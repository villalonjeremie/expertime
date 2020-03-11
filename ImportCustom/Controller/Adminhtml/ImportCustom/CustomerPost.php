<?php
namespace Expertime\ImportCustom\Controller\Adminhtml\ImportCustom;

use Magento\Framework\Controller\ResultFactory;


class CustomerPost extends \Expertime\ImportCustom\Controller\Adminhtml\Import
{

    public function execute()
    {
        $url = $this->getRequest()->getParam('import-custom-customer-input');
        $websiteId  = $this->storeManager->getWebsite()->getWebsiteId();

        $httpAdapter = $this->curlFactory->create();
        $httpAdapter->write(\Zend_Http_Client::GET, $url, '1.1', ["Content-Type:application/json"]);
        $result = $httpAdapter->read();
        $body = \Zend_Http_Response::extractBody($result);
        $response = $this->jsonHelper->jsonDecode($body);

        //check if the data is correct
        if (empty($response['data'])) {
            $this->messsageManager->addErrorMessage(__('Result empty'));
        } else {
            if (empty($response['data'][0]['id']) ||
                empty($response['data'][0]['email']) ||
                empty($response['data'][0]['first_name']) ||
                empty($response['data'][0]['last_name']) ||
                empty($response['data'][0]['avatar'])) {
                $this->messsageManager->addErrorMessage(__('Wrong Format of data'));
            } else {

                foreach ($response['data'] as $t){
                    $customer   = $this->customerFactory->create();
                    $customer->setWebsiteId($websiteId);
                    if(!empty($customer->loadByEmail($t['email'])->getId())){
                        continue;
                    }

                    // Preparing data for new customer
                    $customer->setEmail($t['email']);
                    $customer->setFirstname($t['first_name']);
                    $customer->setLastname($t['last_name']);
                    $customer->save();
                }
            }
        }

        $indexidarray = $this->indexFactory->create()->load('customer_grid');
        $indexidarray->reindexAll('customer_grid');
        $this->messageManager->addSuccess(__('Import Customer Success!!!!'));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRedirectUrl());
        return $resultRedirect;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(
                'Magento_TaxImportExport::import_export'
            );
    }
}

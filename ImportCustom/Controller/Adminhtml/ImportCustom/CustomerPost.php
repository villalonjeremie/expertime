<?php
namespace Expertime\ImportCustom\Controller\Adminhtml\ImportCustom;

use Magento\Framework\Controller\ResultFactory;

class CustomerPost extends \Expertime\ImportCustom\Controller\Adminhtml\Import
{
    public function execute()
    {
        $arrayDefault = [
            'group_id' =>1,
            'store_id' =>1,
            'is_active' =>1
        ];

        try{
            //get url from bo
            $url = $this->getRequest()->getParam('import-custom-customer-input');

            $httpAdapter = $this->curlFactory->create();
            $httpAdapter->write(\Zend_Http_Client::GET, $url, '1.1', ["Content-Type:application/json"]);
            $result = $httpAdapter->read();
            $body = \Zend_Http_Response::extractBody($result);
            $response = $this->jsonHelper->jsonDecode($body);

            //check if the data is correct
            if (empty($response['data'])) {
                $this->messsageManager->addErrorMessage(__('Result empty'));
            }

            if (empty($response['data'][0]['id']) ||
                empty($response['data'][0]['email']) ||
                empty($response['data'][0]['first_name']) ||
                empty($response['data'][0]['last_name']) ||
                empty($response['data'][0]['avatar'])) {
                $this->messsageManager->addErrorMessage(__('Wrong Format of data'));
            }

            foreach ($response['data'] as $t){
                $array[] =  array_merge(
                    ['email' => $t['email'],
                    'firstname' => $t['first_name'],
                    'lastname' => $t['last_name']
                ],
                    $arrayDefault
                );
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        try {
            $tableName = $this->resource->getTableName('customer_entity');
            $this->connection->insertMultiple($tableName, $array);
        } catch (\Exception $e) {
           $this->connection->rollBack();
        }

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

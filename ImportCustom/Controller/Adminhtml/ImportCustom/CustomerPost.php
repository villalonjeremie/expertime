<?php
namespace Expertime\ImportCustom\Controller\Adminhtml\ImportCustom;

use Magento\Framework\Controller\ResultFactory;

class CustomerPost extends \Expertime\ImportCustom\Controller\Adminhtml\Import
{
    public function execute()
    {
        $this->messageManager->addSuccess(__('Import Customer Success'));

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

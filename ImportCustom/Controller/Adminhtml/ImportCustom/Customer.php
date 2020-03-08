<?php
namespace Expertime\ImportCustom\Controller\Adminhtml\ImportCustom;

use Magento\Backend\Model\View\Result\Page;

class Customer extends \Expertime\ImportCustom\Controller\Adminhtml\Import
{
    /**
     * @return Page
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Expertime_ImportCustom::import_custom_customer');
        $resultPage->getConfig()->getTitle()->prepend(__('Import Customer by Url'));
        $resultPage->addContent(
            $resultPage->getLayout()->createBlock(\Expertime\ImportCustom\Block\Adminhtml\ImportCustom\Customer::class)
        );

        return $resultPage;
    }
}

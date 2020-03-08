<?php
namespace Expertime\ImportCustom\Controller\Adminhtml;

use Magento\Framework\View\Result\PageFactory;

abstract class Import extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Expertime_ImportCustom::import_custom_customer';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
}

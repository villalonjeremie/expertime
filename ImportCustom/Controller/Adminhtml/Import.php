<?php
namespace Expertime\ImportCustom\Controller\Adminhtml;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\ResourceConnection;

abstract class Import extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Expertime_ImportCustom::import_custom_customer';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Framework\HTTP\Adapter\CurlFactory
     */
    protected $curlFactory;

    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    protected $jsonHelper;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        PageFactory $resultPageFactory,
        \Magento\Framework\HTTP\Adapter\CurlFactory $curlFactory,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        ResourceConnection $resource
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->curlFactory = $curlFactory;
        $this->jsonHelper = $jsonHelper;
        $this->resource = $resource;
        $this->connection = $resource->getConnection();
        parent::__construct($context);
    }
}

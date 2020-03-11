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
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    protected $customerFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        PageFactory $resultPageFactory,
        \Magento\Framework\HTTP\Adapter\CurlFactory $curlFactory,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        ResourceConnection $resource,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Indexer\Model\IndexerFactory $indexFactory,
        \Magento\Indexer\Model\Indexer\CollectionFactory $indexCollection
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->curlFactory = $curlFactory;
        $this->jsonHelper = $jsonHelper;
        $this->resource = $resource;
        $this->connection = $resource->getConnection();
        $this->storeManager     = $storeManager;
        $this->customerFactory  = $customerFactory;
        $this->indexFactory = $indexFactory;
        $this->indexCollection = $indexCollection;
        parent::__construct($context);
    }
}

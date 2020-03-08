<?php

namespace Expertime\ImportCustom\Block\Adminhtml\ImportCustom;

class Customer extends \Magento\Backend\Block\Widget
{
    /**
     * @var string
     */
    protected $_template = 'Expertime_ImportCustom::importCustom.phtml';

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param array $data
     */
    public function __construct(\Magento\Backend\Block\Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->setUseContainer(true);
    }
}

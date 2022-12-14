<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Chalhoub\Attributes\Block;

class DisplayBlock extends \Magento\Framework\View\Element\Template
{

    protected $checkoutSession;
    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        $this->_checkoutSession = $checkoutSession;
        parent::__construct($context, $data);
    }

    public function getQuoteData()
    {
        $this->_checkoutSession->getQuote();
        if (!$this->hasData('quote')) {
            $this->setData('quote', $this->_checkoutSession->getQuote());
        }
        return $this->_getData('quote');
    }

    /**
     * @return string
     */
    public function displaylevelshoes()
    {
        //Your block code
        return __('Hello Developer! This how to get the storename: %1 and this is the way to build a url: %2', $this->_storeManager->getStore()->getName(), $this->getUrl('contacts'));
    }
}

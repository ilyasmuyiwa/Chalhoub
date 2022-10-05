<?php

namespace Chalhoub\Attributes\Plugin\Webapi;

use Magento\Quote\Model\Quote;

class QuoteRepository
{
    /**
     * Update quote with custom fields
     *
     * @param \Magento\Quote\Model\QuoteRepository $subject
     * @param callable $proceed
     * @param int $cartId
     * @return \Magento\Quote\Model\Quote
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function aroundGet(
        \Magento\Quote\Model\QuoteRepository $subject,
        \Closure $proceed,
                                             $cartId
    ) {
        /** @var \Magento\Quote\Model\Quote $quote */
        $quote = $proceed($cartId);
        if ($quote && $quoteItems = $quote->getItems()) {
            foreach ($quoteItems as $quoteItem) {
                $extensionAttributes = $quoteItem->getExtensionAttributes();

                if ($extensionAttributes === null) {
                    $extensionAttributes = $this->getQuoteItemExtensionDependency();
                }

                $productAttr = $quoteItem->getProduct()->getlevelshoes(); //Get Product Attribute
                $extensionAttributes->setLevelShoesApi($productAttr); //Set quote extension attribute
                $quoteItem->setExtensionAttributes($extensionAttributes);
            }
        }
        return $quote;
    }

    private function getQuoteItemExtensionDependency()
    {
        $quoteItemExtension = \Magento\Framework\App\ObjectManager::getInstance()->get(
            '\Magento\Quote\Api\Data\CartItemExtension'
        );
        return $quoteItemExtension;
    }
}

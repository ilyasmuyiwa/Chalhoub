<?php

namespace Chalhoub\Attributes\Plugin\Carrier;

use Magento\Quote\Model\Cart\ShippingMethodConverter;
use Magento\Quote\Api\Data\ShippingMethodInterface;
use Magento\Quote\Api\Data\ShippingMethodExtensionFactory;
use Magento\Quote\Model\Quote\Address\Rate;

class LevelCarrier
{
    /**
     * @var ShippingMethodExtensionFactory
     */
    protected $extensionFactory;

    protected $checkoutSession;
    /**
     * DeliveryDate constructor.
     *
     * @param ShippingMethodExtensionFactory $extensionFactory
     */
    public function __construct(ShippingMethodExtensionFactory $extensionFactory,

                                \Magento\Checkout\Model\Session $checkoutSession
    )
    {
        $this->_checkoutSession = $checkoutSession;
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * Converts a specified rate model to a shipping method data object.
     *
     * @param string $quoteCurrencyCode The quote currency code.
     * @param \Magento\Quote\Model\Quote\Address\Rate $rateModel The rate model.
     * @return \Magento\Quote\Api\Data\ShippingMethodInterface Shipping method data object.
     */
    public function aroundModelToDataObject(ShippingMethodConverter $subject,   \Closure $proceed,
                                            Rate $rate, $quoteCurrencyCode)
    {
        $result =  $proceed($rate,$quoteCurrencyCode );
        $extensibleAttribute =  ($result->getExtensionAttributes())
            ? $result->getExtensionAttributes()
            : $this->extensionFactory->create();

        $levelAddress = $rate->getAddress()->getleveladdress();

        $extensibleAttribute->setLevelRate($levelAddress );

        $result->setExtensionAttributes($extensibleAttribute);

        return $result;
    }

}

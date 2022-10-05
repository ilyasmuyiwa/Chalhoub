<?php

namespace Chalhoub\AttributesTotal\Plugin\Quote;

use Magento\Quote\Api\Data\TotalsInterface;
use Magento\Quote\Api\CartTotalRepositoryInterface;
use Magento\Quote\Api\Data\TotalsExtensionInterfaceFactory;

class TotalsPlugin
{
    /**
     * @var TotalsExtensionInterfaceFactory
     */
    protected $totalsExtensionInterfaceFactory;

    /**
     * TotalsPlugin constructor.
     *
     * @param TotalsExtensionInterfaceFactory $totalsExtensionInterfaceFactory
     */
    public function __construct(TotalsExtensionInterfaceFactory $totalsExtensionInterfaceFactory)
    {
        $this->totalsExtensionInterfaceFactory = $totalsExtensionInterfaceFactory;
    }

    /**
     * After get items.
     *
     * @param CartTotalRepositoryInterface $subject
     * @param TotalsInterface $result
     * @return TotalsInterface
     */
    public function afterGet(
        CartTotalRepositoryInterface $subject,
        TotalsInterface $result
    ) {

        $extensionAttributes = $result->getExtensionAttributes();
        if (!$extensionAttributes) {
            $extensionAttributes = $this->totalsExtensionInterfaceFactory->create();
        }
        $extensionAttributes->setLevelDiscount(100); //dummy test value
        $result->setExtensionAttributes($extensionAttributes);

        return $result;
    }
}


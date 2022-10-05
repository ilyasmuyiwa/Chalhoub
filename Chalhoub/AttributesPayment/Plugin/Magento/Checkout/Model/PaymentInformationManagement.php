<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Chalhoub\AttributesPayment\Plugin\Magento\Checkout\Model;

class PaymentInformationManagement
{

    protected $orderRepository;
    protected $paymentFactory;
    protected $logger;
    protected $quoteRepository;

    public function __construct(
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        \Magento\Quote\Api\Data\PaymentExtensionFactory $paymentFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->paymentFactory = $paymentFactory;
        $this->logger = $logger;
        $this->quoteRepository = $quoteRepository;
    }

    public function beforeSavePaymentInformationAndPlaceOrder(
        \Magento\Checkout\Api\PaymentInformationManagementInterface $subject,
                                                                    $cartId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
    )
    {

        if ($paymentMethod->getExtensionAttributes()->getLevelPayment()) {
            $quote = $this->quoteRepository->getActive($cartId);
            $quote->setLevelPayment($paymentMethod->getExtensionAttributes()->getLevelPayment());
            $this->quoteRepository->save($quote);
        }
    }
}


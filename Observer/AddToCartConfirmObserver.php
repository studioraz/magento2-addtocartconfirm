<?php

namespace SR\AddToCartConfirm\Observer;

use Magento\Framework\Event\ObserverInterface;

class AddToCartConfirmObserver implements ObserverInterface {

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession
    )
    {
        $this->checkoutSession = $checkoutSession;
    }

    /**
     * Use add to cart event to store product id as a unique session key to use it later
     * in CustomerData class.
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer) {

        /* @var $product \Magento\Catalog\Model\Product */
        $product = $observer->getEvent()->getProduct();

        $this->checkoutSession->setLastAddedProductForConfirmPopup($product->getId());

        return $this;
    }
}
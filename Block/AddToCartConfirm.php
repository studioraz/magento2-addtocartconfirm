<?php
namespace SR\AddToCartConfirm\Block;
class AddToCartConfirm extends \Magento\Framework\View\Element\Template
{
    function _prepareLayout()
    {
    }

    /**
     * Returns popup config
     *
     * @return array
     */
    public function getConfig()
    {
        return [
            'shoppingCartUrl' => $this->getShoppingCartUrl(),
            'checkoutUrl' => $this->getCheckoutUrl()
        ];
    }

    /**
     * Get shopping cart page url
     *
     * @return string
     * @codeCoverageIgnore
     */
    public function getShoppingCartUrl()
    {
        return $this->getUrl('checkout/cart');
    }

    /**
     * Get one page checkout page url
     *
     * @codeCoverageIgnore
     * @return string
     */
    public function getCheckoutUrl()
    {
        return $this->getUrl('checkout');
    }
}

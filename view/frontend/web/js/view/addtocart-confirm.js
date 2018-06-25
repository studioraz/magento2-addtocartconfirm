/**
 * Copyright © 2018 Studio Raz. All rights reserved.
 * For more information contact us at dev@studioraz.co.il
 */

/*jshint browser:true jquery:true*/
/*global alert*/

define([
    'jquery',
    'ko',
    'uiComponent',
    'SR_AddToCartConfirm/js/model/addtocart-confirm',
    'mage/translate',
    'mage/url',
    'Magento_Ui/js/modal/modal',
    'Magento_Customer/js/customer-data'
], function ($, ko, Component, addtocartConfirm, $t, url, model, customerData) {
    'use strict';

    return Component.extend({
        modalWindow: null,
        isLoading: ko.observable(false),
        defaults: {
            template: 'SR_AddToCartConfirm/addtocart-confirm'
        },

        /**
         * Init
         */
        initialize: function () {
            var self = this,
                addToCartData = customerData.get('addtocart-confirm');

            self.observe('productImageHtml productName successMessage productSku');

            addToCartData.subscribe(function (updatedAddToCart) {
                self.productImageHtml(updatedAddToCart.product_image_html)
                    .productName(updatedAddToCart.product_name)
                    .successMessage(updatedAddToCart.success_message)
                    .productSku(updatedAddToCart.product_sku);
                self.showModal();
            }, this);

            this._super();
        },

        /** Init popup login window */
        setModalElement: function (element) {
            this.modalWindow = element;
            if (addtocartConfirm.modalWindow == null) {
                addtocartConfirm.createPopUp(element);
            }
        },

        /** Is login form enabled for current customer */
        isActive: function () {
            // TODO-SR: use config value
            return true
        },

        /** Show login popup window */
        showModal: function () {
            if (this.modalWindow) {
                $(this.modalWindow).modal('openModal');
            } else {
                model({
                    content: $t('Something went wrong while...')
                });
            }
        }
    });
});

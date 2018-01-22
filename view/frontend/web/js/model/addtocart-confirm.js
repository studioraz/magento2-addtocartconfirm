/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
/*jshint browser:true jquery:true*/
/*global alert*/
define(
    [
        'jquery',
        'Magento_Ui/js/modal/modal',
        'mage/translate'
    ],
    function ($, modal, $t) {
        'use strict';

        return {
            modalWindow: null,

            /** Create popUp window for provided element */
            createPopUp: function (element) {
                this.modalWindow = element;
                var options = {
                    'autoOpen': false,
                    'type': 'popup',
                    'clickableOverlay' : true,
                    'modalClass': 'popup-addtocart-confirm',
                    'responsive': true,
                    'innerScroll': true,
                    'buttons': [
                        {
                            text: $t('Continue Shopping'),
                            class: 'action secondary action-continue-shopping',
                            click: function () {
                                this.closeModal();
                            }
                        },
                        {
                            text: $t('Go to Cart Page'),
                            class: 'action primary action-go-to-cart',
                            click: function () {
                                window.location.href = window.addtocartConfirm.shoppingCartUrl;
                            }
                        }
                    ]
                };
                modal(options, $(this.modalWindow));
            },

            /** Show login popup window */
            showModal: function () {
                $(this.modalWindow).modal('openModal');
            }
        }
    }
);

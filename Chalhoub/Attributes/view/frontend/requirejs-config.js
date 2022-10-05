var config = {
    "map": {
        "*": {
            'Magento_Checkout/js/model/shipping-save-processor/default': 'Chalhoub_Attributes/js/model/shipping-save-processor/default'
        }
    },
    config: {
        mixins: {
            'Magento_Checkout/js/action/set-shipping-information': {
                'Chalhoub_Attributes/js/action/set-shipping-information-mixin': true
            },

        }
    }
};

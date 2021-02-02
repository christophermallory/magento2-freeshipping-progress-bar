# Magento 2 Free Shipping Progress Bar

## Description
![Free Shipping Progress Bar](https://i.postimg.cc/PxkF85Jf/Screen-Shot-2021-02-01-at-9-21-40-PM.png)

This Magento 2 module adds a free shipping progress bar to your Magento site's shopping cart to promote increased order value. The styles used were intended to allow for this module to be a drop-in feature for the luma theme or other themes based on it. All of the animations are CSS based and no javascript is used to limit overhead.

### Screenshots

#### Order Value Below Free Shipping Minimum
![Order Value Below Free Shipping Minimum](https://i.postimg.cc/mhx4cGvQ/Screen-Shot-2021-02-01-at-9-05-48-PM.png)

#### Order Value Over Free Shipping Minimum
![Order Value Over Free Shipping Minimum](https://i.postimg.cc/nVXQQG8z/Screen-Shot-2021-02-01-at-9-06-11-PM.png)

## Installation

### Using Composer (Recommended)
 - Install the module composer by running `composer require chrismallory/module-freeshipping-progress-bar`
 - Enable the module by running `php bin/magento module:enable ChrisMallory_FreeShippingProgressBar`
 - apply database updates by running `php bin/magento setup:upgrade`
 - Flush the cache by running `php bin/magento cache:flush`

### Manual File Transfer
- Clone or unzip this repository to `app/code/ChrisMallory_FreeShippingProgressBar`
- Enable the module by running `php bin/magento module:enable ChrisMallory_FreeShippingProgressBar`
- Apply database updates by running `php bin/magento setup:upgrade`
- Flush the cache by running `php bin/magento cache:flush`

## Configuration
This module adds new fields to the Sales > Checkout section of your stores configuration.

### How to Configure
To access this module's configuration, navigate to `Stores > Settings > Configuration > Sales > Checkout` then expand the `Shopping Cart` group.

![Free Shipping Progress Bar Settings](https://i.postimg.cc/jjy7CsBh/Screen-Shot-2021-02-01-at-9-00-46-PM.png)

### Settings Explanation

#### Enable Free Shipping Progress Bar
If set to yes, a free shipping progress bar will be shown on the shopping cart in the cart summary. By default, the free shipping progress bar is disabled.

#### Use Free Shipping Method Configuration
If set to yes, this module will use the configuration for the core Free Shipping method. If that method is enabled then this Free Shipping Progress Bar will show based on that method's minimum order subtotal. If set to no, you will be able to set a custom order subtotal for this Free Shipping Progress Bar to show based on. This setting is primarily useful if your store is using a free shipping method other than the core Free Shipping method. By default, this setting is set to yes.

#### Free Shipping Progress Bar Minimum Order Total
When the above setting is set to no, this field is where you set the order value that the Free Shipping Progress Bar counts down to.

## Compatibility
This module has been tested and validated to work on Magento versions 2.3 and higher.

This module uses a ViewModel and should be compatible with versions 2.2 and higher but has not been tested on versions lower than 2.3.

## Bugs & Issues
If you find a bug or issue please create a new issue [here](https://github.com/christophermallory/magento2-freeshipping-progress-bar/issues) and include as much detail and context as possible including screenshots.

## License
This module is licensed under the Open Software License V3.0 which you can refer to [here](LICENSE.txt).

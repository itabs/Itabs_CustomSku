Itabs_CustomSku
===============

Allow customers to specify their own SKU for the products of an online shop.

Facts
-----
- Version: 1.0.0
- [extension on GitHub](https://github.com/itabs/Itabs_CustomSKU)

Description
-----------

In larger B2B online shops it is a typical use case that customers have custom SKUs for the products of the shop owner and they order only the products with the custom SKUs.

#### Features
- The customer can define the custom SKUs in the customer account
- THe custom SKU will be shown (if applicable) in the cart, checkout review, order/invoice/creditmemo/shipment views in the customer account
- The custom SKU will always be automatically set onto a quote item and transferred to the order item for further processing (e.g. order export)
- The custom SKU will be shown in the admin order view.

Compatibility
-------------
- Magento >= 1.6

Installation Instructions
-------------------------

#### Manually
- Clone the repository or download the latest version of this extension.
- Copy all the files from the **src** folder into your Magento document root

#### Via modman

- Install [modman](https://github.com/colinmollenhour/modman) on your system
- Run the following command in your Magento document root: 

`modman clone https://github.com/itabs/Itabs_CustomSku.git`

#### Via composer
- Install [composer](http://getcomposer.org/download/) on your system
- Install [Magento Composer](https://github.com/magento-hackathon/magento-composer-installer) or any other Magento composer installer.
- Create a composer.json into your project like the following sample:

```json
{
    "require": {
        "itabs/customsku":"*"
    },
    "repositories": [
	    {
            "type": "composer",
            "url": "http://packages.firegento.com"
        }
    ],
    "extra":{
        "magento-root-dir": "htdocs/"
    }
}
```

- From your `composer.json` folder run `php composer.phar install` or `composer install`

#### Final steps
- Clear the cache, logout from the admin panel and then log back in
- Configure and activate the extension under System - Configuration - Developer.

Uninstallation
--------------
- Remove all extension files from your Magento installation:

```
app/code/community/Itabs/CustomSku
app/etc/modules/Itabs_CustomSku.xml
app/design/adminhtml/default/default/layout/itabs_customsku.xml
app/design/adminhtml/default/default/template/itabs/customsku
app/design/frontend/base/default/layout/itabs_customsku.xml
app/design/frontend/base/default/template/itabs/customsku
app/locale/de_DE/Itabs_CustomSku.csv
skin/frontend/base/default/itabs/customsku
skin/frontend/rwd/default/itabs/customsku
```

- Via modman: `modman remove Itabs_CustomSku`
* Via composer, remove the requirement of `itabs/customsku`

After the uninstallation of the extension you need to run the following SQL:
```sql
  DELETE FROM `core_resource` WHERE code = 'itabs_customsku_setup';
  DROP TABLE `itabs_customsku`;
```

Support
-------
If you have any issues with this extension, open an issue on [GitHub](https://github.com/itabs/Itabs_CustomSku/issues).

Contribution
------------
Any contribution is highly appreciated. The best way to contribute code is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).

Developer
---------
Rouven Alexander Rieker / ITABS GmbH
- [http://www.itabs.de](http://www.itabs.de)
- [@therouv](https://twitter.com/therouv)
- [@itabs_gmbh](https://twitter.com/itabs_gmbh)

License
-------
[MIT](http://opensource.org/licenses/MIT) - For the full copyright and license information, please view the LICENSE file that was distributed with this source code.

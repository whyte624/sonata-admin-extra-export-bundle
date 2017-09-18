SonataAdminExtraExportBundle
===============

[SonataAdminExtraExportBundle][sonata-admin-extra-export-bundle] is a PHP (5.4+) extension for [Sonata Admin](https://github.com/sonata-project/SonataAdminBundle). By default Sonata Admin has json, xml, csv and xls export formats. 

The SonataAdminExtraExportBundle provides a simple integration for your Symfony project with Sonata Admin and adds support of:

* pdf (requires [KnpSnappyBundle](https://github.com/KnpLabs/KnpSnappyBundle))
* jpg (requires [KnpSnappyBundle](https://github.com/KnpLabs/KnpSnappyBundle))


Installation
------------

With [composer](http://packagist.org), add:

```json
{
    "require": {
        "whyte624/sonata-admin-extra-export-bundle": "dev-master"
    }
}
```

Then enable it in your kernel:

```php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        //...
        new Whyte624\SonataAdminExtraExportBundle\Whyte624SonataAdminExtraExportBundle(),
        new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
        //...
```
Configuration
-------------
Configure [KnpSnappyBundle](https://github.com/KnpLabs/KnpSnappyBundle).

[SonataAdminExtraExportBundle][sonata-admin-extra-export-bundle] requires you to add traits with export formats to Admin class and extension of export method to CRUDController class.

Add trait to Admin class:


```php
//src/Acme/AcmeBundle/Admin/MyAdmin.php
use Sonata\AdminBundle\Admin\Admin;
use Whyte624\SonataAdminExtraExportBundle\Admin\AdminExtraExportTrait;

class MyAdmin extends Admin
{
    //...
    use AdminExtraExportTrait;
    //...
```

Add trait to CRUDController class

```php
//src/Acme/AcmeBundle/Controller/MyCRUDController.php
use Sonata\AdminBundle\Controller\CRUDController;
use Whyte624\SonataAdminExtraExportBundle\Controller\CRUDControllerExtraExportTrait;

class MyCRUDController extends CRUDController
{
    //...
    use CRUDControllerExtraExportTrait;
    //...

```

This will add extra export formats to your admin.


Pdf layout
-----
You can easily add your companies logo to PDF export, by overriding Whyte624SonataAdminExtraExportBundle::html_layout.html.twig. Just make sure, that paths for images and css that you are using are absolute.

Override getPdfOptions class in your CRUDController class to change orientation to landscape.

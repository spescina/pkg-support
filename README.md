[![Build Status](https://travis-ci.org/spescina/pkg-support.svg?branch=master)](https://travis-ci.org/spescina/pkg-support?branch=master)
[![Coverage Status](https://coveralls.io/repos/spescina/pkg-support/badge.png?branch=master)](https://coveralls.io/r/spescina/pkg-support?branch=master)
# Package Development Support  

Support config and language classes for creating laravel packages

## Install && Usage

Add in the target package `composer.json`  
```
"require": {
    "spescina/pkg-support": "1.x"
}
```

Let the main package class implements the `Spescina\PkgSupport\PackageInterface`.  
In the same class import the `Spescina\PkgSupport\PkgTrait` trait.
Now the constructor has to respect the interface definition.  

```
public function __construct(ServiceInterface $config, ServiceInterface $lang)
{
        $this->config = $config;
        $this->lang = $lang;
}
```

Then you should take care of these dependencies when instantiating the object, usually in the package service provider.  
```
$this->app['mypackage'] = $this->app->share(function($app) {
        return new MyPackage(new Config('mypackage'), new Lang('mypackage'));
});
```

This constructor force the creation of a config and a lang object keeping the registration key for your package. With them, it will be possible to use Laravel Config and Lang facades from the package classes without having to specify the package prefix every time.  
Assuming your class has a facade, you can now make these calls
* `MyPackage::conf()` equal to `Config::get('mypackage::mypackage')`
* `MyPackage::conf('key')` equal to `Config::get('mypackage::mypackage.key')`
* `MyPackage::conf('key', 'section')` equal to `Config::get('mypackage::section.key')`
* `MyPackage::lang('key')` equal to `Lang::get('mypackage::mypackage.key')`
* `MyPackage::lang('key', 'section')` equal to `Lang::get('mypackage::section.key')`



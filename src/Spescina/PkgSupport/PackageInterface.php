<?php namespace Spescina\PkgSupport;

interface PackageInterface {

        public function __construct(ServiceInterface $config, ServiceInterface $lang);
        
        public function conf($key = null, $section = null);
        
        public function lang($key, $section = null);

}

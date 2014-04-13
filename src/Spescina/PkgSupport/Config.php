<?php namespace Spescina\PkgSupport;

use Illuminate\Support\Facades\Config as IlluminateConfig;

class Config implements ServiceInterface {

        private $registrationkey;

        public function __construct($registrationKey)
        {
                $this->registrationkey = $registrationKey;
        }

        public function get($key = null, $section = null)
        {
                if (is_null($key)) {
                        return IlluminateConfig::get("{$this->registrationkey}::{$this->registrationkey}");
                }
                
                return is_null($section)
                        ? IlluminateConfig::get("{$this->registrationkey}::{$this->registrationkey}.$key") 
                        : IlluminateConfig::get("{$this->registrationkey}::{$section}.$key");
        }

}

<?php namespace Spescina\PkgSupport;

use Illuminate\Support\Facades\Lang as IlluminateLang;

class Lang implements ServiceInterface {

        private $registrationkey;

        public function __construct($registrationKey)
        {
                $this->registrationkey = $registrationKey;
        }

        public function get($key, $section = null)
        {
                return is_null($section)
                        ? IlluminateLang::get("{$this->registrationkey}::{$this->registrationkey}.$key") 
                        : IlluminateLang::get("{$this->registrationkey}::{$section}.$key");
        }

}

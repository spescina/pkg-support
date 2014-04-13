<?php namespace Spescina\PkgSupport;

interface ServiceInterface {

        public function __construct($registrationKey);

        public function get($key, $section = null);

}

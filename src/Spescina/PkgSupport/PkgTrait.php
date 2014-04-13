<?php namespace Spescina\PkgSupport;

trait PkgTrait {

        public $config;
        public $lang;

        public function conf($key = null, $section = null)
        {
                return $this->config->get($key, $section);
        }

        public function lang($key, $section = null)
        {
                return $this->lang->get($key, $section);
        }

}

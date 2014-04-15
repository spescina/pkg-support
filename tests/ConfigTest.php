<?php

use Illuminate\Support\Facades\Config as IlluminateConfig;
use Mockery as m;
use Spescina\PkgSupport\Config;

class ConfigTest extends PHPUnit_Framework_TestCase {

        private $config;
        private $registrationKey = 'mypackage';
        
        public function setUp()
        {
                $this->config = new Config($this->registrationKey);
        }

        public function tearDown()
        {
                m::close();
        }
        
        public function test_get_key_alone()
        {
                IlluminateConfig::shouldReceive('get')
                        ->once()
                        ->with("$this->registrationKey::$this->registrationKey.key")
                        ->andReturn('key value');
                
                $config = $this->config->get('key');
                
                $this->assertEquals('key value', $config);                
        }
        
        public function test_get_key_with_section()
        {
                IlluminateConfig::shouldReceive('get')
                        ->once()
                        ->with("$this->registrationKey::section.key")
                        ->andReturn('another key value');
                
                $config = $this->config->get('key', 'section');
                
                $this->assertEquals('another key value', $config);                
        }
        
        public function test_get_all_keys()
        {
                IlluminateConfig::shouldReceive('get')
                        ->once()
                        ->with("$this->registrationKey::$this->registrationKey")
                        ->andReturn(array(
                            'key' => 'key value',
                            'another_key' => 'anoher key value'
                        ));
                
                $config = $this->config->get();
                
                $this->assertEquals(array(
                    'key' => 'key value',
                    'another_key' => 'anoher key value'
                ), $config);                
        }
        
        public function test_get_all_keys_with_ignored_section()
        {
                IlluminateConfig::shouldReceive('get')
                        ->once()
                        ->with("$this->registrationKey::$this->registrationKey")
                        ->andReturn(array(
                            'key' => 'key value',
                            'another_key' => 'anoher key value'
                        ));
                
                $config = $this->config->get(null, 'section');
                
                $this->assertEquals(array(
                    'key' => 'key value',
                    'another_key' => 'anoher key value'
                ), $config);                
        }

}

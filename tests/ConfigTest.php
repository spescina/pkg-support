<?php

use Illuminate\Support\Facades\Config as IlluminateConfig;
use Mockery as m;
use Spescina\PkgSupport\Config;

class ConfigTest extends PHPUnit_Framework_TestCase {

        public function tearDown()
        {
                m::close();
        }
        
        public function test_get_key_alone()
        {
                $registrationKey = 'mypackage';
                
                IlluminateConfig::shouldReceive('get')
                        ->once()
                        ->with("$registrationKey::$registrationKey.key")
                        ->andReturn('key value');
                
                $service = new Config($registrationKey);
                
                $config = $service->get('key');
                
                $this->assertEquals('key value', $config);                
        }
        
        public function test_get_key_with_section()
        {
                $registrationKey = 'mypackage';
                
                IlluminateConfig::shouldReceive('get')
                        ->once()
                        ->with("$registrationKey::section.key")
                        ->andReturn('another key value');
                
                $service = new Config($registrationKey);
                
                $config = $service->get('key', 'section');
                
                $this->assertEquals('another key value', $config);                
        }
        
        public function test_get_all_keys()
        {
                $registrationKey = 'mypackage';
                
                IlluminateConfig::shouldReceive('get')
                        ->once()
                        ->with("$registrationKey::$registrationKey")
                        ->andReturn(array(
                            'key' => 'key value',
                            'another_key' => 'anoher key value'
                        ));
                
                $service = new Config($registrationKey);
                
                $config = $service->get();
                
                $this->assertEquals(array(
                    'key' => 'key value',
                    'another_key' => 'anoher key value'
                ), $config);                
        }
        
        public function test_get_all_keys_with_ignored_section()
        {
                $registrationKey = 'mypackage';
                
                IlluminateConfig::shouldReceive('get')
                        ->once()
                        ->with("$registrationKey::$registrationKey")
                        ->andReturn(array(
                            'key' => 'key value',
                            'another_key' => 'anoher key value'
                        ));
                
                $service = new Config($registrationKey);
                
                $config = $service->get(null, 'section');
                
                $this->assertEquals(array(
                    'key' => 'key value',
                    'another_key' => 'anoher key value'
                ), $config);                
        }

}

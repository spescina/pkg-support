<?php

use Illuminate\Support\Facades\Lang as IlluminateLang;
use Mockery as m;
use Spescina\PkgSupport\Lang;

class LangTest extends PHPUnit_Framework_TestCase {

        public function tearDown()
        {
                m::close();
        }

        public function test_get_key_alone()
        {
                $registrationKey = 'mypackage';

                IlluminateLang::shouldReceive('get')
                        ->once()
                        ->with("$registrationKey::$registrationKey.key")
                        ->andReturn('key value');

                $service = new Lang($registrationKey);

                $config = $service->get('key');

                $this->assertEquals('key value', $config);
        }

        public function test_get_key_with_section()
        {
                $registrationKey = 'mypackage';

                IlluminateLang::shouldReceive('get')
                        ->once()
                        ->with("$registrationKey::section.key")
                        ->andReturn('another key value');

                $service = new Lang($registrationKey);

                $config = $service->get('key', 'section');

                $this->assertEquals('another key value', $config);
        }

}

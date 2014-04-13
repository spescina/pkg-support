<?php namespace Spescina\PkgSupport;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Spescina\PkgSupport\PkgVault;

class PkgSupportServiceProvider extends ServiceProvider {

	/**
         * Indicates if loading of the provider is deferred.
         *
         * @var bool
         */
        protected $defer = false;

        /**
         * Bootstrap the application events.
         *
         * @return void
         */
        public function boot()
        {
                $this->package('spescina/pkg-support');
        }

        /**
         * Register the service provider.
         *
         * @return void
         */
        public function register()
        {
                $this->registerServices();

                $this->registerAlias();
        }

        /**
         * Get the services provided by the provider.
         *
         * @return array
         */
        public function provides()
        {
                return array(
                    'pkgsupport.vault'
                );
        }

        private function registerAlias()
        {
                AliasLoader::getInstance()->alias('PkgVault', 'Spescina\PkgSupport\Facades\PkgVault');
        }

        private function registerServices()
        {
                $this->app['pkgsupport.vault'] = $this->app->share(function($app) {
                        return new PkgVault();
                });
        }

}

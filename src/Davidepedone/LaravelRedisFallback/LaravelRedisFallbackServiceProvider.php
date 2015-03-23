<?php namespace Davidepedone\LaravelRedisFallback;

use Illuminate\Cache\CacheServiceProvider;

class LaravelRedisFallbackServiceProvider extends CacheServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function boot(){
		$this->package('davidepedone/laravel-redis-fallback');
		$this->app->booting(function() {
		  $loader = \Illuminate\Foundation\AliasLoader::getInstance();
		  $loader->alias('LaravelRedisFallback', 'Davidepedone\LaravelRedisFallback\LaravelRedisFallbackFacade');
		});
	}

	public function register(){
		$this->app->bindShared('cache', function($app){
			return new \Davidepedone\LaravelRedisFallback\LaravelRedisFallback($app);
		});

		$this->app->bindShared('cache.store', function($app){
			return $app['cache']->driver();
		});

		$this->app->bindShared('memcached.connector', function(){
			return new MemcachedConnector;
		});

		$this->registerCommands();
	}

}

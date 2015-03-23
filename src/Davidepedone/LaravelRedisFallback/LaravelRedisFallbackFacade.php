<?php  namespace Davidepedone\LaravelRedisFallback;

use Illuminate\Support\Facades\Facade;

class LaravelRedisFallbackFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'laravel-redis-fallback'; }

}

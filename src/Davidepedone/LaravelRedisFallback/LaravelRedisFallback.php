<?php namespace Davidepedone\LaravelRedisFallback;
use \Illuminate\Cache\CacheManager;
use \Illuminate\Cache\RedisStore;

/**
 * @author Davide Pedone <davide.pedone@gmail.com>
 *
 **/

class LaravelRedisFallback extends CacheManager{

    protected function createRedisDriver() {

        $redis = $this->app['redis'];
        $redisStore = new RedisStore($redis, $this->getPrefix());
        try{
            $redisStore->getRedis()->ping();
            return $this->repository( $redisStore );

        }catch(\Exception $e){

            return parent::createFileDriver();
        }
        
    }
}

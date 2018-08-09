<?php

namespace Amber\Cache;

use Amber\Cache\Exception\InvalidArgumentException;
use Psr\SimpleCache\CacheInterface;

class Cache
{
    /**
     * @var The instance of the cache driver
     */
    protected static $instance;

    /**
     * @var List of cache drivers.
     */
    protected static $drivers = [
        'file'  => 'Amber\Cache\Driver\SimpleCache',
        'json'  => 'Amber\Cache\Driver\JsonCache',
        'array' => 'Amber\Cache\Driver\ArrayCache',
        'apcu'  => 'Amber\Cache\Driver\ApcuCache',
    ];

    /**
     * Singleton implementation.
     */
    public static function getInstance()
    {
        /* Checks if the CacheInterface is already instantiated. */
        if (!self::$instance instanceof CacheInterface) {
            self::$instance = self::driver('file');
        }

        return self::$instance;
    }

    /**
     * Returns an instance of the desired Cache driver.
     *
     * @param string $driver The driver to instantiate.
     *
     * @return CacheInterface An instance of the Cache driver.
     */
    public static function driver($driver)
    {
        if (isset(self::$drivers[$driver])) {
            $driver = self::$drivers[$driver];
        }

        if (class_exists($driver)) {
            return self::$instance = new $driver();
        }

        throw new InvalidArgumentException("Cache driver {$driver} not found or could not be instantiated.");
    }

    /**
     * Calls statically methods from the Cache driver instance.
     *
     * @param string $method The Cache driver method.
     * @param string $args   The arguments for the Cache driver method.
     *
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        return call_user_func_array([self::getInstance(), $method], $args);
    }
}

<?php

namespace Amber\Cache\CacheAware;

use Amber\Cache\Driver\CacheDriver;

interface CacheAwareInterface
{
    /**
     * Sets the cache driver.
     *
     * @param CacheDriver $driver An instance of the cache driver.
     *
     * @return void
     */
    public function setCache(CacheDriver $driver);

    /**
     * Gets the cache driver.
     *
     * @param CacheDriver $driver An instance of the cache driver.
     *
     * @return CacheDriver The stored cache driver.
     */
    public function getCache(): CacheDriver;
}

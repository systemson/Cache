<?php
/**
 * This file is part of the Amber/Cache package.
 *
 * @package Amber/Cache
 * @author Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU Public License
 */

namespace Amber\Cache\CacheAware;

use Amber\Cache\Cache;
use Amber\Cache\Driver\CacheDriver;

/**
 * CacheAware implementation.
 */
trait CacheAwareTrait
{
    /**
     * @var The instance of the cache driver.
     */
    protected $cache_driver;

    /**
     * Sets the cache driver.
     *
     * @param CacheDriver $driver An instance of the cache driver.
     *
     * @return void
     */
    public function setCache(CacheDriver $driver): void
    {
        $this->cache_driver = $driver;
    }

    /**
     * Gets the cache driver.
     *
     * @param CacheDriver $driver An instance of the cache driver.
     *
     * @return CacheDriver The instance of the cache driver.
     */
    public function getCache($driver = null): CacheDriver
    {
        $driver_class = $driver ?? $this->getConfig('cache.cache_driver', 'file');

        /* Checks if the CacheInterface is already instantiated. */
        if (!$this->cache_driver instanceof CacheDriver) {
            $this->cache_driver = Cache::driver($driver_class);

            $this->cache_driver->setConfig($this->getCacheConfig());
        }

        return $this->cache_driver;
    }

    /**
     * Gets the cache config vars
     *
     * @return array The cache config vars.
     */
    protected function getCacheConfig(): iterable
    {
        return $this->getConfig('cache') ?? [];
    }
}

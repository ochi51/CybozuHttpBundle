<?php

namespace CybozuHttpBundle\Cybozu;

use CybozuHttp\CacheClient;

/**
 * @author ochi51 <ochiai07@gmail.com>
 */
class CacheClientFactory
{
    /**
     * @param Config $config
     * @return CacheClient
     */
    public static function factory(Config $config)
    {
        return new CacheClient($config->toArray());
    }
}
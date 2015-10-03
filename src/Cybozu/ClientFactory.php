<?php

namespace CybozuHttpBundle\Cybozu;

use CybozuHttp\Client;

/**
 * @author ochi51 <ochiai07@gmail.com>
 */
class ClientFactory
{
    /**
     * @param Config $config
     * @return Client
     */
    public static function factory(Config $config)
    {
        return Client::factory($config->toArray());
    }
}
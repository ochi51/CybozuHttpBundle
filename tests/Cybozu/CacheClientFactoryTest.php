<?php

namespace Cybozu;

use CybozuHttp\CacheClient;
use CybozuHttpBundle\Cybozu\CacheClientFactory;
use CybozuHttpBundle\Cybozu\Config;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * @author ochi51 <ochiai07@gmail.com>
 */
class CacheClientFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testFactory()
    {
        $ts = new TokenStorage();
        $token = new UsernamePasswordToken('test_user', 'pass', 'default', ['ROLE_USER']);
        $ts->setToken($token);

        $config = new Config($ts, [
            "domain"            => "cybozu.com",
            "subdomain"         => "changeMe",
            "use_api_token"     => false,
            "login"             => "changeMe",
            "password"          => "changeMe",
            "token"             => null,
            "use_basic"         => false,
            "basic_login"       => null,
            "basic_password"    => null,
            "use_client_cert"   => false,
            "cert_file"         => "cert.pem",
            "cert_password"     => null,
            "use_cache"         => true,
            "cache_dir"         => __DIR__ . '/../_output/cache',
            "cache_ttl"         => 0,
            "debug"             => false
        ], '/path/to/cert_dir', '/path/to/logfile.log');

        $client = CacheClientFactory::factory($config);

        $this->assertTrue($client instanceof CacheClient);
    }

}

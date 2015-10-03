<?php

namespace CybozuHttpBundle\Tests\Cybozu;

use CybozuHttp\Client;
use CybozuHttpBundle\Cybozu\ClientFactory;
use CybozuHttpBundle\Cybozu\Config;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * @author ochi51 <ochiai07@gmail.com>
 */
class ClientFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testFactory()
    {
        $ts = new TokenStorage();
        $token = new UsernamePasswordToken('test_user', 'pass', 'default', ['ROLE_USER']);
        $ts->setToken($token);

        $config = new Config($ts, [
            "domain" =>         "cybozu.com",
            "subdomain" =>      "changeMe",
            "useApiToken" =>    false,
            "login" =>          "changeMe",
            "password" =>       "changeMe",
            "token" =>          null,
            "useBasic" =>       false,
            "basicLogin" =>     null,
            "basicPassword" =>  null,
            "useClientCert" =>  false,
            "certFile" =>       "cert.pem",
            "certPassword" =>   null,
            "debug" => false
        ], '/path/to/cert_dir', '/path/to/logfile.log');

        $client = ClientFactory::factory($config);

        $this->assertTrue($client instanceof Client);
    }
}

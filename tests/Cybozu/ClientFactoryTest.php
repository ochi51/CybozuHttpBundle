<?php

namespace CybozuHttpBundle\Tests\Cybozu;

use CybozuHttp\Client;
use CybozuHttpBundle\Cybozu\ClientFactory;
use CybozuHttpBundle\Cybozu\Config;
use CybozuHttpBundle\Tests\Entity\TestUser;
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
        $testUser = new TestUser();
        $token = new UsernamePasswordToken($testUser, 'pass', 'default', ['ROLE_USER']);
        $ts->setToken($token);

        $config = new Config($ts, '/path/to/cert_dir', __DIR__ . '/../_output/cybozu-http.log');

        $client = ClientFactory::factory($config);

        $this->assertTrue($client instanceof Client);
    }
}

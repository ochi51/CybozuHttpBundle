<?php

namespace CybozuHttpBundle\Tests\Cybozu;

use CybozuHttpBundle\Cybozu\Config;
use CybozuHttpBundle\Tests\Entity\TestUser;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * @author ochi51 <ochiai07@gmail.com>
 */
class ConfigTest extends \PHPUnit_Framework_TestCase
{

    public function testConstruct()
    {
        $ts = new TokenStorage();
        $testUser = new TestUser();
        $token = new UsernamePasswordToken($testUser, 'pass', 'default', ['ROLE_USER']);
        $ts->setToken($token);

        $config = new Config($ts, '/path/to/cert_dir', '/path/to/logfile.log');
        $this->assertEquals($config->getConfig(), [
            'cert_file' => '/path/to/cert_dir/cert.pem',
            'debug' => true,
            'logfile' => '/path/to/logfile.log',
        ] + $testUser->getCybozuHttpConfig());
    }

    public function testSetUser()
    {
        $ts = new TokenStorage();
        $config = new Config($ts, '/path/to/cert_dir', '/path/to/logfile.log');

        $testUser = new TestUser();

        try {
            $config->getConfig();
        } catch (\RuntimeException $e) {
            self::assertTrue(true);
        }

        $config->setUser($testUser);
        $this->assertEquals($config->getConfig(), [
                'cert_file' => '/path/to/cert_dir/cert.pem',
                'debug' => true,
                'logfile' => '/path/to/logfile.log',
            ] + $testUser->getCybozuHttpConfig());

    }
}

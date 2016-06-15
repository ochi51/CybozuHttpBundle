<?php

namespace CybozuHttpBundle\Tests;

use CybozuHttpBundle\CybozuHttpBundle;
use CybozuHttpBundle\DependencyInjection\CybozuHttpExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use CybozuHttpBundle\Tests\Entity\TestUser;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * @author ochi51 <ochiai07@gmail.com>
 */
class CybozuHttpBundleTest extends \PHPUnit_Framework_TestCase
{

    public function testBundle()
    {
        $container = new ContainerBuilder();
        $bundle    = new CybozuHttpBundle();
        $bundle->build($container);

        $this->assertTrue($bundle instanceof Bundle);

        $ts = new TokenStorage();
        $testUser = new TestUser();
        $token = new UsernamePasswordToken($testUser, 'pass', 'default', ['ROLE_USER']);
        $ts->setToken($token);
        $container->set('security.token_storage', $ts);

        $extension = new CybozuHttpExtension();
        $container->registerExtension($extension);
        $container->loadFromExtension($extension->getAlias());
        $container->compile();

        $this->assertTrue($container->has('cybozu_http.cybozu.config'));
        $this->assertTrue($container->has('cybozu_http.client'));
        $this->assertTrue($container->has('cybozu_http.cache_client'));
        $this->assertTrue($container->has('cybozu_http.kintone_api_client'));
        $this->assertTrue($container->has('cybozu_http.user_api_client'));
        $this->assertTrue($container->has('cybozu_http.cache_kintone_api_client'));
        $this->assertTrue($container->has('cybozu_http.cache_user_api_client'));
    }
}

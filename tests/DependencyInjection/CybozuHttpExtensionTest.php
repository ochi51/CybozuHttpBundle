<?php

namespace CybozuHttpBundle\Tests\DependencyInjection;

use CybozuHttpBundle\DependencyInjection\CybozuHttpExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;

/**
 * @author ochi51 <ochiai07@gmail.com>
 */
class CybozuHttpExtensionTest extends AbstractExtensionTestCase
{
    /**
     * @var array
     */
    private static $config = [
        'domain'            => 'cybozu.com',
        'subdomain'         => 'test',
        'use_api_token'     => false,
        'login'             => 'test@ochi51.com',
        'password'          => 'password',
        'token'             => null,
        'use_basic'         => true,
        'basic_login'       => 'basic_login',
        'basic_password'    => 'password',
        'use_client_cert'   => false,
        'cert_file'         => '/path/to/cert.pem',
        'cert_password'     => 'password',
        'use_cache'         => true,
        'cache_dir'         => '/path/to/cache_dir',
        'cache_ttl'         => 60
    ];

    public function testServiceDefinitions()
    {
        $this->load();

        $this->assertContainerBuilderHasService('cybozu_http.client', 'CybozuHttp\Client');
        $this->assertContainerBuilderHasService('cybozu_http.kintone_api_client', 'CybozuHttp\Api\KintoneApi');
        $this->assertContainerBuilderHasService('cybozu_http.user_api_client', 'CybozuHttp\Api\UserApi');
        $this->assertContainerBuilderHasService('cybozu_http.cybozu.config', 'CybozuHttpBundle\Cybozu\Config');
    }

    /**
     * {@inheritdoc}
     */
    protected function getContainerExtensions()
    {
        return [new CybozuHttpExtension()];
    }
}

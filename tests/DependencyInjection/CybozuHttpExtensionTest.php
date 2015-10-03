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
        'domain'        => 'cybozu.com',
        'subdomain'     => 'test',
        'useApiToken'   => false,
        'login'         => 'test@ochi51.com',
        'password'      => 'password',
        'token'         => null,
        'useBasic'      => true,
        'basicLogin'    => 'basic_login',
        'basicPassword' => 'password',
        'useClientCert' => false,
        'certFile'      => '/path/to/cert.pem',
        'certPassword'  => 'password'
    ];

    public function testParameters()
    {
        $this->load(self::$config + [
            'cert_dir' => '/path/to/cert_dir',
            'debug' => true,
            'logfile' => '/path/to/logfile.log',
            'test' => true
        ]);

        $this->assertContainerBuilderHasParameter('cybozu_http.test', true);
        $this->assertContainerBuilderHasParameter('cybozu_http.config.domain');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.subdomain');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.useApiToken');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.login');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.password');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.token');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.useBasic');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.basicLogin');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.basicPassword');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.useClientCert');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.certFile');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.certPassword');
        $this->assertContainerBuilderHasParameter('cybozu_http.cert_dir');
        $this->assertContainerBuilderHasParameter('cybozu_http.debug');
        $this->assertContainerBuilderHasParameter('cybozu_http.logfile');
        $this->assertContainerBuilderHasParameter('cybozu_http.test');
    }

    public function testServiceDefinitions()
    {
        $this->load(self::$config);

        $this->assertContainerBuilderHasService('cybozu_http.client', 'CybozuHttp\Client');
        $this->assertContainerBuilderHasService('cybozu_http.kintone_api_client', 'CybozuHttp\Api\KintoneApi');
        $this->assertContainerBuilderHasService('cybozu_http.user_api_client', 'CybozuHttp\Api\UserApi');
    }

    /**
     * {@inheritdoc}
     */
    protected function getContainerExtensions()
    {
        return [new CybozuHttpExtension()];
    }
}

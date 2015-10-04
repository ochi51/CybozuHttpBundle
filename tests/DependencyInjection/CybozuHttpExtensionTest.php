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
        'use_api_token'   => false,
        'login'         => 'test@ochi51.com',
        'password'      => 'password',
        'token'         => null,
        'use_basic'      => true,
        'basic_login'    => 'basic_login',
        'basic_password' => 'password',
        'use_client_cert' => false,
        'cert_file'      => '/path/to/cert.pem',
        'cert_password'  => 'password'
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
        $this->assertContainerBuilderHasParameter('cybozu_http.config.use_api_token');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.login');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.password');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.token');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.use_basic');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.basic_login');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.basic_password');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.use_client_cert');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.cert_file');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.cert_password');
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

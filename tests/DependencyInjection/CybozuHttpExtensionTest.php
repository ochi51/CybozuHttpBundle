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
        'cert_password'     => 'password'
    ];

    public function testParameters()
    {
        $this->load([
            'config' => self::$config,
            'cert_dir' => '/path/to/cert_dir',
            'debug' => true,
            'logfile' => '/path/to/logfile.log',
            'test' => true
        ]);

        $this->assertContainerBuilderHasParameter('cybozu_http.config', self::$config);
        $this->assertContainerBuilderHasParameter('cybozu_http.config.domain', 'cybozu.com');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.subdomain', 'test');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.use_api_token', false);
        $this->assertContainerBuilderHasParameter('cybozu_http.config.login', 'test@ochi51.com');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.password', 'password');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.token');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.use_basic', true);
        $this->assertContainerBuilderHasParameter('cybozu_http.config.basic_login', 'basic_login');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.basic_password', 'password');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.use_client_cert', false);
        $this->assertContainerBuilderHasParameter('cybozu_http.config.cert_file', '/path/to/cert.pem');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.cert_password', 'password');
        $this->assertContainerBuilderHasParameter('cybozu_http.cert_dir', '/path/to/cert_dir');
        $this->assertContainerBuilderHasParameter('cybozu_http.debug', true);
        $this->assertContainerBuilderHasParameter('cybozu_http.logfile', '/path/to/logfile.log');
        $this->assertContainerBuilderHasParameter('cybozu_http.test', true);
    }

    public function testNoneParameters()
    {
        $this->load();
        $this->assertContainerBuilderHasParameter('cybozu_http.config', []);
        $this->assertContainerBuilderHasParameter('cybozu_http.config.domain', 'cybozu.com');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.subdomain');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.use_api_token', false);
        $this->assertContainerBuilderHasParameter('cybozu_http.config.login');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.password');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.token');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.use_basic', false);
        $this->assertContainerBuilderHasParameter('cybozu_http.config.basic_login');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.basic_password');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.use_client_cert', false);
        $this->assertContainerBuilderHasParameter('cybozu_http.config.cert_file');
        $this->assertContainerBuilderHasParameter('cybozu_http.config.cert_password');
        $this->assertContainerBuilderHasParameter('cybozu_http.cert_dir');
        $this->assertContainerBuilderHasParameter('cybozu_http.debug', false);
        $this->assertContainerBuilderHasParameter('cybozu_http.logfile');
        $this->assertContainerBuilderHasParameter('cybozu_http.test', false);
    }

    public function testServiceDefinitions()
    {
        $this->load([
            'config' => self::$config
        ]);

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

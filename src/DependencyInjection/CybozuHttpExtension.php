<?php

namespace CybozuHttpBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @author ochi51 <ochiai07@gmail.com>
 */
class CybozuHttpExtension extends Extension
{
    /**
     * @param array[]          $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
        $this->setParameters($container, $config);
    }

    /**
     * @param ContainerBuilder $container
     * @param string[]         $config
     */
    protected function setParameters(ContainerBuilder $container, array $config)
    {
        $container->setParameter('cybozu_http.config.domain', $config['domain']);
        $container->setParameter('cybozu_http.config.subdomain', $config['subdomain']);
        $container->setParameter('cybozu_http.config.use_api_token', $config['use_api_token']);
        $container->setParameter('cybozu_http.config.login', $config['login']);
        $container->setParameter('cybozu_http.config.password', $config['password']);
        $container->setParameter('cybozu_http.config.token', $config['token']);
        $container->setParameter('cybozu_http.config.use_basic', $config['use_basic']);
        $container->setParameter('cybozu_http.config.basic_login', $config['basic_login']);
        $container->setParameter('cybozu_http.config.basic_password', $config['basic_password']);
        $container->setParameter('cybozu_http.config.use_client_cert', $config['use_client_cert']);
        $container->setParameter('cybozu_http.config.cert_file', $config['cert_file']);
        $container->setParameter('cybozu_http.config.cert_password', $config['cert_password']);
        $container->setParameter('cybozu_http.cert_dir', $config['cert_dir']);
        $container->setParameter('cybozu_http.debug', $config['debug']);
        $container->setParameter('cybozu_http.logfile', $config['logfile']);
        $container->setParameter('cybozu_http.test', $config['test']);
    }
}
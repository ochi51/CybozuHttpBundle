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
        $container->setParameter('cybozu_http.config.useApiToken', $config['useApiToken']);
        $container->setParameter('cybozu_http.config.login', $config['login']);
        $container->setParameter('cybozu_http.config.password', $config['password']);
        $container->setParameter('cybozu_http.config.token', $config['token']);
        $container->setParameter('cybozu_http.config.useBasic', $config['useBasic']);
        $container->setParameter('cybozu_http.config.basicLogin', $config['basicLogin']);
        $container->setParameter('cybozu_http.config.basicPassword', $config['basicPassword']);
        $container->setParameter('cybozu_http.config.useClientCert', $config['useClientCert']);
        $container->setParameter('cybozu_http.config.certFile', $config['certFile']);
        $container->setParameter('cybozu_http.config.certPassword', $config['certPassword']);
        $container->setParameter('cybozu_http.cert_dir', $config['cert_dir']);
        $container->setParameter('cybozu_http.debug', $config['debug']);
        $container->setParameter('cybozu_http.logfile', $config['logfile']);
        $container->setParameter('cybozu_http.test', $config['test']);
    }
}
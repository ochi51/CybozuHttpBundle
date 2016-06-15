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
     * @param array            $config
     */
    protected function setParameters(ContainerBuilder $container, array $config)
    {
        $this->setConfigParameter($container, $config);
        $this->setCertDirParameter($container, $config);
        $this->setDebugParameter($container, $config);
        $this->setLogfileParameter($container, $config);
        $this->setTestParameter($container, $config);
    }

    /**
     * @param ContainerBuilder $container
     * @param array            $config
     */
    private function setConfigParameter(ContainerBuilder $container, array $config)
    {
        if (!isset($config['config'])) {
            $config['config'] = [];
        }
        $container->setParameter('cybozu_http.config', $config['config']);
        $this->setDomainParameter($container, $config['config']);
        $this->setSubdomainParameter($container, $config['config']);
        $this->setUseApiTokenParameter($container, $config['config']);
        $this->setLoginParameter($container, $config['config']);
        $this->setPasswordParameter($container, $config['config']);
        $this->setTokenParameter($container, $config['config']);
        $this->setUseBasicParameter($container, $config['config']);
        $this->setBasicLoginParameter($container, $config['config']);
        $this->setBasicPasswordParameter($container, $config['config']);
        $this->setUseClientCertParameter($container, $config['config']);
        $this->setCertFileParameter($container, $config['config']);
        $this->setCertPasswordParameter($container, $config['config']);
        $this->setUseCacheParameter($container, $config['config']);
        $this->setCacheDirParameter($container, $config['config']);
        $this->setCacheTtlParameter($container, $config['config']);
    }

    /**
     * @param ContainerBuilder $container
     * @param string[]         $config
     */
    private function setDomainParameter(ContainerBuilder $container, array $config)
    {
        if (!isset($config['domain'])) {
            $config['domain'] = 'cybozu.com';
        }
        $container->setParameter('cybozu_http.config.domain', $config['domain']);
    }

    /**
     * @param ContainerBuilder $container
     * @param string[]         $config
     */
    private function setSubdomainParameter(ContainerBuilder $container, array $config)
    {
        if (!isset($config['subdomain'])) {
            $config['subdomain'] = null;
        }
        $container->setParameter('cybozu_http.config.subdomain', $config['subdomain']);
    }

    /**
     * @param ContainerBuilder $container
     * @param string[]         $config
     */
    private function setUseApiTokenParameter(ContainerBuilder $container, array $config)
    {
        $container->setParameter('cybozu_http.config.use_api_token', !empty($config['use_api_token']));
    }

    /**
     * @param ContainerBuilder $container
     * @param string[]         $config
     */
    private function setLoginParameter(ContainerBuilder $container, array $config)
    {
        if (!isset($config['login'])) {
            $config['login'] = null;
        }
        $container->setParameter('cybozu_http.config.login', $config['login']);
    }

    /**
     * @param ContainerBuilder $container
     * @param string[]         $config
     */
    private function setPasswordParameter(ContainerBuilder $container, array $config)
    {
        if (!isset($config['password'])) {
            $config['password'] = null;
        }
        $container->setParameter('cybozu_http.config.password', $config['password']);
    }

    /**
     * @param ContainerBuilder $container
     * @param string[]         $config
     */
    private function setTokenParameter(ContainerBuilder $container, array $config)
    {
        if (!isset($config['token'])) {
            $config['token'] = null;
        }
        $container->setParameter('cybozu_http.config.token', $config['token']);
    }

    /**
     * @param ContainerBuilder $container
     * @param string[]         $config
     */
    private function setUseBasicParameter(ContainerBuilder $container, array $config)
    {
        $container->setParameter('cybozu_http.config.use_basic', !empty($config['use_basic']));
    }

    /**
     * @param ContainerBuilder $container
     * @param string[]         $config
     */
    private function setBasicLoginParameter(ContainerBuilder $container, array $config)
    {
        if (!isset($config['basic_login'])) {
            $config['basic_login'] = null;
        }
        $container->setParameter('cybozu_http.config.basic_login', $config['basic_login']);
    }

    /**
     * @param ContainerBuilder $container
     * @param string[]         $config
     */
    private function setBasicPasswordParameter(ContainerBuilder $container, array $config)
    {
        if (!isset($config['basic_password'])) {
            $config['basic_password'] = null;
        }
        $container->setParameter('cybozu_http.config.basic_password', $config['basic_password']);
    }

    /**
     * @param ContainerBuilder $container
     * @param string[]         $config
     */
    private function setUseClientCertParameter(ContainerBuilder $container, array $config)
    {
        $container->setParameter('cybozu_http.config.use_client_cert', !empty($config['use_client_cert']));
    }

    /**
     * @param ContainerBuilder $container
     * @param string[]         $config
     */
    private function setCertFileParameter(ContainerBuilder $container, array $config)
    {
        if (!isset($config['cert_file'])) {
            $config['cert_file'] = null;
        }
        $container->setParameter('cybozu_http.config.cert_file', $config['cert_file']);
    }

    /**
     * @param ContainerBuilder $container
     * @param string[]         $config
     */
    private function setCertPasswordParameter(ContainerBuilder $container, array $config)
    {
        if (!isset($config['cert_password'])) {
            $config['cert_password'] = null;
        }
        $container->setParameter('cybozu_http.config.cert_password', $config['cert_password']);
    }

    /**
     * @param ContainerBuilder $container
     * @param string[]         $config
     */
    private function setUseCacheParameter(ContainerBuilder $container, array $config)
    {
        if (!isset($config['use_cache'])) {
            $config['use_cache'] = false;
        }
        $container->setParameter('cybozu_http.config.use_cache', $config['use_cache']);
    }

    /**
     * @param ContainerBuilder $container
     * @param string[]         $config
     */
    private function setCacheDirParameter(ContainerBuilder $container, array $config)
    {
        if (!isset($config['cache_dir'])) {
            $config['cache_dir'] = null;
        }
        $container->setParameter('cybozu_http.config.cache_dir', $config['cache_dir']);
    }

    /**
     * @param ContainerBuilder $container
     * @param string[]         $config
     */
    private function setCacheTtlParameter(ContainerBuilder $container, array $config)
    {
        if (!isset($config['cache_ttl'])) {
            $config['cache_ttl'] = 0;
        }
        $container->setParameter('cybozu_http.config.cache_ttl', $config['cache_ttl']);
    }

    /**
     * @param ContainerBuilder $container
     * @param array            $config
     */
    private function setCertDirParameter(ContainerBuilder $container, array $config)
    {
        if (!isset($config['cert_dir'])) {
            $config['cert_dir'] = null;
        }
        $container->setParameter('cybozu_http.cert_dir', $config['cert_dir']);
    }

    /**
     * @param ContainerBuilder $container
     * @param array            $config
     */
    private function setDebugParameter(ContainerBuilder $container, array $config)
    {
        $container->setParameter('cybozu_http.debug', !empty($config['debug']));
    }

    /**
     * @param ContainerBuilder $container
     * @param array            $config
     */
    private function setLogfileParameter(ContainerBuilder $container, array $config)
    {
        if (!isset($config['logfile'])) {
            $config['logfile'] = null;
        }
        $container->setParameter('cybozu_http.logfile', $config['logfile']);
    }

    /**
     * @param ContainerBuilder $container
     * @param array            $config
     */
    private function setTestParameter(ContainerBuilder $container, array $config)
    {
        $container->setParameter('cybozu_http.test', !empty($config['test']));
    }
}
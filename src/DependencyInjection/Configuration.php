<?php

namespace CybozuHttpBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author ochi51 <ochiai07@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('cybozu_http');
        $rootNode
            ->children()
                ->scalarNode('domain')->defaultValue('cybozu.com')->end()
                ->scalarNode('subdomain')->defaultNull()->end()
                ->booleanNode('useApiToken')->defaultFalse()->end()
                ->scalarNode('login')->defaultNull()->end()
                ->scalarNode('password')->defaultNull()->end()
                ->scalarNode('token')->defaultNull()->end()
                ->booleanNode('useBasic')->defaultFalse()->end()
                ->scalarNode('basicLogin')->defaultNull()->end()
                ->scalarNode('basicPassword')->defaultNull()->end()
                ->booleanNode('useClientCert')->defaultFalse()->end()
                ->scalarNode('certFile')->defaultNull()->end()
                ->scalarNode('certPassword')->defaultNull()->end()
                ->scalarNode('cert_dir')->defaultNull()->end()
                ->booleanNode('debug')->defaultFalse()->end()
                ->scalarNode('logfile')->defaultNull()->end()
                ->booleanNode('test')->defaultFalse()->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
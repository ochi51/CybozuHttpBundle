<?php

namespace CybozuHttpBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

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
        $this->setChildrenNodes($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition|NodeDefinition $rootNode
     */
    private function setChildrenNodes(ArrayNodeDefinition $rootNode)
    {
        $rootNode->children()
            ->arrayNode('config')
                ->children()
                    ->scalarNode('domain')->isRequired()->defaultValue('cybozu.com')->end()
                    ->scalarNode('subdomain')->isRequired()->defaultNull()->end()
                    ->booleanNode('use_api_token')->defaultFalse()->end()
                    ->scalarNode('login')->defaultNull()->end()
                    ->scalarNode('password')->defaultNull()->end()
                    ->scalarNode('token')->defaultNull()->end()
                    ->booleanNode('use_basic')->defaultFalse()->end()
                    ->scalarNode('basic_login')->defaultNull()->end()
                    ->scalarNode('basic_password')->defaultNull()->end()
                    ->booleanNode('use_client_cert')->defaultFalse()->end()
                    ->scalarNode('cert_file')->defaultNull()->end()
                    ->scalarNode('cert_password')->defaultNull()->end()
                    ->booleanNode('use_cache')->defaultFalse()->end()
                    ->scalarNode('cache_dir')->defaultNull()->end()
                    ->scalarNode('cache_ttl')->defaultNull()->end()
                ->end()
            ->end()
            ->scalarNode('cert_dir')->defaultNull()->end()
            ->booleanNode('debug')->defaultFalse()->end()
            ->scalarNode('logfile')->defaultNull()->end()
            ->booleanNode('test')->defaultFalse()->end()
        ->end();
    }
}
<?php

namespace Arii\ATSBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('arii_ats');

        $rootNode
            ->children()
              ->scalarNode('host')
                ->defaultValue('host')
              ->end()
            ->end()
            ->children()
              ->scalarNode('user')
                ->defaultValue('user')
              ->end()
            ->end()
            ->children()
              ->scalarNode('password')
                ->defaultValue('password')
              ->end()
            ->end()
            ->children()
              ->scalarNode('profile')
                ->defaultValue('profile')
              ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}

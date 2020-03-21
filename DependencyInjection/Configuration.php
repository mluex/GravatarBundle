<?php

namespace Mluex\GravatarBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Mluex\GravatarBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('mluex_gravatar', 'array');

        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC for symfony/config < 4.2
            $rootNode = $treeBuilder->root('mluex_gravatar', 'array');
        }
        $rootNode
            ->children()
                ->scalarNode('size')->defaultValue('80')->end()
                ->scalarNode('rating')->defaultValue('g')->end()
                ->scalarNode('default')->defaultValue('mm')->end()
                ->booleanNode('secure')->defaultFalse()->end()
            ->end();

        return $treeBuilder;
    }
}

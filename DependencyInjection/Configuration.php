<?php

namespace Glory\Bundle\OAuthBundle\DependencyInjection;

use HWI\Bundle\OAuthBundle\DependencyInjection\Configuration as BaseConfiguration;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration for the extension
 */
class Configuration extends BaseConfiguration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder $builder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();

        $rootNode = $builder->root('glory_oauth');
        $this->addResourceOwnersConfiguration($rootNode);
        return $builder;
    }

}

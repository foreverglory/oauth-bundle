<?php

namespace Glory\Bundle\OAuthBundle\DependencyInjection;

use HWI\Bundle\OAuthBundle\DependencyInjection\HWIOAuthExtension;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class GloryOAuthExtension extends HWIOAuthExtension // Extension
{

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/'));
        $loader->load('services.yml');

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/'));
        $loader->load('oauth.xml');
        $loader->load('templating.xml');
        $loader->load('twig.xml');
        $loader->load('http_client.xml');
        //parent::load($configs, $container);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'glory_oauth';
    }

}

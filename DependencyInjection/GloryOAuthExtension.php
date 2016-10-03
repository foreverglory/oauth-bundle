<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\OAuthBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Glory\Bundle\OAuthBundle\GloryOAuthSupport;

/**
 * GloryOAuthExtension
 * 
 * @see \HWI\Bundle\OAuthBundle\DependencyInjection\HWIOAuthExtension
 * 
 * @author ForeverGlory <foreverglory@qq.com>
 */
class GloryOAuthExtension extends Extension
{

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config/'));
        $loader->load('services.yml');
        $loader->load('owners.yml');

        $processor = new Processor();
        $config = $processor->processConfiguration(new Configuration(), $configs);

        $container
                ->getDefinition('glory_oauth.oauth_manager')
                ->addMethodCall('setOAuthClass', array($config['oauth_class']));

        // setup http client settings
        $httpClient = $container->getDefinition('glory_oauth.http_client');
        $httpClient->addMethodCall('setVerifyPeer', array($config['http_client']['verify_peer']));
        $httpClient->addMethodCall('setTimeout', array($config['http_client']['timeout']));
        $httpClient->addMethodCall('setMaxRedirects', array($config['http_client']['max_redirects']));
        $httpClient->addMethodCall('setIgnoreErrors', array($config['http_client']['ignore_errors']));
        if (isset($config['http_client']['proxy']) && $config['http_client']['proxy'] != '') {
            $httpClient->addMethodCall('setProxy', array($config['http_client']['proxy']));
        }

        // setup services for all configured resource owners
        foreach ($config['owners'] as $name => $options) {
            $this->createOwnerService($container, $name, $options);
        }

        // check of the connect controllers etc should be enabled

        $container->setParameter('glory_oauth.auto_register', $config['auto_register']);
        $container->setAlias('glory_oauth.connect', $config['connect']);
    }

    /**
     * Creates a resource owner service.
     *
     * @example code
     * $extension = $container->getExtension('glory_oauth');
     * $extension->createOwnerService($container,$name,[]);
     * 
     * @param ContainerBuilder $container The container builder
     * @param string           $name      The name of the service
     * @param array            $options   Additional options of the service
     */
    public function createOwnerService(ContainerBuilder $container, $name, array $options)
    {
        $ownerId = 'glory_oauth.owner.' . $name;
        // alias services
        if (isset($options['service'])) {
            // set the appropriate name for aliased services, compiler pass depends on it
            $container->setAlias($ownerId, $options['service']);
        } else {
            $type = $options['type'];
            unset($options['type']);

            $definition = new DefinitionDecorator('glory_oauth.owner.abstract_' . GloryOAuthSupport::getOwnerType($type));
            $definition->setClass("%glory_oauth.owner.$type.class%");
            $container->setDefinition($ownerId, $definition);
            $definition
                    ->replaceArgument(2, $options)
                    ->replaceArgument(3, $name)
            ;
        }
        $container->getDefinition('glory_oauth.ownermap')
                ->addMethodCall('addOwner', array($name, new Reference($ownerId)));
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'glory_oauth';
    }

}

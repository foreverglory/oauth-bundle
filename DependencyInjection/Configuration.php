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

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Glory\Bundle\OAuthBundle\GloryOAuthSupport;

/**
 * Configuration for the extension
 * 
 * @see \HWI\Bundle\OAuthBundle\DependencyInjection\Configuration
 * 
 * @author ForeverGlory <foreverglory@qq.com>
 */
class Configuration implements ConfigurationInterface
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
        $this->addOAuthClassConfiguration($rootNode);
        $this->addOwnersConfiguration($rootNode);
        $this->addConnectConfiguration($rootNode);
        $this->addHttpClientConfiguration($rootNode);
        
        return $builder;
    }
    
    protected function addOAuthClassConfiguration(ArrayNodeDefinition $node){
        $node
            ->children()
                ->scalarNode('oauth_class')->defaultValue('Glory\Bundle\OAuthBundle\Entity\OAuth')->end()
            ->end();
    }


    protected function addOwnersConfiguration(ArrayNodeDefinition $node)
    {
        $node
            ->fixXmlConfig('owner')
            ->children()
                ->arrayNode('owners')
                    //->isRequired()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->ignoreExtraKeys()
                        ->children()
                            ->scalarNode('base_url')->end()
                            ->scalarNode('access_token_url')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('authorization_url')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('request_token_url')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('revoke_token_url')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('infos_url')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('client_id')->cannotBeEmpty()->end()
                            ->scalarNode('client_secret')->cannotBeEmpty()->end()
                            ->scalarNode('realm')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('scope')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('user_response_class')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('service')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('type')
                                ->validate()
                                    ->ifTrue(function($type) {
                                        return !GloryOAuthSupport::isOwnerSupported($type);
                                    })
                                    ->thenInvalid('Unknown resource owner type "%s".')
                                ->end()
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->arrayNode('paths')
                                ->useAttributeAsKey('name')
                                ->prototype('variable')
                                    ->validate()
                                        ->ifTrue(function($v) {
                                            if (null === $v) {
                                                return true;
                                            }

                                            if (is_array($v)) {
                                                return 0 === count($v);
                                            }

                                            if (is_string($v)) {
                                                return empty($v);
                                            }

                                            return !is_numeric($v);
                                        })
                                        ->thenInvalid('Path can be only string or array type.')
                                    ->end()
                                ->end()
                            ->end()
                            ->arrayNode('options')
                                ->useAttributeAsKey('name')
                                ->prototype('scalar')->end()
                            ->end()
                        ->end()
                        ->validate()
                            ->ifTrue(function($c) {
                                // skip if this contains a service
                                if (isset($c['service'])) {
                                    return false;
                                }

                                // for each type at least these have to be set
                                foreach (array('type', 'client_id', 'client_secret') as $child) {
                                    if (!isset($c[$child])) {
                                        return true;
                                    }
                                }

                                return false;
                            })
                            ->thenInvalid("You should set at least the 'type', 'client_id' and the 'client_secret' of a resource owner.")
                        ->end()
                        ->validate()
                            ->ifTrue(function($c) {
                                // skip if this contains a service
                                if (isset($c['service'])) {
                                    return false;
                                }

                                // Only validate the 'oauth2' and 'oauth1' type
                                if ('oauth2' !== $c['type'] && 'oauth1' !== $c['type']) {
                                    return false;
                                }

                                $children = array('authorization_url', 'access_token_url', 'request_token_url', 'infos_url');
                                foreach ($children as $child) {
                                    // This option exists only for OAuth1.0a
                                    if ('request_token_url' === $child && 'oauth2' === $c['type']) {
                                        continue;
                                    }

                                    if (!isset($c[$child])) {
                                        return true;
                                    }
                                }

                                return false;
                            })
                            ->thenInvalid("All parameters are mandatory for types 'oauth2' and 'oauth1'. Check if you're missing one of: 'access_token_url', 'authorization_url', 'infos_url' and 'request_token_url' for 'oauth1'.")
                        ->end()
                        ->validate()
                            ->ifTrue(function($c) {
                                // skip if this contains a service
                                if (isset($c['service'])) {
                                    return false;
                                }

                                // Only validate the 'oauth2' and 'oauth1' type
                                if ('oauth2' !== $c['type'] && 'oauth1' !== $c['type']) {
                                    return false;
                                }

                                // one of this two options must be set
                                if (0 === count($c['paths'])) {
                                    return !isset($c['user_response_class']);
                                }

                                foreach (array('identifier', 'nickname', 'realname') as $child) {
                                    if (!isset($c['paths'][$child])) {
                                        return true;
                                    }
                                }

                                return false;
                            })
                            ->thenInvalid("At least the 'identifier', 'nickname' and 'realname' paths should be configured for 'oauth2' and 'oauth1' types.")
                        ->end()
                        ->validate()
                            ->ifTrue(function($c) {
                                if (isset($c['service'])) {
                                    // ignore paths & options if none were set
                                    return 0 !== count($c['paths']) || 0 !== count($c['options']) || 3 < count($c);
                                }

                                return false;
                            })
                            ->thenInvalid("If you're setting a 'service', no other arguments should be set.")
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    protected function addConnectConfiguration(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->scalarNode('connect')->defaultValue('glory_oauth.connect.only')->end()
                ->booleanNode('auto_register')->defaultTrue()->end()
            ->end()
        ;
    }
    
    protected function addHttpClientConfiguration(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('http_client')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('timeout')->defaultValue(5)->cannotBeEmpty()->end()
                        ->booleanNode('verify_peer')->defaultTrue()->end()
                        ->scalarNode('max_redirects')->defaultValue(5)->cannotBeEmpty()->end()
                        ->booleanNode('ignore_errors')->defaultTrue()->end()
                        ->scalarNode('proxy')->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
    
}

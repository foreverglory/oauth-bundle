<?php

/**
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 */

namespace Glory\Bundle\OAuthBundle\DependencyInjection\Security\Factory;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\AbstractFactory;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\Reference;

/**
 * OAuthFactory
 * 
 * @author ForeverGlory <foreverglory@qq.com>
 */
class OAuthFactory extends AbstractFactory
{

    public function __construct()
    {
        $this->addOption('check_path', '/connect/{service}/callback');
    }

    /**
     * {@inheritDoc}
     */
    public function addConfiguration(NodeDefinition $node)
    {
        parent::addConfiguration($node);
    }

    /**
     * {@inheritDoc}
     */
    public function getKey()
    {
        return 'oauth';
    }

    /**
     * {@inheritDoc}
     */
    public function getPosition()
    {
        return 'http';
    }

    /**
     * {@inheritDoc}
     */
    protected function createAuthProvider(ContainerBuilder $container, $id, $config, $userProviderId)
    {
        $providerId = 'glory_oauth.authentication.provider.oauth.' . $id;

        $container
                ->setDefinition($providerId, new DefinitionDecorator('glory_oauth.authentication.provider.oauth'))
                ->addArgument(new Reference($userProviderId))
                ->addArgument(new Reference('glory_oauth.user_checker'))
        ;

        return $providerId;
    }

    /**
     * {@inheritDoc}
     * @see \Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\FormLoginFactory::createEntryPoint()
     */
    protected function createEntryPoint($container, $id, $config, $defaultEntryPoint)
    {
        //进入权限页面时的状态，调用form_login的操作，自动转到登录页
        $entryPointId = 'security.authentication.form_entry_point.' . $id;
        $container
                ->setDefinition($entryPointId, new DefinitionDecorator('security.authentication.form_entry_point'))
                ->addArgument(new Reference('security.http_utils'))
                ->addArgument($config['login_path'])
                ->addArgument($config['use_forward'])
        ;

        return $entryPointId;
    }

    /**
     * {@inheritDoc}
     */
    protected function createListener($container, $id, $config, $userProvider)
    {
        $listenerId = parent::createListener($container, $id, $config, $userProvider);

        return $listenerId;
    }

    /**
     * {@inheritDoc}
     */
    protected function getListenerId()
    {
        return 'glory_oauth.authentication.listener.oauth';
    }

}

<?php

namespace Glory\Bundle\OAuthBundle\DependencyInjection\Security\Factory;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\AbstractFactory;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\Reference;


class OAuthFactory extends AbstractFactory
{
    protected $options = array(
        'check_path' => '/connect/{service}/callback',
        'use_forward' => false,
        'require_previous_session' => true,
    );

    protected $defaultSuccessHandlerOptions = array(
        'always_use_default_target_path' => false,
        'default_target_path' => '/',
        'login_path' => '/login',
        'target_path_parameter' => '_target_path',
        'use_referer' => false,
    );

    protected $defaultFailureHandlerOptions = array(
        'failure_path' => null,
        'failure_forward' => false,
        'login_path' => '/login',
        'failure_path_parameter' => '_failure_path',
    );

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
     * Creates a resource owner map for the given configuration.
     *
     * @param ContainerBuilder $container Container to build for
     * @param string           $id        Firewall id
     * @param array            $config    Configuration
     */
    protected function createResourceOwnerMap(ContainerBuilder $container, $id, array $config)
    {
        $resourceOwnersMap = array();
        //todo: 应该是直接从 glory_oauth 配置中，取出
    }

    /**
     * Gets a reference to the resource owner map.
     *
     * @param string $id
     *
     * @return Reference
     */
    protected function getResourceOwnerMapReference($id)
    {
        return new Reference('hwi_oauth.resource_ownermap.'.$id);
    }

    /**
     * {@inheritDoc}
     */
    protected function createAuthProvider(ContainerBuilder $container, $id, $config, $userProviderId)
    {
        $providerId = 'glory_oauth.authentication.provider.oauth.'.$id;

        $this->createResourceOwnerMap($container, $id, $config);

        $container
            ->setDefinition($providerId, new DefinitionDecorator('glory_oauth.authentication.provider.oauth'))
            ->addArgument(new Reference($userProviderId))
            ->addArgument($this->getResourceOwnerMapReference($id))
            ->addArgument(new Reference('hwi_oauth.user_checker'))
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
        $entryPointId = 'security.authentication.form_entry_point.'.$id;
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

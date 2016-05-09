<?php

namespace Glory\Bundle\OAuthBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Glory\Bundle\OAuthBundle\DependencyInjection\GloryOAuthExtension;
use Glory\Bundle\OAuthBundle\DependencyInjection\Security\Factory\OAuthFactory;
use Symfony\Bundle\SecurityBundle\DependencyInjection\SecurityExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class GloryOAuthBundle extends Bundle
{

    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        /** @var $extension SecurityExtension */
        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new OAuthFactory());

    }

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        // return the right extension instead of "auto-registering" it. Now the
        // alias can be glory_oauth instead of glory_o_auth..
        if (null === $this->extension) {
            return new GloryOAuthExtension();
        }

        return $this->extension;
    }

}

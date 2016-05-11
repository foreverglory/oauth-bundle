<?php

/**
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 */

namespace Glory\Bundle\OAuthBundle\OAuth\Provider;

use Glory\Bundle\OAuthBundle\Model\OAuthInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of FOSUserProvider
 *
 * @author ForeverGlory
 */
class FOSUserProvider implements OAuthProviderInterface
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function loadUserByOAuth(OAuthInterface $oauth)
    {
        if ($user = $oauth->getUser()) {
            return $user;
        }
        $manager = $this->container->get('fos_user.user_manager');
        $user = $manager->createUser();
        $user->setUsername($oauth->getUsername());
        return $user;
    }

}

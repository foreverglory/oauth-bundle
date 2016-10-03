<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\OAuthBundle\OAuth\Connect;

use Glory\Bundle\OAuthBundle\OAuth\Connect\FOSUserConnect;
use Glory\Bundle\OAuthBundle\Model\OAuthInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of GloryUserConnect
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class GloryUserConnect extends FOSUserConnect implements ConnectInterface
{

    public function connect(OAuthInterface $oauth, UserInterface $user = null)
    {
        if (!$user) {
            $user = $this->userManager->createUser();
            $user->setUsernameCanonical($oauth->getUsername());
            $user->setUsername($oauth->getNickname());
            $user->setEmail($this->generateEmail($oauth));
            $user->setAvatar($oauth->getAvatar());
            $user->setCreatedSource($oauth->getOwner());
            $user->setEnabled(true);
            $this->userManager->updateUser($user);
        } else {
            if ($user->hasOAuth($oauth->getOwner())) {
                new \LogicException(sprintf('User %s is already connect %s oauth', $user->getUsername(), $oauth->getOwner()));
            }
        }
        $oauth->setUser($user);
        $this->oauthManager->updateOAuth($oauth);
        return $user;
    }

    protected function generateEmail(OAuthInterface $oauth)
    {
        return $oauth->getEmail();
    }

}

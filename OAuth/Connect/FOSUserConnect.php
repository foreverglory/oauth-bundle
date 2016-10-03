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

use Glory\Bundle\OAuthBundle\Model\OAuthManager;
use FOS\UserBundle\Model\UserManagerInterface;
use Glory\Bundle\OAuthBundle\Model\OAuthInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of FOSUserConnect
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class FOSUserConnect implements ConnectInterface
{

    protected $oauthManager;
    protected $userManager;

    public function __construct(OAuthManager $oauthManager, UserManagerInterface $userManager)
    {
        $this->oauthManager = $oauthManager;
        $this->userManager = $userManager;
    }

    public function getConnect(OAuthInterface $oauth)
    {
        return $oauth->getUser();
    }

    public function connect(OAuthInterface $oauth, UserInterface $user = null)
    {
        if (!$user) {
            $user = $this->userManager->createUser();
            $user->setUsernameCanonical($oauth->getUsername());
            $user->setUsername($oauth->getNickname());
            $user->setEmail($this->generateEmail($oauth));
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

    public function unConnect(OAuthInterface $oauth)
    {
        $user = $oauth->getUser();
        if ($user) {
            $user->removeOAuth($oauth->getOwner());
            $this->userManager->updateUser($user);
        }
        $oauth->setUser(null);
        $this->oauthManager->updateOAuth($oauth);
    }

    protected function generateEmail(OAuthInterface $oauth)
    {
        $email = $oauth->getEmail();
        if (!$email) {
            $email = $oauth->getOwner() . '-' . $oauth->getUsername() . '@' . '';
        }
        return $email;
    }

}

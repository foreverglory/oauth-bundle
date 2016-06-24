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

use Glory\Bundle\OAuthBundle\Model\OAuthInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;

/**
 * Description of OnlyConnect
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class OnlyConnect implements ConnectInterface
{

    public function getConnect(OAuthInterface $oauth)
    {
        $roles = array();
        $enabled = true;
        $userNonExpired = true;
        $credentialsNonExpired = true;
        $userNonLocked = true;
        $user = new User($oauth->getNickname(), '', $roles, $enabled, $userNonExpired, $credentialsNonExpired, $userNonLocked);
        return $user;
    }

    public function connect(OAuthInterface $oauth, UserInterface $user = null)
    {
        throw new \LogicException('Don\'t need to do a user connect');
    }

    public function unConnect(OAuthInterface $oauth)
    {
        throw new \LogicException('Don\'t need to do a user connect');
    }

}

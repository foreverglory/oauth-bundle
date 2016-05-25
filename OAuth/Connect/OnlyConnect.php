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
use Symfony\Component\Security\Core\User;

/**
 * Description of OnlyConnect
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class OnlyConnect implements ConnectInterface
{

    public function connect(OAuthInterface $oauth, UserInterface $user = null)
    {
        $roles = array();
        $enabled = true;
        $userNonExpired = true;
        $credentialsNonExpired = true;
        $userNonLocked = true;
        $user = new User($oauth->getNickname(), '', $roles, $enabled, $userNonExpired, $credentialsNonExpired, $userNonLocked);
        return $user;
    }

    public function unConnect(OAuthInterface $oauth)
    {
        
    }

    /**
     * 
     * @param UserResponseInterface $response
     * @return OAuth
     */
    public function createOAuthFromResponse(UserResponseInterface $response)
    {
        $oauthClass = $this->getOAuthClass();
        $oauth = new $oauthClass();
        $oauth->setOwner($response->getResourceOwner()->getName());
        $oauth->setUsername($response->getUsername());
        $oauth->setCreated();
        $this->updateOAuthFromResponse($oauth, $response, true);
        return $oauth;
    }

    /**
     * 
     * @param OAuth $oauth
     * @param UserResponseInterface $response
     * @return OAuth
     */
    public function updateOAuthFromResponse(OAuth $oauth, UserResponseInterface $response, $andFlush = false)
    {
        $oauth->setNickname($response->getNickname());
        $oauth->setFirstname($response->getFirstName());
        $oauth->setLastname($response->getLastName());
        $oauth->setRealname($response->getRealName());
        $oauth->setEmail($response->getEmail());
        $oauth->setAvatar($response->getProfilePicture());
        $oauth->setAccesstoken($response->getAccessToken());
        $oauth->setRefreshtoken($response->getRefreshToken());
        $oauth->setTokensecret($response->getTokenSecret());
        $oauth->setExpires($response->getExpiresIn());
        $this->updateOAuth($oauth, $andFlush);
    }

}

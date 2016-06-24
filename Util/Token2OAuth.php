<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\OAuthBundle\Util;

use Glory\Bundle\OAuthBundle\OAuth\OwnerMap;
use Glory\Bundle\OAuthBundle\Model\OAuthManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Glory\Bundle\OAuthBundle\Model\OAuthInterface;
use Glory\Bundle\OAuthBundle\Security\Core\Authentication\Token\OAuthToken;

/**
 * Description of Token to OAuth
 *
 * @author ForeverGlory
 */
class Token2OAuth
{

    protected $ownerMap;
    protected $oauthManager;

    public function __construct(OwnerMap $ownerMap, OAuthManager $oauthManager)
    {
        $this->ownerMap = $ownerMap;
        $this->oauthManager = $oauthManager;
    }

    public function generate(OAuthToken $token)
    {
        $owner = $this->ownerMap->getOwner($token->getOwnerName());
        $response = $owner->getUserInformation($token->getRawToken());
        $oauth = $this->oauthManager->getOAuth($response->getUsername(), $owner->getName());
        if (!$oauth) {
            $oauth = $this->oauthManager->createOAuth();
            $oauth->setCreated();
            $oauth->setOwner($owner->getName());
            $oauth->setUsername($response->getUsername());
        }
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
        $this->oauthManager->updateOAuth($oauth);
        return $oauth;
    }

}

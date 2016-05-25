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

use Glory\Bundle\OAuthBundle\Model\OAuthInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use HWI\Bundle\OAuthBundle\Security\Core\Authentication\Token\OAuthToken;

/**
 * Description of Token to OAuth
 *
 * @author ForeverGlory
 */
class Token2OAuth
{

    protected $container;
    protected $hasOauth = false;
    protected $oauth;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function handle(OAuthToken $token)
    {
        $ownerMap = $this->container->get('glory_oauth.ownerMap');
        $oauthManager = $this->container->get('glory_oauth.oauth_manager');
        $owner = $ownerMap->getOwner($token->getResourceOwnerName());
        $userInformation = $owner->getUserInformation($token->getRawToken());
        $oauth = $oauthManager->findOAuthBy(['' => $userInformation['']]);
        if (!$this->hasOauth = (boolean) $oauth) {
            $oauth = $oauthManager->createOAuth();
        }
        $this->oauth = $this->bindOAuth($oauth, $userInformation);
    }

    public function bindOAuth(OAuthInterface $oauth, $userInfomation)
    {
        return $oauth;
    }

    public function hasOAuth()
    {
        return $this->hasOauth;
    }

    /**
     * @return OAuthInterface
     */
    public function getOAuth()
    {
        return $this->oauth;
    }

}

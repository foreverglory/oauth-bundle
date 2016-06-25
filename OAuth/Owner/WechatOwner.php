<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\OAuthBundle\OAuth\Owner;

use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\WechatResourceOwner;
use Symfony\Component\HttpFoundation\Request;
use Glory\Bundle\OAuthBundle\Security\Core\Authentication\Token\OAuthToken;

/**
 * Description of WechatOwner
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class WechatOwner extends WechatResourceOwner
{

    public function getAccessToken(Request $request, $redirectUri, array $extraParameters = array())
    {
        $parameters = array_merge(array(
            'appid' => $this->options['client_id'],
            'secret' => $this->options['client_secret'],
            'code' => $request->query->get('code'),
            'grant_type' => 'authorization_code',
                ), $extraParameters);

        $response = $this->doGetTokenRequest($this->options['access_token_url'], $parameters);
        $response = $this->getResponseContent($response);

        $this->validateResponseContent($response);

        return $response;
    }

    /**
     * {@inheritDoc}
     */
    public function getUserInformation(array $accessToken = null, array $extraParameters = array())
    {
        if ('snsapi_userinfo' === $this->options['scope']) {
            $openid = $accessToken['openid'];

            $url = $this->normalizeUrl($this->options['infos_url'], array(
                'access_token' => $accessToken['access_token'],
                'openid' => $openid,
            ));

            $response = $this->doGetUserInformationRequest($url);
            $content = $this->getResponseContent($response);
        } else {
            $content = array(
                'openid' => $accessToken['openid'],
            );
        }

        $this->validateResponseContent($content);

        $response = $this->getUserResponse();
        $response->setResponse($content);
        $response->setResourceOwner($this);
        $response->setOAuthToken(new OAuthToken($accessToken));

        return $response;
    }

}

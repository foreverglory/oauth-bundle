<?php

/*
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 */

namespace Glory\Bundle\OAuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of OAuthController
 *
 * @author ForeverGlory
 */
class OAuthController extends Controller
{

    public function connectAction(Request $request, $service)
    {
        $redirectUrl = $this->generateUrl('glory_oauth_callback', ['service' => $service], true);
        $ownerMap = $this->get('glory_oauth.ownermap');
        $owner = $ownerMap->getOwner($service);
        $authorizationUrl = $owner->getAuthorizationUrl($redirectUrl, []);

        // Check for a return path and store it before redirect
        if ($request->hasSession()) {
            $targetUrl = $request->get('target');
            $targetUrl = $targetUrl? : $request->headers->get('Referer');
            if ($targetUrl) {
                //todo: 这里还有一个可能
                /*if(useForward){
                    
                }*/
                $sessionKey = 'glory_oauth.target_path';
                $request->getSession()->set($sessionKey, $targetUrl);
            }
        }

        return $this->redirect($authorizationUrl);
    }

    public function callbackAction(Request $request)
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using oauth in your security firewall configuration.');
    }

}

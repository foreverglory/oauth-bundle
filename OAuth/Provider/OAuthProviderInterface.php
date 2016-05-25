<?php

/**
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 */

namespace Glory\Bundle\OAuthBundle\OAuth\Provider;

use Glory\Bundle\OAuthBundle\Model\OAuthInterface;

/**
 *
 * @author ForeverGlory
 */
interface OAuthProviderInterface
{

    public function loadUserByOAuth(OAuthInterface $oauth);
}

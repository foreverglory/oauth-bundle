<?php

/**
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 */

namespace Glory\Bundle\OAuthBundle\OAuth;

use Glory\Bundle\OAuthBundle\OAuth\OwnerMap;

/**
 *
 * @author ForeverGlory
 */
interface OwnerMapAwareInterface
{

    public function setOwnerMap(OwnerMap $ownerMap);
}

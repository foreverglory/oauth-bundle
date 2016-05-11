<?php

/**
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 */

namespace Glory\Bundle\OAuthBundle\OAuth;

use Glory\Bundle\OAuthBundle\OAuth\OwnerMap;

/**
 * Description of OwnerMapAwareTrait
 *
 * @author ForeverGlory
 */
trait OwnerMapAwareTrait
{

    protected $ownerMap;

    public function setOwnerMap(OwnerMap $ownerMap)
    {
        $this->ownerMap = $ownerMap;
        return $this;
    }

    public function getOwnerMap()
    {
        return $this->ownerMap;
    }

}

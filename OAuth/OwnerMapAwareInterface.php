<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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

<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\OAuthBundle\Model;

use Glory\Bundle\OAuthBundle\Model\OAuthInterface;

/**
 * UserOAuthInterface
 * 
 * User Entity must implements this Interface
 * 
 * @author ForeverGlory
 */
interface UserOAuthInterface
{

    public function hasOAuth($owner);

    public function addOAuth(OAuthInterface $oauth);

    public function removeOAuth($owner);

    public function getOAuths();
}

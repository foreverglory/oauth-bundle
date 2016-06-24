<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\OAuthBundle\Security\Core\Authentication\Token;

use HWI\Bundle\OAuthBundle\Security\Core\Authentication\Token\OAuthToken as Token;

/**
 * Description of OAuthToken
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class OAuthToken extends Token
{

    /**
     * Get the owner name.
     * @return string
     */
    public function getOwnerName()
    {
        return $this->getResourceOwnerName();
    }

    /**
     * Set the owner name.
     * @param string $ownerName
     */
    public function setOwnerName($ownerName)
    {
        return $this->setResourceOwnerName($ownerName);
    }

}

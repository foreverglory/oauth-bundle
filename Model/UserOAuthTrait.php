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
 * Description of UserOAuthTrait
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
trait UserOAuthTrait
{

    protected $oauths;

    public function addOAuth(OAuthInterface $oauth)
    {
        $this->oauths[$oauth->getOwner()] = $oauth;
        return $this;
    }

    public function getOAuths()
    {
        return $this->oauths;
    }

    public function hasOAuth($owner)
    {
        return array_key_exists($owner, $this->oauths);
    }

    public function removeOAuth($owner)
    {
        if ($this->hasOAuth($owner)) {
            unset($this->oauths[$owner]);
        }
        return $this;
    }

}

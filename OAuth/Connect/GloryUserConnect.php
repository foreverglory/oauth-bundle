<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\OAuthBundle\OAuth\Connect;

use Glory\Bundle\OAuthBundle\OAuth\Connect\FOSUserConnect;
use Glory\Bundle\OAuthBundle\Model\OAuthInterface;

/**
 * Description of GloryUserConnect
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class GloryUserConnect extends FOSUserConnect implements ConnectInterface
{

    protected function generateEmail(OAuthInterface $oauth)
    {
        return $oauth->getEmail();
    }

}

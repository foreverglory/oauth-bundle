<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\OAuthBundle\Twig\Extension;

use Glory\Bundle\OAuthBundle\OAuth\OwnerMap;

/**
 * Description of OwnerExtension
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class OwnerExtension extends \Twig_Extension
{

    /**
     *
     * @var OwnerMap 
     */
    protected $ownerMap;

    public function __construct(OwnerMap $ownerMap)
    {
        $this->ownerMap = $ownerMap;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('oauth_owners', array($this, 'getOwners'), array('is_safe' => 'html')),
        );
    }

    public function getOwners()
    {
        return $this->ownerMap->getOwners();
    }

    public function getName()
    {
        return 'glory_oauth.owner';
    }

}

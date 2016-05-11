<?php

/**
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 */

namespace Glory\Bundle\OAuthBundle\OAuth\Owner;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use HWI\Bundle\OAuthBundle\OAuth\ResourceOwnerInterface as OwnerInterface;

/**
 * Description of OwnerMap
 *
 * @author ForeverGlory
 */
class OwnerMap implements ContainerAwareInterface
{

    use ContainerAwareTrait;

    public function addOwner(OwnerInterface $owner)
    {
        
    }

    public function getOwner($type)
    {
        
    }

    public function getOwners()
    {
        
    }

}

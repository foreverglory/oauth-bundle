<?php

/*
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 */

namespace Glory\Bundle\OAuthBundle\Model;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Glory\Bundle\OAuthBundle\Model\OAuthInterface;

/**
 * Description of OAuthManager
 *
 * @author ForeverGlory
 */
class OAuthManager
{

    protected $container;
    protected $class;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    public function getClass()
    {
        $this->class;
    }

    public function createOAuth()
    {
        $class = $this->getClass();
        $oauth = new $class();
        return $oauth;
    }

    public function getOAuth($username, $owner)
    {
        
    }

    public function findOAuthBy($criteria)
    {
        
    }

    public function updateOAuth(OAuthInterface $oauth)
    {
        
    }

    public function deleteOAuth(OAuthInterface $oauth)
    {
        
    }

}

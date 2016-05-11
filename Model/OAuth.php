<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Glory\Bundle\OAuthBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of OAuth
 *
 * @author ForeverGlory
 */
class OAuth
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $owner;

    /**
     * @var string
     */
    private $username;

    /**
     * @var integer
     */
    private $nickname;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var integer
     * 
     */
    private $realname;

    /**
     * @var integer
     */
    private $email;

    /**
     * @var string
     */
    private $avatar;

    /**
     * @var string
     */
    private $accesstoken;

    /**
     * @var string
     */
    private $refreshtoken;

    /**
     * @var string
     */
    private $tokensecret;

    /**
     * @var string
     */
    private $expires;

    /**
     * @var string
     */
    private $created;

    /**
     * @var string
     */
    private $updated;

    /**
     * @var UserInterface
     */
    private $user;

    public function __construct()
    {
        
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $owner
     *
     * @return OAuth
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return OAuth
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     *
     * @return OAuth
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return OAuth
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return OAuth
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set realname
     *
     * @param string $realname
     *
     * @return OAuth
     */
    public function setRealname($realname)
    {
        $this->realname = $realname;

        return $this;
    }

    /**
     * Get realname
     *
     * @return string
     */
    public function getRealname()
    {
        return $this->realname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return OAuth
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return OAuth
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set accesstoken
     *
     * @param string $accesstoken
     *
     * @return OAuth
     */
    public function setAccesstoken($accesstoken)
    {
        $this->accesstoken = $accesstoken;

        return $this;
    }

    /**
     * Get accesstoken
     *
     * @return string
     */
    public function getAccesstoken()
    {
        return $this->accesstoken;
    }

    /**
     * Set refreshtoken
     *
     * @param string $refreshtoken
     *
     * @return OAuth
     */
    public function setRefreshtoken($refreshtoken)
    {
        $this->refreshtoken = $refreshtoken;

        return $this;
    }

    /**
     * Get refreshtoken
     *
     * @return string
     */
    public function getRefreshtoken()
    {
        return $this->refreshtoken;
    }

    /**
     * Set tokensecret
     *
     * @param string $tokensecret
     *
     * @return OAuth
     */
    public function setTokensecret($tokensecret)
    {
        $this->tokensecret = $tokensecret;

        return $this;
    }

    /**
     * Get tokensecret
     *
     * @return string
     */
    public function getTokensecret()
    {
        return $this->tokensecret;
    }

    /**
     * Set expires
     *
     * @param integer $expires
     *
     * @return OAuth
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set created
     *
     * @param integer $created
     *
     * @return OAuth
     */
    public function setCreated($created = null)
    {
        $this->created = $created? : time();

        return $this;
    }

    /**
     * Get created
     *
     * @return integer
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param integer $updated
     *
     * @return OAuth
     */
    public function setUpdated($updated = null)
    {
        $this->updated = $updated? : time();

        return $this;
    }

    /**
     * Get updated
     *
     * @return integer
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return OAuth
     */
    public function setUser(UserInterface $user = null)
    {
        $this->user = $user;
        return $this;
    }

}

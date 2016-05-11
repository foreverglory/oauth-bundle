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
    protected $id;

    /**
     * @var string
     */
    protected $owner;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var integer
     */
    protected $nickname;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var integer
     * 
     */
    protected $realname;

    /**
     * @var integer
     */
    protected $email;

    /**
     * @var string
     */
    protected $avatar;

    /**
     * @var string
     */
    protected $accesstoken;

    /**
     * @var string
     */
    protected $refreshtoken;

    /**
     * @var string
     */
    protected $tokensecret;

    /**
     * @var string
     */
    protected $expires;

    /**
     * @var string
     */
    protected $created;

    /**
     * @var string
     */
    protected $updated;

    /**
     * @var UserInterface
     */
    protected $user;

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

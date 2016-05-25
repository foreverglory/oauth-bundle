<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\OAuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Glory\Bundle\OAuthBundle\Model\OAuth as BaseOAuth;
use Symfony\Component\Security\Core\User\UserInterface as User;

/**
 * OAuth
 *
 * @ORM\MappedSuperclass
 * 
 * @author ForeverGlory <foreverglory@qq.com>
 */
class OAuth extends BaseOAuth
{

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="owner", type="string", length=32)
     */
    protected $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    protected $username;

    /**
     * @var integer
     *
     * @ORM\Column(name="nickname", type="string", length=255, nullable=true)
     */
    protected $nickname;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    protected $lastname;

    /**
     * @var integer
     * @ORM\Column(name="realname", type="string", length=255, nullable=true)
     * 
     */
    protected $realname;

    /**
     * @var integer
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=255, nullable=true)
     */
    protected $avatar;

    /**
     * @var string
     *
     * @ORM\Column(name="access_token", type="string", length=255)
     */
    protected $accesstoken;

    /**
     * @var string
     *
     * @ORM\Column(name="refresh_token", type="string", length=255, nullable=true)
     */
    protected $refreshtoken;

    /**
     * @var string
     *
     * @ORM\Column(name="token_secret", type="string", length=255, nullable=true)
     */
    protected $tokensecret;

    /**
     * @var string
     *
     * @ORM\Column(name="expires", type="integer", nullable=true)
     */
    protected $expires;

    /**
     * @var string
     *
     * @ORM\Column(name="created", type="integer", nullable=true)
     */
    protected $created;

    /**
     * @var string
     *
     * @ORM\Column(name="updated", type="integer", nullable=true)
     */
    protected $updated;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="oauths")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

}

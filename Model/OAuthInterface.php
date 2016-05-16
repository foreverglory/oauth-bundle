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

use Symfony\Component\Security\Core\User\UserInterface;

/**
 *
 * OAuthInterface
 * 
 * @author ForeverGlory <foreverglory@qq.com>
 */
interface OAuthInterface
{

    public function getId();

    public function setOwner($owner);

    public function getOwner();

    public function setUsername($username);

    public function getUsername();

    public function setNickname($nickname);

    public function getNickname();

    public function setFirstname($firstname);

    public function getFirstname();

    public function setLastname($lastname);

    public function getLastname();

    public function setRealname($realname);

    public function getRealname();

    public function setEmail($email);

    public function getEmail();

    public function setAvatar($avatar);

    public function getAvatar();

    public function setAccesstoken($accesstoken);

    public function getAccesstoken();

    public function setRefreshtoken($refreshtoken);

    public function getRefreshtoken();

    public function setTokensecret($tokensecret);

    public function getTokensecret();

    public function setExpires($expires);

    public function getExpires();

    public function setCreated($created);

    public function getCreated();

    public function setUpdated($updated);

    public function getUpdated();

    public function getUser();

    public function setUser(UserInterface $user);
}

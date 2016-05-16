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

use Symfony\Component\DependencyInjection\ContainerInterface;
use Glory\Bundle\OAuthBundle\Model\OAuthInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Glory\Bundle\OAuthBundle\Model\UserOAuthInterface;

/**
 * Description of OAuthManager
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class OAuthManager
{

    protected $container;
    protected $oauthClass;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function setOAuthClass($class)
    {
        if (!$class instanceof OAuthInterface) {
            throw new \Exception(sprintf('oauth class must implements %s', get_class(OAuthInterface)));
        }
        $this->oauthClass = $class;
        return $this;
    }

    /**
     * 获取 OAuth class
     * 
     * class implements OAuthInterface
     */
    public function getOAuthClass()
    {
        $this->oauthClass;
    }

    /**
     * 创建 OAuth
     * 
     * @return OAuthInterface
     */
    public function createOAuth()
    {
        $class = $this->getOAuthClass();
        $oauth = new $class();
        return $oauth;
    }

    /**
     * 获取 OAuth
     * 
     * @param type $username
     * @param type $owner
     * @return OAuthInterface
     */
    public function getOAuth($username, $owner)
    {
        $criteria = [
            'username' => $username,
            'owner' => $owner
        ];
        return $this->findOAuthBy($criteria);
    }

    /**
     * 查找 OAuth 通过条件
     * 
     * @param type $criteria
     * @return OAuthInterface
     */
    public function findOAuthBy($criteria)
    {
        $repository = $this->getDoctrine()->getRepository($this->getOAuthClass());
        return $repository->findOneBy($criteria);
    }

    /**
     * 查找 OAuths
     * 
     * @param array $criteria
     * @param array $orderBy
     * @param type $limit
     * @param type $offset
     * @return array|null
     */
    public function findOAuths(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $repository = $this->getDoctrine()->getRepository($this->getOAuthClass());
        return $repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * 更新 OAuth
     * 
     * @param OAuthInterface $oauth
     * @param type $andFlush
     */
    public function updateOAuth(OAuthInterface $oauth, $andFlush = true)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($oauth);
        if ($andFlush) {
            $em->flush();
        }
    }

    /**
     * 删除 OAuth
     * 
     * @param OAuthInterface $oauth
     */
    public function deleteOAuth(OAuthInterface $oauth)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($oauth);
        $em->flush();
    }

    /**
     * 关联到用户
     * 
     * @param OAuthInterface $oauth
     * @param UserInterface $user
     * @throws \LogicException
     */
    public function connectUser(OAuthInterface $oauth, UserOAuthInterface $user)
    {
        $user->addOAuth($oauth);
        $this->updateUser($user);
        $oauth->setUser($user);
        $this->updateOAuth($oauth);
    }

    /**
     * 更新用户
     * @param UserOAuthInterface $user
     */
    public function updateUser(UserOAuthInterface $user)
    {
        $connect = $this->container->get('glory_oauth.connect');
        $connect->updateUser($user);
    }

    /**
     * Shortcut to return the Doctrine Registry service.
     *
     * @return Registry
     *
     * @throws \LogicException If DoctrineBundle is not available
     */
    protected function getDoctrine()
    {
        if (!$this->container->has('doctrine')) {
            throw new \LogicException('The DoctrineBundle is not registered in your application.');
        }

        return $this->container->get('doctrine');
    }

}

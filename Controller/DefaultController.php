<?php

namespace Glory\Bundle\OAuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GloryOAuthBundle:Default:index.html.twig');
    }
}

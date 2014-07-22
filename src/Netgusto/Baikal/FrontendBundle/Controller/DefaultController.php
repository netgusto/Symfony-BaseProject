<?php

namespace Netgusto\Baikal\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NetgustoBaikalFrontendBundle:Default:index.html.twig');
    }
}

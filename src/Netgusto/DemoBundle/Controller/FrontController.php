<?php

namespace Netgusto\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController extends Controller
{
    public function indexAction()
    {
        return $this->render('NetgustoDemoBundle:Front:index.html.twig');
    }
}

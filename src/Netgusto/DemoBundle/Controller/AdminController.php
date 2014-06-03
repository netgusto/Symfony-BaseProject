<?php

namespace Netgusto\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('NetgustoDemoBundle:Admin:index.html.twig');
    }
}

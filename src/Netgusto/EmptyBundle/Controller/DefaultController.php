<?php

namespace Netgusto\EmptyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NetgustoEmptyBundle:Default:index.html.twig');
    }
}

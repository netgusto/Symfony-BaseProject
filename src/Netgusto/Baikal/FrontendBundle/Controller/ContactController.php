<?php

namespace Netgusto\Baikal\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function listAction()
    {
        return $this->render('NetgustoBaikalFrontendBundle:Contact:list.html.twig');
    }
}

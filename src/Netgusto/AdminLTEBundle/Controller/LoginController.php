<?php

namespace Netgusto\AdminLTEBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller {
    
    public function indexAction() {
        return $this->render('NetgustoAdminLTEBundle:Login:index.html.twig');
    }
}

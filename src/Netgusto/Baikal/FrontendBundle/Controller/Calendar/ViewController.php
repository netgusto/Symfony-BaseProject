<?php

namespace Netgusto\Baikal\FrontendBundle\Controller\Calendar;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Netgusto\Baikal\DavServicesBundle\Entity\User;
use Netgusto\Baikal\DavServicesBundle\Entity\Calendar;

class ViewController extends Controller {

    public function indexAction(Request $request, Calendar $calendar) {

        $user = $this->get('security.context')->getToken()->getUser();
        return $this->render('NetgustoBaikalFrontendBundle:Calendar/View:index.html.twig', array(
            'user' => $user,
            'calendar' => $calendar,
        ));
    }
}

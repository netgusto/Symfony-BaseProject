<?php

namespace Netgusto\Baikal\AdminBundle\Controller\Calendar;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Netgusto\Baikal\DavServicesBundle\Entity\User;
use Netgusto\Baikal\DavServicesBundle\Entity\Calendar;

class ViewController extends Controller {

    public function indexAction(Request $request, User $user, Calendar $calendar) {

        return $this->render('NetgustoBaikalAdminBundle:Calendar/View:index.html.twig', array(
            'user' => $user,
            'calendar' => $calendar,
        ));
    }
}

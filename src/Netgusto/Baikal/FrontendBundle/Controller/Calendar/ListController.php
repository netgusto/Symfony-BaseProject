<?php

namespace Netgusto\Baikal\FrontendBundle\Controller\Calendar;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Netgusto\Baikal\DavServicesBundle\Entity\User;
use Netgusto\Baikal\DavServicesBundle\Entity\Calendar;

class ListController extends Controller {
    
    public function indexAction() {
        
        $user = $this->get('security.context')->getToken()->getUser();
        $calendars = $this->getDoctrine()->getManager()->getRepository('\Netgusto\Baikal\DavServicesBundle\Entity\Calendar')->findByUser($user);
        
        return $this->render('NetgustoBaikalFrontendBundle:Calendar:List/index.html.twig', array(
            'user' => $user,
            'calendars' => $calendars,
        ));
    }

    public function deleteAction(Calendar $calendar) {

        $em = $this->getDoctrine()->getManager();
        $em->remove($calendar);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('notice', 'Calendar <i class="fa fa-calendar"></i> <strong>' . htmlspecialchars($calendar->getDisplayname()) . '</strong> has been deleted.');
        return $this->redirect($this->generateUrl('netgusto_baikal_frontend_calendar_list'));
    }
}

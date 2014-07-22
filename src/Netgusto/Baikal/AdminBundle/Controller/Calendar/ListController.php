<?php

namespace Netgusto\Baikal\AdminBundle\Controller\Calendar;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Netgusto\Baikal\DavServicesBundle\Entity\User;
use Netgusto\Baikal\DavServicesBundle\Entity\Calendar;

class ListController extends Controller {

    public function indexAction(User $user) {
        
        $calendars = $this->getDoctrine()->getManager()->getRepository('\Netgusto\Baikal\DavServicesBundle\Entity\Calendar')->findByUser($user);
        
        return $this->render('NetgustoBaikalAdminBundle:Calendar/List:index.html.twig', array(
            'user' => $user,
            'calendars' => $calendars,
        ));
    }

    public function deleteAction(User $user, Calendar $calendar) {

        $em = $this->getDoctrine()->getManager();
        $em->remove($calendar);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('notice', 'Calendar <i class="fa fa-calendar"></i> <strong>' . htmlspecialchars($calendar->getDisplayname()) . '</strong> has been deleted.');
        return $this->redirect($this->generateUrl('netgusto_baikal_admin_user_calendar_list', array('id' => $user->getId())));
    }
}

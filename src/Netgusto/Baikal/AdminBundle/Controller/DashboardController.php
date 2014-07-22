<?php

namespace Netgusto\Baikal\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $nbusers = $this->getDoctrine()->getManager()->getRepository('\Netgusto\Baikal\DavServicesBundle\Entity\User')->countAll();

        $nbcalendars = $this->getDoctrine()->getManager()->getRepository('\Netgusto\Baikal\DavServicesBundle\Entity\Calendar')->countAll();
        $nbevents = $this->getDoctrine()->getManager()->getRepository('\Netgusto\Baikal\DavServicesBundle\Entity\CalendarEvent')->countAll();

        $nbaddressbooks = $this->getDoctrine()->getManager()->getRepository('\Netgusto\Baikal\DavServicesBundle\Entity\Addressbook')->countAll();
        $nbaddressbookcontacts = $this->getDoctrine()->getManager()->getRepository('\Netgusto\Baikal\DavServicesBundle\Entity\AddressbookContact')->countAll();

        return $this->render('NetgustoBaikalAdminBundle:Dashboard:index.html.twig', array(
            'nbusers' => $nbusers,
            'nbcalendars' => $nbcalendars,
            'nbevents' => $nbevents,
            'nbaddressbooks' => $nbaddressbooks,
            'nbaddressbookcontacts' => $nbaddressbookcontacts,
        ));
    }
}

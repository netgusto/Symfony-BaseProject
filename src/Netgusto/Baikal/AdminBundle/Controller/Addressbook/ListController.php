<?php

namespace Netgusto\Baikal\AdminBundle\Controller\Addressbook;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Netgusto\Baikal\DavServicesBundle\Entity;

class ListController extends Controller {

    public function indexAction(Entity\User $user) {
        
        $addressbooks = $this->getDoctrine()->getManager()->getRepository('\Netgusto\Baikal\DavServicesBundle\Entity\Addressbook')->findByUser($user);
        
        return $this->render('NetgustoBaikalAdminBundle:Addressbook/List:index.html.twig', array(
            'user' => $user,
            'addressbooks' => $addressbooks,
        ));
    }

    public function deleteAction(Entity\User $user, Entity\Addressbook $addressbook) {

        $em = $this->getDoctrine()->getManager();
        $em->remove($addressbook);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('notice', 'Addressbook <i class="fa fa-book"></i> <strong>' . htmlspecialchars($addressbook->getDisplayname()) . '</strong> has been deleted.');
        return $this->redirect($this->generateUrl('netgusto_baikal_admin_user_addressbook_list', array('id' => $user->getId())));
    }
}

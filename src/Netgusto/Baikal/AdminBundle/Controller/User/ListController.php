<?php

namespace Netgusto\Baikal\AdminBundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Netgusto\Baikal\DavServicesBundle\Entity\User;

class ListController extends Controller
{
    public function indexAction()
    {
        $users = $this->getDoctrine()->getManager()->getRepository('NetgustoBaikalDavServicesBundle:User')->findAll();
        
        return $this->render('NetgustoBaikalAdminBundle:User/List:index.html.twig', array(
            'users' => $users,
        ));
    }

    public function deleteAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('notice', 'User <i class="fa fa-user"></i> <strong>' . htmlspecialchars($user->getUsername()) . '</strong> has been deleted.');
        return $this->redirect($this->generateUrl('netgusto_baikal_admin_user_list'));
    }
}

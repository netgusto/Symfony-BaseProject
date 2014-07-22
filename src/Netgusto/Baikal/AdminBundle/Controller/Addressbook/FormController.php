<?php

namespace Netgusto\Baikal\AdminBundle\Controller\Addressbook;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

use Sabre\DAV\UUIDUtil;

use Netgusto\Baikal\DavServicesBundle\Entity\User;
use Netgusto\Baikal\DavServicesBundle\Entity\Addressbook;

class FormController extends Controller
{

    public function newAction(Request $request, User $user) {
        $formBuilder = $this->getFormBase();
        $form = $formBuilder->setData(array())->getForm();
        $form->handleRequest($request);

        if($form->isValid()) {

            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();

            # Persisting calendar
            $addressbook = new Addressbook();
            $addressbook->setPrincipaluri($user->getIdentityPrincipal()->getUri());
            $addressbook->setSynctoken('1');
            $addressbook->setUri(UUIDUtil::getUUID());

            $addressbook->setDisplayname($data['displayname']);
            $addressbook->setDescription($data['description']);

            $em->persist($addressbook);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'Addressbook <i class="fa fa-book"></i> <strong>' . htmlspecialchars($addressbook->getDisplayname()) . '</strong> has been created.');
            return $this->redirect($this->generateUrl('netgusto_baikal_admin_user_addressbook_list', array('id' => $user->getId())));
        }

        return $this->render('NetgustoBaikalAdminBundle:Addressbook/Form:new+edit.html.twig', array(
            'form' => $form->createView(),
            'user' => $user
        ));
    }

    public function editAction(Request $request, User $user, Addressbook $addressbook) {
        
        $formBuilder = $this->getFormBase();

        $form = $formBuilder->setData(array(
            'displayname' => $addressbook->getDisplayname(),
            'description' => $addressbook->getDescription(),
        ))->getForm();
        $form->handleRequest($request);

        if($form->isValid()) {

            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();

            # Persisting calendar
            $addressbook->setDisplayname($data['displayname']);
            $addressbook->setDescription($data['description']);

            $em->persist($addressbook);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'Addressbook <i class="fa fa-book"></i> <strong>' . htmlspecialchars($addressbook->getDisplayname()) . '</strong> has been updated.');
            return $this->redirect($this->generateUrl('netgusto_baikal_admin_user_addressbook_list', array('id' => $user->getId())));
        }

        return $this->render('NetgustoBaikalAdminBundle:Addressbook/Form:new+edit.html.twig', array(
            'form' => $form->createView(),
            'user' => $user,
            'addressbook' => $addressbook
        ));
    }

    protected function getFormBase() {
        return $this->createFormBuilder()
            ->add('displayname', 'text', array(
                "label" => "Display name",
                'constraints' => array(
                    new NotBlank(),
                )
            ))
            ->add('description', 'text', array(
                "label" => "Description",
                'constraints' => array(
                    new NotBlank(),
                )
            ));
    }
}

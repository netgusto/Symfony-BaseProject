<?php

namespace Netgusto\Baikal\AdminBundle\Controller\Addressbook;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Netgusto\Baikal\DavServicesBundle\Entity\User;
use Netgusto\Baikal\DavServicesBundle\Entity\Addressbook;

class ViewController extends Controller {

    public function indexAction(Request $request, User $user, Addressbook $addressbook) {

        $contacts = $this->getDoctrine()->getManager()->getRepository('\Netgusto\Baikal\DavServicesBundle\Entity\AddressbookContact')->findByAddressbook($addressbook);
        foreach($contacts as $contact) {
            echo '<h2>Nom:' . (string)$contact->getVObject()->FN . '</h2>';
            echo '<p>Email:' . (string)$contact->getVObject()->EMAIL . '</p>';
            echo '<p>Tél:' . (string)$contact->getVObject()->TEL . '</p>';
            if($contact->getVObject()->ADR) {
                echo '<p>Adresse:' . print_r($contact->getVObject()->ADR->getParts(), TRUE) . '</p>';
            }

            #echo '<pre>Photo: ' . print_r($contact->getVObject()->PHOTO, TRUE) . '</pre>';
            if(!is_null($contact->getVObject()->PHOTO)) {
                $clipRect = $contact->getVObject()->PHOTO['X-ABCROP-RECTANGLE'];
                $encoding = $contact->getVObject()->PHOTO['ENCODING'];
                $type = $contact->getVObject()->PHOTO['TYPE'];
                $img = (string)$contact->getVObject()->PHOTO;
                echo '<p><img src="data:image/png;base64,' . base64_encode($img) . '" /></p>';
            }
        }

        return new Response('Hello, World !');
        /*return $this->render('NetgustoBaikalAdminBundle:Addressbook/View:index.html.twig', array(
            'user' => $user,
            'addressbook' => $addressbook,
        ));*/
    }
}

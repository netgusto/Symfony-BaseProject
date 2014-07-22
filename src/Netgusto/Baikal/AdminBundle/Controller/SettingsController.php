<?php

namespace Netgusto\Baikal\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Validator\Constraints\NotBlank;

use Netgusto\Baikal\AdminBundle\Entity\Settings;
use Netgusto\Baikal\DavServicesBundle\NetgustoBaikalDavServicesBundle;

class SettingsController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        # Determine if there's a settings record
        $allsettings = $em->getRepository('\Netgusto\Baikal\AdminBundle\Entity\Settings')->findAll();
        
        if(count($allsettings) === 0) {
            # no settings; we have to create it

            $settings = new Settings();
            $settings->setConfiguredversion($this->container->getParameter('app_version'));
            $settings->setServertimezone('Europe/Paris');
            $settings->setEnabledServices(array(
                'CALDAV',
                'CARDDAV'
            ));

            $em->persist($settings);
            $em->flush();
        } else {
            $settings = $allsettings[0];
        }

        # Displaying the edition form
        $formBuilder = $this->getFormBase();

        $form = $formBuilder->setData(array(
            'servertimezone' => $settings->getServertimezone(),
            'enabledservices' => $settings->getEnabledservices(),
        ))->getForm();
        $form->handleRequest($request);

        if($form->isValid()) {

            $data = $form->getData();

            # Persisting settings
            $settings->setServertimezone($data['servertimezone']);
            $settings->setEnabledServices($data['enabledservices']);

            $em->persist($settings);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', '<i class="fa fa-cogs"></i> Settings have been updated.');
            return $this->redirect($this->generateUrl('netgusto_baikal_admin_settings'));
        }

        return $this->render('NetgustoBaikalAdminBundle:Settings:index.html.twig', array(
            'form' => $form->createView(),
            'settings' => $settings
        ));

        # Netgusto\Baikal\DavServicesBundle\NetgustoBaikalDavServicesBundle::timezones()
    }

    protected function getFormBase() {

        return $this->createFormBuilder()
            ->add('servertimezone', 'choice', array(
                'label' => 'Server time zone',
                'multiple' => FALSE,
                'expanded' => FALSE,
                'choices' => NetgustoBaikalDavServicesBundle::timezones(),
                'constraints' => array(
                    new NotBlank(),
                )
            ))
            ->add('enabledservices', 'choice', array(
                'label' => 'Enabled services',
                'multiple' => TRUE,
                'expanded' => TRUE,
                'choices' => array(
                    'CALDAV' => "CalDAV - Calendar service",
                    'CARDDAV' => "CardDAV - Addressbook service"
                ),
                'constraints' => array(
                    new NotBlank(),
                )
            ));
    }
}
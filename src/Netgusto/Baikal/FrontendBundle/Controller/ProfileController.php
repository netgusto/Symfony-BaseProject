<?php

namespace Netgusto\Baikal\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
	Symfony\Component\HttpFoundation\Request,
	Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

class ProfileController extends Controller {
    
    public function indexAction(Request $request) {

    	$user = $this->get('security.context')->getToken()->getUser();
        $principalidentity = $user->getIdentityPrincipal();

        $data = array(
            'displayname' => $principalidentity->getDisplayname(),
            'email' => $principalidentity->getEmail(),
            'roles' => $user->getRoles(),
        );

        $form = $this->getFormBase()->setData($data)->getForm();
        $form->handleRequest($request);

        if($form->isValid()) {
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();

            # Persisting identity principal
            $principalidentity->setDisplayname($data['displayname']);
            $principalidentity->setEmail($data['email']);

            $em->persist($principalidentity);

            # Persisting user if password changed
            if(!is_null($data['password'])) {
                $password = $data['password'];

                $user->setPassword(
                    $this->get('security.encoder_factory')
                        ->getEncoder($user)
                        ->encodePassword(
                            $password,
                            $user->getSalt()
                        )
                );
            }

             # Persisting user roles
            $user->setRoles($data['roles']);

            $em->persist($user);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'User <i class="fa fa-user"></i> <strong>' . htmlspecialchars($user->getUsername()) . '</strong> has been updated.');
            return $this->redirect($this->generateUrl('netgusto_baikal_admin_user_list'));
        }

        return $this->render('NetgustoBaikalFrontendBundle:Profile:index.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    protected function getFormBase($requiredpassword = FALSE) {

        if($requiredpassword === TRUE) {
            $passconstraints = array(new NotBlank());
        } else {
            $passconstraints = array();
        }

        return $this->createFormBuilder()
            ->add('displayname', 'text', array(
                "label" => "Display name",
                'constraints' => array(
                    new NotBlank(),
                )
            ))
            ->add('email', 'email', array(
                "label" => "Email",
                'constraints' => array(
                    new NotBlank(),
                    new Email()
                )
            ))
            ->add('roles', 'choice', array(
                'multiple' => TRUE,
                'expanded' => TRUE,
                'choices' => array(
                    'ROLE_FRONTEND_USER' => "Frontend User",
                    'ROLE_ADMIN' => "Administrator"
                ),
                'constraints' => array(
                    new NotBlank(),
                )
            ))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Passwords do not match.',
                'options' => array('required' => $requiredpassword),
                'constraints' => $passconstraints,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Password (confirmation)'),
            ));
    }
}

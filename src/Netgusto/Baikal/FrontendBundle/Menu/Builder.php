<?php

namespace Netgusto\Baikal\FrontendBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware {

    public function userMenu(FactoryInterface $factory, array $options) {

        $securityContext = $this->container->get('security.context');
        $user = $securityContext->getToken()->getUser();
        
        $menu = $factory->createItem('root', array('childrenAttributes' => array('class' => 'nav navbar-nav')));

        if($securityContext->isGranted('ROLE_FRONTEND_USER')) {
            $menu->addChild('Calendars', array('route' => 'netgusto_baikal_frontend_calendar_list'));
            $menu->addChild('Contacts', array('route' => 'netgusto_baikal_frontend_contact_list'));
            $menu->addChild('My profile', array('route' => 'netgusto_baikal_frontend_profile'));
        }

        if($securityContext->isGranted('ROLE_STATIC_ADMIN') || $securityContext->isGranted('ROLE_ADMIN')) {
            $menu->addChild('Web admin', array('route' => 'netgusto_baikal_admin_homepage'));
        }

        return $menu;
    }
}
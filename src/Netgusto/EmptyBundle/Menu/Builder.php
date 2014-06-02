<?php

namespace Netgusto\EmptyBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware {

    public function demoMenu(FactoryInterface $factory, array $options) {
        
        $menu = $factory->createItem('root', $options);
        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('Users+Data', array('route' => 'netgusto_empty_homepage'))
            ->setAttribute('icon', 'plane');
        $menu->addChild('Settings', array('uri' => '#'))
            ->setAttribute('icon', 'car');

        $menu['Settings']->addChild('Subpage', array('route' => 'netgusto_empty_subpage'))
            ->setAttribute('icon', 'rocket');

        return $menu;
    }
}
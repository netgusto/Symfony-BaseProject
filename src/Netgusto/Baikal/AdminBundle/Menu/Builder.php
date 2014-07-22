<?php

namespace Netgusto\Baikal\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware {

    public function leftMenu(FactoryInterface $factory, array $options) {

        $menu = $factory->createItem('root', $options);

        $menu->addChild('Users', array('route' => 'netgusto_baikal_admin_user_list'))
            ->setAttribute('icon', 'group');

        $menu->addChild('Settings', array('route' => 'netgusto_baikal_admin_settings'))
            ->setAttribute('icon', 'cogs');

        return $menu;
    }
}
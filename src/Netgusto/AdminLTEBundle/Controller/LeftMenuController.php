<?php

namespace Netgusto\AdminLTEBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Netgusto\AdminLTEBundle\Struct;

class LeftMenuController extends Controller {
    
    public function indexAction() {

        $menuitems = array();

        $dashboard = new Struct\MenuItem();
        $dashboard->setTitle('Dashboard');
        $dashboard->setCurrent(TRUE);
        $dashboard->setIcon('dashboard');
        $menuitems[] = $dashboard;

        $widgets = new Struct\MenuItem();
        $widgets->setTitle('Widgets');
        $widgets->setIcon('car');
        $menuitems[] = $widgets;

        return $this->render('NetgustoAdminLTEBundle:LeftMenu:index.html.twig', array('menuitems' => $menuitems));
    }

    public function _menuItemAction(Struct\MenuItem $menuitem) {
        return $this->render('NetgustoAdminLTEBundle:LeftMenu:_menuitem.html.twig', array('menuitem' => $menuitem));
    }
}

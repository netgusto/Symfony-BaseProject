<?php

namespace Netgusto\Baikal\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\RedirectResponse;

class DavReroutingController extends Controller {

    public function propfindAction(Request $request) {
        if(preg_match('%caldav%smix', $request->getContent())) {
            return new RedirectResponse($this->generateUrl("netgusto_baikal_dav_services_caldav"), 301); # 302
        }
        
        if(preg_match('%carddav%smix', $request->getContent())) {
            return new RedirectResponse($this->generateUrl("netgusto_baikal_dav_services_carddav"), 301); # 302
        }
        
        return new RedirectResponse($this->generateUrl("netgusto_baikal_frontend_homepage"), 301); # 302
    }
}

<?php

namespace Netgusto\Baikal\DavServicesBundle\Entity;

use Doctrine\Common\EventArgs;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class UserListener {

    public function postLoad(User $user, LifecycleEventArgs $event) {
        # Loading the principals/calendars/addressbooks for a user in the User postLoad doctrine event
        # As doctrine can't handle relationships natively on non-primarykey values

        $em = $event->getObjectManager();

        $user->setPrincipals(
            $em->getRepository('\Netgusto\Baikal\DavServicesBundle\Entity\UserPrincipal')->findByUser($user)
        );
        
        $user->setCalendars(
            $em->getRepository('\Netgusto\Baikal\DavServicesBundle\Entity\Calendar')->findByUser($user)
        );
        
        $user->setAddressbooks(
            $em->getRepository('\Netgusto\Baikal\DavServicesBundle\Entity\Addressbook')->findByUser($user)
        );
    }

    public function preRemove(User $user, LifecycleEventArgs $event) {

        # Removing the metadata/principals/calendars/addressbooks for a user in the User preRemove doctrine event
        # As doctrine can't handle relationships natively on non-primarykey values

        $em = $event->getObjectManager();

        foreach($user->getPrincipals() as $principal) {
            $em->remove($principal);
        }

        foreach($user->getCalendars() as $calendar) {
            $em->remove($calendar);
        }

        foreach($user->getAddressbooks() as $addressbook) {
            $em->remove($addressbook);
        }

        $em->flush();
    }
}
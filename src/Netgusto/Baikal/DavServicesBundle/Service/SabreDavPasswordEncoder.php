<?php

namespace Netgusto\Baikal\DavServicesBundle\Service;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class SabreDavPasswordEncoder implements PasswordEncoderInterface {

    public function encodePassword($raw, $salt) {
        return md5($salt . ':BaikalDAV:' . $raw);	# $salt contains the username
    }

    public function isPasswordValid($encoded, $raw, $salt) {
        return $encoded === $this->encodePassword($raw, $salt);
    }
}
<?php

namespace Netgusto\Baikal\DavServicesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserPrincipal
 *
 * @ORM\Table(name="principals")
 * @ORM\Entity(repositoryClass="Netgusto\Baikal\DavServicesBundle\Entity\UserPrincipalRepository")
 */
class UserPrincipal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="uri", type="string", length=255, nullable=true)
     */
    private $uri;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="displayname", type="string", length=255, nullable=true)
     */
    private $displayname;

    /**
     * @var string
     *
     * @ORM\Column(name="vcardurl", type="string", length=255, nullable=true)
     */
    private $vcardurl;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set uri
     *
     * @param string $uri
     * @return UserPrincipal
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Get uri
     *
     * @return string 
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return UserPrincipal
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set displayname
     *
     * @param string $displayname
     * @return UserPrincipal
     */
    public function setDisplayname($displayname)
    {
        $this->displayname = $displayname;

        return $this;
    }

    /**
     * Get displayname
     *
     * @return string 
     */
    public function getDisplayname()
    {
        return $this->displayname;
    }

    /**
     * Set vcardurl
     *
     * @param string $vcardurl
     * @return UserPrincipal
     */
    public function setVcardurl($vcardurl)
    {
        $this->vcardurl = $vcardurl;

        return $this;
    }

    /**
     * Get vcardurl
     *
     * @return string 
     */
    public function getVcardurl()
    {
        return $this->vcardurl;
    }
}

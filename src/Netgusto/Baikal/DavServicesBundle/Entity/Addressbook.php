<?php

namespace Netgusto\Baikal\DavServicesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Addressbook
 *
 * @ORM\Table(name="addressbooks")
 * @ORM\Entity(repositoryClass="Netgusto\Baikal\DavServicesBundle\Entity\AddressbookRepository")
 */
class Addressbook
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
     * @ORM\Column(name="principaluri", type="string", length=255, nullable=true)
     */
    private $principaluri;

    /**
     * @var string
     *
     * @ORM\Column(name="displayname", type="string", length=255, nullable=true)
     */
    private $displayname;

    /**
     * @var string
     *
     * @ORM\Column(name="uri", type="string", length=255, nullable=true)
     */
    private $uri;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="synctoken", type="integer", nullable=true)
     */
    private $synctoken;

    /**
     * @ORM\OneToMany(targetEntity="AddressbookContact", mappedBy="addressbook", cascade={"remove"})
     */
    private $contacts;

    /**
     * @ORM\OneToMany(targetEntity="AddressbookChange", mappedBy="addressbook", cascade={"remove"})
     */
    private $changes;

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
     * Set principaluri
     *
     * @param string $principaluri
     * @return Addressbook
     */
    public function setPrincipaluri($principaluri)
    {
        $this->principaluri = $principaluri;

        return $this;
    }

    /**
     * Get principaluri
     *
     * @return string 
     */
    public function getPrincipaluri()
    {
        return $this->principaluri;
    }

    /**
     * Set displayname
     *
     * @param string $displayname
     * @return Addressbook
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
     * Set uri
     *
     * @param string $uri
     * @return Addressbook
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
     * Set description
     *
     * @param string $description
     * @return Addressbook
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set synctoken
     *
     * @param integer $synctoken
     * @return Addressbook
     */
    public function setSynctoken($synctoken)
    {
        $this->synctoken = $synctoken;

        return $this;
    }

    /**
     * Get synctoken
     *
     * @return integer 
     */
    public function getSynctoken()
    {
        return $this->synctoken;
    }

    /**
     * Get contacts
     *
     * @return string 
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Get changes
     *
     * @return string 
     */
    public function getChanges()
    {
        return $this->changes;
    }
}

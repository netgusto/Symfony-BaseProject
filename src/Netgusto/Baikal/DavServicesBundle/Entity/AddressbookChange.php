<?php

namespace Netgusto\Baikal\DavServicesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AddressbookChange
 *
 * @ORM\Table(name="addressbookchanges")
 * @ORM\Entity()
 */
class AddressbookChange
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
     * @var integer
     *
     * @ORM\Column(name="synctoken", type="integer", nullable=true)
     */
    private $synctoken;

    /**
     * @var Addressbook
     *
     * @ORM\ManyToOne(targetEntity="Addressbook", inversedBy="changes")
     * @ORM\JoinColumn(name="addressbookid", referencedColumnName="id")
     */
    private $addressbook;

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
     * Get addressbook
     *
     * @return Addressbook
     */
    public function getAddressbook()
    {
        return $this->addressbook;
    }

    /**
     * Set addressbook
     *
     * @return AddressbookChange
     */
    public function setAddressbook(Addressbook $addressbook)
    {
        $this->addressbook = $addressbook;
        return $this;
    }
}

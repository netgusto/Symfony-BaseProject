<?php

namespace Netgusto\Baikal\DavServicesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Sabre\VObject;

/**
 * AddressbookContact
 *
 * @ORM\Table(name="cards")
 * @ORM\Entity(repositoryClass="Netgusto\Baikal\DavServicesBundle\Entity\AddressbookContactRepository")
 */
class AddressbookContact
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
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Addressbook", inversedBy="contacts")
     * @ORM\JoinColumn(name="addressbookid", referencedColumnName="id")
     */
    private $addressbook;

    /**
     * @var string
     *
     * @ORM\Column(name="carddata", type="text", nullable=true)
     */
    private $carddata;

    /**
     * @var string
     *
     * @ORM\Column(name="uri", type="string", length=255, nullable=true)
     */
    private $uri;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastmodified", type="integer", nullable=true)
     */
    private $lastmodified;

    private $vobject;


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
     * Set addressbook
     *
     * @param Addressbook $addressbook
     * @return AddressbookContact
     */
    public function setAddressbook(Addressbook $addressbook)
    {
        $this->addressbook = $addressbook;

        return $this;
    }

    /**
     * Get addressbook
     *
     * @return integer 
     */
    public function getAddressbook()
    {
        return $this->addressbook;
    }

    /**
     * Set carddata
     *
     * @param string $carddata
     * @return AddressbookContact
     */
    public function setCarddata($carddata)
    {
        $this->carddata = $carddata;

        return $this;
    }

    /**
     * Get carddata
     *
     * @return string 
     */
    public function getCarddata()
    {
        return $this->carddata;
    }

    /**
     * Set uri
     *
     * @param string $uri
     * @return AddressbookContact
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
     * Set lastmodified
     *
     * @param integer $lastmodified
     * @return AddressbookContact
     */
    public function setLastmodified($lastmodified)
    {
        $this->lastmodified = $lastmodified;

        return $this;
    }

    /**
     * Get lastmodified
     *
     * @return integer 
     */
    public function getLastmodified()
    {
        return $this->lastmodified;
    }

    # Dav wrapper methods below this line

    public function getVObject() {
        if(is_null($this->vobject)) {
            $this->vobject = VObject\Reader::read($this->getCarddata());
        }

        return $this->vobject;
    }


}

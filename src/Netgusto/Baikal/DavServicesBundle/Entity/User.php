<?php

namespace Netgusto\Baikal\DavServicesBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection,
    Symfony\Component\Security\Core\User\UserInterface,
    Symfony\Component\Validator\Constraints as Assert,
    Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;

/**
 * User
 *
 * @ORM\Entity @ORM\EntityListeners({"Netgusto\Baikal\DavServicesBundle\Entity\UserListener"})
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Netgusto\Baikal\DavServicesBundle\Entity\UserRepository")
 * @ORMAssert\UniqueEntity(fields={"username"}, message="This username is not available.")
 */
class User implements UserInterface, \Serializable {
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
     * @ORM\Column(name="username", type="string", unique=true, length=32)
     * @Assert\NotBlank(message="Username is required.")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="digesta1", type="string", length=200)
     * @Assert\NotBlank(message="Password is required.")
     */
    private $digesta1;

    # Loaded during Doctrine's postLoad event using the EntityListener UserListener
    private $principals;

    # Loaded during Doctrine's postLoad event using the EntityListener UserListener
    private $calendars;

    # Loaded during Doctrine's postLoad event using the EntityListener UserListener
    private $addressbooks;

    /**
     * @var Entity\UserMetadata
     *
     * # This is the inversed side of the 1-1 relationship
     * @ORM\OneToOne(targetEntity="UserMetadata", mappedBy="user", cascade={"persist", "merge", "remove"})
     */
    private $metadata;

    public function __construct() {
        # This will be populated by Netgusto\Baikal\DavServicesBundle\Entity\UserListener::postLoad()
        # Using Doctrine Entity Listener here as Doctrine cannot natively handle relationships on non-primarykey columns
        $this->principals = array();
    }

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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($digesta1) {
        $this->digesta1 = $digesta1;
        return $this;
    }

    public function getPassword() {
        return $this->digesta1;
    }

    # The trick: SabreDav hashes passwords using username
    # The only way to bring the username to the password encoder (\Netgusto\Baikal\DavServicesBundle\Service\SabreDavPasswordEncoder)
    # Is therefore to pass it as salt
    public function getSalt() {
        return $this->getUsername();
    }

    public function getPrincipals() {
        return $this->principals;
    }

    public function setPrincipals(array $principals) {
        $this->principals = $principals;
    }

    public function getIdentityPrincipal() {
        $principals = $this->getPrincipals();
        foreach($principals as $principal) {
            if($principal->getUri() === 'principals/' . $this->getUsername()) {
                return $principal;
            }
        }

        return null;
    }

    public function getCalendars() {
        return $this->calendars;
    }

    public function setCalendars(array $calendars) {
        $this->calendars = $calendars;
    }

    public function getAddressbooks() {
        return $this->addressbooks;
    }

    public function setAddressbooks(array $addressbooks) {
        $this->addressbooks = $addressbooks;
    }

    public function getUILabel() {
        $principal = $this->getIdentityPrincipal();

        if(!is_null($principal)) {
            return $principal->getDisplayname();
        } else {
            return $this->getUsername();
        }
    }


    /**
     * @inheritDoc
     */
    public function getRoles() {
        if(is_null($this->metadata)) {
            return array();
        }
        
        return $this->metadata->getRoles();
    }

    /**
     * @inheritDoc
     */
    public function setRoles(array $roles) {
        if(is_null($this->metadata)) {
            return array();
        }
        
        $this->metadata->setRoles($roles);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addRole($role) {
        $this->metadata->addRole($role);
        return $this;
    }

    public function hasRole($role) {
        return in_array($role, $this->getRoles());
    }

    /**
     * @inheritDoc
     */
    public function removeRole($role) {
        $this->metadata->removeRole($role);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize() {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized) {
        list (
            $this->id,
        ) = unserialize($serialized);
    }
}
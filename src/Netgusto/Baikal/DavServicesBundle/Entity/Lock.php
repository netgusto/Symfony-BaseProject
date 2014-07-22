<?php

namespace Netgusto\Baikal\DavServicesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lock
 *
 * @ORM\Table(name="locks")
 * @ORM\Entity()
 */
class Lock
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
     * @ORM\Column(name="owner", type="text", nullable=true)
     */
    private $owner;

    /**
     * @var integer
     *
     * @ORM\Column(name="timeout", type="integer", nullable=true)
     */
    private $timeout;

    /**
     * @var integer
     *
     * @ORM\Column(name="created", type="integer", nullable=true)
     */
    private $created;

    /**
     * @var text
     *
     * @ORM\Column(name="token", type="text", nullable=true)
     */
    private $token;

    /**
     * @var integer
     *
     * @ORM\Column(name="scope", type="integer", nullable=true)
     */
    private $scope;

    /**
     * @var integer
     *
     * @ORM\Column(name="depth", type="integer", nullable=true)
     */
    private $depth;

    /**
     * @var string
     *
     * @ORM\Column(name="uri", type="string", length=255, nullable=true)
     */
    private $uri;

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
     * Set owner
     *
     * @param string $owner
     * @return Lock
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * Get owner
     *
     * @return string 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set timeout
     *
     * @param int $timeout
     * @return Lock
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * Get timeout
     *
     * @return int 
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Set created
     *
     * @param int $created
     * @return Lock
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return int 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Lock
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set scope
     *
     * @param string $scope
     * @return Lock
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }

    /**
     * Get scope
     *
     * @return string 
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Set depth
     *
     * @param string $depth
     * @return Lock
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
        return $this;
    }

    /**
     * Get depth
     *
     * @return string 
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * Set uri
     *
     * @param string $uri
     * @return Lock
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
}

<?php

namespace Netgusto\Baikal\DavServicesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CalendarSubscription
 *
 * @ORM\Table(name="calendarsubscriptions")
 * @ORM\Entity()
 */
class CalendarSubscription
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
     * @ORM\Column(name="uri", type="string", length=255)
     */
    private $uri;

    /**
     * @var string
     *
     * @ORM\Column(name="principaluri", type="string", length=255)
     */
    private $principaluri;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="text", nullable=true)
     */
    private $source;

    /**
     * @var string
     *
     * @ORM\Column(name="displayname", type="string", length=255, nullable=true)
     */
    private $displayname;

    /**
     * @var string
     *
     * @ORM\Column(name="refreshrate", type="string", length=255, nullable=true)
     */
    private $refreshrate;

    /**
     * @var integer
     *
     * @ORM\Column(name="calendarorder", type="integer", nullable=true)
     */
    private $calendarorder;

    /**
     * @var string
     *
     * @ORM\Column(name="calendarcolor", type="string", length=255, nullable=true)
     */
    private $calendarcolor;

    /**
     * @var boolean
     *
     * @ORM\Column(name="striptodos", type="boolean", nullable=true)
     */
    private $striptodos;

    /**
     * @var bool
     *
     * @ORM\Column(name="stripalarms", type="boolean", nullable=true)
     */
    private $stripalarms;

    /**
     * @var bool
     *
     * @ORM\Column(name="stripattachments", type="boolean", nullable=true)
     */
    private $stripattachments;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastmodified", type="integer", nullable=true)
     */
    private $lastmodified;

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
     * Get principaluri
     *
     * @return string 
     */
    public function getPrincipaluri()
    {
        return $this->principaluri;
    }

    /**
     * Set principaluri
     *
     * @param string $principaluri
     * @return CalendarSubscription
     */
    public function setPrincipaluri($principaluri)
    {
        $this->principaluri = $principaluri;
        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return CalendarSubscription
     */
    public function setSource($source)
    {
        $this->source = $source;
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
     * Set displayname
     *
     * @param string $source
     * @return CalendarSubscription
     */
    public function setDisplayname($displayname)
    {
        $this->displayname = $displayname;
        return $this;
    }

    /**
     * Get refreshrate
     *
     * @return string 
     */
    public function getRefreshrate()
    {
        return $this->refreshrate;
    }

    /**
     * Set refreshrate
     *
     * @param string $refreshrate
     * @return CalendarSubscription
     */
    public function setRefreshrate($refreshrate)
    {
        $this->refreshrate = $refreshrate;
        return $this;
    }

    /**
     * Get calendarorder
     *
     * @return integer 
     */
    public function getCalendarorder()
    {
        return $this->calendarorder;
    }

    /**
     * Set calendarorder
     *
     * @param integer $calendarorder
     * @return CalendarSubscription
     */
    public function setCalendarorder($calendarorder)
    {
        $this->calendarorder = $calendarorder;
        return $this;
    }

    /**
     * Get calendarcolor
     *
     * @return string 
     */
    public function getCalendarcolor()
    {
        return $this->calendarcolor;
    }

    /**
     * Set calendarcolor
     *
     * @param string $calendarcolor
     * @return CalendarSubscription
     */
    public function setCalendarcolor($calendarcolor)
    {
        $this->calendarcolor = $calendarcolor;
        return $this;
    }

    /**
     * Get striptodos
     *
     * @return string 
     */
    public function getStriptodos()
    {
        return $this->striptodos;
    }

    /**
     * Set striptodos
     *
     * @param string $striptodos
     * @return CalendarSubscription
     */
    public function setStriptodos($striptodos)
    {
        $this->striptodos = $striptodos;
        return $this;
    }

    /**
     * Get stripalarms
     *
     * @return bool 
     */
    public function getStripalarms()
    {
        return $this->stripalarms;
    }

    /**
     * Set stripalarms
     *
     * @param bool $stripalarms
     * @return CalendarSubscription
     */
    public function setStripalarms($stripalarms)
    {
        $this->stripalarms = $stripalarms;
        return $this;
    }

    /**
     * Get stripattachments
     *
     * @return bool 
     */
    public function getStripattachements()
    {
        return $this->stripattachments;
    }

    /**
     * Set stripattachments
     *
     * @param bool $stripattachments
     * @return CalendarSubscription
     */
    public function setStripattachements($stripattachments)
    {
        $this->stripattachments = $stripattachments;
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

    /**
     * Set lastmodified
     *
     * @param integer $lastmodified
     * @return CalendarSubscription
     */
    public function setLastmodified($lastmodified)
    {
        $this->lastmodified = $lastmodified;
        return $this;
    }
}

<?php

namespace Netgusto\Baikal\DavServicesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Netgusto\Baikal\DavServicesBundle\Entity\CalendarEvent;

/**
 * Calendar
 *
 * @ORM\Table(name="calendars")
 * @ORM\Entity(repositoryClass="Netgusto\Baikal\DavServicesBundle\Entity\CalendarRepository")
 */
class Calendar
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
     * @var integer
     *
     * @ORM\Column(name="synctoken", type="integer", nullable=true)
     */
    private $synctoken;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="calendarorder", type="integer", nullable=true)
     */
    private $calendarorder;

    /**
     * @var string
     *
     * @ORM\Column(name="calendarcolor", type="string", length=9, nullable=true)
     */
    private $calendarcolor;

    /**
     * @var string
     *
     * @ORM\Column(name="timezone", type="text", nullable=true)
     */
    private $timezone;

    /**
     * @var string
     *
     * @ORM\Column(name="components", type="string", length=255, nullable=true)
     */
    private $components;

    /**
     * @var string
     *
     * @ORM\Column(name="transparent", type="string", length=255, nullable=true)
     */
    private $transparent;


    /**
     * @ORM\OneToMany(targetEntity="CalendarEvent", mappedBy="calendar", cascade={"remove"})
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity="CalendarChange", mappedBy="calendar", cascade={"remove"})
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
     * @return Calendar
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
     * @return Calendar
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
     * @return Calendar
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
     * @return Calendar
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
     * Set description
     *
     * @param string $description
     * @return Calendar
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
     * Set calendarorder
     *
     * @param integer $calendarorder
     * @return Calendar
     */
    public function setCalendarorder($calendarorder)
    {
        $this->calendarorder = $calendarorder;

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
     * Set calendarcolor
     *
     * @param string $calendarcolor
     * @return Calendar
     */
    public function setCalendarcolor($calendarcolor)
    {
        $this->calendarcolor = $calendarcolor;

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
     * Set timezone
     *
     * @param string $timezone
     * @return Calendar
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return string 
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set components
     *
     * @param string $components
     * @return Calendar
     */
    public function setComponents($components)
    {
        $this->components = $components;

        return $this;
    }

    /**
     * Get components
     *
     * @return string 
     */
    public function getComponents()
    {
        return $this->components;
    }

    public function getTodos() {
        $components = explode(',', $this->getComponents());
        return in_array('VTODO', $components);
    }

    public function setTodos($todo) {
        $components = explode(',', $this->getComponents());

        if($todo) {
            if(!$this->getTodos()) {
                $components[] = 'VTODO';
            }
        } else {
            if($this->getTodos()) {
                unset($components[array_search('VTODO', $components)]);
            }
        }

        $this->setComponents(implode(',', $components));
        return $this;
    }

    /**
     * Set transparent
     *
     * @param string $transparent
     * @return Calendar
     */
    public function setTransparent($transparent)
    {
        $this->transparent = $transparent;

        return $this;
    }

    /**
     * Get transparent
     *
     * @return string 
     */
    public function getTransparent()
    {
        return $this->transparent;
    }

    /**
     * Get events
     *
     * @return string 
     */
    public function getEvents()
    {
        return $this->events;
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

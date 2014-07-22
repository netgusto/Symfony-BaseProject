<?php

namespace Netgusto\Baikal\DavServicesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Netgusto\Baikal\DavServicesBundle\Entity\Calendar;

use Sabre\VObject;

/**
 * CalendarEvent
 *
 * @ORM\Table(name="calendarobjects")
 * @ORM\Entity(repositoryClass="Netgusto\Baikal\DavServicesBundle\Entity\CalendarEventRepository")
 */
class CalendarEvent
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
     * @ORM\Column(name="calendardata", type="text", nullable=true)
     */
    private $calendardata;

    /**
     * @var string
     *
     * @ORM\Column(name="uri", type="string", length=255, nullable=true)
     */
    private $uri;

    /**
     * @ORM\ManyToOne(targetEntity="Calendar", inversedBy="events")
     * @ORM\JoinColumn(name="calendarid", referencedColumnName="id")
     */
    private $calendar;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastmodified", type="integer", nullable=true)
     */
    private $lastmodified;

    /**
     * @var string
     *
     * @ORM\Column(name="etag", type="string", length=255, nullable=true)
     */
    private $etag;

    /**
     * @var integer
     *
     * @ORM\Column(name="size", type="integer", nullable=true)
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="componenttype", type="string", length=255, nullable=true)
     */
    private $componenttype;

    /**
     * @var integer
     *
     * @ORM\Column(name="firstoccurence", type="integer", nullable=true)
     */
    private $firstoccurence;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastoccurence", type="integer", nullable=true)
     */
    private $lastoccurence;

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
     * Set calendardata
     *
     * @param string $calendardata
     * @return CalendarEvent
     */
    public function setCalendardata($calendardata)
    {
        $this->calendardata = $calendardata;

        return $this;
    }

    /**
     * Get calendardata
     *
     * @return string 
     */
    public function getCalendardata()
    {
        return $this->calendardata;
    }

    /**
     * Set uri
     *
     * @param string $uri
     * @return CalendarEvent
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
     * Set calendar
     *
     * @param Calendar $calendar
     * @return CalendarEvent
     */
    public function setCalendar(Calendar $calendar)
    {
        $this->calendar = $calendar;
        return $this;
    }

    /**
     * Get calendar
     *
     * @return Calendar 
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /**
     * Set lastmodified
     *
     * @param integer $lastmodified
     * @return CalendarEvent
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

    /**
     * Get lastmodified
     *
     * @return integer 
     */
    public function getLastmodifiedAsDateTime()
    {
        $datetime = new \DateTime();
        $datetime->setTimestamp($this->getLastmodified());
        return $datetime;
    }

    /**
     * Set etag
     *
     * @param string $etag
     * @return CalendarEvent
     */
    public function setEtag($etag)
    {
        $this->etag = $etag;

        return $this;
    }

    /**
     * Get etag
     *
     * @return string 
     */
    public function getEtag()
    {
        return $this->etag;
    }

    /**
     * Set size
     *
     * @param integer $size
     * @return CalendarEvent
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return integer 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set componenttype
     *
     * @param string $componenttype
     * @return CalendarEvent
     */
    public function setComponenttype($componenttype)
    {
        $this->componenttype = $componenttype;

        return $this;
    }

    /**
     * Get componenttype
     *
     * @return string 
     */
    public function getComponenttype()
    {
        return $this->componenttype;
    }

    /**
     * Set firstoccurence
     *
     * @param integer $firstoccurence
     * @return CalendarEvent
     */
    public function setFirstoccurence($firstoccurence)
    {
        $this->firstoccurence = $firstoccurence;

        return $this;
    }

    /**
     * Get firstoccurence
     *
     * @return integer 
     */
    public function getFirstoccurence()
    {
        return $this->firstoccurence;
    }

    /**
     * Set lastoccurence
     *
     * @param integer $lastoccurence
     * @return CalendarEvent
     */
    public function setLastoccurence($lastoccurence)
    {
        $this->lastoccurence = $lastoccurence;

        return $this;
    }

    /**
     * Get lastoccurence
     *
     * @return integer 
     */
    public function getLastoccurence()
    {
        return $this->lastoccurence;
    }

    # Dav wrapper methods below this line

    public function getVObject() {
        if(is_null($this->vobject)) {
            $this->vobject = VObject\Reader::read($this->getCalendardata());
        }

        return $this->vobject;
    }

    public function getStart() {
        return $this->getVObject()->VEVENT->DTSTART->getDateTime();
    }

    public function getEnd() {
        return $this->getVObject()->VEVENT->DTEND->getDateTime();
    }

    public function getSummary() {
        return $this->getVObject()->VEVENT->SUMMARY;
    }

    public function getDescription() {
        return $this->getVObject()->VEVENT->DESCRIPTION;
    }

    public function isCalendarEvent() {
        return is_object($this->getVObject()->VEVENT);
    }

    public function isTodoEvent() {
        return is_object($this->getVObject()->VTODO);
    }
}

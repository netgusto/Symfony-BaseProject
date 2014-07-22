<?php

namespace Netgusto\Baikal\DavServicesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CalendarChange
 *
 * @ORM\Table(name="calendarchanges")
 * @ORM\Entity()
 */
class CalendarChange
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
     * @var Calendar
     *
     * @ORM\ManyToOne(targetEntity="Calendar", inversedBy="changes")
     * @ORM\JoinColumn(name="calendarid", referencedColumnName="id")
     */
    private $calendar;

    /**
     * @var integer
     *
     * @ORM\Column(name="operation", type="integer", nullable=true)
     */
    private $operation;

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
     * @return CalendarChange
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
     * @return CalendarChange
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
     * Set calendar
     *
     * @param Calendar $calendar
     * @return CalendarChange
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
     * Set operation
     *
     * @param integer $operation
     * @return CalendarChange
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * Get operation
     *
     * @return integer 
     */
    public function getOperation()
    {
        return $this->operation;
    }
}

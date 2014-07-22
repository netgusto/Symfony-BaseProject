<?php

namespace Netgusto\Baikal\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Settings
 *
 * @ORM\Entity
 * @ORM\Table(name="bk_settings")
 */
class Settings
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
     * @ORM\Column(name="configuredversion", type="string", length=255)
     */
    private $configuredversion;

    /**
     * @var string
     *
     * @ORM\Column(name="servertimezone", type="string", length=255)
     */
    private $servertimezone;

    /**
     * @var array
     *
     * @ORM\Column(name="enabledservices", type="array")
     */
    private $enabledservices;

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
     * Set configuredversion
     *
     * @param string $configuredversion
     * @return Settings
     */
    public function setConfiguredversion($configuredversion)
    {
        $this->configuredversion = $configuredversion;
        return $this;
    }

    /**
     * Get configuredversion
     *
     * @return string 
     */
    public function getConfiguredversion()
    {
        return $this->configuredversion;
    }

    /**
     * Set servertimezone
     *
     * @param string $servertimezone
     * @return Settings
     */
    public function setServertimezone($servertimezone)
    {
        $this->servertimezone = $servertimezone;
        return $this;
    }

    /**
     * Get servertimezone
     *
     * @return string 
     */
    public function getServertimezone()
    {
        return $this->servertimezone;
    }

    /**
     * Set enabledservices
     *
     * @param array $enabledservices
     * @return Settings
     */
    public function setEnabledservices(array $enabledservices)
    {
        $this->enabledservices = $enabledservices;
        return $this;
    }

    /**
     * Get enabledservices
     *
     * @return array 
     */
    public function getEnabledservices()
    {
        return $this->enabledservices;
    }

    /**
     * Enables the given service
     *
     * @param string $service
     * @return Settings
     */
    public function addEnabledservice($service) {

        $service = strtoupper($service);
        if(!in_array($service, $this->enabledservices, TRUE)) {
            $this->enabledservices[] = $service;
        }

        return $this;
    }

    /**
     * Disables the given service
     *
     * @param string $service
     * @return Settings
     */
    public function removeEnabledservice($service) {

        $service = strtoupper($service);
        if(in_array($service, $this->enabledservices, TRUE)) {
            unset($this->enabledservices[array_search($service, $this->enabledservices)]);
        }

        return $this;
    }

    /**
     * Check if a service is enabled
     *
     * @param string $service
     * @return boolean
     */
    public function hasEnabledService($service) {

        $service = strtoupper($service);
        return in_array($service, $this->enabledservices, TRUE);
    }
}
<?php

namespace Saia;

/**
 * Phinxlog
 */
class Phinxlog
{
    /**
     * @var integer
     */
    private $version;

    /**
     * @var string
     */
    private $migrationName;

    /**
     * @var \DateTime
     */
    private $startTime;

    /**
     * @var \DateTime
     */
    private $endTime;

    /**
     * @var boolean
     */
    private $breakpoint;


    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set migrationName
     *
     * @param string $migrationName
     *
     * @return Phinxlog
     */
    public function setMigrationName($migrationName)
    {
        $this->migrationName = $migrationName;

        return $this;
    }

    /**
     * Get migrationName
     *
     * @return string
     */
    public function getMigrationName()
    {
        return $this->migrationName;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return Phinxlog
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return Phinxlog
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set breakpoint
     *
     * @param boolean $breakpoint
     *
     * @return Phinxlog
     */
    public function setBreakpoint($breakpoint)
    {
        $this->breakpoint = $breakpoint;

        return $this;
    }

    /**
     * Get breakpoint
     *
     * @return boolean
     */
    public function getBreakpoint()
    {
        return $this->breakpoint;
    }
}


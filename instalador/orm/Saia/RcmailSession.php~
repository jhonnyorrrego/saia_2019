<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * RcmailSession
 *
 * @ORM\Table(name="rcmail_session", indexes={@ORM\Index(name="changed_index", columns={"changed"})})
 * @ORM\Entity
 */
class RcmailSession
{
    /**
     * @var string
     *
     * @ORM\Column(name="sess_id", type="string", length=128, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $sessId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created = '1000-01-01 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="changed", type="datetime", nullable=false)
     */
    private $changed = '1000-01-01 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=40, nullable=false)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="vars", type="text", length=16777215, nullable=false)
     */
    private $vars;



    /**
     * Get sessId
     *
     * @return string
     */
    public function getSessId()
    {
        return $this->sessId;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return RcmailSession
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set changed
     *
     * @param \DateTime $changed
     *
     * @return RcmailSession
     */
    public function setChanged($changed)
    {
        $this->changed = $changed;

        return $this;
    }

    /**
     * Get changed
     *
     * @return \DateTime
     */
    public function getChanged()
    {
        return $this->changed;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return RcmailSession
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set vars
     *
     * @param string $vars
     *
     * @return RcmailSession
     */
    public function setVars($vars)
    {
        $this->vars = $vars;

        return $this;
    }

    /**
     * Get vars
     *
     * @return string
     */
    public function getVars()
    {
        return $this->vars;
    }
}

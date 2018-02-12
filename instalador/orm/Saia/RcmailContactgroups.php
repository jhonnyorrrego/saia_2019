<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * RcmailContactgroups
 *
 * @ORM\Table(name="rcmail_contactgroups", indexes={@ORM\Index(name="contactgroups_user_index", columns={"user_id", "del"})})
 * @ORM\Entity
 */
class RcmailContactgroups
{
    /**
     * @var integer
     *
     * @ORM\Column(name="contactgroup_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $contactgroupId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="changed", type="datetime", nullable=false)
     */
    private $changed = '1000-01-01 00:00:00';

    /**
     * @var boolean
     *
     * @ORM\Column(name="del", type="boolean", nullable=false)
     */
    private $del = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name = '';



    /**
     * Get contactgroupId
     *
     * @return integer
     */
    public function getContactgroupId()
    {
        return $this->contactgroupId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return RcmailContactgroups
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set changed
     *
     * @param \DateTime $changed
     *
     * @return RcmailContactgroups
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
     * Set del
     *
     * @param boolean $del
     *
     * @return RcmailContactgroups
     */
    public function setDel($del)
    {
        $this->del = $del;

        return $this;
    }

    /**
     * Get del
     *
     * @return boolean
     */
    public function getDel()
    {
        return $this->del;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return RcmailContactgroups
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

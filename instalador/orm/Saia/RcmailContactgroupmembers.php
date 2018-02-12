<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * RcmailContactgroupmembers
 *
 * @ORM\Table(name="rcmail_contactgroupmembers", indexes={@ORM\Index(name="contactgroupmembers_contact_index", columns={"contact_id"})})
 * @ORM\Entity
 */
class RcmailContactgroupmembers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="contactgroup_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $contactgroupId;

    /**
     * @var integer
     *
     * @ORM\Column(name="contact_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $contactId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created = '1000-01-01 00:00:00';



    /**
     * Set contactgroupId
     *
     * @param integer $contactgroupId
     *
     * @return RcmailContactgroupmembers
     */
    public function setContactgroupId($contactgroupId)
    {
        $this->contactgroupId = $contactgroupId;

        return $this;
    }

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
     * Set contactId
     *
     * @param integer $contactId
     *
     * @return RcmailContactgroupmembers
     */
    public function setContactId($contactId)
    {
        $this->contactId = $contactId;

        return $this;
    }

    /**
     * Get contactId
     *
     * @return integer
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return RcmailContactgroupmembers
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
}

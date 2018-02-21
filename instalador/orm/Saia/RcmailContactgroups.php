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
     * @ORM\GeneratedValue(strategy="AUTO")
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


}


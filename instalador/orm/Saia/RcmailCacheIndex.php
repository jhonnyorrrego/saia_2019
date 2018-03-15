<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * RcmailCacheIndex
 *
 * @ORM\Table(name="rcmail_cache_index", indexes={@ORM\Index(name="expires_index", columns={"expires"})})
 * @ORM\Entity
 */
class RcmailCacheIndex
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="mailbox", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $mailbox;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expires", type="datetime", nullable=true)
     */
    private $expires;

    /**
     * @var boolean
     *
     * @ORM\Column(name="valid", type="boolean", nullable=false)
     */
    private $valid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text", nullable=false)
     */
    private $data;


}


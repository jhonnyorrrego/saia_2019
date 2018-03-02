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
     * @ORM\GeneratedValue(strategy="AUTO")
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


}


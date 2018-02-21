<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * RcmailIdentities
 *
 * @ORM\Table(name="rcmail_identities", indexes={@ORM\Index(name="user_identities_index", columns={"user_id", "del"}), @ORM\Index(name="email_identities_index", columns={"email", "del"})})
 * @ORM\Entity
 */
class RcmailIdentities
{
    /**
     * @var integer
     *
     * @ORM\Column(name="identity_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $identityId;

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
     * @var boolean
     *
     * @ORM\Column(name="standard", type="boolean", nullable=false)
     */
    private $standard = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="organization", type="string", length=128, nullable=false)
     */
    private $organization = '';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=128, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="`reply-to`", type="string", length=128, nullable=false)
     */
    private $replyTo = '';

    /**
     * @var string
     *
     * @ORM\Column(name="bcc", type="string", length=128, nullable=false)
     */
    private $bcc = '';

    /**
     * @var string
     *
     * @ORM\Column(name="signature", type="text", nullable=true)
     */
    private $signature;

    /**
     * @var boolean
     *
     * @ORM\Column(name="html_signature", type="boolean", nullable=false)
     */
    private $htmlSignature = '0';


}


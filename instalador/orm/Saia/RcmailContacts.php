<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * RcmailContacts
 *
 * @ORM\Table(name="rcmail_contacts", indexes={@ORM\Index(name="user_contacts_index", columns={"user_id", "del"})})
 * @ORM\Entity
 */
class RcmailContacts
{
    /**
     * @var integer
     *
     * @ORM\Column(name="contact_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $contactId;

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
     * @var string
     *
     * @ORM\Column(name="email", type="text", length=65535, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=128, nullable=false)
     */
    private $firstname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=128, nullable=false)
     */
    private $surname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="vcard", type="text", nullable=true)
     */
    private $vcard;

    /**
     * @var string
     *
     * @ORM\Column(name="words", type="text", length=65535, nullable=true)
     */
    private $words;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;


}


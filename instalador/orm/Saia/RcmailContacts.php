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
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * Set changed
     *
     * @param \DateTime $changed
     *
     * @return RcmailContacts
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
     * @return RcmailContacts
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
     * @return RcmailContacts
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

    /**
     * Set email
     *
     * @param string $email
     *
     * @return RcmailContacts
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return RcmailContacts
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return RcmailContacts
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set vcard
     *
     * @param string $vcard
     *
     * @return RcmailContacts
     */
    public function setVcard($vcard)
    {
        $this->vcard = $vcard;

        return $this;
    }

    /**
     * Get vcard
     *
     * @return string
     */
    public function getVcard()
    {
        return $this->vcard;
    }

    /**
     * Set words
     *
     * @param string $words
     *
     * @return RcmailContacts
     */
    public function setWords($words)
    {
        $this->words = $words;

        return $this;
    }

    /**
     * Get words
     *
     * @return string
     */
    public function getWords()
    {
        return $this->words;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return RcmailContacts
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
}

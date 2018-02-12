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
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @ORM\Column(name="reply-to", type="string", length=128, nullable=false)
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



    /**
     * Get identityId
     *
     * @return integer
     */
    public function getIdentityId()
    {
        return $this->identityId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return RcmailIdentities
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
     * @return RcmailIdentities
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
     * @return RcmailIdentities
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
     * Set standard
     *
     * @param boolean $standard
     *
     * @return RcmailIdentities
     */
    public function setStandard($standard)
    {
        $this->standard = $standard;

        return $this;
    }

    /**
     * Get standard
     *
     * @return boolean
     */
    public function getStandard()
    {
        return $this->standard;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return RcmailIdentities
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
     * Set organization
     *
     * @param string $organization
     *
     * @return RcmailIdentities
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get organization
     *
     * @return string
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return RcmailIdentities
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
     * Set replyTo
     *
     * @param string $replyTo
     *
     * @return RcmailIdentities
     */
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;

        return $this;
    }

    /**
     * Get replyTo
     *
     * @return string
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * Set bcc
     *
     * @param string $bcc
     *
     * @return RcmailIdentities
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;

        return $this;
    }

    /**
     * Get bcc
     *
     * @return string
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * Set signature
     *
     * @param string $signature
     *
     * @return RcmailIdentities
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get signature
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Set htmlSignature
     *
     * @param boolean $htmlSignature
     *
     * @return RcmailIdentities
     */
    public function setHtmlSignature($htmlSignature)
    {
        $this->htmlSignature = $htmlSignature;

        return $this;
    }

    /**
     * Get htmlSignature
     *
     * @return boolean
     */
    public function getHtmlSignature()
    {
        return $this->htmlSignature;
    }
}

<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * RcmailUsers
 *
 * @ORM\Table(name="rcmail_users", uniqueConstraints={@ORM\UniqueConstraint(name="username", columns={"username", "mail_host"})})
 * @ORM\Entity
 */
class RcmailUsers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=128, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_host", type="string", length=128, nullable=false)
     */
    private $mailHost;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created = '1000-01-01 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    private $lastLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=5, nullable=true)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="preferences", type="text", nullable=true)
     */
    private $preferences;



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
     * Set username
     *
     * @param string $username
     *
     * @return RcmailUsers
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set mailHost
     *
     * @param string $mailHost
     *
     * @return RcmailUsers
     */
    public function setMailHost($mailHost)
    {
        $this->mailHost = $mailHost;

        return $this;
    }

    /**
     * Get mailHost
     *
     * @return string
     */
    public function getMailHost()
    {
        return $this->mailHost;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return RcmailUsers
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
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     *
     * @return RcmailUsers
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set language
     *
     * @param string $language
     *
     * @return RcmailUsers
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set preferences
     *
     * @param string $preferences
     *
     * @return RcmailUsers
     */
    public function setPreferences($preferences)
    {
        $this->preferences = $preferences;

        return $this;
    }

    /**
     * Get preferences
     *
     * @return string
     */
    public function getPreferences()
    {
        return $this->preferences;
    }
}

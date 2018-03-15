<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * RcmailSearches
 *
 * @ORM\Table(name="rcmail_searches", uniqueConstraints={@ORM\UniqueConstraint(name="uniqueness", columns={"user_id", "type", "name"})})
 * @ORM\Entity
 */
class RcmailSearches
{
    /**
     * @var integer
     *
     * @ORM\Column(name="search_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $searchId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text", length=65535, nullable=true)
     */
    private $data;


}


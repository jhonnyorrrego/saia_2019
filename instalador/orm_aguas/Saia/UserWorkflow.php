<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserWorkflow
 *
 * @ORM\Table(name="USER_WORKFLOW")
 * @ORM\Entity
 */
class UserWorkflow
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="USER_WORKFLOW_ID_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCOUNT", type="string", length=128, nullable=true)
     */
    private $account;

    /**
     * @var string
     *
     * @ORM\Column(name="EMAIL", type="string", length=128, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="PASSWORD", type="string", length=128, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="NAME", type="string", length=128, nullable=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CREATEDDATE", type="date", nullable=false)
     */
    private $createddate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="LASTLOGINDATE", type="date", nullable=true)
     */
    private $lastlogindate;

    /**
     * @var string
     *
     * @ORM\Column(name="LASTLOGINIP", type="string", length=40, nullable=true)
     */
    private $lastloginip;

    /**
     * @var string
     *
     * @ORM\Column(name="LASTBROWSERTYPE", type="string", length=255, nullable=true)
     */
    private $lastbrowsertype;


}


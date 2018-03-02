<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserWorkflow
 *
 * @ORM\Table(name="user_workflow")
 * @ORM\Entity
 */
class UserWorkflow
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="USER_WORKFLOW_ID_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="account", type="string", length=128, nullable=true)
     */
    private $account;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=128, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=128, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createddate", type="date", nullable=false)
     */
    private $createddate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastlogindate", type="date", nullable=true)
     */
    private $lastlogindate;

    /**
     * @var string
     *
     * @ORM\Column(name="lastloginip", type="string", length=40, nullable=true)
     */
    private $lastloginip;

    /**
     * @var string
     *
     * @ORM\Column(name="lastbrowsertype", type="string", length=255, nullable=true)
     */
    private $lastbrowsertype;


}


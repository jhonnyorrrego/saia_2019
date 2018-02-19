<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Userdiagram
 *
 * @ORM\Table(name="USERDIAGRAM", uniqueConstraints={@ORM\UniqueConstraint(name="userdiagram", columns={"DIAGRAMID"})})
 * @ORM\Entity
 */
class Userdiagram
{
    /**
     * @var integer
     *
     * @ORM\Column(name="USERID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="USERDIAGRAM_USERID_seq", allocationSize=1, initialValue=1)
     */
    private $userid;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIAGRAMID", type="integer", nullable=true)
     */
    private $diagramid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="INVITEDDATE", type="date", nullable=true)
     */
    private $inviteddate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ACCEPTEDDATE", type="date", nullable=true)
     */
    private $accepteddate;

    /**
     * @var string
     *
     * @ORM\Column(name="STATUS", type="string", length=255, nullable=true)
     */
    private $status = 'accepted';

    /**
     * @var string
     *
     * @ORM\Column(name="NIVEL", type="string", length=255, nullable=true)
     */
    private $nivel = 'editor';


}


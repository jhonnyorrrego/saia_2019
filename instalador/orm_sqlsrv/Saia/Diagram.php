<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diagram
 *
 * @ORM\Table(name="diagram", uniqueConstraints={@ORM\UniqueConstraint(name="uniqueHash", columns={"hash"})}, indexes={@ORM\Index(name="diagram_pk", columns={"id"})})
 * @ORM\Entity
 */
class Diagram
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="hash", type="string", length=6, nullable=false)
     */
    private $hash;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=16777215, nullable=true)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="publico", type="boolean", nullable=true)
     */
    private $publico = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdDate", type="datetime", nullable=false)
     */
    private $createddate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastUpdate", type="datetime", nullable=false)
     */
    private $lastupdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="tamano", type="integer", nullable=true)
     */
    private $tamano;


}

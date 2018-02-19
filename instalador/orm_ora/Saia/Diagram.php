<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diagram
 *
 * @ORM\Table(name="DIAGRAM")
 * @ORM\Entity
 */
class Diagram
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DIAGRAM_ID_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="HASH", type="string", length=4000, nullable=true)
     */
    private $hash;

    /**
     * @var string
     *
     * @ORM\Column(name="TITLE", type="string", length=4000, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION", type="text", nullable=true)
     */
    private $description = 'empty_clob()';

    /**
     * @var string
     *
     * @ORM\Column(name="PUBLICO", type="string", length=4000, nullable=true)
     */
    private $publico = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CREATEDDATE", type="date", nullable=true)
     */
    private $createddate = 'sysdate';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="LASTUPDATE", type="date", nullable=true)
     */
    private $lastupdate = 'sysdate';

    /**
     * @var string
     *
     * @ORM\Column(name="TAMANO", type="string", length=4000, nullable=true)
     */
    private $tamano;


}


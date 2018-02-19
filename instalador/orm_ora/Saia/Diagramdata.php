<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diagramdata
 *
 * @ORM\Table(name="DIAGRAMDATA")
 * @ORM\Entity
 */
class Diagramdata
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDIAGRAMDATA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DIAGRAMDATA_IDDIAGRAMDATA_seq", allocationSize=1, initialValue=1)
     */
    private $iddiagramdata;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIAGRAMID", type="integer", nullable=true)
     */
    private $diagramid;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPE", type="string", length=11, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="FILENAME", type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @var integer
     *
     * @ORM\Column(name="FILESIZE", type="integer", nullable=true)
     */
    private $filesize;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="LASTUPDATE", type="date", nullable=true)
     */
    private $lastupdate;


}


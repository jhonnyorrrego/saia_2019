<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diagramdata
 *
 * @ORM\Table(name="diagramdata")
 * @ORM\Entity
 */
class Diagramdata
{
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $type = 'dia';

    /**
     * @var integer
     *
     * @ORM\Column(name="diagramId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $diagramid;

    /**
     * @var string
     *
     * @ORM\Column(name="fileName", type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @var integer
     *
     * @ORM\Column(name="fileSize", type="integer", nullable=true)
     */
    private $filesize;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastUpdate", type="datetime", nullable=false)
     */
    private $lastupdate;


}


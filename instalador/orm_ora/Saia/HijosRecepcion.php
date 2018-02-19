<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * HijosRecepcion
 *
 * @ORM\Table(name="HIJOS_RECEPCION")
 * @ORM\Entity
 */
class HijosRecepcion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDOC_RECEPCION", type="integer", nullable=true)
     */
    private $iddocRecepcion;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_HIJO", type="string", length=255, nullable=true)
     */
    private $nombreHijo;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDDOC_HIJO", type="integer", nullable=true)
     */
    private $iddocHijo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_HIJOS_RECEPCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="HIJOS_RECEPCION_ID_HIJOS_RECEP", allocationSize=1, initialValue=1)
     */
    private $idHijosRecepcion;


}


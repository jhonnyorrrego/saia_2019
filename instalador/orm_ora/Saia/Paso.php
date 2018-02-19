<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paso
 *
 * @ORM\Table(name="PASO")
 * @ORM\Entity
 */
class Paso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_IDPASO_seq", allocationSize=1, initialValue=1)
     */
    private $idpaso;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="text", nullable=true)
     */
    private $descripcion = 'empty_clob()';

    /**
     * @var string
     *
     * @ORM\Column(name="RESPONSABLE", type="text", nullable=true)
     */
    private $responsable = 'empty_clob()';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_PASO", type="string", length=255, nullable=true)
     */
    private $nombrePaso;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ESTADO", type="boolean", nullable=true)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFIGURA", type="integer", nullable=true)
     */
    private $idfigura;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIAGRAM_IDDIAGRAM", type="integer", nullable=true)
     */
    private $diagramIddiagram;

    /**
     * @var string
     *
     * @ORM\Column(name="POSICION", type="string", length=255, nullable=true)
     */
    private $posicion;

    /**
     * @var string
     *
     * @ORM\Column(name="PLAZO_PASO", type="string", length=255, nullable=true)
     */
    private $plazoPaso;


}


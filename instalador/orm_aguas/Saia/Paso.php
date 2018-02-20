<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paso
 *
 * @ORM\Table(name="PASO", indexes={@ORM\Index(name="i_paso_idfigura", columns={"IDFIGURA"})})
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
     * @ORM\Column(name="RESPONSABLE", type="text", nullable=false)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_PASO", type="string", length=255, nullable=false)
     */
    private $nombrePaso;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="DIAGRAM_IDDIAGRAM", type="integer", nullable=false)
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

    /**
     * @var string
     *
     * @ORM\Column(name="IDFIGURA", type="string", length=255, nullable=false)
     */
    private $idfigura;


}

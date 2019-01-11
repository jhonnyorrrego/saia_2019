<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salidas
 *
 * @ORM\Table(name="salidas", indexes={@ORM\Index(name="documento_iddocumento", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class Salidas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idsalida", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsalida;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="numero_guia", type="string", length=255, nullable=true)
     */
    private $numeroGuia;

    /**
     * @var integer
     *
     * @ORM\Column(name="empresa", type="integer", nullable=true)
     */
    private $empresa = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="responsable", type="integer", nullable=true)
     */
    private $responsable = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_despacho", type="date", nullable=true)
     */
    private $fechaDespacho;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_despacho", type="string", length=255, nullable=true)
     */
    private $tipoDespacho;

    /**
     * @var string
     *
     * @ORM\Column(name="notas", type="text", length=65535, nullable=true)
     */
    private $notas;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="radicado_despacho", type="integer", nullable=true)
     */
    private $radicadoDespacho;


}


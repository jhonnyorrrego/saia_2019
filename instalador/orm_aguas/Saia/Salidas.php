<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salidas
 *
 * @ORM\Table(name="SALIDAS", indexes={@ORM\Index(name="i_salidas_empresa", columns={"EMPRESA"}), @ORM\Index(name="i_salidas_responsable", columns={"RESPONSABLE"}), @ORM\Index(name="i_salidas_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class Salidas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDSALIDA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="SALIDAS_IDSALIDA_seq", allocationSize=1, initialValue=1)
     */
    private $idsalida;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_GUIA", type="string", length=255, nullable=true)
     */
    private $numeroGuia;

    /**
     * @var integer
     *
     * @ORM\Column(name="EMPRESA", type="integer", nullable=true)
     */
    private $empresa = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="RESPONSABLE", type="integer", nullable=true)
     */
    private $responsable = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_DESPACHO", type="date", nullable=true)
     */
    private $fechaDespacho;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_DESPACHO", type="string", length=255, nullable=true)
     */
    private $tipoDespacho;

    /**
     * @var string
     *
     * @ORM\Column(name="NOTAS", type="text", nullable=true)
     */
    private $notas;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=255, nullable=true)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="RADICADO_DESPACHO", type="integer", nullable=true)
     */
    private $radicadoDespacho;


}

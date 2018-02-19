<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salidas
 *
 * @ORM\Table(name="SALIDAS")
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
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_GUIA", type="string", length=50, nullable=true)
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
     * @ORM\Column(name="FECHA_DESPACHO", type="date", nullable=true)
     */
    private $fechaDespacho = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_DESPACHO", type="string", length=255, nullable=true)
     */
    private $tipoDespacho;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="NOTAS", type="string", length=255, nullable=true)
     */
    private $notas;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=true)
     */
    private $estado = '1';


}


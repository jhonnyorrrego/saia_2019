<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoRutaAprob
 *
 * @ORM\Table(name="documento_ruta_aprob")
 * @ORM\Entity
 */
class DocumentoRutaAprob
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_ruta_aprob", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddocumentoRutaAprob;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_vencimiento", type="date", nullable=true)
     */
    private $fechaVencimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_ruta_aprob", type="integer", nullable=true)
     */
    private $estadoRutaAprob = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=false)
     */
    private $fechaCreacion = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="idfunc_creador", type="integer", nullable=false)
     */
    private $idfuncCreador;

    /**
     * @var integer
     *
     * @ORM\Column(name="aprobacion_en", type="integer", nullable=false)
     */
    private $aprobacionEn;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=false)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;


}


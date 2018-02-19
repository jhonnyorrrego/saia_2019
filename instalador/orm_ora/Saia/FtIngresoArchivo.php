<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtIngresoArchivo
 *
 * @ORM\Table(name="FT_INGRESO_ARCHIVO", indexes={@ORM\Index(name="i_ingreso_arch", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class FtIngresoArchivo
{
    /**
     * @var string
     *
     * @ORM\Column(name="SUBSECCION_ARCHIVO", type="string", length=255, nullable=true)
     */
    private $subseccionArchivo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="REGIONAL_ARCHIVO", type="string", length=255, nullable=false)
     */
    private $regionalArchivo;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_TOMA_CONTRIBU", type="string", length=255, nullable=false)
     */
    private $lugarTomaContribu;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_INGRESO_ARCHIVO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_INGRESO_ARCHIVO_IDFT_INGRES", allocationSize=1, initialValue=1)
     */
    private $idftIngresoArchivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPENDENCIA", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENCABEZADO", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="FIRMA", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '701';

    /**
     * @var string
     *
     * @ORM\Column(name="CONSECUTIVO_CIU_ARCHI", type="string", length=255, nullable=false)
     */
    private $consecutivoCiuArchi;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_FOLIOS", type="string", length=255, nullable=true)
     */
    private $numeroFolios;

    /**
     * @var string
     *
     * @ORM\Column(name="SECCION_ARCHIVO", type="string", length=255, nullable=true)
     */
    private $seccionArchivo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="CARGUE_ARCHIVO", type="string", length=255, nullable=true)
     */
    private $cargueArchivo;


}


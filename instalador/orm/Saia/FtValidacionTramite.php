<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtValidacionTramite
 *
 * @ORM\Table(name="ft_validacion_tramite")
 * @ORM\Entity
 */
class FtValidacionTramite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_validacion_tramite", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftValidacionTramite;

    /**
     * @var string
     *
     * @ORM\Column(name="concepto_dir", type="text", length=65535, nullable=false)
     */
    private $conceptoDir;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_tramite", type="date", nullable=false)
     */
    private $fechaTramite;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_prestamos", type="integer", nullable=false)
     */
    private $ftSolicitudPrestamos;

    /**
     * @var integer
     *
     * @ORM\Column(name="memorandos", type="integer", nullable=false)
     */
    private $memorandos;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1093';


}


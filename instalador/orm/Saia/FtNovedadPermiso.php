<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtNovedadPermiso
 *
 * @ORM\Table(name="ft_novedad_permiso")
 * @ORM\Entity
 */
class FtNovedadPermiso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_novedad_permiso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftNovedadPermiso;

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
     * @ORM\Column(name="fecha_llegada_nov", type="datetime", nullable=false)
     */
    private $fechaLlegadaNov;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_salida_nov", type="datetime", nullable=false)
     */
    private $fechaSalidaNov;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_permisos", type="integer", nullable=false)
     */
    private $ftSolicitudPermisos;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1055';

    /**
     * @var string
     *
     * @ORM\Column(name="tiempo_requerido_nov", type="string", length=255, nullable=false)
     */
    private $tiempoRequeridoNov;


}


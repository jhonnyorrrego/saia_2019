<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtUbicacionActivos
 *
 * @ORM\Table(name="ft_ubicacion_activos")
 * @ORM\Entity
 */
class FtUbicacionActivos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_ubicacion_activos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftUbicacionActivos;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

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
     * @ORM\Column(name="fecha_devolucion", type="date", nullable=true)
     */
    private $fechaDevolucion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=true)
     */
    private $fechaFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=true)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ubicacion", type="date", nullable=false)
     */
    private $fechaUbicacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_registro_activos_fijos", type="integer", nullable=false)
     */
    private $ftRegistroActivosFijos;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_padre", type="integer", nullable=true)
     */
    private $idPadre;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="responsable_activo", type="integer", nullable=false)
     */
    private $responsableActivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '892';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_traslado", type="integer", nullable=true)
     */
    private $tipoTraslado;

    /**
     * @var integer
     *
     * @ORM\Column(name="ubicacion", type="integer", nullable=false)
     */
    private $ubicacion;


}


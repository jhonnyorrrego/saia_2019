<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtProceso
 *
 * @ORM\Table(name="ft_proceso")
 * @ORM\Entity
 */
class FtProceso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_proceso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftProceso;

    /**
     * @var string
     *
     * @ORM\Column(name="alcance", type="text", length=65535, nullable=false)
     */
    private $alcance;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="aprobado_por", type="integer", nullable=false)
     */
    private $aprobadoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, nullable=true)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="coordenadas", type="string", length=255, nullable=true)
     */
    private $coordenadas;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="dependencias_partici", type="string", length=255, nullable=false)
     */
    private $dependenciasPartici;

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
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_aprobacion_rie", type="datetime", nullable=true)
     */
    private $fechaAprobacionRie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_revision_riesg", type="datetime", nullable=true)
     */
    private $fechaRevisionRiesg;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="lider_proceso", type="string", length=255, nullable=false)
     */
    private $liderProceso;

    /**
     * @var string
     *
     * @ORM\Column(name="listado_maestro_registros", type="string", length=255, nullable=true)
     */
    private $listadoMaestroRegistros;

    /**
     * @var integer
     *
     * @ORM\Column(name="macroproceso", type="integer", nullable=true)
     */
    private $macroproceso;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivo", type="text", length=65535, nullable=false)
     */
    private $objetivo;

    /**
     * @var string
     *
     * @ORM\Column(name="permisos_acceso", type="string", length=255, nullable=true)
     */
    private $permisosAcceso;

    /**
     * @var string
     *
     * @ORM\Column(name="politica_operacion", type="text", length=65535, nullable=true)
     */
    private $politicaOperacion;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255, nullable=false)
     */
    private $responsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="revisado_por", type="integer", nullable=false)
     */
    private $revisadoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="secretarias", type="string", length=255, nullable=true)
     */
    private $secretarias;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1478';

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=true)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="vigencia", type="string", length=255, nullable=true)
     */
    private $vigencia;


}

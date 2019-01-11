<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtProcedimiento
 *
 * @ORM\Table(name="ft_procedimiento")
 * @ORM\Entity
 */
class FtProcedimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_procedimiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftProcedimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="acta", type="string", length=255, nullable=true)
     */
    private $acta;

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
     * @var string
     *
     * @ORM\Column(name="aprobado_por", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="definicion", type="text", length=65535, nullable=false)
     */
    private $definicion;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="dispocisiones_generales", type="text", length=65535, nullable=true)
     */
    private $dispocisionesGenerales;

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
     * @ORM\Column(name="fecha_nomina", type="date", nullable=false)
     */
    private $fechaNomina;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_proceso", type="integer", nullable=false)
     */
    private $ftProceso;

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
     * @ORM\Column(name="secretarias", type="string", length=255, nullable=true)
     */
    private $secretarias;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=true)
     */
    private $serieIdserie = '1040';

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=true)
     */
    private $version;

    /**
     * @var integer
     *
     * @ORM\Column(name="origen_documento", type="integer", nullable=true)
     */
    private $origenDocumento = '2';


}

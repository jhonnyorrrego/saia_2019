<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPolizas
 *
 * @ORM\Table(name="ft_polizas")
 * @ORM\Entity
 */
class FtPolizas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_polizas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPolizas;

    /**
     * @var string
     *
     * @ORM\Column(name="anexar_poliza", type="string", length=255, nullable=false)
     */
    private $anexarPoliza;

    /**
     * @var integer
     *
     * @ORM\Column(name="aseguradora", type="integer", nullable=false)
     */
    private $aseguradora;

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
     * @ORM\Column(name="fecha_inicio_poliza", type="date", nullable=false)
     */
    private $fechaInicioPoliza;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_vencimiento_poliza", type="date", nullable=false)
     */
    private $fechaVencimientoPoliza;

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
    private $serieIdserie = '907';


}

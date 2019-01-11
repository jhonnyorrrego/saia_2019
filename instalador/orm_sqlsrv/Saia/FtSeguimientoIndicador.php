<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSeguimientoIndicador
 *
 * @ORM\Table(name="ft_seguimiento_indicador")
 * @ORM\Entity
 */
class FtSeguimientoIndicador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_seguimiento_indicador", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSeguimientoIndicador;

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
     * @ORM\Column(name="fecha_seguimiento", type="date", nullable=false)
     */
    private $fechaSeguimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_formula_indicador", type="integer", nullable=false)
     */
    private $ftFormulaIndicador;

    /**
     * @var string
     *
     * @ORM\Column(name="linea_base", type="string", length=255, nullable=true)
     */
    private $lineaBase;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_indicador_actual", type="string", length=20, nullable=false)
     */
    private $metaIndicadorActual;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="resultado", type="string", length=255, nullable=true)
     */
    private $resultado;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1260';


}

<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtFormulaIndicador
 *
 * @ORM\Table(name="ft_formula_indicador")
 * @ORM\Entity
 */
class FtFormulaIndicador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_formula_indicador", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftFormulaIndicador;

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
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_indicadores_calidad", type="integer", nullable=false)
     */
    private $ftIndicadoresCalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="naturaleza", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $naturaleza = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=255, nullable=true)
     */
    private $observacion;

    /**
     * @var string
     *
     * @ORM\Column(name="periocidad", type="string", length=255, nullable=true)
     */
    private $periocidad = '180';

    /**
     * @var string
     *
     * @ORM\Column(name="rango_colores", type="string", length=255, nullable=false)
     */
    private $rangoColores;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '2542';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_rango", type="integer", nullable=false)
     */
    private $tipoRango = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="unidad", type="string", length=50, nullable=false)
     */
    private $unidad = '0';


}


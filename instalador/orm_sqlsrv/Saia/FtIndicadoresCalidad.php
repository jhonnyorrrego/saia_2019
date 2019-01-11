<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtIndicadoresCalidad
 *
 * @ORM\Table(name="ft_indicadores_calidad")
 * @ORM\Entity
 */
class FtIndicadoresCalidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_indicadores_calidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftIndicadoresCalidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="dependencia_indicador", type="string", length=255, nullable=false)
     */
    private $dependenciaIndicador;

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
     * @ORM\Column(name="fuente_datos", type="text", length=65535, nullable=false)
     */
    private $fuenteDatos;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivo_calidad_indicador", type="text", length=65535, nullable=false)
     */
    private $objetivoCalidadIndicador;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_analisis", type="string", length=255, nullable=false)
     */
    private $responsableAnalisis;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '2541';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_grafico", type="string", length=20, nullable=false)
     */
    private $tipoGrafico = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_indicador", type="string", length=255, nullable=true)
     */
    private $tipoIndicador;


}

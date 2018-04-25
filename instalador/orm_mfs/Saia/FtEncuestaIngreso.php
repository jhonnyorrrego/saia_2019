<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEncuestaIngreso
 *
 * @ORM\Table(name="ft_encuesta_ingreso")
 * @ORM\Entity
 */
class FtEncuestaIngreso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_encuesta_ingreso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftEncuestaIngreso;

    /**
     * @var string
     *
     * @ORM\Column(name="aspecto_mejorar", type="text", length=65535, nullable=false)
     */
    private $aspectoMejorar;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad_encuesta", type="string", length=255, nullable=false)
     */
    private $ciudadEncuesta = '658';

    /**
     * @var string
     *
     * @ORM\Column(name="consideracion_empresa", type="text", length=65535, nullable=false)
     */
    private $consideracionEmpresa;

    /**
     * @var string
     *
     * @ORM\Column(name="corto_plazo", type="text", length=65535, nullable=false)
     */
    private $cortoPlazo;

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
     * @var string
     *
     * @ORM\Column(name="expectativas_empresa", type="text", length=65535, nullable=false)
     */
    private $expectativasEmpresa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_encuesta", type="date", nullable=false)
     */
    private $fechaEncuesta;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="fortalezas", type="text", length=65535, nullable=false)
     */
    private $fortalezas;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_personal", type="integer", nullable=false)
     */
    private $ftSolicitudPersonal;

    /**
     * @var string
     *
     * @ORM\Column(name="habilidades_talentos", type="text", length=65535, nullable=false)
     */
    private $habilidadesTalentos;

    /**
     * @var string
     *
     * @ORM\Column(name="hobbies", type="text", length=65535, nullable=false)
     */
    private $hobbies;

    /**
     * @var string
     *
     * @ORM\Column(name="largo_plazo", type="text", length=65535, nullable=false)
     */
    private $largoPlazo;

    /**
     * @var string
     *
     * @ORM\Column(name="medio_plazo", type="text", length=65535, nullable=false)
     */
    private $medioPlazo;

    /**
     * @var string
     *
     * @ORM\Column(name="quien_aporta", type="text", length=65535, nullable=false)
     */
    private $quienAporta;

    /**
     * @var string
     *
     * @ORM\Column(name="reconocimiento_logros", type="text", length=65535, nullable=false)
     */
    private $reconocimientoLogros;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1193';


}


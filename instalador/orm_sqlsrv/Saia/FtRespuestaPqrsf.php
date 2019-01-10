<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRespuestaPqrsf
 *
 * @ORM\Table(name="ft_respuesta_pqrsf")
 * @ORM\Entity
 */
class FtRespuestaPqrsf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_respuesta_pqrsf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftRespuestaPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_pqrsf", type="integer", nullable=false)
     */
    private $ftPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=false)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="text", length=65535, nullable=false)
     */
    private $comentario;

    /**
     * @var string
     *
     * @ORM\Column(name="para", type="string", length=255, nullable=false)
     */
    private $para;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="requiere_recogida", type="integer", nullable=true)
     */
    private $requiereRecogida = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_mensajeria", type="integer", nullable=true)
     */
    private $tipoMensajeria = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_digitales", type="string", length=255, nullable=true)
     */
    private $anexosDigitales;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_fisicos", type="text", length=65535, nullable=true)
     */
    private $anexosFisicos;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", length=65535, nullable=false)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="copia", type="text", length=65535, nullable=true)
     */
    private $copia;

    /**
     * @var string
     *
     * @ORM\Column(name="copiainterna", type="text", length=65535, nullable=true)
     */
    private $copiainterna;

    /**
     * @var string
     *
     * @ORM\Column(name="despedida", type="string", length=255, nullable=true)
     */
    private $despedida;

    /**
     * @var string
     *
     * @ORM\Column(name="destinos", type="text", length=65535, nullable=false)
     */
    private $destinos;

    /**
     * @var string
     *
     * @ORM\Column(name="iniciales", type="string", length=255, nullable=false)
     */
    private $iniciales;

    /**
     * @var string
     *
     * @ORM\Column(name="vercopiainterna", type="string", length=1, nullable=false)
     */
    private $vercopiainterna = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="expediente_serie", type="integer", nullable=true)
     */
    private $expedienteSerie;


}

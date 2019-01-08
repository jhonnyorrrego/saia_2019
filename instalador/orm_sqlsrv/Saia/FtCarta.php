<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtCarta
 *
 * @ORM\Table(name="ft_carta", indexes={@ORM\Index(name="i_ft_carta_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtCarta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_carta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftCarta;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", length=65535, nullable=false)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="copiainterna", type="text", length=65535, nullable=true)
     */
    private $copiainterna;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_carta", type="date", nullable=false)
     */
    private $fechaCarta;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_fisicos", type="text", length=65535, nullable=true)
     */
    private $anexosFisicos;

    /**
     * @var string
     *
     * @ORM\Column(name="iniciales", type="string", length=255, nullable=false)
     */
    private $iniciales;

    /**
     * @var string
     *
     * @ORM\Column(name="copia", type="text", length=65535, nullable=true)
     */
    private $copia;

    /**
     * @var string
     *
     * @ORM\Column(name="despedida", type="string", length=255, nullable=true)
     */
    private $despedida;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="destinos", type="text", length=65535, nullable=false)
     */
    private $destinos;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=false)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_digitales", type="string", length=255, nullable=true)
     */
    private $anexosDigitales;

    /**
     * @var string
     *
     * @ORM\Column(name="vercopiainterna", type="string", length=1, nullable=false)
     */
    private $vercopiainterna = '1';

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
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="varios_radicados", type="integer", nullable=false)
     */
    private $variosRadicados;

    /**
     * @var string
     *
     * @ORM\Column(name="idflujo", type="string", length=255, nullable=true)
     */
    private $idflujo = '4';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_copia_interna", type="integer", nullable=false)
     */
    private $tipoCopiaInterna = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="version_carta", type="string", length=10, nullable=false)
     */
    private $versionCarta;

    /**
     * @var integer
     *
     * @ORM\Column(name="email_aprobar", type="integer", nullable=false)
     */
    private $emailAprobar = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="expediente_serie", type="integer", nullable=true)
     */
    private $expedienteSerie;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_mensajeria", type="integer", nullable=true)
     */
    private $tipoMensajeria = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="requiere_recogida", type="integer", nullable=true)
     */
    private $requiereRecogida = '1';


}

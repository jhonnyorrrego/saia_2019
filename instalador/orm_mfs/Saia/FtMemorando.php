<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtMemorando
 *
 * @ORM\Table(name="ft_memorando", indexes={@ORM\Index(name="i_ft_memorando_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtMemorando
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_memorando", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftMemorando;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_memorando", type="datetime", nullable=false)
     */
    private $fechaMemorando;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="text", length=65535, nullable=false)
     */
    private $destino;

    /**
     * @var string
     *
     * @ORM\Column(name="copia", type="text", length=65535, nullable=true)
     */
    private $copia;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=false)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", length=65535, nullable=false)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="despedida", type="string", length=255, nullable=false)
     */
    private $despedida;

    /**
     * @var string
     *
     * @ORM\Column(name="iniciales", type="string", length=255, nullable=false)
     */
    private $iniciales;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_fisicos", type="text", length=65535, nullable=true)
     */
    private $anexosFisicos;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=true)
     */
    private $serieIdserie;

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
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="text", length=65535, nullable=true)
     */
    private $anexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="expediente_serie", type="string", length=255, nullable=true)
     */
    private $expedienteSerie;

    /**
     * @var integer
     *
     * @ORM\Column(name="email_aprobar", type="integer", nullable=false)
     */
    private $emailAprobar = '2';


}


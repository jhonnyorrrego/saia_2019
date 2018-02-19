<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtTemaPreguntaTrancrip
 *
 * @ORM\Table(name="FT_TEMA_PREGUNTA_TRANCRIP", indexes={@ORM\Index(name="i_ft_info_proceso_transcrip", columns={"FT_INFO_PROCESO_TRANSCRIP"})})
 * @ORM\Entity
 */
class FtTemaPreguntaTrancrip
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_TEMA_PREGUNTA_TRANCRIP", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_TEMA_PREGUNTA_TRANCRIP_IDFT", allocationSize=1, initialValue=1)
     */
    private $idftTemaPreguntaTrancrip;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_INFO_PROCESO_TRANSCRIP", type="integer", nullable=false)
     */
    private $ftInfoProcesoTranscrip;

    /**
     * @var string
     *
     * @ORM\Column(name="PREGUNTA_ENTREVISTA", type="string", length=255, nullable=false)
     */
    private $preguntaEntrevista;

    /**
     * @var string
     *
     * @ORM\Column(name="TEMA_ENTREVISTA", type="text", nullable=true)
     */
    private $temaEntrevista = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=true)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="TIEMPO_TRANSCURRIR", type="string", length=255, nullable=true)
     */
    private $tiempoTranscurrir;


}


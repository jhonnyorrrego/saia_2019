<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtValoracionPregunta
 *
 * @ORM\Table(name="FT_VALORACION_PREGUNTA")
 * @ORM\Entity
 */
class FtValoracionPregunta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_VALORACION_ASIGNADO", type="integer", nullable=false)
     */
    private $ftValoracionAsignado;

    /**
     * @var string
     *
     * @ORM\Column(name="PREGUNTA_VALORACION", type="string", length=255, nullable=false)
     */
    private $preguntaValoracion;

    /**
     * @var string
     *
     * @ORM\Column(name="TEMA_VALORACION", type="string", length=255, nullable=true)
     */
    private $temaValoracion;

    /**
     * @var string
     *
     * @ORM\Column(name="TIEMPO_INICIAL_AUDIO", type="string", length=255, nullable=true)
     */
    private $tiempoInicialAudio;

    /**
     * @var string
     *
     * @ORM\Column(name="TIEMPO_FINAL_AUDIO", type="string", length=255, nullable=true)
     */
    private $tiempoFinalAudio;

    /**
     * @var integer
     *
     * @ORM\Column(name="RELATO_PRIORIZADO", type="integer", nullable=true)
     */
    private $relatoPriorizado;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_VALORACION_PREGUNTA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_VALORACION_PREGUNTA_IDFT_VA", allocationSize=1, initialValue=1)
     */
    private $idftValoracionPregunta;


}


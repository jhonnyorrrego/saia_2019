<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemParticipantes
 *
 * @ORM\Table(name="ft_item_participantes")
 * @ORM\Entity
 */
class FtItemParticipantes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_participantes", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftItemParticipantes;

    /**
     * @var string
     *
     * @ORM\Column(name="asistencia_participa", type="string", length=255, nullable=true)
     */
    private $asistenciaParticipa;

    /**
     * @var integer
     *
     * @ORM\Column(name="enviar_copia", type="integer", nullable=true)
     */
    private $enviarCopia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_firmo", type="datetime", nullable=true)
     */
    private $fechaFirmo;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma_participantes", type="integer", nullable=true)
     */
    private $firmaParticipantes;

    /**
     * @var integer
     *
     * @ORM\Column(name="firmo", type="integer", nullable=true)
     */
    private $firmo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_acta_reunion", type="integer", nullable=false)
     */
    private $ftActaReunion;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="text", length=65535, nullable=true)
     */
    private $justificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion_impun", type="text", length=65535, nullable=true)
     */
    private $justificacionImpun;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_participantes", type="string", length=255, nullable=false)
     */
    private $nombreParticipantes;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntual", type="integer", nullable=true)
     */
    private $puntual;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;


}


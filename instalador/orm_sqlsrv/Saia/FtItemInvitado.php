<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemInvitado
 *
 * @ORM\Table(name="ft_item_invitado")
 * @ORM\Entity
 */
class FtItemInvitado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_invitado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftItemInvitado;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion_imp_ex", type="text", length=65535, nullable=true)
     */
    private $justificacionImpEx;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntual", type="integer", nullable=true)
     */
    private $puntual;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_acta_reunion", type="integer", nullable=false)
     */
    private $ftActaReunion;

    /**
     * @var string
     *
     * @ORM\Column(name="asistio", type="string", length=255, nullable=true)
     */
    private $asistio;

    /**
     * @var string
     *
     * @ORM\Column(name="invitado_externo", type="string", length=255, nullable=false)
     */
    private $invitadoExterno;

    /**
     * @var string
     *
     * @ORM\Column(name="invitado_interno", type="string", length=255, nullable=true)
     */
    private $invitadoInterno;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_invitado", type="integer", nullable=false)
     */
    private $tipoInvitado = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="text", length=65535, nullable=true)
     */
    private $justificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;


}


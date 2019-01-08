<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitudVacaciones
 *
 * @ORM\Table(name="ft_solicitud_vacaciones")
 * @ORM\Entity
 */
class FtSolicitudVacaciones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicitud_vacaciones", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSolicitudVacaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo_funcionario", type="string", length=255, nullable=false)
     */
    private $cargoFuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="dato_funcionario", type="string", length=255, nullable=true)
     */
    private $datoFuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="dias_disfrutados", type="integer", nullable=true)
     */
    private $diasDisfrutados;

    /**
     * @var integer
     *
     * @ORM\Column(name="dias_pagados", type="integer", nullable=true)
     */
    private $diasPagados;

    /**
     * @var integer
     *
     * @ORM\Column(name="dias_solicitados", type="integer", nullable=false)
     */
    private $diasSolicitados;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="date", nullable=false)
     */
    private $fechaIngreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=false)
     */
    private $fechaSolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_hoja_vida", type="integer", nullable=false)
     */
    private $ftHojaVida;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario", type="string", length=255, nullable=false)
     */
    private $funcionario;

    /**
     * @var string
     *
     * @ORM\Column(name="persona_autoriza", type="string", length=255, nullable=false)
     */
    private $personaAutoriza;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1230';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_solicitud", type="string", length=255, nullable=false)
     */
    private $tipoSolicitud;


}


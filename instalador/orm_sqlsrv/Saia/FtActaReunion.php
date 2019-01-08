<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtActaReunion
 *
 * @ORM\Table(name="ft_acta_reunion")
 * @ORM\Entity
 */
class FtActaReunion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_acta_reunion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftActaReunion;

    /**
     * @var string
     *
     * @ORM\Column(name="hora_prog", type="string", length=255, nullable=true)
     */
    private $horaProg;

    /**
     * @var string
     *
     * @ORM\Column(name="hora_ini_real", type="string", length=255, nullable=true)
     */
    private $horaIniReal;

    /**
     * @var integer
     *
     * @ORM\Column(name="causales", type="integer", nullable=true)
     */
    private $causales;

    /**
     * @var string
     *
     * @ORM\Column(name="hora_fin_prog", type="string", length=255, nullable=true)
     */
    private $horaFinProg;

    /**
     * @var string
     *
     * @ORM\Column(name="hora_fin_real", type="string", length=255, nullable=true)
     */
    private $horaFinReal;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_reunion", type="string", length=255, nullable=false)
     */
    private $tipoReunion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date", nullable=false)
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_comite", type="datetime", nullable=true)
     */
    private $fechaComite;

    /**
     * @var integer
     *
     * @ORM\Column(name="confidencialidad", type="integer", nullable=false)
     */
    private $confidencialidad = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="asistentes", type="string", length=255, nullable=true)
     */
    private $asistentes;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '42';

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="string", length=255, nullable=true)
     */
    private $justificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="soporte_acta", type="string", length=255, nullable=true)
     */
    private $soporteActa;

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


}


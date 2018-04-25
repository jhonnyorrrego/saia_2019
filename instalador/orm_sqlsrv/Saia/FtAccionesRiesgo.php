<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAccionesRiesgo
 *
 * @ORM\Table(name="ft_acciones_riesgo", indexes={@ORM\Index(name="i_ft_acciones_riesgo_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_acciones_riesgo_riesgos_pr", columns={"ft_riesgos_proceso"}), @ORM\Index(name="i_acciones_riesgo_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtAccionesRiesgo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_acciones_riesgo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftAccionesRiesgo;

    /**
     * @var string
     *
     * @ORM\Column(name="acciones_accion", type="text", length=65535, nullable=false)
     */
    private $accionesAccion;

    /**
     * @var string
     *
     * @ORM\Column(name="acciones_control", type="string", length=255, nullable=false)
     */
    private $accionesControl;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_accion", type="date", nullable=false)
     */
    private $fechaAccion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cumplimiento", type="date", nullable=false)
     */
    private $fechaCumplimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_riesgos_proceso", type="integer", nullable=false)
     */
    private $ftRiesgosProceso;

    /**
     * @var string
     *
     * @ORM\Column(name="indicador", type="text", length=65535, nullable=false)
     */
    private $indicador;

    /**
     * @var integer
     *
     * @ORM\Column(name="opcio_admin_riesgo", type="integer", nullable=false)
     */
    private $opcioAdminRiesgo;

    /**
     * @var string
     *
     * @ORM\Column(name="reponsables", type="text", length=65535, nullable=false)
     */
    private $reponsables;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '612';


}

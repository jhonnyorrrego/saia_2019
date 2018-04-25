<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitudPrestamos
 *
 * @ORM\Table(name="ft_solicitud_prestamos")
 * @ORM\Entity
 */
class FtSolicitudPrestamos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicitud_prestamos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSolicitudPrestamos;

    /**
     * @var integer
     *
     * @ORM\Column(name="accion_pres", type="integer", nullable=true)
     */
    private $accionPres;

    /**
     * @var integer
     *
     * @ORM\Column(name="accion_sol", type="integer", nullable=true)
     */
    private $accionSol;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=false)
     */
    private $anexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="codeudor", type="integer", nullable=false)
     */
    private $codeudor;

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
     * @ORM\Column(name="fecha_final", type="date", nullable=false)
     */
    private $fechaFinal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_pres", type="date", nullable=true)
     */
    private $fechaPres;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_sol", type="date", nullable=true)
     */
    private $fechaSol;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud_prest", type="date", nullable=false)
     */
    private $fechaSolicitudPrest;

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
     * @ORM\Column(name="funcionario_prest", type="string", length=255, nullable=false)
     */
    private $funcionarioPrest;

    /**
     * @var string
     *
     * @ORM\Column(name="func_registro", type="string", length=255, nullable=true)
     */
    private $funcRegistro;

    /**
     * @var string
     *
     * @ORM\Column(name="func_registro_sol", type="string", length=255, nullable=true)
     */
    private $funcRegistroSol;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_codeudor", type="integer", nullable=false)
     */
    private $idCodeudor;

    /**
     * @var integer
     *
     * @ORM\Column(name="motivo_prestamo", type="integer", nullable=false)
     */
    private $motivoPrestamo;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones_pres", type="text", length=65535, nullable=true)
     */
    private $observacionesPres;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones_sol", type="text", length=65535, nullable=true)
     */
    private $observacionesSol;

    /**
     * @var string
     *
     * @ORM\Column(name="pantalla_formato", type="string", length=255, nullable=false)
     */
    private $pantallaFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="periodicidad", type="integer", nullable=false)
     */
    private $periodicidad;

    /**
     * @var string
     *
     * @ORM\Column(name="plan_pago", type="text", length=65535, nullable=false)
     */
    private $planPago;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1227';

    /**
     * @var float
     *
     * @ORM\Column(name="valor_solicitado_prest", type="float", precision=10, scale=0, nullable=false)
     */
    private $valorSolicitadoPrest;


}


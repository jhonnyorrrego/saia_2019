<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRegistroIncapacidad
 *
 * @ORM\Table(name="ft_registro_incapacidad")
 * @ORM\Entity
 */
class FtRegistroIncapacidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_registro_incapacidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftRegistroIncapacidad;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo_inca", type="string", length=255, nullable=false)
     */
    private $cargoInca;

    /**
     * @var string
     *
     * @ORM\Column(name="copia_a", type="string", length=255, nullable=false)
     */
    private $copiaA;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="dias_incapacidad", type="integer", nullable=false)
     */
    private $diasIncapacidad;

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
     * @var string
     *
     * @ORM\Column(name="eps", type="string", length=255, nullable=false)
     */
    private $eps;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date", nullable=true)
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=false)
     */
    private $fechaFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ini", type="date", nullable=false)
     */
    private $fechaIni;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_pago_incapacidad", type="date", nullable=false)
     */
    private $fechaPagoIncapacidad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_radicacion", type="date", nullable=false)
     */
    private $fechaRadicacion;

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
     * @ORM\Column(name="funcionario_inca", type="string", length=255, nullable=false)
     */
    private $funcionarioInca;

    /**
     * @var string
     *
     * @ORM\Column(name="modo_pago", type="string", length=255, nullable=false)
     */
    private $modoPago;

    /**
     * @var integer
     *
     * @ORM\Column(name="motivo_incapacidad", type="integer", nullable=false)
     */
    private $motivoIncapacidad;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_recobro", type="text", length=65535, nullable=true)
     */
    private $observacionRecobro;

    /**
     * @var integer
     *
     * @ORM\Column(name="radicacion_recobro", type="integer", nullable=false)
     */
    private $radicacionRecobro;

    /**
     * @var string
     *
     * @ORM\Column(name="radicado_incapa", type="string", length=255, nullable=false)
     */
    private $radicadoIncapa;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1082';

    /**
     * @var integer
     *
     * @ORM\Column(name="valor_pagado", type="integer", nullable=false)
     */
    private $valorPagado;


}


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CfValidarRecepcion
 *
 * @ORM\Table(name="CF_VALIDAR_RECEPCION", indexes={@ORM\Index(name="cf_validar_recepcion_cedula", columns={"CEDULA"}), @ORM\Index(name="cf_validar_recepcion_sede", columns={"SEDE"}), @ORM\Index(name="cf_validar_recepcion_coda", columns={"CODA"}), @ORM\Index(name="cf_validar_recepcion_fecha", columns={"FECHA_RECEPCION"}), @ORM\Index(name="cf_validar_recepcion_ciu", columns={"CIU"})})
 * @ORM\Entity
 */
class CfValidarRecepcion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCF_VALIDAR_RECEPCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CF_VALIDAR_RECEPCION_IDCF_VALI", allocationSize=1, initialValue=1)
     */
    private $idcfValidarRecepcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_RECEPCION", type="date", nullable=true)
     */
    private $fechaRecepcion;

    /**
     * @var string
     *
     * @ORM\Column(name="CODA", type="string", length=255, nullable=true)
     */
    private $coda;

    /**
     * @var string
     *
     * @ORM\Column(name="CEDULA", type="string", length=255, nullable=true)
     */
    private $cedula;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRES", type="string", length=255, nullable=true)
     */
    private $nombres;

    /**
     * @var integer
     *
     * @ORM\Column(name="MUNICIPIO", type="integer", nullable=true)
     */
    private $municipio;

    /**
     * @var string
     *
     * @ORM\Column(name="CIU", type="string", length=255, nullable=true)
     */
    private $ciu;

    /**
     * @var integer
     *
     * @ORM\Column(name="SEDE", type="integer", nullable=true)
     */
    private $sede;

    /**
     * @var string
     *
     * @ORM\Column(name="PRIORIZADO", type="string", length=255, nullable=true)
     */
    private $priorizado;


}


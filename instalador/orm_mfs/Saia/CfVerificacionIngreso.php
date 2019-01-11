<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CfVerificacionIngreso
 *
 * @ORM\Table(name="cf_verificacion_ingreso")
 * @ORM\Entity
 */
class CfVerificacionIngreso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcf_verificacion_ingreso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcfVerificacionIngreso;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_actividad", type="string", length=255, nullable=false)
     */
    private $tipoActividad;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=true)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden_datos", type="integer", nullable=false)
     */
    private $ordenDatos;


}


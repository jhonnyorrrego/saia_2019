<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dependencia
 *
 * @ORM\Table(name="dependencia")
 * @ORM\Entity
 */
class Dependencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddependencia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=50, nullable=true)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="datetime", nullable=false)
     */
    private $fechaIngreso = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_tabla", type="string", length=255, nullable=true)
     */
    private $codigoTabla;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=20, nullable=true)
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion_dependencia", type="text", length=65535, nullable=true)
     */
    private $ubicacionDependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="blob", length=65535, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="orden", type="string", length=255, nullable=true)
     */
    private $orden;


}

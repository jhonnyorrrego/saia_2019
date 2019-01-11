<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Serie
 *
 * @ORM\Table(name="serie", indexes={@ORM\Index(name="cod_padre", columns={"cod_padre"}), @ORM\Index(name="Indice_llave_entidad", columns={"llave_entidad"}), @ORM\Index(name="serie_idserie_PK", columns={"idserie"})})
 * @ORM\Entity
 */
class Serie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idserie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idserie;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="dias_entrega", type="integer", nullable=false)
     */
    private $diasEntrega = '8';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=20, nullable=true)
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_entidad", type="integer", nullable=true)
     */
    private $tipoEntidad;

    /**
     * @var string
     *
     * @ORM\Column(name="llave_entidad", type="string", length=100, nullable=true)
     */
    private $llaveEntidad;

    /**
     * @var boolean
     *
     * @ORM\Column(name="retencion_gestion", type="boolean", nullable=false)
     */
    private $retencionGestion = '3';

    /**
     * @var boolean
     *
     * @ORM\Column(name="retencion_central", type="boolean", nullable=false)
     */
    private $retencionCentral = '5';

    /**
     * @var string
     *
     * @ORM\Column(name="conservacion", type="string", nullable=true)
     */
    private $conservacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="digitalizacion", type="boolean", nullable=true)
     */
    private $digitalizacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="seleccion", type="boolean", nullable=true)
     */
    private $seleccion;

    /**
     * @var string
     *
     * @ORM\Column(name="otro", type="string", length=255, nullable=true)
     */
    private $otro;

    /**
     * @var string
     *
     * @ORM\Column(name="procedimiento", type="text", length=65535, nullable=true)
     */
    private $procedimiento;

    /**
     * @var boolean
     *
     * @ORM\Column(name="copia", type="boolean", nullable=false)
     */
    private $copia = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo", type="boolean", nullable=false)
     */
    private $tipo = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="clase", type="boolean", nullable=true)
     */
    private $clase = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="categoria", type="integer", nullable=false)
     */
    private $categoria = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="orden", type="string", length=255, nullable=true)
     */
    private $orden;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_expediente", type="string", length=255, nullable=true)
     */
    private $tipoExpediente;

    /**
     * @var integer
     *
     * @ORM\Column(name="tvd", type="integer", nullable=true)
     */
    private $tvd = '0';


}


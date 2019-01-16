<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Serie
 *
 * @ORM\Table(name="serie", indexes={@ORM\Index(name="i_serie_tipo_entidad", columns={"tipo_entidad"}), @ORM\Index(name="i_serie_cod_padre", columns={"cod_padre"}), @ORM\Index(name="i_serie_llave_entidad", columns={"llave_entidad"})})
 * @ORM\Entity
 */
class Serie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idserie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idserie;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

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
     * @var integer
     *
     * @ORM\Column(name="retencion_gestion", type="integer", nullable=true)
     */
    private $retencionGestion = '3';

    /**
     * @var integer
     *
     * @ORM\Column(name="retencion_central", type="integer", nullable=true)
     */
    private $retencionCentral = '5';

    /**
     * @var string
     *
     * @ORM\Column(name="conservacion", type="string", length=11, nullable=true)
     */
    private $conservacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="digitalizacion", type="integer", nullable=true)
     */
    private $digitalizacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="seleccion", type="integer", nullable=true)
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
     * @ORM\Column(name="procedimiento", type="text", nullable=true)
     */
    private $procedimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="copia", type="integer", nullable=false)
     */
    private $copia = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="max_prestamo", type="integer", nullable=true)
     */
    private $maxPrestamo;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="clase", type="integer", nullable=true)
     */
    private $clase = '1';

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

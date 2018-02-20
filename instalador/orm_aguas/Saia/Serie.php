<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Serie
 *
 * @ORM\Table(name="SERIE", indexes={@ORM\Index(name="i_serie_tipo_entidad", columns={"TIPO_ENTIDAD"})})
 * @ORM\Entity
 */
class Serie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDSERIE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="SERIE_IDSERIE_seq", allocationSize=1, initialValue=1)
     */
    private $idserie;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="COD_PADRE", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIAS_ENTREGA", type="integer", nullable=false)
     */
    private $diasEntrega = '8';

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO", type="string", length=20, nullable=true)
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_ENTIDAD", type="integer", nullable=true)
     */
    private $tipoEntidad;

    /**
     * @var string
     *
     * @ORM\Column(name="LLAVE_ENTIDAD", type="string", length=100, nullable=true)
     */
    private $llaveEntidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="RETENCION_GESTION", type="integer", nullable=true)
     */
    private $retencionGestion = '3';

    /**
     * @var integer
     *
     * @ORM\Column(name="RETENCION_CENTRAL", type="integer", nullable=true)
     */
    private $retencionCentral = '5';

    /**
     * @var string
     *
     * @ORM\Column(name="CONSERVACION", type="string", length=11, nullable=true)
     */
    private $conservacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIGITALIZACION", type="integer", nullable=true)
     */
    private $digitalizacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="SELECCION", type="integer", nullable=true)
     */
    private $seleccion;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO", type="string", length=255, nullable=true)
     */
    private $otro;

    /**
     * @var string
     *
     * @ORM\Column(name="PROCEDIMIENTO", type="text", nullable=true)
     */
    private $procedimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="COPIA", type="integer", nullable=false)
     */
    private $copia = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="MAX_PRESTAMO", type="integer", nullable=true)
     */
    private $maxPrestamo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO", type="integer", nullable=false)
     */
    private $tipo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="CLASE", type="integer", nullable=true)
     */
    private $clase = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="CATEGORIA", type="integer", nullable=false)
     */
    private $categoria = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="ORDEN", type="string", length=255, nullable=true)
     */
    private $orden;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_EXPEDIENTE", type="string", length=255, nullable=true)
     */
    private $tipoExpediente;

    /**
     * @var integer
     *
     * @ORM\Column(name="TVD", type="integer", nullable=true)
     */
    private $tvd = '0';


}

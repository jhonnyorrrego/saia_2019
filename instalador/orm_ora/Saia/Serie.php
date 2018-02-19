<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Serie
 *
 * @ORM\Table(name="SERIE")
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
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="DIAS_ENTREGA", type="integer", nullable=true)
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
     * @ORM\Column(name="RETENCION_GESTION", type="integer", nullable=true)
     */
    private $retencionGestion;

    /**
     * @var integer
     *
     * @ORM\Column(name="RETENCION_CENTRAL", type="integer", nullable=true)
     */
    private $retencionCentral;

    /**
     * @var string
     *
     * @ORM\Column(name="CONSERVACION", type="string", length=4000, nullable=true)
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
     * @ORM\Column(name="COPIA", type="integer", nullable=true)
     */
    private $copia = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="MAX_PRESTAMO", type="integer", nullable=true)
     */
    private $maxPrestamo = '4';

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=1, nullable=true)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO", type="integer", nullable=true)
     */
    private $tipo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="CATEGORIA", type="integer", nullable=true)
     */
    private $categoria = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="FORMATO", type="string", length=255, nullable=true)
     */
    private $formato;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_ENTIDAD", type="integer", nullable=true)
     */
    private $tipoEntidad;

    /**
     * @var string
     *
     * @ORM\Column(name="LLAVE_ENTIDAD", type="string", length=255, nullable=true)
     */
    private $llaveEntidad;

    /**
     * @var string
     *
     * @ORM\Column(name="CLASE", type="string", length=5, nullable=true)
     */
    private $clase = '1';


}


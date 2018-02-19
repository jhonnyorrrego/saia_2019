<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dependencia
 *
 * @ORM\Table(name="DEPENDENCIA")
 * @ORM\Entity
 */
class Dependencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDEPENDENCIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DEPENDENCIA_IDDEPENDENCIA_seq", allocationSize=1, initialValue=1)
     */
    private $iddependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO", type="string", length=50, nullable=true)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INGRESO", type="date", nullable=true)
     */
    private $fechaIngreso = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="COD_PADRE", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO", type="integer", nullable=true)
     */
    private $tipo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_TABLA", type="string", length=11, nullable=true)
     */
    private $codigoTabla = '';

    /**
     * @var string
     *
     * @ORM\Column(name="LOGO", type="blob", nullable=true)
     */
    private $logo = 'EMPTY_BLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="DIRECCION", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="TELEFONO", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="UBICACION_DEPENDENCIA", type="string", length=255, nullable=true)
     */
    private $ubicacionDependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="EXTENSION", type="string", length=255, nullable=true)
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_ARBOL", type="string", length=255, nullable=true)
     */
    private $codigoArbol;


}

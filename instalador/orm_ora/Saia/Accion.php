<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accion
 *
 * @ORM\Table(name="ACCION")
 * @ORM\Entity
 */
class Accion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDACCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ACCION_IDACCION_seq", allocationSize=1, initialValue=1)
     */
    private $idaccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="CODIGO", type="integer", nullable=true)
     */
    private $codigo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=255, nullable=true)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=3000, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="FUNCION", type="string", length=255, nullable=true)
     */
    private $funcion;

    /**
     * @var string
     *
     * @ORM\Column(name="PARAMETROS", type="string", length=255, nullable=true)
     */
    private $parametros;

    /**
     * @var integer
     *
     * @ORM\Column(name="MODULO_IDMODULO", type="integer", nullable=true)
     */
    private $moduloIdmodulo;


}

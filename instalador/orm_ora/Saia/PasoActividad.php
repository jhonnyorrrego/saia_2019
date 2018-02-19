<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoActividad
 *
 * @ORM\Table(name="PASO_ACTIVIDAD")
 * @ORM\Entity
 */
class PasoActividad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_ACTIVIDAD", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_ACTIVIDAD_IDPASO_ACTIVIDA", allocationSize=1, initialValue=1)
     */
    private $idpasoActividad;

    /**
     * @var integer
     *
     * @ORM\Column(name="RESTRICTIVO", type="integer", nullable=true)
     */
    private $restrictivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="PASO_IDPASO", type="integer", nullable=true)
     */
    private $pasoIdpaso;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO", type="integer", nullable=true)
     */
    private $tipo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTIDAD_IDENTIDAD", type="integer", nullable=true)
     */
    private $entidadIdentidad;

    /**
     * @var string
     *
     * @ORM\Column(name="LLAVE_ENTIDAD", type="string", length=255, nullable=true)
     */
    private $llaveEntidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="PASO_OBJETO_IDPASO_OBJETO", type="integer", nullable=true)
     */
    private $pasoObjetoIdpasoObjeto;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACCION_IDACCION", type="integer", nullable=true)
     */
    private $accionIdaccion;

    /**
     * @var string
     *
     * @ORM\Column(name="FORMATO_IDFORMATO", type="string", length=255, nullable=true)
     */
    private $formatoIdformato;

    /**
     * @var integer
     *
     * @ORM\Column(name="PLAZO", type="integer", nullable=true)
     */
    private $plazo = '24';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_PLAZO", type="string", length=30, nullable=true)
     */
    private $tipoPlazo = 'hour';

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=255, nullable=true)
     */
    private $descripcion;


}


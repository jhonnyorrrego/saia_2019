<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoActividad
 *
 * @ORM\Table(name="PASO_ACTIVIDAD", indexes={@ORM\Index(name="i_paso_activid_formato_ante", columns={"FORMATO_ANTERIOR"}), @ORM\Index(name="i_paso_activid_paso_anterio", columns={"PASO_ANTERIOR"})})
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
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="RESTRICTIVO", type="integer", nullable=false)
     */
    private $restrictivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="PASO_IDPASO", type="integer", nullable=false)
     */
    private $pasoIdpaso;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO", type="integer", nullable=false)
     */
    private $tipo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTIDAD_IDENTIDAD", type="integer", nullable=false)
     */
    private $entidadIdentidad;

    /**
     * @var string
     *
     * @ORM\Column(name="LLAVE_ENTIDAD", type="string", length=255, nullable=false)
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
     * @ORM\Column(name="PLAZO", type="integer", nullable=false)
     */
    private $plazo = '24';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_PLAZO", type="string", length=30, nullable=false)
     */
    private $tipoPlazo = 'hour';

    /**
     * @var integer
     *
     * @ORM\Column(name="PASO_ANTERIOR", type="integer", nullable=true)
     */
    private $pasoAnterior;

    /**
     * @var string
     *
     * @ORM\Column(name="FORMATO_ANTERIOR", type="string", length=255, nullable=true)
     */
    private $formatoAnterior;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_CAMPOS_FORMATO", type="integer", nullable=true)
     */
    private $fkCamposFormato;


}

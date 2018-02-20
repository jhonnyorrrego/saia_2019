<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoActividad
 *
 * @ORM\Table(name="paso_actividad", indexes={@ORM\Index(name="i_paso_activid_formato_ante", columns={"formato_anterior"}), @ORM\Index(name="i_paso_activid_paso_anterio", columns={"paso_anterior"})})
 * @ORM\Entity
 */
class PasoActividad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_actividad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpasoActividad;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="restrictivo", type="integer", nullable=false)
     */
    private $restrictivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="paso_idpaso", type="integer", nullable=false)
     */
    private $pasoIdpaso;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="entidad_identidad", type="integer", nullable=false)
     */
    private $entidadIdentidad;

    /**
     * @var string
     *
     * @ORM\Column(name="llave_entidad", type="string", length=255, nullable=false)
     */
    private $llaveEntidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="paso_objeto_idpaso_objeto", type="integer", nullable=true)
     */
    private $pasoObjetoIdpasoObjeto;

    /**
     * @var integer
     *
     * @ORM\Column(name="accion_idaccion", type="integer", nullable=true)
     */
    private $accionIdaccion;

    /**
     * @var string
     *
     * @ORM\Column(name="formato_idformato", type="string", length=255, nullable=true)
     */
    private $formatoIdformato;

    /**
     * @var integer
     *
     * @ORM\Column(name="plazo", type="integer", nullable=false)
     */
    private $plazo = '24';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_plazo", type="string", length=30, nullable=false)
     */
    private $tipoPlazo = 'hour';

    /**
     * @var integer
     *
     * @ORM\Column(name="paso_anterior", type="integer", nullable=true)
     */
    private $pasoAnterior;

    /**
     * @var string
     *
     * @ORM\Column(name="formato_anterior", type="string", length=255, nullable=true)
     */
    private $formatoAnterior;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_campos_formato", type="integer", nullable=true)
     */
    private $fkCamposFormato;


}

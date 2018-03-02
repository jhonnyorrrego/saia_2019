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
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
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



    /**
     * Get idpasoActividad
     *
     * @return integer
     */
    public function getIdpasoActividad()
    {
        return $this->idpasoActividad;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return PasoActividad
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set restrictivo
     *
     * @param integer $restrictivo
     *
     * @return PasoActividad
     */
    public function setRestrictivo($restrictivo)
    {
        $this->restrictivo = $restrictivo;

        return $this;
    }

    /**
     * Get restrictivo
     *
     * @return integer
     */
    public function getRestrictivo()
    {
        return $this->restrictivo;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return PasoActividad
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set pasoIdpaso
     *
     * @param integer $pasoIdpaso
     *
     * @return PasoActividad
     */
    public function setPasoIdpaso($pasoIdpaso)
    {
        $this->pasoIdpaso = $pasoIdpaso;

        return $this;
    }

    /**
     * Get pasoIdpaso
     *
     * @return integer
     */
    public function getPasoIdpaso()
    {
        return $this->pasoIdpaso;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return PasoActividad
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return PasoActividad
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set entidadIdentidad
     *
     * @param integer $entidadIdentidad
     *
     * @return PasoActividad
     */
    public function setEntidadIdentidad($entidadIdentidad)
    {
        $this->entidadIdentidad = $entidadIdentidad;

        return $this;
    }

    /**
     * Get entidadIdentidad
     *
     * @return integer
     */
    public function getEntidadIdentidad()
    {
        return $this->entidadIdentidad;
    }

    /**
     * Set llaveEntidad
     *
     * @param string $llaveEntidad
     *
     * @return PasoActividad
     */
    public function setLlaveEntidad($llaveEntidad)
    {
        $this->llaveEntidad = $llaveEntidad;

        return $this;
    }

    /**
     * Get llaveEntidad
     *
     * @return string
     */
    public function getLlaveEntidad()
    {
        return $this->llaveEntidad;
    }

    /**
     * Set pasoObjetoIdpasoObjeto
     *
     * @param integer $pasoObjetoIdpasoObjeto
     *
     * @return PasoActividad
     */
    public function setPasoObjetoIdpasoObjeto($pasoObjetoIdpasoObjeto)
    {
        $this->pasoObjetoIdpasoObjeto = $pasoObjetoIdpasoObjeto;

        return $this;
    }

    /**
     * Get pasoObjetoIdpasoObjeto
     *
     * @return integer
     */
    public function getPasoObjetoIdpasoObjeto()
    {
        return $this->pasoObjetoIdpasoObjeto;
    }

    /**
     * Set accionIdaccion
     *
     * @param integer $accionIdaccion
     *
     * @return PasoActividad
     */
    public function setAccionIdaccion($accionIdaccion)
    {
        $this->accionIdaccion = $accionIdaccion;

        return $this;
    }

    /**
     * Get accionIdaccion
     *
     * @return integer
     */
    public function getAccionIdaccion()
    {
        return $this->accionIdaccion;
    }

    /**
     * Set formatoIdformato
     *
     * @param string $formatoIdformato
     *
     * @return PasoActividad
     */
    public function setFormatoIdformato($formatoIdformato)
    {
        $this->formatoIdformato = $formatoIdformato;

        return $this;
    }

    /**
     * Get formatoIdformato
     *
     * @return string
     */
    public function getFormatoIdformato()
    {
        return $this->formatoIdformato;
    }

    /**
     * Set plazo
     *
     * @param integer $plazo
     *
     * @return PasoActividad
     */
    public function setPlazo($plazo)
    {
        $this->plazo = $plazo;

        return $this;
    }

    /**
     * Get plazo
     *
     * @return integer
     */
    public function getPlazo()
    {
        return $this->plazo;
    }

    /**
     * Set tipoPlazo
     *
     * @param string $tipoPlazo
     *
     * @return PasoActividad
     */
    public function setTipoPlazo($tipoPlazo)
    {
        $this->tipoPlazo = $tipoPlazo;

        return $this;
    }

    /**
     * Get tipoPlazo
     *
     * @return string
     */
    public function getTipoPlazo()
    {
        return $this->tipoPlazo;
    }

    /**
     * Set pasoAnterior
     *
     * @param integer $pasoAnterior
     *
     * @return PasoActividad
     */
    public function setPasoAnterior($pasoAnterior)
    {
        $this->pasoAnterior = $pasoAnterior;

        return $this;
    }

    /**
     * Get pasoAnterior
     *
     * @return integer
     */
    public function getPasoAnterior()
    {
        return $this->pasoAnterior;
    }

    /**
     * Set formatoAnterior
     *
     * @param string $formatoAnterior
     *
     * @return PasoActividad
     */
    public function setFormatoAnterior($formatoAnterior)
    {
        $this->formatoAnterior = $formatoAnterior;

        return $this;
    }

    /**
     * Get formatoAnterior
     *
     * @return string
     */
    public function getFormatoAnterior()
    {
        return $this->formatoAnterior;
    }

    /**
     * Set fkCamposFormato
     *
     * @param integer $fkCamposFormato
     *
     * @return PasoActividad
     */
    public function setFkCamposFormato($fkCamposFormato)
    {
        $this->fkCamposFormato = $fkCamposFormato;

        return $this;
    }

    /**
     * Get fkCamposFormato
     *
     * @return integer
     */
    public function getFkCamposFormato()
    {
        return $this->fkCamposFormato;
    }
}

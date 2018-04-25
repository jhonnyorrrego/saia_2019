<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoCondicionalAdmin
 *
 * @ORM\Table(name="paso_condicional_admin")
 * @ORM\Entity
 */
class PasoCondicionalAdmin
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_condicional_admin", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpasoCondicionalAdmin;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_paso_condicional", type="integer", nullable=false)
     */
    private $fkPasoCondicional;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_campos_formato", type="integer", nullable=false)
     */
    private $fkCamposFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="comparacion", type="string", length=255, nullable=false)
     */
    private $comparacion;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=false)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="habilitar_pasos_si", type="string", length=255, nullable=false)
     */
    private $habilitarPasosSi;

    /**
     * @var string
     *
     * @ORM\Column(name="habilitar_pasos_no", type="string", length=255, nullable=false)
     */
    private $habilitarPasosNo;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;



    /**
     * Get idpasoCondicionalAdmin
     *
     * @return integer
     */
    public function getIdpasoCondicionalAdmin()
    {
        return $this->idpasoCondicionalAdmin;
    }

    /**
     * Set fkPasoCondicional
     *
     * @param integer $fkPasoCondicional
     *
     * @return PasoCondicionalAdmin
     */
    public function setFkPasoCondicional($fkPasoCondicional)
    {
        $this->fkPasoCondicional = $fkPasoCondicional;

        return $this;
    }

    /**
     * Get fkPasoCondicional
     *
     * @return integer
     */
    public function getFkPasoCondicional()
    {
        return $this->fkPasoCondicional;
    }

    /**
     * Set fkCamposFormato
     *
     * @param integer $fkCamposFormato
     *
     * @return PasoCondicionalAdmin
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

    /**
     * Set comparacion
     *
     * @param string $comparacion
     *
     * @return PasoCondicionalAdmin
     */
    public function setComparacion($comparacion)
    {
        $this->comparacion = $comparacion;

        return $this;
    }

    /**
     * Get comparacion
     *
     * @return string
     */
    public function getComparacion()
    {
        return $this->comparacion;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return PasoCondicionalAdmin
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set habilitarPasosSi
     *
     * @param string $habilitarPasosSi
     *
     * @return PasoCondicionalAdmin
     */
    public function setHabilitarPasosSi($habilitarPasosSi)
    {
        $this->habilitarPasosSi = $habilitarPasosSi;

        return $this;
    }

    /**
     * Get habilitarPasosSi
     *
     * @return string
     */
    public function getHabilitarPasosSi()
    {
        return $this->habilitarPasosSi;
    }

    /**
     * Set habilitarPasosNo
     *
     * @param string $habilitarPasosNo
     *
     * @return PasoCondicionalAdmin
     */
    public function setHabilitarPasosNo($habilitarPasosNo)
    {
        $this->habilitarPasosNo = $habilitarPasosNo;

        return $this;
    }

    /**
     * Get habilitarPasosNo
     *
     * @return string
     */
    public function getHabilitarPasosNo()
    {
        return $this->habilitarPasosNo;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return PasoCondicionalAdmin
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
     * Set estado
     *
     * @param integer $estado
     *
     * @return PasoCondicionalAdmin
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
}

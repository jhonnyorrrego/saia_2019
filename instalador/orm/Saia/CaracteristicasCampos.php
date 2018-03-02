<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaracteristicasCampos
 *
 * @ORM\Table(name="caracteristicas_campos")
 * @ORM\Entity
 */
class CaracteristicasCampos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcaracteristicas_campos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idcaracteristicasCampos;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_caracteristica", type="string", length=255, nullable=false)
     */
    private $tipoCaracteristica = 'validacion';

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="idcampos_formato", type="integer", nullable=false)
     */
    private $idcamposFormato;



    /**
     * Get idcaracteristicasCampos
     *
     * @return integer
     */
    public function getIdcaracteristicasCampos()
    {
        return $this->idcaracteristicasCampos;
    }

    /**
     * Set tipoCaracteristica
     *
     * @param string $tipoCaracteristica
     *
     * @return CaracteristicasCampos
     */
    public function setTipoCaracteristica($tipoCaracteristica)
    {
        $this->tipoCaracteristica = $tipoCaracteristica;

        return $this;
    }

    /**
     * Get tipoCaracteristica
     *
     * @return string
     */
    public function getTipoCaracteristica()
    {
        return $this->tipoCaracteristica;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return CaracteristicasCampos
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
     * Set idcamposFormato
     *
     * @param integer $idcamposFormato
     *
     * @return CaracteristicasCampos
     */
    public function setIdcamposFormato($idcamposFormato)
    {
        $this->idcamposFormato = $idcamposFormato;

        return $this;
    }

    /**
     * Get idcamposFormato
     *
     * @return integer
     */
    public function getIdcamposFormato()
    {
        return $this->idcamposFormato;
    }
}

<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnexosTmp
 *
 * @ORM\Table(name="anexos_tmp")
 * @ORM\Entity
 */
class AnexosTmp
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idanexos_tmp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idanexosTmp;

    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=255, nullable=false)
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=600, nullable=false)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=true)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="idformato", type="integer", nullable=false)
     */
    private $idformato;

    /**
     * @var integer
     *
     * @ORM\Column(name="idcampos_formato", type="integer", nullable=false)
     */
    private $idcamposFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_anexo", type="datetime", nullable=true)
     */
    private $fechaAnexo;



    /**
     * Get idanexosTmp
     *
     * @return integer
     */
    public function getIdanexosTmp()
    {
        return $this->idanexosTmp;
    }

    /**
     * Set uuid
     *
     * @param string $uuid
     *
     * @return AnexosTmp
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set ruta
     *
     * @param string $ruta
     *
     * @return AnexosTmp
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * Get ruta
     *
     * @return string
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return AnexosTmp
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return string
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return AnexosTmp
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set idformato
     *
     * @param integer $idformato
     *
     * @return AnexosTmp
     */
    public function setIdformato($idformato)
    {
        $this->idformato = $idformato;

        return $this;
    }

    /**
     * Get idformato
     *
     * @return integer
     */
    public function getIdformato()
    {
        return $this->idformato;
    }

    /**
     * Set idcamposFormato
     *
     * @param integer $idcamposFormato
     *
     * @return AnexosTmp
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

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return AnexosTmp
     */
    public function setFuncionarioIdfuncionario($funcionarioIdfuncionario)
    {
        $this->funcionarioIdfuncionario = $funcionarioIdfuncionario;

        return $this;
    }

    /**
     * Get funcionarioIdfuncionario
     *
     * @return integer
     */
    public function getFuncionarioIdfuncionario()
    {
        return $this->funcionarioIdfuncionario;
    }

    /**
     * Set fechaAnexo
     *
     * @param \DateTime $fechaAnexo
     *
     * @return AnexosTmp
     */
    public function setFechaAnexo($fechaAnexo)
    {
        $this->fechaAnexo = $fechaAnexo;

        return $this;
    }

    /**
     * Get fechaAnexo
     *
     * @return \DateTime
     */
    public function getFechaAnexo()
    {
        return $this->fechaAnexo;
    }
}

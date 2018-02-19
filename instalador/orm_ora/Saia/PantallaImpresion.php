<?php

namespace Saia;

/**
 * PantallaImpresion
 */
class PantallaImpresion
{
    /**
     * @var integer
     */
    private $idpantallaImpresion;

    /**
     * @var string
     */
    private $pdf;

    /**
     * @var integer
     */
    private $idregistro;

    /**
     * @var integer
     */
    private $fkIdpantalla;


    /**
     * Get idpantallaImpresion
     *
     * @return integer
     */
    public function getIdpantallaImpresion()
    {
        return $this->idpantallaImpresion;
    }

    /**
     * Set pdf
     *
     * @param string $pdf
     *
     * @return PantallaImpresion
     */
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * Get pdf
     *
     * @return string
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Set idregistro
     *
     * @param integer $idregistro
     *
     * @return PantallaImpresion
     */
    public function setIdregistro($idregistro)
    {
        $this->idregistro = $idregistro;

        return $this;
    }

    /**
     * Get idregistro
     *
     * @return integer
     */
    public function getIdregistro()
    {
        return $this->idregistro;
    }

    /**
     * Set fkIdpantalla
     *
     * @param integer $fkIdpantalla
     *
     * @return PantallaImpresion
     */
    public function setFkIdpantalla($fkIdpantalla)
    {
        $this->fkIdpantalla = $fkIdpantalla;

        return $this;
    }

    /**
     * Get fkIdpantalla
     *
     * @return integer
     */
    public function getFkIdpantalla()
    {
        return $this->fkIdpantalla;
    }
}


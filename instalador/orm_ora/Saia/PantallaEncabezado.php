<?php

namespace Saia;

/**
 * PantallaEncabezado
 */
class PantallaEncabezado
{
    /**
     * @var integer
     */
    private $idpantallaEncabezado;

    /**
     * @var integer
     */
    private $fkIdbpmni;

    /**
     * @var integer
     */
    private $fkIdbpmnTarea;

    /**
     * @var string
     */
    private $encabezado;

    /**
     * @var string
     */
    private $pie;

    /**
     * @var integer
     */
    private $fkIdpantalla;


    /**
     * Get idpantallaEncabezado
     *
     * @return integer
     */
    public function getIdpantallaEncabezado()
    {
        return $this->idpantallaEncabezado;
    }

    /**
     * Set fkIdbpmni
     *
     * @param integer $fkIdbpmni
     *
     * @return PantallaEncabezado
     */
    public function setFkIdbpmni($fkIdbpmni)
    {
        $this->fkIdbpmni = $fkIdbpmni;

        return $this;
    }

    /**
     * Get fkIdbpmni
     *
     * @return integer
     */
    public function getFkIdbpmni()
    {
        return $this->fkIdbpmni;
    }

    /**
     * Set fkIdbpmnTarea
     *
     * @param integer $fkIdbpmnTarea
     *
     * @return PantallaEncabezado
     */
    public function setFkIdbpmnTarea($fkIdbpmnTarea)
    {
        $this->fkIdbpmnTarea = $fkIdbpmnTarea;

        return $this;
    }

    /**
     * Get fkIdbpmnTarea
     *
     * @return integer
     */
    public function getFkIdbpmnTarea()
    {
        return $this->fkIdbpmnTarea;
    }

    /**
     * Set encabezado
     *
     * @param string $encabezado
     *
     * @return PantallaEncabezado
     */
    public function setEncabezado($encabezado)
    {
        $this->encabezado = $encabezado;

        return $this;
    }

    /**
     * Get encabezado
     *
     * @return string
     */
    public function getEncabezado()
    {
        return $this->encabezado;
    }

    /**
     * Set pie
     *
     * @param string $pie
     *
     * @return PantallaEncabezado
     */
    public function setPie($pie)
    {
        $this->pie = $pie;

        return $this;
    }

    /**
     * Get pie
     *
     * @return string
     */
    public function getPie()
    {
        return $this->pie;
    }

    /**
     * Set fkIdpantalla
     *
     * @param integer $fkIdpantalla
     *
     * @return PantallaEncabezado
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


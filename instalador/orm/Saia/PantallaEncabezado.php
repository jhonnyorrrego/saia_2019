<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaEncabezado
 *
 * @ORM\Table(name="pantalla_encabezado", indexes={@ORM\Index(name="i_pantalla_encab_fk_pant", columns={"fk_idpantalla"})})
 * @ORM\Entity
 */
class PantallaEncabezado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_encabezado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpantallaEncabezado;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idbpmni", type="integer", nullable=true)
     */
    private $fkIdbpmni = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idbpmn_tarea", type="integer", nullable=true)
     */
    private $fkIdbpmnTarea = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="encabezado", type="string", length=255, nullable=true)
     */
    private $encabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="pie", type="string", length=255, nullable=false)
     */
    private $pie;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idpantalla", type="integer", nullable=false)
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

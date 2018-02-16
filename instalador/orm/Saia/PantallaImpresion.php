<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaImpresion
 *
 * @ORM\Table(name="pantalla_impresion", indexes={@ORM\Index(name="i_pant_impresion_pantalla1", columns={"fk_idpantalla"})})
 * @ORM\Entity
 */
class PantallaImpresion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_impresion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpantallaImpresion;

    /**
     * @var string
     *
     * @ORM\Column(name="pdf", type="text", length=65535, nullable=true)
     */
    private $pdf;

    /**
     * @var integer
     *
     * @ORM\Column(name="idregistro", type="integer", nullable=false)
     */
    private $idregistro;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idpantalla", type="integer", nullable=false)
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

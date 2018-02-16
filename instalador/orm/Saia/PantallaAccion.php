<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaAccion
 *
 * @ORM\Table(name="pantalla_accion", indexes={@ORM\Index(name="fk_pantalla_accion_pantalla1_idx", columns={"fk_idpantalla"})})
 * @ORM\Entity
 */
class PantallaAccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_accion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpantallaAccion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_accion", type="integer", nullable=false)
     */
    private $tipoAccion = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idpantalla", type="integer", nullable=false)
     */
    private $fkIdpantalla;



    /**
     * Get idpantallaAccion
     *
     * @return integer
     */
    public function getIdpantallaAccion()
    {
        return $this->idpantallaAccion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return PantallaAccion
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return PantallaAccion
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
     * Set tipoAccion
     *
     * @param integer $tipoAccion
     *
     * @return PantallaAccion
     */
    public function setTipoAccion($tipoAccion)
    {
        $this->tipoAccion = $tipoAccion;

        return $this;
    }

    /**
     * Get tipoAccion
     *
     * @return integer
     */
    public function getTipoAccion()
    {
        return $this->tipoAccion;
    }

    /**
     * Set fkIdpantalla
     *
     * @param integer $fkIdpantalla
     *
     * @return PantallaAccion
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

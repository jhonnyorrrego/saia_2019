<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaEsquema
 *
 * @ORM\Table(name="pantalla_esquema")
 * @ORM\Entity
 */
class PantallaEsquema
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_esquema", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpantallaEsquema;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=false)
     */
    private $ruta;



    /**
     * Get idpantallaEsquema
     *
     * @return integer
     */
    public function getIdpantallaEsquema()
    {
        return $this->idpantallaEsquema;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return PantallaEsquema
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
     * Set ruta
     *
     * @param string $ruta
     *
     * @return PantallaEsquema
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
}

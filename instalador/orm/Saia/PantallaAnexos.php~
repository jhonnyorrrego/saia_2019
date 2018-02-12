<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaAnexos
 *
 * @ORM\Table(name="pantalla_anexos", indexes={@ORM\Index(name="fk_pantalla_anexos_pantalla1_idx", columns={"pantalla_idpantalla"}), @ORM\Index(name="i_pantalla_anexos_documento_", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class PantallaAnexos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_anexos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpantallaAnexos;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo", type="string", length=255, nullable=true)
     */
    private $anexo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="documento_iddocumento", type="string", length=255, nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="pantalla_idpantalla", type="integer", nullable=false)
     */
    private $pantallaIdpantalla;



    /**
     * Get idpantallaAnexos
     *
     * @return integer
     */
    public function getIdpantallaAnexos()
    {
        return $this->idpantallaAnexos;
    }

    /**
     * Set anexo
     *
     * @param string $anexo
     *
     * @return PantallaAnexos
     */
    public function setAnexo($anexo)
    {
        $this->anexo = $anexo;

        return $this;
    }

    /**
     * Get anexo
     *
     * @return string
     */
    public function getAnexo()
    {
        return $this->anexo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return PantallaAnexos
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
     * Set documentoIddocumento
     *
     * @param string $documentoIddocumento
     *
     * @return PantallaAnexos
     */
    public function setDocumentoIddocumento($documentoIddocumento)
    {
        $this->documentoIddocumento = $documentoIddocumento;

        return $this;
    }

    /**
     * Get documentoIddocumento
     *
     * @return string
     */
    public function getDocumentoIddocumento()
    {
        return $this->documentoIddocumento;
    }

    /**
     * Set pantallaIdpantalla
     *
     * @param integer $pantallaIdpantalla
     *
     * @return PantallaAnexos
     */
    public function setPantallaIdpantalla($pantallaIdpantalla)
    {
        $this->pantallaIdpantalla = $pantallaIdpantalla;

        return $this;
    }

    /**
     * Get pantallaIdpantalla
     *
     * @return integer
     */
    public function getPantallaIdpantalla()
    {
        return $this->pantallaIdpantalla;
    }
}

<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoActividadAnexo
 *
 * @ORM\Table(name="paso_actividad_anexo")
 * @ORM\Entity
 */
class PasoActividadAnexo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_actividad_anexo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpasoActividadAnexo;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

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
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="actividad_idactividad", type="integer", nullable=false)
     */
    private $actividadIdactividad;



    /**
     * Get idpasoActividadAnexo
     *
     * @return integer
     */
    public function getIdpasoActividadAnexo()
    {
        return $this->idpasoActividadAnexo;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return PasoActividadAnexo
     */
    public function setDocumentoIddocumento($documentoIddocumento)
    {
        $this->documentoIddocumento = $documentoIddocumento;

        return $this;
    }

    /**
     * Get documentoIddocumento
     *
     * @return integer
     */
    public function getDocumentoIddocumento()
    {
        return $this->documentoIddocumento;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return PasoActividadAnexo
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
     * @return PasoActividadAnexo
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return PasoActividadAnexo
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
     * Set actividadIdactividad
     *
     * @param integer $actividadIdactividad
     *
     * @return PasoActividadAnexo
     */
    public function setActividadIdactividad($actividadIdactividad)
    {
        $this->actividadIdactividad = $actividadIdactividad;

        return $this;
    }

    /**
     * Get actividadIdactividad
     *
     * @return integer
     */
    public function getActividadIdactividad()
    {
        return $this->actividadIdactividad;
    }
}

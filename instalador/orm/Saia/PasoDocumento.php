<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoDocumento
 *
 * @ORM\Table(name="paso_documento", indexes={@ORM\Index(name="i_paso_documento_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class PasoDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_documento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpasoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="paso_idpaso", type="integer", nullable=false)
     */
    private $pasoIdpaso;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_asignacion", type="datetime", nullable=false)
     */
    private $fechaAsignacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="diagram_iddiagram_instance", type="integer", nullable=false)
     */
    private $diagramIddiagramInstance;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_paso_documento", type="integer", nullable=false)
     */
    private $estadoPasoDocumento = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_limite", type="datetime", nullable=true)
     */
    private $fechaLimite;



    /**
     * Get idpasoDocumento
     *
     * @return integer
     */
    public function getIdpasoDocumento()
    {
        return $this->idpasoDocumento;
    }

    /**
     * Set pasoIdpaso
     *
     * @param integer $pasoIdpaso
     *
     * @return PasoDocumento
     */
    public function setPasoIdpaso($pasoIdpaso)
    {
        $this->pasoIdpaso = $pasoIdpaso;

        return $this;
    }

    /**
     * Get pasoIdpaso
     *
     * @return integer
     */
    public function getPasoIdpaso()
    {
        return $this->pasoIdpaso;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return PasoDocumento
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
     * Set fechaAsignacion
     *
     * @param \DateTime $fechaAsignacion
     *
     * @return PasoDocumento
     */
    public function setFechaAsignacion($fechaAsignacion)
    {
        $this->fechaAsignacion = $fechaAsignacion;

        return $this;
    }

    /**
     * Get fechaAsignacion
     *
     * @return \DateTime
     */
    public function getFechaAsignacion()
    {
        return $this->fechaAsignacion;
    }

    /**
     * Set diagramIddiagramInstance
     *
     * @param integer $diagramIddiagramInstance
     *
     * @return PasoDocumento
     */
    public function setDiagramIddiagramInstance($diagramIddiagramInstance)
    {
        $this->diagramIddiagramInstance = $diagramIddiagramInstance;

        return $this;
    }

    /**
     * Get diagramIddiagramInstance
     *
     * @return integer
     */
    public function getDiagramIddiagramInstance()
    {
        return $this->diagramIddiagramInstance;
    }

    /**
     * Set estadoPasoDocumento
     *
     * @param integer $estadoPasoDocumento
     *
     * @return PasoDocumento
     */
    public function setEstadoPasoDocumento($estadoPasoDocumento)
    {
        $this->estadoPasoDocumento = $estadoPasoDocumento;

        return $this;
    }

    /**
     * Get estadoPasoDocumento
     *
     * @return integer
     */
    public function getEstadoPasoDocumento()
    {
        return $this->estadoPasoDocumento;
    }

    /**
     * Set fechaLimite
     *
     * @param \DateTime $fechaLimite
     *
     * @return PasoDocumento
     */
    public function setFechaLimite($fechaLimite)
    {
        $this->fechaLimite = $fechaLimite;

        return $this;
    }

    /**
     * Get fechaLimite
     *
     * @return \DateTime
     */
    public function getFechaLimite()
    {
        return $this->fechaLimite;
    }
}

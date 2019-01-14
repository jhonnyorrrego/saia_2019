<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtVincularDocExpedie
 *
 * @ORM\Table(name="ft_vincular_doc_expedie", indexes={@ORM\Index(name="i_vincular_doc_expedie_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_vincular_doc_expedie_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtVincularDocExpedie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_vincular_doc_expedie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftVincularDocExpedie;

    /**
     * @var string
     *
     * @ORM\Column(name="serie_idserie", type="string", length=255, nullable=false)
     */
    private $serieIdserie = '7204';

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=false)
     */
    private $asunto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_documento", type="date", nullable=false)
     */
    private $fechaDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="fk_idexpediente", type="string", length=255, nullable=false)
     */
    private $fkIdexpediente;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftVincularDocExpedie
     *
     * @return integer
     */
    public function getIdftVincularDocExpedie()
    {
        return $this->idftVincularDocExpedie;
    }

    /**
     * Set serieIdserie
     *
     * @param string $serieIdserie
     *
     * @return FtVincularDocExpedie
     */
    public function setSerieIdserie($serieIdserie)
    {
        $this->serieIdserie = $serieIdserie;

        return $this;
    }

    /**
     * Get serieIdserie
     *
     * @return string
     */
    public function getSerieIdserie()
    {
        return $this->serieIdserie;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtVincularDocExpedie
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtVincularDocExpedie
     */
    public function setDependencia($dependencia)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return integer
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtVincularDocExpedie
     */
    public function setEncabezado($encabezado)
    {
        $this->encabezado = $encabezado;

        return $this;
    }

    /**
     * Get encabezado
     *
     * @return integer
     */
    public function getEncabezado()
    {
        return $this->encabezado;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtVincularDocExpedie
     */
    public function setFirma($firma)
    {
        $this->firma = $firma;

        return $this;
    }

    /**
     * Get firma
     *
     * @return integer
     */
    public function getFirma()
    {
        return $this->firma;
    }

    /**
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtVincularDocExpedie
     */
    public function setAnexos($anexos)
    {
        $this->anexos = $anexos;

        return $this;
    }

    /**
     * Get anexos
     *
     * @return string
     */
    public function getAnexos()
    {
        return $this->anexos;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     *
     * @return FtVincularDocExpedie
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set fechaDocumento
     *
     * @param \DateTime $fechaDocumento
     *
     * @return FtVincularDocExpedie
     */
    public function setFechaDocumento($fechaDocumento)
    {
        $this->fechaDocumento = $fechaDocumento;

        return $this;
    }

    /**
     * Get fechaDocumento
     *
     * @return \DateTime
     */
    public function getFechaDocumento()
    {
        return $this->fechaDocumento;
    }

    /**
     * Set fkIdexpediente
     *
     * @param string $fkIdexpediente
     *
     * @return FtVincularDocExpedie
     */
    public function setFkIdexpediente($fkIdexpediente)
    {
        $this->fkIdexpediente = $fkIdexpediente;

        return $this;
    }

    /**
     * Get fkIdexpediente
     *
     * @return string
     */
    public function getFkIdexpediente()
    {
        return $this->fkIdexpediente;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtVincularDocExpedie
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtVincularDocExpedie
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return integer
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }
}

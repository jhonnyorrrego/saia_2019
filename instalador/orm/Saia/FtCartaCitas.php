<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtCartaCitas
 *
 * @ORM\Table(name="ft_carta_citas", indexes={@ORM\Index(name="i_ft_carta_citas_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtCartaCitas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_carta_citas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftCartaCitas;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_citas_ejecutadas", type="integer", nullable=false)
     */
    private $ftCitasEjecutadas;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '979';

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
     * @ORM\Column(name="destino", type="string", length=255, nullable=false)
     */
    private $destino;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=false)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="citas_remitidas", type="string", length=255, nullable=true)
     */
    private $citasRemitidas;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftCartaCitas
     *
     * @return integer
     */
    public function getIdftCartaCitas()
    {
        return $this->idftCartaCitas;
    }

    /**
     * Set ftCitasEjecutadas
     *
     * @param integer $ftCitasEjecutadas
     *
     * @return FtCartaCitas
     */
    public function setFtCitasEjecutadas($ftCitasEjecutadas)
    {
        $this->ftCitasEjecutadas = $ftCitasEjecutadas;

        return $this;
    }

    /**
     * Get ftCitasEjecutadas
     *
     * @return integer
     */
    public function getFtCitasEjecutadas()
    {
        return $this->ftCitasEjecutadas;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtCartaCitas
     */
    public function setSerieIdserie($serieIdserie)
    {
        $this->serieIdserie = $serieIdserie;

        return $this;
    }

    /**
     * Get serieIdserie
     *
     * @return integer
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
     * @return FtCartaCitas
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
     * @return FtCartaCitas
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
     * @return FtCartaCitas
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
     * @return FtCartaCitas
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
     * Set destino
     *
     * @param string $destino
     *
     * @return FtCartaCitas
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return string
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     *
     * @return FtCartaCitas
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
     * Set citasRemitidas
     *
     * @param string $citasRemitidas
     *
     * @return FtCartaCitas
     */
    public function setCitasRemitidas($citasRemitidas)
    {
        $this->citasRemitidas = $citasRemitidas;

        return $this;
    }

    /**
     * Get citasRemitidas
     *
     * @return string
     */
    public function getCitasRemitidas()
    {
        return $this->citasRemitidas;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtCartaCitas
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

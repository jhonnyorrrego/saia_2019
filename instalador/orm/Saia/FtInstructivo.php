<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtInstructivo
 *
 * @ORM\Table(name="ft_instructivo", indexes={@ORM\Index(name="i_ft_instructivo_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_instructivo_proceso", columns={"ft_proceso"}), @ORM\Index(name="i_instructivo_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtInstructivo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_instructivo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftInstructivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1046';

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

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
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="soporte", type="string", length=255, nullable=false)
     */
    private $soporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_proceso", type="integer", nullable=false)
     */
    private $ftProceso;

    /**
     * @var string
     *
     * @ORM\Column(name="secretarias", type="string", length=255, nullable=true)
     */
    private $secretarias;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftInstructivo
     *
     * @return integer
     */
    public function getIdftInstructivo()
    {
        return $this->idftInstructivo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtInstructivo
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtInstructivo
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtInstructivo
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtInstructivo
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
     * @return FtInstructivo
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtInstructivo
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
     * Set estado
     *
     * @param string $estado
     *
     * @return FtInstructivo
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set soporte
     *
     * @param string $soporte
     *
     * @return FtInstructivo
     */
    public function setSoporte($soporte)
    {
        $this->soporte = $soporte;

        return $this;
    }

    /**
     * Get soporte
     *
     * @return string
     */
    public function getSoporte()
    {
        return $this->soporte;
    }

    /**
     * Set ftProceso
     *
     * @param integer $ftProceso
     *
     * @return FtInstructivo
     */
    public function setFtProceso($ftProceso)
    {
        $this->ftProceso = $ftProceso;

        return $this;
    }

    /**
     * Get ftProceso
     *
     * @return integer
     */
    public function getFtProceso()
    {
        return $this->ftProceso;
    }

    /**
     * Set secretarias
     *
     * @param string $secretarias
     *
     * @return FtInstructivo
     */
    public function setSecretarias($secretarias)
    {
        $this->secretarias = $secretarias;

        return $this;
    }

    /**
     * Get secretarias
     *
     * @return string
     */
    public function getSecretarias()
    {
        return $this->secretarias;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtInstructivo
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

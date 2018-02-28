<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtContextoExtrategico
 *
 * @ORM\Table(name="ft_contexto_extrategico", indexes={@ORM\Index(name="i_ft_contexto_extrategico_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_contexto_extrategico_proceso", columns={"ft_proceso"}), @ORM\Index(name="i_contexto_extrategico_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtContextoExtrategico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_contexto_extrategico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftContextoExtrategico;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_proceso", type="integer", nullable=false)
     */
    private $ftProceso;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '3038';

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
     * @var string
     *
     * @ORM\Column(name="proceso", type="string", length=255, nullable=false)
     */
    private $proceso;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivo", type="text", length=65535, nullable=false)
     */
    private $objetivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftContextoExtrategico
     *
     * @return integer
     */
    public function getIdftContextoExtrategico()
    {
        return $this->idftContextoExtrategico;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtContextoExtrategico
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
     * Set ftProceso
     *
     * @param integer $ftProceso
     *
     * @return FtContextoExtrategico
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtContextoExtrategico
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
     * @return FtContextoExtrategico
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
     * @return FtContextoExtrategico
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
     * Set proceso
     *
     * @param string $proceso
     *
     * @return FtContextoExtrategico
     */
    public function setProceso($proceso)
    {
        $this->proceso = $proceso;

        return $this;
    }

    /**
     * Get proceso
     *
     * @return string
     */
    public function getProceso()
    {
        return $this->proceso;
    }

    /**
     * Set objetivo
     *
     * @param string $objetivo
     *
     * @return FtContextoExtrategico
     */
    public function setObjetivo($objetivo)
    {
        $this->objetivo = $objetivo;

        return $this;
    }

    /**
     * Get objetivo
     *
     * @return string
     */
    public function getObjetivo()
    {
        return $this->objetivo;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtContextoExtrategico
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtContextoExtrategico
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

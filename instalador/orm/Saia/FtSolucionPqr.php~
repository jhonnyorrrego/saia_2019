<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolucionPqr
 *
 * @ORM\Table(name="ft_solucion_pqr", indexes={@ORM\Index(name="i_solucion_pqr_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_solucion_pqr_pqr", columns={"ft_pqr"}), @ORM\Index(name="i_solucion_pqr_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtSolucionPqr
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solucion_pqr", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSolucionPqr;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '853';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_pqr", type="integer", nullable=false)
     */
    private $ftPqr;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_avance", type="string", length=255, nullable=false)
     */
    private $estadoAvance;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

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
     * @var string
     *
     * @ORM\Column(name="anexo_formato", type="string", length=255, nullable=true)
     */
    private $anexoFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solucion", type="datetime", nullable=false)
     */
    private $fechaSolucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftSolucionPqr
     *
     * @return integer
     */
    public function getIdftSolucionPqr()
    {
        return $this->idftSolucionPqr;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolucionPqr
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
     * Set ftPqr
     *
     * @param integer $ftPqr
     *
     * @return FtSolucionPqr
     */
    public function setFtPqr($ftPqr)
    {
        $this->ftPqr = $ftPqr;

        return $this;
    }

    /**
     * Get ftPqr
     *
     * @return integer
     */
    public function getFtPqr()
    {
        return $this->ftPqr;
    }

    /**
     * Set estadoAvance
     *
     * @param string $estadoAvance
     *
     * @return FtSolucionPqr
     */
    public function setEstadoAvance($estadoAvance)
    {
        $this->estadoAvance = $estadoAvance;

        return $this;
    }

    /**
     * Get estadoAvance
     *
     * @return string
     */
    public function getEstadoAvance()
    {
        return $this->estadoAvance;
    }

    /**
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtSolucionPqr
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtSolucionPqr
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
     * @return FtSolucionPqr
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
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtSolucionPqr
     */
    public function setAnexoFormato($anexoFormato)
    {
        $this->anexoFormato = $anexoFormato;

        return $this;
    }

    /**
     * Get anexoFormato
     *
     * @return string
     */
    public function getAnexoFormato()
    {
        return $this->anexoFormato;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtSolucionPqr
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtSolucionPqr
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
     * Set fechaSolucion
     *
     * @param \DateTime $fechaSolucion
     *
     * @return FtSolucionPqr
     */
    public function setFechaSolucion($fechaSolucion)
    {
        $this->fechaSolucion = $fechaSolucion;

        return $this;
    }

    /**
     * Get fechaSolucion
     *
     * @return \DateTime
     */
    public function getFechaSolucion()
    {
        return $this->fechaSolucion;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtSolucionPqr
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

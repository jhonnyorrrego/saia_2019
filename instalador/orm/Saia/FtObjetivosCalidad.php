<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtObjetivosCalidad
 *
 * @ORM\Table(name="ft_objetivos_calidad", indexes={@ORM\Index(name="i_ft_objetivos_calidad_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtObjetivosCalidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_objetivos_calidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftObjetivosCalidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_proceso", type="integer", nullable=false)
     */
    private $ftProceso;

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
     * Get idftObjetivosCalidad
     *
     * @return integer
     */
    public function getIdftObjetivosCalidad()
    {
        return $this->idftObjetivosCalidad;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtObjetivosCalidad
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
     * Set ftProceso
     *
     * @param integer $ftProceso
     *
     * @return FtObjetivosCalidad
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtObjetivosCalidad
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
     * @return FtObjetivosCalidad
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
     * @return FtObjetivosCalidad
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
     * @return FtObjetivosCalidad
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
}

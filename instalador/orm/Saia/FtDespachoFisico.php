<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDespachoFisico
 *
 * @ORM\Table(name="ft_despacho_fisico", indexes={@ORM\Index(name="i_ft_despacho_fisico_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_despacho_fisico_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtDespachoFisico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_despacho_fisico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftDespachoFisico;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1214';

    /**
     * @var string
     *
     * @ORM\Column(name="docs_seleccionados", type="string", length=255, nullable=false)
     */
    private $docsSeleccionados;

    /**
     * @var integer
     *
     * @ORM\Column(name="mensajero", type="integer", nullable=true)
     */
    private $mensajero;

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
     * @ORM\Column(name="fecha_despacho", type="string", length=255, nullable=true)
     */
    private $fechaDespacho;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftDespachoFisico
     *
     * @return integer
     */
    public function getIdftDespachoFisico()
    {
        return $this->idftDespachoFisico;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtDespachoFisico
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
     * Set docsSeleccionados
     *
     * @param string $docsSeleccionados
     *
     * @return FtDespachoFisico
     */
    public function setDocsSeleccionados($docsSeleccionados)
    {
        $this->docsSeleccionados = $docsSeleccionados;

        return $this;
    }

    /**
     * Get docsSeleccionados
     *
     * @return string
     */
    public function getDocsSeleccionados()
    {
        return $this->docsSeleccionados;
    }

    /**
     * Set mensajero
     *
     * @param integer $mensajero
     *
     * @return FtDespachoFisico
     */
    public function setMensajero($mensajero)
    {
        $this->mensajero = $mensajero;

        return $this;
    }

    /**
     * Get mensajero
     *
     * @return integer
     */
    public function getMensajero()
    {
        return $this->mensajero;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtDespachoFisico
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
     * @return FtDespachoFisico
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
     * @return FtDespachoFisico
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
     * @return FtDespachoFisico
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
     * Set fechaDespacho
     *
     * @param string $fechaDespacho
     *
     * @return FtDespachoFisico
     */
    public function setFechaDespacho($fechaDespacho)
    {
        $this->fechaDespacho = $fechaDespacho;

        return $this;
    }

    /**
     * Get fechaDespacho
     *
     * @return string
     */
    public function getFechaDespacho()
    {
        return $this->fechaDespacho;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtDespachoFisico
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

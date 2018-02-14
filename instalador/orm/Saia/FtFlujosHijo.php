<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtFlujosHijo
 *
 * @ORM\Table(name="ft_flujos_hijo", indexes={@ORM\Index(name="i_ft_flujos_hijo_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtFlujosHijo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_flujos_hijo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftFlujosHijo;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

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
     * @ORM\Column(name="campo_tezxt", type="string", length=255, nullable=false)
     */
    private $campoTezxt;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1277';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_flujos_padre", type="integer", nullable=false)
     */
    private $ftFlujosPadre;



    /**
     * Get idftFlujosHijo
     *
     * @return integer
     */
    public function getIdftFlujosHijo()
    {
        return $this->idftFlujosHijo;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtFlujosHijo
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtFlujosHijo
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
     * @return FtFlujosHijo
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
     * @return FtFlujosHijo
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
     * Set campoTezxt
     *
     * @param string $campoTezxt
     *
     * @return FtFlujosHijo
     */
    public function setCampoTezxt($campoTezxt)
    {
        $this->campoTezxt = $campoTezxt;

        return $this;
    }

    /**
     * Get campoTezxt
     *
     * @return string
     */
    public function getCampoTezxt()
    {
        return $this->campoTezxt;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtFlujosHijo
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
     * Set estadoDocumento
     *
     * @param string $estadoDocumento
     *
     * @return FtFlujosHijo
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return string
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }

    /**
     * Set ftFlujosPadre
     *
     * @param integer $ftFlujosPadre
     *
     * @return FtFlujosHijo
     */
    public function setFtFlujosPadre($ftFlujosPadre)
    {
        $this->ftFlujosPadre = $ftFlujosPadre;

        return $this;
    }

    /**
     * Get ftFlujosPadre
     *
     * @return integer
     */
    public function getFtFlujosPadre()
    {
        return $this->ftFlujosPadre;
    }
}

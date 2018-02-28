<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtFlujosPadre
 *
 * @ORM\Table(name="ft_flujos_padre", indexes={@ORM\Index(name="i_ft_flujos_padre_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_flujos_padre_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtFlujosPadre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_flujos_padre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftFlujosPadre;

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
     * @var integer
     *
     * @ORM\Column(name="arbol_fun", type="integer", nullable=false)
     */
    private $arbolFun;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1276';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="campo_anexo", type="string", length=255, nullable=false)
     */
    private $campoAnexo;



    /**
     * Get idftFlujosPadre
     *
     * @return integer
     */
    public function getIdftFlujosPadre()
    {
        return $this->idftFlujosPadre;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtFlujosPadre
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
     * @return FtFlujosPadre
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
     * @return FtFlujosPadre
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
     * @return FtFlujosPadre
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
     * Set arbolFun
     *
     * @param integer $arbolFun
     *
     * @return FtFlujosPadre
     */
    public function setArbolFun($arbolFun)
    {
        $this->arbolFun = $arbolFun;

        return $this;
    }

    /**
     * Get arbolFun
     *
     * @return integer
     */
    public function getArbolFun()
    {
        return $this->arbolFun;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtFlujosPadre
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
     * @return FtFlujosPadre
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
     * Set campoAnexo
     *
     * @param string $campoAnexo
     *
     * @return FtFlujosPadre
     */
    public function setCampoAnexo($campoAnexo)
    {
        $this->campoAnexo = $campoAnexo;

        return $this;
    }

    /**
     * Get campoAnexo
     *
     * @return string
     */
    public function getCampoAnexo()
    {
        return $this->campoAnexo;
    }
}

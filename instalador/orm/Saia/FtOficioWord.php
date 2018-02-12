<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtOficioWord
 *
 * @ORM\Table(name="ft_oficio_word", indexes={@ORM\Index(name="i_oficio_word_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_oficio_word_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtOficioWord
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_oficio_word", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftOficioWord;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1332';

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_word", type="string", length=255, nullable=false)
     */
    private $anexoWord;

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
     * @ORM\Column(name="anexo_csv", type="string", length=255, nullable=true)
     */
    private $anexoCsv;



    /**
     * Get idftOficioWord
     *
     * @return integer
     */
    public function getIdftOficioWord()
    {
        return $this->idftOficioWord;
    }

    /**
     * Set estadoDocumento
     *
     * @param string $estadoDocumento
     *
     * @return FtOficioWord
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtOficioWord
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
     * Set anexoWord
     *
     * @param string $anexoWord
     *
     * @return FtOficioWord
     */
    public function setAnexoWord($anexoWord)
    {
        $this->anexoWord = $anexoWord;

        return $this;
    }

    /**
     * Get anexoWord
     *
     * @return string
     */
    public function getAnexoWord()
    {
        return $this->anexoWord;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtOficioWord
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
     * @return FtOficioWord
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
     * @return FtOficioWord
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
     * @return FtOficioWord
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
     * Set anexoCsv
     *
     * @param string $anexoCsv
     *
     * @return FtOficioWord
     */
    public function setAnexoCsv($anexoCsv)
    {
        $this->anexoCsv = $anexoCsv;

        return $this;
    }

    /**
     * Get anexoCsv
     *
     * @return string
     */
    public function getAnexoCsv()
    {
        return $this->anexoCsv;
    }
}

<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtVerificaInformacion
 *
 * @ORM\Table(name="ft_verifica_informacion")
 * @ORM\Entity
 */
class FtVerificaInformacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_verifica_informacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftVerificaInformacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_radica_doc_mercantil", type="integer", nullable=false)
     */
    private $ftRadicaDocMercantil;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '985';

    /**
     * @var string
     *
     * @ORM\Column(name="datos_remitente", type="string", length=255, nullable=true)
     */
    private $datosRemitente;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_folios_verifi", type="integer", nullable=true)
     */
    private $numeroFoliosVerifi;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha_inicial_verifi", type="string", length=255, nullable=true)
     */
    private $fechaInicialVerifi;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_verifica", type="text", length=65535, nullable=true)
     */
    private $observacionVerifica;

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
     * @ORM\Column(name="identifica_afiliado", type="string", length=255, nullable=true)
     */
    private $identificaAfiliado;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_folios_recibi", type="integer", nullable=true)
     */
    private $numeroFoliosRecibi;

    /**
     * @var integer
     *
     * @ORM\Column(name="presenta_inconsisten", type="integer", nullable=false)
     */
    private $presentaInconsisten;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_afiliado", type="string", length=255, nullable=true)
     */
    private $nombreAfiliado;

    /**
     * @var string
     *
     * @ORM\Column(name="fk_idexpediente", type="string", length=255, nullable=true)
     */
    private $fkIdexpediente;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftVerificaInformacion
     *
     * @return integer
     */
    public function getIdftVerificaInformacion()
    {
        return $this->idftVerificaInformacion;
    }

    /**
     * Set ftRadicaDocMercantil
     *
     * @param integer $ftRadicaDocMercantil
     *
     * @return FtVerificaInformacion
     */
    public function setFtRadicaDocMercantil($ftRadicaDocMercantil)
    {
        $this->ftRadicaDocMercantil = $ftRadicaDocMercantil;

        return $this;
    }

    /**
     * Get ftRadicaDocMercantil
     *
     * @return integer
     */
    public function getFtRadicaDocMercantil()
    {
        return $this->ftRadicaDocMercantil;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtVerificaInformacion
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
     * Set datosRemitente
     *
     * @param string $datosRemitente
     *
     * @return FtVerificaInformacion
     */
    public function setDatosRemitente($datosRemitente)
    {
        $this->datosRemitente = $datosRemitente;

        return $this;
    }

    /**
     * Get datosRemitente
     *
     * @return string
     */
    public function getDatosRemitente()
    {
        return $this->datosRemitente;
    }

    /**
     * Set numeroFoliosVerifi
     *
     * @param integer $numeroFoliosVerifi
     *
     * @return FtVerificaInformacion
     */
    public function setNumeroFoliosVerifi($numeroFoliosVerifi)
    {
        $this->numeroFoliosVerifi = $numeroFoliosVerifi;

        return $this;
    }

    /**
     * Get numeroFoliosVerifi
     *
     * @return integer
     */
    public function getNumeroFoliosVerifi()
    {
        return $this->numeroFoliosVerifi;
    }

    /**
     * Set fechaInicialVerifi
     *
     * @param string $fechaInicialVerifi
     *
     * @return FtVerificaInformacion
     */
    public function setFechaInicialVerifi($fechaInicialVerifi)
    {
        $this->fechaInicialVerifi = $fechaInicialVerifi;

        return $this;
    }

    /**
     * Get fechaInicialVerifi
     *
     * @return string
     */
    public function getFechaInicialVerifi()
    {
        return $this->fechaInicialVerifi;
    }

    /**
     * Set observacionVerifica
     *
     * @param string $observacionVerifica
     *
     * @return FtVerificaInformacion
     */
    public function setObservacionVerifica($observacionVerifica)
    {
        $this->observacionVerifica = $observacionVerifica;

        return $this;
    }

    /**
     * Get observacionVerifica
     *
     * @return string
     */
    public function getObservacionVerifica()
    {
        return $this->observacionVerifica;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtVerificaInformacion
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
     * @return FtVerificaInformacion
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
     * @return FtVerificaInformacion
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
     * @return FtVerificaInformacion
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
     * Set identificaAfiliado
     *
     * @param string $identificaAfiliado
     *
     * @return FtVerificaInformacion
     */
    public function setIdentificaAfiliado($identificaAfiliado)
    {
        $this->identificaAfiliado = $identificaAfiliado;

        return $this;
    }

    /**
     * Get identificaAfiliado
     *
     * @return string
     */
    public function getIdentificaAfiliado()
    {
        return $this->identificaAfiliado;
    }

    /**
     * Set numeroFoliosRecibi
     *
     * @param integer $numeroFoliosRecibi
     *
     * @return FtVerificaInformacion
     */
    public function setNumeroFoliosRecibi($numeroFoliosRecibi)
    {
        $this->numeroFoliosRecibi = $numeroFoliosRecibi;

        return $this;
    }

    /**
     * Get numeroFoliosRecibi
     *
     * @return integer
     */
    public function getNumeroFoliosRecibi()
    {
        return $this->numeroFoliosRecibi;
    }

    /**
     * Set presentaInconsisten
     *
     * @param integer $presentaInconsisten
     *
     * @return FtVerificaInformacion
     */
    public function setPresentaInconsisten($presentaInconsisten)
    {
        $this->presentaInconsisten = $presentaInconsisten;

        return $this;
    }

    /**
     * Get presentaInconsisten
     *
     * @return integer
     */
    public function getPresentaInconsisten()
    {
        return $this->presentaInconsisten;
    }

    /**
     * Set nombreAfiliado
     *
     * @param string $nombreAfiliado
     *
     * @return FtVerificaInformacion
     */
    public function setNombreAfiliado($nombreAfiliado)
    {
        $this->nombreAfiliado = $nombreAfiliado;

        return $this;
    }

    /**
     * Get nombreAfiliado
     *
     * @return string
     */
    public function getNombreAfiliado()
    {
        return $this->nombreAfiliado;
    }

    /**
     * Set fkIdexpediente
     *
     * @param string $fkIdexpediente
     *
     * @return FtVerificaInformacion
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtVerificaInformacion
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

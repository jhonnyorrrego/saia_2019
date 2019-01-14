<?php

namespace Saia;

/**
 * FtRegistroCliente
 */
class FtRegistroCliente
{
    /**
     * @var integer
     */
    private $idftRegistroCliente;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $nombreCliente;

    /**
     * @var string
     */
    private $descripcionOrigenContacto;

    /**
     * @var string
     */
    private $paginaWeb;

    /**
     * @var integer
     */
    private $estadoCliente;

    /**
     * @var string
     */
    private $sector;

    /**
     * @var string
     */
    private $nombreContacto1;

    /**
     * @var string
     */
    private $cargoContacto1;

    /**
     * @var string
     */
    private $celularContacto1;

    /**
     * @var string
     */
    private $emailContacto1;

    /**
     * @var string
     */
    private $nombreContacto2;

    /**
     * @var string
     */
    private $cargoContacto2;

    /**
     * @var string
     */
    private $telefonoContacto1;

    /**
     * @var string
     */
    private $telefonoContacto2;

    /**
     * @var string
     */
    private $celularContacto2;

    /**
     * @var string
     */
    private $emailContacto2;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var integer
     */
    private $dependencia;

    /**
     * @var integer
     */
    private $encabezado;

    /**
     * @var integer
     */
    private $firma;

    /**
     * @var string
     */
    private $responsable;

    /**
     * @var string
     */
    private $anexoFormato;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftRegistroCliente
     *
     * @return integer
     */
    public function getIdftRegistroCliente()
    {
        return $this->idftRegistroCliente;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtRegistroCliente
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
     * Set nombreCliente
     *
     * @param integer $nombreCliente
     *
     * @return FtRegistroCliente
     */
    public function setNombreCliente($nombreCliente)
    {
        $this->nombreCliente = $nombreCliente;

        return $this;
    }

    /**
     * Get nombreCliente
     *
     * @return integer
     */
    public function getNombreCliente()
    {
        return $this->nombreCliente;
    }

    /**
     * Set descripcionOrigenContacto
     *
     * @param string $descripcionOrigenContacto
     *
     * @return FtRegistroCliente
     */
    public function setDescripcionOrigenContacto($descripcionOrigenContacto)
    {
        $this->descripcionOrigenContacto = $descripcionOrigenContacto;

        return $this;
    }

    /**
     * Get descripcionOrigenContacto
     *
     * @return string
     */
    public function getDescripcionOrigenContacto()
    {
        return $this->descripcionOrigenContacto;
    }

    /**
     * Set paginaWeb
     *
     * @param string $paginaWeb
     *
     * @return FtRegistroCliente
     */
    public function setPaginaWeb($paginaWeb)
    {
        $this->paginaWeb = $paginaWeb;

        return $this;
    }

    /**
     * Get paginaWeb
     *
     * @return string
     */
    public function getPaginaWeb()
    {
        return $this->paginaWeb;
    }

    /**
     * Set estadoCliente
     *
     * @param integer $estadoCliente
     *
     * @return FtRegistroCliente
     */
    public function setEstadoCliente($estadoCliente)
    {
        $this->estadoCliente = $estadoCliente;

        return $this;
    }

    /**
     * Get estadoCliente
     *
     * @return integer
     */
    public function getEstadoCliente()
    {
        return $this->estadoCliente;
    }

    /**
     * Set sector
     *
     * @param string $sector
     *
     * @return FtRegistroCliente
     */
    public function setSector($sector)
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * Get sector
     *
     * @return string
     */
    public function getSector()
    {
        return $this->sector;
    }

    /**
     * Set nombreContacto1
     *
     * @param string $nombreContacto1
     *
     * @return FtRegistroCliente
     */
    public function setNombreContacto1($nombreContacto1)
    {
        $this->nombreContacto1 = $nombreContacto1;

        return $this;
    }

    /**
     * Get nombreContacto1
     *
     * @return string
     */
    public function getNombreContacto1()
    {
        return $this->nombreContacto1;
    }

    /**
     * Set cargoContacto1
     *
     * @param string $cargoContacto1
     *
     * @return FtRegistroCliente
     */
    public function setCargoContacto1($cargoContacto1)
    {
        $this->cargoContacto1 = $cargoContacto1;

        return $this;
    }

    /**
     * Get cargoContacto1
     *
     * @return string
     */
    public function getCargoContacto1()
    {
        return $this->cargoContacto1;
    }

    /**
     * Set celularContacto1
     *
     * @param string $celularContacto1
     *
     * @return FtRegistroCliente
     */
    public function setCelularContacto1($celularContacto1)
    {
        $this->celularContacto1 = $celularContacto1;

        return $this;
    }

    /**
     * Get celularContacto1
     *
     * @return string
     */
    public function getCelularContacto1()
    {
        return $this->celularContacto1;
    }

    /**
     * Set emailContacto1
     *
     * @param string $emailContacto1
     *
     * @return FtRegistroCliente
     */
    public function setEmailContacto1($emailContacto1)
    {
        $this->emailContacto1 = $emailContacto1;

        return $this;
    }

    /**
     * Get emailContacto1
     *
     * @return string
     */
    public function getEmailContacto1()
    {
        return $this->emailContacto1;
    }

    /**
     * Set nombreContacto2
     *
     * @param string $nombreContacto2
     *
     * @return FtRegistroCliente
     */
    public function setNombreContacto2($nombreContacto2)
    {
        $this->nombreContacto2 = $nombreContacto2;

        return $this;
    }

    /**
     * Get nombreContacto2
     *
     * @return string
     */
    public function getNombreContacto2()
    {
        return $this->nombreContacto2;
    }

    /**
     * Set cargoContacto2
     *
     * @param string $cargoContacto2
     *
     * @return FtRegistroCliente
     */
    public function setCargoContacto2($cargoContacto2)
    {
        $this->cargoContacto2 = $cargoContacto2;

        return $this;
    }

    /**
     * Get cargoContacto2
     *
     * @return string
     */
    public function getCargoContacto2()
    {
        return $this->cargoContacto2;
    }

    /**
     * Set telefonoContacto1
     *
     * @param string $telefonoContacto1
     *
     * @return FtRegistroCliente
     */
    public function setTelefonoContacto1($telefonoContacto1)
    {
        $this->telefonoContacto1 = $telefonoContacto1;

        return $this;
    }

    /**
     * Get telefonoContacto1
     *
     * @return string
     */
    public function getTelefonoContacto1()
    {
        return $this->telefonoContacto1;
    }

    /**
     * Set telefonoContacto2
     *
     * @param string $telefonoContacto2
     *
     * @return FtRegistroCliente
     */
    public function setTelefonoContacto2($telefonoContacto2)
    {
        $this->telefonoContacto2 = $telefonoContacto2;

        return $this;
    }

    /**
     * Get telefonoContacto2
     *
     * @return string
     */
    public function getTelefonoContacto2()
    {
        return $this->telefonoContacto2;
    }

    /**
     * Set celularContacto2
     *
     * @param string $celularContacto2
     *
     * @return FtRegistroCliente
     */
    public function setCelularContacto2($celularContacto2)
    {
        $this->celularContacto2 = $celularContacto2;

        return $this;
    }

    /**
     * Get celularContacto2
     *
     * @return string
     */
    public function getCelularContacto2()
    {
        return $this->celularContacto2;
    }

    /**
     * Set emailContacto2
     *
     * @param string $emailContacto2
     *
     * @return FtRegistroCliente
     */
    public function setEmailContacto2($emailContacto2)
    {
        $this->emailContacto2 = $emailContacto2;

        return $this;
    }

    /**
     * Get emailContacto2
     *
     * @return string
     */
    public function getEmailContacto2()
    {
        return $this->emailContacto2;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtRegistroCliente
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
     * @return FtRegistroCliente
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
     * @return FtRegistroCliente
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
     * @return FtRegistroCliente
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
     * Set responsable
     *
     * @param string $responsable
     *
     * @return FtRegistroCliente
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtRegistroCliente
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtRegistroCliente
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


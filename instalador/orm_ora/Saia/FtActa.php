<?php

namespace Saia;

/**
 * FtActa
 */
class FtActa
{
    /**
     * @var integer
     */
    private $idftActa;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $ajendaReunion;

    /**
     * @var string
     */
    private $anexoFormato;

    /**
     * @var string
     */
    private $asistentes;

    /**
     * @var integer
     */
    private $caracter;

    /**
     * @var string
     */
    private $codigo;

    /**
     * @var string
     */
    private $desarrolloReunion;

    /**
     * @var \DateTime
     */
    private $fechaProximaReunion;

    /**
     * @var \DateTime
     */
    private $fechaReunion;

    /**
     * @var string
     */
    private $firmaPresidente;

    /**
     * @var integer
     */
    private $firmaSecretaria;

    /**
     * @var string
     */
    private $grupoReunido;

    /**
     * @var string
     */
    private $hora;

    /**
     * @var string
     */
    private $invitados;

    /**
     * @var string
     */
    private $lugarProximaReunion;

    /**
     * @var string
     */
    private $numeroActa;

    /**
     * @var string
     */
    private $objetivoReunion;

    /**
     * @var string
     */
    private $ausentes;

    /**
     * @var integer
     */
    private $tareas;

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
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftActa
     *
     * @return integer
     */
    public function getIdftActa()
    {
        return $this->idftActa;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtActa
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
     * Set ajendaReunion
     *
     * @param string $ajendaReunion
     *
     * @return FtActa
     */
    public function setAjendaReunion($ajendaReunion)
    {
        $this->ajendaReunion = $ajendaReunion;

        return $this;
    }

    /**
     * Get ajendaReunion
     *
     * @return string
     */
    public function getAjendaReunion()
    {
        return $this->ajendaReunion;
    }

    /**
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtActa
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
     * Set asistentes
     *
     * @param string $asistentes
     *
     * @return FtActa
     */
    public function setAsistentes($asistentes)
    {
        $this->asistentes = $asistentes;

        return $this;
    }

    /**
     * Get asistentes
     *
     * @return string
     */
    public function getAsistentes()
    {
        return $this->asistentes;
    }

    /**
     * Set caracter
     *
     * @param integer $caracter
     *
     * @return FtActa
     */
    public function setCaracter($caracter)
    {
        $this->caracter = $caracter;

        return $this;
    }

    /**
     * Get caracter
     *
     * @return integer
     */
    public function getCaracter()
    {
        return $this->caracter;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return FtActa
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set desarrolloReunion
     *
     * @param string $desarrolloReunion
     *
     * @return FtActa
     */
    public function setDesarrolloReunion($desarrolloReunion)
    {
        $this->desarrolloReunion = $desarrolloReunion;

        return $this;
    }

    /**
     * Get desarrolloReunion
     *
     * @return string
     */
    public function getDesarrolloReunion()
    {
        return $this->desarrolloReunion;
    }

    /**
     * Set fechaProximaReunion
     *
     * @param \DateTime $fechaProximaReunion
     *
     * @return FtActa
     */
    public function setFechaProximaReunion($fechaProximaReunion)
    {
        $this->fechaProximaReunion = $fechaProximaReunion;

        return $this;
    }

    /**
     * Get fechaProximaReunion
     *
     * @return \DateTime
     */
    public function getFechaProximaReunion()
    {
        return $this->fechaProximaReunion;
    }

    /**
     * Set fechaReunion
     *
     * @param \DateTime $fechaReunion
     *
     * @return FtActa
     */
    public function setFechaReunion($fechaReunion)
    {
        $this->fechaReunion = $fechaReunion;

        return $this;
    }

    /**
     * Get fechaReunion
     *
     * @return \DateTime
     */
    public function getFechaReunion()
    {
        return $this->fechaReunion;
    }

    /**
     * Set firmaPresidente
     *
     * @param string $firmaPresidente
     *
     * @return FtActa
     */
    public function setFirmaPresidente($firmaPresidente)
    {
        $this->firmaPresidente = $firmaPresidente;

        return $this;
    }

    /**
     * Get firmaPresidente
     *
     * @return string
     */
    public function getFirmaPresidente()
    {
        return $this->firmaPresidente;
    }

    /**
     * Set firmaSecretaria
     *
     * @param integer $firmaSecretaria
     *
     * @return FtActa
     */
    public function setFirmaSecretaria($firmaSecretaria)
    {
        $this->firmaSecretaria = $firmaSecretaria;

        return $this;
    }

    /**
     * Get firmaSecretaria
     *
     * @return integer
     */
    public function getFirmaSecretaria()
    {
        return $this->firmaSecretaria;
    }

    /**
     * Set grupoReunido
     *
     * @param string $grupoReunido
     *
     * @return FtActa
     */
    public function setGrupoReunido($grupoReunido)
    {
        $this->grupoReunido = $grupoReunido;

        return $this;
    }

    /**
     * Get grupoReunido
     *
     * @return string
     */
    public function getGrupoReunido()
    {
        return $this->grupoReunido;
    }

    /**
     * Set hora
     *
     * @param string $hora
     *
     * @return FtActa
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return string
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set invitados
     *
     * @param string $invitados
     *
     * @return FtActa
     */
    public function setInvitados($invitados)
    {
        $this->invitados = $invitados;

        return $this;
    }

    /**
     * Get invitados
     *
     * @return string
     */
    public function getInvitados()
    {
        return $this->invitados;
    }

    /**
     * Set lugarProximaReunion
     *
     * @param string $lugarProximaReunion
     *
     * @return FtActa
     */
    public function setLugarProximaReunion($lugarProximaReunion)
    {
        $this->lugarProximaReunion = $lugarProximaReunion;

        return $this;
    }

    /**
     * Get lugarProximaReunion
     *
     * @return string
     */
    public function getLugarProximaReunion()
    {
        return $this->lugarProximaReunion;
    }

    /**
     * Set numeroActa
     *
     * @param string $numeroActa
     *
     * @return FtActa
     */
    public function setNumeroActa($numeroActa)
    {
        $this->numeroActa = $numeroActa;

        return $this;
    }

    /**
     * Get numeroActa
     *
     * @return string
     */
    public function getNumeroActa()
    {
        return $this->numeroActa;
    }

    /**
     * Set objetivoReunion
     *
     * @param string $objetivoReunion
     *
     * @return FtActa
     */
    public function setObjetivoReunion($objetivoReunion)
    {
        $this->objetivoReunion = $objetivoReunion;

        return $this;
    }

    /**
     * Get objetivoReunion
     *
     * @return string
     */
    public function getObjetivoReunion()
    {
        return $this->objetivoReunion;
    }

    /**
     * Set ausentes
     *
     * @param string $ausentes
     *
     * @return FtActa
     */
    public function setAusentes($ausentes)
    {
        $this->ausentes = $ausentes;

        return $this;
    }

    /**
     * Get ausentes
     *
     * @return string
     */
    public function getAusentes()
    {
        return $this->ausentes;
    }

    /**
     * Set tareas
     *
     * @param integer $tareas
     *
     * @return FtActa
     */
    public function setTareas($tareas)
    {
        $this->tareas = $tareas;

        return $this;
    }

    /**
     * Get tareas
     *
     * @return integer
     */
    public function getTareas()
    {
        return $this->tareas;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtActa
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
     * @return FtActa
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
     * @return FtActa
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
     * @return FtActa
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
     * @return FtActa
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


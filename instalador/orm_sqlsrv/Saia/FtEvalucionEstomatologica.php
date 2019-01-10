<?php

namespace Saia;

/**
 * FtEvalucionEstomatologica
 */
class FtEvalucionEstomatologica
{
    /**
     * @var integer
     */
    private $idftEvalucionEstomatologica;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $procesoOdontologico;

    /**
     * @var string
     */
    private $cualProcedimiento;

    /**
     * @var \DateTime
     */
    private $ultimaVisita;

    /**
     * @var string
     */
    private $tiposDeLimpieza;

    /**
     * @var integer
     */
    private $labios;

    /**
     * @var integer
     */
    private $lengua;

    /**
     * @var integer
     */
    private $paladar;

    /**
     * @var integer
     */
    private $carrillos;

    /**
     * @var integer
     */
    private $pisoDeBoca;

    /**
     * @var integer
     */
    private $frenillos;

    /**
     * @var integer
     */
    private $maxilares;

    /**
     * @var integer
     */
    private $funcionOclusion;

    /**
     * @var integer
     */
    private $atm;

    /**
     * @var integer
     */
    private $aperturaMaxima;

    /**
     * @var string
     */
    private $observacionesTejidob;

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
     * Get idftEvalucionEstomatologica
     *
     * @return integer
     */
    public function getIdftEvalucionEstomatologica()
    {
        return $this->idftEvalucionEstomatologica;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtEvalucionEstomatologica
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
     * Set procesoOdontologico
     *
     * @param integer $procesoOdontologico
     *
     * @return FtEvalucionEstomatologica
     */
    public function setProcesoOdontologico($procesoOdontologico)
    {
        $this->procesoOdontologico = $procesoOdontologico;

        return $this;
    }

    /**
     * Get procesoOdontologico
     *
     * @return integer
     */
    public function getProcesoOdontologico()
    {
        return $this->procesoOdontologico;
    }

    /**
     * Set cualProcedimiento
     *
     * @param string $cualProcedimiento
     *
     * @return FtEvalucionEstomatologica
     */
    public function setCualProcedimiento($cualProcedimiento)
    {
        $this->cualProcedimiento = $cualProcedimiento;

        return $this;
    }

    /**
     * Get cualProcedimiento
     *
     * @return string
     */
    public function getCualProcedimiento()
    {
        return $this->cualProcedimiento;
    }

    /**
     * Set ultimaVisita
     *
     * @param \DateTime $ultimaVisita
     *
     * @return FtEvalucionEstomatologica
     */
    public function setUltimaVisita($ultimaVisita)
    {
        $this->ultimaVisita = $ultimaVisita;

        return $this;
    }

    /**
     * Get ultimaVisita
     *
     * @return \DateTime
     */
    public function getUltimaVisita()
    {
        return $this->ultimaVisita;
    }

    /**
     * Set tiposDeLimpieza
     *
     * @param string $tiposDeLimpieza
     *
     * @return FtEvalucionEstomatologica
     */
    public function setTiposDeLimpieza($tiposDeLimpieza)
    {
        $this->tiposDeLimpieza = $tiposDeLimpieza;

        return $this;
    }

    /**
     * Get tiposDeLimpieza
     *
     * @return string
     */
    public function getTiposDeLimpieza()
    {
        return $this->tiposDeLimpieza;
    }

    /**
     * Set labios
     *
     * @param integer $labios
     *
     * @return FtEvalucionEstomatologica
     */
    public function setLabios($labios)
    {
        $this->labios = $labios;

        return $this;
    }

    /**
     * Get labios
     *
     * @return integer
     */
    public function getLabios()
    {
        return $this->labios;
    }

    /**
     * Set lengua
     *
     * @param integer $lengua
     *
     * @return FtEvalucionEstomatologica
     */
    public function setLengua($lengua)
    {
        $this->lengua = $lengua;

        return $this;
    }

    /**
     * Get lengua
     *
     * @return integer
     */
    public function getLengua()
    {
        return $this->lengua;
    }

    /**
     * Set paladar
     *
     * @param integer $paladar
     *
     * @return FtEvalucionEstomatologica
     */
    public function setPaladar($paladar)
    {
        $this->paladar = $paladar;

        return $this;
    }

    /**
     * Get paladar
     *
     * @return integer
     */
    public function getPaladar()
    {
        return $this->paladar;
    }

    /**
     * Set carrillos
     *
     * @param integer $carrillos
     *
     * @return FtEvalucionEstomatologica
     */
    public function setCarrillos($carrillos)
    {
        $this->carrillos = $carrillos;

        return $this;
    }

    /**
     * Get carrillos
     *
     * @return integer
     */
    public function getCarrillos()
    {
        return $this->carrillos;
    }

    /**
     * Set pisoDeBoca
     *
     * @param integer $pisoDeBoca
     *
     * @return FtEvalucionEstomatologica
     */
    public function setPisoDeBoca($pisoDeBoca)
    {
        $this->pisoDeBoca = $pisoDeBoca;

        return $this;
    }

    /**
     * Get pisoDeBoca
     *
     * @return integer
     */
    public function getPisoDeBoca()
    {
        return $this->pisoDeBoca;
    }

    /**
     * Set frenillos
     *
     * @param integer $frenillos
     *
     * @return FtEvalucionEstomatologica
     */
    public function setFrenillos($frenillos)
    {
        $this->frenillos = $frenillos;

        return $this;
    }

    /**
     * Get frenillos
     *
     * @return integer
     */
    public function getFrenillos()
    {
        return $this->frenillos;
    }

    /**
     * Set maxilares
     *
     * @param integer $maxilares
     *
     * @return FtEvalucionEstomatologica
     */
    public function setMaxilares($maxilares)
    {
        $this->maxilares = $maxilares;

        return $this;
    }

    /**
     * Get maxilares
     *
     * @return integer
     */
    public function getMaxilares()
    {
        return $this->maxilares;
    }

    /**
     * Set funcionOclusion
     *
     * @param integer $funcionOclusion
     *
     * @return FtEvalucionEstomatologica
     */
    public function setFuncionOclusion($funcionOclusion)
    {
        $this->funcionOclusion = $funcionOclusion;

        return $this;
    }

    /**
     * Get funcionOclusion
     *
     * @return integer
     */
    public function getFuncionOclusion()
    {
        return $this->funcionOclusion;
    }

    /**
     * Set atm
     *
     * @param integer $atm
     *
     * @return FtEvalucionEstomatologica
     */
    public function setAtm($atm)
    {
        $this->atm = $atm;

        return $this;
    }

    /**
     * Get atm
     *
     * @return integer
     */
    public function getAtm()
    {
        return $this->atm;
    }

    /**
     * Set aperturaMaxima
     *
     * @param integer $aperturaMaxima
     *
     * @return FtEvalucionEstomatologica
     */
    public function setAperturaMaxima($aperturaMaxima)
    {
        $this->aperturaMaxima = $aperturaMaxima;

        return $this;
    }

    /**
     * Get aperturaMaxima
     *
     * @return integer
     */
    public function getAperturaMaxima()
    {
        return $this->aperturaMaxima;
    }

    /**
     * Set observacionesTejidob
     *
     * @param string $observacionesTejidob
     *
     * @return FtEvalucionEstomatologica
     */
    public function setObservacionesTejidob($observacionesTejidob)
    {
        $this->observacionesTejidob = $observacionesTejidob;

        return $this;
    }

    /**
     * Get observacionesTejidob
     *
     * @return string
     */
    public function getObservacionesTejidob()
    {
        return $this->observacionesTejidob;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtEvalucionEstomatologica
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
     * @return FtEvalucionEstomatologica
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
     * @return FtEvalucionEstomatologica
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
     * @return FtEvalucionEstomatologica
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
     * @return FtEvalucionEstomatologica
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


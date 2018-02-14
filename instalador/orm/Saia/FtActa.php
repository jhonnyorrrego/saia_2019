<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtActa
 *
 * @ORM\Table(name="ft_acta", indexes={@ORM\Index(name="i_ft_acta_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtActa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_acta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftActa;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1039';

    /**
     * @var string
     *
     * @ORM\Column(name="ajenda_reunion", type="text", length=65535, nullable=false)
     */
    private $ajendaReunion;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_formato", type="string", length=255, nullable=true)
     */
    private $anexoFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="asistentes", type="string", length=255, nullable=false)
     */
    private $asistentes;

    /**
     * @var integer
     *
     * @ORM\Column(name="caracter", type="integer", nullable=false)
     */
    private $caracter = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, nullable=true)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="desarrollo_reunion", type="text", length=65535, nullable=false)
     */
    private $desarrolloReunion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_proxima_reunion", type="datetime", nullable=true)
     */
    private $fechaProximaReunion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_reunion", type="date", nullable=false)
     */
    private $fechaReunion;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_presidente", type="string", length=255, nullable=false)
     */
    private $firmaPresidente;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma_secretaria", type="integer", nullable=false)
     */
    private $firmaSecretaria;

    /**
     * @var string
     *
     * @ORM\Column(name="grupo_reunido", type="string", length=255, nullable=false)
     */
    private $grupoReunido;

    /**
     * @var string
     *
     * @ORM\Column(name="hora", type="string", length=255, nullable=false)
     */
    private $hora;

    /**
     * @var string
     *
     * @ORM\Column(name="invitados", type="string", length=255, nullable=true)
     */
    private $invitados;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar_proxima_reunion", type="string", length=255, nullable=true)
     */
    private $lugarProximaReunion;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_acta", type="string", length=255, nullable=false)
     */
    private $numeroActa;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivo_reunion", type="text", length=65535, nullable=false)
     */
    private $objetivoReunion;

    /**
     * @var string
     *
     * @ORM\Column(name="ausentes", type="string", length=255, nullable=true)
     */
    private $ausentes;

    /**
     * @var integer
     *
     * @ORM\Column(name="tareas", type="integer", nullable=false)
     */
    private $tareas;

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
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



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

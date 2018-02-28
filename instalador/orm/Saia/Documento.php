<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documento
 *
 * @ORM\Table(name="documento", indexes={@ORM\Index(name="serie", columns={"serie", "fecha", "tipo_radicado", "estado"}), @ORM\Index(name="fecha", columns={"fecha"}), @ORM\Index(name="estado", columns={"estado"}), @ORM\Index(name="ejecutor", columns={"ejecutor"})})
 * @ORM\Entity
 */
class Documento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255, nullable=false)
     */
    private $numero;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie", type="integer", nullable=false)
     */
    private $serie = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="ejecutor", type="string", length=255, nullable=false)
     */
    private $ejecutor;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_radicado", type="integer", nullable=false)
     */
    private $tipoRadicado = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="dias", type="string", length=255, nullable=true)
     */
    private $dias;

    /**
     * @var string
     *
     * @ORM\Column(name="plantilla", type="string", length=255, nullable=false)
     */
    private $plantilla;

    /**
     * @var string
     *
     * @ORM\Column(name="activa_admin", type="string", length=255, nullable=false)
     */
    private $activaAdmin = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=true)
     */
    private $fechaCreacion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_ejecutor", type="string", length=255, nullable=true)
     */
    private $tipoEjecutor;

    /**
     * @var integer
     *
     * @ORM\Column(name="paginas", type="integer", nullable=true)
     */
    private $paginas = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="municipio_idmunicipio", type="integer", nullable=false)
     */
    private $municipioIdmunicipio = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="pdf", type="string", length=255, nullable=true)
     */
    private $pdf;

    /**
     * @var string
     *
     * @ORM\Column(name="pdf_hash", type="string", length=255, nullable=true)
     */
    private $pdfHash;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_oficio", type="date", nullable=true)
     */
    private $fechaOficio;

    /**
     * @var string
     *
     * @ORM\Column(name="oficio", type="string", length=20, nullable=true)
     */
    private $oficio;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo", type="string", length=255, nullable=true)
     */
    private $anexo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_anexo", type="text", length=16777215, nullable=true)
     */
    private $descripcionAnexo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="almacenado", type="boolean", nullable=false)
     */
    private $almacenado = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="responsable", type="integer", nullable=true)
     */
    private $responsable = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="guia", type="string", length=50, nullable=true)
     */
    private $guia;

    /**
     * @var integer
     *
     * @ORM\Column(name="guia_empresa", type="integer", nullable=true)
     */
    private $guiaEmpresa = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_despacho", type="string", length=255, nullable=true)
     */
    private $tipoDespacho;

    /**
     * @var integer
     *
     * @ORM\Column(name="formato_idformato", type="integer", nullable=true)
     */
    private $formatoIdformato = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_antiguo", type="integer", nullable=true)
     */
    private $documentoAntiguo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idversion_documento", type="integer", nullable=true)
     */
    private $fkIdversionDocumento = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="version", type="integer", nullable=true)
     */
    private $version = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_limite", type="date", nullable=true)
     */
    private $fechaLimite;

    /**
     * @var integer
     *
     * @ORM\Column(name="ventanilla_radicacion", type="integer", nullable=true)
     */
    private $ventanillaRadicacion;



    /**
     * Get iddocumento
     *
     * @return integer
     */
    public function getIddocumento()
    {
        return $this->iddocumento;
    }

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return Documento
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set serie
     *
     * @param integer $serie
     *
     * @return Documento
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return integer
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Documento
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set ejecutor
     *
     * @param string $ejecutor
     *
     * @return Documento
     */
    public function setEjecutor($ejecutor)
    {
        $this->ejecutor = $ejecutor;

        return $this;
    }

    /**
     * Get ejecutor
     *
     * @return string
     */
    public function getEjecutor()
    {
        return $this->ejecutor;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Documento
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set tipoRadicado
     *
     * @param integer $tipoRadicado
     *
     * @return Documento
     */
    public function setTipoRadicado($tipoRadicado)
    {
        $this->tipoRadicado = $tipoRadicado;

        return $this;
    }

    /**
     * Get tipoRadicado
     *
     * @return integer
     */
    public function getTipoRadicado()
    {
        return $this->tipoRadicado;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Documento
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set dias
     *
     * @param string $dias
     *
     * @return Documento
     */
    public function setDias($dias)
    {
        $this->dias = $dias;

        return $this;
    }

    /**
     * Get dias
     *
     * @return string
     */
    public function getDias()
    {
        return $this->dias;
    }

    /**
     * Set plantilla
     *
     * @param string $plantilla
     *
     * @return Documento
     */
    public function setPlantilla($plantilla)
    {
        $this->plantilla = $plantilla;

        return $this;
    }

    /**
     * Get plantilla
     *
     * @return string
     */
    public function getPlantilla()
    {
        return $this->plantilla;
    }

    /**
     * Set activaAdmin
     *
     * @param string $activaAdmin
     *
     * @return Documento
     */
    public function setActivaAdmin($activaAdmin)
    {
        $this->activaAdmin = $activaAdmin;

        return $this;
    }

    /**
     * Get activaAdmin
     *
     * @return string
     */
    public function getActivaAdmin()
    {
        return $this->activaAdmin;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Documento
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set tipoEjecutor
     *
     * @param string $tipoEjecutor
     *
     * @return Documento
     */
    public function setTipoEjecutor($tipoEjecutor)
    {
        $this->tipoEjecutor = $tipoEjecutor;

        return $this;
    }

    /**
     * Get tipoEjecutor
     *
     * @return string
     */
    public function getTipoEjecutor()
    {
        return $this->tipoEjecutor;
    }

    /**
     * Set paginas
     *
     * @param integer $paginas
     *
     * @return Documento
     */
    public function setPaginas($paginas)
    {
        $this->paginas = $paginas;

        return $this;
    }

    /**
     * Get paginas
     *
     * @return integer
     */
    public function getPaginas()
    {
        return $this->paginas;
    }

    /**
     * Set municipioIdmunicipio
     *
     * @param integer $municipioIdmunicipio
     *
     * @return Documento
     */
    public function setMunicipioIdmunicipio($municipioIdmunicipio)
    {
        $this->municipioIdmunicipio = $municipioIdmunicipio;

        return $this;
    }

    /**
     * Get municipioIdmunicipio
     *
     * @return integer
     */
    public function getMunicipioIdmunicipio()
    {
        return $this->municipioIdmunicipio;
    }

    /**
     * Set pdf
     *
     * @param string $pdf
     *
     * @return Documento
     */
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * Get pdf
     *
     * @return string
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Set pdfHash
     *
     * @param string $pdfHash
     *
     * @return Documento
     */
    public function setPdfHash($pdfHash)
    {
        $this->pdfHash = $pdfHash;

        return $this;
    }

    /**
     * Get pdfHash
     *
     * @return string
     */
    public function getPdfHash()
    {
        return $this->pdfHash;
    }

    /**
     * Set fechaOficio
     *
     * @param \DateTime $fechaOficio
     *
     * @return Documento
     */
    public function setFechaOficio($fechaOficio)
    {
        $this->fechaOficio = $fechaOficio;

        return $this;
    }

    /**
     * Get fechaOficio
     *
     * @return \DateTime
     */
    public function getFechaOficio()
    {
        return $this->fechaOficio;
    }

    /**
     * Set oficio
     *
     * @param string $oficio
     *
     * @return Documento
     */
    public function setOficio($oficio)
    {
        $this->oficio = $oficio;

        return $this;
    }

    /**
     * Get oficio
     *
     * @return string
     */
    public function getOficio()
    {
        return $this->oficio;
    }

    /**
     * Set anexo
     *
     * @param string $anexo
     *
     * @return Documento
     */
    public function setAnexo($anexo)
    {
        $this->anexo = $anexo;

        return $this;
    }

    /**
     * Get anexo
     *
     * @return string
     */
    public function getAnexo()
    {
        return $this->anexo;
    }

    /**
     * Set descripcionAnexo
     *
     * @param string $descripcionAnexo
     *
     * @return Documento
     */
    public function setDescripcionAnexo($descripcionAnexo)
    {
        $this->descripcionAnexo = $descripcionAnexo;

        return $this;
    }

    /**
     * Get descripcionAnexo
     *
     * @return string
     */
    public function getDescripcionAnexo()
    {
        return $this->descripcionAnexo;
    }

    /**
     * Set almacenado
     *
     * @param boolean $almacenado
     *
     * @return Documento
     */
    public function setAlmacenado($almacenado)
    {
        $this->almacenado = $almacenado;

        return $this;
    }

    /**
     * Get almacenado
     *
     * @return boolean
     */
    public function getAlmacenado()
    {
        return $this->almacenado;
    }

    /**
     * Set responsable
     *
     * @param integer $responsable
     *
     * @return Documento
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return integer
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set guia
     *
     * @param string $guia
     *
     * @return Documento
     */
    public function setGuia($guia)
    {
        $this->guia = $guia;

        return $this;
    }

    /**
     * Get guia
     *
     * @return string
     */
    public function getGuia()
    {
        return $this->guia;
    }

    /**
     * Set guiaEmpresa
     *
     * @param integer $guiaEmpresa
     *
     * @return Documento
     */
    public function setGuiaEmpresa($guiaEmpresa)
    {
        $this->guiaEmpresa = $guiaEmpresa;

        return $this;
    }

    /**
     * Get guiaEmpresa
     *
     * @return integer
     */
    public function getGuiaEmpresa()
    {
        return $this->guiaEmpresa;
    }

    /**
     * Set tipoDespacho
     *
     * @param string $tipoDespacho
     *
     * @return Documento
     */
    public function setTipoDespacho($tipoDespacho)
    {
        $this->tipoDespacho = $tipoDespacho;

        return $this;
    }

    /**
     * Get tipoDespacho
     *
     * @return string
     */
    public function getTipoDespacho()
    {
        return $this->tipoDespacho;
    }

    /**
     * Set formatoIdformato
     *
     * @param integer $formatoIdformato
     *
     * @return Documento
     */
    public function setFormatoIdformato($formatoIdformato)
    {
        $this->formatoIdformato = $formatoIdformato;

        return $this;
    }

    /**
     * Get formatoIdformato
     *
     * @return integer
     */
    public function getFormatoIdformato()
    {
        return $this->formatoIdformato;
    }

    /**
     * Set documentoAntiguo
     *
     * @param integer $documentoAntiguo
     *
     * @return Documento
     */
    public function setDocumentoAntiguo($documentoAntiguo)
    {
        $this->documentoAntiguo = $documentoAntiguo;

        return $this;
    }

    /**
     * Get documentoAntiguo
     *
     * @return integer
     */
    public function getDocumentoAntiguo()
    {
        return $this->documentoAntiguo;
    }

    /**
     * Set fkIdversionDocumento
     *
     * @param integer $fkIdversionDocumento
     *
     * @return Documento
     */
    public function setFkIdversionDocumento($fkIdversionDocumento)
    {
        $this->fkIdversionDocumento = $fkIdversionDocumento;

        return $this;
    }

    /**
     * Get fkIdversionDocumento
     *
     * @return integer
     */
    public function getFkIdversionDocumento()
    {
        return $this->fkIdversionDocumento;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return Documento
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set fechaLimite
     *
     * @param \DateTime $fechaLimite
     *
     * @return Documento
     */
    public function setFechaLimite($fechaLimite)
    {
        $this->fechaLimite = $fechaLimite;

        return $this;
    }

    /**
     * Get fechaLimite
     *
     * @return \DateTime
     */
    public function getFechaLimite()
    {
        return $this->fechaLimite;
    }

    /**
     * Set ventanillaRadicacion
     *
     * @param integer $ventanillaRadicacion
     *
     * @return Documento
     */
    public function setVentanillaRadicacion($ventanillaRadicacion)
    {
        $this->ventanillaRadicacion = $ventanillaRadicacion;

        return $this;
    }

    /**
     * Get ventanillaRadicacion
     *
     * @return integer
     */
    public function getVentanillaRadicacion()
    {
        return $this->ventanillaRadicacion;
    }
}

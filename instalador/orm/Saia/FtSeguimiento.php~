<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSeguimiento
 *
 * @ORM\Table(name="ft_seguimiento", indexes={@ORM\Index(name="i_seguimiento_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_seguimiento_hallazgo", columns={"ft_hallazgo"}), @ORM\Index(name="i_seguimiento_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtSeguimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_seguimiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSeguimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1056';

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_hallazgo", type="integer", nullable=false)
     */
    private $ftHallazgo;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=true)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="porcentaje", type="integer", nullable=false)
     */
    private $porcentaje;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=50, nullable=false)
     */
    private $estado = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="logros_alcanzados", type="text", length=65535, nullable=false)
     */
    private $logrosAlcanzados;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="evidencia_documental", type="string", length=255, nullable=true)
     */
    private $evidenciaDocumental;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftSeguimiento
     *
     * @return integer
     */
    public function getIdftSeguimiento()
    {
        return $this->idftSeguimiento;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSeguimiento
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtSeguimiento
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
     * Set ftHallazgo
     *
     * @param integer $ftHallazgo
     *
     * @return FtSeguimiento
     */
    public function setFtHallazgo($ftHallazgo)
    {
        $this->ftHallazgo = $ftHallazgo;

        return $this;
    }

    /**
     * Get ftHallazgo
     *
     * @return integer
     */
    public function getFtHallazgo()
    {
        return $this->ftHallazgo;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtSeguimiento
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSeguimiento
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtSeguimiento
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
     * Set porcentaje
     *
     * @param integer $porcentaje
     *
     * @return FtSeguimiento
     */
    public function setPorcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;

        return $this;
    }

    /**
     * Get porcentaje
     *
     * @return integer
     */
    public function getPorcentaje()
    {
        return $this->porcentaje;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return FtSeguimiento
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
     * Set logrosAlcanzados
     *
     * @param string $logrosAlcanzados
     *
     * @return FtSeguimiento
     */
    public function setLogrosAlcanzados($logrosAlcanzados)
    {
        $this->logrosAlcanzados = $logrosAlcanzados;

        return $this;
    }

    /**
     * Get logrosAlcanzados
     *
     * @return string
     */
    public function getLogrosAlcanzados()
    {
        return $this->logrosAlcanzados;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtSeguimiento
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set evidenciaDocumental
     *
     * @param string $evidenciaDocumental
     *
     * @return FtSeguimiento
     */
    public function setEvidenciaDocumental($evidenciaDocumental)
    {
        $this->evidenciaDocumental = $evidenciaDocumental;

        return $this;
    }

    /**
     * Get evidenciaDocumental
     *
     * @return string
     */
    public function getEvidenciaDocumental()
    {
        return $this->evidenciaDocumental;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtSeguimiento
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

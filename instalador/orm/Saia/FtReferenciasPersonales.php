<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtReferenciasPersonales
 *
 * @ORM\Table(name="ft_referencias_personales", indexes={@ORM\Index(name="i_referencias_persona_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_referencias_persona_hoja_vida", columns={"ft_hoja_vida"}), @ORM\Index(name="i_referencias_persona_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtReferenciasPersonales
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_referencias_personales", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftReferenciasPersonales;

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
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ocupacion", type="string", length=255, nullable=false)
     */
    private $ocupacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '896';

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_hoja_vida", type="integer", nullable=false)
     */
    private $ftHojaVida;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftReferenciasPersonales
     *
     * @return integer
     */
    public function getIdftReferenciasPersonales()
    {
        return $this->idftReferenciasPersonales;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtReferenciasPersonales
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
     * @return FtReferenciasPersonales
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
     * Set telefono
     *
     * @param string $telefono
     *
     * @return FtReferenciasPersonales
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtReferenciasPersonales
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set ocupacion
     *
     * @param string $ocupacion
     *
     * @return FtReferenciasPersonales
     */
    public function setOcupacion($ocupacion)
    {
        $this->ocupacion = $ocupacion;

        return $this;
    }

    /**
     * Get ocupacion
     *
     * @return string
     */
    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtReferenciasPersonales
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
     * @return FtReferenciasPersonales
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
     * Set ftHojaVida
     *
     * @param integer $ftHojaVida
     *
     * @return FtReferenciasPersonales
     */
    public function setFtHojaVida($ftHojaVida)
    {
        $this->ftHojaVida = $ftHojaVida;

        return $this;
    }

    /**
     * Get ftHojaVida
     *
     * @return integer
     */
    public function getFtHojaVida()
    {
        return $this->ftHojaVida;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtReferenciasPersonales
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtReferenciasPersonales
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

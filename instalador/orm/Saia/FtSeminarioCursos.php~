<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSeminarioCursos
 *
 * @ORM\Table(name="ft_seminario_cursos", indexes={@ORM\Index(name="i_seminario_cursos_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_seminario_cursos_hoja_vida", columns={"ft_hoja_vida"}), @ORM\Index(name="i_seminario_cursos_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtSeminarioCursos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_seminario_cursos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSeminarioCursos;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_hoja_vida", type="integer", nullable=false)
     */
    private $ftHojaVida;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_seminario", type="integer", nullable=false)
     */
    private $tipoSeminario;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo_seminario", type="string", length=255, nullable=false)
     */
    private $tituloSeminario;

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
     * Get idftSeminarioCursos
     *
     * @return integer
     */
    public function getIdftSeminarioCursos()
    {
        return $this->idftSeminarioCursos;
    }

    /**
     * Set ftHojaVida
     *
     * @param integer $ftHojaVida
     *
     * @return FtSeminarioCursos
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSeminarioCursos
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
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtSeminarioCursos
     */
    public function setAnexos($anexos)
    {
        $this->anexos = $anexos;

        return $this;
    }

    /**
     * Get anexos
     *
     * @return string
     */
    public function getAnexos()
    {
        return $this->anexos;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtSeminarioCursos
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
     * Set tipoSeminario
     *
     * @param integer $tipoSeminario
     *
     * @return FtSeminarioCursos
     */
    public function setTipoSeminario($tipoSeminario)
    {
        $this->tipoSeminario = $tipoSeminario;

        return $this;
    }

    /**
     * Get tipoSeminario
     *
     * @return integer
     */
    public function getTipoSeminario()
    {
        return $this->tipoSeminario;
    }

    /**
     * Set tituloSeminario
     *
     * @param string $tituloSeminario
     *
     * @return FtSeminarioCursos
     */
    public function setTituloSeminario($tituloSeminario)
    {
        $this->tituloSeminario = $tituloSeminario;

        return $this;
    }

    /**
     * Get tituloSeminario
     *
     * @return string
     */
    public function getTituloSeminario()
    {
        return $this->tituloSeminario;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSeminarioCursos
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
     * @return FtSeminarioCursos
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
     * @return FtSeminarioCursos
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
     * @return FtSeminarioCursos
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
     * @return FtSeminarioCursos
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

<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDirectivaPrueba
 *
 * @ORM\Table(name="ft_directiva_prueba", indexes={@ORM\Index(name="i_ft_directiva_prueba_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_directiva_prueba_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtDirectivaPrueba
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_directiva_prueba", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftDirectivaPrueba;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=true)
     */
    private $serieIdserie;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="dependencia", type="string", length=255, nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_formato", type="integer", nullable=false)
     */
    private $estadoFormato;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_directiva", type="date", nullable=false)
     */
    private $fechaDirectiva;

    /**
     * @var string
     *
     * @ORM\Column(name="tema_directiva", type="string", length=255, nullable=false)
     */
    private $temaDirectiva;



    /**
     * Get idftDirectivaPrueba
     *
     * @return integer
     */
    public function getIdftDirectivaPrueba()
    {
        return $this->idftDirectivaPrueba;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtDirectivaPrueba
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtDirectivaPrueba
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
     * @param string $dependencia
     *
     * @return FtDirectivaPrueba
     */
    public function setDependencia($dependencia)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return string
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set estadoFormato
     *
     * @param integer $estadoFormato
     *
     * @return FtDirectivaPrueba
     */
    public function setEstadoFormato($estadoFormato)
    {
        $this->estadoFormato = $estadoFormato;

        return $this;
    }

    /**
     * Get estadoFormato
     *
     * @return integer
     */
    public function getEstadoFormato()
    {
        return $this->estadoFormato;
    }

    /**
     * Set fechaDirectiva
     *
     * @param \DateTime $fechaDirectiva
     *
     * @return FtDirectivaPrueba
     */
    public function setFechaDirectiva($fechaDirectiva)
    {
        $this->fechaDirectiva = $fechaDirectiva;

        return $this;
    }

    /**
     * Get fechaDirectiva
     *
     * @return \DateTime
     */
    public function getFechaDirectiva()
    {
        return $this->fechaDirectiva;
    }

    /**
     * Set temaDirectiva
     *
     * @param string $temaDirectiva
     *
     * @return FtDirectivaPrueba
     */
    public function setTemaDirectiva($temaDirectiva)
    {
        $this->temaDirectiva = $temaDirectiva;

        return $this;
    }

    /**
     * Get temaDirectiva
     *
     * @return string
     */
    public function getTemaDirectiva()
    {
        return $this->temaDirectiva;
    }
}

<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPruebaConfirmacionV32
 *
 * @ORM\Table(name="ft_prueba_confirmacion_v32")
 * @ORM\Entity
 */
class FtPruebaConfirmacionV32
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_prueba_confirmacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPruebaConfirmacion;

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
     * @var string
     *
     * @ORM\Column(name="campo_texto_nice", type="string", length=255, nullable=true)
     */
    private $campoTextoNice;

    /**
     * @var string
     *
     * @ORM\Column(name="oculto_mostrar", type="string", length=255, nullable=true)
     */
    private $ocultoMostrar;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_1027490111", type="date", nullable=false)
     */
    private $date1027490111;



    /**
     * Get idftPruebaConfirmacion
     *
     * @return integer
     */
    public function getIdftPruebaConfirmacion()
    {
        return $this->idftPruebaConfirmacion;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPruebaConfirmacionV32
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
     * @return FtPruebaConfirmacionV32
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
     * @return FtPruebaConfirmacionV32
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
     * @return FtPruebaConfirmacionV32
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
     * Set campoTextoNice
     *
     * @param string $campoTextoNice
     *
     * @return FtPruebaConfirmacionV32
     */
    public function setCampoTextoNice($campoTextoNice)
    {
        $this->campoTextoNice = $campoTextoNice;

        return $this;
    }

    /**
     * Get campoTextoNice
     *
     * @return string
     */
    public function getCampoTextoNice()
    {
        return $this->campoTextoNice;
    }

    /**
     * Set ocultoMostrar
     *
     * @param string $ocultoMostrar
     *
     * @return FtPruebaConfirmacionV32
     */
    public function setOcultoMostrar($ocultoMostrar)
    {
        $this->ocultoMostrar = $ocultoMostrar;

        return $this;
    }

    /**
     * Get ocultoMostrar
     *
     * @return string
     */
    public function getOcultoMostrar()
    {
        return $this->ocultoMostrar;
    }

    /**
     * Set date1027490111
     *
     * @param \DateTime $date1027490111
     *
     * @return FtPruebaConfirmacionV32
     */
    public function setDate1027490111($date1027490111)
    {
        $this->date1027490111 = $date1027490111;

        return $this;
    }

    /**
     * Get date1027490111
     *
     * @return \DateTime
     */
    public function getDate1027490111()
    {
        return $this->date1027490111;
    }
}

<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPruebaOctRuben
 *
 * @ORM\Table(name="ft_prueba_oct_ruben", indexes={@ORM\Index(name="i_prueba_oct_ruben_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_prueba_oct_ruben_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtPruebaOctRuben
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_prueba_oct_ruben", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPruebaOctRuben;

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
     * @ORM\Column(name="campo_text_ruben", type="string", length=255, nullable=false)
     */
    private $campoTextRuben;



    /**
     * Get idftPruebaOctRuben
     *
     * @return integer
     */
    public function getIdftPruebaOctRuben()
    {
        return $this->idftPruebaOctRuben;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPruebaOctRuben
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
     * @return FtPruebaOctRuben
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
     * @return FtPruebaOctRuben
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
     * @return FtPruebaOctRuben
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
     * Set campoTextRuben
     *
     * @param string $campoTextRuben
     *
     * @return FtPruebaOctRuben
     */
    public function setCampoTextRuben($campoTextRuben)
    {
        $this->campoTextRuben = $campoTextRuben;

        return $this;
    }

    /**
     * Get campoTextRuben
     *
     * @return string
     */
    public function getCampoTextRuben()
    {
        return $this->campoTextRuben;
    }
}

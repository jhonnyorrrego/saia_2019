<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtExplicandoDani
 *
 * @ORM\Table(name="ft_explicando_dani", indexes={@ORM\Index(name="i_ft_explicando_dani_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_explicando_dani_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtExplicandoDani
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_explicando_dani", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftExplicandoDani;

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
     * @ORM\Column(name="mi_campo", type="string", length=255, nullable=false)
     */
    private $miCampo;



    /**
     * Get idftExplicandoDani
     *
     * @return integer
     */
    public function getIdftExplicandoDani()
    {
        return $this->idftExplicandoDani;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtExplicandoDani
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
     * @return FtExplicandoDani
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
     * @return FtExplicandoDani
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
     * @return FtExplicandoDani
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
     * Set miCampo
     *
     * @param string $miCampo
     *
     * @return FtExplicandoDani
     */
    public function setMiCampo($miCampo)
    {
        $this->miCampo = $miCampo;

        return $this;
    }

    /**
     * Get miCampo
     *
     * @return string
     */
    public function getMiCampo()
    {
        return $this->miCampo;
    }
}

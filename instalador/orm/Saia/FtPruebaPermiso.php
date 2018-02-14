<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPruebaPermiso
 *
 * @ORM\Table(name="ft_prueba_permiso")
 * @ORM\Entity
 */
class FtPruebaPermiso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_prueba_permiso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPruebaPermiso;

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
     * @ORM\Column(name="arbol_radio_2090523243", type="string", length=255, nullable=false)
     */
    private $arbolRadio2090523243;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_1228833842", type="date", nullable=false)
     */
    private $date1228833842;

    /**
     * @var string
     *
     * @ORM\Column(name="textarea_tiny_275953781", type="text", length=65535, nullable=false)
     */
    private $textareaTiny275953781;

    /**
     * @var string
     *
     * @ORM\Column(name="campo_texto_1107024019", type="string", length=255, nullable=false)
     */
    private $campoTexto1107024019;



    /**
     * Get idftPruebaPermiso
     *
     * @return integer
     */
    public function getIdftPruebaPermiso()
    {
        return $this->idftPruebaPermiso;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPruebaPermiso
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
     * @return FtPruebaPermiso
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
     * @return FtPruebaPermiso
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
     * @return FtPruebaPermiso
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
     * Set arbolRadio2090523243
     *
     * @param string $arbolRadio2090523243
     *
     * @return FtPruebaPermiso
     */
    public function setArbolRadio2090523243($arbolRadio2090523243)
    {
        $this->arbolRadio2090523243 = $arbolRadio2090523243;

        return $this;
    }

    /**
     * Get arbolRadio2090523243
     *
     * @return string
     */
    public function getArbolRadio2090523243()
    {
        return $this->arbolRadio2090523243;
    }

    /**
     * Set date1228833842
     *
     * @param \DateTime $date1228833842
     *
     * @return FtPruebaPermiso
     */
    public function setDate1228833842($date1228833842)
    {
        $this->date1228833842 = $date1228833842;

        return $this;
    }

    /**
     * Get date1228833842
     *
     * @return \DateTime
     */
    public function getDate1228833842()
    {
        return $this->date1228833842;
    }

    /**
     * Set textareaTiny275953781
     *
     * @param string $textareaTiny275953781
     *
     * @return FtPruebaPermiso
     */
    public function setTextareaTiny275953781($textareaTiny275953781)
    {
        $this->textareaTiny275953781 = $textareaTiny275953781;

        return $this;
    }

    /**
     * Get textareaTiny275953781
     *
     * @return string
     */
    public function getTextareaTiny275953781()
    {
        return $this->textareaTiny275953781;
    }

    /**
     * Set campoTexto1107024019
     *
     * @param string $campoTexto1107024019
     *
     * @return FtPruebaPermiso
     */
    public function setCampoTexto1107024019($campoTexto1107024019)
    {
        $this->campoTexto1107024019 = $campoTexto1107024019;

        return $this;
    }

    /**
     * Get campoTexto1107024019
     *
     * @return string
     */
    public function getCampoTexto1107024019()
    {
        return $this->campoTexto1107024019;
    }
}

<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPruebaComprasV10
 *
 * @ORM\Table(name="ft_prueba_compras_v10", indexes={@ORM\Index(name="i_prueba_compras_v10_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_prueba_compras_v10_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtPruebaComprasV10
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_prueba_compras", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPruebaCompras;

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
     * @ORM\Column(name="arbol_radio_funcionario", type="string", length=255, nullable=false)
     */
    private $arbolRadioFuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_451910049", type="date", nullable=false)
     */
    private $date451910049;



    /**
     * Get idftPruebaCompras
     *
     * @return integer
     */
    public function getIdftPruebaCompras()
    {
        return $this->idftPruebaCompras;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPruebaComprasV10
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
     * @return FtPruebaComprasV10
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
     * @return FtPruebaComprasV10
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
     * @return FtPruebaComprasV10
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
     * Set arbolRadioFuncionario
     *
     * @param string $arbolRadioFuncionario
     *
     * @return FtPruebaComprasV10
     */
    public function setArbolRadioFuncionario($arbolRadioFuncionario)
    {
        $this->arbolRadioFuncionario = $arbolRadioFuncionario;

        return $this;
    }

    /**
     * Get arbolRadioFuncionario
     *
     * @return string
     */
    public function getArbolRadioFuncionario()
    {
        return $this->arbolRadioFuncionario;
    }

    /**
     * Set date451910049
     *
     * @param \DateTime $date451910049
     *
     * @return FtPruebaComprasV10
     */
    public function setDate451910049($date451910049)
    {
        $this->date451910049 = $date451910049;

        return $this;
    }

    /**
     * Get date451910049
     *
     * @return \DateTime
     */
    public function getDate451910049()
    {
        return $this->date451910049;
    }
}

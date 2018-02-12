<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtHijoPrueba
 *
 * @ORM\Table(name="ft_hijo_prueba", indexes={@ORM\Index(name="i_ft_hijo_prueba_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_hijo_prueba_prueba_con", columns={"ft_prueba_confir_apru"}), @ORM\Index(name="i_hijo_prueba_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtHijoPrueba
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_hijo_prueba", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftHijoPrueba;

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
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="mi_campo", type="string", length=255, nullable=false)
     */
    private $miCampo;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1267';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_prueba_confir_apru", type="integer", nullable=false)
     */
    private $ftPruebaConfirApru;



    /**
     * Get idftHijoPrueba
     *
     * @return integer
     */
    public function getIdftHijoPrueba()
    {
        return $this->idftHijoPrueba;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtHijoPrueba
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
     * @return FtHijoPrueba
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtHijoPrueba
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtHijoPrueba
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
     * Set miCampo
     *
     * @param string $miCampo
     *
     * @return FtHijoPrueba
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

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtHijoPrueba
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
     * Set estadoDocumento
     *
     * @param string $estadoDocumento
     *
     * @return FtHijoPrueba
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return string
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }

    /**
     * Set ftPruebaConfirApru
     *
     * @param integer $ftPruebaConfirApru
     *
     * @return FtHijoPrueba
     */
    public function setFtPruebaConfirApru($ftPruebaConfirApru)
    {
        $this->ftPruebaConfirApru = $ftPruebaConfirApru;

        return $this;
    }

    /**
     * Get ftPruebaConfirApru
     *
     * @return integer
     */
    public function getFtPruebaConfirApru()
    {
        return $this->ftPruebaConfirApru;
    }
}

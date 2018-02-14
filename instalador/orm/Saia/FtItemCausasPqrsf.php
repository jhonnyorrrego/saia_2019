<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemCausasPqrsf
 *
 * @ORM\Table(name="ft_item_causas_pqrsf", indexes={@ORM\Index(name="i_ft_item_causas_pqrsf_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtItemCausasPqrsf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_causas_pqrsf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftItemCausasPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_analisis_pqrsf", type="integer", nullable=false)
     */
    private $ftAnalisisPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1049';

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
     * @var string
     *
     * @ORM\Column(name="accion_causa", type="string", length=255, nullable=false)
     */
    private $accionCausa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_limite", type="date", nullable=false)
     */
    private $fechaLimite;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255, nullable=false)
     */
    private $responsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="transferido", type="integer", nullable=true)
     */
    private $transferido = '1';



    /**
     * Get idftItemCausasPqrsf
     *
     * @return integer
     */
    public function getIdftItemCausasPqrsf()
    {
        return $this->idftItemCausasPqrsf;
    }

    /**
     * Set ftAnalisisPqrsf
     *
     * @param integer $ftAnalisisPqrsf
     *
     * @return FtItemCausasPqrsf
     */
    public function setFtAnalisisPqrsf($ftAnalisisPqrsf)
    {
        $this->ftAnalisisPqrsf = $ftAnalisisPqrsf;

        return $this;
    }

    /**
     * Get ftAnalisisPqrsf
     *
     * @return integer
     */
    public function getFtAnalisisPqrsf()
    {
        return $this->ftAnalisisPqrsf;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtItemCausasPqrsf
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
     * @return FtItemCausasPqrsf
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
     * @return FtItemCausasPqrsf
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
     * @return FtItemCausasPqrsf
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
     * @return FtItemCausasPqrsf
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
     * Set accionCausa
     *
     * @param string $accionCausa
     *
     * @return FtItemCausasPqrsf
     */
    public function setAccionCausa($accionCausa)
    {
        $this->accionCausa = $accionCausa;

        return $this;
    }

    /**
     * Get accionCausa
     *
     * @return string
     */
    public function getAccionCausa()
    {
        return $this->accionCausa;
    }

    /**
     * Set fechaLimite
     *
     * @param \DateTime $fechaLimite
     *
     * @return FtItemCausasPqrsf
     */
    public function setFechaLimite($fechaLimite)
    {
        $this->fechaLimite = $fechaLimite;

        return $this;
    }

    /**
     * Get fechaLimite
     *
     * @return \DateTime
     */
    public function getFechaLimite()
    {
        return $this->fechaLimite;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     *
     * @return FtItemCausasPqrsf
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set transferido
     *
     * @param integer $transferido
     *
     * @return FtItemCausasPqrsf
     */
    public function setTransferido($transferido)
    {
        $this->transferido = $transferido;

        return $this;
    }

    /**
     * Get transferido
     *
     * @return integer
     */
    public function getTransferido()
    {
        return $this->transferido;
    }
}

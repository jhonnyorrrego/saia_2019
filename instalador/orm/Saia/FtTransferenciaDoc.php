<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtTransferenciaDoc
 *
 * @ORM\Table(name="ft_transferencia_doc", indexes={@ORM\Index(name="i_transferencia_doc_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_transferencia_doc_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtTransferenciaDoc
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_transferencia_doc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftTransferenciaDoc;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1196';

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
     * @ORM\Column(name="expediente_vinculado", type="string", length=255, nullable=false)
     */
    private $expedienteVinculado;

    /**
     * @var string
     *
     * @ORM\Column(name="oficina_productora", type="string", length=255, nullable=false)
     */
    private $oficinaProductora;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="entregado_por", type="string", length=255, nullable=false)
     */
    private $entregadoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="recibido_por", type="string", length=255, nullable=false)
     */
    private $recibidoPor;

    /**
     * @var integer
     *
     * @ORM\Column(name="transferir_a", type="integer", nullable=false)
     */
    private $transferirA;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftTransferenciaDoc
     *
     * @return integer
     */
    public function getIdftTransferenciaDoc()
    {
        return $this->idftTransferenciaDoc;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtTransferenciaDoc
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
     * @return FtTransferenciaDoc
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
     * @return FtTransferenciaDoc
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
     * @return FtTransferenciaDoc
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
     * @return FtTransferenciaDoc
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
     * Set expedienteVinculado
     *
     * @param string $expedienteVinculado
     *
     * @return FtTransferenciaDoc
     */
    public function setExpedienteVinculado($expedienteVinculado)
    {
        $this->expedienteVinculado = $expedienteVinculado;

        return $this;
    }

    /**
     * Get expedienteVinculado
     *
     * @return string
     */
    public function getExpedienteVinculado()
    {
        return $this->expedienteVinculado;
    }

    /**
     * Set oficinaProductora
     *
     * @param string $oficinaProductora
     *
     * @return FtTransferenciaDoc
     */
    public function setOficinaProductora($oficinaProductora)
    {
        $this->oficinaProductora = $oficinaProductora;

        return $this;
    }

    /**
     * Get oficinaProductora
     *
     * @return string
     */
    public function getOficinaProductora()
    {
        return $this->oficinaProductora;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtTransferenciaDoc
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtTransferenciaDoc
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
     * Set entregadoPor
     *
     * @param string $entregadoPor
     *
     * @return FtTransferenciaDoc
     */
    public function setEntregadoPor($entregadoPor)
    {
        $this->entregadoPor = $entregadoPor;

        return $this;
    }

    /**
     * Get entregadoPor
     *
     * @return string
     */
    public function getEntregadoPor()
    {
        return $this->entregadoPor;
    }

    /**
     * Set recibidoPor
     *
     * @param string $recibidoPor
     *
     * @return FtTransferenciaDoc
     */
    public function setRecibidoPor($recibidoPor)
    {
        $this->recibidoPor = $recibidoPor;

        return $this;
    }

    /**
     * Get recibidoPor
     *
     * @return string
     */
    public function getRecibidoPor()
    {
        return $this->recibidoPor;
    }

    /**
     * Set transferirA
     *
     * @param integer $transferirA
     *
     * @return FtTransferenciaDoc
     */
    public function setTransferirA($transferirA)
    {
        $this->transferirA = $transferirA;

        return $this;
    }

    /**
     * Get transferirA
     *
     * @return integer
     */
    public function getTransferirA()
    {
        return $this->transferirA;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtTransferenciaDoc
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

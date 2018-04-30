<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ruta
 *
 * @ORM\Table(name="ruta", indexes={@ORM\Index(name="i_ruta_origen", columns={"origen"}), @ORM\Index(name="i_ruta_destino", columns={"destino"}), @ORM\Index(name="i_ruta_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_ruta_tipo_desti", columns={"tipo_destino"})})
 * @ORM\Entity
 */
class Ruta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idruta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idruta;

    /**
     * @var integer
     *
     * @ORM\Column(name="origen", type="integer", nullable=false)
     */
    private $origen = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", nullable=false)
     */
    private $tipo = 'ACTIVO';

    /**
     * @var integer
     *
     * @ORM\Column(name="destino", type="integer", nullable=false)
     */
    private $destino = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="idtipo_documental", type="integer", nullable=true)
     */
    private $idtipoDocumental;

    /**
     * @var string
     *
     * @ORM\Column(name="condicion_transferencia", type="string", nullable=true)
     */
    private $condicionTransferencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="transferencia_idtransferencia", type="integer", nullable=true)
     */
    private $transferenciaIdtransferencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_origen", type="integer", nullable=false)
     */
    private $tipoOrigen = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_destino", type="integer", nullable=false)
     */
    private $tipoDestino = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="obligatorio", type="integer", nullable=false)
     */
    private $obligatorio = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="restrictivo", type="integer", nullable=false)
     */
    private $restrictivo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="idenlace_nodo", type="integer", nullable=true)
     */
    private $idenlaceNodo;

    /**
     * @var integer
     *
     * @ORM\Column(name="clase", type="integer", nullable=false)
     */
    private $clase = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="firma_externa", type="string", length=255, nullable=true)
     */
    private $firmaExterna;



    /**
     * Get idruta
     *
     * @return integer
     */
    public function getIdruta()
    {
        return $this->idruta;
    }

    /**
     * Set origen
     *
     * @param integer $origen
     *
     * @return Ruta
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return integer
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Ruta
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set destino
     *
     * @param integer $destino
     *
     * @return Ruta
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return integer
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set idtipoDocumental
     *
     * @param integer $idtipoDocumental
     *
     * @return Ruta
     */
    public function setIdtipoDocumental($idtipoDocumental)
    {
        $this->idtipoDocumental = $idtipoDocumental;

        return $this;
    }

    /**
     * Get idtipoDocumental
     *
     * @return integer
     */
    public function getIdtipoDocumental()
    {
        return $this->idtipoDocumental;
    }

    /**
     * Set condicionTransferencia
     *
     * @param string $condicionTransferencia
     *
     * @return Ruta
     */
    public function setCondicionTransferencia($condicionTransferencia)
    {
        $this->condicionTransferencia = $condicionTransferencia;

        return $this;
    }

    /**
     * Get condicionTransferencia
     *
     * @return string
     */
    public function getCondicionTransferencia()
    {
        return $this->condicionTransferencia;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return Ruta
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Ruta
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set transferenciaIdtransferencia
     *
     * @param integer $transferenciaIdtransferencia
     *
     * @return Ruta
     */
    public function setTransferenciaIdtransferencia($transferenciaIdtransferencia)
    {
        $this->transferenciaIdtransferencia = $transferenciaIdtransferencia;

        return $this;
    }

    /**
     * Get transferenciaIdtransferencia
     *
     * @return integer
     */
    public function getTransferenciaIdtransferencia()
    {
        return $this->transferenciaIdtransferencia;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return Ruta
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set tipoOrigen
     *
     * @param integer $tipoOrigen
     *
     * @return Ruta
     */
    public function setTipoOrigen($tipoOrigen)
    {
        $this->tipoOrigen = $tipoOrigen;

        return $this;
    }

    /**
     * Get tipoOrigen
     *
     * @return integer
     */
    public function getTipoOrigen()
    {
        return $this->tipoOrigen;
    }

    /**
     * Set tipoDestino
     *
     * @param integer $tipoDestino
     *
     * @return Ruta
     */
    public function setTipoDestino($tipoDestino)
    {
        $this->tipoDestino = $tipoDestino;

        return $this;
    }

    /**
     * Get tipoDestino
     *
     * @return integer
     */
    public function getTipoDestino()
    {
        return $this->tipoDestino;
    }

    /**
     * Set obligatorio
     *
     * @param boolean $obligatorio
     *
     * @return Ruta
     */
    public function setObligatorio($obligatorio)
    {
        $this->obligatorio = $obligatorio;

        return $this;
    }

    /**
     * Get obligatorio
     *
     * @return boolean
     */
    public function getObligatorio()
    {
        return $this->obligatorio;
    }

    /**
     * Set restrictivo
     *
     * @param boolean $restrictivo
     *
     * @return Ruta
     */
    public function setRestrictivo($restrictivo)
    {
        $this->restrictivo = $restrictivo;

        return $this;
    }

    /**
     * Get restrictivo
     *
     * @return boolean
     */
    public function getRestrictivo()
    {
        return $this->restrictivo;
    }

    /**
     * Set idenlaceNodo
     *
     * @param integer $idenlaceNodo
     *
     * @return Ruta
     */
    public function setIdenlaceNodo($idenlaceNodo)
    {
        $this->idenlaceNodo = $idenlaceNodo;

        return $this;
    }

    /**
     * Get idenlaceNodo
     *
     * @return integer
     */
    public function getIdenlaceNodo()
    {
        return $this->idenlaceNodo;
    }

    /**
     * Set clase
     *
     * @param boolean $clase
     *
     * @return Ruta
     */
    public function setClase($clase)
    {
        $this->clase = $clase;

        return $this;
    }

    /**
     * Get clase
     *
     * @return boolean
     */
    public function getClase()
    {
        return $this->clase;
    }

    /**
     * Set firmaExterna
     *
     * @param string $firmaExterna
     *
     * @return Ruta
     */
    public function setFirmaExterna($firmaExterna)
    {
        $this->firmaExterna = $firmaExterna;

        return $this;
    }

    /**
     * Get firmaExterna
     *
     * @return string
     */
    public function getFirmaExterna()
    {
        return $this->firmaExterna;
    }
}

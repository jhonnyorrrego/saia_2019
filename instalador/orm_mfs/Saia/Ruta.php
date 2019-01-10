<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ruta
 *
 * @ORM\Table(name="ruta", indexes={@ORM\Index(name="origen", columns={"origen"}), @ORM\Index(name="destino", columns={"destino"})})
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
     * @var boolean
     *
     * @ORM\Column(name="obligatorio", type="boolean", nullable=false)
     */
    private $obligatorio = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="restrictivo", type="boolean", nullable=false)
     */
    private $restrictivo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="idenlace_nodo", type="integer", nullable=true)
     */
    private $idenlaceNodo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="clase", type="boolean", nullable=false)
     */
    private $clase = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="firma_externa", type="string", length=255, nullable=true)
     */
    private $firmaExterna;


}


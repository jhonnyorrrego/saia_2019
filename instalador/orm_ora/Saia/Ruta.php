<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ruta
 *
 * @ORM\Table(name="ruta", indexes={@ORM\Index(name="i_ruta_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_ruta_origen", columns={"origen"}), @ORM\Index(name="i_ruta_destino", columns={"destino"})})
 * @ORM\Entity
 */
class Ruta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idruta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idruta;

    /**
     * @var string
     *
     * @ORM\Column(name="origen", type="string", length=255, nullable=false)
     */
    private $origen = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=8, nullable=false)
     */
    private $tipo = 'ACTIVO';

    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="string", length=255, nullable=false)
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
     * @ORM\Column(name="condicion_transferencia", type="string", length=17, nullable=true)
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
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';

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
     * @ORM\Column(name="bloqueo", type="string", length=255, nullable=true)
     */
    private $bloqueo;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_externa", type="string", length=255, nullable=true)
     */
    private $firmaExterna;


}

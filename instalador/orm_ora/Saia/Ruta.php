<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ruta
 *
 * @ORM\Table(name="RUTA")
 * @ORM\Entity
 */
class Ruta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDRUTA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="RUTA_IDRUTA_seq", allocationSize=1, initialValue=1)
     */
    private $idruta;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORIGEN", type="integer", nullable=true)
     */
    private $origen = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=4000, nullable=true)
     */
    private $tipo = 'ACTIVO';

    /**
     * @var integer
     *
     * @ORM\Column(name="DESTINO", type="integer", nullable=true)
     */
    private $destino = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDTIPO_DOCUMENTAL", type="integer", nullable=true)
     */
    private $idtipoDocumental;

    /**
     * @var string
     *
     * @ORM\Column(name="CONDICION_TRANSFERENCIA", type="string", length=4000, nullable=true)
     */
    private $condicionTransferencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="TRANSFERENCIA_IDTRANSFERENCIA", type="integer", nullable=true)
     */
    private $transferenciaIdtransferencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=true)
     */
    private $orden = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_ORIGEN", type="integer", nullable=true)
     */
    private $tipoOrigen = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_DESTINO", type="integer", nullable=true)
     */
    private $tipoDestino = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="OBLIGATORIO", type="integer", nullable=true)
     */
    private $obligatorio = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="RESTRICTIVO", type="integer", nullable=true)
     */
    private $restrictivo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDENLACE_NODO", type="integer", nullable=true)
     */
    private $idenlaceNodo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="CLASE", type="boolean", nullable=true)
     */
    private $clase;


}


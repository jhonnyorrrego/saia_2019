<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ruta
 *
 * @ORM\Table(name="RUTA", indexes={@ORM\Index(name="i_ruta_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
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
     * @var string
     *
     * @ORM\Column(name="ORIGEN", type="string", length=255, nullable=false)
     */
    private $origen = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=8, nullable=false)
     */
    private $tipo = 'ACTIVO';

    /**
     * @var string
     *
     * @ORM\Column(name="DESTINO", type="string", length=255, nullable=false)
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
     * @ORM\Column(name="CONDICION_TRANSFERENCIA", type="string", length=17, nullable=true)
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
     * @ORM\Column(name="ORDEN", type="integer", nullable=false)
     */
    private $orden = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_ORIGEN", type="integer", nullable=false)
     */
    private $tipoOrigen = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_DESTINO", type="integer", nullable=false)
     */
    private $tipoDestino = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="OBLIGATORIO", type="integer", nullable=false)
     */
    private $obligatorio = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="RESTRICTIVO", type="integer", nullable=false)
     */
    private $restrictivo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDENLACE_NODO", type="integer", nullable=true)
     */
    private $idenlaceNodo;

    /**
     * @var integer
     *
     * @ORM\Column(name="CLASE", type="integer", nullable=false)
     */
    private $clase = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="BLOQUEO", type="string", length=255, nullable=true)
     */
    private $bloqueo;

    /**
     * @var string
     *
     * @ORM\Column(name="FIRMA_EXTERNA", type="string", length=255, nullable=true)
     */
    private $firmaExterna;


}

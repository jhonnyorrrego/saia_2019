<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * NuevoBuzonEntrada
 *
 * @ORM\Table(name="NUEVO_BUZON_ENTRADA", indexes={@ORM\Index(name="i_nuevo_buzo_tipo_ctx", columns={"TIPO"}), @ORM\Index(name="i_nuevo_buzo_notas_ctx", columns={"NOTAS"}), @ORM\Index(name="i_nuevo_buzo_nombre_ctx", columns={"NOMBRE"})})
 * @ORM\Entity
 */
class NuevoBuzonEntrada
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTRANSFERENCIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="NUEVO_BUZON_ENTRADA_IDTRANSFER", allocationSize=1, initialValue=1)
     */
    private $idtransferencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ARCHIVO_IDARCHIVO", type="integer", nullable=false)
     */
    private $archivoIdarchivo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=4000, nullable=false)
     */
    private $nombre = 'RECEPCION';

    /**
     * @var string
     *
     * @ORM\Column(name="DESTINO", type="string", length=255, nullable=true)
     */
    private $destino;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_DESTINO", type="integer", nullable=true)
     */
    private $tipoDestino;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="RESPUESTA", type="date", nullable=true)
     */
    private $respuesta;

    /**
     * @var string
     *
     * @ORM\Column(name="ORIGEN", type="string", length=255, nullable=false)
     */
    private $origen;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_ORIGEN", type="integer", nullable=true)
     */
    private $tipoOrigen;

    /**
     * @var string
     *
     * @ORM\Column(name="NOTAS", type="text", nullable=true)
     */
    private $notas;

    /**
     * @var string
     *
     * @ORM\Column(name="TRANSFERENCIA_DESCRIPCION", type="text", nullable=true)
     */
    private $transferenciaDescripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=4000, nullable=false)
     */
    private $tipo = 'ARCHIVO';

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTIVO", type="integer", nullable=false)
     */
    private $activo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="RUTA_IDRUTA", type="integer", nullable=true)
     */
    private $rutaIdruta = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="VER_NOTAS", type="string", length=1, nullable=true)
     */
    private $verNotas = '0';


}


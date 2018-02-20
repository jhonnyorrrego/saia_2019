<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BuzonSalida
 *
 * @ORM\Table(name="BUZON_SALIDA", indexes={@ORM\Index(name="i_buzon_salida_destino", columns={"DESTINO"}), @ORM\Index(name="i_buzon_salida_ruta_idruta", columns={"RUTA_IDRUTA"}), @ORM\Index(name="i_buzon_sali_notas_ctx", columns={"NOTAS"}), @ORM\Index(name="i_buzon_salida_origen", columns={"ORIGEN"}), @ORM\Index(name="i_buzon_salida_fecha", columns={"FECHA"}), @ORM\Index(name="i_buzon_salida_archivo_idar", columns={"ARCHIVO_IDARCHIVO"})})
 * @ORM\Entity
 */
class BuzonSalida
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTRANSFERENCIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="BUZON_SALIDA_IDTRANSFERENCIA_s", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="NOMBRE", type="string", length=20, nullable=false)
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
     * @ORM\Column(name="FECHA", type="date", nullable=true)
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
     * @ORM\Column(name="ORIGEN", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="TIPO", type="string", length=20, nullable=true)
     */
    private $tipo = 'ARCHIVO';

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

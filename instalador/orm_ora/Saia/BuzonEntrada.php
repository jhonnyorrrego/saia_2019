<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BuzonEntrada
 *
 * @ORM\Table(name="buzon_entrada", indexes={@ORM\Index(name="i_buzon_entrad_fecha", columns={"fecha"}), @ORM\Index(name="i_buzon_entrad_destino", columns={"destino"}), @ORM\Index(name="i_buzon_entrad_ruta_idruta", columns={"ruta_idruta"}), @ORM\Index(name="i_buzon_entrad_archivo_idar", columns={"archivo_idarchivo"}), @ORM\Index(name="i_buzon_entrad_origen", columns={"origen"})})
 * @ORM\Entity
 */
class BuzonEntrada
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtransferencia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtransferencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="archivo_idarchivo", type="integer", nullable=false)
     */
    private $archivoIdarchivo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=20, nullable=true)
     */
    private $nombre = 'RECEPCION';

    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="string", length=255, nullable=true)
     */
    private $destino;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_destino", type="integer", nullable=true)
     */
    private $tipoDestino;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="respuesta", type="date", nullable=true)
     */
    private $respuesta;

    /**
     * @var string
     *
     * @ORM\Column(name="origen", type="string", length=255, nullable=true)
     */
    private $origen;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_origen", type="integer", nullable=true)
     */
    private $tipoOrigen;

    /**
     * @var string
     *
     * @ORM\Column(name="notas", type="text", nullable=true)
     */
    private $notas;

    /**
     * @var string
     *
     * @ORM\Column(name="transferencia_descripcion", type="text", nullable=true)
     */
    private $transferenciaDescripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=20, nullable=true)
     */
    private $tipo = 'ARCHIVO';

    /**
     * @var integer
     *
     * @ORM\Column(name="activo", type="integer", nullable=true)
     */
    private $activo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ruta_idruta", type="integer", nullable=true)
     */
    private $rutaIdruta;

    /**
     * @var string
     *
     * @ORM\Column(name="ver_notas", type="string", length=1, nullable=true)
     */
    private $verNotas = '0';


}

<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtGastosViaje
 *
 * @ORM\Table(name="ft_gastos_viaje")
 * @ORM\Entity
 */
class FtGastosViaje
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_gastos_viaje", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftGastosViaje;

    /**
     * @var string
     *
     * @ORM\Column(name="a", type="string", length=255, nullable=true)
     */
    private $a;

    /**
     * @var string
     *
     * @ORM\Column(name="aa", type="string", length=255, nullable=true)
     */
    private $aa;

    /**
     * @var string
     *
     * @ORM\Column(name="alojamiento", type="string", length=255, nullable=false)
     */
    private $alojamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255, nullable=false)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="aprobado_por", type="string", length=255, nullable=true)
     */
    private $aprobadoPor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="aprob_rech_fecha", type="datetime", nullable=true)
     */
    private $aprobRechFecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="aprob_rech_idfun", type="integer", nullable=true)
     */
    private $aprobRechIdfun;

    /**
     * @var string
     *
     * @ORM\Column(name="campo_detalle", type="string", length=255, nullable=true)
     */
    private $campoDetalle;

    /**
     * @var integer
     *
     * @ORM\Column(name="cedula", type="integer", nullable=false)
     */
    private $cedula;

    /**
     * @var string
     *
     * @ORM\Column(name="centro_costos", type="string", length=100, nullable=false)
     */
    private $centroCostos;

    /**
     * @var string
     *
     * @ORM\Column(name="de", type="string", length=255, nullable=true)
     */
    private $de;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_gasto_viaje", type="string", length=255, nullable=true)
     */
    private $estadoGastoViaje = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_temp", type="integer", nullable=false)
     */
    private $estadoTemp = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_regreso", type="date", nullable=false)
     */
    private $fechaRegreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_salida", type="date", nullable=false)
     */
    private $fechaSalida;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario", type="text", length=65535, nullable=false)
     */
    private $funcionario;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario_entidad", type="string", length=255, nullable=false)
     */
    private $funcionarioEntidad = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_entrada_gasto", type="time", nullable=false)
     */
    private $horaEntradaGasto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_salida_gasto", type="time", nullable=false)
     */
    private $horaSalidaGasto;

    /**
     * @var integer
     *
     * @ORM\Column(name="idcf_categoria_viaje", type="integer", nullable=false)
     */
    private $idcfCategoriaViaje;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_viajero", type="string", length=255, nullable=true)
     */
    private $numeroViajero;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivo_viaje", type="text", length=65535, nullable=false)
     */
    private $objetivoViaje;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_identificacion", type="integer", nullable=false)
     */
    private $tipoIdentificacion = '1';


}


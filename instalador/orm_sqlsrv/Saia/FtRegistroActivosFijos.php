<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRegistroActivosFijos
 *
 * @ORM\Table(name="ft_registro_activos_fijos")
 * @ORM\Entity
 */
class FtRegistroActivosFijos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_registro_activos_fijos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftRegistroActivosFijos;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=true)
     */
    private $cantidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_completa", type="text", length=65535, nullable=true)
     */
    private $descripcionCompleta;

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
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_compra", type="date", nullable=true)
     */
    private $fechaCompra;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_acta_entrega_af", type="integer", nullable=true)
     */
    private $idftItemActaEntregaAf;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen_activo", type="string", length=255, nullable=true)
     */
    private $imagenActivo;

    /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=255, nullable=true)
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=255, nullable=true)
     */
    private $modelo;

    /**
     * @var string
     *
     * @ORM\Column(name="otros_elementos", type="string", length=255, nullable=true)
     */
    private $otrosElementos;

    /**
     * @var integer
     *
     * @ORM\Column(name="proveedor", type="integer", nullable=true)
     */
    private $proveedor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registro_inventario", type="date", nullable=true)
     */
    private $registroInventario;

    /**
     * @var string
     *
     * @ORM\Column(name="serial", type="string", length=255, nullable=true)
     */
    private $serial;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '891';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_activo", type="integer", nullable=false)
     */
    private $tipoActivo;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_compra", type="string", length=255, nullable=true)
     */
    private $valorCompra;


}


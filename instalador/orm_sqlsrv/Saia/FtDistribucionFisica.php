<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDistribucionFisica
 *
 * @ORM\Table(name="ft_distribucion_fisica", indexes={@ORM\Index(name="i_ft_distribucion_fisica_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtDistribucionFisica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_distribucion_fisica", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftDistribucionFisica;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '990';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_documento", type="date", nullable=false)
     */
    private $fechaDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_mensajero", type="string", length=255, nullable=false)
     */
    private $nombreMensajero;

    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="string", length=255, nullable=false)
     */
    private $destino;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_radicacion_entrada", type="integer", nullable=false)
     */
    private $ftRadicacionEntrada;

    /**
     * @var string
     *
     * @ORM\Column(name="nivel_urgencia", type="string", length=10, nullable=false)
     */
    private $nivelUrgencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_recibido", type="date", nullable=true)
     */
    private $fechaRecibido;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_recibido", type="string", length=255, nullable=true)
     */
    private $usuarioRecibido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_entregado", type="date", nullable=true)
     */
    private $fechaEntregado;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_entregado", type="string", length=255, nullable=true)
     */
    private $usuarioEntregado;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';


}

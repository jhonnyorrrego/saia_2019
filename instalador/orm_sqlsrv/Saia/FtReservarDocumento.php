<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtReservarDocumento
 *
 * @ORM\Table(name="ft_reservar_documento")
 * @ORM\Entity
 */
class FtReservarDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_reservar_documento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftReservarDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1108';

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=false)
     */
    private $fechaSolicitud;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="desde", type="datetime", nullable=false)
     */
    private $desde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hasta", type="datetime", nullable=false)
     */
    private $hasta;

    /**
     * @var integer
     *
     * @ORM\Column(name="solicitar_a", type="integer", nullable=false)
     */
    private $solicitarA;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="doc_relacionado", type="integer", nullable=true)
     */
    private $docRelacionado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_entrega", type="datetime", nullable=true)
     */
    private $fechaEntrega;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario_entrega", type="integer", nullable=true)
     */
    private $usuarioEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_entrega", type="string", length=255, nullable=true)
     */
    private $observacionEntrega;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_devolver", type="datetime", nullable=true)
     */
    private $fechaDevolver;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario_devolver", type="integer", nullable=true)
     */
    private $usuarioDevolver;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_devolver", type="string", length=255, nullable=true)
     */
    private $observacionDevolver;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_doc", type="integer", nullable=true)
     */
    private $estadoDoc = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';


}

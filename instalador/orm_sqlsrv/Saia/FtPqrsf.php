<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPqrsf
 *
 * @ORM\Table(name="ft_pqrsf")
 * @ORM\Entity
 */
class FtPqrsf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_pqrsf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1032';

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="comentarios", type="text", length=65535, nullable=false)
     */
    private $comentarios;

    /**
     * @var string
     *
     * @ORM\Column(name="documento", type="string", length=255, nullable=true)
     */
    private $documento;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_reporte", type="integer", nullable=true)
     */
    private $estadoReporte = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_verificacion", type="integer", nullable=true)
     */
    private $estadoVerificacion = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_reporte", type="datetime", nullable=true)
     */
    private $fechaReporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_reporte", type="integer", nullable=true)
     */
    private $funcionarioReporte;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="rol_institucion", type="integer", nullable=false)
     */
    private $rolInstitucion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

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
     * @var string
     *
     * @ORM\Column(name="numero_radicado", type="string", length=255, nullable=true)
     */
    private $numeroRadicado;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="remitente_origen", type="integer", nullable=true)
     */
    private $remitenteOrigen;


}

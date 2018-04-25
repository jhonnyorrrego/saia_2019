<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtCertificadoLaboral
 *
 * @ORM\Table(name="ft_certificado_laboral")
 * @ORM\Entity
 */
class FtCertificadoLaboral
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_certificado_laboral", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftCertificadoLaboral;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=255, nullable=false)
     */
    private $cargo;

    /**
     * @var string
     *
     * @ORM\Column(name="cedula", type="string", length=255, nullable=false)
     */
    private $cedula;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="dirigido", type="string", length=255, nullable=false)
     */
    private $dirigido;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=false)
     */
    private $fechaSolicitud;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_vinculacion", type="date", nullable=false)
     */
    private $fechaVinculacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_certificado", type="integer", nullable=false)
     */
    private $ftSolicitudCertificado;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario", type="string", length=255, nullable=false)
     */
    private $funcionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="idhojav", type="integer", nullable=true)
     */
    private $idhojav;

    /**
     * @var integer
     *
     * @ORM\Column(name="salario", type="integer", nullable=false)
     */
    private $salario;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1084';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_contrato", type="string", length=255, nullable=false)
     */
    private $tipoContrato;


}


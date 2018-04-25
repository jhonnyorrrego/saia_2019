<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtVerififcacionP1
 *
 * @ORM\Table(name="ft_verififcacion_p1")
 * @ORM\Entity
 */
class FtVerififcacionP1
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_verififcacion_p1", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftVerififcacionP1;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_formato", type="string", length=255, nullable=true)
     */
    private $anexoFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="check_permiso", type="integer", nullable=false)
     */
    private $checkPermiso;

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
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_gh", type="datetime", nullable=false)
     */
    private $fechaGh;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_permiso_p1", type="integer", nullable=false)
     */
    private $ftSolicitudPermisoP1;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;


}


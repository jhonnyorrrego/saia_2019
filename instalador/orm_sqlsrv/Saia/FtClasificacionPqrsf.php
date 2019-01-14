<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtClasificacionPqrsf
 *
 * @ORM\Table(name="ft_clasificacion_pqrsf", indexes={@ORM\Index(name="i_ft_clasificacion_pqrsf_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtClasificacionPqrsf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_clasificacion_pqrsf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftClasificacionPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_pqrsf", type="integer", nullable=false)
     */
    private $ftPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1033';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255, nullable=false)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="serie", type="string", length=255, nullable=false)
     */
    private $serie;

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
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';


}

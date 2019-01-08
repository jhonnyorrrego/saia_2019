<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtNovedadCesantias
 *
 * @ORM\Table(name="ft_novedad_cesantias")
 * @ORM\Entity
 */
class FtNovedadCesantias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_novedad_cesantias", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftNovedadCesantias;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_novedad", type="date", nullable=false)
     */
    private $fechaNovedad;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_cesantias", type="integer", nullable=false)
     */
    private $ftSolicitudCesantias;

    /**
     * @var string
     *
     * @ORM\Column(name="legalizacion_inver", type="string", length=255, nullable=false)
     */
    private $legalizacionInver;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones_nove", type="text", length=65535, nullable=true)
     */
    private $observacionesNove;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1086';


}


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtLegalizacionGastosViaje
 *
 * @ORM\Table(name="ft_legalizacion_gastos_viaje")
 * @ORM\Entity
 */
class FtLegalizacionGastosViaje
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_legalizacion_gastos_viaje", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftLegalizacionGastosViaje;

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
     * @ORM\Column(name="fecha_legalizacion", type="date", nullable=false)
     */
    private $fechaLegalizacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_gastos_viaje", type="integer", nullable=false)
     */
    private $ftGastosViaje;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1398';


}


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRutaDistribucion
 *
 * @ORM\Table(name="ft_ruta_distribucion")
 * @ORM\Entity
 */
class FtRutaDistribucion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_ruta_distribucion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftRutaDistribucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

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
     * @var string
     *
     * @ORM\Column(name="descripcion_ruta", type="text", length=65535, nullable=true)
     */
    private $descripcionRuta;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_ruta", type="string", length=255, nullable=false)
     */
    private $nombreRuta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ruta_distribuc", type="date", nullable=false)
     */
    private $fechaRutaDistribuc;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1280';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="asignar_dependencias", type="text", length=65535, nullable=false)
     */
    private $asignarDependencias;

    /**
     * @var string
     *
     * @ORM\Column(name="asignar_mensajeros", type="string", length=255, nullable=false)
     */
    private $asignarMensajeros;


}

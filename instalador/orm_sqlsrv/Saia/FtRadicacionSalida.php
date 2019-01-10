<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRadicacionSalida
 *
 * @ORM\Table(name="ft_radicacion_salida")
 * @ORM\Entity
 */
class FtRadicacionSalida
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_radicacion_salida", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftRadicacionSalida;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1318';

    /**
     * @var integer
     *
     * @ORM\Column(name="anexos_fisicos", type="integer", nullable=true)
     */
    private $anexosFisicos;

    /**
     * @var string
     *
     * @ORM\Column(name="persona_natural", type="string", length=255, nullable=false)
     */
    private $personaNatural;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_salida", type="text", length=65535, nullable=false)
     */
    private $descripcionSalida;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_anexos", type="string", length=255, nullable=true)
     */
    private $descripcionAnexos;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_radicado", type="string", length=255, nullable=true)
     */
    private $estadoRadicado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_radicacion_entrada", type="datetime", nullable=false)
     */
    private $fechaRadicacionEntrada;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_radicado", type="integer", nullable=true)
     */
    private $numeroRadicado;

    /**
     * @var string
     *
     * @ORM\Column(name="area_responsable", type="string", length=255, nullable=false)
     */
    private $areaResponsable;

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
     * @ORM\Column(name="tipo_mensajeria", type="integer", nullable=false)
     */
    private $tipoMensajeria = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="mensajeros", type="integer", nullable=true)
     */
    private $mensajeros;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_folios", type="integer", nullable=false)
     */
    private $numFolios;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';


}

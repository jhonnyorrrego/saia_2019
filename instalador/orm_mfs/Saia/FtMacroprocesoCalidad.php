<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtMacroprocesoCalidad
 *
 * @ORM\Table(name="ft_macroproceso_calidad")
 * @ORM\Entity
 */
class FtMacroprocesoCalidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_macroproceso_calidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftMacroprocesoCalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="caracterizacion", type="string", length=255, nullable=true)
     */
    private $caracterizacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="des_formato", type="text", length=65535, nullable=true)
     */
    private $desFormato;

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
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '2543';


}


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtBasesCalidad
 *
 * @ORM\Table(name="ft_bases_calidad")
 * @ORM\Entity
 */
class FtBasesCalidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_bases_calidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftBasesCalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_soporte", type="string", length=255, nullable=false)
     */
    private $anexoSoporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_base", type="text", length=65535, nullable=true)
     */
    private $descripcionBase;

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
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1251';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_base_calidad", type="integer", nullable=false)
     */
    private $tipoBaseCalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="version_base_calidad", type="string", length=255, nullable=true)
     */
    private $versionBaseCalidad;


}


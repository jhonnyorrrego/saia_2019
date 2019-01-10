<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDarBajaActivo
 *
 * @ORM\Table(name="ft_dar_baja_activo")
 * @ORM\Entity
 */
class FtDarBajaActivo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_dar_baja_activo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftDarBajaActivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="comprador_receptor", type="integer", nullable=true)
     */
    private $compradorReceptor;

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
     * @ORM\Column(name="fecha_baja", type="date", nullable=false)
     */
    private $fechaBaja;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_registro_activos_fijos", type="integer", nullable=false)
     */
    private $ftRegistroActivosFijos;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '909';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_baja", type="integer", nullable=false)
     */
    private $tipoBaja;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_baja", type="string", length=255, nullable=true)
     */
    private $valorBaja;


}


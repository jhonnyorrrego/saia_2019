<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtNovedadDespacho
 *
 * @ORM\Table(name="ft_novedad_despacho", indexes={@ORM\Index(name="i_ft_novedad_despacho_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtNovedadDespacho
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_novedad_despacho", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftNovedadDespacho;

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
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1215';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_despacho_ingresados", type="integer", nullable=false)
     */
    private $ftDespachoIngresados;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="novedad", type="string", length=255, nullable=false)
     */
    private $novedad;

    /**
     * @var string
     *
     * @ORM\Column(name="item_radicacion", type="string", length=255, nullable=false)
     */
    private $itemRadicacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_novedad", type="datetime", nullable=false)
     */
    private $fechaNovedad;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_soporte", type="string", length=255, nullable=true)
     */
    private $anexoSoporte;


}

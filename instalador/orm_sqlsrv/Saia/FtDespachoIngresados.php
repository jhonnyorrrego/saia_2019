<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDespachoIngresados
 *
 * @ORM\Table(name="ft_despacho_ingresados", indexes={@ORM\Index(name="i_ft_despacho_ingresados_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtDespachoIngresados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_despacho_ingresados", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftDespachoIngresados;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1215';

    /**
     * @var integer
     *
     * @ORM\Column(name="mensajero", type="integer", nullable=false)
     */
    private $mensajero;

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
     * @var string
     *
     * @ORM\Column(name="fecha_entrega", type="string", length=255, nullable=true)
     */
    private $fechaEntrega;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="iddestino_radicacion", type="string", length=255, nullable=false)
     */
    private $iddestinoRadicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo", type="string", length=255, nullable=true)
     */
    private $anexo;

    /**
     * @var string
     *
     * @ORM\Column(name="docs_seleccionados", type="string", length=255, nullable=true)
     */
    private $docsSeleccionados;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_recorrido", type="integer", nullable=false)
     */
    private $tipoRecorrido;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_mensajero", type="string", length=255, nullable=true)
     */
    private $tipoMensajero = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="idft_ruta_dist", type="string", length=255, nullable=true)
     */
    private $idftRutaDist;


}

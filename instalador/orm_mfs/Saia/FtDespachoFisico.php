<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDespachoFisico
 *
 * @ORM\Table(name="ft_despacho_fisico", indexes={@ORM\Index(name="i_ft_despacho_fisico_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtDespachoFisico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_despacho_fisico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftDespachoFisico;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1214';

    /**
     * @var string
     *
     * @ORM\Column(name="docs_seleccionados", type="string", length=255, nullable=false)
     */
    private $docsSeleccionados;

    /**
     * @var integer
     *
     * @ORM\Column(name="mensajero", type="integer", nullable=true)
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
     * @ORM\Column(name="fecha_despacho", type="string", length=255, nullable=true)
     */
    private $fechaDespacho;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';


}


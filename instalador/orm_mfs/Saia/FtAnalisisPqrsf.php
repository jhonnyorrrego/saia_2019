<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAnalisisPqrsf
 *
 * @ORM\Table(name="ft_analisis_pqrsf", indexes={@ORM\Index(name="i_ft_analisis_pqrsf_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtAnalisisPqrsf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_analisis_pqrsf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftAnalisisPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_pqrsf", type="integer", nullable=false)
     */
    private $ftPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1047';

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
     * @ORM\Column(name="analisis_causas", type="string", length=255, nullable=false)
     */
    private $analisisCausas;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_causas", type="integer", nullable=false)
     */
    private $itemCausas;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_clasificacion_pqrsf", type="integer", nullable=false)
     */
    private $ftClasificacionPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';


}


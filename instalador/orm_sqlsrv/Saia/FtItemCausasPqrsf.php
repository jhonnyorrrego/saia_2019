<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemCausasPqrsf
 *
 * @ORM\Table(name="ft_item_causas_pqrsf", indexes={@ORM\Index(name="i_ft_item_causas_pqrsf_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtItemCausasPqrsf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_causas_pqrsf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftItemCausasPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_analisis_pqrsf", type="integer", nullable=false)
     */
    private $ftAnalisisPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1049';

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
     * @ORM\Column(name="accion_causa", type="string", length=255, nullable=false)
     */
    private $accionCausa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_limite", type="date", nullable=false)
     */
    private $fechaLimite;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255, nullable=false)
     */
    private $responsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="transferido", type="integer", nullable=true)
     */
    private $transferido = '1';


}

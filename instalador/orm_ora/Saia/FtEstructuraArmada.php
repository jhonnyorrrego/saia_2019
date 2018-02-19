<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEstructuraArmada
 *
 * @ORM\Table(name="FT_ESTRUCTURA_ARMADA", indexes={@ORM\Index(name="ft_estructura_armada_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class FtEstructuraArmada
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '21';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_FRENTE", type="string", length=255, nullable=false)
     */
    private $nombreFrente;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_ESTRUCTURA", type="string", length=255, nullable=true)
     */
    private $nombreEstructura;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ESTRUCTURA_ARMADA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ESTRUCTURA_ARMADA_IDFT_ESTR", allocationSize=1, initialValue=1)
     */
    private $idftEstructuraArmada;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPENDENCIA", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENCABEZADO", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="FIRMA", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_DOC", type="integer", nullable=false)
     */
    private $estadoDoc = '2';


}


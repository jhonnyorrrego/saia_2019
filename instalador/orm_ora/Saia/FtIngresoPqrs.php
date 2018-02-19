<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtIngresoPqrs
 *
 * @ORM\Table(name="FT_INGRESO_PQRS", indexes={@ORM\Index(name="ft_ingreso_pqrs_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class FtIngresoPqrs
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=true)
     */
    private $serieIdserie = '422';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_INGRESO_PQRS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_INGRESO_PQRS_IDFT_INGRESO_P", allocationSize=1, initialValue=1)
     */
    private $idftIngresoPqrs;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPENDENCIA", type="integer", nullable=true)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENCABEZADO", type="integer", nullable=true)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="FIRMA", type="integer", nullable=true)
     */
    private $firma = '1';


}


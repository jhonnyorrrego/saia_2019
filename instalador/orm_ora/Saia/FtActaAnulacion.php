<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtActaAnulacion
 *
 * @ORM\Table(name="FT_ACTA_ANULACION", indexes={@ORM\Index(name="ft_acta_anulacion_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class FtActaAnulacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=true)
     */
    private $serieIdserie = '421';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ACTA_ANULACION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ACTA_ANULACION_IDFT_ACTA_AN", allocationSize=1, initialValue=1)
     */
    private $idftActaAnulacion;

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


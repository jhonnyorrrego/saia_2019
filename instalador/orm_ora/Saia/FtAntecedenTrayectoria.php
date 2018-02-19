<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAntecedenTrayectoria
 *
 * @ORM\Table(name="FT_ANTECEDEN_TRAYECTORIA", indexes={@ORM\Index(name="ft_anteceden_trayectoria_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_anteceden_tr", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtAntecedenTrayectoria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ENTREVISTA_ESTRUCTURADA", type="integer", nullable=false)
     */
    private $ftEntrevistaEstructurada;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '122';

    /**
     * @var string
     *
     * @ORM\Column(name="PERTENECIO_GRUPO", type="string", length=255, nullable=false)
     */
    private $pertenecioGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PERTENECIO_GRUPO", type="string", length=255, nullable=true)
     */
    private $otroPertenecioGrupo;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ANTECEDEN_TRAYECTORIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ANTECEDEN_TRAYECTORIA_IDFT_", allocationSize=1, initialValue=1)
     */
    private $idftAntecedenTrayectoria;

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
     * @var string
     *
     * @ORM\Column(name="IDFORMATO_ITEM1", type="string", length=255, nullable=true)
     */
    private $idformatoItem1;

    /**
     * @var string
     *
     * @ORM\Column(name="IDFORMATO_ITEM2", type="string", length=255, nullable=true)
     */
    private $idformatoItem2;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}


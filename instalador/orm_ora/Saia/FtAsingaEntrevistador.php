<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAsingaEntrevistador
 *
 * @ORM\Table(name="FT_ASINGA_ENTREVISTADOR", indexes={@ORM\Index(name="ft_asinga_entrevistador_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_asinga_entre", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_gestion_citacion", columns={"FT_GESTION_CITACION"})})
 * @ORM\Entity
 */
class FtAsingaEntrevistador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_GESTION_CITACION", type="integer", nullable=false)
     */
    private $ftGestionCitacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '8';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ASIGNACION", type="date", nullable=false)
     */
    private $fechaAsignacion = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_ENTREVISTADOR", type="string", length=255, nullable=false)
     */
    private $nombreEntrevistador;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ASINGA_ENTREVISTADOR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ASINGA_ENTREVISTADOR_IDFT_A", allocationSize=1, initialValue=1)
     */
    private $idftAsingaEntrevistador;

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
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtObservacionesEncues
 *
 * @ORM\Table(name="FT_OBSERVACIONES_ENCUES", indexes={@ORM\Index(name="i_ft_reintegracion", columns={"FT_REINTEGRACION"})})
 * @ORM\Entity
 */
class FtObservacionesEncues
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_REINTEGRACION", type="integer", nullable=false)
     */
    private $ftReintegracion;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_PREGUNTA", type="string", length=255, nullable=false)
     */
    private $numeroPregunta;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_PREGUNTA", type="text", nullable=false)
     */
    private $observacionPregunta = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_OBSERVACIONES_ENCUES", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_OBSERVACIONES_ENCUES_IDFT_O", allocationSize=1, initialValue=1)
     */
    private $idftObservacionesEncues;


}


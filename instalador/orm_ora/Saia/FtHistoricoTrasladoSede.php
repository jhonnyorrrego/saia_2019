<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtHistoricoTrasladoSede
 *
 * @ORM\Table(name="FT_HISTORICO_TRASLADO_SEDE", indexes={@ORM\Index(name="i_ft_recepcion_acuerdos", columns={"FT_RECEPCION_ACUERDOS"})})
 * @ORM\Entity
 */
class FtHistoricoTrasladoSede
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_RECEPCION_ACUERDOS", type="integer", nullable=false)
     */
    private $ftRecepcionAcuerdos;

    /**
     * @var string
     *
     * @ORM\Column(name="SEDE_REGIONAL_ANTERIOR", type="string", length=255, nullable=false)
     */
    private $sedeRegionalAnterior;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_HISTORICO_TRASLADO_SEDE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_HISTORICO_TRASLADO_SEDE_IDF", allocationSize=1, initialValue=1)
     */
    private $idftHistoricoTrasladoSede;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="SEDE_REGIONAL_NUEVA", type="string", length=255, nullable=true)
     */
    private $sedeRegionalNueva;

    /**
     * @var string
     *
     * @ORM\Column(name="PASO_REALIZA_TRANSFE", type="string", length=255, nullable=true)
     */
    private $pasoRealizaTransfe;


}


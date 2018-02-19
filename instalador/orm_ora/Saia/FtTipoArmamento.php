<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtTipoArmamento
 *
 * @ORM\Table(name="FT_TIPO_ARMAMENTO", indexes={@ORM\Index(name="ft_tipo_armamento_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class FtTipoArmamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=true)
     */
    private $serieIdserie = '131';

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ENTREVISTA_ESTRUCTURADA", type="integer", nullable=true)
     */
    private $ftEntrevistaEstructurada;

    /**
     * @var string
     *
     * @ORM\Column(name="QUIEN_SUMINISTRA_ARMA", type="string", length=255, nullable=true)
     */
    private $quienSuministraArma;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_QUIEN_SUMINISTRA_ARMA", type="string", length=255, nullable=true)
     */
    private $otroQuienSuministraArma;

    /**
     * @var string
     *
     * @ORM\Column(name="PAISES_TRAFICANTES", type="string", length=255, nullable=true)
     */
    private $paisesTraficantes;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_TIPO_ARMAMENTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_TIPO_ARMAMENTO_IDFT_TIPO_AR", allocationSize=1, initialValue=1)
     */
    private $idftTipoArmamento;

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


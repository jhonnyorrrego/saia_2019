<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEntrevistaRetiro
 *
 * @ORM\Table(name="ft_entrevista_retiro")
 * @ORM\Entity
 */
class FtEntrevistaRetiro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_entrevista_retiro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftEntrevistaRetiro;

    /**
     * @var string
     *
     * @ORM\Column(name="ampliacion", type="text", length=65535, nullable=false)
     */
    private $ampliacion;

    /**
     * @var string
     *
     * @ORM\Column(name="asp_mejorar", type="text", length=65535, nullable=false)
     */
    private $aspMejorar;

    /**
     * @var string
     *
     * @ORM\Column(name="asp_mejora_cargo", type="text", length=65535, nullable=false)
     */
    private $aspMejoraCargo;

    /**
     * @var string
     *
     * @ORM\Column(name="asp_negativos", type="text", length=65535, nullable=false)
     */
    private $aspNegativos;

    /**
     * @var string
     *
     * @ORM\Column(name="asp_neg_cargo", type="text", length=65535, nullable=false)
     */
    private $aspNegCargo;

    /**
     * @var string
     *
     * @ORM\Column(name="asp_positivos", type="text", length=65535, nullable=false)
     */
    private $aspPositivos;

    /**
     * @var string
     *
     * @ORM\Column(name="asp_pos_cargo", type="text", length=65535, nullable=false)
     */
    private $aspPosCargo;

    /**
     * @var string
     *
     * @ORM\Column(name="concepto_entre", type="text", length=65535, nullable=false)
     */
    private $conceptoEntre;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_entrevista", type="date", nullable=false)
     */
    private $fechaEntrevista;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_retiro", type="date", nullable=false)
     */
    private $fechaRetiro;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_hoja_vida", type="integer", nullable=false)
     */
    private $ftHojaVida;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="string", length=255, nullable=false)
     */
    private $justificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="motivo_retiro", type="integer", nullable=false)
     */
    private $motivoRetiro;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="relaciones_comp", type="text", length=65535, nullable=false)
     */
    private $relacionesComp;

    /**
     * @var string
     *
     * @ORM\Column(name="relaciones_jefes", type="text", length=65535, nullable=false)
     */
    private $relacionesJefes;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1097';


}


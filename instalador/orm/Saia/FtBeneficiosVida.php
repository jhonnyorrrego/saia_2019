<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtBeneficiosVida
 *
 * @ORM\Table(name="ft_beneficios_vida")
 * @ORM\Entity
 */
class FtBeneficiosVida
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_beneficios_vida", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftBeneficiosVida;

    /**
     * @var integer
     *
     * @ORM\Column(name="beneficio_opc", type="integer", nullable=false)
     */
    private $beneficioOpc;

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
     * @ORM\Column(name="fecha_beneficios", type="date", nullable=false)
     */
    private $fechaBeneficios;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date", nullable=true)
     */
    private $fechaCreacion;

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
     * @ORM\Column(name="obs_beneficio", type="text", length=65535, nullable=false)
     */
    private $obsBeneficio;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1204';


}


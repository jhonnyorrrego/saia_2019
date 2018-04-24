<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtExperiencia
 *
 * @ORM\Table(name="ft_experiencia")
 * @ORM\Entity
 */
class FtExperiencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_experiencia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftExperiencia;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_experiencia", type="string", length=255, nullable=true)
     */
    private $anexoExperiencia;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo_experiencia", type="string", length=255, nullable=false)
     */
    private $cargoExperiencia;

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
     * @var string
     *
     * @ORM\Column(name="empresa", type="string", length=255, nullable=false)
     */
    private $empresa;

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
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1025';

    /**
     * @var string
     *
     * @ORM\Column(name="tiempo_servicio", type="string", length=255, nullable=false)
     */
    private $tiempoServicio;


}


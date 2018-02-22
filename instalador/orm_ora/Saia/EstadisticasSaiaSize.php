<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstadisticasSaiaSize
 *
 * @ORM\Table(name="estadisticas_saia_size")
 * @ORM\Entity
 */
class EstadisticasSaiaSize
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idestadisticas_saia_size", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="ESTADISTICAS_SAIA_SIZE_IDESTAD", allocationSize=1, initialValue=1)
     */
    private $idestadisticasSaiaSize;

    /**
     * @var string
     *
     * @ORM\Column(name="tamanio", type="string", length=255, nullable=false)
     */
    private $tamanio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicial", type="date", nullable=false)
     */
    private $fechaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final", type="date", nullable=false)
     */
    private $fechaFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=false)
     */
    private $observaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="date", nullable=false)
     */
    private $fechaRegistro;


}


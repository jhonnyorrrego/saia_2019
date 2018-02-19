<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CalendarioSaia
 *
 * @ORM\Table(name="CALENDARIO_SAIA")
 * @ORM\Entity
 */
class CalendarioSaia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCALENDARIO_SAIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CALENDARIO_SAIA_IDCALENDARIO_S", allocationSize=1, initialValue=1)
     */
    private $idcalendarioSaia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO", type="integer", nullable=true)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTILO", type="string", length=255, nullable=true)
     */
    private $estilo;

    /**
     * @var string
     *
     * @ORM\Column(name="DATOS", type="string", length=255, nullable=true)
     */
    private $datos;

    /**
     * @var string
     *
     * @ORM\Column(name="ENCABEZADO_IZQUIERDA", type="string", length=255, nullable=true)
     */
    private $encabezadoIzquierda;

    /**
     * @var string
     *
     * @ORM\Column(name="ENCABEZADO_CENTRO", type="string", length=255, nullable=true)
     */
    private $encabezadoCentro;

    /**
     * @var string
     *
     * @ORM\Column(name="ENCABEZADO_DERECHO", type="string", length=255, nullable=true)
     */
    private $encabezadoDerecho;

    /**
     * @var string
     *
     * @ORM\Column(name="ADICIONAR_EVENTO", type="string", length=255, nullable=true)
     */
    private $adicionarEvento;


}


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CalendarioSaia
 *
 * @ORM\Table(name="calendario_saia")
 * @ORM\Entity
 */
class CalendarioSaia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcalendario_saia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idcalendarioSaia;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="estilo", type="string", length=255, nullable=true)
     */
    private $estilo;

    /**
     * @var string
     *
     * @ORM\Column(name="datos", type="string", length=255, nullable=false)
     */
    private $datos;

    /**
     * @var string
     *
     * @ORM\Column(name="encabezado_izquierda", type="string", length=255, nullable=false)
     */
    private $encabezadoIzquierda;

    /**
     * @var string
     *
     * @ORM\Column(name="encabezado_centro", type="string", length=255, nullable=false)
     */
    private $encabezadoCentro;

    /**
     * @var string
     *
     * @ORM\Column(name="encabezado_derecho", type="string", length=255, nullable=false)
     */
    private $encabezadoDerecho;

    /**
     * @var string
     *
     * @ORM\Column(name="adicionar_evento", type="string", length=255, nullable=true)
     */
    private $adicionarEvento;

    /**
     * @var string
     *
     * @ORM\Column(name="busqueda_avanzada", type="string", length=255, nullable=true)
     */
    private $busquedaAvanzada;


}

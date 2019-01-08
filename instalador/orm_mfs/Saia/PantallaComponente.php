<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaComponente
 *
 * @ORM\Table(name="pantalla_componente")
 * @ORM\Entity
 */
class PantallaComponente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_componente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpantallaComponente;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="clase", type="string", length=255, nullable=false)
     */
    private $clase;

    /**
     * @var string
     *
     * @ORM\Column(name="componente", type="text", length=65535, nullable=false)
     */
    private $componente;

    /**
     * @var string
     *
     * @ORM\Column(name="opciones", type="text", length=65535, nullable=false)
     */
    private $opciones;

    /**
     * @var string
     *
     * @ORM\Column(name="procesar", type="string", length=255, nullable=true)
     */
    private $procesar;

    /**
     * @var string
     *
     * @ORM\Column(name="categoria", type="string", length=255, nullable=false)
     */
    private $categoria = 'I';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="librerias", type="string", length=3999, nullable=true)
     */
    private $librerias;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_componente", type="integer", nullable=false)
     */
    private $tipoComponente = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="eliminar", type="string", length=255, nullable=false)
     */
    private $eliminar;


}


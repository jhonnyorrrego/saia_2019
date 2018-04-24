<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ejecutor
 *
 * @ORM\Table(name="ejecutor", indexes={@ORM\Index(name="nombre", columns={"nombre"})})
 * @ORM\Entity
 */
class Ejecutor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idejecutor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idejecutor;

    /**
     * @var string
     *
     * @ORM\Column(name="identificacion", type="string", length=50, nullable=true)
     */
    private $identificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="datetime", nullable=false)
     */
    private $fechaIngreso = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_ejecutor", type="integer", nullable=false)
     */
    private $tipoEjecutor = '1';


}

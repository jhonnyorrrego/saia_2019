<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ejecutor
 *
 * @ORM\Table(name="ejecutor", indexes={@ORM\Index(name="i_ejecutor_identificaci", columns={"identificacion"}),@ORM\Index(name="nombre", columns={"nombre"})})
 * @ORM\Entity
 */
class Ejecutor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idejecutor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idejecutor;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="identificacion", type="string", length=50, nullable=true)
     */
    private $identificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="date", nullable=false)
     */
    private $fechaIngreso = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_ejecutor", type="integer", nullable=true)
     */
    private $tipoEjecutor = '1';


}

<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plantillas
 *
 * @ORM\Table(name="PLANTILLAS")
 * @ORM\Entity
 */
class Plantillas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPLANTILLA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PLANTILLAS_IDPLANTILLA_seq", allocationSize=1, initialValue=1)
     */
    private $idplantilla;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="IMAGEN", type="string", length=100, nullable=true)
     */
    private $imagen;

    /**
     * @var integer
     *
     * @ORM\Column(name="CONTADOR_IDCONTADOR", type="integer", nullable=false)
     */
    private $contadorIdcontador;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_PLANTILLA", type="string", length=255, nullable=false)
     */
    private $rutaPlantilla;

    /**
     * @var string
     *
     * @ORM\Column(name="MOSTRAR", type="string", length=1, nullable=false)
     */
    private $mostrar;


}


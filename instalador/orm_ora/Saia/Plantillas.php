<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plantillas
 *
 * @ORM\Table(name="plantillas")
 * @ORM\Entity
 */
class Plantillas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idplantilla", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="PLANTILLAS_IDPLANTILLA_seq", allocationSize=1, initialValue=1)
     */
    private $idplantilla;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=100, nullable=true)
     */
    private $imagen;

    /**
     * @var integer
     *
     * @ORM\Column(name="contador_idcontador", type="integer", nullable=false)
     */
    private $contadorIdcontador;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_plantilla", type="string", length=255, nullable=false)
     */
    private $rutaPlantilla;

    /**
     * @var string
     *
     * @ORM\Column(name="mostrar", type="string", length=1, nullable=false)
     */
    private $mostrar;


}


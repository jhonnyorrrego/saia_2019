<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entidad
 *
 * @ORM\Table(name="ENTIDAD")
 * @ORM\Entity
 */
class Entidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDENTIDAD", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ENTIDAD_IDENTIDAD_seq", allocationSize=1, initialValue=1)
     */
    private $identidad;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;


}

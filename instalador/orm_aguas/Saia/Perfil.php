<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Perfil
 *
 * @ORM\Table(name="PERFIL")
 * @ORM\Entity
 */
class Perfil
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPERFIL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PERFIL_IDPERFIL_seq", allocationSize=1, initialValue=1)
     */
    private $idperfil;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;


}

<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pais
 *
 * @ORM\Table(name="PAIS")
 * @ORM\Entity
 */
class Pais
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPAIS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PAIS_IDPAIS_seq", allocationSize=1, initialValue=1)
     */
    private $idpais;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;


}

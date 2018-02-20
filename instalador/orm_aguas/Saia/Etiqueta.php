<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etiqueta
 *
 * @ORM\Table(name="ETIQUETA")
 * @ORM\Entity
 */
class Etiqueta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDETIQUETA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ETIQUETA_IDETIQUETA_seq", allocationSize=1, initialValue=1)
     */
    private $idetiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="FUNCIONARIO", type="string", length=255, nullable=false)
     */
    private $funcionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRIVADA_SAIA", type="integer", nullable=false)
     */
    private $privadaSaia = '0';


}

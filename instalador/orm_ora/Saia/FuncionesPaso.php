<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionesPaso
 *
 * @ORM\Table(name="FUNCIONES_PASO")
 * @ORM\Entity
 */
class FuncionesPaso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFUNCIONES_PASO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FUNCIONES_PASO_IDFUNCIONES_PAS", allocationSize=1, initialValue=1)
     */
    private $idfuncionesPaso;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="PARAMETROS", type="string", length=255, nullable=true)
     */
    private $parametros;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBRERIA", type="string", length=255, nullable=true)
     */
    private $libreria;


}

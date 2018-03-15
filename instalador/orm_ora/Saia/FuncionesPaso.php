<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionesPaso
 *
 * @ORM\Table(name="funciones_paso")
 * @ORM\Entity
 */
class FuncionesPaso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfunciones_paso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idfuncionesPaso;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="parametros", type="string", length=255, nullable=true)
     */
    private $parametros;

    /**
     * @var string
     *
     * @ORM\Column(name="libreria", type="string", length=255, nullable=false)
     */
    private $libreria;


}

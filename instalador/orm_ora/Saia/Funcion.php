<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Funcion
 *
 * @ORM\Table(name="FUNCION")
 * @ORM\Entity
 */
class Funcion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFUNCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FUNCION_IDFUNCION_seq", allocationSize=1, initialValue=1)
     */
    private $idfuncion;

    /**
     * @var integer
     *
     * @ORM\Column(name="COMPONENTE_PANTALLA_IDPANTALLA", type="integer", nullable=true)
     */
    private $componentePantallaIdpantalla = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="COMPONENTE_IDCOMPONENTE", type="integer", nullable=true)
     */
    private $componenteIdcomponente = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="PANTALLA_IDPANTALLA", type="integer", nullable=true)
     */
    private $pantallaIdpantalla = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre = '';

    /**
     * @var string
     *
     * @ORM\Column(name="PARAMETROS", type="string", length=255, nullable=true)
     */
    private $parametros;

    /**
     * @var string
     *
     * @ORM\Column(name="RETORNO", type="string", length=255, nullable=true)
     */
    private $retorno;

    /**
     * @var string
     *
     * @ORM\Column(name="CLASE", type="string", length=255, nullable=true)
     */
    private $clase = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ACCION", type="string", length=100, nullable=true)
     */
    private $accion = '';


}


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaFuncion
 *
 * @ORM\Table(name="PANTALLA_FUNCION", indexes={@ORM\Index(name="i_pantalla_f_ayuda_ctx", columns={"AYUDA"})})
 * @ORM\Entity
 */
class PantallaFuncion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPANTALLA_FUNCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_FUNCION_IDPANTALLA_FU", allocationSize=1, initialValue=1)
     */
    private $idpantallaFuncion;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="PARAMETROS", type="string", length=255, nullable=true)
     */
    private $parametros;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDPANTALLA_LIBRERIA", type="integer", nullable=false)
     */
    private $fkIdpantallaLibreria;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_FUNCION", type="string", length=50, nullable=false)
     */
    private $tipoFuncion;

    /**
     * @var string
     *
     * @ORM\Column(name="AYUDA", type="text", nullable=true)
     */
    private $ayuda;


}

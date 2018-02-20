<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaFuncion
 *
 * @ORM\Table(name="pantalla_funcion")
 * @ORM\Entity
 */
class PantallaFuncion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_funcion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpantallaFuncion;

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
     * @var integer
     *
     * @ORM\Column(name="fk_idpantalla_libreria", type="integer", nullable=false)
     */
    private $fkIdpantallaLibreria;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_funcion", type="string", length=50, nullable=false)
     */
    private $tipoFuncion;

    /**
     * @var string
     *
     * @ORM\Column(name="ayuda", type="text", nullable=true)
     */
    private $ayuda;


}

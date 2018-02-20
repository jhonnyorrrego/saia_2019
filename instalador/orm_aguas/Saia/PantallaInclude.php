<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaInclude
 *
 * @ORM\Table(name="pantalla_include", indexes={@ORM\Index(name="i_pant_include_pantalla", columns={"pantalla_idpantalla"}), @ORM\Index(name="i_pant_include_pant_fklib", columns={"fk_idpantalla_libreria"})})
 * @ORM\Entity
 */
class PantallaInclude
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_include", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpantallaInclude;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar_incluir", type="string", length=255, nullable=true)
     */
    private $lugarIncluir = 'footer';

    /**
     * @var string
     *
     * @ORM\Column(name="acciones_include", type="string", length=255, nullable=true)
     */
    private $accionesInclude = 'a,e,m';

    /**
     * @var integer
     *
     * @ORM\Column(name="pantalla_idpantalla", type="integer", nullable=false)
     */
    private $pantallaIdpantalla;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idpantalla_libreria", type="integer", nullable=false)
     */
    private $fkIdpantallaLibreria;


}

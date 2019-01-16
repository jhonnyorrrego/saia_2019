<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaFuncionExe
 *
 * @ORM\Table(name="pantalla_funcion_exe", indexes={@ORM\Index(name="i_pant_func_exe_idpantalla", columns={"pantalla_idpantalla"}), @ORM\Index(name="i_pant_func_exe_pant_funct", columns={"fk_idpantalla_funcion"})})
 * @ORM\Entity
 */
class PantallaFuncionExe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_funcion_exe", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpantallaFuncionExe;

    /**
     * @var string
     *
     * @ORM\Column(name="accion", type="string", length=255, nullable=false)
     */
    private $accion;

    /**
     * @var integer
     *
     * @ORM\Column(name="momento", type="integer", nullable=false)
     */
    private $momento = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="vistas", type="string", length=50, nullable=false)
     */
    private $vistas = 'v';

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="pantalla_idpantalla", type="integer", nullable=false)
     */
    private $pantallaIdpantalla;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idpantalla_funcion", type="integer", nullable=false)
     */
    private $fkIdpantallaFuncion;


}

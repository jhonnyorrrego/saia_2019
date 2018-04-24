<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaFuncParam
 *
 * @ORM\Table(name="pantalla_func_param", indexes={@ORM\Index(name="fk_pantalla_func_param_pantalla_funcion_exe1_idx", columns={"fk_idpantalla_funcion_exe"})})
 * @ORM\Entity
 */
class PantallaFuncParam
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_func_param", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpantallaFuncParam;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="text", length=65535, nullable=false)
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idpantalla_funcion_exe", type="integer", nullable=false)
     */
    private $fkIdpantallaFuncionExe;


}

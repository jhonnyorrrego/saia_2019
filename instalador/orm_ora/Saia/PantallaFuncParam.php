<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaFuncParam
 *
 * @ORM\Table(name="pantalla_func_param", indexes={@ORM\Index(name="i_panfunpar_fkpant_funcexe", columns={"fk_idpantalla_funcion_exe"})})
 * @ORM\Entity
 */
class PantallaFuncParam
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_func_param", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @ORM\Column(name="valor", type="text", nullable=false)
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

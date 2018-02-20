<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaFuncParam
 *
 * @ORM\Table(name="PANTALLA_FUNC_PARAM", indexes={@ORM\Index(name="i_pantalla_f_valor_ctx", columns={"VALOR"})})
 * @ORM\Entity
 */
class PantallaFuncParam
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPANTALLA_FUNC_PARAM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_FUNC_PARAM_IDPANTALLA", allocationSize=1, initialValue=1)
     */
    private $idpantallaFuncParam;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="VALOR", type="text", nullable=false)
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO", type="integer", nullable=false)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDPANTALLA_FUNCION_EXE", type="integer", nullable=false)
     */
    private $fkIdpantallaFuncionExe;


}

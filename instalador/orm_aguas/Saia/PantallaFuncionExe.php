<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaFuncionExe
 *
 * @ORM\Table(name="PANTALLA_FUNCION_EXE")
 * @ORM\Entity
 */
class PantallaFuncionExe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPANTALLA_FUNCION_EXE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_FUNCION_EXE_IDPANTALL", allocationSize=1, initialValue=1)
     */
    private $idpantallaFuncionExe;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCION", type="string", length=255, nullable=false)
     */
    private $accion;

    /**
     * @var integer
     *
     * @ORM\Column(name="MOMENTO", type="integer", nullable=false)
     */
    private $momento = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="VISTAS", type="string", length=50, nullable=false)
     */
    private $vistas = 'v';

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=false)
     */
    private $orden = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="PANTALLA_IDPANTALLA", type="integer", nullable=false)
     */
    private $pantallaIdpantalla;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDPANTALLA_FUNCION", type="integer", nullable=false)
     */
    private $fkIdpantallaFuncion;


}

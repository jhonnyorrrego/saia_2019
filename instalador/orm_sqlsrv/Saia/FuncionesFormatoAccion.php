<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionesFormatoAccion
 *
 * @ORM\Table(name="funciones_formato_accion")
 * @ORM\Entity
 */
class FuncionesFormatoAccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfunciones_formato_accion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfuncionesFormatoAccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="idfunciones_formato", type="integer", nullable=false)
     */
    private $idfuncionesFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="accion_idaccion", type="integer", nullable=false)
     */
    private $accionIdaccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="formato_idformato", type="integer", nullable=false)
     */
    private $formatoIdformato;

    /**
     * @var string
     *
     * @ORM\Column(name="momento", type="string", length=20, nullable=false)
     */
    private $momento = 'ANTERIOR';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden = '1';


}

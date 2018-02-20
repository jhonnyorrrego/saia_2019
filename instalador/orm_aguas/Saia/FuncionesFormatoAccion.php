<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionesFormatoAccion
 *
 * @ORM\Table(name="FUNCIONES_FORMATO_ACCION", indexes={@ORM\Index(name="i_funciones_fo_idfunciones_", columns={"IDFUNCIONES_FORMATO"})})
 * @ORM\Entity
 */
class FuncionesFormatoAccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFUNCIONES_FORMATO_ACCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FUNCIONES_FORMATO_ACCION_IDFUN", allocationSize=1, initialValue=1)
     */
    private $idfuncionesFormatoAccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFUNCIONES_FORMATO", type="integer", nullable=false)
     */
    private $idfuncionesFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACCION_IDACCION", type="integer", nullable=false)
     */
    private $accionIdaccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMATO_IDFORMATO", type="integer", nullable=false)
     */
    private $formatoIdformato;

    /**
     * @var string
     *
     * @ORM\Column(name="MOMENTO", type="string", length=20, nullable=false)
     */
    private $momento = 'ANTERIOR';

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=false)
     */
    private $orden = '1';


}

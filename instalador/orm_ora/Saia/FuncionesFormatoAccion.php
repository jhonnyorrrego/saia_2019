<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionesFormatoAccion
 *
 * @ORM\Table(name="FUNCIONES_FORMATO_ACCION")
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
     * @ORM\Column(name="IDFUNCIONES_FORMATO", type="integer", nullable=true)
     */
    private $idfuncionesFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACCION_IDACCION", type="integer", nullable=true)
     */
    private $accionIdaccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMATO_IDFORMATO", type="integer", nullable=true)
     */
    private $formatoIdformato;

    /**
     * @var string
     *
     * @ORM\Column(name="MOMENTO", type="string", length=20, nullable=true)
     */
    private $momento = 'ANTERIOR';

    /**
     * @var boolean
     *
     * @ORM\Column(name="ESTADO", type="boolean", nullable=true)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=true)
     */
    private $orden = '1';


}


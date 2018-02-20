<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReferenciaSalida
 *
 * @ORM\Table(name="REFERENCIA_SALIDA")
 * @ORM\Entity
 */
class ReferenciaSalida
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDREFERENCIA_SALIDA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="REFERENCIA_SALIDA_IDREFERENCIA", allocationSize=1, initialValue=1)
     */
    private $idreferenciaSalida;

    /**
     * @var integer
     *
     * @ORM\Column(name="COMPONENTE_PANTALLA_IDPANTALLA", type="integer", nullable=false)
     */
    private $componentePantallaIdpantalla;

    /**
     * @var integer
     *
     * @ORM\Column(name="COMPONENTE_IDCOMPONENTE", type="integer", nullable=false)
     */
    private $componenteIdcomponente;

    /**
     * @var string
     *
     * @ORM\Column(name="SQL_COMP", type="string", length=255, nullable=true)
     */
    private $sqlComp;

    /**
     * @var string
     *
     * @ORM\Column(name="DB", type="string", length=255, nullable=true)
     */
    private $db;

    /**
     * @var string
     *
     * @ORM\Column(name="VALOR", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=7, nullable=true)
     */
    private $tipo;


}


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReferenciaSalida
 *
 * @ORM\Table(name="referencia_salida")
 * @ORM\Entity
 */
class ReferenciaSalida
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreferencia_salida", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="REFERENCIA_SALIDA_IDREFERENCIA", allocationSize=1, initialValue=1)
     */
    private $idreferenciaSalida;

    /**
     * @var integer
     *
     * @ORM\Column(name="componente_pantalla_idpantalla", type="integer", nullable=false)
     */
    private $componentePantallaIdpantalla;

    /**
     * @var integer
     *
     * @ORM\Column(name="componente_idcomponente", type="integer", nullable=false)
     */
    private $componenteIdcomponente;

    /**
     * @var string
     *
     * @ORM\Column(name="sql_comp", type="string", length=255, nullable=true)
     */
    private $sqlComp;

    /**
     * @var string
     *
     * @ORM\Column(name="db", type="string", length=255, nullable=true)
     */
    private $db;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=7, nullable=true)
     */
    private $tipo;


}


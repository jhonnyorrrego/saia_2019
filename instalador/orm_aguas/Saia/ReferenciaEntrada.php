<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReferenciaEntrada
 *
 * @ORM\Table(name="referencia_entrada")
 * @ORM\Entity
 */
class ReferenciaEntrada
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreferencia_entrada", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="REFERENCIA_ENTRADA_IDREFERENCI", allocationSize=1, initialValue=1)
     */
    private $idreferenciaEntrada;

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
     * @ORM\Column(name="tipo", type="string", length=7, nullable=true)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="db", type="string", length=255, nullable=true)
     */
    private $db;

    /**
     * @var string
     *
     * @ORM\Column(name="tabla", type="string", length=255, nullable=true)
     */
    private $tabla;


}


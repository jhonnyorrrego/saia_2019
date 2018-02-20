<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReferenciaEntrada
 *
 * @ORM\Table(name="REFERENCIA_ENTRADA")
 * @ORM\Entity
 */
class ReferenciaEntrada
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDREFERENCIA_ENTRADA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="REFERENCIA_ENTRADA_IDREFERENCI", allocationSize=1, initialValue=1)
     */
    private $idreferenciaEntrada;

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
     * @ORM\Column(name="TIPO", type="string", length=7, nullable=true)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="VALOR", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="DB", type="string", length=255, nullable=true)
     */
    private $db;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLA", type="string", length=255, nullable=true)
     */
    private $tabla;


}


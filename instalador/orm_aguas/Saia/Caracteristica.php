<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caracteristica
 *
 * @ORM\Table(name="caracteristica", uniqueConstraints={@ORM\UniqueConstraint(name="caracteristica_pk", columns={"idcaracteristica", "pantalla_idpantalla", "componente_pantalla_idpantalla", "componente_idcomponente"})})
 * @ORM\Entity
 */
class Caracteristica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcaracteristica", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="CARACTERISTICA_IDCARACTERISTIC", allocationSize=1, initialValue=1)
     */
    private $idcaracteristica;

    /**
     * @var integer
     *
     * @ORM\Column(name="pantalla_idpantalla", type="integer", nullable=false)
     */
    private $pantallaIdpantalla = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="componente_pantalla_idpantalla", type="integer", nullable=false)
     */
    private $componentePantallaIdpantalla = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="componente_idcomponente", type="integer", nullable=false)
     */
    private $componenteIdcomponente = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="categoria", type="string", length=255, nullable=true)
     */
    private $categoria;


}


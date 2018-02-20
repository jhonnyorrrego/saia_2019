<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caracteristica
 *
 * @ORM\Table(name="CARACTERISTICA", uniqueConstraints={@ORM\UniqueConstraint(name="caracteristica_pk", columns={"IDCARACTERISTICA", "PANTALLA_IDPANTALLA", "COMPONENTE_PANTALLA_IDPANTALLA", "COMPONENTE_IDCOMPONENTE"})})
 * @ORM\Entity
 */
class Caracteristica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCARACTERISTICA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CARACTERISTICA_IDCARACTERISTIC", allocationSize=1, initialValue=1)
     */
    private $idcaracteristica;

    /**
     * @var integer
     *
     * @ORM\Column(name="PANTALLA_IDPANTALLA", type="integer", nullable=false)
     */
    private $pantallaIdpantalla = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="COMPONENTE_PANTALLA_IDPANTALLA", type="integer", nullable=false)
     */
    private $componentePantallaIdpantalla = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="COMPONENTE_IDCOMPONENTE", type="integer", nullable=false)
     */
    private $componenteIdcomponente = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=100, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="VALOR", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="CATEGORIA", type="string", length=255, nullable=true)
     */
    private $categoria;


}


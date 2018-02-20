<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Componente
 *
 * @ORM\Table(name="componente", uniqueConstraints={@ORM\UniqueConstraint(name="componente_pk", columns={"idcomponente", "pantalla_idpantalla"})})
 * @ORM\Entity
 */
class Componente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcomponente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="COMPONENTE_IDCOMPONENTE_seq", allocationSize=1, initialValue=1)
     */
    private $idcomponente;

    /**
     * @var integer
     *
     * @ORM\Column(name="pantalla_idpantalla", type="integer", nullable=false)
     */
    private $pantallaIdpantalla = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=4000, nullable=true)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="posx", type="smallint", nullable=true)
     */
    private $posx;

    /**
     * @var integer
     *
     * @ORM\Column(name="posy", type="smallint", nullable=true)
     */
    private $posy;

    /**
     * @var string
     *
     * @ORM\Column(name="nulo", type="string", length=255, nullable=true)
     */
    private $nulo;

    /**
     * @var string
     *
     * @ORM\Column(name="primary_key", type="string", length=255, nullable=true)
     */
    private $primaryKey;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_defecto", type="string", length=255, nullable=true)
     */
    private $valorDefecto;


}


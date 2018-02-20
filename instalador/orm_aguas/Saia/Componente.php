<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Componente
 *
 * @ORM\Table(name="COMPONENTE", uniqueConstraints={@ORM\UniqueConstraint(name="componente_pk", columns={"IDCOMPONENTE", "PANTALLA_IDPANTALLA"})}, indexes={@ORM\Index(name="i_componente_tipo_ctx", columns={"TIPO"})})
 * @ORM\Entity
 */
class Componente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCOMPONENTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="COMPONENTE_IDCOMPONENTE_seq", allocationSize=1, initialValue=1)
     */
    private $idcomponente;

    /**
     * @var integer
     *
     * @ORM\Column(name="PANTALLA_IDPANTALLA", type="integer", nullable=false)
     */
    private $pantallaIdpantalla = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=4000, nullable=true)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="POSX", type="smallint", nullable=true)
     */
    private $posx;

    /**
     * @var integer
     *
     * @ORM\Column(name="POSY", type="smallint", nullable=true)
     */
    private $posy;

    /**
     * @var string
     *
     * @ORM\Column(name="NULO", type="string", length=255, nullable=true)
     */
    private $nulo;

    /**
     * @var string
     *
     * @ORM\Column(name="PRIMARY_KEY", type="string", length=255, nullable=true)
     */
    private $primaryKey;

    /**
     * @var string
     *
     * @ORM\Column(name="VALOR_DEFECTO", type="string", length=255, nullable=true)
     */
    private $valorDefecto;


}


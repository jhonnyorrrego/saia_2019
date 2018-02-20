<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoCondicional
 *
 * @ORM\Table(name="PASO_CONDICIONAL", indexes={@ORM\Index(name="i_paso_condici_idcondiciona", columns={"IDCONDICIONAL"})})
 * @ORM\Entity
 */
class PasoCondicional
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_CONDICIONAL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_CONDICIONAL_IDPASO_CONDIC", allocationSize=1, initialValue=1)
     */
    private $idpasoCondicional;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIAGRAM_IDDIAGRAM", type="integer", nullable=false)
     */
    private $diagramIddiagram;

    /**
     * @var string
     *
     * @ORM\Column(name="IDCONDICIONAL", type="string", length=255, nullable=false)
     */
    private $idcondicional;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_CONDICIONAL", type="string", length=255, nullable=false)
     */
    private $tipoCondicional;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=true)
     */
    private $etiqueta;


}

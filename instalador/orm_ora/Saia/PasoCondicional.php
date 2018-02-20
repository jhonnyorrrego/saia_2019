<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoCondicional
 *
 * @ORM\Table(name="paso_condicional", indexes={@ORM\Index(name="i_paso_condici_idcondiciona", columns={"idcondicional"})})
 * @ORM\Entity
 */
class PasoCondicional
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_condicional", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpasoCondicional;

    /**
     * @var integer
     *
     * @ORM\Column(name="diagram_iddiagram", type="integer", nullable=false)
     */
    private $diagramIddiagram;

    /**
     * @var string
     *
     * @ORM\Column(name="idcondicional", type="string", length=255, nullable=false)
     */
    private $idcondicional;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_condicional", type="string", length=255, nullable=false)
     */
    private $tipoCondicional;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=true)
     */
    private $etiqueta;


}

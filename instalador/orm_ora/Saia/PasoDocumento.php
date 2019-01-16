<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoDocumento
 *
 * @ORM\Table(name="paso_documento", indexes={@ORM\Index(name="i_paso_documento_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class PasoDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_documento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpasoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="paso_idpaso", type="integer", nullable=false)
     */
    private $pasoIdpaso;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_asignacion", type="date", nullable=false)
     */
    private $fechaAsignacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="diagram_iddiagram_instance", type="integer", nullable=false)
     */
    private $diagramIddiagramInstance;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_paso_documento", type="integer", nullable=false)
     */
    private $estadoPasoDocumento = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_limite", type="date", nullable=true)
     */
    private $fechaLimite;


}

<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoInstanciaTerminada
 *
 * @ORM\Table(name="PASO_INSTANCIA_TERMINADA", indexes={@ORM\Index(name="i_paso_instancia_terminada_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class PasoInstanciaTerminada
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_INSTANCIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_INSTANCIA_TERMINADA_IDPAS", allocationSize=1, initialValue=1)
     */
    private $idpasoInstancia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTIVIDAD_IDPASO_ACTIVIDAD", type="integer", nullable=false)
     */
    private $actividadIdpasoActividad;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="RESPONSABLE", type="integer", nullable=false)
     */
    private $responsable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_TERMINACION", type="integer", nullable=false)
     */
    private $tipoTerminacion = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_ACTIVIDAD", type="integer", nullable=false)
     */
    private $estadoActividad = '1';


}

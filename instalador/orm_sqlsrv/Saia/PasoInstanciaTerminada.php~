<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoInstanciaTerminada
 *
 * @ORM\Table(name="paso_instancia_terminada")
 * @ORM\Entity
 */
class PasoInstanciaTerminada
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_instancia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpasoInstancia;

    /**
     * @var integer
     *
     * @ORM\Column(name="actividad_idpaso_actividad", type="integer", nullable=false)
     */
    private $actividadIdpasoActividad;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="responsable", type="integer", nullable=false)
     */
    private $responsable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_terminacion", type="integer", nullable=false)
     */
    private $tipoTerminacion = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_actividad", type="integer", nullable=false)
     */
    private $estadoActividad = '1';


}


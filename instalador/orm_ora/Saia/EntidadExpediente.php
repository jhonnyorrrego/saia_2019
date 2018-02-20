<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntidadExpediente
 *
 * @ORM\Table(name="entidad_expediente", indexes={@ORM\Index(name="i_expediente_idexpediente", columns={"expediente_idexpediente"}), @ORM\Index(name="i_ent_exp_llave_entidad", columns={"llave_entidad"})})
 * @ORM\Entity
 */
class EntidadExpediente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="identidad_expediente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $identidadExpediente;

    /**
     * @var integer
     *
     * @ORM\Column(name="entidad_identidad", type="integer", nullable=false)
     */
    private $entidadIdentidad = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="expediente_idexpediente", type="integer", nullable=false)
     */
    private $expedienteIdexpediente = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="llave_entidad", type="integer", nullable=false)
     */
    private $llaveEntidad = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="permiso", type="string", length=255, nullable=true)
     */
    private $permiso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;


}

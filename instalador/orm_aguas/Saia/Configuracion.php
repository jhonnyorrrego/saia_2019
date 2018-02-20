<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Configuracion
 *
 * @ORM\Table(name="CONFIGURACION")
 * @ORM\Entity
 */
class Configuracion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCONFIGURACION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CONFIGURACION_IDCONFIGURACION_", allocationSize=1, initialValue=1)
     */
    private $idconfiguracion;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
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
     * @ORM\Column(name="TIPO", type="string", length=255, nullable=true)
     */
    private $tipo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="ENCRYPT", type="integer", nullable=true)
     */
    private $encrypt = '0';


}

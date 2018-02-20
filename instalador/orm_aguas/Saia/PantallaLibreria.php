<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaLibreria
 *
 * @ORM\Table(name="PANTALLA_LIBRERIA")
 * @ORM\Entity
 */
class PantallaLibreria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPANTALLA_LIBRERIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_LIBRERIA_IDPANTALLA_L", allocationSize=1, initialValue=1)
     */
    private $idpantallaLibreria;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=false)
     */
    private $orden = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_ARCHIVO", type="string", length=10, nullable=false)
     */
    private $tipoArchivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_LIBRERIA", type="integer", nullable=false)
     */
    private $tipoLibreria = '2';


}

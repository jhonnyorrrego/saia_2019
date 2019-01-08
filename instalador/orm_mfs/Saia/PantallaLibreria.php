<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaLibreria
 *
 * @ORM\Table(name="pantalla_libreria")
 * @ORM\Entity
 */
class PantallaLibreria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_libreria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpantallaLibreria;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_archivo", type="string", length=10, nullable=false)
     */
    private $tipoArchivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_libreria", type="integer", nullable=false)
     */
    private $tipoLibreria = '2';


}


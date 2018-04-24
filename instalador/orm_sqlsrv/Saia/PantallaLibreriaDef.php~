<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaLibreriaDef
 *
 * @ORM\Table(name="pantalla_libreria_def")
 * @ORM\Entity
 */
class PantallaLibreriaDef
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
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_archivo", type="string", length=10, nullable=false)
     */
    private $tipoArchivo;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar_incluir", type="string", length=255, nullable=false)
     */
    private $lugarIncluir = 'head';

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;


}


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Indicador
 *
 * @ORM\Table(name="indicador")
 * @ORM\Entity
 */
class Indicador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idindicador", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idindicador;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_formulario", type="string", length=255, nullable=false)
     */
    private $rutaFormulario;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="librerias", type="text", length=65535, nullable=true)
     */
    private $librerias;


}

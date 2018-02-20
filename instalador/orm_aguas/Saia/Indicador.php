<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Indicador
 *
 * @ORM\Table(name="INDICADOR", indexes={@ORM\Index(name="i_indicador_librerias_ctx", columns={"LIBRERIAS"})})
 * @ORM\Entity
 */
class Indicador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDINDICADOR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="INDICADOR_IDINDICADOR_seq", allocationSize=1, initialValue=1)
     */
    private $idindicador;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_FORMULARIO", type="string", length=255, nullable=false)
     */
    private $rutaFormulario;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBRERIAS", type="text", nullable=true)
     */
    private $librerias;


}

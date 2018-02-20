<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * VistaFormato
 *
 * @ORM\Table(name="VISTA_FORMATO")
 * @ORM\Entity
 */
class VistaFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDVISTA_FORMATO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="VISTA_FORMATO_IDVISTA_FORMATO_", allocationSize=1, initialValue=1)
     */
    private $idvistaFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMATO_PADRE", type="integer", nullable=false)
     */
    private $formatoPadre;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_MOSTRAR", type="string", length=255, nullable=false)
     */
    private $rutaMostrar;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBRERIAS", type="string", length=255, nullable=true)
     */
    private $librerias;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTILOS", type="string", length=255, nullable=true)
     */
    private $estilos;

    /**
     * @var string
     *
     * @ORM\Column(name="JAVASCRIPT", type="string", length=255, nullable=true)
     */
    private $javascript;

    /**
     * @var string
     *
     * @ORM\Column(name="ENCABEZADO", type="text", nullable=true)
     */
    private $encabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="CUERPO", type="text", nullable=true)
     */
    private $cuerpo;

    /**
     * @var string
     *
     * @ORM\Column(name="PIE_PAGINA", type="text", nullable=true)
     */
    private $piePagina;

    /**
     * @var string
     *
     * @ORM\Column(name="MARGENES", type="string", length=50, nullable=false)
     */
    private $margenes;

    /**
     * @var string
     *
     * @ORM\Column(name="ORIENTACION", type="string", length=50, nullable=true)
     */
    private $orientacion;

    /**
     * @var string
     *
     * @ORM\Column(name="PAPEL", type="string", length=50, nullable=true)
     */
    private $papel;

    /**
     * @var string
     *
     * @ORM\Column(name="EXPORTAR", type="string", length=255, nullable=true)
     */
    private $exportar;

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
     * @var string
     *
     * @ORM\Column(name="IMAGEN", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="AYUDA", type="string", length=400, nullable=true)
     */
    private $ayuda;

    /**
     * @var string
     *
     * @ORM\Column(name="FONT_SIZE", type="string", length=4, nullable=false)
     */
    private $fontSize;

    /**
     * @var string
     *
     * @ORM\Column(name="BANDERAS", type="string", length=255, nullable=false)
     */
    private $banderas;


}


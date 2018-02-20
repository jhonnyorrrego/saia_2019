<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * VistaFormato
 *
 * @ORM\Table(name="vista_formato")
 * @ORM\Entity
 */
class VistaFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idvista_formato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="VISTA_FORMATO_IDVISTA_FORMATO_", allocationSize=1, initialValue=1)
     */
    private $idvistaFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="formato_padre", type="integer", nullable=false)
     */
    private $formatoPadre;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_mostrar", type="string", length=255, nullable=false)
     */
    private $rutaMostrar;

    /**
     * @var string
     *
     * @ORM\Column(name="librerias", type="string", length=255, nullable=true)
     */
    private $librerias;

    /**
     * @var string
     *
     * @ORM\Column(name="estilos", type="string", length=255, nullable=true)
     */
    private $estilos;

    /**
     * @var string
     *
     * @ORM\Column(name="javascript", type="string", length=255, nullable=true)
     */
    private $javascript;

    /**
     * @var string
     *
     * @ORM\Column(name="encabezado", type="text", nullable=true)
     */
    private $encabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="cuerpo", type="text", nullable=true)
     */
    private $cuerpo;

    /**
     * @var string
     *
     * @ORM\Column(name="pie_pagina", type="text", nullable=true)
     */
    private $piePagina;

    /**
     * @var string
     *
     * @ORM\Column(name="margenes", type="string", length=50, nullable=false)
     */
    private $margenes;

    /**
     * @var string
     *
     * @ORM\Column(name="orientacion", type="string", length=50, nullable=true)
     */
    private $orientacion;

    /**
     * @var string
     *
     * @ORM\Column(name="papel", type="string", length=50, nullable=true)
     */
    private $papel;

    /**
     * @var string
     *
     * @ORM\Column(name="exportar", type="string", length=255, nullable=true)
     */
    private $exportar;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="ayuda", type="string", length=400, nullable=true)
     */
    private $ayuda;

    /**
     * @var string
     *
     * @ORM\Column(name="font_size", type="string", length=4, nullable=false)
     */
    private $fontSize;

    /**
     * @var string
     *
     * @ORM\Column(name="banderas", type="string", length=255, nullable=false)
     */
    private $banderas;


}


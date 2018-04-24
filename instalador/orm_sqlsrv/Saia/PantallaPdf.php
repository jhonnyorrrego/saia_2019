<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaPdf
 *
 * @ORM\Table(name="pantalla_pdf", indexes={@ORM\Index(name="fk_pantalla_pdf_pantalla1_idx", columns={"fk_idpantalla"})})
 * @ORM\Entity
 */
class PantallaPdf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_pdf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpantallaPdf;

    /**
     * @var string
     *
     * @ORM\Column(name="tamano", type="string", length=255, nullable=false)
     */
    private $tamano = '12';

    /**
     * @var string
     *
     * @ORM\Column(name="superior", type="string", length=255, nullable=false)
     */
    private $superior = '30';

    /**
     * @var string
     *
     * @ORM\Column(name="inferior", type="string", length=255, nullable=false)
     */
    private $inferior = '20';

    /**
     * @var string
     *
     * @ORM\Column(name="izquierda", type="string", length=255, nullable=false)
     */
    private $izquierda = '15';

    /**
     * @var string
     *
     * @ORM\Column(name="derecha", type="string", length=255, nullable=false)
     */
    private $derecha = '20';

    /**
     * @var string
     *
     * @ORM\Column(name="orientacion", type="string", length=255, nullable=false)
     */
    private $orientacion = 'P';

    /**
     * @var string
     *
     * @ORM\Column(name="tamano_papel", type="string", length=255, nullable=false)
     */
    private $tamanoPapel = 'LETTER';

    /**
     * @var string
     *
     * @ORM\Column(name="mostrar_pdf", type="string", length=255, nullable=false)
     */
    private $mostrarPdf = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="mostrar_encabezado_pie", type="string", length=255, nullable=false)
     */
    private $mostrarEncabezadoPie = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="mostrar_enca_pie_primera", type="string", length=255, nullable=true)
     */
    private $mostrarEncaPiePrimera = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="firma_digital", type="string", length=255, nullable=true)
     */
    private $firmaDigital;

    /**
     * @var string
     *
     * @ORM\Column(name="proteccion", type="string", length=255, nullable=true)
     */
    private $proteccion;

    /**
     * @var string
     *
     * @ORM\Column(name="mostrar_notas", type="string", length=255, nullable=true)
     */
    private $mostrarNotas;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_fuente", type="string", length=255, nullable=true)
     */
    private $tipoFuente;

    /**
     * @var string
     *
     * @ORM\Column(name="color_fondo", type="string", length=255, nullable=true)
     */
    private $colorFondo;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idbpmni", type="integer", nullable=true)
     */
    private $fkIdbpmni = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idbpmn_tarea", type="integer", nullable=true)
     */
    private $fkIdbpmnTarea = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idpantalla", type="integer", nullable=false)
     */
    private $fkIdpantalla;


}

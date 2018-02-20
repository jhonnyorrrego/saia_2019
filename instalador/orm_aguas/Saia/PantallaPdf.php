<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaPdf
 *
 * @ORM\Table(name="PANTALLA_PDF")
 * @ORM\Entity
 */
class PantallaPdf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPANTALLA_PDF", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_PDF_IDPANTALLA_PDF_se", allocationSize=1, initialValue=1)
     */
    private $idpantallaPdf;

    /**
     * @var string
     *
     * @ORM\Column(name="TAMANO", type="string", length=255, nullable=false)
     */
    private $tamano = '12';

    /**
     * @var string
     *
     * @ORM\Column(name="SUPERIOR", type="string", length=255, nullable=false)
     */
    private $superior = '30';

    /**
     * @var string
     *
     * @ORM\Column(name="INFERIOR", type="string", length=255, nullable=false)
     */
    private $inferior = '20';

    /**
     * @var string
     *
     * @ORM\Column(name="IZQUIERDA", type="string", length=255, nullable=false)
     */
    private $izquierda = '15';

    /**
     * @var string
     *
     * @ORM\Column(name="DERECHA", type="string", length=255, nullable=false)
     */
    private $derecha = '20';

    /**
     * @var string
     *
     * @ORM\Column(name="ORIENTACION", type="string", length=255, nullable=false)
     */
    private $orientacion = 'P';

    /**
     * @var string
     *
     * @ORM\Column(name="TAMANO_PAPEL", type="string", length=255, nullable=false)
     */
    private $tamanoPapel = 'LETTER';

    /**
     * @var string
     *
     * @ORM\Column(name="MOSTRAR_PDF", type="string", length=255, nullable=false)
     */
    private $mostrarPdf = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="MOSTRAR_ENCABEZADO_PIE", type="string", length=255, nullable=false)
     */
    private $mostrarEncabezadoPie = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="MOSTRAR_ENCA_PIE_PRIMERA", type="string", length=255, nullable=true)
     */
    private $mostrarEncaPiePrimera = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="FIRMA_DIGITAL", type="string", length=255, nullable=true)
     */
    private $firmaDigital;

    /**
     * @var string
     *
     * @ORM\Column(name="PROTECCION", type="string", length=255, nullable=true)
     */
    private $proteccion;

    /**
     * @var string
     *
     * @ORM\Column(name="MOSTRAR_NOTAS", type="string", length=255, nullable=true)
     */
    private $mostrarNotas;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_FUENTE", type="string", length=255, nullable=true)
     */
    private $tipoFuente;

    /**
     * @var string
     *
     * @ORM\Column(name="COLOR_FONDO", type="string", length=255, nullable=true)
     */
    private $colorFondo;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDBPMNI", type="integer", nullable=true)
     */
    private $fkIdbpmni = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDBPMN_TAREA", type="integer", nullable=true)
     */
    private $fkIdbpmnTarea = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDPANTALLA", type="integer", nullable=false)
     */
    private $fkIdpantalla;


}

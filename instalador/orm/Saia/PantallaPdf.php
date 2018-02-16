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
     * @ORM\GeneratedValue(strategy="AUTO")
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



    /**
     * Get idpantallaPdf
     *
     * @return integer
     */
    public function getIdpantallaPdf()
    {
        return $this->idpantallaPdf;
    }

    /**
     * Set tamano
     *
     * @param string $tamano
     *
     * @return PantallaPdf
     */
    public function setTamano($tamano)
    {
        $this->tamano = $tamano;

        return $this;
    }

    /**
     * Get tamano
     *
     * @return string
     */
    public function getTamano()
    {
        return $this->tamano;
    }

    /**
     * Set superior
     *
     * @param string $superior
     *
     * @return PantallaPdf
     */
    public function setSuperior($superior)
    {
        $this->superior = $superior;

        return $this;
    }

    /**
     * Get superior
     *
     * @return string
     */
    public function getSuperior()
    {
        return $this->superior;
    }

    /**
     * Set inferior
     *
     * @param string $inferior
     *
     * @return PantallaPdf
     */
    public function setInferior($inferior)
    {
        $this->inferior = $inferior;

        return $this;
    }

    /**
     * Get inferior
     *
     * @return string
     */
    public function getInferior()
    {
        return $this->inferior;
    }

    /**
     * Set izquierda
     *
     * @param string $izquierda
     *
     * @return PantallaPdf
     */
    public function setIzquierda($izquierda)
    {
        $this->izquierda = $izquierda;

        return $this;
    }

    /**
     * Get izquierda
     *
     * @return string
     */
    public function getIzquierda()
    {
        return $this->izquierda;
    }

    /**
     * Set derecha
     *
     * @param string $derecha
     *
     * @return PantallaPdf
     */
    public function setDerecha($derecha)
    {
        $this->derecha = $derecha;

        return $this;
    }

    /**
     * Get derecha
     *
     * @return string
     */
    public function getDerecha()
    {
        return $this->derecha;
    }

    /**
     * Set orientacion
     *
     * @param string $orientacion
     *
     * @return PantallaPdf
     */
    public function setOrientacion($orientacion)
    {
        $this->orientacion = $orientacion;

        return $this;
    }

    /**
     * Get orientacion
     *
     * @return string
     */
    public function getOrientacion()
    {
        return $this->orientacion;
    }

    /**
     * Set tamanoPapel
     *
     * @param string $tamanoPapel
     *
     * @return PantallaPdf
     */
    public function setTamanoPapel($tamanoPapel)
    {
        $this->tamanoPapel = $tamanoPapel;

        return $this;
    }

    /**
     * Get tamanoPapel
     *
     * @return string
     */
    public function getTamanoPapel()
    {
        return $this->tamanoPapel;
    }

    /**
     * Set mostrarPdf
     *
     * @param string $mostrarPdf
     *
     * @return PantallaPdf
     */
    public function setMostrarPdf($mostrarPdf)
    {
        $this->mostrarPdf = $mostrarPdf;

        return $this;
    }

    /**
     * Get mostrarPdf
     *
     * @return string
     */
    public function getMostrarPdf()
    {
        return $this->mostrarPdf;
    }

    /**
     * Set mostrarEncabezadoPie
     *
     * @param string $mostrarEncabezadoPie
     *
     * @return PantallaPdf
     */
    public function setMostrarEncabezadoPie($mostrarEncabezadoPie)
    {
        $this->mostrarEncabezadoPie = $mostrarEncabezadoPie;

        return $this;
    }

    /**
     * Get mostrarEncabezadoPie
     *
     * @return string
     */
    public function getMostrarEncabezadoPie()
    {
        return $this->mostrarEncabezadoPie;
    }

    /**
     * Set mostrarEncaPiePrimera
     *
     * @param string $mostrarEncaPiePrimera
     *
     * @return PantallaPdf
     */
    public function setMostrarEncaPiePrimera($mostrarEncaPiePrimera)
    {
        $this->mostrarEncaPiePrimera = $mostrarEncaPiePrimera;

        return $this;
    }

    /**
     * Get mostrarEncaPiePrimera
     *
     * @return string
     */
    public function getMostrarEncaPiePrimera()
    {
        return $this->mostrarEncaPiePrimera;
    }

    /**
     * Set firmaDigital
     *
     * @param string $firmaDigital
     *
     * @return PantallaPdf
     */
    public function setFirmaDigital($firmaDigital)
    {
        $this->firmaDigital = $firmaDigital;

        return $this;
    }

    /**
     * Get firmaDigital
     *
     * @return string
     */
    public function getFirmaDigital()
    {
        return $this->firmaDigital;
    }

    /**
     * Set proteccion
     *
     * @param string $proteccion
     *
     * @return PantallaPdf
     */
    public function setProteccion($proteccion)
    {
        $this->proteccion = $proteccion;

        return $this;
    }

    /**
     * Get proteccion
     *
     * @return string
     */
    public function getProteccion()
    {
        return $this->proteccion;
    }

    /**
     * Set mostrarNotas
     *
     * @param string $mostrarNotas
     *
     * @return PantallaPdf
     */
    public function setMostrarNotas($mostrarNotas)
    {
        $this->mostrarNotas = $mostrarNotas;

        return $this;
    }

    /**
     * Get mostrarNotas
     *
     * @return string
     */
    public function getMostrarNotas()
    {
        return $this->mostrarNotas;
    }

    /**
     * Set tipoFuente
     *
     * @param string $tipoFuente
     *
     * @return PantallaPdf
     */
    public function setTipoFuente($tipoFuente)
    {
        $this->tipoFuente = $tipoFuente;

        return $this;
    }

    /**
     * Get tipoFuente
     *
     * @return string
     */
    public function getTipoFuente()
    {
        return $this->tipoFuente;
    }

    /**
     * Set colorFondo
     *
     * @param string $colorFondo
     *
     * @return PantallaPdf
     */
    public function setColorFondo($colorFondo)
    {
        $this->colorFondo = $colorFondo;

        return $this;
    }

    /**
     * Get colorFondo
     *
     * @return string
     */
    public function getColorFondo()
    {
        return $this->colorFondo;
    }

    /**
     * Set fkIdbpmni
     *
     * @param integer $fkIdbpmni
     *
     * @return PantallaPdf
     */
    public function setFkIdbpmni($fkIdbpmni)
    {
        $this->fkIdbpmni = $fkIdbpmni;

        return $this;
    }

    /**
     * Get fkIdbpmni
     *
     * @return integer
     */
    public function getFkIdbpmni()
    {
        return $this->fkIdbpmni;
    }

    /**
     * Set fkIdbpmnTarea
     *
     * @param integer $fkIdbpmnTarea
     *
     * @return PantallaPdf
     */
    public function setFkIdbpmnTarea($fkIdbpmnTarea)
    {
        $this->fkIdbpmnTarea = $fkIdbpmnTarea;

        return $this;
    }

    /**
     * Get fkIdbpmnTarea
     *
     * @return integer
     */
    public function getFkIdbpmnTarea()
    {
        return $this->fkIdbpmnTarea;
    }

    /**
     * Set fkIdpantalla
     *
     * @param integer $fkIdpantalla
     *
     * @return PantallaPdf
     */
    public function setFkIdpantalla($fkIdpantalla)
    {
        $this->fkIdpantalla = $fkIdpantalla;

        return $this;
    }

    /**
     * Get fkIdpantalla
     *
     * @return integer
     */
    public function getFkIdpantalla()
    {
        return $this->fkIdpantalla;
    }
}

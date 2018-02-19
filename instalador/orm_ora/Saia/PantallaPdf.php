<?php

namespace Saia;

/**
 * PantallaPdf
 */
class PantallaPdf
{
    /**
     * @var integer
     */
    private $idpantallaPdf;

    /**
     * @var string
     */
    private $tamano;

    /**
     * @var string
     */
    private $superior;

    /**
     * @var string
     */
    private $inferior;

    /**
     * @var string
     */
    private $izquierda;

    /**
     * @var string
     */
    private $derecha;

    /**
     * @var string
     */
    private $orientacion;

    /**
     * @var string
     */
    private $tamanoPapel;

    /**
     * @var string
     */
    private $mostrarPdf;

    /**
     * @var string
     */
    private $mostrarEncabezadoPie;

    /**
     * @var string
     */
    private $mostrarEncaPiePrimera;

    /**
     * @var string
     */
    private $firmaDigital;

    /**
     * @var string
     */
    private $proteccion;

    /**
     * @var string
     */
    private $mostrarNotas;

    /**
     * @var string
     */
    private $tipoFuente;

    /**
     * @var string
     */
    private $colorFondo;

    /**
     * @var integer
     */
    private $fkIdbpmni;

    /**
     * @var integer
     */
    private $fkIdbpmnTarea;

    /**
     * @var integer
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


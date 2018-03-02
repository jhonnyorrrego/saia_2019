<?php

namespace Saia;

/**
 * EditorArchivo
 */
class EditorArchivo
{
    /**
     * @var integer
     */
    private $ideditorArchivo;

    /**
     * @var integer
     */
    private $idfuncionarioEditor;

    /**
     * @var string
     */
    private $archivo;

    /**
     * @var string
     */
    private $archivoTemp;

    /**
     * @var integer
     */
    private $guardado;

    /**
     * @var string
     */
    private $rama;


    /**
     * Get ideditorArchivo
     *
     * @return integer
     */
    public function getIdeditorArchivo()
    {
        return $this->ideditorArchivo;
    }

    /**
     * Set idfuncionarioEditor
     *
     * @param integer $idfuncionarioEditor
     *
     * @return EditorArchivo
     */
    public function setIdfuncionarioEditor($idfuncionarioEditor)
    {
        $this->idfuncionarioEditor = $idfuncionarioEditor;

        return $this;
    }

    /**
     * Get idfuncionarioEditor
     *
     * @return integer
     */
    public function getIdfuncionarioEditor()
    {
        return $this->idfuncionarioEditor;
    }

    /**
     * Set archivo
     *
     * @param string $archivo
     *
     * @return EditorArchivo
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * Get archivo
     *
     * @return string
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set archivoTemp
     *
     * @param string $archivoTemp
     *
     * @return EditorArchivo
     */
    public function setArchivoTemp($archivoTemp)
    {
        $this->archivoTemp = $archivoTemp;

        return $this;
    }

    /**
     * Get archivoTemp
     *
     * @return string
     */
    public function getArchivoTemp()
    {
        return $this->archivoTemp;
    }

    /**
     * Set guardado
     *
     * @param integer $guardado
     *
     * @return EditorArchivo
     */
    public function setGuardado($guardado)
    {
        $this->guardado = $guardado;

        return $this;
    }

    /**
     * Get guardado
     *
     * @return integer
     */
    public function getGuardado()
    {
        return $this->guardado;
    }

    /**
     * Set rama
     *
     * @param string $rama
     *
     * @return EditorArchivo
     */
    public function setRama($rama)
    {
        $this->rama = $rama;

        return $this;
    }

    /**
     * Get rama
     *
     * @return string
     */
    public function getRama()
    {
        return $this->rama;
    }
}


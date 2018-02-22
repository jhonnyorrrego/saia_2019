<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EditorArchivo
 *
 * @ORM\Table(name="editor_archivo", indexes={@ORM\Index(name="archivo", columns={"archivo"})})
 * @ORM\Entity
 */
class EditorArchivo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ideditor_archivo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $ideditorArchivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="idfuncionario_editor", type="integer", nullable=false)
     */
    private $idfuncionarioEditor;

    /**
     * @var string
     *
     * @ORM\Column(name="archivo", type="string", length=600, nullable=false)
     */
    private $archivo;

    /**
     * @var string
     *
     * @ORM\Column(name="archivo_temp", type="string", length=600, nullable=true)
     */
    private $archivoTemp;

    /**
     * @var integer
     *
     * @ORM\Column(name="guardado", type="integer", nullable=false)
     */
    private $guardado = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="rama", type="string", length=255, nullable=false)
     */
    private $rama = 'master';



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

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
     * @ORM\GeneratedValue(strategy="IDENTITY")
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


}

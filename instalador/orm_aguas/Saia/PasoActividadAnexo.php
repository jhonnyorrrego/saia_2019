<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoActividadAnexo
 *
 * @ORM\Table(name="PASO_ACTIVIDAD_ANEXO", indexes={@ORM\Index(name="i_paso_actividad_anexo_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class PasoActividadAnexo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_ACTIVIDAD_ANEXO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_ACTIVIDAD_ANEXO_IDPASO_AC", allocationSize=1, initialValue=1)
     */
    private $idpasoActividadAnexo;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTIVIDAD_IDACTIVIDAD", type="integer", nullable=false)
     */
    private $actividadIdactividad;


}

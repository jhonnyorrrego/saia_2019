<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoActividadAnexo
 *
 * @ORM\Table(name="paso_actividad_anexo", indexes={@ORM\Index(name="i_paso_actividad_anexo_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class PasoActividadAnexo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_actividad_anexo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpasoActividadAnexo;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="actividad_idactividad", type="integer", nullable=false)
     */
    private $actividadIdactividad;


}

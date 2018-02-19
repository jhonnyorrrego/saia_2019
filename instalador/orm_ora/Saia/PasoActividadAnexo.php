<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoActividadAnexo
 *
 * @ORM\Table(name="PASO_ACTIVIDAD_ANEXO")
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
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=255, nullable=true)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=255, nullable=true)
     */
    private $tipo;


}

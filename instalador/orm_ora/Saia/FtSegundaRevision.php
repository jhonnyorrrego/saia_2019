<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSegundaRevision
 *
 * @ORM\Table(name="FT_SEGUNDA_REVISION", indexes={@ORM\Index(name="ft_segunda_revision_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class FtSegundaRevision
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=true)
     */
    private $serieIdserie = '84';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="APELLIDO", type="string", length=255, nullable=true)
     */
    private $apellido;

    /**
     * @var integer
     *
     * @ORM\Column(name="OPCION_ADICIONAL", type="integer", nullable=true)
     */
    private $opcionAdicional;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_OPCION_ADICIONAL", type="string", length=255, nullable=true)
     */
    private $otroOpcionAdicional;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_SEGUNDA_REVISION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_SEGUNDA_REVISION_IDFT_SEGUN", allocationSize=1, initialValue=1)
     */
    private $idftSegundaRevision;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPENDENCIA", type="integer", nullable=true)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENCABEZADO", type="integer", nullable=true)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="FIRMA", type="integer", nullable=true)
     */
    private $firma = '1';


}


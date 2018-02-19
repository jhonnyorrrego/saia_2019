<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRevisionFormatos
 *
 * @ORM\Table(name="FT_REVISION_FORMATOS", indexes={@ORM\Index(name="ft_revision_formatos_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class FtRevisionFormatos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '83';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="APELLIDO", type="string", length=255, nullable=false)
     */
    private $apellido;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_REVISION_FORMATOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_REVISION_FORMATOS_IDFT_REVI", allocationSize=1, initialValue=1)
     */
    private $idftRevisionFormatos;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPENDENCIA", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENCABEZADO", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="FIRMA", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="OTRA_OPCION", type="integer", nullable=true)
     */
    private $otraOpcion;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_OTRA_OPCION", type="string", length=255, nullable=true)
     */
    private $otroOtraOpcion;


}


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtTranscripcion
 *
 * @ORM\Table(name="FT_TRANSCRIPCION", indexes={@ORM\Index(name="ft_transcripcion_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_transcripcio", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtTranscripcion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_RECEPCION_ACUERDOS", type="integer", nullable=false)
     */
    private $ftRecepcionAcuerdos;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '10';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_TRANSCRIPCION", type="date", nullable=false)
     */
    private $fechaTranscripcion = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXO_TRANSCRIPCION", type="string", length=255, nullable=true)
     */
    private $anexoTranscripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_TRANSCRIPCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_TRANSCRIPCION_IDFT_TRANSCRI", allocationSize=1, initialValue=1)
     */
    private $idftTranscripcion;

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


}


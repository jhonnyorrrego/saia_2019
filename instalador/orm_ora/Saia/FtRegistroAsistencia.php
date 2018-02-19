<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRegistroAsistencia
 *
 * @ORM\Table(name="FT_REGISTRO_ASISTENCIA", indexes={@ORM\Index(name="ft_registro_asistencia_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class FtRegistroAsistencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ENTREVISTA_ESTRUCTURADA", type="integer", nullable=false)
     */
    private $ftEntrevistaEstructurada;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '242';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_REGISTRO", type="date", nullable=false)
     */
    private $fechaRegistro = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTOS_ANEXO", type="string", length=255, nullable=true)
     */
    private $documentosAnexo;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_REGISTRO_ASISTENCIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_REGISTRO_ASISTENCIA_IDFT_RE", allocationSize=1, initialValue=1)
     */
    private $idftRegistroAsistencia;

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


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtConvocaTelefonica
 *
 * @ORM\Table(name="FT_CONVOCA_TELEFONICA", indexes={@ORM\Index(name="ft_convoca_telefonica_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_convoca_tele", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_asinga_entrevistador", columns={"FT_ASINGA_ENTREVISTADOR"})})
 * @ORM\Entity
 */
class FtConvocaTelefonica
{
    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_CITADO", type="string", length=255, nullable=false)
     */
    private $nombreCitado;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ASINGA_ENTREVISTADOR", type="integer", nullable=false)
     */
    private $ftAsingaEntrevistador;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '87';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_LLAMADA", type="date", nullable=false)
     */
    private $fechaLlamada = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="RESULTADO_LLAMADA", type="integer", nullable=false)
     */
    private $resultadoLlamada;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACOINES_LLAMADA", type="text", nullable=true)
     */
    private $observacoinesLlamada = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="MEDIO_CONTACTO", type="integer", nullable=true)
     */
    private $medioContacto;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_CONVOCA_TELEFONICA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_CONVOCA_TELEFONICA_IDFT_CON", allocationSize=1, initialValue=1)
     */
    private $idftConvocaTelefonica;

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
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}


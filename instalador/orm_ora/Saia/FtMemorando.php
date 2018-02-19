<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtMemorando
 *
 * @ORM\Table(name="FT_MEMORANDO", indexes={@ORM\Index(name="i_memorando_fi", columns={"FIRMA"}), @ORM\Index(name="ft_memorando_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_memorando_en", columns={"ENCABEZADO"})})
 * @ORM\Entity
 */
class FtMemorando
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_MEMORANDO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_MEMORANDO_IDFT_MEMORANDO_se", allocationSize=1, initialValue=1)
     */
    private $idftMemorando;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ORIGEN", type="string", length=255, nullable=true)
     */
    private $origen = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="DESTINO", type="string", length=2000, nullable=false)
     */
    private $destino;

    /**
     * @var string
     *
     * @ORM\Column(name="ASUNTO", type="string", length=3999, nullable=false)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTENIDO", type="text", nullable=false)
     */
    private $contenido = 'empty_clob()';

    /**
     * @var integer
     *
     * @ORM\Column(name="FIRMA", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ENCABEZADO", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPENDENCIA", type="integer", nullable=true)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="DESPEDIDA", type="string", length=255, nullable=true)
     */
    private $despedida;

    /**
     * @var string
     *
     * @ORM\Column(name="INICIALES", type="string", length=255, nullable=true)
     */
    private $iniciales;

    /**
     * @var string
     *
     * @ORM\Column(name="COPIA", type="string", length=2000, nullable=true)
     */
    private $copia;

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXOS_FISICOS", type="string", length=2000, nullable=true)
     */
    private $anexosFisicos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_MEMORANDO", type="date", nullable=false)
     */
    private $fechaMemorando = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=true)
     */
    private $serieIdserie = '441';

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXOS", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_ORIGEN", type="integer", nullable=true)
     */
    private $tipoOrigen = '5';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_CODIGO", type="string", length=5, nullable=true)
     */
    private $tipoCodigo = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_ANEXO_FISICO", type="string", length=3999, nullable=true)
     */
    private $otroAnexoFisico;


}


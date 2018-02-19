<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtCarta
 *
 * @ORM\Table(name="FT_CARTA", indexes={@ORM\Index(name="i_carta_serie_", columns={"SERIE_IDSERIE"}), @ORM\Index(name="i_carta_encabe", columns={"ENCABEZADO"}), @ORM\Index(name="i_carta_depend", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_carta_firma", columns={"FIRMA"}), @ORM\Index(name="ft_carta_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class FtCarta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_CARTA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_CARTA_IDFT_CARTA_seq", allocationSize=1, initialValue=1)
     */
    private $idftCarta;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPENDENCIA", type="integer", nullable=false)
     */
    private $dependencia = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="DESTINOS", type="string", length=3999, nullable=false)
     */
    private $destinos;

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD", type="string", length=30, nullable=true)
     */
    private $ciudad;

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
     * @var string
     *
     * @ORM\Column(name="DESPEDIDA", type="string", length=255, nullable=true)
     */
    private $despedida;

    /**
     * @var integer
     *
     * @ORM\Column(name="FIRMA", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="INICIALES", type="string", length=255, nullable=false)
     */
    private $iniciales;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=true)
     */
    private $serieIdserie = '261';

    /**
     * @var integer
     *
     * @ORM\Column(name="ENCABEZADO", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXOS_FISICOS", type="string", length=2000, nullable=true)
     */
    private $anexosFisicos;

    /**
     * @var string
     *
     * @ORM\Column(name="COPIA", type="string", length=2000, nullable=true)
     */
    private $copia;

    /**
     * @var string
     *
     * @ORM\Column(name="COPIAINTERNA", type="string", length=2000, nullable=true)
     */
    private $copiainterna;

    /**
     * @var string
     *
     * @ORM\Column(name="VERCOPIAINTERNA", type="string", length=1, nullable=false)
     */
    private $vercopiainterna = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CARTA", type="date", nullable=false)
     */
    private $fechaCarta = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXOS_DIGITALES", type="string", length=2000, nullable=true)
     */
    private $anexosDigitales;

    /**
     * @var integer
     *
     * @ORM\Column(name="VARIOS_RADICADOS", type="integer", nullable=false)
     */
    private $variosRadicados = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_COPIA_INTERNA", type="string", length=5, nullable=true)
     */
    private $tipoCopiaInterna = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_MENSAJERIA", type="integer", nullable=false)
     */
    private $tipoMensajeria = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_ANEXO_FISICO", type="string", length=255, nullable=true)
     */
    private $otroAnexoFisico;

    /**
     * @var string
     *
     * @ORM\Column(name="ASOCIADO_A", type="text", nullable=true)
     */
    private $asociadoA = 'EMPTY_CLOB()';


}


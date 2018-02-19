<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRadicacionEntrada
 *
 * @ORM\Table(name="FT_RADICACION_ENTRADA", indexes={@ORM\Index(name="ft_radicacion_entrada_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class FtRadicacionEntrada
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_RADICACION", type="date", nullable=true)
     */
    private $fechaRadicacion = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD_ORIGEN", type="string", length=255, nullable=true)
     */
    private $ciudadOrigen;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_OFICIO", type="string", length=255, nullable=true)
     */
    private $numeroOficio;

    /**
     * @var string
     *
     * @ORM\Column(name="PERSONA_NATURAL", type="string", length=255, nullable=false)
     */
    private $personaNatural;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="TIEMPO_RESPUESTA", type="date", nullable=true)
     */
    private $tiempoRespuesta = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="text", nullable=false)
     */
    private $descripcion = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="ANEXOS_FISICOS", type="integer", nullable=true)
     */
    private $anexosFisicos;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION_ANEXOS", type="text", nullable=true)
     */
    private $descripcionAnexos = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXOS_DIGITALES", type="string", length=255, nullable=true)
     */
    private $anexosDigitales;

    /**
     * @var string
     *
     * @ORM\Column(name="DESTINO", type="string", length=255, nullable=false)
     */
    private $destino;

    /**
     * @var string
     *
     * @ORM\Column(name="COPIA_A", type="string", length=255, nullable=true)
     */
    private $copiaA;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_RADICACION_ENTRADA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_RADICACION_ENTRADA_IDFT_RAD", allocationSize=1, initialValue=1)
     */
    private $idftRadicacionEntrada;

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
     * @var string
     *
     * @ORM\Column(name="IDFLUJO", type="string", length=255, nullable=true)
     */
    private $idflujo;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '592';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_RADICACION_ENTRADA", type="date", nullable=false)
     */
    private $fechaRadicacionEntrada = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="NUMERO_RADICADO", type="integer", nullable=true)
     */
    private $numeroRadicado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_OFICIO_ENTRADA", type="date", nullable=true)
     */
    private $fechaOficioEntrada = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO_RADICADO", type="string", length=255, nullable=true)
     */
    private $estadoRadicado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="COLPATRIA", type="string", length=255, nullable=true)
     */
    private $colpatria;

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXOS_FISICOS_R", type="string", length=255, nullable=true)
     */
    private $anexosFisicosR;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_ANEXO_FISICO", type="string", length=255, nullable=true)
     */
    private $otroAnexoFisico;


}


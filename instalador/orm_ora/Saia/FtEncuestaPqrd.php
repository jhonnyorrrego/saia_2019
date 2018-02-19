<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEncuestaPqrd
 *
 * @ORM\Table(name="FT_ENCUESTA_PQRD", indexes={@ORM\Index(name="ft_encuesta_pqrd_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_ft_registro_pqrs", columns={"FT_REGISTRO_PQRS"})})
 * @ORM\Entity
 */
class FtEncuestaPqrd
{
    /**
     * @var string
     *
     * @ORM\Column(name="ALGUNA_SUGERENCIA", type="text", nullable=true)
     */
    private $algunaSugerencia = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="CONOCE_PAGINA", type="integer", nullable=false)
     */
    private $conocePagina;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMA_TRATO", type="integer", nullable=false)
     */
    private $formaTrato;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION1", type="text", nullable=true)
     */
    private $observacion1 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION2", type="text", nullable=true)
     */
    private $observacion2 = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="RELACION_SOLICITUD", type="integer", nullable=false)
     */
    private $relacionSolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="RESPUESTA_SOLICITUD", type="integer", nullable=false)
     */
    private $respuestaSolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_REGISTRO_PQRS", type="integer", nullable=false)
     */
    private $ftRegistroPqrs;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '661';

    /**
     * @var integer
     *
     * @ORM\Column(name="CALIDAD_ACTUALIZADA", type="integer", nullable=false)
     */
    private $calidadActualizada;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIRECCION_DEPENDENCIA", type="integer", nullable=false)
     */
    private $direccionDependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="FACILIDAD_ENCONTRADA", type="integer", nullable=false)
     */
    private $facilidadEncontrada;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ENCUESTA_PQRD", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ENCUESTA_PQRD_IDFT_ENCUESTA", allocationSize=1, initialValue=1)
     */
    private $idftEncuestaPqrd;

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


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEntornoSocioecoDos
 *
 * @ORM\Table(name="FT_ENTORNO_SOCIOECO_DOS")
 * @ORM\Entity
 */
class FtEntornoSocioecoDos
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
     * @ORM\Column(name="IDFT_ENTORNO_SOCIOECO_DOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ENTORNO_SOCIOECO_DOS_IDFT_E", allocationSize=1, initialValue=1)
     */
    private $idftEntornoSocioecoDos;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '127';

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
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTIDAD_RESOLUCION", type="integer", nullable=false)
     */
    private $entidadResolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_ENTIDAD_RESOLUCION", type="string", length=255, nullable=true)
     */
    private $otroEntidadResolucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="VICTIMA_ACCION", type="integer", nullable=false)
     */
    private $victimaAccion;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPO_ITEM", type="string", length=255, nullable=true)
     */
    private $campoItem;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}


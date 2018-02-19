<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDesmoviDesarmetres
 *
 * @ORM\Table(name="FT_DESMOVI_DESARMETRES")
 * @ORM\Entity
 */
class FtDesmoviDesarmetres
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
    private $serieIdserie = '211';

    /**
     * @var integer
     *
     * @ORM\Column(name="VINCULACION_PERSONAS", type="integer", nullable=true)
     */
    private $vinculacionPersonas;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_DESMOVI_DESARMETRES", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_DESMOVI_DESARMETRES_IDFT_DE", allocationSize=1, initialValue=1)
     */
    private $idftDesmoviDesarmetres;

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
     * @ORM\Column(name="OPINION_VINCULA_PERS", type="integer", nullable=true)
     */
    private $opinionVinculaPers;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_OPINION_VINCULA_PERS", type="string", length=255, nullable=true)
     */
    private $otroOpinionVinculaPers;

    /**
     * @var integer
     *
     * @ORM\Column(name="PREGUNTA_ENTREGA", type="integer", nullable=true)
     */
    private $preguntaEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PREGUNTA_ENTREGA", type="string", length=255, nullable=true)
     */
    private $otroPreguntaEntrega;

    /**
     * @var integer
     *
     * @ORM\Column(name="PERSONAS_DESMOVIL", type="integer", nullable=true)
     */
    private $personasDesmovil;

    /**
     * @var string
     *
     * @ORM\Column(name="INGRESO_DESMOVIL", type="string", length=255, nullable=true)
     */
    private $ingresoDesmovil;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_INGRESO_DESMOVIL", type="string", length=255, nullable=true)
     */
    private $otroIngresoDesmovil;

    /**
     * @var string
     *
     * @ORM\Column(name="DESC_MATERIAL_INTEND", type="string", length=255, nullable=true)
     */
    private $descMaterialIntend;

    /**
     * @var string
     *
     * @ORM\Column(name="DESC_MATERIAL_COMUN", type="string", length=255, nullable=true)
     */
    private $descMaterialComun;

    /**
     * @var string
     *
     * @ORM\Column(name="DESC_VEHICULOS", type="string", length=255, nullable=true)
     */
    private $descVehiculos;

    /**
     * @var string
     *
     * @ORM\Column(name="ENTREGA_DESMOVIL", type="string", length=255, nullable=false)
     */
    private $entregaDesmovil;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_ENTREGA_DESMOVIL", type="string", length=255, nullable=true)
     */
    private $otroEntregaDesmovil;

    /**
     * @var string
     *
     * @ORM\Column(name="DESC_ARMAS_ENTREGA", type="string", length=255, nullable=true)
     */
    private $descArmasEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="DESC_UNIFORM_ENTREGA", type="string", length=255, nullable=true)
     */
    private $descUniformEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="DESC_INTEND_ENTREGA", type="string", length=255, nullable=true)
     */
    private $descIntendEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="DESC_COMUN_ENTREGA", type="string", length=255, nullable=true)
     */
    private $descComunEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="DESC_VEHICULO_ENTREGA", type="string", length=255, nullable=true)
     */
    private $descVehiculoEntrega;

    /**
     * @var integer
     *
     * @ORM\Column(name="PREGUNTA_ARMA", type="integer", nullable=true)
     */
    private $preguntaArma;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PREGUNTA_ARMA", type="string", length=255, nullable=true)
     */
    private $otroPreguntaArma;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPTO_MUNIC_DESMOVIL", type="string", length=255, nullable=false)
     */
    private $deptoMunicDesmovil;

    /**
     * @var string
     *
     * @ORM\Column(name="CUAL_LUGAR_RESIDENCIA", type="string", length=255, nullable=true)
     */
    private $cualLugarResidencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="SITIO_RESIDENCIA", type="integer", nullable=true)
     */
    private $sitioResidencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="VIVIENDA_DESMOVIL", type="integer", nullable=false)
     */
    private $viviendaDesmovil;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_VIVIENDA_DESMOVIL", type="string", length=255, nullable=true)
     */
    private $otroViviendaDesmovil;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}


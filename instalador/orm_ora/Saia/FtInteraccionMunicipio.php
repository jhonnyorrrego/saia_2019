<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtInteraccionMunicipio
 *
 * @ORM\Table(name="FT_INTERACCION_MUNICIPIO", indexes={@ORM\Index(name="ft_interaccion_municipio_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_interaccion_", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtInteraccionMunicipio
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
    private $serieIdserie = '145';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIEMPO_PERMANENCIA", type="integer", nullable=false)
     */
    private $tiempoPermanencia;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCIONES_GRUPO_PARA", type="string", length=255, nullable=false)
     */
    private $accionesGrupoPara;

    /**
     * @var string
     *
     * @ORM\Column(name="ACTUACION_GRUPO_ARMA", type="string", length=255, nullable=false)
     */
    private $actuacionGrupoArma;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_ACTUACION_GRUPO_ARMA", type="string", length=255, nullable=true)
     */
    private $otroActuacionGrupoArma;

    /**
     * @var string
     *
     * @ORM\Column(name="PERSIGUIO_COMUNIDAD", type="string", length=255, nullable=true)
     */
    private $persiguioComunidad;

    /**
     * @var string
     *
     * @ORM\Column(name="ACTIVIDADES_GRUPO", type="string", length=255, nullable=false)
     */
    private $actividadesGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCIONES_COMUNIDAD", type="string", length=255, nullable=false)
     */
    private $accionesComunidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="DENUNCIA_COMUNIDAD", type="integer", nullable=false)
     */
    private $denunciaComunidad;

    /**
     * @var string
     *
     * @ORM\Column(name="MUNICIPIO_BARRIO", type="string", length=255, nullable=false)
     */
    private $municipioBarrio;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_INTERACCION_MUNICIPIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_INTERACCION_MUNICIPIO_IDFT_", allocationSize=1, initialValue=1)
     */
    private $idftInteraccionMunicipio;

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


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtCaracterizaIntrafila
 *
 * @ORM\Table(name="FT_CARACTERIZA_INTRAFILA", indexes={@ORM\Index(name="ft_caracteriza_intrafila_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_caracteriza_", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtCaracterizaIntrafila
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
    private $serieIdserie = '129';

    /**
     * @var integer
     *
     * @ORM\Column(name="RECIBIO_ENTRENAMIENTO", type="integer", nullable=false)
     */
    private $recibioEntrenamiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_CARACTERIZA_INTRAFILA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_CARACTERIZA_INTRAFILA_IDFT_", allocationSize=1, initialValue=1)
     */
    private $idftCaracterizaIntrafila;

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
     * @ORM\Column(name="DOTACION_ENTREGADA", type="string", length=255, nullable=false)
     */
    private $dotacionEntregada;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_DOTACION_ENTREGADA", type="string", length=255, nullable=true)
     */
    private $otroDotacionEntregada;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_ENTRENAMIENTO", type="string", length=255, nullable=true)
     */
    private $tipoEntrenamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_TIPO_ENTRENAMIENTO", type="string", length=255, nullable=true)
     */
    private $otroTipoEntrenamiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="NO_RECIBIO_ENTRENA", type="integer", nullable=true)
     */
    private $noRecibioEntrena;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_NO_RECIBIO_ENTRENA", type="string", length=255, nullable=true)
     */
    private $otroNoRecibioEntrena;

    /**
     * @var string
     *
     * @ORM\Column(name="DIAS_ENTRENAMIENTO", type="string", length=255, nullable=true)
     */
    private $diasEntrenamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="MESES_ENTRENAMIENTO", type="string", length=255, nullable=true)
     */
    private $mesesEntrenamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_INSTRUCTURES", type="string", length=255, nullable=true)
     */
    private $tipoInstructures;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_TIPO_INSTRUCTURES", type="string", length=255, nullable=true)
     */
    private $otroTipoInstructures;

    /**
     * @var integer
     *
     * @ORM\Column(name="INTEGRANTES_MUJERES", type="integer", nullable=false)
     */
    private $integrantesMujeres;

    /**
     * @var integer
     *
     * @ORM\Column(name="NINIOS_NINIAS_ADOLES", type="integer", nullable=false)
     */
    private $niniosNiniasAdoles;

    /**
     * @var integer
     *
     * @ORM\Column(name="INTEGRANTES_INDIGENAS", type="integer", nullable=false)
     */
    private $integrantesIndigenas;

    /**
     * @var integer
     *
     * @ORM\Column(name="INTEGRANTES_NEGROS", type="integer", nullable=false)
     */
    private $integrantesNegros;

    /**
     * @var integer
     *
     * @ORM\Column(name="INTEGRANTES_GITANOS", type="integer", nullable=false)
     */
    private $integrantesGitanos;

    /**
     * @var integer
     *
     * @ORM\Column(name="INTEGRANTES_LGBTI", type="integer", nullable=false)
     */
    private $integrantesLgbti;

    /**
     * @var integer
     *
     * @ORM\Column(name="INTEGRANTES_DISCAPACI", type="integer", nullable=false)
     */
    private $integrantesDiscapaci;

    /**
     * @var integer
     *
     * @ORM\Column(name="INTEGRANTES_EXTRANJE", type="integer", nullable=false)
     */
    private $integrantesExtranje;

    /**
     * @var integer
     *
     * @ORM\Column(name="CODIGO_DISCIPLINA", type="integer", nullable=false)
     */
    private $codigoDisciplina;

    /**
     * @var string
     *
     * @ORM\Column(name="CONOCIO_ESTATUTO_GRUPO", type="string", length=255, nullable=true)
     */
    private $conocioEstatutoGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_CONOCIO_ESTATUTO_GRUPO", type="string", length=255, nullable=true)
     */
    private $otroConocioEstatutoGrupo;

    /**
     * @var integer
     *
     * @ORM\Column(name="QUIEN_EXPLICO_ESTATU", type="integer", nullable=true)
     */
    private $quienExplicoEstatu;

    /**
     * @var string
     *
     * @ORM\Column(name="COMO_PAGABAN", type="string", length=255, nullable=false)
     */
    private $comoPagaban;

    /**
     * @var integer
     *
     * @ORM\Column(name="DINERO_MENSUAL_GRUPO", type="integer", nullable=true)
     */
    private $dineroMensualGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="COMANDANTE_GENERAL", type="string", length=255, nullable=true)
     */
    private $comandanteGeneral;

    /**
     * @var string
     *
     * @ORM\Column(name="COMANDANTE_MILITAR", type="string", length=255, nullable=true)
     */
    private $comandanteMilitar;

    /**
     * @var string
     *
     * @ORM\Column(name="COMANTANTE_URBANO", type="string", length=255, nullable=true)
     */
    private $comantanteUrbano;

    /**
     * @var string
     *
     * @ORM\Column(name="COMANDANTE_POLITICO", type="string", length=255, nullable=true)
     */
    private $comandantePolitico;

    /**
     * @var string
     *
     * @ORM\Column(name="COMANDANTE_FINANCIE", type="string", length=255, nullable=true)
     */
    private $comandanteFinancie;

    /**
     * @var string
     *
     * @ORM\Column(name="COMANDANTE_OTROS", type="string", length=255, nullable=true)
     */
    private $comandanteOtros;

    /**
     * @var string
     *
     * @ORM\Column(name="JEFE_COORDINADOR", type="string", length=255, nullable=true)
     */
    private $jefeCoordinador;

    /**
     * @var string
     *
     * @ORM\Column(name="JEFE_ESCUADRA", type="string", length=255, nullable=true)
     */
    private $jefeEscuadra;

    /**
     * @var string
     *
     * @ORM\Column(name="JEFE_SEGUNDO", type="string", length=255, nullable=true)
     */
    private $jefeSegundo;

    /**
     * @var string
     *
     * @ORM\Column(name="JEFE_SEGUNDO_ESCUADRA", type="string", length=255, nullable=true)
     */
    private $jefeSegundoEscuadra;

    /**
     * @var string
     *
     * @ORM\Column(name="JEFE_ALIAS_OTROS", type="text", nullable=false)
     */
    private $jefeAliasOtros = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="GRUPOS_ESPECIALES", type="string", length=255, nullable=false)
     */
    private $gruposEspeciales;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_GRUPOS_ESPECIALES", type="string", length=255, nullable=true)
     */
    private $otroGruposEspeciales;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_BLOQUE_DOS", type="string", length=255, nullable=false)
     */
    private $nombreBloqueDos;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_BLOQUE_UNO", type="string", length=255, nullable=false)
     */
    private $nombreBloqueUno;

    /**
     * @var string
     *
     * @ORM\Column(name="PRIMER_GRUPO_PARAMI", type="string", length=255, nullable=false)
     */
    private $primerGrupoParami;

    /**
     * @var string
     *
     * @ORM\Column(name="PRUEBA_ITEM", type="string", length=255, nullable=true)
     */
    private $pruebaItem;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPO_ITEM_PERSONAL", type="string", length=255, nullable=true)
     */
    private $campoItemPersonal;

    /**
     * @var string
     *
     * @ORM\Column(name="BLOQUE_MAYOR_DURACION", type="string", length=255, nullable=true)
     */
    private $bloqueMayorDuracion;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}


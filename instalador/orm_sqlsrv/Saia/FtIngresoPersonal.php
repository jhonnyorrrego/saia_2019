<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtIngresoPersonal
 *
 * @ORM\Table(name="ft_ingreso_personal")
 * @ORM\Entity
 */
class FtIngresoPersonal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_ingreso_personal", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftIngresoPersonal;

    /**
     * @var integer
     *
     * @ORM\Column(name="arl", type="integer", nullable=false)
     */
    private $arl;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=12, nullable=false)
     */
    private $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="celular_contacto", type="string", length=12, nullable=false)
     */
    private $celularContacto;

    /**
     * @var integer
     *
     * @ORM\Column(name="cesantias", type="integer", nullable=false)
     */
    private $cesantias;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad_residencia", type="string", length=255, nullable=false)
     */
    private $ciudadResidencia;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_documentos", type="string", length=255, nullable=true)
     */
    private $codigoDocumentos;

    /**
     * @var string
     *
     * @ORM\Column(name="contacto_emergencia", type="string", length=255, nullable=false)
     */
    private $contactoEmergencia;

    /**
     * @var string
     *
     * @ORM\Column(name="cual_parentesco", type="string", length=255, nullable=true)
     */
    private $cualParentesco;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_residencia", type="string", length=255, nullable=false)
     */
    private $direccionResidencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="edad", type="string", length=255, nullable=false)
     */
    private $edad;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="eps_ingres_perso", type="integer", nullable=false)
     */
    private $epsIngresPerso;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_civil", type="integer", nullable=false)
     */
    private $estadoCivil;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingr_personal", type="date", nullable=false)
     */
    private $fechaIngrPersonal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_pasado_judi", type="date", nullable=true)
     */
    private $fechaPasadoJudi;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_personal", type="integer", nullable=false)
     */
    private $ftSolicitudPersonal;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar_expedicion", type="string", length=255, nullable=false)
     */
    private $lugarExpedicion;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar_nacimiento", type="string", length=255, nullable=false)
     */
    private $lugarNacimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_completo", type="integer", nullable=false)
     */
    private $nombreCompleto;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_libreta", type="string", length=11, nullable=true)
     */
    private $numeroLibreta;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_pasado_judicial", type="string", length=11, nullable=true)
     */
    private $numeroPasadoJudicial;

    /**
     * @var integer
     *
     * @ORM\Column(name="parentesco", type="integer", nullable=false)
     */
    private $parentesco;

    /**
     * @var integer
     *
     * @ORM\Column(name="pension_ingre_perso", type="integer", nullable=false)
     */
    private $pensionIngrePerso;

    /**
     * @var integer
     *
     * @ORM\Column(name="rh_ingreso_pers", type="integer", nullable=false)
     */
    private $rhIngresoPers;

    /**
     * @var string
     *
     * @ORM\Column(name="salario", type="string", length=255, nullable=false)
     */
    private $salario;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1179';

    /**
     * @var integer
     *
     * @ORM\Column(name="sexo_ingreso_per", type="integer", nullable=false)
     */
    private $sexoIngresoPer;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=11, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_contacto", type="string", length=12, nullable=true)
     */
    private $telefonoContacto;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_contrato", type="integer", nullable=false)
     */
    private $tipoContrato;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_funcionario", type="integer", nullable=true)
     */
    private $tipoFuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ubicacion", type="integer", nullable=false)
     */
    private $ubicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=true)
     */
    private $version;


}


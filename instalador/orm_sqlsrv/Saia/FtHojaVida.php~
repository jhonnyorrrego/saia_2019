<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtHojaVida
 *
 * @ORM\Table(name="ft_hoja_vida")
 * @ORM\Entity
 */
class FtHojaVida
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_hoja_vida", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftHojaVida;

    /**
     * @var integer
     *
     * @ORM\Column(name="arl", type="integer", nullable=false)
     */
    private $arl;

    /**
     * @var integer
     *
     * @ORM\Column(name="caja_compensacion", type="integer", nullable=false)
     */
    private $cajaCompensacion;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo_fun", type="string", length=255, nullable=false)
     */
    private $cargoFun;

    /**
     * @var string
     *
     * @ORM\Column(name="cedula", type="string", length=255, nullable=false)
     */
    private $cedula;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=255, nullable=true)
     */
    private $celular;

    /**
     * @var integer
     *
     * @ORM\Column(name="ciudad_residencia", type="integer", nullable=false)
     */
    private $ciudadResidencia;

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
     * @ORM\Column(name="direccion", type="string", length=255, nullable=false)
     */
    private $direccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad", type="integer", nullable=false)
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
     * @ORM\Column(name="eps", type="integer", nullable=false)
     */
    private $eps;

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
     * @var integer
     *
     * @ORM\Column(name="estado_hv", type="integer", nullable=false)
     */
    private $estadoHv;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_evaluacion", type="date", nullable=true)
     */
    private $fechaEvaluacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="date", nullable=false)
     */
    private $fechaIngreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_vencimiento", type="date", nullable=true)
     */
    private $fechaVencimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="fondo_cesantias", type="integer", nullable=true)
     */
    private $fondoCesantias;

    /**
     * @var integer
     *
     * @ORM\Column(name="fondo_pensio", type="integer", nullable=false)
     */
    private $fondoPensio;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_personal", type="integer", nullable=false)
     */
    private $ftSolicitudPersonal;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario_hv", type="string", length=255, nullable=false)
     */
    private $funcionarioHv;

    /**
     * @var integer
     *
     * @ORM\Column(name="grupo_sanguineo", type="integer", nullable=false)
     */
    private $grupoSanguineo;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar_nacimiento", type="string", length=255, nullable=false)
     */
    private $lugarNacimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_personas", type="integer", nullable=false)
     */
    private $numeroPersonas;

    /**
     * @var integer
     *
     * @ORM\Column(name="parentesco", type="integer", nullable=false)
     */
    private $parentesco;

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
    private $serieIdserie = '1023';

    /**
     * @var integer
     *
     * @ORM\Column(name="sexo", type="integer", nullable=false)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_contacto", type="string", length=255, nullable=false)
     */
    private $telefonoContacto;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_contrato", type="integer", nullable=false)
     */
    private $tipoContrato;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion", type="string", length=255, nullable=false)
     */
    private $ubicacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="vivienda", type="integer", nullable=false)
     */
    private $vivienda;


}


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRegistroPqrs
 *
 * @ORM\Table(name="FT_REGISTRO_PQRS", indexes={@ORM\Index(name="ft_registro_pqrs_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_registro_pqr", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtRegistroPqrs
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_REGISTRO_PQRS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_REGISTRO_PQRS_IDFT_REGISTRO", allocationSize=1, initialValue=1)
     */
    private $idftRegistroPqrs;

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
     * @ORM\Column(name="MEDIO_RESPUESTA", type="string", length=255, nullable=false)
     */
    private $medioRespuesta;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_SOLICITA_PQR", type="string", length=255, nullable=false)
     */
    private $nombreSolicitaPqr;

    /**
     * @var string
     *
     * @ORM\Column(name="IDENTIFICACION", type="string", length=255, nullable=false)
     */
    private $identificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="DIRECCION", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="TELEFONO_FIJO", type="integer", nullable=true)
     */
    private $telefonoFijo;

    /**
     * @var integer
     *
     * @ORM\Column(name="CELULAR", type="integer", nullable=true)
     */
    private $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD", type="string", length=255, nullable=false)
     */
    private $ciudad = '883';

    /**
     * @var string
     *
     * @ORM\Column(name="EMAIL", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXO_DIGITAL", type="string", length=255, nullable=true)
     */
    private $anexoDigital;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_IDENTIFICACION", type="integer", nullable=true)
     */
    private $tipoIdentificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="CONFLICTO_ARMADO", type="integer", nullable=true)
     */
    private $conflictoArmado;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORGANIZACION_VICTIMAS", type="integer", nullable=true)
     */
    private $organizacionVictimas;

    /**
     * @var integer
     *
     * @ORM\Column(name="MESA_VICTIMAS", type="integer", nullable=true)
     */
    private $mesaVictimas;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_PQR", type="integer", nullable=false)
     */
    private $tipoPqr;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION_PQR", type="text", nullable=false)
     */
    private $descripcionPqr = 'EMPTY_CLOB()';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_APERTURA", type="date", nullable=true)
     */
    private $fechaApertura = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '461';

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_CUAL", type="string", length=255, nullable=true)
     */
    private $otroCual;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PAIS", type="string", length=255, nullable=true)
     */
    private $otroPais;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRA_CIUDAD", type="string", length=255, nullable=true)
     */
    private $otraCiudad;

    /**
     * @var string
     *
     * @ORM\Column(name="EDAD", type="string", length=255, nullable=true)
     */
    private $edad;

    /**
     * @var integer
     *
     * @ORM\Column(name="GENERO", type="integer", nullable=true)
     */
    private $genero;

    /**
     * @var integer
     *
     * @ORM\Column(name="ETNICA", type="integer", nullable=true)
     */
    private $etnica;

    /**
     * @var integer
     *
     * @ORM\Column(name="DISCAPACIDAD", type="integer", nullable=true)
     */
    private $discapacidad;

    /**
     * @var string
     *
     * @ORM\Column(name="MESA_CUAL", type="string", length=255, nullable=true)
     */
    private $mesaCual;

    /**
     * @var integer
     *
     * @ORM\Column(name="HABITA", type="integer", nullable=true)
     */
    private $habita;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESCOLARIDAD", type="integer", nullable=true)
     */
    private $escolaridad;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTRATO", type="integer", nullable=true)
     */
    private $estrato;

    /**
     * @var string
     *
     * @ORM\Column(name="CUAL_ORGANIZACION", type="string", length=255, nullable=true)
     */
    private $cualOrganizacion;


}


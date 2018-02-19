<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtVerificacionInfo
 *
 * @ORM\Table(name="FT_VERIFICACION_INFO", indexes={@ORM\Index(name="ft_verificacion_info_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_verificacion", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_recep_territo_acuerdo", columns={"FT_RECEP_TERRITO_ACUERDO"}), @ORM\Index(name="i_ft_asigna_verifica_datos", columns={"FT_ASIGNA_VERIFICA_DATOS"})})
 * @ORM\Entity
 */
class FtVerificacionInfo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ASIGNA_VERIFICA_DATOS", type="integer", nullable=false)
     */
    private $ftAsignaVerificaDatos;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '5';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_HORA", type="date", nullable=false)
     */
    private $fechaHora = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="CEDULA", type="integer", nullable=false)
     */
    private $cedula;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="APELLIDOS", type="string", length=255, nullable=false)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPARTAMENTO_MUNICI", type="string", length=255, nullable=true)
     */
    private $departamentoMunici;

    /**
     * @var string
     *
     * @ORM\Column(name="DIRECCION_CONTACTO", type="string", length=255, nullable=false)
     */
    private $direccionContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="TELEFONO_CONTACTO", type="string", length=255, nullable=false)
     */
    private $telefonoContacto;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_VERIFICACION_INFO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_VERIFICACION_INFO_IDFT_VERI", allocationSize=1, initialValue=1)
     */
    private $idftVerificacionInfo;

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
     * @ORM\Column(name="DATOS_CONTACTO", type="integer", nullable=false)
     */
    private $datosContacto;

    /**
     * @var integer
     *
     * @ORM\Column(name="VERIFICA_EN_PROCESO", type="integer", nullable=false)
     */
    private $verificaEnProceso;

    /**
     * @var string
     *
     * @ORM\Column(name="MUNICIPIO_RESIDENCIA", type="string", length=255, nullable=false)
     */
    private $municipioResidencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_RECEP_TERRITO_ACUERDO", type="integer", nullable=false)
     */
    private $ftRecepTerritoAcuerdo;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_VERIFICA", type="text", nullable=true)
     */
    private $observacionVerifica = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}


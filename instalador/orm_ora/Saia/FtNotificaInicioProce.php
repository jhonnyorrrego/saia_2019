<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtNotificaInicioProce
 *
 * @ORM\Table(name="FT_NOTIFICA_INICIO_PROCE", indexes={@ORM\Index(name="ft_notifica_inicio_proce_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_ft_verificacion_info", columns={"FT_VERIFICACION_INFO"})})
 * @ORM\Entity
 */
class FtNotificaInicioProce
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_VERIFICACION_INFO", type="integer", nullable=false)
     */
    private $ftVerificacionInfo;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '6';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_NOTIFICACION", type="date", nullable=false)
     */
    private $fechaNotificacion = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_APELLIDO", type="string", length=255, nullable=true)
     */
    private $nombreApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="DIRECCION", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_NOTIFICA_INICIO_PROCE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_NOTIFICA_INICIO_PROCE_IDFT_", allocationSize=1, initialValue=1)
     */
    private $idftNotificaInicioProce;

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
     * @ORM\Column(name="TELEFONO_CONTACTO", type="string", length=255, nullable=true)
     */
    private $telefonoContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD_DILIGENCIAMIENTO", type="string", length=255, nullable=false)
     */
    private $ciudadDiligenciamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="MUNICIPIO_RESIDENCIA", type="string", length=255, nullable=true)
     */
    private $municipioResidencia;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPARTAMENTO_RESIDEN", type="string", length=255, nullable=true)
     */
    private $departamentoResiden;


}


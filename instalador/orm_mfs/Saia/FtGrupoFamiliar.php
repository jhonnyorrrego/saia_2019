<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtGrupoFamiliar
 *
 * @ORM\Table(name="ft_grupo_familiar")
 * @ORM\Entity
 */
class FtGrupoFamiliar
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_grupo_familiar", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftGrupoFamiliar;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="aporta_hogar", type="integer", nullable=false)
     */
    private $aportaHogar;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="edad", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_grupo_fam", type="integer", nullable=false)
     */
    private $estadoGrupoFam;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=true)
     */
    private $fechaNacimiento;

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
     * @ORM\Column(name="nombres_apellidos", type="string", length=255, nullable=false)
     */
    private $nombresApellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_identificacion", type="string", length=255, nullable=true)
     */
    private $numeroIdentificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="ocupacion", type="string", length=255, nullable=false)
     */
    private $ocupacion;

    /**
     * @var string
     *
     * @ORM\Column(name="otro_parentesco", type="string", length=255, nullable=true)
     */
    private $otroParentesco;

    /**
     * @var integer
     *
     * @ORM\Column(name="parentesco", type="integer", nullable=false)
     */
    private $parentesco;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var integer
     *
     * @ORM\Column(name="sexo", type="integer", nullable=false)
     */
    private $sexo;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_documento", type="integer", nullable=true)
     */
    private $tipoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="vive_usted", type="integer", nullable=false)
     */
    private $viveUsted;


}


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtVictimaHechoViolen
 *
 * @ORM\Table(name="FT_VICTIMA_HECHO_VIOLEN", indexes={@ORM\Index(name="i_ft_entorno_socioeco_dos", columns={"FT_ENTORNO_SOCIOECO_DOS"})})
 * @ORM\Entity
 */
class FtVictimaHechoViolen
{
    /**
     * @var string
     *
     * @ORM\Column(name="GRUPO_RESPONSABLE", type="string", length=255, nullable=true)
     */
    private $grupoResponsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ENTORNO_SOCIOECO_DOS", type="integer", nullable=false)
     */
    private $ftEntornoSocioecoDos;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_POBLACION", type="integer", nullable=false)
     */
    private $tipoPoblacion;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_TIPO_POBLACION", type="string", length=255, nullable=true)
     */
    private $otroTipoPoblacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDENTIDAD_GENERO", type="integer", nullable=false)
     */
    private $identidadGenero;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_OCURRENCIA", type="string", length=255, nullable=true)
     */
    private $anioOcurrencia;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_OCURRENCIA", type="string", length=255, nullable=true)
     */
    private $lugarOcurrencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_VICTIMA_HECHO_VIOLEN", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_VICTIMA_HECHO_VIOLEN_IDFT_V", allocationSize=1, initialValue=1)
     */
    private $idftVictimaHechoViolen;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_TIPO_HECHO_VIOLENTO", type="string", length=255, nullable=true)
     */
    private $otroTipoHechoViolento;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_HECHOS_VIOLENTOS", type="string", length=255, nullable=false)
     */
    private $tipoHechosViolentos;

    /**
     * @var string
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="string", length=255, nullable=true)
     */
    private $docPadreAcuerdo;


}


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPrueba
 *
 * @ORM\Table(name="FT_PRUEBA", indexes={@ORM\Index(name="i_prueba_depen", columns={"DEPENDENCIA"}), @ORM\Index(name="ft_prueba_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class FtPrueba
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="SEXO", type="integer", nullable=false)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_SEXO", type="string", length=255, nullable=true)
     */
    private $otroSexo;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_PRUEBA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_PRUEBA_IDFT_PRUEBA_seq", allocationSize=1, initialValue=1)
     */
    private $idftPrueba;

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
     * @ORM\Column(name="TIPO_DOCUMENTO", type="integer", nullable=false)
     */
    private $tipoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_TIPO_DOCUMENTO", type="string", length=255, nullable=true)
     */
    private $otroTipoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPO_PRUEBA", type="string", length=255, nullable=true)
     */
    private $campoPrueba;

    /**
     * @var integer
     *
     * @ORM\Column(name="LUGAR_RESIDENCIA", type="integer", nullable=true)
     */
    private $lugarResidencia;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_LUGAR_RESIDENCIA", type="string", length=255, nullable=true)
     */
    private $otroLugarResidencia;

    /**
     * @var string
     *
     * @ORM\Column(name="ACTIVIDADES_REALIZA", type="string", length=255, nullable=true)
     */
    private $actividadesRealiza;

    /**
     * @var string
     *
     * @ORM\Column(name="PAIS_FORMATO", type="string", length=255, nullable=true)
     */
    private $paisFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PAIS_FORMATO", type="string", length=255, nullable=true)
     */
    private $otroPaisFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_NACIMIENTO", type="string", length=255, nullable=true)
     */
    private $anioNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION_PRUEBA", type="text", nullable=true)
     */
    private $descripcionPrueba = 'EMPTY_CLOB()';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_PRUEBA", type="date", nullable=true)
     */
    private $fechaPrueba = 'SYSDATE';


}


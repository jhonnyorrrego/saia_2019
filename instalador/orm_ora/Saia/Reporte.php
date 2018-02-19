<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reporte
 *
 * @ORM\Table(name="REPORTE")
 * @ORM\Entity
 */
class Reporte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDREPORTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="REPORTE_IDREPORTE_seq", allocationSize=1, initialValue=1)
     */
    private $idreporte;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre = '';

    /**
     * @var string
     *
     * @ORM\Column(name="SQL_REPORTE", type="string", length=3000, nullable=true)
     */
    private $sqlReporte;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_ARCHIVO", type="string", length=255, nullable=true)
     */
    private $nombreArchivo = 'reporte';

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="MASCARAS", type="string", length=3000, nullable=true)
     */
    private $mascaras;

    /**
     * @var integer
     *
     * @ORM\Column(name="MODULO_IDMODULO", type="integer", nullable=true)
     */
    private $moduloIdmodulo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="FILTRO_OBLIGATORIO", type="integer", nullable=true)
     */
    private $filtroObligatorio = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPOS_TEXTO", type="string", length=2000, nullable=true)
     */
    private $camposTexto;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPOS_NUMERO", type="string", length=2000, nullable=true)
     */
    private $camposNumero;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_ORDENAMIENTO", type="string", length=20, nullable=true)
     */
    private $tipoOrdenamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPO_ORDENAMIENTO", type="string", length=255, nullable=true)
     */
    private $campoOrdenamiento;


}

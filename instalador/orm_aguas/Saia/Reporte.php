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
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="SQL_REPORTE", type="text", nullable=false)
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
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="MASCARAS", type="text", nullable=true)
     */
    private $mascaras;

    /**
     * @var integer
     *
     * @ORM\Column(name="MODULO_IDMODULO", type="integer", nullable=false)
     */
    private $moduloIdmodulo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPOS_TEXTO", type="text", nullable=true)
     */
    private $camposTexto;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPOS_NUMERO", type="text", nullable=true)
     */
    private $camposNumero;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_ORDENAMIENTO", type="string", length=4, nullable=true)
     */
    private $tipoOrdenamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPO_ORDENAMIENTO", type="string", length=255, nullable=true)
     */
    private $campoOrdenamiento;


}

<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reporte
 *
 * @ORM\Table(name="reporte")
 * @ORM\Entity
 */
class Reporte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreporte", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idreporte;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="sql_reporte", type="text", nullable=false)
     */
    private $sqlReporte;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_archivo", type="string", length=255, nullable=true)
     */
    private $nombreArchivo = 'reporte';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="mascaras", type="text", nullable=true)
     */
    private $mascaras;

    /**
     * @var integer
     *
     * @ORM\Column(name="modulo_idmodulo", type="integer", nullable=false)
     */
    private $moduloIdmodulo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="campos_texto", type="text", nullable=true)
     */
    private $camposTexto;

    /**
     * @var string
     *
     * @ORM\Column(name="campos_numero", type="text", nullable=true)
     */
    private $camposNumero;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_ordenamiento", type="string", length=4, nullable=true)
     */
    private $tipoOrdenamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="campo_ordenamiento", type="string", length=255, nullable=true)
     */
    private $campoOrdenamiento;


}

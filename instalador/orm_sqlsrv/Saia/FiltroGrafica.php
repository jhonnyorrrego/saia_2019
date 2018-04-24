<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FiltroGrafica
 *
 * @ORM\Table(name="filtro_grafica")
 * @ORM\Entity
 */
class FiltroGrafica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfiltro_grafica", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfiltroGrafica;

    /**
     * @var integer
     *
     * @ORM\Column(name="grafica_idgrafica", type="integer", nullable=false)
     */
    private $graficaIdgrafica;

    /**
     * @var string
     *
     * @ORM\Column(name="campo", type="string", length=255, nullable=false)
     */
    private $campo;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta_html", type="string", length=255, nullable=false)
     */
    private $etiquetaHtml;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_sql", type="string", length=2000, nullable=true)
     */
    private $codigoSql;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_dato", type="string", length=255, nullable=false)
     */
    private $tipoDato = 'varchar';


}

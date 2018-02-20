<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FiltroGrafica
 *
 * @ORM\Table(name="FILTRO_GRAFICA")
 * @ORM\Entity
 */
class FiltroGrafica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFILTRO_GRAFICA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FILTRO_GRAFICA_IDFILTRO_GRAFIC", allocationSize=1, initialValue=1)
     */
    private $idfiltroGrafica;

    /**
     * @var integer
     *
     * @ORM\Column(name="GRAFICA_IDGRAFICA", type="integer", nullable=false)
     */
    private $graficaIdgrafica;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPO", type="string", length=255, nullable=false)
     */
    private $campo;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA_HTML", type="string", length=255, nullable=false)
     */
    private $etiquetaHtml;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_SQL", type="text", nullable=true)
     */
    private $codigoSql;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_DATO", type="string", length=255, nullable=false)
     */
    private $tipoDato = 'varchar';


}

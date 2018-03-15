<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionesBusqueda
 *
 * @ORM\Table(name="funciones_busqueda")
 * @ORM\Entity
 */
class FuncionesBusqueda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfunciones_busqueda", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idfuncionesBusqueda;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="busquedas_idbusqueda", type="integer", nullable=false)
     */
    private $busquedasIdbusqueda = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="pagina", type="string", length=255, nullable=false)
     */
    private $pagina;

    /**
     * @var string
     *
     * @ORM\Column(name="parametros", type="string", length=255, nullable=true)
     */
    private $parametros;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo = 'link';

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;


}

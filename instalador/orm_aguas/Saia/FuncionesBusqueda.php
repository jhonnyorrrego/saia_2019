<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionesBusqueda
 *
 * @ORM\Table(name="FUNCIONES_BUSQUEDA")
 * @ORM\Entity
 */
class FuncionesBusqueda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFUNCIONES_BUSQUEDA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FUNCIONES_BUSQUEDA_IDFUNCIONES", allocationSize=1, initialValue=1)
     */
    private $idfuncionesBusqueda;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="BUSQUEDAS_IDBUSQUEDA", type="integer", nullable=false)
     */
    private $busquedasIdbusqueda = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="PAGINA", type="string", length=255, nullable=false)
     */
    private $pagina;

    /**
     * @var string
     *
     * @ORM\Column(name="PARAMETROS", type="string", length=255, nullable=true)
     */
    private $parametros;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=255, nullable=false)
     */
    private $tipo = 'link';

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=false)
     */
    private $orden;


}

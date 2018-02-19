<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormatoRuta
 *
 * @ORM\Table(name="FORMATO_RUTA")
 * @ORM\Entity
 */
class FormatoRuta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFORMATO_RUTA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FORMATO_RUTA_IDFORMATO_RUTA_se", allocationSize=1, initialValue=1)
     */
    private $idformatoRuta;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTIDAD", type="integer", nullable=true)
     */
    private $entidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="LLAVE", type="integer", nullable=true)
     */
    private $llave;

    /**
     * @var integer
     *
     * @ORM\Column(name="FIRMA", type="integer", nullable=true)
     */
    private $firma;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=255, nullable=true)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="FUNCION", type="string", length=255, nullable=true)
     */
    private $funcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMATO_IDFORMATO", type="integer", nullable=true)
     */
    private $formatoIdformato;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_CAMPO", type="integer", nullable=true)
     */
    private $tipoCampo = '1';


}


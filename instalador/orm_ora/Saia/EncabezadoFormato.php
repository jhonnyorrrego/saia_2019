<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EncabezadoFormato
 *
 * @ORM\Table(name="encabezado_formato")
 * @ORM\Entity
 */
class EncabezadoFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idencabezado_formato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idencabezadoFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", nullable=false)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=true)
     */
    private $etiqueta;


}

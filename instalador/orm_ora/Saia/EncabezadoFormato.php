<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EncabezadoFormato
 *
 * @ORM\Table(name="ENCABEZADO_FORMATO")
 * @ORM\Entity
 */
class EncabezadoFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDENCABEZADO_FORMATO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ENCABEZADO_FORMATO_IDENCABEZAD", allocationSize=1, initialValue=1)
     */
    private $idencabezadoFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTENIDO", type="text", nullable=true)
     */
    private $contenido = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=true)
     */
    private $etiqueta;


}

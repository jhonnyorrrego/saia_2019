<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pagina
 *
 * @ORM\Table(name="PAGINA", indexes={@ORM\Index(name="i_pagina_id_documento", columns={"ID_DOCUMENTO"})})
 * @ORM\Entity
 */
class Pagina
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CONSECUTIVO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PAGINA_CONSECUTIVO_seq", allocationSize=1, initialValue=1)
     */
    private $consecutivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_DOCUMENTO", type="integer", nullable=false)
     */
    private $idDocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="IMAGEN", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var integer
     *
     * @ORM\Column(name="PAGINA", type="integer", nullable=false)
     */
    private $pagina = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_PAGINA", type="date", nullable=true)
     */
    private $fechaPagina;

    /**
     * @var string
     *
     * @ORM\Column(name="HASH_FILE", type="string", length=255, nullable=true)
     */
    private $hashFile;


}

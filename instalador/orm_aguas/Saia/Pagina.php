<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pagina
 *
 * @ORM\Table(name="pagina", indexes={@ORM\Index(name="i_pagina_id_documento", columns={"id_documento"})})
 * @ORM\Entity
 */
class Pagina
{
    /**
     * @var integer
     *
     * @ORM\Column(name="consecutivo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $consecutivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_documento", type="integer", nullable=false)
     */
    private $idDocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var integer
     *
     * @ORM\Column(name="pagina", type="integer", nullable=false)
     */
    private $pagina = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_pagina", type="date", nullable=true)
     */
    private $fechaPagina;

    /**
     * @var string
     *
     * @ORM\Column(name="hash_file", type="string", length=255, nullable=true)
     */
    private $hashFile;


}

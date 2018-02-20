<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Convenio
 *
 * @ORM\Table(name="CONVENIO", indexes={@ORM\Index(name="i_convenio_encabezado_ctx", columns={"ENCABEZADO"}), @ORM\Index(name="i_convenio_pie_pagina_ctx", columns={"PIE_PAGINA"})})
 * @ORM\Entity
 */
class Convenio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCONVENIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CONVENIO_IDCONVENIO_seq", allocationSize=1, initialValue=1)
     */
    private $idconvenio;

    /**
     * @var string
     *
     * @ORM\Column(name="ENCABEZADO", type="text", nullable=false)
     */
    private $encabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="PIE_PAGINA", type="text", nullable=false)
     */
    private $piePagina;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;


}


<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionPagina
 *
 * @ORM\Table(name="VERSION_PAGINA", indexes={@ORM\Index(name="i_version_pagina_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class VersionPagina
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDVERSION_PAGINA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="VERSION_PAGINA_IDVERSION_PAGIN", allocationSize=1, initialValue=1)
     */
    private $idversionPagina;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=255, nullable=true)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_MINIATURA", type="string", length=255, nullable=true)
     */
    private $rutaMiniatura;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDVERSION_DOCUMENTO", type="integer", nullable=true)
     */
    private $fkIdversionDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="PAGINA_IDPAGINA", type="integer", nullable=true)
     */
    private $paginaIdpagina;


}

<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionPagina
 *
 * @ORM\Table(name="version_pagina")
 * @ORM\Entity
 */
class VersionPagina
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idversion_pagina", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idversionPagina;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=600, nullable=true)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_miniatura", type="string", length=600, nullable=true)
     */
    private $rutaMiniatura;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idversion_documento", type="integer", nullable=true)
     */
    private $fkIdversionDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="pagina_idpagina", type="integer", nullable=true)
     */
    private $paginaIdpagina;


}

<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaginaVinculados
 *
 * @ORM\Table(name="pagina_vinculados")
 * @ORM\Entity
 */
class PaginaVinculados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpagina_vinculados", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpaginaVinculados;

    /**
     * @var integer
     *
     * @ORM\Column(name="pagina_origen", type="integer", nullable=false)
     */
    private $paginaOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="pagina_destino", type="integer", nullable=false)
     */
    private $paginaDestino;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=16777215, nullable=true)
     */
    private $observaciones;


}


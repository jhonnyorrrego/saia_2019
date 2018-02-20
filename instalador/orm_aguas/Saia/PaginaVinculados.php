<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaginaVinculados
 *
 * @ORM\Table(name="pagina_vinculados", indexes={@ORM\Index(name="i_pagina_vincu_pagina_desti", columns={"pagina_destino"}), @ORM\Index(name="i_pagina_vincu_pagina_orige", columns={"pagina_origen"}), @ORM\Index(name="i_pagina_vincu_funcionario_", columns={"funcionario_idfuncionario"})})
 * @ORM\Entity
 */
class PaginaVinculados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpagina_vinculados", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @ORM\Column(name="fecha", type="date", nullable=false)
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
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;


}

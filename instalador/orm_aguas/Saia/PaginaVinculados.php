<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaginaVinculados
 *
 * @ORM\Table(name="PAGINA_VINCULADOS", indexes={@ORM\Index(name="i_pagina_vincu_pagina_desti", columns={"PAGINA_DESTINO"}), @ORM\Index(name="i_pagina_vincu_pagina_orige", columns={"PAGINA_ORIGEN"}), @ORM\Index(name="i_pagina_vincu_funcionario_", columns={"FUNCIONARIO_IDFUNCIONARIO"})})
 * @ORM\Entity
 */
class PaginaVinculados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPAGINA_VINCULADOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PAGINA_VINCULADOS_IDPAGINA_VIN", allocationSize=1, initialValue=1)
     */
    private $idpaginaVinculados;

    /**
     * @var integer
     *
     * @ORM\Column(name="PAGINA_ORIGEN", type="integer", nullable=false)
     */
    private $paginaOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="PAGINA_DESTINO", type="integer", nullable=false)
     */
    private $paginaDestino;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", nullable=true)
     */
    private $observaciones;


}

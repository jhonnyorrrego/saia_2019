<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaginaVinculados
 *
 * @ORM\Table(name="PAGINA_VINCULADOS")
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
     * @ORM\Column(name="PAGINA_ORIGEN", type="integer", nullable=true)
     */
    private $paginaOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="PAGINA_DESTINO", type="integer", nullable=true)
     */
    private $paginaDestino;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", nullable=true)
     */
    private $observaciones = 'empty_clob()';


}


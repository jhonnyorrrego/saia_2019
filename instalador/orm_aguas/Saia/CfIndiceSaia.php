<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CfIndiceSaia
 *
 * @ORM\Table(name="cf_indice_saia")
 * @ORM\Entity
 */
class CfIndiceSaia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcf_indice_saia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idcfIndiceSaia;

    /**
     * @var string
     *
     * @ORM\Column(name="tablespace_name", type="string", length=255, nullable=true)
     */
    private $tablespaceName;

    /**
     * @var string
     *
     * @ORM\Column(name="table_name", type="string", length=255, nullable=true)
     */
    private $tableName;

    /**
     * @var string
     *
     * @ORM\Column(name="column_name", type="string", length=255, nullable=true)
     */
    private $columnName;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_llave", type="string", length=20, nullable=true)
     */
    private $tipoLlave;


}

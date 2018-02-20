<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CfIndiceSaia
 *
 * @ORM\Table(name="CF_INDICE_SAIA")
 * @ORM\Entity
 */
class CfIndiceSaia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCF_INDICE_SAIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CF_INDICE_SAIA_IDCF_INDICE_SAI", allocationSize=1, initialValue=1)
     */
    private $idcfIndiceSaia;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLESPACE_NAME", type="string", length=255, nullable=true)
     */
    private $tablespaceName;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLE_NAME", type="string", length=255, nullable=true)
     */
    private $tableName;

    /**
     * @var string
     *
     * @ORM\Column(name="COLUMN_NAME", type="string", length=255, nullable=true)
     */
    private $columnName;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_LLAVE", type="string", length=20, nullable=true)
     */
    private $tipoLlave;


}

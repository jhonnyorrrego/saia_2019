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
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcfIndiceSaia;

    /**
     * @var string
     *
     * @ORM\Column(name="tablespace_name", type="string", length=255, nullable=false)
     */
    private $tablespaceName;

    /**
     * @var string
     *
     * @ORM\Column(name="table_name", type="string", length=255, nullable=false)
     */
    private $tableName;

    /**
     * @var string
     *
     * @ORM\Column(name="column_name", type="string", length=255, nullable=false)
     */
    private $columnName;



    /**
     * Get idcfIndiceSaia
     *
     * @return integer
     */
    public function getIdcfIndiceSaia()
    {
        return $this->idcfIndiceSaia;
    }

    /**
     * Set tablespaceName
     *
     * @param string $tablespaceName
     *
     * @return CfIndiceSaia
     */
    public function setTablespaceName($tablespaceName)
    {
        $this->tablespaceName = $tablespaceName;

        return $this;
    }

    /**
     * Get tablespaceName
     *
     * @return string
     */
    public function getTablespaceName()
    {
        return $this->tablespaceName;
    }

    /**
     * Set tableName
     *
     * @param string $tableName
     *
     * @return CfIndiceSaia
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;

        return $this;
    }

    /**
     * Get tableName
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * Set columnName
     *
     * @param string $columnName
     *
     * @return CfIndiceSaia
     */
    public function setColumnName($columnName)
    {
        $this->columnName = $columnName;

        return $this;
    }

    /**
     * Get columnName
     *
     * @return string
     */
    public function getColumnName()
    {
        return $this->columnName;
    }
}

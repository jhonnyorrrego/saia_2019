<?php

namespace Saia;

/**
 * CfIndiceSaia
 */
class CfIndiceSaia
{
    /**
     * @var integer
     */
    private $idcfIndiceSaia;

    /**
     * @var string
     */
    private $tablespaceName;

    /**
     * @var string
     */
    private $tableName;

    /**
     * @var string
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


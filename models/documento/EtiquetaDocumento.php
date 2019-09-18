<?php

class EtiquetaDocumento extends Model
{
    protected $iddocumento_etiqueta;
    protected $fk_etiqueta;
    protected $fk_documento;


    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'fk_etiqueta',
            'fk_documento'
        ];
        // set the date attributes on the schema
        $dateAttributes = [];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    /**
     * define el valor para un tipo de checkbox a mostrar
     *
     * @param integer $tagId
     * @param array $documentIds
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public static function defineCheckboxType($tagId, $documentIds)
    {
        $findIncluded = self::getQueryBuilder()
            ->select('count(*) as total')
            ->from('etiqueta_documento')
            ->where('fk_etiqueta', ':tagId')
            ->andWhere('fk_documento in (:documentList)')
            ->setParameter(':tagId', $tagId, \Doctrine\DBAL\Types\Type::INTEGER)
            ->setParameter(':documentList', $documentIds, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY)
            ->execute()->fetch();

        $totalDocuments = count($documentIds);
        if ($findIncluded['total'] ==  $totalDocuments) {
            $response = 1;
        } else if ($findIncluded['total'] == 0) {
            $response = 0;
        } else {
            $response = 2;
        }

        return $response;
    }
}

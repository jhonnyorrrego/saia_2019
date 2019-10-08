<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

function findFormatChilds($Documento)
{
    $children = [];
    $Formato = $Documento->getFormat();
    $formats = Model::getQueryBuilder()
        ->select('idformato', 'nombre_tabla', 'etiqueta', 'ruta_adicionar', 'nombre')
        ->from('formato')
        ->where('cod_padre = :formatId')
        ->setParameter(':formatId', $Formato->getPK(), \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();

    foreach ($formats as  $format) {
        $children[] = [
            'title' => $format['etiqueta'],
            'icon' => 'fa fa-plus-square',
            'key' => $format['idformato'],
            'expanded' => true,
            'children' => findDocumentChilds($format['nombre_tabla'], $Formato->nombre_tabla, $Documento->getPK()),
            'data' => [
                'type' => 'create_document',
                'formatId' => $format['idformato'],
                'parent' => $Documento->getPK()
            ]
        ];
    }

    return $children;
}

function findDocumentChilds($table, $parentTable, $documentId)
{
    $children = [];
    $QueryBuilder = Model::getQueryBuilder()
        ->select('c.*')
        ->from($table, 'a')
        ->join('a', $parentTable, 'b', "a.{$parentTable} = b.id{$parentTable}")
        ->join('a', 'documento', 'c', 'a.documento_iddocumento = c.iddocumento')
        ->where('b.documento_iddocumento = :parentDocument')
        ->setParameter('parentDocument', $documentId, \Doctrine\DBAL\Types\Type::INTEGER);
    $documents = Documento::findByQueryBuilder($QueryBuilder);

    foreach ($documents as $Documento) {
        $children[] = createDocumentItem($Documento);
    }

    return $children;
}

function createDocumentItem($Documento)
{
    $active = $Documento->getPK() == $_REQUEST['documentId'];
    return [
        'title' => substr($Documento->descripcion, 0, 40),
        'key' => $Documento->getPK(),
        'icon' => $active ? 'fa fa-map-marker' : 'fa fa-file-text',
        'active' => $active,
        'children' => findFormatChilds($Documento),
        'expanded' => true,
        'data' => [
            'type' => 'show_document',
            'documentId' => $Documento->getPK()
        ]
    ];
}

$parentDocumentId = buscarPapaPrimero($_REQUEST['documentId']);
$Documento = new Documento($parentDocumentId);
$ouput = ['children' => [createDocumentItem($Documento)]];
echo json_encode($ouput);

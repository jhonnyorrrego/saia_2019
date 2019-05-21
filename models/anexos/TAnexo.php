<?php
use function GuzzleHttp\json_decode;

/**
 * 
 */
trait TAnexo
{
    /**
     * calcula el peso del anexo
     *
     * @return string
     */
    public function getFileSize($route)
    {
        $data = StorageUtils::resolver_ruta($route);
        $bites = $data['clase']->get_filesystem()->size($data['ruta']);
        $size = round($bites / 1000);

        return $size . ' Kb';
    }

    /**
     * calcula el icono en base a la extension
     *
     * @return string
     */
    public function getIcon($extension)
    {
        switch (strtolower($extension)) {
            case 'csv':
            case 'xls':
            case 'xlsx':
                $icon = 'fa-file-excel-o';
                break;
            case 'png':
            case 'jpg':
                $icon = 'fa-file-picture-o';
                break;
            case 'pdf':
                $icon = 'fa-file-pdf-o';
                break;
            case 'docx':
                $icon = 'fa-file-word-o';
                break;
            default:
                $icon = 'fa-file-o';
                break;
        }

        return "<i class='fa {$icon}'></i>";
    }

    /**
     * retorna el nombre de un archivo
     * basado en el json de base de datos
     *
     * @param string $json
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-14
     */
    public static function getNameFromJson($json)
    {
        $object = json_decode($json);
        return basename($object->ruta);
    }
}

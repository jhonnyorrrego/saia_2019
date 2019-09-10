<?php
class DocumentoController {

    public static function getDocumentRoute($iddoc){
        $formatoRuta = "{estado}/{fecha}/{iddocumento}";
        $infoRuta = Model::getQueryBuilder()
        ->select('valor')
        ->from('configuracion')
        ->where("nombre='formato_ruta_documentos'")->execute()->fetchAll();
        
        if ($infoRuta) {
            $formatoRuta = $infoRuta[0]["valor"];
        }
        if (!preg_match_all("/(?:\{)([a-zA-Z_0-9]+)(?:\})/", $formatoRuta, $salida)) {
            throw new Exception("Error en el formato de la ruta de almacenamiento. Parametro configuracion->formato_ruta_documentos");
        }
        if (empty($salida) || empty($salida[1])) {
            throw new Exception("Error en el formato de la ruta de almacenamiento. Parametro configuracion->formato_ruta_documentos");
        }

        $Documento = new Documento($iddoc);
        $formatoRuta = sprintf('%s/%s/%s',$Documento->estado,$Documento->getDateAttribute("fecha","Y-m-d"),$iddoc);
        return $formatoRuta;

    }
}
?>
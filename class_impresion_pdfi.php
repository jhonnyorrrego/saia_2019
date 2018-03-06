<?php
set_time_limit(0);
use setasign\Fpdi;
require_once('db.php');
if (!$_SESSION["LOGIN" . LLAVE_SAIA] && isset($_REQUEST["LOGIN"]) && @$_REQUEST["conexion_remota"]) {
	logear_funcionario_webservice($_REQUEST["LOGIN"]);
}
require_once('tcpdf/tcpdf.php');
require_once('vendor/setasign/fpdi/src/autoload.php');


/*
 * obtener orientazion
 * numero de paginas
 * contenido para agregar
 * posicion en X y Y
 * Salida del PDF*/
class Pdf extends Fpdi\TcpdfFpdi
{
    
    protected $tplId;
    protected $totalPaginas="1";
    protected $texto;
    protected $posicionX=0;
    protected $posicionY=0;
    protected $orientacionPapel="L";
    protected $tamano_letra=16;

    
    /**
     * Cambia el valor de $texto 
     * @param string $texto contenido a insertar en el pdf
     */
    function setTexto($texto){
        $this->texto=$texto;
    }
    /**
     * Cambia el valor de $x 
     * @param string $x posicion X del contenido
     */
    function setPosicionX($x){
        $this->posicionX=$x;
    }
    /**
     * Cambia el valor de $x 
     * @param string $x posicion X del contenido
     */
    function setPosicionY($y){
        $this->posicionY=$y;
    }
    /**
     * Cambia el valor de la orientacion del papel, verticual u horizontal
     * @param string $orientacion_papel orientacion del papel
     */
    function setOrientacionPapel($orientacion_papel){
        $this->orientacionPapel=$orientacion_papel;
    }
    /**
     * Cambia el tamano de la letra
     * @param int $tamano_letra tamano de la letra
     */
    function setTamanoLetra($tamano_letra){
        $this->tamano_letra=$tamano_letra;
    }
    function Header()
    {
        $size = $this->useImportedPage($this->tplId);
    }
    /**
     * Almacena el total de paginas que tiene el PDF a importar
     * @param string $ruta Ruta origen de la carga del PDF
     */
	function setRuta($ruta){
		$this->totalPaginas = $this->setSourceFile($ruta);
	}
    /**
     * Almacena el total de paginas que tiene el PDF a importar
     * @param string $pagina Numero de pagina del PDF en el cual se pondra el contenido
     */
	function importar_paginas($pagina=NULL,$etiqueta=NULL){
	    
	    if($etiqueta==1){
	        if(!$pagina){
	            $pagina=1;
	        }
	        for ($pageNo = 1; $pageNo <= $this->totalPaginas; $pageNo++) {
	            $this->tplId = $this->importPage($pageNo);
	            $this->SetFontSize($this->tamano_letra);
	            $size = $this->getTemplateSize($this->tplId);
	            $this ->useTemplate($this->tplId, null, null, $size['width'], $size['height'], true);
	            $this->AddPage();
	            if($pagina==$pageNo){
	                $this->escribir_pdf($this->texto,$this->posicionX,$this->posicionY);
	            }
	        }
	    }
        else{
            $pageNo=explode(",",$pagina);
            sort($pageNo);
            
            $totalPaginas=count($pageNo);

            for ($i = 0; $i < $totalPaginas; $i++) {
                $this->tplId = $this->importPage($pageNo[$i]);
                $this->SetFontSize($this->tamano_letra);
                $size = $this->getTemplateSize($this->tplId);
                
                // create a page (landscape or portrait depending on the imported page size)
                if ($size['w'] > $size['h']) {
                    $this->AddPage('L', array($size['w'], $size['h']));
                } else {
                    $this->AddPage('P', array($size['w'], $size['h']));
                }
                $this->useTemplate($this->tplId);
                
            }
        }
        
	}
    /**
     * Almacena el total de paginas que tiene el PDF a importar
     * @param string $texto Escribe el contenido en la pagina actual
     * @param string $x posicion en X en la cual se pondra el contenido
     * @param string $y posicion en Y en la cual se pondra el contenido
     */
    private function escribir_pdf($texto,$x,$y){
        $this->writeHTMLCell("","",$x,$y,$texto);
    }
}

$param=json_decode(urldecode($_REQUEST['param']));

if($param->versionamiento==1){
    $destino=str_replace("v1.pdf", "v2.pdf", $param->ruta);
    $nombre=explode("anexos/", $destino);
    // initiate PDF
    $contenido=$param->contenido;
    
    $pdf = new Pdf();
    $pdf->setTexto($contenido);
    $pdf->setRuta($param->ruta);
    //$pdf->SetMargins($param->margen_izquierda, $param->margen_superior,$param->margen_derecha,$param->margen_inferior);
    $pdf->SetAutoPageBreak(true, 20);
    //$pdf->setOrientacionPapel($param->orientacion);
    $pdf->setPosicionX($param->posicionx);
    $pdf->setPosicionY($param->posiciony);
    $pdf->setTamanoLetra($param->tamano);
    $pdf->importar_paginas($param->pagina,1);
    $pdf->Output($destino,'F');
    $insert_anexo = "insert into anexos(documento_iddocumento, ruta, etiqueta, tipo, formato,fecha_anexo) VALUES (0,'" . $destino . "','" . $nombre[1]. "','pdf',1,".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').")";

    phpmkr_query($insert_anexo, $conn, usuario_actual('funcionario_codigo'));
    $idnexo = phpmkr_insert_id();
    $insert_permiso = "insert into permiso_anexo (anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_dependencia, caracteristica_cargo, caracteristica_total) VALUES (" . $idnexo . "," . usuario_actual('funcionario_codigo'). ",'lem', '', '', 'l')";
    phpmkr_query($insert_permiso);
    redirecciona("visores/pdf/web/viewer2.php?files=".base64_encode($destino));
}elseif($param->x_pag_pdf){
    
    include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
    
    $formato_ruta = aplicar_plantilla_ruta_documento($param->iddocumento);
    $datos_documento=busca_filtro_tabla("a.plantilla,a.numero,b.idformato,".fecha_db_obtener("a.fecha","Y-m-d")." AS fecha","documento a, formato b","lower(a.plantilla)=b.nombre AND a.iddocumento=".$param->iddocumento,"",$conn);
    
    $ruta_pdfs = ruta_almacenamiento("pdf");
    $carpeta = $ruta_pdfs . $formato_ruta . "/pdf_transferido";
    
    $nombre=$datos_documento[0]["plantilla"] . "_" . $datos_documento[0]["numero"] . "_" . str_replace("-", "_", date('Y-m-d')) . ".pdf";
    $destino = $carpeta . "/" . $nombre;
    
    crear_destino($carpeta);
    chmod($carpeta,0777);

    
    $pdf = new Pdf();
    
    $pdf->setRuta($param->ruta);
    //$pdf->SetMargins($param->margen_izquierda, $param->margen_superior,$param->margen_derecha,$param->margen_inferior);
    $pdf->SetAutoPageBreak(true, 20);
    //$pdf->setOrientacionPapel($param->orientacion);
    
    $pdf->importar_paginas($param->x_pag_pdf,0);
    
    $pdf->Output($destino,'F');
    $buzon_salida=explode(",",$param->idtransferencia);
    $cont=count($buzon_salida);
    //print_r($buzon_salida);die();
    for ($i = 0; $i < $cont; $i++) {
        $insert_anexo = "insert into anexos_transferencia(documento_iddocumento, ruta, etiqueta, tipo, formato,idbuzon_salida) VALUES (".$param->iddocumento.",'" . $destino . "','" . $nombre. "','pdf',".$datos_documento[0]['idformato'].",".$buzon_salida[$i].")";
        phpmkr_query($insert_anexo, $conn, usuario_actual('funcionario_codigo'));
    }
    
    //$idnexo = phpmkr_insert_id();

    if($param->retorno=='ruta'){
        return($destino);
    }else{
        redirecciona("visores/pdf/web/viewer2.php?files=".base64_encode($destino));
    }
}
?>
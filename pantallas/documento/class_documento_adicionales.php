<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } ?>
<?php 
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php"); 
include_once($ruta_db_superior."pantallas/lib/elasticsearch/class_elasticsearch.php"); 
class documento{
    var $datos_ft;
    var $cliente_elasticsearch;
	var $iddocumento;
	var $mensaje;
	var $estado_mensaje;
	var $documento;
	var $idformato;
	var $nombre_formato;
	
	function get_documento($iddocumento) {
		$this->iddocumento=$iddocumento;
		$this->documento=busca_filtro_tabla("","documento","iddocumento=".$this->iddocumento,"",$conn);
		if($this->documento["numcampos"]){
			$formato=busca_filtro_tabla("","formato","lower(nombre) LIKE '".strtolower($this->documento[0]["plantilla"])."'","",$conn);
			if($formato["numcampos"]){
				$this->idformato=$formato[0]["idformato"];
				$this->nombre_formato=$formato[0]["nombre"];
			}
		}
	}
	
    function asignar_iddocumento($iddocumento){
        if($this->iddocumento && $this->iddocumento!=$iddocumento){
            $this->mensaje="El documento esta relacionado con el id ".$this->iddocumento." se a reemplazado por ".$iddocumento;
            $this->estado_mensaje="warning";
            $this->iddocumento=$iddocumento;
            if($this->documento["numcampos"])
                $this->get_documento($this->iddocumento);
            if($this->datos_ft["numcampos"])    
                $this->cargar_informacion_ft();
        }
        else{
            $this->iddocumento=$iddocumento;
            $this->mensaje="El documento con id ".$this->iddocumento." asignado correctamente";
            $this->estado_mensaje="success";
        }
    }
    function cargar_informacion_ft(){
        if(@$this->documento["numcampos"]){
            $this->datos_ft=busca_filtro_tabla('','ft_'.strtolower($this->documento[0]["plantilla"])." A",'A.documento_iddocumento='.$this->iddocumento,'',conn);
        }
    }
    function exportar_informacion($tipo_export=""){
        $datos_temporal=array();
        if(!@$this->documento["numcampos"]){
            $this->get_documento($this->iddocumento);
            if(!$this->documento["numcampos"]){
                die("Existe un error al tratar de buscar el documento con id ".$this->iddocumento);
            }
        }    
        if(!@$this->datos_ft["numcampos"]){
            $this->cargar_informacion_ft();
        }
        $this->cargar_adicional_documento();
        if(@$this->documento["numcampos"]){
            foreach($this->documento[0] AS $key=>$valor){
                if(!is_int($key)){
                    $datos_temporal["documento"][$key]=$valor;        
                }
            }
        }
        if(@$this->datos_ft["numcampos"]){
            foreach($this->datos_ft[0] AS $key=>$valor){
                if(!is_int($key)){
                    $datos_temporal["datos_ft"][$key]=mostrar_valor_campo($key,$this->idformato,$this->iddocumento,1);
                }
            }
        }
        //aqui debe ir las diferentes formas de exportar un documento json, csv, array, etc y cuando exista otro metodo como isadg o chicago aqui es donde debe quedar
        switch($tipo_export){
            case "json":
                return(json_encode($datos_temporal));
            break;
            default:
                return($datos_temporal);
            break;
        }
        
    }
    function cargar_adicional_documento(){
        if($this->documento["numcampos"]){
            if($this->datos_ft["numcampos"] && $this->datos_ft[0]["serie_idserie"]){
                $this->documento[0]["serie"]=$this->datos_ft[0]["serie_idserie"];
            }
            $serie=busca_filtro_tabla('','serie','idserie='.$this->documento[0]["serie"],'',conn);
            if($serie["numcampos"]){
                $this->documento[0]["nombre_serie"]=$serie[0]["nombre"];
            }
            else{
                $this->documento[0]["nombre_serie"]='';
            }
            $tipo_documento=busca_filtro_tabla('','contador','idcontador='.$this->documento[0]["tipo_radicado"],'',conn);
            if($tipo_documento["numcampos"]){
                $this->documento[0]["nombre_contador"]=$tipo_documento[0]["nombre"];
            }
            else{
                $this->documento[0]["nombre_contador"]='';
            }
        }
    }
    function crear_elasticsearch(){
        if(!@$this->cliente_elasticsearch){
            $this->cliente_elasticsearch = new elasticsearch_saia();
        }
        /*if($this->cliente_elasticsearch->error()){
            $this->error_saia->asignar("Ya existe un cliente elasticsearch",3);
        }*/
    }
    //Se debe tener en cuenta que el documento ya debe estar cargado
    function indexar_elasticsearch($iddocumento){
        $this->asignar_iddocumento($iddocumento);
        $arreglo_datos=$this->exportar_informacion();
        if($this->documento["numcampos"]){
            if(!@$this->cliente_elasticsearch){
                $this->crear_elasticsearch();
            } 
            $indice="documentos";
            $tipo_dato=$this->documento[0]["plantilla"];
            $id=$this->documento[0]["iddocumento"];
            return($this->cliente_elasticsearch->adicionar_indice($indice,$id,$arreglo_datos,$tipo_dato));
        }
        return(false);
    }
    //$parametros= arreglo asociativo de valores a buscar ejemplo numero=>234, descripcion=>constituci&oacute;n pol&iacute;tica de COLOMBIA, 
    //en cualquier caso se debe enviar sin comilllas adicionales a las definidas por la cadena
    function buscar_elasticsearch($param_busqueda,$from=0,$size=20,$parametros=""){
        $cadena=array();
        if(!@$this->cliente_elasticsearch){
            $this->crear_elasticsearch();
        }
        foreach($param_busqueda AS $key=>$valor){
            array_push($cadena,'"'.$key.'" : "'.$valor.'"');
        }
        $json = '{
            "from" : '.$from.', "size" : '.$size.',
            "query" : {
                "match" : {
                    '.implode(",",$cadena).'
                }
            }
        }';
		if($parametros==''){
			$parametros=array("index"=>"documentos");
		}
        $response = $this->cliente_elasticsearch->buscar_item_elastic($parametros,$json);
        return($response);
    }
	function buscar_elasticsearch_all($parametros=''){
		if(!@$this->cliente_elasticsearch){
            $this->crear_elasticsearch();
        }
        $json = '{
		    "query": {
		        "match_all": {}
		    }
		}';
		if($parametros==''){
			$parametros=array("index"=>"documentos");
		}
        $response = $this->cliente_elasticsearch->buscar_item_elastic($parametros,$json);
        return($response);
	}
	function borrar_elasticsearch_all($parametros=''){
		if(!@$this->cliente_elasticsearch){
            $this->crear_elasticsearch();
        }
        $json = '{
		    "query": {
		        "match_all": {}
		    }
		}';
		if($parametros==''){
			$parametros=array("index"=>"documentos");
		}
        $response = $this->cliente_elasticsearch->buscar_item_elastic($parametros,$json);
		$response_borrar=array();
		foreach($response["hits"]["hits"] AS $key=>$valor){
			array_push($response_borrar,$this->cliente_elasticsearch->borrar_indice($valor["_index"],$valor["_id"],$valor["_type"]));
		}
        return($response_borrar);
	}
}
?>
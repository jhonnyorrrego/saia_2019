<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } ?>
<?php include_once($ruta_db_superior."db.php"); ?>
<?php include_once($ruta_db_superior."pantallas/documento/funciones.php"); 
include_once($ruta_db_superior."pantallas/documento/class_transferencia_saia.php"); 
include_once($ruta_db_superior."pantallas/lib/elasticsearch/class_elasticsearch.php"); 
include_once($ruta_db_superior."pantallas/lib/error_saia.php"); 
?><?php
class documento{
var $documento;
    var $idpantalla_documento;
		var $campos_documento;
    var $iddocumento;
    var $nombre_pantalla;
    var $error_saia;
public function __construct(){
$this->campos_documento=array();
$this->get_campos_documento();
$this->idpantalla_documento=6;
$this->nombre_pantalla=documento;
$this->error_saia=new error_saia();
}
public function __destruct(){}
 public function set_documento($validar=1,$set_type="request",$data=null){
    global $conn, $ruta_db_superior;
    $retorno=new stdClass;
    $retorno->exito=0;
    $retorno->mensaje="Error al guardar Documento";
    $exito=1;
if(!$this->validar_insert() && $validar){
    $exito=0;
    $retorno->mensaje="Tratando de almacenar varias veces los registros"; 
    return($retorno);
  }if($set_type=="request"){
    $datos_set=$_REQUEST;
  } else if($set_type=="json" && $data){
    $datos_set=(array)json_decode($data);
  }$valores_documento=array();
$campos_temp=array();
foreach($this->campos_documento AS $key=>$campo){
        if($key!="" && isset($datos_set[$key])){
          if(is_array($datos_set[$key])){
            $valor_request=implode(",",$datos_set[$key]);
          }
          else{
            $valor_request=$datos_set[$key];
          }					
        }
        else{
        	if($campo["predeterminado"]){
        		$valor_request=$campo["predeterminado"];
        	}
					else{
          	$valor_request="";
					}
        }
				if($campo["tipo_dato"]=="datetime"){
					if($valor_request=="now()"){
						$valor_request=date("Y-m-d H:i:s");
					}
					$valor_request=fecha_db_obtener("'".$valor_request."'","Y-m-d H:i:s");
				}
				else if($campo["tipo_dato"]=="date"){
					if($valor_request=="now()"){
						$valor_request=date("Y-m-d");
					}
					$valor_request=fecha_db_obtener("'".$valor_request."'","Y-m-d");
				}
				else{
					$valor_request="'".$valor_request."'";
				}
        array_push($campos_temp,$key);
        array_push($valores_documento,$valor_request);
      }
$sql_documento="INSERT INTO documento(".implode(",",$campos_temp).")VALUES(".implode(",",$valores_documento).")";      
        phpmkr_query($sql_documento);
$this->get_documento(phpmkr_insert_id());

      if(!$this->iddocumento){      
        $exito=0; 
        $retorno->mensaje.="<br>".$sql_documento;
        }
  if($exito){
$retorno->exito=1;
$retorno->iddocumento=$this->iddocumento;
$retorno->mensaje="Documento guardada con &eacute;xito";

  }
  return($retorno);
}
public function get_documento($iddocumento) {
$this->iddocumento=$iddocumento;
$this->documento=busca_filtro_tabla("","documento","iddocumento=".$this->iddocumento,"",$conn);
}
public function get_campos_documento() {
    global $conn;
    $campos_temp=$conn->Busca_tabla("documento");
    $this->campos_documento=$campos_temp;
    /*$campos_temp=busca_filtro_tabla("","pantalla_campos","tabla='documento' AND tabla<>''","orden",$conn);
        for($i=0;$i<$campos_temp["numcampos"];$i++){
            $this->campos_documento[$campos_temp[$i]["nombre"]]=$campos_temp[$i];
        }*/
    }
public function get_campo_documento($nombre){
if($this->campos_documento!=""){
        return($this->campos_documento[$nombre]);
      }
      else{
        return($nombre);
      }
      }
public function get_valor_documento($tabla,$nombre_campo){
if($tabla=="documento" && $this->documento["numcampos"]){
      return($this->documento[0][$nombre_campo]);  		
  } 
  else{return($this->campos_documento[$nombre_campo]["predeterminado"]);
  }
}
public function update_documento($set_type="request",$data=null){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al actualizar Documento";
$exito=0;
if($set_type=="request"){
      $datos_set=$_REQUEST;
    } else if($set_type=="json" && $data){
      $datos_set=(array)json_decode($data);
      $_REQUEST["iddocumento"]=$datos_set["iddocumento"];
    }if($_REQUEST["iddocumento"]){$retorno=$this->validar_retorno_pantalla($retorno,$retorno_temp);
$sql2="UPDATE documento SET ";
$valor_update=array();
foreach($this->campos_documento AS $key=>$value){
  if($key!="" && isset($datos_set[$key])){
    $valor_request="";
    if(is_array($datos_set[$key])){
      $valor_request=$key."='".implode(",",$datos_set[$key])."'";
    }
    else{
      $valor_request=$key."='".$datos_set[$key]."'";
    }
    array_push($valor_update,$valor_request);
  }
}
$sql2.= implode(",",$valor_update);
$sql2.= " WHERE iddocumento=".$_REQUEST["iddocumento"];
$retorno->sql_documento=$sql2;
phpmkr_query($sql2);
$exito=1;
$this->get_documento($_REQUEST["iddocumento"]);
}
if($exito){$retorno->exito=1;
  $retorno->mensaje="Pantalla Documento actualizado con &eacute;xito"; 
}
return($retorno);
}
public function delete_documento($set_type="request",$data=null){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al Eliminar Documento";
$exito=0;
if($set_type=="request"){
      $datos_set=$_REQUEST;
    } else if($set_type=="json" && $data){
      $datos_set=(array)json_decode($data);
      $_REQUEST["iddocumento"]=$datos_set["iddocumento"];
    }if($_REQUEST["iddocumento"]){$retorno=$this->validar_retorno_pantalla($retorno,$retorno_temp);
$sql2="DELETE FROM documento";
$sql2.= " WHERE iddocumento=".$_REQUEST["iddocumento"];
$retorno->sql_documento=$sql2;
phpmkr_query($sql2);
$exito=1;
}
if($exito){$retorno->exito=1;
  $retorno->mensaje="Pantalla Documento borrado con &eacute;xito"; 
}
return($retorno);
}
public function existe_documento(){
    if(!$this->documento["numcampos"]){
      return(false);
    }
return(true);
}
public function validar_insert(){
if(isset($_SESSION["key_formulario_saia"])){
  if ($_REQUEST["key_formulario_saia"] === $_SESSION["key_formulario_saia"]) {
    return false;
  } 
  else {
    $_SESSION["key_formulario_saia"] = $_REQUEST["key_formulario_saia"];
    return true;
  }
} 
else {
  $_SESSION["key_formulario_saia"] = $_REQUEST["key_formulario_saia"];
  return true;
}
}
public function validar_retorno_pantalla($retorno,$retorno_temp){
    if($retorno_temp && $retorno_temp->operador_exito){ 
      if($retorno_temp->operador_exito==1)   
        $retorno->exito=$retorno->exito && $retorno_temp->exito;
      else if($retorno_temp->operador_exito==2) 
        $retorno->exito=$retorno->exito || $retorno_temp->exito;
      else if($retorno_temp->operador_exito==3) 
        $retorno->exito=$retorno->exito xor $retorno_temp->exito;        
    }
    if($retorno_temp->concatenar==1){
      $retorno->mensaje.=$retorno_temp->mensaje;
    }
    else if ($retorno_temp->concatenar==2){
      $retorno->mensaje=$retorno_temp->mensaje;
    }
    return($retorno);
  }public function insert_busqueda_temp_documento($validar=1){
    global $conn, $ruta_db_superior;
    $retorno=new stdClass;
    $retorno->exito=0;
    $retorno->mensaje="Error al almacenar los datos de la busqueda de Documento";
    $exito=1;
if(!$this->validar_insert() && $validar){
    $exito=0;
    $retorno->mensaje="Tratando de almacenar varias veces los registros"; 
    return($retorno);
  }$valores_documento=array();
$campos_temp=array();

      if(@$_REQUEST["idbusqueda_componente"]){
        $busqueda_componente[0]["idbusqueda_componente"]=$_REQUEST["idbusqueda_componente"];
        $busqueda_componente["numcampos"]=1;
      }
      else{
        $busqueda_componente=busca_filtro_tabla("","busqueda_componente","nombre LIKE 'pantalla_documento'","",$conn);
      }  
      $cant_campos=count($this->campos_documento);
    if($busqueda_componente["numcampos"]){
      $k=0;      
      foreach($this->campos_documento AS $key=>$campo){
        if($key!="" && @$_REQUEST[$key]!==""){
          if(is_array($_REQUEST[$key])){
            $valor_request=implode(",",$_REQUEST[$key]);
          }
          else{
            $valor_request=$_REQUEST[$key];
          }	
          //////////////////TODO: Agrupacion de condiciones 
          if(@$_REQUEST["bqsaiacondicion_".$key] && @$_REQUEST["bqsaiaenlace_".$key]){            
            if($k){
              $cadena_condicion.="|".$_REQUEST["bqsaiaenlace_".$key]."|";
            } 
            $cadena_condicion.="lower(".$key.")|".$_REQUEST["bqsaiacondicion_".$key]."|(".strtolower($_REQUEST[$key]).")";
            $k++;                                   
          }  				
        }
      }

$sql_documento="INSERT INTO busqueda_filtro_temp(fk_busqueda_componente,funcionario_idfuncionario,fecha,detalle)VALUES(".$busqueda_componente[0]["idbusqueda_componente"].",'".usuario_actual("funcionario_codigo")."',".fecha_db_obtener("'".date("Y-m-d H:i:s")."'","Y-m-d H:i:s").",'".$cadena_condicion."')";      
        phpmkr_query($sql_documento);
$idbusqueda_temp=phpmkr_insert_id();

      if(!$idbusqueda_temp){      
        $exito=0; 
        $retorno->mensaje.="<br>".$sql_documento;
      }}
  if($exito){
$retorno->exito=1;
$retorno->idbusqueda_temp=$idbusqueda_temp;
$retorno->mensaje="Documento guardada con &eacute;xito";

  }
  return($retorno);
}

  } 
?>
<?php
runkit_import($ruta_db_superior."pantallas/documento/class_documento_adicionales.php");
?>
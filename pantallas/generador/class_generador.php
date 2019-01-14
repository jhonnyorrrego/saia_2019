<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } ?>
<?php include_once($ruta_db_superior."db.php"); ?><?php
class generador{
var $generador;
    var $idpantalla_generador;
		var $campos_generador;
    var $nombre_pantalla;
    var $idgenerador;
public function __construct(){
$this->campos_generador=array();
$this->get_campos_generador();
$this->idpantalla_generador=62;
$this->nombre_pantalla=generador;
}
public function __destruct(){}
 public function set_generador($validar=1,$set_type="request",$data=null){
    global $conn, $ruta_db_superior;
    $retorno=new stdClass;
    $retorno->exito=0;
    $retorno->mensaje="Error al guardar Usuario";
    $exito=1;
if(!$this->validar_insert() && $validar){
    $exito=0;
    $retorno->mensaje="Tratando de almacenar varias veces los registros"; 
    return($retorno);
  }if($set_type=="request"){
    $datos_set=$_REQUEST;
  } else if($set_type=="json" && $data){
    $datos_set=(array)json_decode($data);
  }$valores_generador=array();
$campos_temp=array();
foreach($this->campos_generador AS $key=>$campo){
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
        array_push($valores_generador,$valor_request);
      }
$sql_generador="INSERT INTO generador(".implode(",",$campos_temp).")VALUES(".implode(",",$valores_generador).")";      
        phpmkr_query($sql_generador);
$this->get_generador(phpmkr_insert_id());

      if(!$this->idgenerador){      
        $exito=0; 
        $retorno->mensaje.="<br>".$sql_generador;
        }
  if($exito){
$retorno->exito=1;
$retorno->idgenerador=$this->idgenerador;
$retorno->mensaje="Usuario guardada con &eacute;xito";

  }
  return($retorno);
}
public function get_generador($idgenerador){
$this->idgenerador=$idgenerador;
$this->generador=busca_filtro_tabla("","generador","idgenerador=".$this->idgenerador,"",$conn);
}
public function get_campos_generador(){
$campos_temp=busca_filtro_tabla("","pantalla_campos","tabla='generador' AND tabla<>''","orden",$conn);
        for($i=0;$i<$campos_temp["numcampos"];$i++){
          $this->campos_generador[$campos_temp[$i]["nombre"]]=$campos_temp[$i];
        }      
      }
public function get_campo_generador($nombre){
if($this->campos_generador!=""){
        return($this->campos_generador[$nombre]);
      }
      else{
        return($nombre);
      }
      }
public function get_valor_generador($tabla,$nombre_campo){
if($tabla=="generador" && $this->generador["numcampos"]){
      return($this->generador[0][$nombre_campo]);  		
  } 
  else{return($this->campos_generador[$nombre_campo]["predeterminado"]);
  }
}
public function update_generador($set_type="request",$data=null){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al actualizar Usuario";
$exito=0;
if($set_type=="request"){
      $datos_set=$_REQUEST;
    } else if($set_type=="json" && $data){
      $datos_set=(array)json_decode($data);
      $_REQUEST["idgenerador"]=$datos_set["idgenerador"];
    }if($_REQUEST["idgenerador"]){$retorno=$this->validar_retorno_pantalla($retorno,$retorno_temp);
$sql2="UPDATE generador SET ";
$valor_update=array();
foreach($this->campos_generador AS $key=>$value){
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
$sql2.= " WHERE idgenerador=".$_REQUEST["idgenerador"];
$retorno->sql_generador=$sql2;
phpmkr_query($sql2);
$exito=1;
$this->get_generador($_REQUEST["idgenerador"]);
}
if($exito){$retorno->exito=1;
  $retorno->mensaje="Pantalla Usuario actualizado con &eacute;xito"; 
}
return($retorno);
}
public function delete_generador($set_type="request",$data=null){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al Eliminar Usuario";
$exito=0;
if($set_type=="request"){
      $datos_set=$_REQUEST;
    } else if($set_type=="json" && $data){
      $datos_set=(array)json_decode($data);
      $_REQUEST["idgenerador"]=$datos_set["idgenerador"];
    }if($_REQUEST["idgenerador"]){$retorno=$this->validar_retorno_pantalla($retorno,$retorno_temp);
$sql2="DELETE FROM generador";
$sql2.= " WHERE idgenerador=".$_REQUEST["idgenerador"];
$retorno->sql_generador=$sql2;
phpmkr_query($sql2);
$exito=1;
}
if($exito){$retorno->exito=1;
  $retorno->mensaje="Pantalla Usuario borrado con &eacute;xito"; 
}
return($retorno);
}
public function existe_generador(){
    if(!$this->generador["numcampos"]){
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
  }public function insert_busqueda_temp_generador($validar=1){
    global $conn, $ruta_db_superior;
    $retorno=new stdClass;
    $retorno->exito=0;
    $retorno->mensaje="Error al almacenar los datos de la busqueda de Usuario";
    $exito=1;
if(!$this->validar_insert() && $validar){
    $exito=0;
    $retorno->mensaje="Tratando de almacenar varias veces los registros"; 
    return($retorno);
  }$valores_generador=array();
$campos_temp=array();

      if(@$_REQUEST["idbusqueda_componente"]){
        $busqueda_componente[0]["idbusqueda_componente"]=$_REQUEST["idbusqueda_componente"];
        $busqueda_componente["numcampos"]=1;
      }
      else{
        $busqueda_componente=busca_filtro_tabla("","busqueda_componente","nombre LIKE 'pantalla_generador'","",$conn);
      }  
      $cant_campos=count($this->campos_generador);
    if($busqueda_componente["numcampos"]){
      $k=0;      
      foreach($this->campos_generador AS $key=>$campo){
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

$sql_generador="INSERT INTO busqueda_filtro_temp(fk_busqueda_componente,funcionario_idfuncionario,fecha,detalle)VALUES(".$busqueda_componente[0]["idbusqueda_componente"].",'".usuario_actual("funcionario_codigo")."',".fecha_db_obtener("'".date("Y-m-d H:i:s")."'","Y-m-d H:i:s").",'".$cadena_condicion."')";      
        phpmkr_query($sql_generador);
$idbusqueda_temp=phpmkr_insert_id();

      if(!$idbusqueda_temp){      
        $exito=0; 
        $retorno->mensaje.="<br>".$sql_generador;
      }}
  if($exito){
$retorno->exito=1;
$retorno->idbusqueda_temp=$idbusqueda_temp;
$retorno->mensaje="Usuario guardada con &eacute;xito";

  }
  return($retorno);
}

  } 
?>

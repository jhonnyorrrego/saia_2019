<?php
include_once(dirname(__FILE__)."/../../db.php");
function mostrar_datos_expediente($iddoc){
$entidad=1;
$llave_entidad=array($_SESSION["usuario_actual"]);
$expediente=datos_expediente($iddoc);
$texto='';
if($expediente["numcampos"]){
  $texto.='<table class="table table-bordered" style="max-width: 200px;">';
  for($i=0;$i<$expediente["numcampos"];$i++){
  	$permiso=permiso_funcionario_expediente($expediente[$i],$entidad,$llave_entidad);
  	$texto.='<tr>';
  	if(strpos($permiso,"l")!==false){
  		$texto.='<td ><a href="#">'.$expediente[$i]["nombre"]."</a></td>";
  	}
  	else{
  		$texto.='<td>'.$expediente[$i]["nombre"].'</td>';
  	}
  	$texto.='</tr>';
  }
  $texto.='</table></div>';
}
return($texto);
}
function datos_expediente($iddoc){
	global $conn;
	$datos=busca_filtro_tabla("","vexpediente","documento_iddocumento=".$iddoc,"",$conn);
	return($datos);
}
function permiso_funcionario_expediente($expediente,$entidad,$llave){
	if(in_array($expediente["propietario"],$llave)){
		return("lame");
	}
	else{
		$permiso_expediente=busca_filtro_tabla("","entidad_expediente","entidad_identidad=".$entidad." AND expediente_idexpediente=".$expediente["idexpediente"]." AND llave_entidad=".$llave,"",$conn);
		if($permiso_expediente["numcampos"]){
			return($permiso_expediente["permiso"]);
		}
	}
	return("");
}

function mostrar_informacion_adicional_expediente($idexpediente){
    global $conn; 
    
    $cadena='';
    
    //EXPEDIENTE
    $expediente_actual=busca_filtro_tabla("serie_idserie,propietario","expediente","idexpediente=".$idexpediente,"",$conn);
    
    //NOMBRE DE LA DEPENDENCIA
    $dependencia_propietario=busca_filtro_tabla("dependencia","vfuncionario_dc","estado_dc=1 AND funcionario_codigo=".$expediente_actual[0]['propietario'],"",$conn);
    $nombre_dependencia_propietario=$dependencia_propietario[0]['dependencia'];  
    $cadena.=$nombre_dependencia_propietario;
    
    //NOMBRE DE LA SERIE
    $serie=busca_filtro_tabla("nombre","serie","idserie=".$expediente_actual[0]['serie_idserie'],"",$conn);
    $cadena.='<br>';
    $cadena.=$serie[0]['nombre'];
    return($cadena);
}

function enlace_expediente($idexpediente,$nombre){
	global $conn;    

    $expediente_actual=busca_filtro_tabla("tomo_padre,tomo_no,serie_idserie,propietario","expediente","idexpediente=".$idexpediente,"",$conn);
    //$dependencia_propietario=busca_filtro_tabla("dependencia","vfuncionario_dc","estado_dc=1 AND funcionario_codigo=".$expediente_actual[0]['propietario'],"",$conn);
    //$nombre_dependencia_propietario=$dependencia_propietario[0]['dependencia'];
    
    $tomo_padre=$idexpediente;
    if($expediente_actual[0]['tomo_padre']){
        $tomo_padre=$expediente_actual[0]['tomo_padre'];
    }
    $ccantidad_tomos=busca_filtro_tabla("idexpediente","expediente","tomo_padre=".$tomo_padre,"",$conn);
    $cantidad_tomos=$ccantidad_tomos['numcampos']+1; //tomos + el padre  
    $cadena_tomos=("&nbsp;&nbsp;&nbsp;<i><b style='font-size:10px;'>Tomo: </b></i><i style='font-size:10px;'>".$expediente_actual[0]['tomo_no']." de ".$cantidad_tomos."</i>");

    
    return("<div style='' class='link kenlace_saia' enlace='pantallas/busquedas/consulta_busqueda_expediente.php?idbusqueda_componente=".$_REQUEST["idbusqueda_componente"]."&idexpediente=".$idexpediente."&variable_busqueda=".@$_REQUEST['variable_busqueda']."' conector='iframe' titulo='".$nombre."'><table><tr><td style='font-size:12px;'> <i class=' icon-folder-open pull-left'></i>&nbsp;<b>".$nombre."</b>&nbsp;".$cadena_tomos."</td></tr></table></div>");
}
function request_expediente_padre(){
$texto='';
if(@$_REQUEST["idexpediente"]){
  $texto.="cod_padre=".$_REQUEST["idexpediente"];
}
else if(@$_REQUEST["idbusqueda_filtro_temp"]){
	$texto.="1=1";
}
else{
  $texto.="(cod_padre=0 OR cod_padre IS NULL) ";
}
if(@$_REQUEST["idcaja"]){
	$texto.=" AND fk_idcaja=".@$_REQUEST["idcaja"];
}
if(@$_REQUEST["variable_busqueda"]==2 || @$_REQUEST["variable_busqueda"]==3){
	if(@$_REQUEST["idexpediente"]){
	  $texto="cod_padre=".$_REQUEST["idexpediente"];
	}else{
		$texto="1=1";
	}
}
return($texto);
}
function request_expediente_actual(){
$texto='';
if(@$_REQUEST["expediente_actual"]){
  $texto.=" AND a.idexpediente=".$_REQUEST["expediente_actual"];
}
$texto2=obtener_expedientes_negados();
if($texto2){
	$texto.=$texto2;
}
return($texto);
}
function obtener_expedientes_negados(){
	global $conn;
	$negados=busca_filtro_tabla("expediente_idexpediente","entidad_expediente A","((A.entidad_identidad=1 AND llave_entidad=".usuario_actual('idfuncionario').")or(A.entidad_identidad=2 AND llave_entidad in(".dependencia_actual_codigos()."))) AND A.estado=2","",$conn);
	
	$no_incluidos=array();
	if($negados["numcampos"]){
		$no_incluidos=extrae_campo($negados,"expediente_idexpediente");
		$texto=implode(",",$no_incluidos);
		$texto=" AND a.idexpediente not in(".implode(",",$no_incluidos).")";
	}
	return($texto);
}
function request_expediente_documento(){
if(@$_REQUEST["idexpediente"]){
  return($_REQUEST["idexpediente"]);
}
else{
  return("0");
}
}

function barra_superior_busqueda(){
	$permiso=new Permiso();
	$ok1=$permiso->acceso_modulo_perfil('adicionar_expediente');
	$ok2=$permiso->acceso_modulo_perfil('transferencia_doc');
	$cadena='';
	
	if($ok1){
		$cadena.='
	<li class="divider-vertical"></li>                          
	<li>            
	 <div class="btn-group">                    
	    <button class="btn btn-mini" id="adicionar_expediente" idbusqueda_componente="'.$_REQUEST["idbusqueda_componente"].'" title="Adicionar expediente hijo" enlace="pantallas/expediente/adicionar_expediente.php?cod_padre='.@$_REQUEST["idexpediente"].'&div_actualiza=resultado_busqueda'.$_REQUEST["idbusqueda_componente"].'&target_actualiza=parent&idbusqueda_componente='.$_REQUEST["idbusqueda_componente"].'&cod_padre='.$_REQUEST["idexpediente"].'&estado_archivo='.@$_REQUEST["variable_busqueda"].'&fk_idcaja='.$_REQUEST["idcaja"].'">Adicionar Expediente</button>                                            
	  </div>
	</li>';
	}
	if($ok2){
		$cadena.='<li class="divider-vertical"></li>                          
		<li>
		 <div class="btn-group">                    
		    <button class="btn btn-mini" id="transferencia_documental" titulo="Transferencia documental">Transferencia documental</button>                                            
		  </div>    
		</li>
		<script>
		$("#transferencia_documental").click(function(){
			var seleccionados=$("#seleccionados_expediente").val();
			if(seleccionados){
				enlace_katien_saia("formatos/transferencia_doc/adicionar_transferencia_doc.php?id="+seleccionados,"Transferencia documental","iframe","");
			}
			else{
				alert("Seleccione por lo menos un expediente");
			}
		});
		</script>';
	}
		
	return($cadena);
}
function listado_expedientes_documento($iddocumento){
$expedientes=busca_filtro_tabla("","expediente A, expediente_doc B","A.idexpediente=B.expediente_idexpediente AND B.documento_iddocumento=".$iddocumento,"",$conn);
if($expedientes["numcampos"]){
  $texto='<ul>';
  for($i=0;$i<$expedientes["numcampos"];$i++){
    $texto.='<li>'.$expedientes[$i]["nombre"].'</li>';
  } 
  $texto.='</ul>';
}
else{
  $texto='No existen expedientes vinculados con el documento';
}
return($texto);
}
function verificar_expediente($nombre,$padre){
global $conn,$usu; 
$exp=busca_filtro_tabla("idexpediente","expediente","lower(nombre) like lower('".$nombre."') and cod_padre='".$padre."'","",$conn);
if($nombre=='PROCESO RECLAMOS'){

}
if(!$exp["numcampos"]){
  $sql2="insert into expediente(nombre,fecha,cod_padre) values('".$nombre."',".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",'".$padre."')";   
  echo($sql2."<br />");
  $llave=ejecuta_sql($sql2);
  if($llave)  
    return($llave);
  else{
    return(0);
  }  
}
return($exp[0][0]);  
}
function vincular_documento_expediente($idexp,$iddoc){
global $conn;
$existe=busca_filtro_tabla("","expediente_doc","expediente_idexpediente=".$idexp." and documento_iddocumento=".$iddoc,"",$conn);
if(!$existe['numcampos']){
  $sql2="insert into expediente_doc(expediente_idexpediente,documento_iddocumento) values('".$idexp."','".$iddoc."')"; 
  phpmkr_query($sql2);
}
} 
function asignar_expediente($idexp, $tipo_entidad, $llave_entidad, $permiso="", $indice=1){
	global $conn;
	$indice++;
	if($indice>100)return false;
	$busqueda=busca_filtro_tabla("","entidad_expediente a","entidad_identidad=".$tipo_entidad." and llave_entidad=".$llave_entidad." and expediente_idexpediente=".$idexp,"",$conn);
	if(!$busqueda["numcampos"]){
		$sql1="insert into entidad_expediente(entidad_identidad, expediente_idexpediente, llave_entidad, estado, permiso, fecha)values(".$tipo_entidad.",".$idexp.",".$llave_entidad.",'1', '".$permiso."', ".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').")";
	}
	else{
		$sql1="update entidad_expediente set entidad_identidad=".$tipo_entidad.", expediente_idexpediente=".$idexp.", llave_entidad=".$llave_entidad.", permiso='".$permiso."' where identidad_expediente=".$busqueda[0]["identidad_expediente"];
	}
	phpmkr_query($sql1);
	$padre=busca_filtro_tabla("","expediente a","a.idexpediente=".$idexp,"",$conn);
	if($padre[0]["cod_padre"]!=''&&$padre[0]["cod_padre"]!=0){
		return(asignar_expediente($padre[0]["cod_padre"], $tipo_entidad, $llave_entidad, $permiso="", $indice));
	}
	else return true;
}
function insertar_expediente_automatico($idserie,$hijo="",$indice=1){
	$indice++;
	if($indice>100)return false;
	$serie=busca_filtro_tabla("","serie a","a.idserie=".$idserie,"",$conn);
	
	if($serie["numcampos"]){
		$busqueda=busca_filtro_tabla("","expediente a","a.serie_idserie=".$serie[0]["idserie"],"",$conn);
		if(!$busqueda["numcampos"]){
			$value_agrupador="0";
			if(intval($serie[0]['tipo_expediente'])==2){
				$value_agrupador="1";
			}
			$sql1="insert into expediente(nombre, fecha, serie_idserie,agrupador)values('".$serie[0]["nombre"]."', ".fecha_db_almacenar(date('Y-m-d'),'Y-m-d').", '".$serie[0]["idserie"]."',".$value_agrupador.")";
			phpmkr_query($sql1);
			$id=phpmkr_insert_id();
		}
		else{
			$sql1="update expediente set nombre='".$serie[0]["nombre"]."' where idexpediente=".$busqueda[0]["idexpediente"];
			phpmkr_query($sql1);
			$id=$busqueda[0]["idexpediente"];
		}
		if($hijo){
			$sql2="update expediente set cod_padre='".$id."' where idexpediente=".$hijo;
			phpmkr_query($sql2);
		}
		if($serie[0]["cod_padre"]!=0&&$serie[0]["cod_padre"]!=''){
			insertar_expediente_automatico($serie[0]["cod_padre"],$id,$indice);
		}
		else return true;
	}
	else if($serie[0]["cod_padre"]!=0&&$serie[0]["cod_padre"]!=''){
		insertar_expediente_automatico($serie[0]["cod_padre"],"",$indice);
	}
	else return true;
}
function actualizar_codigo_arbol($idserie){
	$idexpediente=busca_filtro_tabla("","expediente A","A.serie_idserie=".$idserie,"",$conn);
	if($idexpediente["numcampos"]){
		if(!$idexpediente[0]["cod_arbol"]){
			$codigo="";
			$padre=busca_filtro_tabla("cod_arbol","expediente A","A.idexpediente=".$idexpediente[0]["cod_padre"],"",$conn);
			if($padre["numcampos"]){
				$codigo.=$padre[0]["cod_arbol"].".";
			}
			$codigo.=$idexpediente[0]["idexpediente"];
			$sql1="update expediente set cod_arbol='".$codigo."' WHERE idexpediente=".$idexpediente[0]["idexpediente"];
			phpmkr_query($sql1);
		}
	}
}
function usuario_actual_codigo(){
	return usuario_actual('idfuncionario');
}
function dependencia_actual_codigos(){
	global $dependencia;
	$dependencias=busca_filtro_tabla("dependencia_iddependencia","dependencia_cargo a","a.estado='1' and funcionario_idfuncionario=".usuario_actual('idfuncionario'),"",$conn);
	$dependencia=extrae_campo($dependencias,"dependencia_iddependencia");
	return implode(",",$dependencia);
}
function cargo_actual_codigos(){
	global $dependencia;
	$cargos=busca_filtro_tabla("cargo_idcargo","dependencia_cargo a","a.estado='1' and funcionario_idfuncionario=".usuario_actual('idfuncionario'),"",$conn);
	$cargo=extrae_campo($cargos,"cargo_idcargo");
	return implode(",",$cargo);
}
//Se encarga de generar el where de la consulta de los expedientes segun la serie.
function filtro_where_expediente_serie(){
	global $conn;
	$datos=@$_REQUEST["variable_busqueda"];
	$where="";
	if($datos){
		$dato=explode("/**/",$datos);
		//$where=" cod_padre='".$dato[1]."' and (serie_idserie is null or serie_idserie='') ";
		$where=" cod_padre='".$dato[1]."' ";
	}
	return($where);
}
//Etiqueta sin enlace del listado sobre los expedientes segun la serie
function enlace_expediente2($idexpediente,$nombre){
	return("<div style='' class='link' onclick=window.open('consulta_busqueda_expediente_serie.php?idbusqueda_componente=".$_REQUEST["idbusqueda_componente"]."&variable_busqueda=idexpediente/**/".$idexpediente."','_self'); titulo='".$nombre."'><b>".$nombre."</b></div>");
}
//Muestra la descripción del listado de documentos
function obtener_descripcion_expediente($descripcion){
	return($descripcion);
}

function mostrar_contador_expediente($idexpediente,$cod_arbol){
	global $conn, $dependencia,$arreglo;
	$expedientes=arreglo_expedientes_asignados();
	$arreglo=array();
	obtener_expedientes_padre($idexpediente,$expedientes);
	$arreglo=array_merge($arreglo,array($idexpediente));
	//return(implode(",",$arreglo));
	$documentos=busca_filtro_tabla("count(*) as cantidad","expediente_doc A, documento B","A.expediente_idexpediente in(".implode(",",$arreglo).") AND A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO','ANULADO')","",$conn);
	//return($cantidad["sql"]);
	
	if(!$documentos["numcampos"])$documentos[0]["cantidad"]=0;
	
	return("<span class='pull-right badge' style='margin-top:3px' id='contador_docs_".$idexpediente."'>".$documentos[0]["cantidad"]."</span>");
}
 
/*
function mostrar_contador_expediente($idexpediente,$cod_arbol){
	
	
	global $conn, $dependencia,$arreglo;
	$_REQUEST["idbusqueda_componente"]=110;
	$expedientes=expedientes_asignados();
	$_REQUEST['idexpediente']=$idexpediente;
	$request_exp_padre=request_expediente_padre();
	
	$arreglo=array();
	//obtener_expedientes_padre($idexpediente,$expedientes);
	
	//$texto.=" AND a.idexpediente=".$_REQUEST["expediente_actual"];
	
	$arreglo=array_merge($arreglo,array($idexpediente));
	//return(implode(",",$arreglo));
	$documentos=busca_filtro_tabla("a.idexpediente","vexpediente_serie a","a.estado_archivo=1 and ".$expedientes." and (".$request_exp_padre.")  ","group by a.fecha,a.nombre,a.descripcion,a.cod_arbol,a.idexpediente",$conn);
	
	$documentos_expediente=busca_filtro_tabla("count(*) as cantidad","expediente_doc","expediente_idexpediente IN(".implode(',',extrae_campo($documentos,'idexpediente')).")","",$conn);
	
	if(!$documentos_expediente['numcampos']){
		$documentos=busca_filtro_tabla("count(*) as cantidad","expediente_doc A, documento B","A.expediente_idexpediente in(".implode(",",$arreglo).") AND A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO')","",$conn);
	}
	
	//print_r($documentos);die();
	
	//print_r($documentos);
	//$documentos=busca_filtro_tabla("count(*) as cantidad","vexpediente_serie a,documento b,expediente_doc c ","a.idexpediente=c.expediente_idexpediente and b.iddocumento=c.documento_iddocumento and b.estado<>'eliminado' and b.estado<>'anulado' and c.expediente_idexpediente=".$idexpediente,"",$conn);
	
	
	//return($cantidad["sql"]);
	
	if(!$documentos["numcampos"])$documentos[0]["cantidad"]=0;
	//return("<span class='pull-right badge' style='margin-top:3px' id='contador_docs_".$idexpediente."'>".$documentos[0]["cantidad"]."</span>");
	return("<span class='pull-right badge' style='margin-top:3px' id='contador_docs_".$idexpediente."'>".$documentos["numcampos"]."</span>");
}

*/
function obtener_expedientes_padre($idexpediente,$expedientes){
	global $arreglo;
	$expediente=busca_filtro_tabla("","expediente A","A.cod_padre=".$idexpediente." AND A.estado_archivo=".$_REQUEST['variable_busqueda'],"",$conn);
	if($expediente["numcampos"]){
		for($i=0;$i<$expediente["numcampos"];$i++){
			if(in_array($expediente[$i]["idexpediente"],$expedientes)){
				array_push($arreglo,$expediente[$i]["idexpediente"]);
				$hijos=busca_filtro_tabla("","expediente A","A.cod_padre=".$expediente[$i]["idexpediente"]." AND A.estado_archivo=".$_REQUEST['variable_busqueda'],"",$conn);
				if($hijos["numcampos"]){
					obtener_expedientes_padre($expediente[$i]["idexpediente"],$expedientes);
				}
			}
			else continue; 
		}
	}
	return(true);
}

function eliminar_permiso_expediente($idexpediente,$tipo_entidad,$entidad){
	$sql1="DELETE from entidad_expediente where expediente_idexpediente='$idexpediente' and entidad_identidad='$tipo_entidad' and llave_entidad='$entidad'";
	phpmkr_query($sql1);
}
function negar_expediente($idexp, $tipo_entidad, $llave_entidad, $permiso="", $indice=1){
	global $conn;
	$indice++;
	if($indice>100)return false;
	$busqueda=busca_filtro_tabla("","entidad_expediente a","entidad_identidad=".$tipo_entidad." and llave_entidad=".$llave_entidad." and expediente_idexpediente=".$idexp." and estado='2'","",$conn);
	if(!$busqueda["numcampos"]){
		$sql1="insert into entidad_expediente(entidad_identidad, expediente_idexpediente, llave_entidad, estado, permiso, fecha)values(".$tipo_entidad.",".$idexp.",".$llave_entidad.",'2', '".$permiso."', ".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').")";
	}
	else{
		$sql1="update entidad_expediente set entidad_identidad=".$tipo_entidad.", expediente_idexpediente=".$idexp.", llave_entidad=".$llave_entidad.", permiso='".$permiso."', estado='2' where identidad_expediente=".$busqueda[0]["identidad_expediente"];
	}
	phpmkr_query($sql1);
}
/*
function enlaces_adicionales_expediente($idexpediente,$nombr,$estado_cierre){
	global $conn;
	$texto="";
	$permiso=new Permiso();
	$ok1=$permiso->acceso_modulo_perfil("eliminar_expediente");
	$ok2=$permiso->acceso_modulo_perfil("editar_expediente");
	$ok3=$permiso->acceso_modulo_perfil("asignar_expediente");
	
	if($ok1){
		$texto.='<div class=\'btn btn-mini eliminar_expediente tooltip_saia pull-right\' idregistro=\''.$idexpediente.'\' title=\'Eliminar '.$nombre.'\'><i class=\'icon-remove\'></i></div>';
	}
	
	if($ok2){
		$texto.='<div class=\'btn btn-mini enlace_expediente tooltip_saia pull-right\' idregistro=\''.$idexpediente.'\' title=\'Editar '.$nombre.'\' enlace=\'pantallas/expediente/editar_expediente.php?idexpediente='.$idexpediente.'\'><i class=\'icon-pencil\'></i></div>';
	}

	$texto.='<div class=\'btn btn-mini link kenlace_saia tooltip_saia pull-right\' title=\'Imprimir rotulo\' titulo=\'Imprimir rotulo\' enlace=\'pantallas/caja/rotulo.php?idexpediente='.$idexpediente.'\' conector=\'iframe\'><i class=\'icon-print\'></i></div>';
	
	$disabled_seleccionar="";
	$titulo='Seleccionar';
	if($estado_cierre==1){
	    $disabled_seleccionar='style="pointer-events:none;"';
	    $titulo='No es posible seleccionar hasta que no este cerrado el expediente';
	}
	
	$texto.='<div id="seleccionados_expediente_'.$idexpediente.'" idregistro=\''.$idexpediente.'\' titulo=\''.$titulo.'\' class=\'btn btn-mini tooltip_saia adicionar_seleccionados_expediente pull-right\' '.$disabled_seleccionar.'><i class=\'icon-uncheck\' ></i></div>';
	
	if($ok3){
		$texto.='<div class=\'btn btn-mini enlace_expediente tooltip_saia pull-right\' idregistro=\''.$idexpediente.'\' title=\'Asignar '.$nombre.'\' enlace=\'pantallas/expediente/asignar_expediente.php?idexpediente='.$idexpediente.'\'><i class=\'icon-lock\'></i></div>';
	}
	
	
	$texto.='<div class=\'btn btn-mini crear_tomo_expediente tooltip_saia pull-right\' idregistro=\''.$idexpediente.'\' title=\'Crear Tomo '.$nombre.'\'><i class=\'icon-folder-open\'></i></div>';
	
	return($texto);
}*/
function enlaces_adicionales_expediente($idexpediente, $nombre,$estado_cierre,$propietario) {
	global $conn;
	$m = 0;
	$e = 0;
	$p = 0;
	
	if ($propietario == $_SESSION["usuario_actual"]) {
		$m = 1;
		$e = 1;
		$p = 1;
	} else {
		$permiso = busca_filtro_tabla("permiso", "entidad_expediente", "entidad_identidad=1 and estado=1 and llave_entidad=" . usuario_actual("idfuncionario"), "", $conn);
		if ($permiso["numcampos"] && $permiso[0]["permiso"] != "") {
			if (strpos($permiso[0]["permiso"], "m") !== false) {
				$m = 1;
			}
			if (strpos($permiso[0]["permiso"], "e") !== false) {
				$e = 1;
			}
			if (strpos($permiso[0]["permiso"], "p") !== false) {
				$p = 1;
			}
		}
	}



	$texto = "";
	if ($e) {
		$texto.='<div class=\'btn btn-mini eliminar_expediente tooltip_saia pull-right\' idregistro=\''.$idexpediente.'\' title=\'Eliminar '.$nombre.'\'><i class=\'icon-remove\'></i></div>';
	}
	if ($m) {
		$texto.='<div class=\'btn btn-mini enlace_expediente tooltip_saia pull-right\' idregistro=\''.$idexpediente.'\' title=\'Editar '.$nombre.'\' enlace=\'pantallas/expediente/editar_expediente.php?idexpediente='.$idexpediente.'\'><i class=\'icon-pencil\'></i></div>';
	}
	$texto.='<div class=\'btn btn-mini link kenlace_saia tooltip_saia pull-right\' title=\'Imprimir rotulo\' titulo=\'Imprimir rotulo\' enlace=\'pantallas/caja/rotulo.php?idexpediente='.$idexpediente.'\' conector=\'iframe\'><i class=\'icon-print\'></i></div>';
	if ($p) {
		$texto.='<div class=\'btn btn-mini enlace_expediente tooltip_saia pull-right\' idregistro=\''.$idexpediente.'\' title=\'Asignar '.$nombre.'\' enlace=\'pantallas/expediente/asignar_expediente.php?idexpediente='.$idexpediente.'\'><i class=\'icon-lock\'></i></div>';
	}
	
	if($propietario == $_SESSION["usuario_actual"]){
	    $texto.='<div class=\'btn btn-mini crear_tomo_expediente tooltip_saia pull-right\' idregistro=\''.$idexpediente.'\' title=\'Crear Tomo '.$nombre.'\'><i class=\'icon-folder-open\'></i></div>';	
	}

	$mostrar_seleccionar='';
	if($estado_cierre==1){
	    $mostrar_seleccionar='style="display:none;"';
	}	
	$texto.='<div id="seleccionados_expediente_'.$idexpediente.'" idregistro=\''.$idexpediente.'\' titulo=\'Seleccionar\' class=\'btn btn-mini tooltip_saia adicionar_seleccionados_expediente pull-right\' '.$mostrar_seleccionar.'><i class=\'icon-uncheck\' ></i></div>';	
	

	return ($texto);
}

function valida_from_caja(){
    
    if(@$_REQUEST['variable_busqueda']!='from_caja'){
        return('a.estado_archivo=1 and');
    }
  
}

function expedientes_asignados(){
	global $conn;
	
	if(@$_REQUEST["idbusqueda_componente"]){
		$busqueda_componente=busca_filtro_tabla("","busqueda_componente A","A.nombre='expediente_admin' AND A.idbusqueda_componente=".$_REQUEST["idbusqueda_componente"],"",$conn);
		if($busqueda_componente["numcampos"]){
			return("1=1");
		}
	}
	
	$roles=busca_filtro_tabla("","dependencia_cargo a","a.estado='1' and a.funcionario_idfuncionario=".usuario_actual('idfuncionario'),"",$conn);
	$dependencias=extrae_campo($roles,"dependencia_iddependencia");
	$cargos=extrae_campo($roles,"cargo_idcargo");
	
	$cadena.="";
	$cadena.="(((a.identidad_exp=1 AND a.llave_exp='".usuario_actual("idfuncionario")."') or (a.identidad_exp=2 AND a.llave_exp in ('".implode("','",$dependencias)."')) or (a.identidad_exp=4 AND a.llave_exp in('".implode("','",$cargos)."'))) or ((a.identidad_ser=1 AND a.llave_ser='".usuario_actual("idfuncionario")."') or (a.identidad_ser=2 AND a.llave_ser in ('".implode("','",$dependencias)."')) or (a.identidad_ser=4 AND a.llave_ser in('".implode("','",$cargos)."')) and a.estado_entidad_serie not in(2)))";
	
	//$cadena.=" and a.idexpediente not in(select idexpediente from vexpediente_serie b where ((b.identidad_ser=1 AND b.llave_ser='".usuario_actual("idfuncionario")."') or (b.identidad_ser=2 AND b.llave_ser in ('".implode("','",$dependencias)."')) or (b.identidad_ser=4 AND b.llave_ser in('".implode("','",$cargos)."'))) and (b.estado_entidad_serie =2))";
	
	return($cadena);
}
function expedientes_asignados2(){
	$arreglo=arreglo_expedientes_asignados();
	if(count($arreglo)){
		$texto=implode(",",$arreglo);
	}
	else{
		$texto="''";
	}
	$cadena="a.idexpediente in(".$texto.")";
	return($cadena);
}
function arreglo_expedientes_asignados(){
	global $conn;
	$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
	include_once($ruta_db_superior."db.php");
	
	if(@$_REQUEST["idbusqueda_componente"]){
		$busqueda_componente=busca_filtro_tabla("","busqueda_componente A","A.nombre='expediente_admin' AND A.idbusqueda_componente=".$_REQUEST["idbusqueda_componente"],"",$conn);
		if($busqueda_componente["numcampos"]){
			$expedientes=busca_filtro_tabla("","expediente A","","",$conn);
			$expediente=extrae_campo($expedientes,"idexpediente");
			return($expediente);
		}
	}
	
	$roles=busca_filtro_tabla("","dependencia_cargo a","a.estado='1' and a.funcionario_idfuncionario=".usuario_actual('idfuncionario'),"",$conn);
	$dependencias=extrae_campo($roles,"dependencia_iddependencia");
	$cargos=extrae_campo($roles,"cargo_idcargo");
	
	$asignacion_expediente=busca_filtro_tabla("A.expediente_idexpediente","entidad_expediente A","A.estado=1 AND((entidad_identidad=1 AND llave_entidad='".usuario_actual("idfuncionario")."') or (entidad_identidad=2 AND llave_entidad in ('".implode("','",$dependencias)."')) or (entidad_identidad=4 AND llave_entidad in('".implode("','",$cargos)."')))","",$conn);
	
	$where_estado_archivo=" AND estado_archivo=".$_REQUEST['variable_busqueda'];
	
	$expedientes_serie=busca_filtro_tabla("A.idexpediente","expediente A, serie B, entidad_serie C","A.serie_idserie=B.idserie AND B.idserie=C.serie_idserie AND B.estado=1 AND ((C.entidad_identidad=1 AND C.llave_entidad='".usuario_actual("idfuncionario")."') or (C.entidad_identidad=2 AND C.llave_entidad in ('".implode("','",$dependencias)."')) or (C.entidad_identidad=4 AND C.llave_entidad in('".implode("','",$cargos)."')))".$where_estado_archivo,"",$conn);
	$array_expedientes_serie=extrae_campo($expedientes_serie,"idexpediente");
	
	$expedientes_serie_negado=busca_filtro_tabla("A.idexpediente","expediente A, serie B, entidad_serie C","A.serie_idserie=B.idserie AND B.idserie=C.serie_idserie AND B.estado=1 AND C.estado=2 AND ((C.entidad_identidad=1 AND C.llave_entidad='".usuario_actual("idfuncionario")."') or (C.entidad_identidad=2 AND C.llave_entidad in ('".implode("','",$dependencias)."')) or (C.entidad_identidad=4 AND C.llave_entidad in('".implode("','",$cargos)."')))".$where_estado_archivo,"",$conn);
	$array_expedientes_serie_negado=extrae_campo($expedientes_serie_negado,"idexpediente");
	
	$series_asignadas=array_diff($array_expedientes_serie,$array_expedientes_serie_negado);
	
	$lista=extrae_campo($asignacion_expediente,"expediente_idexpediente");
	$lista=array_merge($lista,$series_asignadas);
	return($lista);
}
function barra_inferior_documento_expediente($iddoc,$numero,$idexpediente){
$dato_prioridad=busca_filtro_tabla("","prioridad_documento","documento_iddocumento=".$iddoc,"fecha_asignacion DESC",$conn);

$prioridad="icon-flag";
if($dato_prioridad["numcampos"]){
  switch ($dato_prioridad[0]["prioridad"]) {  	
    case 1:
      $prioridad='icon-flag-rojo';
    break;
    case 2:
      $prioridad='icon-flag-morado';
	  break;
    case 3:
      $prioridad='icon-flag-naranja';
	  break;   
    case 4:
      $prioridad='icon-flag-amarillo';
	  break;      
    case 5:
      $prioridad='icon-flag-verde';
	  break;   
    default:
      $prioridad='icon-flag';
    break;
  }
}
$texto.='<div class="btn-group pull" >
  <button type="button" class="btn btn-mini detalle_documento_saia tooltip_saia" enlace="ordenar.php?accion=mostrar&mostrar_formato=1&key='.$iddoc.'" title="No.'.$numero.'" idregistro="'.$iddoc.'" id="expediente_'.$iddoc.'"><i class="icon-info-sign"></i></button>
  <button type="button" class="btn btn-mini dropdown-toggle tooltip_saia" data-toggle="dropdown" title="Prioridad">
    <i class="'.$prioridad.'" id="prioridad_'.$iddoc.'" prioridad="'.$prioridad.'"></i><span class="caret"></span>
  </button> 
    <ul class="dropdown-menu">
      <li><a href="#" idregistro="'.$iddoc.'" class="documento_prioridad" prioridad="1"><i class="icon-flag-rojo"></i> Rojo</a></li>
      <li><a href="#" idregistro="'.$iddoc.'" class="documento_prioridad" prioridad="2"><i class="icon-flag-morado"></i> Morado</a></li>
      <li><a href="#" idregistro="'.$iddoc.'" class="documento_prioridad" prioridad="3"><i class="icon-flag-naranja"></i> Naranja</a></li>
      <li><a href="#" idregistro="'.$iddoc.'" class="documento_prioridad" prioridad="4"><i class="icon-flag-amarillo"></i> Amarillo</a></li>
      <li><a href="#" idregistro="'.$iddoc.'" class="documento_prioridad" prioridad="5"><i class="icon-flag-verde"></i> Verde</a></li>
      <li><a href="#" idregistro="'.$iddoc.'" class="documento_prioridad" prioridad="0"><i class="icon-flag"></i>Sin indicador</a></li>
    </ul>';
		$permiso=new Permiso();
		$ok1=$permiso->acceso_modulo_perfil('eliminar_documento_expediente');
		if($ok1){
			$texto.='<button type="button" id="sacar_expediente" class="btn btn-mini tooltip_saia sacar_expediente" iddocumento="'.$iddoc.'" idexpediente="'.$idexpediente.'" title="Sacar de este expediente">
    <i class="icon-remove"></i>
    </button>';
    }
$texto.='</div>';
//$texto.=barra_estandar_documento($iddoc,$funcionario);
return($texto);
}



//VALIDACION BLOQUEO DOCUMENTOS
function origen_documento_expediente($doc,$numero,$origen="",$tipo_radicado="",$estado="",$serie="",$tipo_ejecutor=""){
    $enlace=origen_documento($doc,$numero,$origen,$tipo_radicado,$estado,$serie,$tipo_ejecutor);
    
    //SE VALIDA SI EL USUARIO ESTA INVOLUCRADO CON EL DOCUMENTO (TRANSFERENCIA,RUTA) 
    $involucrado=validar_relacion_documento_expediente($doc);
    if(!$involucrado['numcampos']){
        $enlace=preg_replace("/class=[\"\'][^\'\"]*kenlace_saia[^\'\"]*[\"\']/","class='link pull-left enlace_documento_bloqueado' iddoc=".$doc,$enlace,1);
    }        
    return ($enlace);
}
function fecha_creacion_documento_expediente($fecha0,$plantilla=Null,$doc=Null){
    $enlace=fecha_creacion_documento($fecha0,$plantilla,$doc);

    //SE VALIDA SI EL USUARIO ESTA INVOLUCRADO CON EL DOCUMENTO (TRANSFERENCIA,RUTA) 
    $involucrado=validar_relacion_documento_expediente($doc);  
    if(!$involucrado['numcampos']){
       $enlace=preg_replace("/class=[\"\'][^\'\"]*kenlace_saia[^\'\"]*[\"\']/","class='link enlace_documento_bloqueado' iddoc=".$doc,$enlace,1);
    } 
    
    return($enlace);
}
function validar_relacion_documento_expediente($doc){
    global $conn;
    $funcionario_codigo=usuario_actual('funcionario_codigo');
    $estados_validar=array("'borrador'","'transferido'","'revisado'","'aprobado'");
    
    $consulta=busca_filtro_tabla("archivo_idarchivo","buzon_salida","archivo_idarchivo=".$doc." AND tipo_destino=1 AND lower(nombre) IN(".implode(',',$estados_validar).") AND destino=".$funcionario_codigo,"",$conn);
    return($consulta);
}
?>
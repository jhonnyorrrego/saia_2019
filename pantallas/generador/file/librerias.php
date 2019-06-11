<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once $ruta_db_superior . 'core/autoload.php';
function sincronizar_anexos_temporales($idregistro,$pantalla){
	global $ruta_db_superior;
	$retorno_temp=new stdClass;
  $retorno_temp->exito=0;
	$retorno_temp->operador_exito=2;
	$h=0;
	$k=0;
	if(!$idregistro){
		if(@$_REQUEST["documento_iddocumento"]){
			$iddocumento=$_REQUEST["documento_iddocumento"];
		}
		if(@$_REQUEST["fk_iddocumento"]){
			$iddocumento=$_REQUEST["fk_iddocumento"];
		}
		$datos_pantalla=busca_filtro_tabla("","documento a, pantalla b","a.pantalla_idpantalla=b.idpantalla and a.iddocumento=".$iddocumento,"",$conn);
		$registro=busca_filtro_tabla("id".$datos_pantalla[0]["nombre"]." as idregistro",$datos_pantalla[0]["nombre"]." a","a.documento_iddocumento=".$iddocumento,"",$conn);
		$idregistro=$registro[0]["idregistro"];
	}
	//TODO: Verificar que las pantallas tengan la clase documento para verificar los almacenamientos de estado, y demás que involucran sólo al documento
	$idpantalla=busca_filtro_tabla("a.idpantalla, b.idpantalla_campos, b.nombre, a.tipo_pantalla, a.ruta_almacenamiento, a.nombre AS nombre_pantalla","pantalla a, pantalla_campos b","a.idpantalla=b.pantalla_idpantalla and a.nombre='".$pantalla."' and etiqueta_html='file'","",$conn);
	$retorno_temp->mensaje="Error al almacenar los anexos del ".$idpantalla[0]["etiqueta"];
	$ids_guardados=busca_filtro_tabla("",$pantalla,"id".$pantalla."=".$idregistro,"",$conn);
	if($idpantalla["numcampos"]){
		$ruta=ruta_archivos_pantalla($idregistro,$idpantalla);
		crear_destino($ruta_db_superior.$ruta);
		for($i=0;$i<$idpantalla["numcampos"];$i++){
			$anexos=busca_filtro_tabla("ruta, etiqueta, tipo, idanexos_temp_pantalla","anexos_temp_pantalla a","idsesion='".session_id()."' and pantalla_idpantalla=".$idpantalla[$i]["idpantalla"]." and fk_idpantalla_campos=".$idpantalla[$i]["idpantalla_campos"],"",$conn);
			for($j=0;$j<$anexos["numcampos"];$j++){
				$h++;					
				$idanexo=sincronizar_anexo($idpantalla[$i],$anexos[$j]["ruta"],$anexos[$j]["etiqueta"],$anexos[$j]["tipo"],$ruta,$idregistro,$pantalla,$anexos[$j]["idanexos_temp_pantalla"]);
				if($idanexo){
					$k++;
				}
			}
		}
	}
	if($h==$k && $h!=0){
		$retorno_temp->exito=1;
		$retorno_temp->mensaje="<br>Anexos almacenados";	
	}
	else if($h==0){
		$retorno_temp->exito=1;
		$retorno_temp->mensaje="";	
	}
	else{
		$retorno_temp->mensaje="Algunos anexos presentaron problemas al realizar la carga por favor verifique y si el problema persiste comuniquese con su administrador";
	}
	return($retorno_temp);
}
function sincronizar_anexo($nombre_campo,$ruta_origen,$etiqueta,$type,$ruta,$id,$pantalla,$id_eliminar){
	global $ruta_db_superior;
	$nombre=(rand());
	$idanexo=0; 
	if(is_file($ruta_db_superior.$ruta_origen)){                     
		if(rename($ruta_db_superior.$ruta_origen,$ruta_db_superior.$ruta.$nombre.".".$type)){
			$campo_adicional="";
			$valor_adicional="";
			if(@$_REQUEST["documento_iddocumento"]){
				$campo_adicional.=",documento_iddocumento";
				$valor_adicional.=",'".$_REQUEST["documento_iddocumento"]."'";
			}
			if(@$_REQUEST["fk_iddocumento"]){
				$campo_adicional.=",documento_iddocumento";
				$valor_adicional.=",'".$_REQUEST["fk_iddocumento"]."'";
			}
			if(@$_REQUEST["descripcion"]){
				$campo_adicional.=",descripcion";
				$valor_adicional.=",'".$_REQUEST["descripcion"]."'";
			}
			
			$sql="INSERT INTO anexos(fecha,funcionario_idfuncionario,ruta,etiqueta,tipo,aleatorio".$campo_adicional.") values(".fecha_db_almacenar(date('Y-m-d h:i:s'),"Y-m-d h:i:s").",".usuario_actual('idfuncionario').",'".$ruta.$nombre.'.'.$type."','".$etiqueta."','".$type."','".$nombre."'".$valor_adicional.")";  				
			phpmkr_query($sql);	
			$idanexo=phpmkr_insert_id();
			$sql_permiso="INSERT INTO permiso_anexo(anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_dependencia, caracteristica_cargo, caracteristica_total) VALUE(".$idanexo.",'".usuario_actual("idfuncionario")."','lem','','','l')";
			phpmkr_query($sql_permiso,$conn);
			
			if($nombre_campo["tipo_pantalla"]==1||$nombre_campo["tipo_pantalla"]==2){
				$ids_guardados=busca_filtro_tabla("",$pantalla,"id".$pantalla."=".$id,"",$conn);
				if($ids_guardados[0][$nombre_campo["nombre"]]!='')$valores=$ids_guardados[0][$nombre_campo["nombre"]].",".$idanexo;
				else $valores=$idanexo;
				$sql3="update ".$pantalla." set ".$nombre_campo["nombre"]."='".$valores."' where id".$pantalla."=".$id;
				phpmkr_query($sql3);
				$sql4="delete from anexos_temp_pantalla where idanexos_temp_pantalla=".$id_eliminar;
				phpmkr_query($sql4);
			}
		}
	}
return($idanexo);
}
function ruta_archivos_pantalla($id='',$pantalla=''){
	if($pantalla["numcampos"]){
		$almacenamiento=$pantalla[0]["ruta_almacenamiento"];
	}
	else{
		$almacenamiento='{*fecha_ano*}/{*fecha_mes*}/{*idpantalla*}/';
	}
	if($id){
		$almacenamiento=str_replace('{*fecha_ano*}',date("Y"),$almacenamiento);
		$almacenamiento=str_replace('{*fecha_mes*}',date("m"),$almacenamiento);
		//id del registro de la pantalla 
		$almacenamiento=str_replace('{*idpantalla*}',$id,$almacenamiento);
		//nombre del campo 
		$almacenamiento=str_replace('{*nombre*}',$pantalla[0]["nombre"],$almacenamiento);
		//nombre de la pantalla
		$almacenamiento=str_replace('{*nombre_pantalla*}',$pantalla[0]["nombre_pantalla"],$almacenamiento);
		//Hacer los updates requeridos para que todas las pantallas se actualicen como deben quedar es decir algo como: pantallas/{fecha_ano}/{fecha_mes}/{*nombre_pantalla*}/{*idpantalla*}/anexos  para la pantalla con las paginas digitalizadas debe quedar pantallas/{fecha_ano}/{fecha_mes}/{*nombre_pantalla*}/{*idpantalla*}/paginas   
		$ruta=RUTA_ARCHIVOS.$almacenamiento;
	}
	else
		$ruta="temporal_".usuario_actual('login')."/";
	return $ruta;
}
function validar_anexos_subidos(){
	echo "var exitoso=validar_anexos_subidos();
	if(!exitoso)return false;
	";
}
function vincular_funcion(){
	global $conn;
	$archivo=busca_filtro_tabla("","pantalla_libreria a","ruta='pantallas/generador/file/librerias.php'","",$conn);
	if($archivo["numcampos"]){
		$idarchivo=$archivo[0]["idpantalla_libreria"];
	}
	else{
		$sql1="insert into pantalla_libreria(ruta, funcionario_idfuncionario, fecha, tipo_archivo)values('pantallas/generador/file/librerias.php', '".usuario_actual('idfuncionario')."', ".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').", 'php')";
		phpmkr_query($sql1);
		$idarchivo=phpmkr_insert_id();
	}
	//--funcion validar_anexos_subidos
	$funcion_validacion=busca_filtro_tabla("","pantalla_funcion a","a.nombre='validar_anexos_subidos' and fk_idpantalla_libreria='".$idarchivo."'","",$conn);
	if($funcion_validacion["numcampos"]){
		$idfuncion=$funcion_validacion[0]["idpantalla_funcion"];
	}
	else{
		$sql2="insert into pantalla_funcion(nombre, fk_idpantalla_libreria, tipo_funcion)values('validar_anexos_subidos', '".$idarchivo."', 'php')";
		phpmkr_query($sql2);
		$idfuncion=phpmkr_insert_id();
	}
	//--funcion sincronizar_anexos_temporales
	$funcion_validacion2=busca_filtro_tabla("","pantalla_funcion a","a.nombre='sincronizar_anexos_temporales' and fk_idpantalla_libreria='".$idarchivo."'","",$conn);
	if($funcion_validacion2["numcampos"]){
		$idfuncion2=$funcion_validacion2[0]["idpantalla_funcion"];
	}
	else{
		$sql2="insert into pantalla_funcion(nombre, fk_idpantalla_libreria, tipo_funcion)values('sincronizar_anexos_temporales', '".$idarchivo."', 'php')";
		phpmkr_query($sql2);
		$idfuncion2=phpmkr_insert_id();
	}
	
	//--function_exe validar_anexos_subidos
	$buscar_funcion_exe=busca_filtro_tabla("","pantalla_funcion_exe a","pantalla_idpantalla=".$_REQUEST["idpantalla"]." and accion='enviar' and fk_idpantalla_funcion='".$idfuncion."' and momento='1'","",$conn);
	if($buscar_funcion_exe["numcampos"]){
		$idfuncion_exe=$buscar_funcion_exe[0]["idpantalla_funcion_exe"];
	}
	else{
		$sql3="insert into pantalla_funcion_exe(pantalla_idpantalla, fk_idpantalla_funcion, accion, momento, vistas)values('".$_REQUEST["idpantalla"]."', '".$idfuncion."', 'enviar', '1', 'v,l')";
		phpmkr_query($sql3);
		$idfuncion_exe=phpmkr_insert_id();
	}
	//--funcion_exe sincronizar_anexos_temporales
	$buscar_funcion_exe2=busca_filtro_tabla("","pantalla_funcion_exe a","pantalla_idpantalla=".$_REQUEST["idpantalla"]." and accion='adicionar' and fk_idpantalla_funcion='".$idfuncion2."' and momento='2'","",$conn);
	if($buscar_funcion_exe2["numcampos"]){
		$idfuncion_exe2=$buscar_funcion_exe2[0]["idpantalla_funcion_exe"];
	}
	else{
		$sql3="insert into pantalla_funcion_exe(pantalla_idpantalla, fk_idpantalla_funcion, accion, momento, vistas)values('".$_REQUEST["idpantalla"]."', '".$idfuncion2."', 'adicionar', '2', 'v,l')";
		phpmkr_query($sql3);
		$idfuncion_exe2=phpmkr_insert_id();
	}
	//--funcion_exe sincronizar_anexos_temporales edit
	$buscar_funcion_exe3=busca_filtro_tabla("","pantalla_funcion_exe a","pantalla_idpantalla=".$_REQUEST["idpantalla"]." and accion='editar' and fk_idpantalla_funcion='".$idfuncion2."' and momento='2'","",$conn);
	if($buscar_funcion_exe3["numcampos"]){
		$idfuncion_exe3=$buscar_funcion_exe3[0]["idpantalla_funcion_exe"];
	}
	else{
		$sql3="insert into pantalla_funcion_exe(pantalla_idpantalla, fk_idpantalla_funcion, accion, momento, vistas)values('".$_REQUEST["idpantalla"]."', '".$idfuncion2."', 'editar', '2', 'v,l')";
		phpmkr_query($sql3);
		$idfuncion_exe3=phpmkr_insert_id();
	}
	
	//--func_param sincronizar_anexos_temporales
	$buscar_exe_param2=busca_filtro_tabla("","pantalla_func_param a","a.fk_idpantalla_funcion_exe=".$idfuncion_exe2,"",$conn);
	if($buscar_exe_param2["numcampos"]){
		$idexe_param2=$buscar_exe_param2[0]["idpantalla_funcion_exe"];
	}
	else{
		$pantalla=busca_filtro_tabla("","pantalla a","a.idpantalla=".$_REQUEST["idpantalla"],"",$conn);
		$idcampo=busca_filtro_tabla("idpantalla_campos","pantalla_campos a","a.nombre like 'id".$pantalla[0]["nombre"]."'","",$conn);
		$sql3="insert into pantalla_func_param(nombre, valor, tipo, fk_idpantalla_funcion_exe)values('idregistro', '".$idcampo[0]["idpantalla_campos"]."', '1', '".$idfuncion_exe2."')";
		phpmkr_query($sql3);
		$sql3="insert into pantalla_func_param(nombre, valor, tipo, fk_idpantalla_funcion_exe)values('pantalla', 'pantalla', '3', '".$idfuncion_exe2."')";
		phpmkr_query($sql3);
		$idexe_param2=phpmkr_insert_id();
	}
	//--func_param sincronizar_anexos_temporales editar
	$buscar_exe_param3=busca_filtro_tabla("","pantalla_func_param a","a.fk_idpantalla_funcion_exe=".$idfuncion_exe3,"",$conn);
	if($buscar_exe_param3["numcampos"]){
		$idexe_param3=$buscar_exe_param3[0]["idpantalla_funcion_exe"];
	}
	else{
		$pantalla=busca_filtro_tabla("","pantalla a","a.idpantalla=".$_REQUEST["idpantalla"],"",$conn);
		$idcampo=busca_filtro_tabla("idpantalla_campos","pantalla_campos a","a.nombre like 'id".$pantalla[0]["nombre"]."'","",$conn);
		$sql3="insert into pantalla_func_param(nombre, valor, tipo, fk_idpantalla_funcion_exe)values('idregistro', '".$idcampo[0]["idpantalla_campos"]."', '1', '".$idfuncion_exe3."')";
		phpmkr_query($sql3);
		$sql3="insert into pantalla_func_param(nombre, valor, tipo, fk_idpantalla_funcion_exe)values('pantalla', 'pantalla', '3', '".$idfuncion_exe3."')";
		phpmkr_query($sql3);
		$idexe_param3=phpmkr_insert_id();
	}

	//--pantalla_campo validar_anexos_subidos
	$campo_vinculado=busca_filtro_tabla("","pantalla_campos a","a.pantalla_idpantalla='".$_REQUEST["idpantalla"]."' and valor='".$idfuncion_exe."'","",$conn);
	if($campo_vinculado["numcampos"]){
		$idcampo=$campo_vinculado[0]["idpantalla_campos"];
	}
	else{
		$sql4="insert into pantalla_campos(pantalla_idpantalla, tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, placeholder)value('".$_REQUEST["idpantalla"]."', '', 'accion_pantalla_anexo', 'Validar anexos subidos', 'varchar', '255', '0', '".$idfuncion_exe."', 'a,e,b', 'Se encarga de validar de que los anexos que se estan cargando en el adicionar, esten al 100%', '', '', 'acciones_pantalla', 'Acciones pantalla')";
		phpmkr_query($sql4);
		$idcampo=phpmkr_insert_id();
	}
	//--pantalla_campo sincronizar_anexos_temporales
	$campo_vinculado2=busca_filtro_tabla("","pantalla_campos a","a.pantalla_idpantalla='".$_REQUEST["idpantalla"]."' and valor='".$idfuncion_exe2."'","",$conn);
	if($campo_vinculado2["numcampos"]){
		$idcampo2=$campo_vinculado2[0]["idpantalla_campos"];
	}
	else{
		$sql4="insert into pantalla_campos(pantalla_idpantalla, tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, placeholder)value('".$_REQUEST["idpantalla"]."', '', 'accion_pantalla_anexo_enviar', 'Se encarga de sincronizar los anexos desde las tablas temporales, a las tablas reales', 'varchar', '255', '0', '".$idfuncion_exe2."', 'a,e,b', 'Se encarga de sincronizar los anexos desde las tablas temporales, a las tablas reales', '', '', 'acciones_pantalla', 'Acciones pantalla')";
		phpmkr_query($sql4);
		$idcampo2=phpmkr_insert_id();
	}
	//--pantalla_campo sincronizar_anexos_temporales editar
	$campo_vinculado2=busca_filtro_tabla("","pantalla_campos a","a.pantalla_idpantalla='".$_REQUEST["idpantalla"]."' and valor='".$idfuncion_exe3."'","",$conn);
	if($campo_vinculado2["numcampos"]){
		$idcampo2=$campo_vinculado2[0]["idpantalla_campos"];
	}
	else{
		$sql4="insert into pantalla_campos(pantalla_idpantalla, tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, placeholder)value('".$_REQUEST["idpantalla"]."', '', 'accion_pantalla_anexo_editar', 'Se encarga de sincronizar los anexos desde las tablas temporales, a las tablas reales despues de editar', 'varchar', '255', '0', '".$idfuncion_exe3."', 'a,e,b', 'Se encarga de sincronizar los anexos desde las tablas temporales, a las tablas reales despues de editar', '', '', 'acciones_pantalla', 'Acciones pantalla')";
		phpmkr_query($sql4);
		$idcampo2=phpmkr_insert_id();
	}

	return $idcampo;
}
if(@$_REQUEST["ejecutar_pantalla_campo"])$_REQUEST["ejecutar_pantalla_campo"]();
?>
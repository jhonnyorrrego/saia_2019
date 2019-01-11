<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/clasificacion_pqrsf/funciones.php");


$info_request=explode(",", @$_REQUEST["variable_busqueda"]);
$cant=count($info_request);
for($i=0;$i<$cant;$i++){
	$parametros=explode("-", $info_request[$i]);
	$_REQUEST[$parametros[0]]=$parametros[1];
}

/*FUNCIONES DEL SQL*/
function filtro_where(){
global $conn;
	$parteWhere=" a.estado not in ('ELIMINADO','ANULADO','ACTIVO')";
	
	if(@$_REQUEST['usuario']=="actual"){
		$rol_actual=busca_filtro_tabla("iddependencia_cargo","vfuncionario_dc","idfuncionario=".usuario_actual('idfuncionario'),"",$conn);
		$roles=extrae_campo($rol_actual,"iddependencia_cargo");
		$parteWhere.=" and c.responsable in (".implode(",", $roles).")";
	}
	return ($parteWhere); 
}
function filtro_where2(){
global $conn;
	$parteWhere=" a.iddocumento=b.documento_iddocumento AND b.idft_pqrsf=c.ft_pqrsf AND c.serie=d.idserie AND c.documento_iddocumento=e.iddocumento AND lower(e.estado) not in('eliminado','anulado') AND lower(a.estado) not in('anulado','eliminado') ";
	
	if(@$_REQUEST['usuario']=="actual"){
		$rol_actual=busca_filtro_tabla("iddependencia_cargo","vfuncionario_dc","idfuncionario=".usuario_actual('idfuncionario'),"",$conn);
		$roles=extrae_campo($rol_actual,"iddependencia_cargo");
		$parteWhere.=" and c.responsable in (".implode(",", $roles).")";
	}
	return ($parteWhere); 
}
function decodificar_html($valor){
	$result=strip_tags($valor);
	$result=str_replace('"', "'", $result);
	return(($result));
}
function ver_documento($iddocumento,$radicado,$html=""){
	if($html==""){
		$html=$radicado;
	}
	$enlace = "<div style='text-align:center' class='link kenlace_saia' enlace='ordenar.php?accion=mostrar&amp;amp;mostrar_formato=1&amp;amp;key=".$iddocumento."' conector='iframe' titulo='Documento No - ".$radicado."'><span class='badge'>".$html."</span></div>";
	return($enlace);
}

function ver_tipo($iddocumento){
$idformato=busca_filtro_tabla("idformato","formato f,documento d","lower(d.plantilla)=lower(f.nombre) and d.iddocumento=".$iddocumento,"",$conn);	
return(mostrar_valor_campo('tipo',$idformato[0][0],$iddocumento,1));
}

function ver_rol($iddocumento){
	$idformato=busca_filtro_tabla("idformato","formato f,documento d","lower(d.plantilla)=lower(f.nombre) and d.iddocumento=".$iddocumento,"",$conn);
	return(mostrar_valor_campo('rol_institucion',$idformato[0][0],$iddocumento,1));
}
function ver_comentario($iddocumento){
	//$idformato=busca_filtro_tabla("idformato","formato f,documento d","lower(d.plantilla)=lower(f.nombre) and d.iddocumento=".$iddocumento,"",$conn);
	//$comentarios=mostrar_valor_campo('comentarios',$idformato[0][0],$iddocumento,1);
	
	$comentario=busca_filtro_tabla("","ft_pqrsf","documento_iddocumento=".$iddocumento,"",$conn);
	$ncomentario=str_replace('"', "'", $comentario[0]['comentarios']);//las comillas dobles dañan los resultados del reporte.
	return ($ncomentario);
}

function ver_clasificacion($iddocumento){
	$idformato=busca_filtro_tabla("idformato","formato f","nombre='clasificacion_pqrsf'","",$conn);
	$cadena=array();
	$clasificaciones=busca_filtro_tabla("C.iddocumento","ft_pqrsf A, ft_clasificacion_pqrsf B, documento C","A.documento_iddocumento=".$iddocumento." AND A.idft_pqrsf=B.ft_pqrsf AND B.documento_iddocumento=C.iddocumento AND C.estado not in('ELIMINADO', 'ANULADO')","",$conn);
	if($clasificaciones["numcampos"]){
		for($i=0;$i<$clasificaciones["numcampos"];$i++){
			$cadena[]=mostrar_valor_campo('serie',$idformato[0][0],$clasificaciones[$i]["iddocumento"],1);
		}
	}
	else{
		//$cadena[]="Sin clasificacion";
	}
	return(implode(",",$cadena));
}

function ver_respon($iddocumento){
	$idformato=busca_filtro_tabla("idformato","formato f","nombre='clasificacion_pqrsf'","",$conn);
	$cadena=array();
	$clasificaciones=busca_filtro_tabla("C.iddocumento","ft_pqrsf A, ft_clasificacion_pqrsf B, documento C","A.documento_iddocumento=".$iddocumento." AND A.idft_pqrsf=B.ft_pqrsf AND B.documento_iddocumento=C.iddocumento AND C.estado not in('ELIMINADO', 'ANULADO')","",$conn);
	if($clasificaciones["numcampos"]){
		for($i=0;$i<$clasificaciones["numcampos"];$i++){
			$cadena[]=ver_responsable($idformato[0][0],$clasificaciones[$i]["iddocumento"],1);
		}
	}
	else{
		//$cadena[]="Sin clasificacion";
	}
	return(implode(",",$cadena));
}

function estado_reporte_pqrsf($estado,$iddoc){
	global $conn;
	$idformato=busca_filtro_tabla("idformato","formato f,documento d","lower(d.plantilla)=lower(f.nombre) and d.iddocumento=".$iddoc,"",$conn);
	$html="<div id='estado_veri_".$iddoc."'>".mostrar_valor_campo('estado_reporte',$idformato[0][0],$iddoc,1)."</div>";
	return($html);
}
function verificacion($iddocumento,$estado_ver){
	$idformato=busca_filtro_tabla("idformato","formato f,documento d","lower(d.plantilla)=lower(f.nombre) and d.iddocumento=".$iddocumento,"",$conn);
	$valores=busca_filtro_tabla("valor","campos_formato","nombre='estado_verificacion' and formato_idformato=".$idformato[0][0],"",$conn);
	$campos=explode(";", $valores[0][0]);
	
	$select="<select style='width:100px' iddocumento='".$iddocumento."' id='estado_verificacion' class='estado_verificacion' name='estado_verificacion'><option value=''>Seleccione</option>";
	for($i=0;$i<count($campos);$i++){
		$dato=explode(",", $campos[$i]);
		if($dato[0]==$estado_ver){
			$nombre_estado=$dato[1];
			$select.="<option value='".$dato[0]."' selected>".$dato[1]."</option>";
		}else{
			$select.="<option value='".$dato[0]."'>".$dato[1]."</option>";
		}
	}
	$select.="</select>";
	
	$permiso=new Permiso();
	$ok1=$permiso->acceso_modulo_perfil("permiso_modificar_verificacion_pqrsf");
	if($ok1){
		$html=$select;
	}else{
		$html=$nombre_estado;
	}
	return($html);
}

function funcionario_cambio($funcionario,$fecha,$iddoc){
global $conn;	
	$opt=0;
	if($fecha=="fecha_reporte"){
		$fecha=date("Y-m-d");
		$opt=1;
	}
	$date = new DateTime($fecha);
	$html="<div id='funcionario_".$iddoc."'>";
	if($funcionario!="" && $funcionario!=0){
		$datos=busca_filtro_tabla("nombres,apellidos","funcionario","idfuncionario=".$funcionario,"",$conn);
		
		$html.="<b>Funcionario: </b>".$datos[0]['nombres']." ".$datos[0]['apellidos']."<br/>";
		if($opt==1){
			$html.="<b>Fecha: </b>";
		}else{
			$html.="<b>Fecha: </b>".date_format($date, 'Y-m-d H:i');
		}
		
	}
	$html.="</div>";
	return($html);
}

/*AJAX*/
if(isset($_REQUEST['iddoc_verificacion'])){
	$idfun=usuario_actual('idfuncionario');
	$date=fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s");
	$sql="UPDATE ft_pqrsf SET estado_reporte=4,funcionario_reporte=".$idfun.",estado_verificacion=".$_REQUEST['estado_verif'].",fecha_reporte=".$date." WHERE documento_iddocumento=".$_REQUEST['iddoc_verificacion'];//Cambio a Verificado
	phpmkr_query($sql);
	$htmlfun="";
	$datos_fun=busca_filtro_tabla("nombres,apellidos","funcionario","idfuncionario=".$idfun,"",$conn);
	$htmlfun.="<b>Funcionario: </b>".$datos_fun[0]['nombres']." ".$datos_fun[0]['apellidos']."<br/>";
	$htmlfun.="<b>Fecha: </b>".date("Y-m-d H:i");
	echo $htmlfun;
}
function cantidad_total_funcion(){
	global $conn;
	$consulta=busca_filtro_tabla("count(*) as cant","ft_pqrsf a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO')","",$conn);
	$cadena="Total<br/>";
	$cadena.=$consulta[0]["cant"];
	return($cadena);
}

?>
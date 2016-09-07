<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");

if(isset($_REQUEST['cliente']) && $_REQUEST["opt"]==1){
 	$datos=busca_filtro_tabla("cp.nombre_corto,dcp.iddocumento","ft_clientes_proveedores cp, documento dcp","cp.documento_iddocumento=dcp.iddocumento and dcp.estado not in ('ELIMINADO','ANULADO','ACTIVO') and lower(cp.nombre_corto) like '%".strtolower($_REQUEST['cliente'])."%'","",$conn);	
	$html="<ul>";
	if($datos['numcampos']){
		for($i=0;$i<$datos['numcampos'];$i++){
			$html.="<li onclick=\"cargar_datos(".$datos[$i]['iddocumento'].",'".$datos[$i]['nombre_corto']."')\">".$datos[$i]['nombre_corto']."</li>";
		}
	}else{
		$html.="<li onclick=\"cargar_datos(0)\">NO se encuentra procesos para el cliente</li>";
	}
	$html.="</ul>";
	echo $html;
}

if (isset($_REQUEST['iddoc']) && $_REQUEST['opt'] == 3) {
  $html = "---";
  $datos=busca_filtro_tabla("cp.nombre_corto,dcp.iddocumento","ft_clientes_proveedores cp, documento dcp","cp.documento_iddocumento=dcp.iddocumento AND dcp.iddocumento=".$_REQUEST["iddoc"],"",$conn);
  if ($datos["numcampos"]) {
  	$html=$datos[0]['nombre_corto'];
  }
  echo $html;
}

if(isset($_REQUEST['nombre_macro']) && $_REQUEST["opt"]==4){
	$html="<ul>";	
	$idserie_macro=busca_filtro_tabla("idserie","serie","lower(nombre) LIKE 'macroprocesos%-%procesos'","",$conn);
	$macro=busca_filtro_tabla("idserie","serie","cod_padre=".$idserie_macro[0]['idserie']." and estado=1","nombre",$conn);
	if($macro["numcampos"]){
		$idserie_macro=extrae_campo($macro,"idserie");
	 	$datos=busca_filtro_tabla("s.idserie,s.nombre,sp.nombre as nombre_padre","serie s, serie sp","s.cod_padre=sp.idserie AND (lower(sp.nombre) like '%".strtolower($_REQUEST['nombre_macro'])."%' OR lower(s.nombre) like '%".strtolower($_REQUEST['nombre_macro'])."%')  and sp.estado=1 and s.estado=1 and s.cod_padre in (".implode(",", $idserie_macro).") ","sp.nombre",$conn);
		if($datos['numcampos']){
			for($i=0;$i<$datos['numcampos'];$i++){
				$descripcion=$datos[$i]['nombre_padre']." - ".$datos[$i]['nombre'];
				$html.="<li onclick=\"cargar_datos_macro(".$datos[$i]['idserie'].",'".$descripcion."')\">".$descripcion."</li>";
			}
		}else{
			$html.="<li onclick=\"cargar_datos_macro(0)\">NO se encuentra el macroproceso-proceso</li>";
		}
	}else{
		$html.="<li onclick=\"cargar_datos_macro(0)\">NO se encuentra el macroproceso-proceso</li>";
	}
	$html.="</ul>";
	echo $html;
}

if (isset($_REQUEST['idserie']) && $_REQUEST['opt'] == 5) {
  $html = "---";
  $datos=busca_filtro_tabla("s.idserie,s.nombre,sp.nombre as nombre_padre","serie s, serie sp","s.cod_padre=sp.idserie and s.idserie=".$_REQUEST["idserie"],"",$conn);
  if ($datos["numcampos"]) {
  	$html=$datos[0]['nombre_padre']." - ".$datos[0]['nombre'];
  }
  echo $html;
}

?>
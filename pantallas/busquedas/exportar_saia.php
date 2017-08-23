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
include_once ($ruta_db_superior."define.php");
include_once ($ruta_db_superior."librerias_saia.php");
echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap());
?>
<body style="background-color: transparent;">
<div id="barra_exp_ppal" style="margin-top:2px;margin-left:2px;width:100px">
<div class="progress progress-striped active" style="margin-bottom: 0px;"><div class="bar bar-success" id="barra_exp" ></div></div>
</div>
<?php 
$_REQUEST["no_imprime"]=1;
if($_REQUEST['tipo_reporte']==1){
	$_REQUEST['tipo_busqueda']=1;
}
$request='';
if((@$_REQUEST["actual_row"]<@$_REQUEST["cantidad_total"] )|| @$_REQUEST["page"]==1){
	include_once($ruta_db_superior."pantallas/busquedas/servidor_busqueda.php");
	if($response->exito){
	  if(!$_REQUEST["cantidad_total"]){
	    $_REQUEST["cantidad_total"]=$response->cantidad_total;
	  }
	    //$_REQUEST["cantidad_total"]=$response->cantidad_total;
		$_REQUEST["actual_row"]=$response->actual_row;
		$_REQUEST["page"]=$response->page;
    
		if(count($_REQUEST)){
			$request.="?";
			$i=0;
			foreach ($_REQUEST AS $key=>$valor){
				if($i>0){
					$request.="&";
				}
				$request.=$key."=".$valor;
				$i++;
			}
			$porcentaje=floor(($_REQUEST["actual_row"]/$_REQUEST["cantidad_total"])*100);
			if($porcentaje>=100){
				$porcentaje=100;
			}

			echo('<script type="text/javascript">');
			if($porcentaje==100){
				$texto='$("#barra_exp_ppal").html("<a href=\''.$ruta_db_superior.$_REQUEST["ruta_exportar_saia"].'\' align=\'center\'><div class=\'btn btn-mini btn-primary\'>Descargar</div></a>");';
			}
			else{
				$texto='$("#barra_exp").html("'.$porcentaje.'%");
						$("#barra_exp").css("width","'.$porcentaje.'%");';
			}	
			echo($texto.'</script>');
			if($porcentaje<100){
				usleep(500);
				abrir_url("exportar_saia.php".$request,"_self");
			}			
		}
	}
}
/*@$_REQUEST['page']; // pagina actual inicia en 1
 @$_REQUEST['rows']; // registros por listado de datos
 @$_REQUEST['sidx']; // Campo por el que se debe ordenar
 @$_REQUEST['sord']; // Orden de la consulta
 @$_REQUEST['actual_row']; //fila en la que inicia la consulta o ultimo resultado de la consulta anterior.
 @$_REQUEST["idbusqueda_componente"];
 @$_REQUEST["variable_busqueda"]; // conjunto de variables separados por , toma el valor para pasar por REQUEST a la consulta
 @$_REQUEST["idbusqueda_filtro_temp"];
 @$_REQUEST["cantidad_total"]; //Cantidad total de los registros de la consulta
 @$_REQUEST["reporte"]; //Saca todas las filas de la consulta
 @$_REQUEST["exportar_saia"]; //Debe llevar excel para exportar a excel
 @$_REQUEST["ruta_exportar_saia"]; //Ruta completa de almacenamiento del archivo.
 @$_REQUEST["estilo_actualizar_informacion"] ; //Si es igual a vacio pone un div well
 @$_REQUEST["condicion_adicional"]; //Concatena a la condicion que sale de la base de datos*/
?>
</body>
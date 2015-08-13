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
include_once($ruta_db_superior."librerias_saia.php");
echo(estilo_bootstrap());
echo(librerias_jquery("1.7"));
ini_set("display_errors",true);
if(@$_REQUEST["accion"]){
	switch($_REQUEST["accion"]){
		case 1: 
			if(@$_REQUEST["idbusqueda"])
				exportar_busqueda($_REQUEST["idbusqueda"]);
		break;
		case 2: 
			formulario_importar_busqueda();
		break;
		case 3:
			$arreglo=json_decode(utf8_encode($_REQUEST["json"]),true);
			print_r($arreglo);
			importar_busqueda($arreglo);
		break;
	}
}
function exportar_busqueda($idbusqueda){
	$json=array();
	$json["busqueda"]=array();
	$busqueda=busca_filtro_tabla("","busqueda","idbusqueda=".$idbusqueda,"",$conn);
	if($busqueda["numcampos"]){
		$busqueda_componente = busca_filtro_tabla("","busqueda_componente","busqueda_idbusqueda=".$idbusqueda,"",$conn);
		//$idbusqueda=phpmk_insert_id();
		$sql=arreglo_to_insert("busqueda",$busqueda[0],array("idbusqueda"));
		$json["busqueda"]["sql"]=$sql;
		$json["busqueda"]["nombre"]=$sql;
		if($busqueda_componente["numcampos"]){
			for($i=0;$i<$busqueda_componente["numcampos"];$i++){
				$json["busqueda"]["bc_".$i]=array();
				$json["busqueda"]["bc_".$i]["nombre"]=$busqueda_componente[$i]["nombre"];
				//validar el tema de los modulos si se debe buscar en la base de datos o que se debe hacer
				$sql=arreglo_to_insert("busqueda_componente",$busqueda_componente[0],array("idbusqueda_componente"),array("busqueda_idbusqueda"=>"{-idbusqueda-}"));
				$json["busqueda"]["bc_".$i]["sql"]=$sql;
				$busqueda_condicion=busca_filtro_tabla("","busqueda_condicion","fk_busqueda_componente=".$busqueda_componente[$i]["idbusqueda_componente"],"",$conn);
				//Se parte del hecho de que cada componente tiene solo una condicion
				if($busqueda_condicion["numcampos"]){
					$sql=arreglo_to_insert("busqueda_condicion",$busqueda_condicion[0],array("idbusqueda_condicion"),array("fk_busqueda_componente"=>"{-idbusqueda_componente-}","busqueda_idbusqueda"=>"{-busqueda_idbusqueda-}"));
					$json["busqueda"]["bc_".$i]["condicion"]=$sql;
				}
				$busqueda_condicion2=busca_filtro_tabla("","busqueda_condicion","busqueda_idbusqueda=".$busqueda[0]["idbusqueda"],"",$conn);
				//Se parte del hecho de que cada componente tiene solo una condicion
				if($busqueda_condicion2["numcampos"]){
					$sql=arreglo_to_insert("busqueda_condicion",$busqueda_condicion2[0],array("idbusqueda_condicion"),array("fk_busqueda_componente"=>"{-idbusqueda_componente-}","busqueda_idbusqueda"=>"{-busqueda_idbusqueda-}"));
					$json["busqueda"]["condicion"]=$sql;
				}
				if($busqueda_condicion["numcampos"] && $busqueda_condicion2["numcampos"]){
					//$json["restricciones"]="--- Pilas con busqueda_componente y busqueda en busqueda_condicion ";
				}
			}	
		}
		$json["busqueda"]["numcompenentes"]=$busqueda_componente["numcampos"];
	}
echo("<br><br><pre>".json_encode($json)."</pre>");
}
function formulario_importar_busqueda(){
?>
<form action="io_busqueda_saia.php" method="POST" id="importar_saia_busqueda" class="form-inline">
<textarea name="json" id="json" rows="10" cols="50"></textarea><br>
<input type="hidden" name="accion" value="<?php echo($_REQUEST["accion"]+1);?>">
<input type="submit" value="Enviar" class="btn btn-primary" name="enviar"> 
</form>
<?php 
}
function importar_busqueda($arreglo){
	print_r($arreglo);
}
function arreglo_to_insert($tabla, $datos, $excluir, $reemplazar){
	$arreglo=array();
	$campos= listar_campos_tabla($tabla);
	foreach($campos AS $key=>$valor){
		if(!in_array($valor,$excluir) && $datos[$valor]){
			if(array_key_exists($valor,$reemplazar)){
				$datos[$valor]=$reemplazar[$valor];
			}
			$arreglo[$valor]=$datos[$valor];		
		}
	}
	$sql="INSERT INTO ".$tabla."(".implode(",",array_keys($arreglo)).") VALUES('".implode("','",array_values($arreglo))."')";
return($sql);
}
?>
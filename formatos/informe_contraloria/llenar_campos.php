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
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
if(@$_REQUEST["accion"]==1){
		registrar();
}
else{
		formulario();
}
function formulario(){
		global $conn;
			$iddoc=$_REQUEST["iddoc"];
			$idformato=$_REQUEST["idformato"];
				$datos=busca_filtro_tabla("","ft_informe_contraloria a","a.documento_iddocumento=".$iddoc,"",$conn);
				if($datos[0]["cumplimiento_general"]!=''){
							$cumplimiento_general=$datos[0]["cumplimiento_general"];
								}
					if($datos[0]["cumplimiento_especificos"]!=''){
								$cumplimiento_especificos=$datos[0]["cumplimiento_especificos"];
									}
					if($datos[0]["conclusiones"]!=''){
								$conclusiones=$datos[0]["conclusiones"];
									}
					?>
	<form method="post" name="formulario_formatos" id="formulario_formatos" action="llenar_campos.php">
	<table style="width:100%;font-family:arial">
		<tr>
			<td class="encabezado_list" colspan="2" style="text-align:center">Llenar campos</td>
		</tr>
		<tr>
			<td class="encabezado_list">Cumplimiento del objetivo general del plan</td>
			<td>
			<textarea id="cumplimiento_general" name="cumplimiento_general" rows="4" cols="50"><?php echo(strip_tags(html_entity_decode($cumplimiento_general))); ?></textarea>
			</td>
		</tr>
		<tr>
			<td class="encabezado_list">Cumplimiento de los objetivos especificos</td>
			<td>
			<textarea id="cumplimiento_especificos" name="cumplimiento_especificos" rows="4" cols="50"><?php echo(strip_tags(html_entity_decode($cumplimiento_especificos))); ?></textarea>
			</td>
		</tr>
		<tr>
			<td class="encabezado_list">Conclusiones</td>
			<td>
			<textarea id="conclusiones" name="conclusiones" rows="4" cols="50"><?php echo(strip_tags(html_entity_decode($conclusiones))); ?></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Guardar"></td>
		</tr>
	</table>
	<input type="hidden" name="idformato" value="<?php echo $idformato; ?>" id="idformato">
	<input type="hidden" name="iddoc" value="<?php echo $iddoc; ?>" id="iddoc">
	<input type="hidden" name="accion" value="1" id="accion">
	</form>
	<?php
}
function registrar(){
		global $conn;
			$iddoc=$_REQUEST["iddoc"];
			$idformato=$_REQUEST["idformato"];
				$cumplimiento_general=$_REQUEST["cumplimiento_general"];
				$cumplimiento_especificos=$_REQUEST["cumplimiento_especificos"];
					$conclusiones=$_REQUEST["conclusiones"];
					
					$sql1="update ft_informe_contraloria set cumplimiento_general='".$cumplimiento_general."', cumplimiento_especificos='".$cumplimiento_especificos."', conclusiones='".$conclusiones."' where documento_iddocumento=".$iddoc;
						phpmkr_query($sql1);
						abrir_url("mostrar_informe_contraloria.php?iddoc=".$iddoc."&idformato=".$idformato,"_parent");
}
?>

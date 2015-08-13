<?php
$max_salida=6;
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta;
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
if(@$_REQUEST["accion"]){
	registrar();
}
else{
	formulario();
}
function formulario(){
	global $conn;
	$iddoc=$_REQUEST["iddoc"];
	$idformato=$_REQUEST["idformato"];
	
	$datos=busca_filtro_tabla("","ft_solicitud_permiso A","A.documento_iddocumento=".$iddoc,"",$conn);
	
	?>
	<form method="post" action="llenar_campos_adicionales.php">
	<table style="font-size:8pt;font-family:arial">
		<tr>
			<td class="encabezado">Permiso remunerado</td>
			<td>
				<input type="radio" value="1" name="permiso_remunerado" <?php if($datos[0]["permiso_remunerado"]==1)echo("checked"); ?> >Si<br />
				<input type="radio" value="2" name="permiso_remunerado" <?php if($datos[0]["permiso_remunerado"]==2)echo("checked"); ?> >No
			</td>
		</tr>
		<tr>
			<td class="encabezado">Observaciones</td>
			<td><textarea name="observaciones_remunerado"><?php echo($datos[0]["observaciones_remunerado"]); ?></textarea></td>
		</tr>
		
		<tr>
			<td class="encabezado">Recupera el tiempo</td>
			<td>
				<input type="radio" value="1" name="recupera_tiempo" <?php if($datos[0]["recupera_tiempo"]==1)echo("checked"); ?> >Si<br />
				<input type="radio" value="2" name="recupera_tiempo" <?php if($datos[0]["recupera_tiempo"]==2)echo("checked"); ?> >No
			</td>
		</tr>
		<tr>
			<td class="encabezado">Observaciones</td>
			<td><textarea name="observaciones_recupera_tiempo"><?php echo($datos[0]["observaciones_recupera_tiempo"]); ?></textarea></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="hidden" name="accion" value="1">
				<input type="hidden" name="iddoc" value="<?php echo($iddoc); ?>">
				<input type="hidden" name="idformato" value="<?php echo($idformato); ?>">
				<input type="submit" value="Guardar">
			</td>
		</tr>
	</table>
	</form>
	<?php
}
function registrar(){
	$iddoc=$_REQUEST["iddoc"];
	$idformato=$_REQUEST["idformato"];
	
	$permiso_remunerado=@$_REQUEST["permiso_remunerado"];
	$observaciones_remunerado=@$_REQUEST["observaciones_remunerado"];
	
	$recupera_tiempo=@$_REQUEST["recupera_tiempo"];
	$observaciones_recupera_tiempo=@$_REQUEST["observaciones_recupera_tiempo"];
	
	$updates=array();
	
	if($permiso_remunerado){
		$updates[]="permiso_remunerado='".$permiso_remunerado."'";
	}
	if($observaciones_remunerado){
		$updates[]="observaciones_remunerado='".$observaciones_remunerado."'";
	}
	
	if($recupera_tiempo){
		$updates[]="recupera_tiempo='".$recupera_tiempo."'";
	}
	if($observaciones_recupera_tiempo){
		$updates[]="observaciones_recupera_tiempo='".$observaciones_recupera_tiempo."'";
	}
	$sql1="UPDATE ft_solicitud_permiso SET ".implode(",",$updates)." WHERE documento_iddocumento=".$iddoc;
	phpmkr_query($sql1);
	abrir_url("mostrar_solicitud_permiso.php?iddoc=".$iddoc."&idformato=".$idformato,"_parent");
}
?>
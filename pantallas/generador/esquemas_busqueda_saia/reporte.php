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
include_once $ruta_db_superior . 'core/autoload.php';
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery("1.7"));
echo(librerias_html5());
echo(estilo_bootstrap());
$pantalla_busqueda=busca_filtro_tabla("","pantalla","idpantalla=".$_REQUEST["idpantalla"],"",$conn);
$busqueda=busca_filtro_tabla("","busqueda A,busqueda_componente B","A.idbusqueda=B.busqueda_idbusqueda AND B.nombre LIKE 'pantalla_".$pantalla_busqueda[0]["nombre"]."'","",$conn);

$alineaciones="";
$alineaciones.="<option value='center'>Centro</option>";
$alineaciones.="<option value='left'>Izquierda</option>";
$alineaciones.="<option value='right'>Derecha</option>";

$valores=$busqueda[0]["info"];
//$valores="Et1|Valor: {*accion_pantalla_1108823447*}|center|-|Et2|{*validaciones*}|left|-|Et3|descripcion: {*enviar_email_pantalla*}|right";
if($valores){
	$filas=explode("|-|",$valores);
	$cant=count($filas);
	$cuerpo='';
	for($i=0;$i<$cant;$i++){
		$celdas=explode("|",$filas[$i]);
		$center='';
		$left='';
		$right='';
		if($celdas[2]=="center")$center="selected";
		if($celdas[2]=="left")$left="selected";
		if($celdas[2]=="right")$right="selected";
		$alineaciones.="<option value='center' ".$center.">Centro</option>";
		$alineaciones.="<option value='left' ".$left.">Izquierda</option>";
		$alineaciones.="<option value='right' ".$right.">Derecha</option>";
		
		$cuerpo.="<tr id='fila[]'><td><input type='text' class='etiquetas_llenado' style='width:100%' value='".$celdas[0]."'></td>";
		$cuerpo.="<td><input type='text' class='valores_llenado' id='campos_temp-".$i."' style='width:100%' value='".$celdas[1]."'></td>";
		$cuerpo.="<td><select class='alineaciones_llenado' style='width:100%'>".$alineaciones."</select></td>";
		$cuerpo.="<td class='eliminar_fila' style='cursor:pointer;text-align:center'>X</td></tr>";
	}
}
?>
<html>
	<head>
    <link href="<?php echo($ruta_db_superior);?>pantallas/generador/css/generador_pantalla.css" rel="stylesheet">
  </head>
  <body>                                                                            
    <table class="table table-bordered">
    	<thead>
      	<tr>
      		<td style="text-align:center;"><b>Etiqueta</b></td>
      		<td style="text-align:center;"><b>Valor</b></td>
      		<td style="text-align:center;"><b>Alineaci&oacute;n</b></td>
      		<td style="text-align:center;">&nbsp;</td>
      	</tr>
      </thead>
      <tbody id="items">
<?php
echo $cuerpo;
?>
      </tbody>
      <tfoot>
      	<tr>
      		<td colspan="4" id="adicionar_item" style="text-align:center;cursor:pointer">+Adicionar</td>
      	</tr>
      </tfoot>
		</table>
		<input type="hidden" name="campo_pantalla_busqueda" id="campo_pantalla_busqueda" value="">
		<!--button onclick="actualizar_campo_pantalla_busqueda();return false;">Parsear</button-->
  </body>
</html>
<script>
$(document).ready(function(){
	var indice_id=1;
	$("#adicionar_item").click(function(){
		$("#items").append("<tr id='fila[]' ><td><input type='text' class='etiquetas_llenado' style='width:100%'></td><td><input type='text' class='valores_llenado' id='campos_temp"+indice_id+"' style='width:100%'></td><td><select class='alineaciones_llenado' style='width:100%'><?php echo($alineaciones); ?></select></td><td class='eliminar_fila' style='cursor:pointer;text-align:center'>X</td></tr>");
		indice_id++;
	});
	$(".eliminar_fila").live("click",function(){
		var fila=$(this).parent();
		fila.remove();
	});
	
	$("input[type=text]").live('click',function(){
		if($(this).attr("id"))
			campo_id_foco=$(this).attr("id");
	});
});
function actualizar_campo_pantalla_busqueda(){
	var etiqueta=new Array();
	var valor=new Array();
	var alineacion=new Array();
	$(".etiquetas_llenado").each(function(i){
		etiqueta[i]=$(this).attr("value");
	});
	$(".valores_llenado").each(function(i){
		valor[i]=$(this).attr("value");
	});
	$(".alineaciones_llenado").each(function(i){
		alineacion[i]=$(this).attr("value");
	});
	var cantidad=valor.length;
	var cadena=new Array();
	for(var i=0;i<cantidad;i++){
		if(etiqueta[i]&&alineacion[i])
			cadena[i]=etiqueta[i]+"|"+valor[i]+"|"+alineacion[i];
	}
	var ocultar=cadena.join("|-|");
	$("#campo_pantalla_busqueda").val(ocultar);
}
</script>
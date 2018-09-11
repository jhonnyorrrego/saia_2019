<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior."db.php");
include_once ($ruta_db_superior."header.php");

$tvd=array(0=>"",1=>"");
$tvd[$_REQUEST["tvd"]]="checked";

include_once ($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery("1.8"));
echo(librerias_validar_formulario("11"));
echo(librerias_arboles());
echo(librerias_notificaciones());
if ($_REQUEST["seleccionados"]) {
	$buscar_asignacion_series["numcampos"]=array();	
   $buscar_asignacion_series = busca_filtro_tabla("", "entidad_serie", "estado=1 and llave_entidad=".$_REQUEST["seleccionados"], "", $conn);
	
    if ($buscar_asignacion_series["numcampos"]) {
    	for($i=0;$i<$buscar_asignacion_series["numcampos"];$i++){
        	$lista_series[] = $buscar_asignacion_series[$i]["serie_idserie"];
        	//if (!empty($lista_series)) {
            	
        	//}
		}
		$series_seleccionadas = implode(",", $lista_series);
    }
}
?>
<h3>Asignar series</h3>
<p>
<form name="asignarserie_entidad" id="asignarserie_entidad" action="asignarserie.php" method="post" >
	<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO*</span></td>
			<td bgcolor="#F5F5F5">
				<?php if($_REQUEST["tvd"]){
					echo "TVD";
				}
				else {echo "TRD";}				
				?>
				<!--input type="radio" name="tvd" id="tvd0" value="0" <?php echo $tvd[0];?> />TRD <input type="radio" name="tvd" id="tvd1" value="1" <?php echo $tvd[1];?>/>TVD -->
				
			</td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DEPENDENCIA*</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <div id="sub_entidad"></div> 
				<input type="hidden" name="iddependencia" id="iddependencia" value="<?php echo $_REQUEST["seleccionados"]; ?>"></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SERIE*</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <div id="divserie"></div> </td>
		</tr>

		<!--tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ACCION*</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"><input type="radio" name="accion" id="accion1" value="adicionar" checked="true" class="required"/>ADICIONAR <input type="radio" name="accion" id="accion0" value="eliminar" />ELIMINAR </td>
		</tr>

		<tr>
			<td colspan="2" style="text-align: center;background-color: #F5F5F5;">
			<input type="hidden" name="opt" value="1">
			<input type="hidden" name="idnode" value="<?php echo $_REQUEST["idnode"];?>">
			<input type="submit" name="Action" value="Guardar">
			</td>
		</tr-->
	</table>
</form>
</p>
<script type="text/javascript">
	$(document).ready(function() {
		//url1="test/test_dependencia.php?seleccionados=<?php echo $_REQUEST["seleccionados"];?>";
		$.ajax({
			//url : "<?php echo $ruta_db_superior;?>test/crear_arbol.php",
			url : "buscar_dependencia.php",
			//data:{xml:url1,campo:"iddependencia",radio:0,abrir_cargar:1,ruta_db_superior:"../../"},
			data:{campo:"iddependencia",valor:<?php echo $_REQUEST["seleccionados"];?>},
			type : "POST",
			async:false,
			success : function(html_dep) {
				$("#sub_entidad").empty().html(html_dep);
			},error: function (){
				top.noty({text: 'No se pudo cargar de dependencias de series',type: 'error',layout: 'topCenter',timeout:5000});
			}
		});

		//$("[name='tvd']").change(function (){
			//tvd=$(this).val();
			tvd="<?php echo $_REQUEST["tvd"]; ?>";
			var seleccionados="<?php echo $series_seleccionadas; ?>";
			url2="test/test_serie.php?tipo3=0&tvd="+tvd+"&seleccionados="+seleccionados;
			$.ajax({
				url : "<?php echo $ruta_db_superior;?>test/crear_arbol.php",
				data:{xml:url2,campo:"serie_idserie",radio:0,check_branch:0,abrir_cargar:1,ruta_db_superior:"../../",onNodeSelect:"asignar_permisos_entidad"},
				type : "POST",
				async:false,
				success : function(html_serie) {
					$("#divserie").empty().html(html_serie);
				},error: function (){
					top.noty({text: 'No se pudo cargar el arbol de series',type: 'error',layout: 'topCenter',timeout:5000});
				}
			});
		//});
		$("[name='tvd']:checked").trigger("change");

		$("#asignarserie_entidad").validate({
			submitHandler: function(form) {
				var serie=$("#serie_idserie").val();
				var dependencia=$("#iddependencia").val();

				if(serie!="" && dependencia!=""){
					form.submit();
				}else{
					top.noty({text: 'Por favor seleccione la serie y la dependencia',type: 'error',layout: 'topCenter',timeout:5000});
					return false;
				}
			}
		});
	});
	function asignar_permisos_entidad(nodeId){
		var iddependencia = $("#iddependencia").val();
		var serie_idserie= $("#serie_idserie").val();
		var id = nodeId;
		var accion ='eliminar'; 
		if(treeserie_idserie.isItemChecked(nodeId)==1){
			var accion = "adicionar";
		}
        $.ajax({
        	    url: 'asignarserie.php',
                type : "POST",
                data:{opt:1,iddependencia:iddependencia,serie_idserie:serie_idserie,accion:accion},
                success: function(retorno){
                    var tipo='warning';
                    var mensaje='<b>ATENCI&Oacute;N</b><br>Se ha retirado el permiso a la serie';
                    if(retorno==1){
                        tipo='success';
                        mensaje='<b>ATENCI&Oacute;N</b><br>Se ha adicionado el permiso a la serie';
                    }
                    notificacion_saia(mensaje,tipo,"topRight",3000);
                }
        	});
	}
</script>

<?php include ($ruta_db_superior."footer.php") ?>
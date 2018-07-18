<?php
include_once ("db.php");
include_once ("header.php");

$tvd=array(0=>"",1=>"");
$tvd[$_REQUEST["tvd"]]="checked";

include_once ("librerias_saia.php");
echo(librerias_jquery("1.8"));
echo(librerias_validar_formulario("11"));
echo(librerias_arboles());
?>
<p> 
<form name="asignarserie_entidad" id="asignarserie_entidad" action="asignarserie.php" method="post" >
	<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO*</span></td>
			<td bgcolor="#F5F5F5"><input type="radio" name="tvd" id="tvd0" value="0" <?php echo $tvd[0];?> />TRD <input type="radio" name="tvd" id="tvd1" value="1" <?php echo $tvd[1];?>/>TVD </td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DEPENDENCIA*</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <div id="sub_entidad"></div> </td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SERIE*</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <div id="divserie"></div> </td>
		</tr>
		
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ACCION*</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"><input type="radio" name="accion" id="accion1" value="adicionar" checked="true" class="required"/>ADICIONAR <input type="radio" name="accion" id="accion0" value="eliminar" />ELIMINAR </td>
		</tr>
		
		<tr>
			<td colspan="2" style="text-align: center;background-color: #F5F5F5;">
			<input type="hidden" name="opt" value="1">
			<input type="hidden" name="idnode" value="<?php echo $_REQUEST["idnode"];?>">
			<input type="submit" name="Action" value="Guardar">
			</td>
		</tr>
	</table>
</form>
</p>
<script type="text/javascript">
	$(document).ready(function() {
		url1="test/test_dependencia.php?seleccionados=<?php echo $_REQUEST["seleccionados"];?>";
		$.ajax({
			url : "test/crear_arbol.php",
			data:{xml:url1,campo:"iddependencia",radio:0,abrir_cargar:1},
			type : "POST",
			async:false,
			success : function(html_dep) {
				$("#sub_entidad").empty().html(html_dep);
			},error: function (){
				top.noty({text: 'No se pudo cargar de dependencias de series',type: 'error',layout: 'topCenter',timeout:5000});
			}
		});
				
		$("[name='tvd']").change(function (){
			tvd=$(this).val();
			url2="test/test_serie.php?tipo3=0&tvd="+tvd;
			$.ajax({
				url : "test/crear_arbol.php",
				data:{xml:url2,campo:"serie_idserie",radio:0,check_branch:1,abrir_cargar:1},
				type : "POST",
				async:false,
				success : function(html_serie) {
					$("#divserie").empty().html(html_serie);
				},error: function (){
					top.noty({text: 'No se pudo cargar el arbol de series',type: 'error',layout: 'topCenter',timeout:5000});
				}
			});
		});
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
</script>

<?php include ("footer.php") ?>
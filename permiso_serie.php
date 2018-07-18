<?php
include_once ("db.php");
include_once ("header.php");

$entidad=busca_filtro_tabla("identidad,nombre","entidad","identidad in (1,2,4)","nombre asc",$conn);
$option='<option value="">Seleccione</option>';
if($entidad["numcampos"]){
	for ($i=0; $i <$entidad["numcampos"] ; $i++) { 
		$option.='<option value="'.$entidad[$i]["identidad"].'">'.$entidad[$i]["nombre"].'</option>';
	}
}

include_once ("librerias_saia.php");
echo(librerias_jquery("1.8"));
echo(librerias_validar_formulario("11"));
echo(librerias_arboles());
?>
<p> 
<form name="permiso_serie" id="permiso_serie" action="asignarserie.php" method="post" >
	<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SERIE*</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <div id="divserie"></div> </td>
		</tr>
		
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO ENTIDAD*</span></td>
			<td bgcolor="#F5F5F5"><select id="tipo_entidad" name="tipo_entidad" class="required"><?php echo $option;?></select></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ENTIDAD*</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <div id="sub_entidad"></div> </td>
		</tr>
		
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ACCION*</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"><input type="radio" name="accion" id="accion1" value="adicionar" checked="true" class="required"/>ADICIONAR <input type="radio" name="accion" id="accion0" value="eliminar" />ELIMINAR </td>
		</tr>

		<tr>
			<td colspan="2" style="text-align: center;background-color: #F5F5F5;">
			<input type="hidden" name="opt" value="2">
			<input type="submit" name="Action" value="Guardar">
			</td>
		</tr>
	</table>
</form>
</p>
<script type="text/javascript">
	$(document).ready(function() {
		url2="test/test_serie.php?tipo1=0&tipo2=0&tvd=0&estado=1";
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
		
		$("#tipo_entidad").change(function (){
			option=$(this).val();
			if(option!=""){
				url1="";
				switch(option) {
					case '1'://Funcionario
					//url1="test/test_funcionario.php";
					url1="test.php?rol=1";
					check=1;
					break;
					
					case '2'://Dependencia
						url1="test/test_dependencia.php?estado=1";
						check=0;
					break;
					
					case '4'://Cargo
						url1="test/test_cargo.php?estado=1";
						check=0;
					break;
				} 
				$.ajax({
					url : "test/crear_arbol.php",
					data:{xml:url1,campo:"identidad",radio:0,abrir_cargar:1,check_branch:check},
					type : "POST",
					async:false,
					success : function(html) {
						$("#sub_entidad").empty().html(html);
					},error: function (){
						top.noty({text: 'No se pudo cargar la informacion',type: 'error',layout: 'topCenter',timeout:5000});
					}
				});
			}else{
				$("#sub_entidad").empty();
			}
		});
		$("#tipo_entidad").trigger("change");
		
		$("#permiso_serie").validate({
			submitHandler: function(form) {
				var serie=$("#serie_idserie").val();
				var entidad=$("#identidad").val();
				if(serie!="" && entidad!=""){
					form.submit();
				}else{
					top.noty({text: 'Por favor seleccione todos los campos',type: 'error',layout: 'topCenter',timeout:5000});
					return false;
				}
			}
		});		
	});
</script>

<?php include ("footer.php") ?>
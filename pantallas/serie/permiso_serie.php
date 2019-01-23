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

include_once ($ruta_db_superior . "db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once ($ruta_db_superior . "header.php");
?>
<style type="text/css">
ul.fancytree-container {
    border: none;
    background-color:#F5F5F5;
}
span.fancytree-title 
{  
	font-family: Verdana,Tahoma,arial;
	font-size: 9px; 
}
</style>
<?php
echo librerias_jquery("3.3");
echo(librerias_notificaciones());
echo librerias_validar_formulario("12");
//echo librerias_arboles();
echo librerias_UI("1.12");
echo librerias_arboles_ft("2.24", 'filtro');
$idserie = null;
$idserie_padre = null;
$tipo_entidad = null;
$identidad = null;
if ($_REQUEST["idserie"]) {
    $idserie = $_REQUEST["idserie"];
    $idserie_padre = $_REQUEST["idserie_padre"];
	$buscar_series = busca_filtro_tabla("", "serie", "idserie=$idserie", "", $conn);
	if($buscar_series["numcampos"]){
		$nombre_serie = $buscar_series[0]["nombre"];
	}
}
if ($_REQUEST["tipo_entidad"]) {
    $tipo_entidad = $_REQUEST["tipo_entidad"];
}
if($_REQUEST["identidad_serie"]){
	$identidad_serie=$_REQUEST["identidad_serie"];
}
$series_seleccionadas = null;
if ($_REQUEST["identidad"]) {
    $identidad = $_REQUEST["identidad"];
    if ($identidad) {
        $series_funcionario = busca_filtro_tabla("distinct idserie", "vpermiso_serie", "idfuncionario=$identidad", "", $conn);
        if ($series_funcionario["numcampos"]) {
            $lista_series = extrae_campo($series_funcionario, "idserie", "U");
            if (!empty($lista_series)) {
                $series_seleccionadas = implode(",", $lista_series);
            }
        }
    }
}//nuevo
else{
	$entidades=array();
	$vista_series = busca_filtro_tabla("", "permiso_serie", "estado=1 and fk_entidad_serie=".$identidad_serie, "", $conn);
	if($vista_series["numcampos"]){
		for($i=0;$i<$vista_series["numcampos"];$i++){
			$entidades[$vista_series[$i]["entidad_identidad"]][]=$vista_series[$i]["llave_entidad"];
			//$identidad[]=$vista_series[$i]["llave_entidad"];
		}
		//$entidades = implode(",", $entidades);
	}
	//var_dump($entidades);
}
$option = '<option value="">Seleccione</option>
		   <option value="4">Asignado a Cargo(s)</option>
 		   <option value="2">Asignado a Dependencia(s)</option>
 		   <option value="1">Asignado a Funcionario(s)</option>
		   <option value="5">Asignado a Roles</option>';

?>
<h3>Permisos sobre series</h3>
<p>
<!--form name="permiso_serie" id="permiso_serie" method="post" -->
	<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SERIE*</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> 
			<!--div id="divserie"-->
			<?php echo $nombre_serie; ?>

			</div> </td>
			<input type="hidden" name="serie_idserie" id="x_serie_idserie" value="<?php echo $idserie; ?>">
		</tr>

		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO ENTIDAD*</span></td>
			<td bgcolor="#F5F5F5"><select id="tipo_entidad" name="tipo_entidad" class="required"><?php echo $option;?></select></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ENTIDAD*</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <div id="sub_entidad"></div> </td>
		</tr>

		<!--tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ACCION*</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"><input type="radio" name="accion" id="accion1" value="adicionar" checked="true" class="required"/>ADICIONAR <input type="radio" name="accion" id="accion0" value="eliminar" />ELIMINAR </td>
		</tr>

		<tr>
			<td colspan="2" style="text-align: center;background-color: #F5F5F5;">
			<input type="hidden" name="opt" value="2">
			<input type="submit" name="Action" value="Guardar">
			</td>
		</tr-->
	</table>
<!--/form-->
</p>
<script type="text/javascript" src="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
		 <link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
		 <script type='text/javascript'>
		   hs.graphicsDir = '<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
		   hs.outlineType = 'rounded-white';
		</script>
<script type="text/javascript">

var idserie = <?php echo (empty($idserie) ? 0 : $idserie);?>;
var idserie_padre = <?php echo (empty($idserie_padre) ? 0 : $idserie_padre);?>;
var identidad = '<?php echo (empty($identidad) ? 0 : $identidad);?>';
var series_seleccionadas = <?php echo (empty($series_seleccionadas) ? "''" : "'$series_seleccionadas'");?>;
var entidades = <?php echo json_encode($entidades) ?>;
	$(document).ready(function() {
		$("#tipo_entidad option[value='2']").prop('selected', true)
		if(identidad > 0) {
			$("#tipo_entidad").trigger("change");
		}

		$("#tipo_entidad").change(function () {
			option=$(this).val();
			var entidades_seleccionadas='';
			if(option != "") {
				if(!$.isEmptyObject(entidades)){
					if(entidades[option]){
						entidades_seleccionadas=entidades[option].join(',');
					}
				}
				if(identidad && identidad > 0) {
					if(entidades_seleccionadas==''){
						entidades_seleccionadas=identidad;
					}
					else{
						entidades_seleccionadas = entidades_seleccionadas + ',' + identidad;
					}
				}
				url1="";

				switch(option) {
					case '1'://Funcionario
						url1="arboles/arbol_funcionario.php?idcampofun=funcionario_codigo&checkbox=true&sin_padre=1";
						url1  = url1 + '&seleccionados=' + entidades_seleccionadas;
						check=2;
					break;

					case '2'://Dependencia
						url1="arboles/arbol_dependencia.php?estado=1&checkbox=true";
						url1  = url1 + '&seleccionados=' + entidades_seleccionadas;
						check=2;
					break;

					case '4'://Cargo
						url1="arboles/arbol_cargo.php?estado=1&checkbox=true";
						url1  = url1 + '&seleccionados=' + entidades_seleccionadas;
						check=2;
					break;
					case '5'://Rol
					url1="arboles/arbol_funcionario.php?idcampofun=iddependencia_cargo&checkbox=true&sin_padre=1";
					//url1="test.php?rol=1";
						url1  = url1 + '&seleccionados=' + entidades_seleccionadas;
					//}
					check=2;
					break;
				}
				$.ajax({
					url : "<?php echo $ruta_db_superior;?>arboles/crear_arbol.php",
					data:{xml:url1,campo:"identidad",selectMode:check,ruta_db_superior:"../../",onNodeSelect:"validar_permisos_entidad",onNodeClick:"asignar_permisos_serie",onNodeDblClick:"no_hacer_nada",seleccionar_todos:1,busqueda_item:1},
					type : "POST",
					async:false,
					success : function(html) {
						$("#sub_entidad").empty().html(html);
					},error: function () {
                        top.notification({
                            message: 'No se pudo cargar la informacion',
                            type: 'error',
                            duration: 5000
                        });
					}
				});
			}else{
				$("#sub_entidad").empty();
			}
		});
		$("#tipo_entidad").trigger("change");
	});

	function validar_permisos_entidad(event,data){

		var tipo_entidad = $("#tipo_entidad").val();
		var serie= $("#x_serie_idserie").val();
		var identidad_serie = "<?php echo $identidad_serie; ?>";
		var id = data.node.key;
		var accion = data.node.selected ? 1 : 0;
		//var accion=1;d
		//return false;
        $.ajax({
        	    url: 'validar_permisos_entidad.php',
                dataType: 'json',
                data:{
                	tipo_entidad:tipo_entidad,
                	id:id,
                	accion:accion,
                	asignar_quitar_permiso_editar:1,
                	identidad_serie:identidad_serie},
                success: function(retorno){
                    var tipo='warning';
                    var mensaje='<b>ATENCI&Oacute;N</b><br>Se ha retirado el permiso exitosamente';
                    if(retorno.accion==1){
                        tipo='success';
                        mensaje='<b>ATENCI&Oacute;N</b><br>Se ha asignado el permiso exitosamente';
                    }
                    notificacion_saia(mensaje,tipo,"topRight",3000);
                }
        	});
	}
	function asignar_permisos_serie(event,data)
	{
		var elemento_evento = $.ui.fancytree.getEventTargetType(event.originalEvent);		
		if(elemento_evento=="title" && data.node.selected){	      		 
			var tipo_entidad = $("#tipo_entidad").val();
			//var serie= $("#x_serie_idserie").val();
			var identidad_serie = "<?php echo $identidad_serie; ?>";
			var enlace="highslide_permiso_serie.php?identidad_serie="+identidad_serie+"&tipo_entidad="+tipo_entidad+"&entidad="+data.node.key;
	        //var identificador=$(this).attr("identificador");
	        //top.hs.htmlExpand(this, { objectType: 'iframe',width: 300, height: 150,contentId:'cuerpo_paso', preserveContent:false, src:enlace,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header',targetX:'centro 200px',targetY:null});
	        hs.htmlExpand(this, { objectType: 'iframe',width: 300, height: 150,contentId:'cuerpo_paso', preserveContent:false, src:enlace,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header'});
	   }
	}
	function no_hacer_nada(event, data){
		return false;
	}
</script>

<?php include ($ruta_db_superior."footer.php") ?>
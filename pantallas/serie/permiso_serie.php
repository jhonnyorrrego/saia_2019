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
include_once ($ruta_db_superior . "header.php");
$idserie = null;
$idserie_padre = null;
$tipo_entidad = null;
$identidad = null;
if ($_REQUEST["idserie"]) {
    $idserie = $_REQUEST["idserie"];
    $idserie_padre = $_REQUEST["idserie_padre"];
}

if ($_REQUEST["tipo_entidad"]) {
    $tipo_entidad = $_REQUEST["tipo_entidad"];
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
}

$entidad = busca_filtro_tabla("identidad, nombre", "entidad", "identidad in (1,2,4)", "nombre asc", $conn);
$option = '<option value="">Seleccione</option>';
if ($entidad["numcampos"]) {
    for ($i = 0; $i < $entidad["numcampos"]; $i++) {
        $option .= '<option value="' . $entidad[$i]["identidad"] . '"';
        if (!empty($tipo_entidad) && $tipo_entidad == $entidad[$i]["identidad"]) {
            $option .= ' selected="selected"';
        }
        $option .= '>' . $entidad[$i]["nombre"];
        $option .= '</option>';
    }
}

include_once ($ruta_db_superior . "librerias_saia.php");
echo librerias_jquery("1.8");
echo librerias_validar_formulario("11");
echo librerias_arboles();
?>

<h3>Permisos sobre series</h3>
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
var idserie = <?php echo (empty($idserie) ? 0 : $idserie);?>;
var idserie_padre = <?php echo (empty($idserie_padre) ? 0 : $idserie_padre);?>;
var identidad = <?php echo (empty($identidad) ? 0 : $identidad);?>;
var series_seleccionadas = <?php echo (empty($series_seleccionadas) ? "''" : "'$series_seleccionadas'");?>;
	$(document).ready(function() {
		if(identidad > 0) {
			$("#tipo_entidad").trigger("change");
		}

		url2="test/test_serie.php?tipo1=0&tipo2=0&tvd=0&estado=1";
		if(idserie > 0) {
			url2 = url2 + '&id=' + idserie_padre;
			//url2 = url2 + '&seleccionados=' + idserie;
		}
		console.log(series_seleccionadas);
		if(series_seleccionadas != '') {
			url2 = url2 + '&seleccionados=' + series_seleccionadas;
		}
		$.ajax({
			//url : "<?php echo $ruta_db_superior;?>test/crear_arbol.php",
			url:"buscar_datos_serie.php",
			//data:{xml:url2,campo:"serie_idserie",radio:0,check_branch:1,abrir_cargar:1,ruta_db_superior:"../../"},
			data:{idserie:idserie},
			type : "POST",
			async:false,
			success : function(html_serie) {
				var serie = JSON.parse(html_serie);
				$("#divserie").empty().html(serie["nombre"]);
			},error: function (){
				top.noty({text: 'No se pudo cargar el arbol de series',type: 'error',layout: 'topCenter',timeout:5000});
			}
		});

		$("#tipo_entidad").change(function () {
			option=$(this).val();
			if(option != "") {
				url1="";
				switch(option) {
					case '1'://Funcionario
					//url1="test/test_funcionario.php";
					url1="test.php?rol=1";
					if(identidad > 0) {
						url1  = url1 + '&id=' + identidad;
					}
					check=1;
					break;

					case '2'://Dependencia
						url1="test/test_dependencia.php?estado=1";
						if(identidad > 0) {
							url1  = url1 + '&seleccionados=' + identidad;
						}
						check=0;
					break;

					case '4'://Cargo
						url1="test/test_cargo.php?estado=1";
						if(identidad > 0) {
							url1  = url1 + '&seleccionados=' + identidad;
						}
						check=0;
					break;
				}
				$.ajax({
					url : "<?php echo $ruta_db_superior;?>test/crear_arbol.php",
					data:{xml:url1,campo:"identidad",radio:0,abrir_cargar:1,check_branch:check,ruta_db_superior:"../../"},
					type : "POST",
					async:false,
					success : function(html) {
						$("#sub_entidad").empty().html(html);
					},error: function () {
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
				if(serie!="" && entidad!="") {
					form.submit();
				} else {
					top.noty({text: 'Por favor seleccione todos los campos',type: 'error',layout: 'topCenter',timeout:5000});
					return false;
				}
			}
		});
	});
</script>

<?php include ($ruta_db_superior."footer.php") ?>
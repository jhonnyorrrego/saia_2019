<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

/*ADICIONAR - EDITAR*/
function add_edit_vincu_exp() {
    global $ruta_db_superior;
	$opt = 0;
	$ocultar = 0;
	if (isset($_REQUEST["idexpediente"])) {
		$ocultar = 1;
	}
?>
<script>
var cargado = false;
var opt=parseInt(<?php echo $opt;?>);
var ocultar=parseInt(<?php echo $ocultar;?>);

function fin_carga_arbol_serie_idserie() {
	$("#esperando_serie_idserie").hide();

	if(!cargado) {
		refrescar_arbol();
	}
}

function refrescar_arbol() {
	if(ocultar == 1) {
		var idexp = '<?php echo($_REQUEST["idexpediente"]); ?>';
		//console.log("Exp: "+idexp);
		var url_arbol = "<?php echo($ruta_db_superior); ?>test/test_expediente_funcionario.php?idexpediente=" + idexp;
		if(ocultar==1) {
			tree_serie_idserie.deleteChildItems(0);
			tree_serie_idserie.loadXML(url_arbol);
			cargado = true;
		}
	}
}

$(document).ready(function (){
		tree_serie_idserie.setOnLoadingEnd(fin_carga_arbol_serie_idserie);
		if(ocultar==1) {
			var idexp = '<?php echo($_REQUEST["idexpediente"]); ?>';
			$("[name='fk_idexpediente']").val(idexp);
		} else {
			tree_serie_idserie.setOnCheckHandler(function(nodeId) {
    			var ud = tree_serie_idserie.getUserData(nodeId,"idexpediente");
    			var idexp = ud;
    			var idser = null;
    			if(!ud) {
    				var data = nodeId.split(/[._]/);
    				idser = data[0];
    				idexp = data[1];
    			}
    			$("[name='fk_idexpediente']").val(idexp);
    			//$("#serie_idserie").val(idser);
			});
		}
	});
</script>
<?php
}

/*MOSTRAR*/
function fecha_documento_funcion($idformato, $iddoc) {
	global $conn;
	$fecha_doc = busca_filtro_tabla(fecha_db_obtener('fecha_documento', 'Y-m-d') . " as fecha_doc", "ft_vincular_doc_expedie A", "A.documento_iddocumento=" . $iddoc, "");
	$datos = date_parse($fecha_doc[0]["fecha_doc"]);
	echo($datos["day"] . " de " . mes($datos["month"]) . " del " . $datos["year"]);
}

function ver_anexos_doc_vincu($idformato, $iddoc){
	global $conn,$ruta_db_superior;
	$anexos=busca_filtro_tabla("ruta,etiqueta,tipo,idanexos","anexos","documento_iddocumento=".$iddoc,"", $conn);
	$html="";
	if($anexos["numcampos"]){
		for ($i=0; $i <$anexos["numcampos"] ; $i++) {
			$ruta_anexo=$ruta_db_superior.'anexosdigitales/mostrar_menu_anexo.php?idanexo='.$anexos[$i]["idanexos"].'&iddoc='.$iddoc;
			$html.='<a href="'.$ruta_anexo.'">'.$anexos[$i]["etiqueta"].'</a><br/>';
		}
	}
	return $html;
}

/*POSTERIOR APROBAR*/
function post_aprob_vincu_exp($idformato, $iddoc) {
	global $conn;
	if($_REQUEST["redirecciona_exp"]==1){
		?>
		<script>
			parent.refrescar_panel_kaiten();
		</script>
		<?php
	}
	return;
}
function mostrar_informacion_qr($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$datos_vincular_doc=busca_filtro_tabla("serie_idserie,asunto,".fecha_db_obtener('fecha_documento', 'Y-m-d') . " as fecha_doc,observaciones","ft_vincular_doc_expedie","documento_iddocumento=".$iddoc,"",$conn);

  //$documento=busca_filtro_tabla("numero,tipo_radicado,".fecha_db_obtener("fecha","Y-m-d")." AS fecha","documento","iddocumento=".$iddoc,"",$conn);
  	$dato_serie = explode(".",$datos_vincular_doc[0]["serie_idserie"]);
	$tipo_documento=busca_filtro_tabla("nombre, cod_padre","serie","idserie=".$dato_serie[0],"",$conn);

	if($tipo_documento["numcampos"]){
		$serie = busca_filtro_tabla("nombre","serie","idserie =".$tipo_documento[0]["cod_padre"],"",$conn);
	}

	$datos_fecha = date_parse($datos_vincular_doc[0]["fecha_doc"]);
	$fecha_doc = $datos_fecha["day"] . " de " . mes($datos_fecha["month"]) . " del " . $datos_fecha["year"];

	$estado_doc=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"", $conn);
	if($estado_doc[0]['estado']=='APROBADO'){
		include_once ($ruta_db_superior . "app/qr/librerias.php");
		$img=mostrar_codigo_qr($idformato, $iddoc, 1);
	}

    $tabla='
        <table class="table table-bordered" style="width: 100%; font-size:10px; text-align:left;" border="1">
  <tr>
    <td><b>Fecha:</b></td>
    <td colspan="3">'.$fecha_doc.'</td>
    <td style="text-align:center; width: 23%;" colspan="2" rowspan="3">'.$img.'</td>
 </tr>
 <tr>
    <td style="width: 18%;"><b>Asunto:</b></td>
    <td style="width: 18%;">'.$datos_vincular_doc[0]["asunto"].'</td>
    <td><b>Serie:</b></td>
    <td>'.$serie[0]["nombre"].' - '.$tipo_documento[0]["nombre"].'.</td>
  </tr>
 <tr>
    <td style="width: 18%;"><b>Anexo:</b></td>
    <td style="width: 18%;">'.ver_anexos_doc_vincu($idformato,$iddoc).'</td>
    <td><b>Observaciones:</b></td>
    <td>'.$datos_vincular_doc[0]["observaciones"].'</td>
  </tr>
  </table>';
    echo $tabla;

}
function cargar_serie_documental($idformato,$iddoc){
	global $conn;
	/*
	$idex=$_REQUEST["idexpediente"];
	$expedientes=busca_filtro_tabla("idserie","expediente e, serie s","e.serie_idserie = s.cod_padre and idexpediente=".$idex,"",$conn);
	?>
	<script>
		$(document).ready(function(){
			var serie = "<?php echo $expedientes[0]["idserie"]?>";
			tree_serie_idserie.setOnLoadingEnd(function(){
				tree_serie_idserie.setCheck(serie,true);
			});
			$("#serie_idserie").val(serie);
		});
	</script>
	 * */
}
?>
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
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones_formatos_generales.php");

/*ADICIONAR - EDITAR*/
function add_edit_control_documentos($idformato, $iddoc){
	global $conn, $ruta_db_superior;
	$cf_versionador_calidad = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "estado=1 AND tipo_cargo=2 AND lower(cargo) LIKE 'aprobador%calidad'", "", $conn);
	if(!$cf_versionador_calidad["numcampos"]){
		notificaciones("<b>Antes de continuar por favor asignar el cargo: Aprobador de Calidad.</b>", "error", 8500);
		redirecciona($ruta_db_superior."vacio.php");
		die();
	}
	
	$inicio_version = busca_filtro_tabla("valor", "configuracion", "nombre='inicio_version_calidad' and tipo='proceso_calidad'", "", $conn);
	if(!$inicio_version["numcampos"]){
		notificaciones("<b>Antes de continuar por favor configurar el numero desde donde iniciara la version.</b>", "error", 8500);
		redirecciona($ruta_db_superior."vacio.php");
		die();
	}else if($inicio_version[0]["valor"]!=1 && $inicio_version[0]["valor"]!=0){
		notificaciones("<b>El numero de inicio de version debe ser 1 o 0</b>", "error", 8500);
		redirecciona($ruta_db_superior."vacio.php");
		die();
	}
	if ($_REQUEST["iddoc"]) {
		notificaciones("<b>Si el Proceso/Subproceso es cambiado los items generados hasta el momento para elaboracion/eliminacion seran seran eliminados</b>", "alert", 10000);
		$opt = 1;
		$documento_calidad = busca_filtro_tabla("documento_calidad,listado_procesos", "ft_control_documentos", "documento_iddocumento=" . $_REQUEST["iddoc"], "", $conn);
	} else {
		$opt = 0;
	}
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			var opt=parseInt(<?php echo $opt;?>);
	    $("#version").keyup(function() {
	        this.value = (this.value + '').replace(/[^0-9]/g, '');
	    });
			function cargar_arbol_calidad(){
				if(opt){
					documento_calidad="<?php echo($documento_calidad[0]["documento_calidad"]); ?>";
				}else{
					documento_calidad=0;
				}
				if($("[name='tipo_documento']:checked").val() == 1){
					documento = 10;
				}else{
					documento = $("[name='otros_documentos']:checked").val(); 
				}
				proceso=$("#listado_procesos").val();
				if(proceso==""){
					proceso = 0;
				}
				tree_documento_calidad.deleteChildItems(0);					
				tree_documento_calidad.loadXML("<?php echo($ruta_db_superior); ?>formatos/control_documentos/test_documentos_calidad.php?tipo_solicitud=2&origen_documento=2&documento="+documento+"&proceso="+proceso+"&seleccionado="+documento_calidad);
			}
			
			$("[name='tipo_solicitud']").change(function() {
				if ($(this).val() !=2) {
					$("[name='otros_documentos'],#serie_doc_control,[name='almacenamiento[]'],#nombre_documento,#documento_calidad,[name='anexo_formato[]']").removeClass("required");
					$("#tr_otros_documentos,#tr_tipo_documento,#tr_serie_doc_control,#tr_almacenamiento,#tr_nombre_documento,#tr_documento_calidad,#tr_anexo_formato").hide();
				}else {
					$("[name='tipo_documento'],#nombre_documento,#documento_calidad,[name='anexo_formato[]']").addClass("required");
					$("#tr_tipo_documento,#tr_nombre_documento,#tr_documento_calidad,#tr_anexo_formato").show();
					$("[name='tipo_documento']:checked").trigger("change");					
				}
			});
			$("[name='tipo_solicitud']:checked").trigger("change");

			$("[name='tipo_documento']").change(function() {
				if($("[name='tipo_solicitud']:checked").val()==2){
					if ($(this).val() == 1) {
						$("#tr_otros_documentos").hide();
						$("[name='otros_documentos']").removeClass('required');
						$("#tr_serie_doc_control,#tr_almacenamiento").show();
						$("#serie_doc_control,[name='almacenamiento[]']").addClass('required');
					} else {
						$("#tr_otros_documentos").show();
						$("[name='otros_documentos']").addClass('required');
						
						$("#tr_serie_doc_control,#tr_almacenamiento").hide();
						$("#serie_doc_control,[name='almacenamiento[]']").removeClass('required');
						
						tree_serie_doc_control.setCheck($("#serie_doc_control").val(),false);
						$("#serie_doc_control").val("");
						$("[name='almacenamiento[]']").attr("checked",false);
					}
					cargar_arbol_calidad();
				}
			});
			$("[name='tipo_documento']:checked").trigger("change");
			
			$("[name='otros_documentos']").change(function(){
				if($("[name='tipo_solicitud']:checked").val()==2){
					cargar_arbol_calidad();
				}
			});
			//$("[name='otros_documentos']:checked").trigger("change");
			
			$("#listado_procesos").change(function(){	
				if($("[name='tipo_solicitud']:checked").val()==2){	
					cargar_arbol_calidad();			
				}
			});
		
		}); 
	</script>
	<?php
}

/*POSTERIOR ADICIONAR*/
function post_add_ruta_control_documentos($idformato, $iddoc) {
	$funcionarios = busca_filtro_tabla("revisado,aprobado", "ft_control_documentos", "documento_iddocumento=" . $iddoc, "", $conn);
	if ($funcionarios["numcampos"]) {
		$ruta = array();
		if ($funcionarios[0]['revisado'] != "") {
			array_push($ruta, array("funcionario" => $funcionarios[0]['revisado'], "tipo_firma" => 1, "tipo" => 5));
		}
		if ($funcionarios[0]['aprobado']) {
			array_push($ruta, array("funcionario" => $funcionarios[0]['aprobado'], "tipo_firma" => 1, "tipo" => 5));
		}
	}

	//CARGO_FUNCIONAL (aprobador calidad)
	$cf_versionador_calidad = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "estado=1 AND tipo_cargo=2 AND lower(cargo) LIKE 'aprobador%calidad'", "", $conn);
	if ($cf_versionador_calidad["numcampos"]) {
		array_push($ruta, array("funcionario" => $cf_versionador_calidad[0]['funcionario_codigo'], "tipo_firma" => 2));
	}
	if (count($ruta) > 0) {
		insertar_ruta($ruta, $iddoc, 0);
	}
	return;
}

/*ANTERIOR EDITAR*/
function ant_edit_control_documentos($idformato, $iddoc){
	if(isset($_REQUEST["listado_procesos"])){
		$datos=busca_filtro_tabla("listado_procesos,idft_control_documentos,tipo_solicitud","ft_control_documentos","documento_iddocumento=".$iddoc,"",$conn);
		if($datos[0]["listado_procesos"]!=$_REQUEST["listado_procesos"] || $datos[0]["tipo_solicitud"]==2){
			$items=busca_filtro_tabla("d.iddocumento","ft_item_control_versio ft,documento d","d.iddocumento=ft.documento_iddocumento and d.estado not in ('ELIMINADO') and ft.ft_control_documentos=".$datos[0]["idft_control_documentos"],"",$conn);
			if($items["numcampos"]){
				$iddocs_elimi=extrae_campo($items,"iddocumento");
				$update="UPDATE documento SET estado='ELIMINADO' WHERE iddocumento in (".implode(",", $iddocs_elimi).")";
				phpmkr_query($update);
			}
		}
	}
	return;
}

/*MOSTRAR*/
function cargar_info_control_documentos($idformato, $iddoc) {
	global $conn, $datos;
	$datos = busca_filtro_tabla("ft.*,d.estado,d.numero,d.ejecutor," . fecha_db_obtener("d.fecha", "Y-m-d") . " as fecha_aprob", "ft_control_documentos ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.iddocumento=" . $iddoc, "", $conn);
}

function obtener_numero_solicitud($idformato, $iddoc) {
	global $datos;
	echo($datos[0]['numero']);
}

function obtener_nombre_solicitante($idformato, $iddoc) {
	global $conn, $datos;
	$html = "";
	$funcionario = busca_filtro_tabla("b.nombres, b.apellidos", "funcionario b", "funcionario_codigo='" . $datos[0]["ejecutor"] . "'", "", $conn);
	if ($funcionario["numcampos"]) {
		$html = ucwords(strtolower($funcionario[0]['nombres'] . ' ' . $funcionario[0]['apellidos']));
	}
	echo $html;
}

function obtener_fecha_solicitud_control_documento($idformato, $iddoc) {
	global $datos;
	$fecha = date_parse($datos[0]['fecha_aprob']);
	echo $fecha['day'] . ' ' . ucwords(obtener_mes_letra($fecha['month'])) . ' ' . $fecha['year'];
}

function ver_datos_control_doc($idformato, $iddoc) {
	global $conn, $datos;
	$html = "";
	if ($datos[0]["tipo_solicitud"] == 2) {
		$exp_doc = explode("|", $datos[0]["documento_calidad"]);
		$datos_formato = array("idformato" => $exp_doc[0], "iddocumento" => $exp_doc[1]);

		$etiqueta = "";
		$formato = busca_filtro_tabla("nombre, nombre_tabla", "formato", "idformato=" . $datos_formato['idformato'], "", $conn);
		if ($formato["numcampos"]) {
			$etiqueta = $formato[0]["nombre"];
			if ($datos_formato['iddocumento']) {
				$documento = busca_filtro_tabla("nombre", $formato[0]["nombre_tabla"] . " a", "a.documento_iddocumento=" . $datos_formato["iddocumento"], "", $conn);
				if ($documento["numcampos"]) {
					$etiqueta .= "/" . $documento[0]["nombre"];
				}
			}
		}
		$version = "Pasa de la versi&oacute;n PENDIENTE a la versi&oacute;n PENDIENTE 2";
		$html = "</td></tr>
		<tr>
			<td><strong>Documento de calidad Vinculado:</strong></td>
			<td>&nbsp;" . $etiqueta . "</td>
		</tr>
		<tr>
			<td><strong>Versi&oacute;n:</strong></td>
			<td>&nbsp;" . $version;
	}
	echo $html;
}

function confirmar_control_documentos($idformato, $iddoc) {
	global $conn, $ruta_db_superior, $datos;
	$html="";
	if ($datos[0]["fecha_confirmacion"]) {
		$html = "<br/><span style='font-size:12pt;'>FECHA DE TRAMITE Y VIGENCIA DEL DOCUMENTO : " . $datos[0]["fecha_confirmacion"] . "<br />";
		$html .= "Solicitud procesada satisfactoriamente, por favor socializar con los involucrados en el proceso.</span>";
	}else	if ($_REQUEST["tipo"] != 5) {
		$funcionario = array();
		$responsables = busca_filtro_tabla("destino", "buzon_entrada", "nombre ='POR_APROBAR' and archivo_idarchivo=" . $iddoc, "", $conn);
		if ($responsables["numcampos"]) {
			for ($i = 0; $i < $responsables["numcampos"]; $i++) {
				$funcionario[] = $responsables[$i]["destino"];
			}
		}
		//CARGO_FUNCIONAL (aprobador calidad)
		$cf_versionador_calidad = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "estado=1 AND tipo_cargo=2 AND lower(cargo) LIKE 'aprobador%calidad'", "", $conn);
		if ($cf_versionador_calidad["numcampos"]) {
			for ($i = 0; $i < $cf_versionador_calidad["numcampos"]; $i++) {
				$funcionario[] = $cf_versionador_calidad[$i]["funcionario_codigo"];
			}
		}else{
			notificaciones("<b>Actualmente NO existen funcionarios con el cargo: Aprobador de Calidad.</b>", "error", 8500);
		}

		if (in_array($_SESSION["usuario_actual"], $funcionario) && $datos[0]["estado"] == "ACTIVO") {
			$html = "<br/><button class='btn btn-small btn-info dropdown-toggle' id='btn_editar'>Editar</button>";
		} else if ($datos[0]["estado"] == "APROBADO" && !$datos[0]["fecha_confirmacion"]) {
			if ($_SESSION["usuario_actual"] == $cf_versionador_calidad[0]['funcionario_codigo']) {
				$html = "<br/><button class='btn btn-small btn-success' id='confirmar_cambios'>Aprobaci&oacute;n de la Solicitud</button>";
			}
		}
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#editar_ruta").hide();
			$("#confirmar_cambios").click(function(){
				$(this).attr("disabled",true);
				top.noty({text:"Por favor espere hasta que se actualicen los datos", type:"warning", layout:"topCenter", timeout:3500});
				var ruta = "<?php echo($ruta_db_superior); ?>formatos/control_documentos/mostrar_control_documentos.php?activar_accion=1&iddoc=<?php echo($iddoc); ?>&idformato=<?php echo($idformato); ?>";			
				window.location=ruta;
			});
			
			$("#btn_editar").click(function(){
				var ruta = "<?php echo($ruta_db_superior); ?>formatos/control_documentos/editar_control_documentos.php?iddoc=<?php echo($iddoc); ?>&idformato=<?php echo($idformato); ?>";			
				window.location=ruta;
			});
		});
	</script>
	<?php
	}
	echo $html;
}


function mostrar_items_control_version($idformato, $iddoc) {
	global $conn, $ruta_db_superior, $datos;
	if($datos[0]["tipo_solicitud"]!=2){
		$formato_hijo = busca_filtro_tabla("", "formato", "nombre='item_control_versio'", "", $conn);
		$html = "";
		$parte_td="";
		if (@$_REQUEST["tipo"] != 5 && $datos[0]["estado"] == 'ACTIVO') {
			$html .= '<a href="' . $ruta_db_superior . 'formatos/' . $formato_hijo[0]["nombre"] . '/' . $formato_hijo[0]["ruta_adicionar"] . '?anterior=' . $iddoc . '&idformato=' . $formato_hijo[0]["idformato"] . '&padre=' . $datos[0]["idft_control_documentos"] . '">Adicionar Documentos</a>';
			$parte_td = "<td>&nbsp;</td>";
		}
		if($datos[0]["tipo_solicitud"]==1){
			$parte_td.= "<td>&nbsp;</td>";
		}
		$item = busca_filtro_tabla("documento_calidad_i,nombre_documento_i,origen_documento_i,iddocumento,iddocumento_calidad_i", $formato_hijo[0]["nombre_tabla"] . " ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.estado not in ('ELIMINADO','ANULADO','ACTIVO') and ft.ft_control_documentos=" . $datos[0]["idft_control_documentos"], "id" . $formato_hijo[0]["nombre_tabla"], $conn);
		if ($item["numcampos"]) {
			$html .= '<table style="width:100%;border-collapse:collapse" border="1">';
			$html .= '<tr> <td style="font-weight:bold;text-align:center">NOMBRE</td> <td style="font-weight:bold;text-align:center">ORIGEN DOCUMENTO</td>' . $parte_td . ' </tr>';
			$origen=array(1=>"Externo",2=>"Interno");
			for ($i = 0; $i < $item["numcampos"]; $i++) {
				$html .= '<tr>';
				$nombre = "";
				$doc_calidad = explode("|", $item[$i]["documento_calidad_i"]);
				if ($doc_calidad[0]) {
					$formato = busca_filtro_tabla("etiqueta, nombre_tabla", "formato", "idformato=" . $doc_calidad[0], "", $conn);
					if ($formato["numcampos"]) {
						$nombre .= ucwords($formato[0]["etiqueta"]);
						if ($doc_calidad[1]) {
							$documento = busca_filtro_tabla("nombre", $formato[0]["nombre_tabla"] . " a", "a.documento_iddocumento=" . $doc_calidad[1], "", $conn);
							if ($documento["numcampos"]) {
								$nombre .= "/" . $documento[0]["nombre"];
							}
						} else if ($datos[0]["tipo_solicitud"] == 1) {
							$nombre .= "/" . $item[$i]["nombre_documento_i"];
						}
					}
				}
				$html .= '<td>' . $nombre . '</td>';
				$html .= '<td>' . $origen[$item[$i]["origen_documento_i"]] . '</td>';
				
				if($datos[0]["tipo_solicitud"]==1){
					if($item[$i]["iddocumento_calidad_i"]){
						$exp=explode("|", $item[$i]["documento_calidad_i"]);
						if($exp[0]){
							$info_formato=busca_filtro_tabla("nombre","formato","idformato=".$exp[0],"",$conn);
							$html .= "<td><a href='".$ruta_db_superior."formatos/".$info_formato[0]["nombre"]."/mostrar_".$info_formato[0]["nombre"].".php?menu_principal_inactivo=1&idformato=".$exp[0]."&iddoc=".$item[$i]["iddocumento_calidad_i"]."' class='highslide' onclick='return top.hs.htmlExpand(this, { objectType: \"iframe\",width:830, height:680,preserveContent:false } )' style='text-decoration: underline; cursor:pointer;'>Ver</a></td>";
						}else{
							$html .= "<td><a href='".$ruta_db_superior."ordenar.php?mostrar_formato=1&key=".$item[$i]["iddocumento_calidad_i"]."' class='highslide' onclick='return top.hs.htmlExpand(this, { objectType: \"iframe\",width:830, height:680,preserveContent:false } )' style='text-decoration: underline; cursor:pointer;'>Ver</a></td>";
						}
					}else{
						$html .= '<td>PENDIENTE</td>';
					}
				}

				if (@$_REQUEST["tipo"] != 5 && $datos[0]["estado"] == 'ACTIVO') {
					$html .= "<td style='text-align:center'><button class='btn btn-mini btn-danger' iddoc='".$item[$i]["iddocumento"]."'>X</button></td>";
				}
				$html .= '</tr>';
			}
			$html .= '</table>';
		}
		echo($html);
		if($_REQUEST["tipo"]!=5){
			?>
			<script>
				$(document).ready(function (){
					$(".btn-danger").click(function (){
						if(confirm("Esta seguro de Eliminar?")===true){
							iddoc=$(this).attr("iddoc");
					    $.ajax({
					    	url : 'ajax_control_documento.php',
					    	data:{iddoc_item:iddoc,opt:1},
					    	type : 'post',
					    	dataType:'json',
					    	async:false,
					    	success : function(data) {
					    		if(data.exito==1){
					    			top.noty({text:"Se ha eliminado el documento", type:"success", layout:"topCenter", timeout:3500});
					    		}else{
					    			top.noty({text:data.msn, type:"error", layout:"topCenter", timeout:3500});
					    		}
					    		if(window.parent.frames["arbol_formato"]!==undefined){
					    			window.parent.frames["arbol_formato"].location.href=window.parent.frames["arbol_formato"].location.pathname+"?idformato=<?php echo $idformato;?>&iddoc=<?php echo $iddoc;?>";
					    		}else{
					    			window.location.reload();
					    		}
					    	},error:function (){
					    		top.noty({text:'Error al procesar la peticion', type:"error", layout:"topCenter", timeout:3500});
					    	}
					    });
						}
					});
				});
			</script>
			<?php
		}
	}
}

/*ANTERIOR AL CONFIRMAR*/
function ant_confir_control_documentos($idformato, $iddoc){
	global $conn,$ruta_db_superior;
	$datos=busca_filtro_tabla("tipo_solicitud,idft_control_documentos","ft_control_documentos c","documento_iddocumento=".$iddoc,"",$conn);
	if($datos["numcampos"]){
		if($datos[0]["tipo_solicitud"]!=2){
			$item=busca_filtro_tabla("documento_iddocumento","ft_item_control_versio i,documento d","d.iddocumento=i.documento_iddocumento and d.estado not in ('ELIMINADO','ANULADO') and i.ft_control_documentos=".$datos[0]["idft_control_documentos"],"",$conn);
			if(!$item["numcampos"]){
				notificaciones("<b>Por favor adicione los documentos.</b>", "warning", 8500);
				redirecciona($ruta_db_superior."formatos/control_documentos/mostrar_control_documentos.php?iddoc=".$iddoc."&idformato=".$idformato);
			}
		}
	}else{
		notificaciones("<b>No se encuentra datos del documento.</b>", "error", 8500);
		redirecciona($ruta_db_superior."vacio.php");
	}
	return;
}


/*ANTERIOR APROBAR*/
function ant_aprob_control_documentos($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$control_documento = busca_filtro_tabla("tipo_solicitud,documento_calidad,idft_control_documentos", "ft_control_documentos", "documento_iddocumento=" . $iddoc, "", $conn);
	if ($control_documento["numcampos"]) {
		if ($control_documento[0]["tipo_solicitud"] == 1) {
			$item = busca_filtro_tabla("i.documento_calidad_i,version_i,origen_documento_i,d.iddocumento", "ft_item_control_versio i,documento d", "d.iddocumento=i.documento_iddocumento and d.estado not in ('ELIMINADO','ANULADO','ACTIVO') and i.ft_control_documentos=" . $control_documento[0]["idft_control_documentos"], "", $conn);
			$inicio_version = busca_filtro_tabla("valor", "configuracion", "nombre='inicio_version_calidad' and tipo='proceso_calidad'", "", $conn);
			for ($i = 0; $i < $item["numcampos"]; $i++) {
				if ($item[$i]["origen_documento_i"] == 2) {
					$exp = explode("|", $item[$i]["documento_calidad_i"]);
					$datos_formato = array("idformato" => $exp[0], "iddocumento" => $exp[1]);
					if ($inicio_version["numcampos"] && ($inicio_version[0]["valor"] == 1 || $inicio_version[0]["valor"] == 0)) {
						$version = $inicio_version[0]["valor"];
					} else {
						$version = 0;
					}
					$update_version = "UPDATE ft_item_control_versio SET version_i='" . $version . "' WHERE documento_iddocumento=" . $item[$i]["iddocumento"];
					phpmkr_query($update_version);
				}
			}

		} else if ($control_documento[0]["tipo_solicitud"] == 2) {
			$exp = explode("|", $control_documento[0]["documento_calidad"]);
			if ($exp[1]) {
				$update = "update ft_control_documentos set iddocumento_calidad=" . $exp[1] . ", idformato_calidad=" . $exp[0] . " where documento_iddocumento =" . $iddoc;
				phpmkr_query($update);

				$version = busca_filtro_tabla("b.numero_version", "documento a , documento_version b", "a.iddocumento  =b.documento_iddocumento and a.iddocumento=" . $exp[1], "numero_version desc", $conn);
				if ($version[0]["numero_version"]) {
					$numero_version = intval($version[0]["numero_version"]) + 1;
				} else {
					$numero_version = 1;
				}
				$update_version = "UPDATE ft_control_documentos SET version='" . $numero_version . "' WHERE documento_iddocumento=" . $iddoc;
				phpmkr_query($update_version);
			} else {
				notificaciones("<b>No se encuentra el documento de calidad vinculado.</b>", "warning", 8500);
				redirecciona($ruta_db_superior . "formatos/control_documentos/mostrar_control_documentos.php?iddoc=" . $iddoc . "&idformato=" . $idformato);
				die();
			}
		}else {
			$item = busca_filtro_tabla("i.documento_calidad_i,idft_item_control_versio", "ft_item_control_versio i,documento d", "d.iddocumento=i.documento_iddocumento and d.estado not in ('ELIMINADO','ANULADO','ACTIVO') and i.ft_control_documentos=" . $control_documento[0]["idft_control_documentos"], "", $conn);
			for ($i=0; $i <$item["numcampos"] ; $i++) {
				$exp = explode("|", $item[0]["documento_calidad_i"]); 
				$update = "update ft_item_control_versio set iddocumento_calidad_i=" . $exp[1] . " where idft_item_control_versio =" . $item[$i]["idft_item_control_versio"];
				phpmkr_query($update);
			}
		}
	} else {
		notificaciones("<b>No se encuentra informacion del documento.</b>", "warning", 8500);
		redirecciona($ruta_db_superior . "formatos/control_documentos/mostrar_control_documentos.php?iddoc=" . $iddoc . "&idformato=" . $idformato);
		die();
	}
	return;
}

function generar_documentos_version($idformato, $iddoc){
	global $conn,$ruta_db_superior;
	if($_REQUEST["activar_accion"]==1){
		if($_REQUEST["tipo"]!=5){
			?>
			<script>
			$(document).ready(function (){
				$("#confirmar_cambios").hide();
			});
			</script>
			<?php
		}
		$info_retorno=aprobar_control_documentos($_REQUEST["idformato"],$_REQUEST["iddoc"]);
		if($info_retorno["exito"]){
			$update="UPDATE ft_control_documentos SET fecha_confirmacion=".fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s")." WHERE documento_iddocumento=".$iddoc;
			phpmkr_query($update);
			
			notificaciones("Datos actualizados con Exito!", "success", 8500);
			redirecciona($ruta_db_superior."formatos/control_documentos/mostrar_control_documentos.php?iddoc=".$iddoc."&idformato=".$idformato);
			die();
		}else{
			$html='<h5 style="text-align:center;color:red;">Se presentaron las siguientes problemas:</h5>';
			$html.="<ul>";
			if(count($info_retorno["errores"])){
				$html.=implode($info_retorno["errores"]);
			}
			if(count($info_retorno["errores_version"])){
				$html.=implode($info_retorno["errores_version"]);
			}
			$html.="</ul>";
			echo $html;
		}
	}
}

function aprobar_control_documentos($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	include_once ($ruta_db_superior . "class_transferencia.php");
	include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");

	$control_documento = busca_filtro_tabla("a.tipo_solicitud,a.listado_procesos,a.documento_calidad,a.nombre_documento,a.version,a.secretaria,a.iddocumento_calidad,a.idformato_calidad,idft_control_documentos", "ft_control_documentos a, documento b ", "a.documento_iddocumento=b.iddocumento and a.documento_iddocumento=" . $iddoc, "", $conn);
	$datos_retorno = array("exito" => 0);
	if ($control_documento["numcampos"]) {
		$proceso = busca_filtro_tabla("a.nombre, a.idft_proceso as idft_tabla, lower(c.nombre_tabla) AS nombre_tabla, c.idformato,b.iddocumento", "ft_proceso a, documento b, formato c", "a.documento_iddocumento=b.iddocumento AND lower(b.plantilla) like(lower(c.nombre)) and a.idft_proceso=" . $control_documento[0]["listado_procesos"], "", $conn);
		if ($proceso["numcampos"]) {
			$errores = array();
			$errores_version = array();
			$datos_session = "&LOGIN=" . $_SESSION["LOGIN" . LLAVE_SAIA] . "&usuario_actual=" . $_SESSION["usuario_actual"] . "&LLAVE_SAIA=" . LLAVE_SAIA;
			switch($control_documento[0]["tipo_solicitud"]) {
				case 1 :
					$item = busca_filtro_tabla("i.*", "ft_item_control_versio i,documento d", "d.iddocumento=i.documento_iddocumento and d.estado not in ('ELIMINADO','ANULADO','ACTIVO') and i.ft_control_documentos=" . $control_documento[0]["idft_control_documentos"], "", $conn);
					$creador = busca_filtro_tabla("funcionario_codigo,iddependencia_cargo", "vfuncionario_dc", "estado=1 and estado_dc=1 and tipo_cargo=1 and funcionario_codigo='" . $_SESSION["usuario_actual"] . "'", "", $conn);
					for ($i = 0; $i < $item["numcampos"]; $i++) {
						unset($_REQUEST);
						$url = "";
						$error = 0;
						if ($item[$i]["iddocumento_calidad_i"] != "" && $item[$i]["iddocumento_calidad_i"] != 0) {
							$url = PROTOCOLO_CONEXION . RUTA_PDF . "/versionamiento/versionar_documentos.php?no_redirecciona=1&iddocumento=" . $item[$i]["iddocumento_calidad_i"] . "&tipo_versionamiento=1&version_numero=" . $item[$i]["version_i"] . "&iddocumento_anexo=" . $item[$i]["documento_iddocumento"] . "&funcionario_codigo=" . $_SESSION["usuario_actual"];
						} else {
							$exp = explode("|", $item[$i]["documento_calidad_i"]);
							$info_formato = busca_filtro_tabla("a.idformato,a.nombre as formato, a.nombre_tabla as tabla,a.contador_idcontador,a.etiqueta", "formato a", "a.idformato=" . $exp[0], "", $conn);
							if ($info_formato['numcampos']) {
								$contador = busca_filtro_tabla("nombre", "contador", "idcontador=" . $info_formato[0]["contador_idcontador"], "", $conn);
								if ($contador["numcampos"]) {
									$campos = array();
									$campos_descrip = busca_filtro_tabla("idcampos_formato", "formato f, campos_formato cf", "f.idformato=" . $exp[0] . " AND f.idformato=cf.formato_idformato AND (acciones like 'p' or acciones like '%,p' or acciones like 'p,%' or acciones like '%,p,%')", "", $conn);
									if ($campos_descrip["numcampos"]) {
										$campos = extrae_campo($campos_descrip, "idcampos_formato");
									}
									$_REQUEST["encabezado"] = 1;
									$_REQUEST["firma"] = 1;
									$_REQUEST["funcion"] = "radicar_plantilla";

									$_REQUEST["dependencia"] = $creador[0]["iddependencia_cargo"];
									$_REQUEST["campo_descripcion"] = implode(",", $campos);
									$_REQUEST["tipo_radicado"] = $contador[0]["nombre"];
									$_REQUEST["tabla"] = $info_formato[0]["tabla"];
									$_REQUEST["formato"] = $info_formato[0]["formato"];
									$_REQUEST["idformato"] = $info_formato[0]["idformato"];
									$_REQUEST["ejecutor"] = $creador[0]["funcionario_codigo"];
									$_REQUEST['nombre'] = $item[$i]["nombre_documento_i"];
									$_REQUEST["secretarias"] = $control_documento[0]["secretaria"];
									$_REQUEST["origen_documento"] = $item[$i]["origen_documento_i"];

									$_REQUEST["estado"] = "ELABORACION";
									$_REQUEST["anterior"] = $proceso[0]["iddocumento"];

									$_POST = $_REQUEST;
									$_REQUEST["no_redirecciona"] = 1;
									$_REQUEST["webservie_aprob_doc"] = 1;

									$iddocumento = radicar_plantilla();
									if ($iddocumento == 0 || $iddocumento == "" || !$iddocumento) {
										$errores[] = "<li>Error al Guardar la informacion-iddoc (" . $item[$i]["nombre_documento_i"] . ")</li>";
										$error = 1;
									} else {
										$documento = busca_filtro_tabla("B.iddocumento", $info_formato[0]["tabla"] . " A,documento B", "A.documento_iddocumento=B.iddocumento AND A.documento_iddocumento=" . $iddocumento, "", $conn);
										if ($documento["numcampos"]) {
											$datos_documento = obtener_datos_documento($iddocumento);
											crear_pdf_documento_tcpdf($datos_documento);

											$update_documento_creado = "UPDATE ft_item_control_versio SET iddocumento_calidad_i=" . $iddocumento . " WHERE documento_iddocumento=" . $item[$i]["documento_iddocumento"];
											phpmkr_query($update_documento_creado);

											$formato_ruta = aplicar_plantilla_ruta_documento($iddocumento);
											$ruta_archivos = ruta_almacenamiento("archivos");
											$ruta_anexos = $ruta_archivos . $formato_ruta . "/anexos";
											if (!is_dir($ruta_anexos)) {
												if (!crear_destino($ruta_anexos)) {
													$errores[] = "<li>Error al crear la carpeta del anexo (" . $item[$i]["nombre_documento_i"] . ")</li>";
													$error = 1;
												}
											}

											$anexos = busca_filtro_tabla("ruta,tipo,etiqueta,idanexos", "anexos", "documento_iddocumento=" . $item[$i]["documento_iddocumento"], "", $conn);
											if ($anexos["numcampos"]) {
												$array_anexos = array();
												for ($j = 0; $j < $anexos["numcampos"]; $j++) {
													$nombre_anexo = explode("/", $anexos[$j]['ruta']);
													$nombre_anexo = $nombre_anexo[count($nombre_anexo) - 1];

													$ruta_origen = $ruta_db_superior . $anexos[$j]['ruta'];
													$ruta_destino = $ruta_anexos . "/" . $nombre_anexo;

													if (!copy($ruta_origen, $ruta_destino)) {
														$errores[] = "<li>Error al pasar el anexo (" . $item[$i]["nombre_documento_i"] . ")</li>";
														$error = 1;
													} else {
														$ruta_alm = substr($ruta_destino, strlen($ruta_db_superior));
														$sql_anexo = "INSERT INTO anexos(documento_iddocumento, ruta, tipo, etiqueta, formato, fecha_anexo) VALUES(" . $iddocumento . ",'" . $ruta_alm . "','" . $anexos[$j]['tipo'] . "','" . $anexos[$j]['etiqueta'] . "'," . $exp[0] . "," . fecha_db_almacenar(date("Y-m-d"), "Y-m-d") . ")";
														phpmkr_query($sql_anexo);
														$idanexo = phpmkr_insert_id();
														$array_anexos[] = $idanexo;

														if (!$idanexo) {
															$errores[] = "<li>Error al registrar el anexo (" . $item[$i]["nombre_documento_i"] . ")</li>";
															$error = 1;
														} else {
															$permiso_anexo = busca_filtro_tabla("", "permiso_anexo", "anexos_idanexos=" . $anexos[$j]["idanexos"], "", $conn);
															if ($permiso_anexo["numcampos"]) {
																$sql_permiso_anexo = "INSERT INTO permiso_anexo(anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_dependencia, caracteristica_cargo, caracteristica_total) VALUES(" . $idanexo . ",'" . $permiso_anexo[0]['idpropietario'] . "','" . $permiso_anexo[0]['caracteristica_propio'] . "','" . $permiso_anexo[0]['caracteristica_dependencia'] . "','" . $permiso_anexo[0]['caracteristica_cargo'] . "','" . $permiso_anexo[0]["caracteristica_total"] . "')";
																phpmkr_query($sql_permiso_anexo);
																$idpermiso_anexo = phpmkr_insert_id();

																if (!$idpermiso_anexo) {
																	$errores[] = "<li>Error al registrar los permisos anexo (" . $item[$i]["nombre_documento_i"] . ")</li>";
																	$error = 1;
																}
															}
														}
													}
												}
												if (!count($array_anexos)) {
													$errores[] = "<li>No se adicionaron los anexo (" . $item[$i]["nombre_documento_i"] . ")</li>";
													$error = 1;
												}
											}
											$url = PROTOCOLO_CONEXION . RUTA_PDF . "/versionamiento/versionar_documentos.php?no_redirecciona=1&iddocumento=" . $iddocumento . "&tipo_versionamiento=1&version_numero=" . $item[$i]["version_i"] . "&iddocumento_anexo=" . $item[$i]["documento_iddocumento"] . "&funcionario_codigo=" . $_SESSION["usuario_actual"];
										} else {
											$update_est = "UPDATE documento SET estado='ELIMINADO' WHERE iddocumento=" . $iddocumento;
											phpmkr_query($update_est);

											$errores[] = "<li>NO se creo el documento (" . $item[$i]["nombre_documento_i"] . ")</li>";
											$error = 1;
										}
									}
								} else {
									$errores[] = "<li>El tipo de radicado NO esta definido para el formato: " . $info_formato[0]["etiqueta"] . "(" . $item[$i]["nombre_documento_i"] . ")</li>";
									$error = 1;
								}
							} else {
								$errores[] = "<li>No se puede encontrar el formato a ser creado (" . $item[$i]["nombre_documento_i"] . ")</li>";
								$error = 1;
							}
						}

						if ($url && $error == 0) {
							$ch = curl_init();
							$url = $url . $datos_session;
							curl_setopt($ch, CURLOPT_URL, $url);
							curl_setopt($ch, CURLOPT_HEADER, 0);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							$response = curl_exec($ch);
							curl_close($ch);
							$retorno = json_decode($response, true);
							if ($retorno["exito"]) {
								$update = "update ft_item_control_versio set estado_doc_calidad_i=1,fecha_confirmacion_i=" . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . " where documento_iddocumento=" . $item[$i]["documento_iddocumento"];
								phpmkr_query($update);

								if ($retorno["exito"] == 2) {
									$errores_version[] = "<li>Se versiono el documento pero se presento el siguiente error (" . $item[$i]["nombre_documento_i"] . "): " . $retorno["msn2"] . "</li>";
								}
							} else {
								$errores_version[] = "<li>(" . $item[$i]["nombre_documento_i"] . "): " . $retorno["msn"] . "</li>";
							}
						}
						
					}

					if (count($errores) || count($errores_version)) {
						if (count($errores)) {
							$datos_retorno["errores"] = $errores;
						}

						if (count($errores_version)) {
							$datos_retorno["errores_version"] = $errores_version;
						}
					} else {
						$datos_retorno["exito"] = 1;
					}

					break;

				case 2 :
					$url = "";
					$errores_version = array();
					if ($control_documento[0]['iddocumento_calidad']) {
						$url = PROTOCOLO_CONEXION . RUTA_PDF . "/versionamiento/versionar_documentos.php?no_redirecciona=1&iddocumento=" . $control_documento[0]['iddocumento_calidad'] . "&iddocumento_anexo=" . $iddoc . "&tipo_versionamiento=2&nombre_documento=" . urlencode($control_documento[0]["nombre_documento"]) . "&version_numero=" . $control_documento[0]["version"] . "&funcionario_codigo=" . $_SESSION["usuario_actual"];
					} else {
						$errores_version[] = "<li>No se puede encontrar el documento a ser versionado y modificado. Favor comuniquese a sistemas</li>";
					}
					

					if ($url) {
						$ch = curl_init();
						$url = $url . $datos_session;
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_HEADER, 0);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						$response = curl_exec($ch);
						curl_close($ch);
						$retorno = json_decode($response, true);
						
						if ($retorno["exito"]) {
							$update = "UPDATE ft_control_documentos SET estado_doc_calidad=1,fecha_confirmacion=" . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . " WHERE documento_iddocumento=" . $iddoc;
							phpmkr_query($update);

							$update_it = "UPDATE ft_item_control_versio SET estado_doc_calidad_i=2 WHERE iddocumento_calidad_i=" . $control_documento[0]['iddocumento_calidad']." and estado_doc_calidad_i=1";
							phpmkr_query($update_it);
							
							$update_ft = "UPDATE ft_control_documentos SET estado_doc_calidad=2 WHERE iddocumento_calidad=" . $control_documento[0]['iddocumento_calidad']." and documento_iddocumento<>".$iddoc;
							phpmkr_query($update_ft);

							if ($retorno["exito"] == 2) {
								$errores_version[] = "<li>Se versiono el documento pero se presento el siguiente error: " . $retorno["msn2"] . "</li>";
							}
						} else {
							$errores_version[] = "<li>" . $retorno["msn"] . "</li>";
						}

					} else {
						$errores_version[] = "<li>No se puede obtener una URL valida del documento a ser modificado</li>";
					}
					if (count($errores_version)) {
						$datos_retorno["errores_version"] = $errores_version;
					} else {
						$datos_retorno["exito"] = 1;
					}
					die();
					break;

				case 3 :
					$errores_version = array();
					$item = busca_filtro_tabla("i.*", "ft_item_control_versio i,documento d", "d.iddocumento=i.documento_iddocumento and d.estado not in ('ELIMINADO','ANULADO','ACTIVO') and i.ft_control_documentos=" . $control_documento[0]["idft_control_documentos"], "", $conn);
					for ($i = 0; $i < $item["numcampos"]; $i++) {
						$url = "";
						if ($item[$i]["iddocumento_calidad_i"] != "" && $item[$i]["iddocumento_calidad_i"] != 0) {
							$url = PROTOCOLO_CONEXION . RUTA_PDF . "/versionamiento/versionar_documentos.php?no_redirecciona=1&iddocumento=" . $item[$i]["iddocumento_calidad_i"] . "&iddocumento_anexo=" . $item[$i]["documento_iddocumento"] . "&tipo_versionamiento=3&nombre_documento=" . urlencode($item[$i]["nombre_documento_i"]) . "&version_numero=" . $item[$i]["version_i"] . "&funcionario_codigo=" . $_SESSION["usuario_actual"];
						} else {
							$errores_version[] = "<li>No se puede encontrar el documento a ser versionado y modificado. Favor comuniquese a sistemas</li>";
						}
						if ($url) {
							$ch = curl_init();
							$url = $url . $datos_session;
							curl_setopt($ch, CURLOPT_URL, $url);
							curl_setopt($ch, CURLOPT_HEADER, 0);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							$response = curl_exec($ch);
							curl_close($ch);
							$retorno = json_decode($response, true);
							if ($retorno["exito"]) {
								$update = "UPDATE ft_item_control_versio SET estado_doc_calidad=2,fecha_confirmacion_i=" . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . " WHERE documento_iddocumento=" . $item[$i]["documento_iddocumento"];
								phpmkr_query($update);

								$update2 = "UPDATE ft_item_control_versio SET estado_doc_calidad=2 WHERE iddocumento_calidad_i=" . $item[$i]["iddocumento_calidad_i"]." and estado_doc_calidad_i=1";
								phpmkr_query($update2);
								
								$update_ft = "UPDATE ft_control_documentos SET estado_doc_calidad=2 WHERE iddocumento_calidad=" . $item[$i]["iddocumento_calidad_i"]." and estado_doc_calidad=1";
								phpmkr_query($update_ft);

								if ($retorno["exito"] == 2) {
									$errores_version[] = "<li>Se versiono el documento pero se presento el siguiente error: " . $retorno["msn2"] . "</li>";
								}
							} else {
								$errores_version[] = "<li>" . $retorno["msn"] . "</li>";
							}
						} else {
							$errores_version[] = "<li>No se puede obtener una URL valida del documento a ser modificado</li>";
						}
					}
					if (count($errores_version)) {
						$datos_retorno["errores_version"] = $errores_version;
					} else {
						$datos_retorno["exito"] = 1;
					}
					break;
			}
		}
	}
	return ($datos_retorno);
}


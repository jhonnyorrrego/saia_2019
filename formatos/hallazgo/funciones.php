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

include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery("1.7"));
echo(librerias_highslide());

function add_edit_hallazgo($idformato,$iddoc){
global $ruta_db_superior,$conn;
	if($_REQUEST["iddoc"]){
		$opt=1;
	}else{
		$plan=busca_filtro_tabla("estado_plan_mejoramiento,d.numero","ft_plan_mejoramiento p,documento d","d.iddocumento=p.documento_iddocumento and idft_plan_mejoramiento=".$_REQUEST["padre"],"",$conn);
		if($plan[0]["estado_plan_mejoramiento"]==3){
			notificaciones("El plan se encuentra cerrado, NO se permite realizar este formato");
			redirecciona($ruta_db_superior."vacio.php");
		}
		$hallazgo=busca_filtro_tabla("b.iddocumento","ft_hallazgo a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ANULADO') and ft_plan_mejoramiento=".$_REQUEST["padre"],"",$conn);
		$consecutivo = $hallazgo["numcampos"] +1;
		
		$opt=0;
		$gest=0;
		if($_REQUEST["gestion_calid"]!=""){
			$gest=$_REQUEST["gestion_calid"];
		}
	}
?>
<script>
	$(document).ready(function (){
		var opt=parseInt(<?php echo $opt;?>);
		$("#consecutivo_hallazgo").attr("readonly",true);
		$("#radicado_plan").attr("readonly",true);
		if(opt==0){		
			$("#consecutivo_hallazgo").val(<?php echo $consecutivo;?>);
			$("#radicado_plan").val(<?php echo $plan[0]["numero"];?>);
			var gest=parseInt(<?php echo $gest;?>);
			$("[name='ft_gestion_calid']").val(gest)
		}
		
		$("#clase_accion").change(function(){
			if(parseInt($(this).val()) == 3){
				$("#causas").parent().parent().hide();
				$("#secretarias").parent().parent().hide();				
				$("#secretarias").removeClass("required");
				$("#causas").removeClass("required");
				$("#deficiencia").removeClass("required");
			}else{
				$("#causas").parent().parent().show();
				$("#secretarias").parent().parent().show();				
				$("#secretarias").addClass("required");
				$("#deficiencia").addClass("required");
				$("#causas").addClass("required");
			}
		})
		
	});
</script>
<?php
}
	
/*POSTERIOR EDITAR*/

function notificar_edicion($idformato, $iddoc) {
	global $conn;
	$papa = busca_filtro_tabla("c.responsables,c.deficiencia,d.numero,d.ejecutor", "ft_hallazgo c,documento d", "c.documento_iddocumento=" . $iddoc . " c.documento_iddocumento=d.iddocumento and ft_plan_mejoramiento=idft_plan_mejoramiento", "", $conn);
	if ($papa["numcampos"]) {
		$mensaje = "Se ha editado un hallazgo perteneciente a un plan de mejoramiento que usted ha elaborado. Hallazgo No. " . $papa[0]["numero"] . ", Deficiencia: " . strip_tags(html_entity_decode($papa[0]["deficiencia"]));
		enviar_mensaje("", array("para" => "funcionario_codigo"), array("para" => array($papa[0]["ejecutor"])), "Se ha editado un Hallazgo", $mensaje);

		$mensaje = "Se ha editado un hallazgo del cual usted es responsable. Hallazgo No. " . $papa[0]["numero"] . ", Deficiencia: " . strip_tags(html_entity_decode($papa[0]["deficiencia"]));
		enviar_mensaje("", array("para" => "funcionario_codigo"), array("para" => explode(",", $papa[0]["responsables"])), " Se ha editado un Hallazgo", $mensaje);
	}
}

/*MOSTRAR*/
function mostrar_ft_gestion_calid_funcion($idformato,$iddoc){
	global $conn, $ruta_db_superior;
	$gestion_calidad=busca_filtro_tabla("","ft_hallazgo a, ft_gestion_calid b, documento c","a.documento_iddocumento=".$iddoc." and a.ft_gestion_calid=b.idft_gestion_calid and b.documento_iddocumento=c.iddocumento and c.estado not in('ELIMINADO', 'ANULADO')","",$conn);
	
	if($gestion_calidad["numcampos"]){
		echo "<a href='".$ruta_db_superior."ordenar.php?key=".$gestion_calidad[0]["iddocumento"]."&mostrar_formato=1' target='centro'>Gesti&oacute;n de calidad</a>";
	}
}

function detalles_padre($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$texto = "";
	include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
	if (@$idformato && @$iddoc) {
		$formato = busca_filtro_tabla("B.*,A.nombre_tabla", "formato A, campos_formato B", "A.idformato=B.formato_idformato AND B.formato_idformato=" . $idformato . " AND B.etiqueta_html ='detalle'", "B.orden ASC", $conn);
		if ($formato[0]["nombre"]) {
			$papa = busca_filtro_tabla("B.*,A.nombre_tabla", "formato A,campos_formato B", "A.idformato=B.formato_idformato AND A.nombre_tabla='" . $formato[0]["nombre"] . "' AND B.acciones LIKE '%d%'", "", $conn);
			$campos = extrae_campo($papa, "nombre", "U");
			$etiquetas = extrae_campo($papa, "etiqueta", "U");
			if ($papa["numcampos"]) {
				$hijo = busca_filtro_tabla("", $formato[0]["nombre_tabla"], "documento_iddocumento='" . $iddoc . "'", "", $conn);
				if ($hijo["numcampos"]) {
					$documento = busca_filtro_tabla(implode(",", $campos) . ",documento_iddocumento", $papa[0]["nombre_tabla"], "id" . $papa[0]["nombre_tabla"] . "=" . $hijo[0][$papa[0]["nombre_tabla"]], "", $conn);

					if ($documento["numcampos"]) {
						$texto .= '<table border="0" width="100%" class="tabla_borde">';
						for ($i = 0; $i < count($etiquetas); $i++) {

							$texto .= '<tr ><td class="encabezado" width="20%" >' . $etiquetas[$i] . '</td><td class="transparente" style="text-align: left;">' . mostrar_valor_campo($campos[$i], $papa[0]["formato_idformato"], $documento[0]["documento_iddocumento"], 1) . '</td></tr>';
						}
						$texto .= '</table>';
					}
				}
			}
		}
	}
	echo($texto);
}

function editar_hallazgo($idformato, $iddoc) {
	global $conn,$datos;
	$datos = busca_filtro_tabla("h.*,p.estado_plan_mejoramiento,d.ejecutor", "ft_hallazgo h,documento d", "documento_iddocumento=iddocumento and documento_iddocumento=" . $iddoc, "", $conn);
	if ($_REQUEST["tipo"] != 5) {
		$responsables_seguimiento = explode(",", $datos[0]["responsable_seguimiento"]);
		$responsables_hallazgo = explode(",", $datos[0]["responsables"]);
		
		if ($datos[0]["estado_plan_mejoramiento"] != 3) {
			if ($_SESSION["usuario_actual"] == $datos[0]["ejecutor"]) {
				echo '<a class="btn btn-mini btn-warning" href="#" id="link_editar">Editar Hallazgo</a>&nbsp;&nbsp;';
				echo '<a class="btn btn-mini btn-warning" href="#" id="link_eliminar">Eliminar Hallazgo</a>&nbsp;&nbsp;';
				echo '<a class="btn btn-mini btn-warning" href="#" id="link_adicionar_seg">Adicionar Seguimiento</a>';
			}			
	    ?>
	    <script>
	    $(document).ready(function() {
		   	$('#link_editar').click(function(){
		       window.location="editar_hallazgo.php?idformato=<?php echo $idformato;?>&iddoc=<?php echo $iddoc;?>";
		     })
		    $('#link_eliminar').click(function(){
		       window.location="../../documento_borrar.php?iddoc=<?php echo $iddoc;?>";
		     }) 
		    $('#link_adicionar_seg').click(function(){
		       window.location="../seguimiento/adicionar_seguimiento.php?anterior=<?php echo $iddoc;?>";
		     }) 
	    });
	    </script>
	    <?php
		}
	}
}

function procesos_vinculados_funcion($idformato,$iddoc,$informe){
	global $conn;
	$datos=busca_filtro_tabla("procesos_vinculados","ft_hallazgo a","a.documento_iddocumento=".$iddoc,"",$conn);
	$procesos=explode(",",$datos[0]["procesos_vinculados"]);
	$cant=count($procesos);
	$nombres=array();
	for($i=0;$i<$cant;$i++){
		if($procesos[$i]!=''){
			if($procesos[$i][0]!='m'){
				$proceso=busca_filtro_tabla("nombre","ft_proceso a","a.idft_proceso='".trim($procesos[$i])."'","",$conn);
				$nombres[]=$proceso[0]["nombre"];
			}else{
				$proceso=busca_filtro_tabla("nombre","ft_macroproceso_calidad a","a.idft_macroproceso_calidad='".str_replace("m","",trim($procesos[$i]))."'","",$conn);
				$nombres[]=$proceso[0]["nombre"];
			}
		}
	}
	if($informe){
		return implode(", ",$nombres);
	}else{
		echo implode(", ",$nombres);
	}
}


function modificar_responsable_mejoramiento($idformato, $iddoc){
	global $conn,$ruta_db_superior,$ok;
	if($_REQUEST["tipo"]!=5){
	$permiso=new PERMISO();
	$ok=$permiso->acceso_modulo_perfil('cambiar_responsable_hallazgos');
	if($ok){	 
		$button = "<button class='btn btn-mini btn-info' id='cambiar_responsable_mejoramiento'>Cambiar responsables</button><br /><br />";
	}
	echo($button);
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#cambiar_responsable_mejoramiento,#cambiar_responsable_seguimiento,#actualizar_programado").click(function(){
			ancho=500; alto=350;
			if($(this).attr("id")=="cambiar_responsable_mejoramiento"){
				var enlaces='<?php echo($ruta_db_superior)?>formatos/hallazgo/editar_funcionario_responsable.php?idformato=<?php echo($idformato); ?>&iddocumento=<?php echo($iddoc); ?>&campo=responsables';
			}else if($(this).attr("id")=="cambiar_responsable_seguimiento"){
				var enlaces='<?php echo($ruta_db_superior)?>formatos/hallazgo/editar_funcionario_responsable.php?idformato=<?php echo($idformato); ?>&iddocumento=<?php echo($iddoc); ?>&campo=responsable_seguimiento';
			}else{
				var enlaces='<?php echo($ruta_db_superior)?>formatos/hallazgo/actualizar_tiempo_cumplimiento.php?iddoc=<?php echo $aprobado[0]['iddocumento'];?>';
				ancho=350; alto=200;
			}
			hs.graphicsDir = '<?php echo($ruta_db_superior); ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
			hs.outlineType = 'rounded-white';
			hs.htmlExpand( this, {
				src: enlaces,
				objectType: 'iframe',
				outlineType: 'rounded-white',
				wrapperClassName: 'highslide-wrapper drag-header',
				preserveContent: false,
				width: ancho,
				height: alto
			});
			hs.Expander.prototype.onAfterClose = function() {
				window.location = "<?php echo($ruta_db_superior); ?>formatos/hallazgo/mostrar_hallazgo.php?iddoc=<?php echo($iddoc); ?>&idformato=<?php echo($idformato); ?>";
			}
		});
	});
</script>
<?php
}

function modificar_responsable_seguimiento($idformato, $iddoc){
global $conn,$ruta_db_superior,$ok;
	if($_REQUEST["tipo"]!=5){
		if($ok){
			$button = "<button class='btn btn-mini btn-info' id='cambiar_responsable_seguimiento'>Cambiar responsables</button><br /><br />";
		}
		echo($button);
	}
}

function mostrar_tiempo_cumplimiento($idformato,$iddoc){
	global $conn, $ruta_db_superior; 
	$aprobado=busca_filtro_tabla("d.estado, a.tiempo_cumplimiento, d.iddocumento","documento d, ft_hallazgo a","documento_iddocumento=iddocumento AND iddocumento=$iddoc","",$conn);
	if($_REQUEST['tipo']!=5 && $aprobado[0]['estado']=="APROBADO" && $aprobado[0]['tiempo_cumplimiento']==''){
		$html="<button class='btn btn-mini btn-info' id='actualizar_programado'>Ingresar Tiempo Programado para Cumplimiento</button><br/>"; 
		echo $html;
	}
}


function adicionar_item_accion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$dato=busca_filtro_tabla("","ft_hallazgo A, documento B ","A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);  //nombre tabla padre
	if($_REQUEST['tipo']!=5 && $dato[0]['estado']!='APROBADO'){
		echo '<a href="../accion_plan_mejoramiento/adicionar_accion_plan_mejoramiento.php?pantalla=padre&idpadre='.$iddoc.'&idformato='.$idformato.'&padre='.$dato[0]['idft_hallazgo'].'" target="_self">Adicionar Acción Correctiva/Preventiva y/o Mejora</a>';
	}
}

function mostrar_item_accion($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$tabla = '';
	$dato = busca_filtro_tabla("", "ft_hallazgo A, documento B ", "A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=" . $iddoc, "", $conn);
	if ($dato['numcampos'] != 0) {
		$tabla .= '
		<table style="width:100%; border-collapse: collapse;" border="1">
		<tr>
			<td class="encabezado_list">ACCIÓN</td>
			<td class="encabezado_list">RIESGO</td>
			<td class="encabezado_list">COSTO</td>
			<td class="encabezado_list">VOLUMEN</td>
			<td class="encabezado_list">CALIFICACIÓN TOTAL</td>
		</tr>';

		$item = busca_filtro_tabla("", "ft_accion_plan_mejoramiento A, ft_hallazgo B", "idft_hallazgo=ft_hallazgo and A.ft_hallazgo=" . $dato[0]['idft_hallazgo'], "calificacion_total DESC", $conn);
		if ($item['numcampos'] != 0) {
			for ($j = $item['numcampos'] - 1; $j >= 0; $j--) {
				$tabla .= '<tr>
					<td>' . strip_tags(codifica_encabezado(html_entity_decode($item[$j]['accion_item']))) . '</td>
					<td>' . $item[$j]['riesgo_accion'] . '</td>
					<td>' . $item[$j]['costo_accion'] . '</td>
					<td>' . $item[$j]['volumen_accion'] . '</td>
					<td>' . $item[$j]['calificacion_total'] . '</td>';
				if ($_REQUEST['tipo'] != 5 && $dato[0]['estado'] != 'APROBADO') {
					$tabla .= '
										<td id="registro_' . $item[$j]['idft_accion_plan_mejoramiento'] . '" style="width:10px;"><center><img src="' . $ruta_db_superior . 'imagenes/delete.gif" class="guardar_seleccionado" idregistro="' . $item[$j]['idft_accion_plan_mejoramiento'] . '"  style="cursor:pointer"></center></td>
									</tr>';
				} else {
					$tabla .= '</tr>';
				}
			}

			$tabla .= '</table>';

			$tabla .= '<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script!-->
					<script>
					$(document).ready(function(){
						$(".guardar_seleccionado").click(function(){
							var idregistro=$(this).attr("idregistro");
							if(confirm("En realidad desea borrar este elemento?")){
								$.ajax({
                    type:"POST",
                    url: "borrar_item.php",
                    data: {
                        idft:idregistro,
                        tabla:"ft_accion_plan_mejoramiento"
                    },
                    success: function(){
											location.reload();
                    },error:function(){
                    	alert("error consulta ajax");
                    }
	                }); 
                }	  			
						});				
					});
					</script>';
			echo($tabla);
		}
	}
}


/*POSTERIOR APROBAR*/
function post_aprob_hallazgo($idformato,$iddoc){
  global $conn;
  $documento=busca_filtro_tabla("responsable_seguimiento,responsables","ft_hallazgo","documento_iddocumento=".$iddoc,"",$conn);
  if($documento["numcampos"]){
  	$destinos1=array();
  	if($documento[0]["responsable_seguimiento"]!=""){
  		$destinos1=explode(",", $documento[0]["responsable_seguimiento"]);
  	}
		$destinos2=array();
  	if($documento[0]["responsables"]!=""){
  		$destinos2=explode(",", $documento[0]["responsables"]);
  	}
		$destinos=array_merge($destinos1,$destinos2);
  	if(count($destinos)){
  		transferencia_automatica($idformato, $iddoc, implode("@", $destinos), 3);
  	}
  }
}

?>
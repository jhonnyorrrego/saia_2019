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
include_once($ruta_db_superior."pantallas/lib/librerias_notificaciones.php");

function campo_area_responsable($idformato,$idcampo,$iddoc){
global $conn,$ruta_db_superior;
$opt=0;
$value_campo="";
if($_REQUEST["iddoc"]){
	$opt=1;
	$valor=busca_filtro_tabla("secretarias","ft_hallazgo","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
	if($valor[0][0]!=""){
		$value_campo=$valor[0][0];
	}
}
?>
<td bgcolor="#F5F5F5">
<br />
Buscar:
<input  tabindex='6'  type="text" id="stext_secretarias" width="200px" size="25">
<a href="javascript:void(0)" onclick="tree_secretarias.findItem(htmlentities(document.getElementById('stext_secretarias').value),1)"> 
	<img src="<?php echo $ruta_db_superior;?>botones/general/anterior.png"border="0px">
</a>
<a href="javascript:void(0)" onclick="tree_secretarias.findItem(htmlentities(document.getElementById('stext_secretarias').value),0,1)">
	<img src="<?php echo $ruta_db_superior;?>botones/general/buscar.png"border="0px">
</a>
<a href="javascript:void(0)" onclick="tree_secretarias.findItem(htmlentities(document.getElementById('stext_secretarias').value))"> 
	<img src="<?php echo $ruta_db_superior;?>botones/general/siguiente.png"border="0px">
</a>
<br />
<div id="esperando_secretarias"><img src="<?php echo $ruta_db_superior;?>imagenes/cargando.gif">
</div><div id="treeboxbox_secretarias" height="90%"></div>
<input type="hidden" maxlength="255" class="required" name="secretarias" id="secretarias" value="<?php echo $value_campo;?>" >

<script type="text/javascript">
	<!--
	var opt=parseInt(<?php echo $opt;?>);
	var browserType;
	if (document.layers) {
		browserType = "nn4"
	}
	if (document.all) {
		browserType = "ie"
	}
	if (window.navigator.userAgent.toLowerCase().match("gecko")) {
		browserType = "gecko"
	}
	tree_secretarias = new dhtmlXTreeObject("treeboxbox_secretarias", "100%", "100%", 0);
	tree_secretarias.setImagePath("<?php echo $ruta_db_superior;?>imgs/");
	tree_secretarias.enableIEImageFix(true);
	tree_secretarias.enableCheckBoxes(1);
	//tree_secretarias.enableThreeStateCheckboxes(1);
	tree_secretarias.setOnLoadingStart(cargando_secretarias);
	tree_secretarias.setOnLoadingEnd(fin_cargando_secretarias);
	tree_secretarias.enableSmartXMLParsing(true);
	tree_secretarias.loadXML("<?php echo $ruta_db_superior;?>test_serie.php?tabla=dependencia");
	tree_secretarias.setOnCheckHandler(onNodeSelect_secretarias);
	function onNodeSelect_secretarias(nodeId) {
		valor_destino = document.getElementById("secretarias");
		destinos = tree_secretarias.getAllChecked();
		nuevo = destinos.replace(/\,{2,}(d)*/gi, ",");
		nuevo = nuevo.replace(/\,$/gi, "");
		vector = destinos.split(",");
		for ( i = 0; i < vector.length; i++) {
			if (vector[i].indexOf("_") != -1) {
				vector[i] = vector[i].substr(0, vector[i].indexOf("_"));
			}
			nuevo = vector.join(",");
			if (vector[i].indexOf("#") != -1) {
				hijos = tree_secretarias.getAllSubItems(vector[i]);
				hijos = hijos.replace(/\,{2,}(d)*/gi, ",");
				hijos = hijos.replace(/\,$/gi, "");
				vectorh = hijos.split(",");

				for ( h = 0; h < vectorh.length; h++) {
					if (vectorh[h].indexOf("_") != -1)
						vectorh[h] = vectorh[h].substr(0, vectorh[h].indexOf("_"));
					nuevo = eliminarItem(nuevo, vectorh[h]);
				}
			}
		}
		nuevo = nuevo.replace(/\,{2,}(d)*/gi, ",");
		nuevo = nuevo.replace(/\,$/gi, "");
		valor_destino.value = nuevo;
	}

	function fin_cargando_secretarias() {
		if (browserType == "gecko")
			document.poppedLayer = eval('document.getElementById("esperando_secretarias")');
		else if (browserType == "ie")
			document.poppedLayer = eval('document.getElementById("esperando_secretarias")');
		else
			document.poppedLayer = eval('document.layers["esperando_secretarias"]');
		document.poppedLayer.style.display = "none";
		if(opt==1){
			checked_secretarias();
		}
	}
	function checked_secretarias(){
		var dependencias='<?php echo $value_campo;?>';
		var dep=dependencias.split(",");
		for(var i=0;i<dep.length;i++){
			tree_secretarias.setCheck(dep[i],true);
		}
	}

	function cargando_secretarias() {
		if (browserType == "gecko")
			document.poppedLayer = eval('document.getElementById("esperando_secretarias")');
		else if (browserType == "ie")
			document.poppedLayer = eval('document.getElementById("esperando_secretarias")');
		else
			document.poppedLayer = eval('document.layers["esperando_secretarias"]');
		document.poppedLayer.style.display = "";
	}
	-->
</script></td>
<?php
}

function ver_secretarias_hallaz($idformato,$iddoc){
global $conn;
	$html="";
	$datos=busca_filtro_tabla("secretarias","ft_hallazgo","documento_iddocumento=".$iddoc,"",$conn);
	if($datos["numcampos"]){
		$dep=busca_filtro_tabla("nombre","dependencia","iddependencia in (".$datos[0]["secretarias"].")","",$conn);
		if($dep["numcampos"]){
			$nombres=extrae_campo($dep,"nombre");
			$html=implode(", ", $nombres);
		}
	}
	echo $html;
}


function tipo_plan_plan_mejoramiento($idformato,$iddoc){
  global $conn;
  if($papa["numcampos"]){
    
    $idformato_formato=busca_filtro_tabla("idformato","formato","nombre='formato'","",$conn);  
    echo('<td><input type="hidden" value="'.$papa[0]["tipo_plan"].'" name="tipo_plan">'.mostrar_valor_campo("tipo_plan",$idformato_formato[0]['idformato'],$_REQUEST["anterior"],1).'</td>');  
  }
}
function radicado_plan_padre($idformato,$idcampo,$iddoc=NULL){
	global $conn;
  	
	$formato=busca_filtro_tabla("","formato A","A.idformato=".$idformato,"",$conn);
	$doc=busca_filtro_tabla("",$formato[0]["nombre_tabla"].",documento","documento_iddocumento=iddocumento and documento_iddocumento=".$iddoc,"",$conn);
	$padre=busca_filtro_tabla("","ft_plan_mejoramiento","idft_plan_mejoramiento=".$doc[0]["ft_plan_mejoramiento"],"",$conn);
	$plan=busca_filtro_tabla("numero","documento","iddocumento=".$_REQUEST["anterior"],"",$conn);
  
	if($_REQUEST["iddoc"]){
		if($doc[0]["ejecutor"]!=usuario_actual("funcionario_codigo")){
		alerta("El hallazgo solo puede ser editado por su creador");
		redirecciona("mostrar_hallazgo.php?iddoc=".$iddoc."&idformato=".$idformato);
		die();
	}	
	if($padre[0]["estado_plan_mejoramiento"]==2){
		alerta("El plan de mejoramiento se encuentra en estado APROBADO");
		redirecciona("mostrar_hallazgo.php?iddoc=".$iddoc."&idformato=".$idformato);
		die();
	}	
				
		$clase_accion = busca_filtro_tabla("clase_accion","ft_hallazgo","documento_iddocumento=".$iddoc,"",$conn);
	}  

	if($plan["numcampos"]){
		echo '<td><input type="text" name="radicado_plan" readonly="true" value="'.$plan[0][0].'" /></td>';
	}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#deficiencia").parent().parent().hide();
		$("#causas").parent().parent().hide();
		$("#secretarias").parent().parent().hide();				
		$("#secretarias").removeClass("required");
		$("#secretarias").parent().parent().children(".encabezado").html("AREA RESPONSABLE*");
		$("#deficiencia").parent().parent().children(".encabezado").html("DEFICIENCIA*");
		$("#causas").parent().parent().children(".encabezado").html("CAUSAS*");
		
		if(parseInt("<?php echo($clase_accion[0]["clase_accion"]); ?>") !== 3 && parseInt("<?php echo($clase_accion["numcampos"]); ?>") > 0){						
			$("#deficiencia").parent().parent().show();
			$("#causas").parent().parent().show();
			$("#secretarias").parent().parent().show();				
			$("#secretarias").addClass("required");
			$("#causas").addClass("required");
			$("#deficiencia").addClass("required");
		}else{
			$('#clase_accion option[value="1"]').attr('selected','selected');
			$("#deficiencia").parent().parent().show();
			$("#causas").parent().parent().show();
			$("#secretarias").parent().parent().show();				
			$("#secretarias").addClass("required");
			$("#deficiencia").addClass("required");
			$("#causas").addClass("required");
		}		
		
		$("#clase_accion").change(function(){
			if(parseInt($(this).val()) == 3){
				$("#deficiencia").parent().parent().hide();
				$("#causas").parent().parent().hide();
				$("#secretarias").parent().parent().hide();				
				$("#secretarias").removeClass("required");
				$("#causas").removeClass("required");
				$("#deficiencia").removeClass("required");
			}else{
				$("#deficiencia").parent().parent().show();
				$("#causas").parent().parent().show();
				$("#secretarias").parent().parent().show();				
				$("#secretarias").addClass("required");
				$("#deficiencia").addClass("required");
				$("#causas").addClass("required");
			}
		})
	})
</script>
<?php
}

function editar_hallazgo($idformato, $iddoc) {
	global $conn;
	if ($_REQUEST["tipo"] != 5) {
		$formato = busca_filtro_tabla("", "formato A", "A.idformato=" . $idformato, "", $conn);
		$doc = busca_filtro_tabla("", $formato[0]["nombre_tabla"] . ",documento", "documento_iddocumento=iddocumento and documento_iddocumento=" . $iddoc, "", $conn);
		$responsables_seguimiento = explode(",", $doc[0]["responsable_seguimiento"]);
		$responsables_hallazgo = explode(",", $doc[0]["responsables"]);
		$padre = busca_filtro_tabla("", "ft_plan_mejoramiento", "idft_plan_mejoramiento=" . $doc[0]["ft_plan_mejoramiento"], "", $conn);
		$usuario = 0;

		if (usuario_actual("funcionario_codigo") == $doc[0]["ejecutor"]) {
			$usuario = 1;
		}

		if ((!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"] == 1) && $padre[0]["estado_plan_mejoramiento"] != 2) {
			$perm = new PERMISO();
			$ok = $perm -> acceso_modulo_perfil("editar_hallazgo");
			if ($usuario)
				echo '<a href="#" id="link_editar">Editar Hallazgo</a>&nbsp;&nbsp;';
			$ok = $perm -> acceso_modulo_perfil("eliminar_hallazgo");
			if ($ok) {
				if ($doc[0]["ejecutor"] == usuario_actual("funcionario_codigo"))
					echo '<a href="#" id="link_eliminar">Eliminar Hallazgo</a>&nbsp;&nbsp;';
			}
			$ok = $perm -> acceso_modulo_perfil("adicionar_seguimiento_plan");
			if ($ok || $usuario)
				echo '<a href="#" id="link_adicionar_seg">Adicionar Seguimiento</a>';
	    ?>
	    <script type="text/javascript" src="../../js/jquery.js"></script>
	    <script>
	    $(document).ready(function() {
		   	$('#link_editar').click(function(){
		       window.location="<?php echo $formato[0]['ruta_editar'].'?idformato='.$idformato.'&iddoc='.$iddoc; ?>";
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

function transferir_hallazgo_plan_mejoramiento($idformato,$iddoc){
  global $conn;
  $datos=array();
  $documento=busca_filtro_tabla("","ft_hallazgo","documento_iddocumento=".$iddoc,"",$conn);
  
  if(@$documento["numcampos"]){
    $datos["archivo_idarchivo"]=$iddoc;
    $datos["nombre"]="TRANSFERIDO";
    $datos["tipo_destino"]=1;
    $datos["tipo"]="";
  
    $destinos1=explode(",",$documento[0]["responsable_seguimiento"]);
    $destinos2=explode(",",$documento[0]["responsables"]);
    $destino_tramite=array_merge($destinos1,$destinos2);
    $destino_tramite=array_unique($destino_tramite);
    sort($destino_tramite);
    transferir_archivo_prueba($datos,$destino_tramite,"");
  }
}
function notificar_edicion($idformato,$iddoc){
  global $conn;
  $papa=busca_filtro_tabla("","ft_plan_mejoramiento a,documento b,ft_hallazgo c,documento d","c.documento_iddocumento=$iddoc and a.documento_iddocumento=b.iddocumento and c.documento_iddocumento=d.iddocumento and ft_plan_mejoramiento=idft_plan_mejoramiento","",$conn);

  $mensaje="Se ha editado un Hallazgo perteneciente a un Plan de mejoramiento que Usted ha elaborado. Hallazgo No. ".$papa[0]["numero"].", Deficiencia: ".strip_tags(html_entity_decode($papa[0]["deficiencia"]));
enviar_mensaje($_SESSION["usuario_actual"],$papa[0]["ejecutor"],$mensaje,"msg");

  $mensaje="Se ha editado un Hallazgo del cual Usted es responsable. Hallazgo No. ".$papa[0]["numero"].", Deficiencia: ".strip_tags(html_entity_decode($papa[0]["deficiencia"]));
enviar_mensaje($_SESSION["usuario_actual"],explode(",",$papa[0]["responsables"]),$mensaje,"e-interno");
}
function detalles_padre($idformato,$iddoc){
global $conn;
$texto="";

if(@$idformato&&@$iddoc){
  $formato=busca_filtro_tabla("B.*,A.nombre_tabla","formato A, campos_formato B","A.idformato=B.formato_idformato AND B.formato_idformato=".$idformato." AND B.etiqueta_html ='detalle'","B.orden ASC",$conn); 
  if($formato[0]["nombre"]){
    $papa=busca_filtro_tabla("B.*,A.nombre_tabla","formato A,campos_formato B","A.idformato=B.formato_idformato AND A.nombre_tabla='".$formato[0]["nombre"]."' AND B.acciones LIKE '%d%'","",$conn);
    $campos=extrae_campo($papa,"nombre","U");
    $etiquetas=extrae_campo($papa,"etiqueta","U");
    if($papa["numcampos"]){
      $hijo=busca_filtro_tabla("",$formato[0]["nombre_tabla"],"documento_iddocumento='".$iddoc."'","",$conn);
     if($hijo["numcampos"]){
        $documento=busca_filtro_tabla(implode(",",$campos).",documento_iddocumento",$papa[0]["nombre_tabla"],"id".$papa[0]["nombre_tabla"]."=".$hijo[0][$papa[0]["nombre_tabla"]],"",$conn);

        if($documento["numcampos"]){
          $texto.='<table border="0" width="100%" class="tabla_borde">';
          for($i=0;$i<count($etiquetas);$i++){
          
            $texto.='<tr ><td class="encabezado" width="20%" >'.$etiquetas[$i].'</td><td class="transparente" style="text-align: left;">'.mostrar_valor_campo($campos[$i],$papa[0]["formato_idformato"],$documento[0]["documento_iddocumento"],1).'</td></tr>';
          }
          $texto.='</table>';
        }
      }
    }
  }
}
echo  ($texto);
}
function validar_entrada_hallazgo($idformato,$iddoc){
	global $conn;
	$dato=busca_filtro_tabla(fecha_db_obtener("fecha_revisado","Y-m-d H:i:s")." AS fecha_revisado,".fecha_db_obtener("fecha_aprobado","Y-m-d H:i:s")." AS fecha_aprobado","ft_plan_mejoramiento a","a.documento_iddocumento=".$_REQUEST["anterior"],"",$conn);
	if($dato[0]["fecha_revisado"] && $dato[0]["fecha_revisado"]>'2010-01-01 00:00:00' && $dato[0]["fecha_aprobado"] && $dato[0]["fecha_aprobado"]>'2010-01-01 00:00:00'){
		alerta("No se permite adicionar hallazgos, ya que el plan de mejoramiento se encuentra aprobado y cerrado. Cualquier inquietud comunicarse con Control Interno");
		if(usuario_actual('login') != '0k'){
			redirecciona("../../vacio.php");
			die();	
		}		
	}
}
function consecutivo_hallazgo_funcion($idformato,$iddoc){
	global $conn;
	if($_REQUEST["padre"]){		
		$plan=busca_filtro_tabla("max(to_number(lower(trim(a.consecutivo_hallazgo)))) as consecutivo","ft_hallazgo a, documento b","a.documento_iddocumento=b.iddocumento and lower(a.estado) not in('eliminado', 'anulado') and ft_plan_mejoramiento=".$_REQUEST["padre"],"to_number(lower(trim(a.consecutivo_hallazgo))) desc",$conn);		
		$consecutivo = $plan[0]["consecutivo"] +1;		
	}else{
		$plan=busca_filtro_tabla("consecutivo_hallazgo","ft_hallazgo a","a.documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
		$consecutivo = $plan[0]["consecutivo_hallazgo"];				
	}
	
	echo('<td><input type="text" name="consecutivo_hallazgo" id="consecutivo_hallazgo" value="'.($consecutivo).'" readonly></td>');
}
function procesos_vinculados_funcion($idformato,$iddoc,$informe){
	global $conn;
	$datos=busca_filtro_tabla("procesos_vinculados","ft_hallazgo a","a.documento_iddocumento=".$iddoc,"",$conn);
	$procesos=explode(",",$datos[0]["procesos_vinculados"]);
	$cant=count($procesos);
	$nombres=array();
	for($i=0;$i<$cant;$i++){
	    print_r($procesos[$i][0]);
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
	//$nombres=extrae_campo($proceso,"nombre");
	if($informe){
		return implode(", ",$nombres);
	}else
		echo implode(", ",$nombres);
}
function ft_gestion_calid_funcion($idformato,$iddoc){
	global $conn;
	echo '<td>Vinculando verificaci&oacute;n<input type="hidden" id="ft_gestion_calid" name="ft_gestion_calid" value="'.@$_REQUEST["gestion_calid"].'"></td>';
	if(!@$_REQUEST["gestion_calid"]){
		echo '<script>
		$("#ft_gestion_calid").parent().parent().hide();
		</script>';
	}
}
function mostrar_ft_gestion_calid_funcion($idformato,$iddoc){
	global $conn, $ruta_db_superior;
	$gestion_calidad=busca_filtro_tabla("","ft_hallazgo a, ft_gestion_calid b, documento c","a.documento_iddocumento=".$iddoc." and a.ft_gestion_calid=b.idft_gestion_calid and b.documento_iddocumento=c.iddocumento and c.estado not in('ELIMINADO', 'ANULADO')","",$conn);
	
	if($gestion_calidad["numcampos"]){
		echo "<a href='".$ruta_db_superior."ordenar.php?key=".$gestion_calidad[0]["iddocumento"]."&mostrar_formato=1' target='centro'>Gesti&oacute;n de calidad</a>";
	}
}
function redireccionar_gestion_calidad_funcion($idformato,$iddoc){
	global $conn;
	$gestion_calidad=busca_filtro_tabla("b.documento_iddocumento as iddoc, idformato, nombre_tabla, ft_gestion_calid","ft_hallazgo a, ft_gestion_calid b, documento c, formato d","a.documento_iddocumento=".$iddoc." and a.ft_gestion_calid=b.idft_gestion_calid and b.documento_iddocumento=c.iddocumento and lower(c.plantilla)=lower(d.nombre)","",$conn);
	

	if($gestion_calidad["numcampos"]){
		$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
		$ruta_db_superior=$ruta="";
		while($max_salida>0)
		{
		if(is_file($ruta."db.php"))
		{
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
		}
		$ruta.="../";
		$max_salida--;
		}
		$ruta=$ruta_db_superior."formatos/arboles/arbolformato_documento.php?idformato=".$gestion_calidad[0]["idformato"]."&iddoc=".$gestion_calidad[0]["iddoc"]."&llave=".$gestion_calidad[0]["idformato"]."-id".$gestion_calidad[0]["nombre_tabla"]."-".$gestion_calidad[0]["ft_gestion_calid"];
		
		abrir_url($ruta,"formato_detalles");
		die();
	}
}

function modificar_responsable_mejoramiento($idformato, $iddoc){
	global $conn,$ruta_db_superior;
	if($_REQUEST["tipo"]!=5){
	$permiso=new PERMISO();
	$ok=$permiso->acceso_modulo_perfil('cambiar_responsable_hallazgos');
	
	if($ok){	 
		$button = "<button id='cambiar_responsable_mejoramiento'>Cambiar responsables</button><br />";
	}
	
	echo($button);
	echo(librerias_highslide());
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#cambiar_responsable_mejoramiento").click(function(){
			var enlaces='<?php echo($ruta_db_superior)?>formatos/hallazgo/editar_funcionario_responsable.php?idformato=<?php echo($idformato); ?>&iddocumento=<?php echo($iddoc); ?>&campo=responsables';
			hs.graphicsDir = '<?php echo($ruta_db_superior); ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
			hs.outlineType = 'rounded-white';
			hs.htmlExpand( this, {
				src: enlaces,
				objectType: 'iframe',
				outlineType: 'rounded-white',
				wrapperClassName: 'highslide-wrapper drag-header',
				preserveContent: false,
				width: 600,
				height: 300
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
global $conn,$ruta_db_superior;
	if($_REQUEST["tipo"]!=5){
	$permiso=new PERMISO();
	$ok=$permiso->acceso_modulo_perfil('cambiar_responsable_hallazgos');
	
	if($ok){
		$button = "<button id='cambiar_responsable_seguimiento'>Cambiar responsables</button><br />";
	}
	
	echo($button);
	echo(librerias_highslide());
	}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#cambiar_responsable_seguimiento").click(function(){
			var enlaces='<?php echo($ruta_db_superior)?>formatos/hallazgo/editar_funcionario_responsable.php?idformato=<?php echo($idformato); ?>&iddocumento=<?php echo($iddoc); ?>&campo=responsable_seguimiento';
			hs.graphicsDir = '<?php echo($ruta_db_superior); ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
			hs.outlineType = 'rounded-white';
			hs.htmlExpand( this, {
				src: enlaces,
				objectType: 'iframe',
				outlineType: 'rounded-white',
				wrapperClassName: 'highslide-wrapper drag-header',
				preserveContent: false,
				width: 600,
				height: 300
			});
			hs.Expander.prototype.onAfterClose = function() {
				window.location = "<?php echo($ruta_db_superior); ?>formatos/hallazgo/mostrar_hallazgo.php?iddoc=<?php echo($iddoc); ?>&idformato=<?php echo($idformato); ?>";
			}
		});
	});
</script>
<?php	
}

function notificar_responsable_mejoramiento($idformato, $iddoc){
	global $conn;
	
	echo(librerias_jquery("1.7"));
	
	$responsables_mejoramiento = busca_filtro_tabla("responsable_seguimiento","ft_hallazgo",fecha_db_obtener("tiempo_seguimiento","Y-m-d")."='".date("Y-m-d")."' and documento_iddocumento=".$iddoc,"",$conn);	
	
	$responsables = explode(',', $responsables_mejoramiento[0]["responsable_seguimiento"]);	
	
	if(in_array(usuario_actual("funcionario_codigo"), $responsables)){		
		notificaciones("<b>Como responsable de seguimiento de este hallazgo, por favor verifique cumplimiento del mismo</b>","warning","8500");			
	}
}

function notificar_responsable_cumplimiento($idformato, $iddoc){
	global $conn;
	
	echo(librerias_jquery("1.7"));
	
	$responsables_cumplimiento = busca_filtro_tabla("responsables,documento_iddocumento","ft_hallazgo","ROUND(tiempo_cumplimiento-sysdate) IN(5,10,15) and documento_iddocumento=".$iddoc,"",$conn);	
	
	$responsables = explode(',', $responsables_cumplimiento[0]["responsables"]);		
		
	if(in_array(usuario_actual("funcionario_codigo"), $responsables)){		
		notificaciones("<b>Como responsable de cumplimiento de este hallazgo, por favor verifique o reporte cumplimiento del mismo</b>","warning","8500");			
	}
}

function cambiar_firma_editor($idformato, $iddoc){
	$codigo=usuario_actual("funcionario_codigo");
$funcionario=busca_filtro_tabla("","vfuncionario_dc","estado_dc=1 and tipo_cargo=1 and tipo_d=1 and tipo_dep=1 funcionario_codigo=".$codigo,"",$conn);

$sql="update ft_hallazgo set dependencia=".$funcionario[0]["iddependencia"]." where documento_iddocumento=".$iddoc;
phpmkr_query($sql);
$sql="update buzon_entrada set destino=".$codigo." where nombre='APROBADO' and archivo_idarchivo=".$iddoc;
phpmkr_query($sql);
}
function mostrar_correcion($idformato, $iddoc){
	global $conn;
	
	$fecha=busca_filtro_tabla(fecha_db_obtener("fecha_creacion","Y-m-d")." as fecha_creacion","documento","iddocumento=".$iddoc,"",$conn);
	
	if($fecha[0]["fecha_creacion"]>='2015-09-17'){
		
		$correccion=busca_filtro_tabla("","ft_hallazgo","documento_iddocumento=".$iddoc,"",$conn);
		echo('</td></tr><tr><td class="encabezado" valign="top">Correcci&oacute;n</td><td class="celda_transparente" colspan="2">&nbsp;'.$correccion[0]["correcion_hallazgo"]);
		
	}
}
?>
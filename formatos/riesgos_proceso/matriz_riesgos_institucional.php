<?php
if(@$_REQUEST["excel"]){
	header('Content-Type: application/vnd.ms-excel');
	header("Content-Disposition: attachment; filename=Mapa de riesgos institucional.xls");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
}
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
include_once($ruta_db_superior.'librerias_saia.php');
include_once($ruta_db_superior.'formatos/riesgos_proceso/librerias_riesgos.php');

echo(estilo_bootstrap());

$datos=busca_filtro_tabla("","documento","iddocumento=".$_REQUEST["iddoc"],"",$conn);

include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior.'formatos/librerias/estilo_formulario.php');
include_once($ruta_db_superior.'formatos/librerias/funciones_generales.php');
include_once($ruta_db_superior.'riesgos_proceso/librerias_riesgos.php');

$formato=busca_filtro_tabla("","formato","nombre_tabla LIKE 'ft_riesgos_proceso'","",$conn);
$prob[0]="La materializaci&oacute;n del riesgo ocurre con frecuencia";
$prob[1]="Es posible que suceda el da&ntilde;o alguna vez";
$prob[2]="No es esperable que se materialice el riesgo, aunque puede ser concebible";
$imp[0]="Consecuencias reversibles con poca inversi&oacute;n";
$imp[1]="Consecuencias parciales, de costosa y compleja reparaci&oacute;n";
$imp[2]="Destrucci&oacute;n total, muy dif&iacute;cil renovar";
echo(librerias_highslide());
?>
<script type="text/javascript" src="../../js/tooltips_riesgos.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-full.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<style>
.alineados{   
	padding: 0;   
	margin: 0;   
	border: 0;   
	background-color:#CCCCCC;   
	text-shadow: #333 1px 1px 3px;   
	text-align: center;   
	cursor: pointer;   
	display:inline; 
} 
.tabla_borde img{
	border:0px;
}
a:hover {	
	color: #999999 !important;
}
</style>
<script type='text/javascript'>
    hs.graphicsDir = '<?php echo($ruta_db_superior); ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<style type="text/css">	#dhtmlgoodies_tooltip{ 		background-color:#EEE; 		border:1px solid #000; 		position:absolute; 		display:none; 		z-index:30000; 		padding:2px; 		font-size:0.9em; 		-moz-border-radius:6px;	/* Rounded edges in Firefox */ 		font-family: "Trebuchet MS", "Lucida Sans Unicode", Arial, sans-serif; 	} 	#dhtmlgoodies_tooltipShadow{ 		position:absolute; 		background-color:#555; 		display:none; 		z-index:10000; 		opacity:0.7; 		filter:alpha(opacity=70); 		-khtml-opacity: 0.7; 		-moz-opacity: 0.7; 		-moz-border-radius:6px;	/* Rounded edges in Firefox */ 	} 	a{ 		color: #000000; 		text-decoration:none;		; 	} 	a:hover{ 		border-bottom:1px dotted #317082; 		color: #000000; 	} 	
</style>
<?php                 
   if(@$_REQUEST["enlace_adicionar_formato"] && @$_REQUEST["iddoc"]){
      $formato=busca_filtro_tabla("","formato","nombre_tabla LIKE 'ft_riesgos_proceso'","",$conn);
      if($formato["numcampos"]){
        agrega_boton("texto","../../botones/formatos/adicionar.gif","../../responder.php?idformato=".$formato[0]["idformato"]."&iddoc=".$_REQUEST["padre"],"","Adicionar ".$formato[0]["etiqueta"],$formato[0]["nombre_tabla"],"","",0);
        echo("<br /><br />");
        $alto_frame="94%";
      }
    }
$datos=explode("-",$_REQUEST["llave"]);

if(!@$_REQUEST["excel"]){
	$url="matriz_riesgos_institucional.php?excel=1";
	/*$tabla = '
				     <a target="_blank" href="'.$url.'">
					    <img src="'.$ruta_db_superior.'enlaces/imprimir.gif" height="30" width="30" border="0">
				     </a>';*/
	$tabla='<img src="'.$ruta_db_superior.'enlaces/imprimir.gif" style="cursor:pointer" height="30" width="30" border="0" id="exportar_excel">';
	echo($tabla);
}
?>
<form method="post" action="exportar_matriz_riesgos_institucional.php" id="matriz" name="matriz">
<table border="1" width="100%" cellspacing="0" class="tabla_borde" style="border-collapse:collapse">
  <tbody>
    <tr>
      <td  style="background:#E7E7E9" rowspan="2" align="center" >PROBABILIDAD</td>
      <td  style="text-align: center;background:#E7E7E9" colspan="5" >IMPACTO</td>
    </tr>
    <tr>
      <td  style="text-align: center;background:#E7E7E9" >Insignificante<br />(1)&nbsp;</td>
      <td  style="text-align: center;background:#E7E7E9" >Menor<br />(2)&nbsp;</td>
      <td  style="text-align: center;background:#E7E7E9" >Moderado<br />(3)&nbsp;</td>
      <td  style="text-align: center;background:#E7E7E9" >Mayor<br />(4)&nbsp;</td>
      <td  style="text-align: center;background:#E7E7E9" >Catastr&oacute;fico<br />(5)&nbsp;</td>
    </tr>
    <tr>
      <td style="text-align:center;">Raro (1)</td>
      <td style="text-align:center;background-color: green;vertical-align:top; color:blue;" id="1_1">B<br /></td>
      <td style="text-align:center;background-color:green;vertical-align:top;color:blue;" id="2_1">B<br /></td>
      <td style="text-align:center;background-color:yellow;vertical-align:top;color:blue;" id="3_1">M<br /></td>
      <td style="text-align:center;background-color:#DAAAA6;vertical-align:top;color:blue;" id="4_1">A<br /></td>
      <td style="text-align:center;background-color:#DAAAA6;vertical-align:top;color:blue;" id="5_1">A<br /></td>
    </tr>
    <tr>
      <td style="text-align:center;">Improbable (2)</td>
      <td style="text-align:center;background-color:green;vertical-align:top;color:blue;" id="1_2">B<br /></td>
      <td style="text-align:center;background-color:green;vertical-align:top;color:blue;" id="2_2">B<br /></td>
      <td style="text-align:center; background-color:yellow;vertical-align:top;color:blue;" id="3_2">M<br /></td>
      <td style="text-align:center;background-color:#DAAAA6;vertical-align:top;color:blue;" id="4_2">A<br /></td>
      <td style="text-align:center;background-color:red;vertical-align:top;color:blue;" id="5_2">E<br /></td>
    </tr>
    <tr>
      <td style="text-align:center;">Posible (3)</td>
      <td style="text-align:center;background-color:green;vertical-align:top;color:blue;" id="1_3">B<br /></td>
      <td style="text-align:center;background-color:yellow;vertical-align:top;color:blue;" id="2_3">M<br /></td>
      <td style="text-align:center;background-color:#DAAAA6;vertical-align:top;color:blue;" id="3_3">A<br /></td>
      <td style="text-align:center;background-color:red;vertical-align:top;color:blue;" id="4_3">E<br /></td>
      <td style="text-align:center;background-color:red;vertical-align:top;color:blue;" id="5_3">E<br /></td>
    </tr>
    <tr>
      <td style="text-align: center;">Probable (4)</td>
      <td style="text-align:center;background-color:yellow; vertical-align:top;color:blue;" id="1_4">M<br /></td>
      <td style="text-align: center; background-color: #DAAAA6;  vertical-align:top;color:blue;" id="2_4">A<br /></td>
      <td style="text-align: center; background-color: #DAAAA6; vertical-align:top;color:blue;" id="3_4">A<br /></td>
      <td style="text-align: center; background-color: red; vertical-align:top;color:blue;" id="4_4">E<br /></td>
      <td style="text-align: center; background-color: red; vertical-align:top;color:blue;" id="5_4">E<br /></td>
    </tr>
    <tr>
      <td style="text-align:center;">Casi seguro (5)</td>
      <td style="text-align:center;background-color:#DAAAA6;vertical-align:top;color:blue;" id="1_5">A<br /></td>
      <td style="text-align:center;background-color:#DAAAA6;vertical-align:top;color:blue;" id="2_5">A<br /></td>
      <td style="text-align:center;background-color:red;vertical-align:top;color:blue;" id="3_5">E<br /></td>
      <td style="text-align:center;background-color:red;vertical-align:top;color:blue;" id="4_5">E<br /></td>
      <td style="text-align:center;background-color:red;vertical-align:top;color:blue;" id="5_5">E<br /></td>
    </tr>
    <tr>
    	<td colspan="6" style="text-align: left;">
    		B: Zona de riesgo baja: Asumir el riesgo<br>
    		M: Zona de riesgo moderada: Asumir el riesgo, reducir el riesgo<br>
    		A: Zona de riesgo Alta: Reducir el riesgo, evitar, compartir o transferir<br>
    		E: Zona de riesgo extrema: Reducir el riesgo, evitar, compartir o transferir
    	</td>
    </tr>
  </tbody>
</table>
<input type="hidden" name="contenido_excel" id="contenido_excel">
</form>
<?php

cuadrante();
?>
<script>
$(document).ready(function(){
	$("#exportar_excel").click(function(){
		var contenido=$("#matriz").html();
		$("#contenido_excel").val(contenido);
		$("#matriz").submit();
	});	
});
</script>
<?php

function cuadrante(){
global $conn,$formato;
$texto="";
$dato=explode("-",$_REQUEST["llave"]); 

$riesgos=busca_filtro_tabla("a.impacto, a.probabilidad, a.descripcion as nombre, a.idft_riesgos_proceso, a.consecutivo, a.documento_iddocumento, a.ft_proceso","ft_riesgos_proceso a, documento b","lower(a.estado) not in('inactivo') and lower(b.estado) not in('eliminado','anulado') and a.documento_iddocumento=b.iddocumento AND a.tipo_riesgo not in('Corrupcion')","idft_riesgos_proceso asc",$conn);

for($i=0;$i<$riesgos["numcampos"];$i++){
	$dato_proceso=busca_filtro_tabla("","ft_proceso A","A.idft_proceso=".$riesgos[$i]["ft_proceso"],"",$conn);
		
	$probabilidad = obtener_probabilidad_riesgo($riesgos[$i]["idft_riesgos_proceso"], $riesgos[$i]["probabilidad"]);
	$impacto      = obtener_impacto_riesgo($riesgos[$i]["idft_riesgos_proceso"], $riesgos[$i]["impacto"]);		
	
	$texto='';
	$texto.='<a style="color:blue;" title="" href="mostrar_riesgos_proceso.php?idformato='.$formato[0]["idformato"].'&iddoc='.$riesgos[$i]["documento_iddocumento"].'" class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 550, height:400,preserveContent:false } )" style="text-decoration: underline; cursor:pointer;">Riesgo No.'.strip_tags($riesgos[$i]["consecutivo"]).' ('.$dato_proceso[0]["nombre"].')</a><br />';
	
	llenar_evaluaciones($impacto,$probabilidad,$texto);
}	
	return($texto);
}


function obtener_probabilidad_riesgo_eliminar($idft_riesgos_proceso, $probabilidad){
	global $conn;	
	
	$control_riesgos_probabilidad = busca_filtro_tabla("a.herramienta_ejercer, a.procedimiento_herramienta, a.herramienta_efectiva, a.responsables_ejecucion,  a.frecuencia_ejecucion","ft_control_riesgos a, documento b","a.tipo_control=1 and a.documento_iddocumento=b.iddocumento and lower(b.estado) not in('eliminado','anulado') and ft_riesgos_proceso=".$idft_riesgos_proceso,"a.idft_control_riesgos desc",$conn);
	
	$posiciones = 0;
	for ($i=0; $i < $control_riesgos_probabilidad["numcampos"]; $i++) {		
		$mover_probabilidad = 0;
		
		if($control_riesgos_probabilidad[$i]["herramienta_ejercer"] == 1){
			$mover_probabilidad += 15;
		}
		
		if($control_riesgos_probabilidad[$i]["procedimiento_herramienta"] == 1){
			$mover_probabilidad += 15;
		}
		
		if($control_riesgos_probabilidad[$i]["herramienta_efectiva"] == 1){
			$mover_probabilidad += 30;
		}
		
		if($control_riesgos_probabilidad[$i]["responsables_ejecucion"] == 1){
			$mover_probabilidad += 15;
		}
		
		if($control_riesgos_probabilidad[$i]["frecuencia_ejecucion"] == 1){
			$mover_probabilidad += 25;
		}		
		
		if($mover_probabilidad >= 0 && $mover_probabilidad <= 50){
			$posiciones += 0;
		}elseif($mover_probabilidad >= 51  && $mover_probabilidad <= 75){
			$posiciones += 1;
		}elseif($mover_probabilidad >= 76){
			$posiciones += 2;
		}		
	}
	
	$nueva_probabilidad = $probabilidad - $posiciones;
	
	if($nueva_probabilidad < 1){
		$nueva_probabilidad = 1;
	}elseif($nueva_probabilidad > 5){
		$nueva_probabilidad = 5;
	}
	
	return($nueva_probabilidad);
}

function obtener_impacto_riesgo_eliminar($idft_riesgos_proceso, $impacto){
	global $conn;		
	
	$control_riesgos_impacto = busca_filtro_tabla("a.herramienta_ejercer, a.procedimiento_herramienta, a.herramienta_efectiva, a.responsables_ejecucion,  a.frecuencia_ejecucion","ft_control_riesgos a, documento b","a.tipo_control=2 and a.documento_iddocumento=b.iddocumento and lower(b.estado) not in('eliminado','anulado') and ft_riesgos_proceso=".$idft_riesgos_proceso,"a.idft_control_riesgos desc",$conn);
	
	$posiciones = 0;			
	for ($i=0; $i < $control_riesgos_impacto["numcampos"]; $i++){		
		
		$mover_impacto = 0;
			
		if($control_riesgos_impacto[$i]["herramienta_ejercer"] == 1){
			$mover_impacto += 15;
		}
		
		if($control_riesgos_impacto[$i]["procedimiento_herramienta"] == 1){
			$mover_impacto += 15;
		}
		
		if($control_riesgos_impacto[$i]["herramienta_efectiva"] == 1){
			$mover_impacto += 30;
		}
		
		if($control_riesgos_impacto[$i]["responsables_ejecucion"] == 1){
			$mover_impacto += 15;
		}
		
		if($control_riesgos_impacto[$i]["frecuencia_ejecucion"] == 1){
			$mover_impacto += 25;
		}
		
		if($mover_impacto >= 0 && $mover_impacto <= 50){
			$posiciones += 0;
		}elseif($mover_impacto >= 51  && $mover_impacto <= 75){
			$posiciones += 1;
		}elseif($mover_impacto >= 76){
			$posiciones += 2;
		}				
	}
	
	$nuevo_impacto = $impacto - $posiciones;
		
	
	if($nuevo_impacto < 1){
		$nuevo_impacto = 1;
	}elseif($nuevo_impacto > 5){
		$nuevo_impacto = 5;
	}
		
	return($nuevo_impacto);
}

function llenar_evaluaciones($impacto,$probabilidad,$texto){
	global $conn;
?>
<script type="text/javascript"> 
	$(document).ready(function(){
		var idcuadro_riesgos = "<?php echo $impacto; ?>_<?php echo $probabilidad; ?>";		
		$("#"+idcuadro_riesgos).append('<?php echo str_replace("'","\'",$texto); ?>');
	})	
</script>	
<?php
}

?>
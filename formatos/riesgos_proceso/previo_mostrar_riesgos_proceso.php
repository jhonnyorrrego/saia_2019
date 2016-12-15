<?php
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

echo(estilo_bootstrap());
//echo('<a href="http://saia.risaralda.gov.co/SAIA/saia/class_impresion.php?url=formatos/riesgos_proceso/previo_mostrar_riesgos_proceso2.php?llave=9-idft_proceso-161&iddoc=439252&enlace_adicionar_formato=1&padre=161&formato_padre=13&no_menu=1"><img src="../../enlaces/imprimir.gif" border="0"></a>');
//echo('<a href="http://saia.risaralda.gov.co/SAIA/saia/class_impresion.php?url=formatos/riesgos_proceso/previo_mostrar_riesgos_proceso.php?llave=9-idft_proceso-161&iddoc=439252&enlace_adicionar_formato=1&padre=161&formato_padre=13&no_menu=1"><img src="../../enlaces/imprimir_pdf.png" border="0"></a>');

$datos=busca_filtro_tabla("","documento","iddocumento=".$_REQUEST["iddoc"],"",$conn);
//print_r($datos);
/*include_once($ruta_db_superior."db.php");
include_once('../librerias/estilo_formulario.php');
include_once($ruta_db_superior.'formatos/librerias/funciones_generales.php');
include_once($ruta_db_superior.'librerias_saia.php');
include_once('librerias_riesgos.php');*/

include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior.'formatos/librerias/estilo_formulario.php');
include_once($ruta_db_superior.'formatos/librerias/funciones_generales.php');
include_once($ruta_db_superior.'riesgos_proceso/librerias_riesgos.php');

ini_set("display_errors",false);

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
<p><br />
<?php                 
   if(@$_REQUEST["enlace_adicionar_formato"] && @$_REQUEST["iddoc"]){
      $formato=busca_filtro_tabla("","formato","nombre_tabla LIKE 'ft_riesgos_proceso'","",$conn);
      if($formato["numcampos"]){
        //agrega_boton("texto","../../botones/formatos/adicionar.gif","../../responder.php?idformato=".$formato[0]["idformato"]."&iddoc=".$_REQUEST["padre"],"","Adicionar ".$formato[0]["etiqueta"],$formato[0]["nombre_tabla"],"","",0);
        agrega_boton("texto","../../botones/formatos/adicionar.gif","../../formatos/riesgos_proceso/adicionar_riesgos_proceso.php?idformato=".$formato[0]["idformato"]."&padre=".$_REQUEST["padre"]."&from_riesgos=1","","Adicionar ".$formato[0]["etiqueta"],$formato[0]["nombre_tabla"],"","",0);
        echo("<br /><br />");
        $alto_frame="94%";
      }
    }
$datos=explode("-",$_REQUEST["llave"]);
?>

  <table cellpadding=2 border=1 width=100% style="border-collapse:collapse">
    <tr>
<?php 
	//if(usuario_actual("login") == '0k'){
?>
    	<td>
        	<!--a href="<?php echo $ruta_db_superior; ?>pantallas/buscador_principal.php?idbusqueda=221&variable_busqueda=<?php echo(@$datos[2]); ?>" target="">MOSTRAR COMO MAPA DE RIESGOS</a-->			
			<a href="<?php echo $ruta_db_superior; ?>formatos/riesgos_proceso/mostrar_riesgos_resumen2.php?llave=<?php echo($_REQUEST["llave"]);?>" target="">MAPA DE RIESGOS DE GESTION DEL PROCESO</a>				
        </td>
<?php
	//}
?>
        <!--td>
        	<a href="previo_mostrar_riesgos_proceso.php?llave=<?php echo(@$_REQUEST["llave"]);?>">MOSTRAR COMO CUADRO DE MANDO</a>
        </td-->
        <td>
        	<a href="GUIA_DE_RIESGOS_DAFP_2012_V2.pdf" target="_blank">GU&Iacute;A ADMINISTRACI&Oacute;N DE RIESGOS</a>
        </td>
        <td>
        	<a title="Los riesgos en los cuales <?php echo usuario_actual('nombres').' '.usuario_actual('apellidos'); ?> aparece como responsable en la administraci&oacute;n del riesgo" href="<?php echo 'previo_mostrar_riesgos_proceso2.php?llave='.$_REQUEST["llave"].'&responsable='.usuario_actual('funcionario_codigo');?>" target="_self">MIS RESPONSABILIDADES SOBRE LA ADMINISTRACI&Oacute;N DEL RIESGO</a>
        </td>
    </tr>
    <tr>     	
	<td> 
			<?php
				$idft_papa = busca_filtro_tabla("","ft_proceso","documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);
			?>
			
			
        	<a  title="" href="<?php echo($ruta_db_superior);?>formatos/contexto_extrategico/adicionar_contexto_extrategico.php?anterior=<?php echo($_REQUEST['iddoc']);?>&padre=<?php echo($idft_papa[0]['idft_proceso']);?>&idformato=211" target="_self">CONTEXTO EXTRAT&Eacute;GICO</a>(<a class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 500, height: 700,preserveContent:true} )" href="ayuda_contexto_estrategico_riesgos.php"><b>ayuda</b></a>)
        	<?php
				$t=1;
				if($t==0){
			?>
        	
        	<div class="highslide-maincontent">
          <p style="text-align:right"><b>¿QU&Eacute; ES EL CONTEXTO EXTRAT&Eacute;GICO?</b></p>
          <p style="text-align:justify">Son las condiciones internas y del entorno, que pueden generar eventos que originan oportunidades o afectan negativamente el cumplimiento de la misi&oacute;n y objetivos de una instituci&oacute;n.</p>
          <p style="text-align:justify">Las situaciones del entorno o externas pueden ser de car&aacute;cter social, cultural, econ&oacute;mico, tecnol&oacute;gico, pol&iacute;tico y legal, bien sean internacional, nacional o regional seg&uacute;n sea el caso de an&aacute;lisis.</p>
          <p style="text-align:justify">Las situaciones internas est&aacute;n relacionadas con la estructura, cultura organizacional, el modelo de operaci&oacute;n, el cumplimiento de los planes y programas, los sistemas de informaci&oacute;n, los procesos y procedimientos y los recursos humanos y econ&oacute;micos con los que cuenta una entidad.</p>
          <table style="width:100%;font-size:12pt;border-collapse:collapse" border="1px">
          	<tr>
          		<td style="font-size:10pt;text-align:center;background:#D0D1D3" colspan="2"><b>EJEMPLO DE FACTORES INTERNOS Y EXTERNOS DE RIESGO</b></td>
          	</tr>
          	<tr style="background:#E6E6E7">
          		<td style="font-size:10pt;text-align:center"><b>FACTORES EXTERNOS</b></td>
          		<td style="font-size:10pt;text-align:center"><b>FACTORES INTERNOS</b></td>
          	</tr>
          	<tr>
          		<td style="font-size:10pt;text-align:justify"><b>Econ&oacute;micos:</b> disponibilidad de capital, emisi&oacute;n de deuda o no pago de la misma, liquidez, mercados financieros, desempleo, competencia.</td>
          		<td style="font-size:10pt;text-align:justify"><b>Infraestructura:</b> disponibilidad de activos, capacidad de los activos, acceso al capital.</td>
          	</tr>
          	<tr>
          		<td style="font-size:10pt;text-align:justify"><b>Medioambientales:</b> emisiones y residuos, energ&iacute;, cat&aacute;strofes naturales, desarrollo sostenible.</td>
          		<td style="font-size:10pt;text-align:justify"><b>Personal:</b> capacidad del persona, salud, seguridad.</td>
          	</tr>
          	<tr>
          		<td style="font-size:10pt;text-align:justify"><b>Pol&iacute;ticos:</b> cambios de gobierno, legislaci&oacute;n, pol&iacute;ticas p&uacute;blicas, regulaci&oacute;n.</td>
          		<td style="font-size:10pt;text-align:justify"><b>Procesos:</b> capacidad, dise&ntilde;o, ejecuci&oacute;n, proveedores, entradas, salidas, conocimiento.</td>
          	</tr>
          	<tr>
          		<td style="font-size:10pt;text-align:justify"><b>Sociales:</b> demograf&iacute;a, responsabilidad social, terrorismo.</td>
          		<td style="font-size:10pt;text-align:justify" rowspan="2"><b>Tecnolog&iacute;a:</b> integridad de datos, disponibilidad de datos y sistemas, desarrollo, producci&oacute;n, mantenimiento.</td>
          	</tr>
          	<tr>
          		<td style="font-size:10pt;text-align:justify"><b>Tecnol&oacute;gicos:</b> interrupciones, comercio electr&oacute;nico, datos externos, tecnolog&iacute;a emergente.</td>
          	</tr>
          </table>
          </div>
          <?php
        	}
        	?>
        </td> 
       
        <td><a href="mostrar_riesgos_tipo_corrupcion.php" target="_self">MAPA DE RIESGOS DE CORRUPCI&Oacute;N INSTITUCIONAL</a></td> 
        	<td><a href="mapa_riesgos_institucional.php" target="_self">MAPA DE RIESGOS INSTITUCIONAL</a></td>
	</tr>
	<tr>
		<td ><a href="matriz_riesgos_institucional.php" target="_self">MATRIZ DE RIESGOS INSTITUCIONAL</a></td>
	</tr>	
  </table>
  <br /><br /><br />
</p>
<table border="1" width="100%" cellspacing="0" class="tabla_borde" style="border-collapse:collapse">
  <tbody>
    <tr>
      <td  style="background:#E7E7E9" rowspan="2" align="center" >PROBABILIDAD</td>
      <td  style="text-align: center;background:#E7E7E9" colspan="5" >IMPACTO</td>
    </tr>
    <tr>
      <td  style="text-align: center;background:#E7E7E9" >Insignificante<br />(1)</td>
      <td  style="text-align: center;background:#E7E7E9" >Menor<br />(2)</td>
      <td  style="text-align: center;background:#E7E7E9" >Moderado<br />(3)</td>
      <td  style="text-align: center;background:#E7E7E9" >Mayor<br />(4)</td>
      <td  style="text-align: center;background:#E7E7E9" >Catastr&oacute;fico<br />(5)</td>
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
</p>
<p>&nbsp;
</p>
</p>
<?php
$proceso = busca_filtro_tabla("nombre,".fecha_db_obtener('fecha_revision_riesgo','d/m/Y H:i:s')." as fecha_revision,".fecha_db_obtener('fecha_aprobacion_riesgo','d/m/Y H:i:s')." as fecha_aprobacion,aprobado_por,revisado_por,lider_proceso,responsable,idft_proceso","ft_proceso","documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);
$revisado = busca_filtro_tabla("b.nombres,b.apellidos,b.funcionario_codigo","dependencia_cargo a,funcionario b","a.funcionario_idfuncionario=b.idfuncionario AND iddependencia_cargo=".$proceso[0]['revisado_por'],"",$conn);
$aprobado = busca_filtro_tabla("b.nombres,b.apellidos,b.funcionario_codigo","dependencia_cargo a,funcionario b","a.funcionario_idfuncionario=b.idfuncionario AND iddependencia_cargo=".$proceso[0]['aprobado_por'],"",$conn);
$lider = busca_filtro_tabla("b.nombres,b.apellidos,b.funcionario_codigo","funcionario b","b.funcionario_codigo in(".$proceso[0]['lider_proceso'].")","",$conn);
$responsable = busca_filtro_tabla("b.nombres,b.apellidos,b.funcionario_codigo","funcionario b","b.funcionario_codigo in(".$proceso[0]['responsable'].")","",$conn);
$lider_proceso = explode(",", $proceso[0]['lider_proceso']);

if(in_array(usuario_actual('funcionario_codigo'),$lider_proceso)){	
	echo('<a id="revisado_por" class="label label-success">Revisado por</a>');
}
?>
<table style="border-collapse:collapse; margin-top: 4px;" border="1" id="tabla_revisado_por">
<tr>
  <td style="text-align: center;" colspan="2">Revisado por Lider del Proceso</td>
</tr>
<?php 
    $tr_lider="";
    $hist_lider=busca_filtro_tabla("v.nombres,v.apellidos,".fecha_db_obtener('fecha_revision','d/m/Y H:i:s')." as fecha_revi,".fecha_db_obtener('fecha_cambio','d/m/Y H:i:s')." as fecha_cambio","cf_historial_proceso cf,funcionario v","v.funcionario_codigo=cf.lider_proceso and cf.documento_iddocumento=".$_REQUEST['iddoc'],"cf.idcf_historial_proceso asc",$conn);
    if($hist_lider["numcampos"]){
       for($i=0;$i<$hist_lider["numcampos"];$i++){
         $tr_lider.="<tr>";
           $tr_lider.="<td>".ucwords(strtolower($hist_lider[$i]['nombres'].' '.$hist_lider[$i]['apellidos']))."</td>"; 
           $tr_lider.="<td>".$hist_lider[$i]["fecha_revi"]."</td>";   
        $tr_lider.="</tr>";    
       }  
    }elseif($lider["numcampos"]){
      $tr_lider.="<tr>";
        $tr_lider.="<td>".ucwords(strtolower($lider[0]['nombres'].' '.$lider[0]['apellidos']))."</td>";  
        $tr_lider.="<td id='fecha_revision'>".($proceso[0]['fecha_revision'])."</td>";  
      $tr_lider.="</tr>";
    }
  echo $tr_lider;
?>
</table>
<br />
<?php
$responsable_proceso = explode(",", $proceso[0]['responsable']);

if(in_array(usuario_actual('funcionario_codigo'),$responsable_proceso)){	
	echo('<a id="aprobado_por" class="label label-success"> Aprobado por Responsable del Proceso</a>');
}
?>
<table style="border-collapse:collapse; margin-top: 4px;" border="1" id="tabla_aprobado_por">
<tr>
  <td style="text-align: center;" colspan="2">Aprobado por</td>
</tr>
<?php 
    $tr_resp="";
    $hist_respon=busca_filtro_tabla("v.nombres,v.apellidos,".fecha_db_obtener('fecha_aprobacion','d/m/Y H:i:s')." as fecha_aprob","cf_historial_proceso cf,funcionario v","v.funcionario_codigo=cf.responsable and cf.documento_iddocumento=".$_REQUEST['iddoc'],"cf.idcf_historial_proceso asc",$conn);
    if($hist_respon["numcampos"]){
     for($i=0;$i<$hist_respon["numcampos"];$i++){
       $tr_resp.="<tr>";
         $tr_resp.="<td>".ucwords(strtolower($hist_respon[$i]['nombres'].' '.$hist_respon[$i]['apellidos']))."</td>"; 
         $tr_resp.="<td>".$hist_respon[$i]["fecha_aprob"]."</td>";    
       $tr_resp.="</tr>";    
     }  
    }elseif($responsable["numcampos"]){
      $tr_resp.="<tr>";
        $tr_resp.="<td>".ucwords(strtolower($responsable[0]['nombres'].' '.$responsable[0]['apellidos']))."</td>";  
        $tr_resp.="<td id='fecha_aprobacion'>".($proceso[0]['fecha_aprobacion'])."</td>";  
      $tr_resp.="</tr>";
    }
  echo $tr_resp;
	?>
</table>
<?php
$corrupcion=busca_filtro_tabla("a.tipo_riesgo","ft_riesgos_proceso a, ft_proceso b, documento d","a.documento_iddocumento=d.iddocumento and a.tipo_riesgo='Corrupcion' and a.estado not in ('INACTIVO') and  b.idft_proceso=a.ft_proceso and d.estado not in ('ACTIVO','ELIMINADO','ANULADO') and b.documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
if($corrupcion["numcampos"]!=0){
		echo ('<br/><br/><table style="border-collapse:collapse; margin-top: 4px;" border="0"><tr><td style="text-align: center; font-size:16px">MAPA DE RIESGOS DE CORRUPCIÓN</td></tr></table><br/>');
	
$url="mostrar_riesgos_tipo_corrupcion.php?excel=1";
	$tabla = '
   <a target="_blank" href="'.$url.'">
    <img src="'.$ruta_db_superior.'enlaces/imprimir.gif" height="30" width="30" border="0">
   </a>';
   include_once($ruta_db_superior.'formatos/riesgos_proceso/mostrar_riesgos_tipo_corrupcion.php');
}

cuadrante();
function cuadrante(){
global $conn,$formato,$proceso;
$texto="";
$dato=explode("-",$_REQUEST["llave"]); 

$riesgos=busca_filtro_tabla("a.impacto, a.probabilidad, a.descripcion as nombre, a.idft_riesgos_proceso, a.consecutivo, a.documento_iddocumento","ft_riesgos_proceso a, documento b","lower(a.estado) not in('inactivo') and lower(b.estado) not in('eliminado','anulado') and a.documento_iddocumento=b.iddocumento and a.ft_proceso=".$dato[2]." AND a.tipo_riesgo not in('Corrupcion')","idft_riesgos_proceso asc",$conn);

for($i=0;$i<$riesgos["numcampos"];$i++){
		
	$probabilidad = obtener_probabilidad_riesgo($riesgos[$i]["idft_riesgos_proceso"], $riesgos[$i]["probabilidad"]);
	$impacto      = obtener_impacto_riesgo($riesgos[$i]["idft_riesgos_proceso"], $riesgos[$i]["impacto"]);		
	
	$texto='';
	$texto.='<a style="color:blue;" title="" href="mostrar_riesgos_proceso.php?idformato='.$formato[0]["idformato"].'&iddoc='.$riesgos[$i]["documento_iddocumento"].'" class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 550, height:400,preserveContent:false } )" style="text-decoration: underline; cursor:pointer;">Riesgo No.'.strip_tags($riesgos[$i]["consecutivo"]).'</a><br />';
	
	llenar_evaluaciones($impacto,$probabilidad,$texto);
}	
	return($texto);
}


function obtener_probabilidad_riesgo($idft_riesgos_proceso, $probabilidad){
	global $conn;	
	
	$control_riesgos_probabilidad = busca_filtro_tabla("a.herramienta_ejercer, a.procedimiento_herramienta, a.herramienta_efectiva, a.responsables_ejecucion,  a.frecuencia_ejecucion","ft_control_riesgos a, documento b","a.tipo_control=1 and a.documento_iddocumento=b.iddocumento and lower(b.estado) not in('eliminado','anulado') and ft_riesgos_proceso=".$idft_riesgos_proceso,"a.idft_control_riesgos desc",$conn);
	
	$posiciones = 0;
	for ($i=0; $i < $control_riesgos_probabilidad["numcampos"]; $i++) {		
		$mover_probabilidad = 0;
		
		if($control_riesgos_probabilidad[0]["herramienta_ejercer"] == 1){
			$mover_probabilidad += 15;
		}
		
		if($control_riesgos_probabilidad[0]["procedimiento_herramienta"] == 1){
			$mover_probabilidad += 15;
		}
		
		if($control_riesgos_probabilidad[0]["herramienta_efectiva"] == 1){
			$mover_probabilidad += 30;
		}
		
		if($control_riesgos_probabilidad[0]["responsables_ejecucion"] == 1){
			$mover_probabilidad += 15;
		}
		
		if($control_riesgos_probabilidad[0]["frecuencia_ejecucion"] == 1){
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

function obtener_impacto_riesgo($idft_riesgos_proceso, $impacto){
	global $conn;		
	
	$control_riesgos_impacto = busca_filtro_tabla("a.herramienta_ejercer, a.procedimiento_herramienta, a.herramienta_efectiva, a.responsables_ejecucion,  a.frecuencia_ejecucion","ft_control_riesgos a, documento b","a.tipo_control=2 and a.documento_iddocumento=b.iddocumento and lower(b.estado) not in('eliminado','anulado') and ft_riesgos_proceso=".$idft_riesgos_proceso,"a.idft_control_riesgos desc",$conn);
	
	$posiciones = 0;			
	for ($i=0; $i < $control_riesgos_impacto["numcampos"]; $i++){		
		
		$mover_impacto = 0;
			
		if($control_riesgos_impacto[0]["herramienta_ejercer"] == 1){
			$mover_impacto += 15;
		}
		
		if($control_riesgos_impacto[0]["procedimiento_herramienta"] == 1){
			$mover_impacto += 15;
		}
		
		if($control_riesgos_impacto[0]["herramienta_efectiva"] == 1){
			$mover_impacto += 30;
		}
		
		if($control_riesgos_impacto[0]["responsables_ejecucion"] == 1){
			$mover_impacto += 15;
		}
		
		if($control_riesgos_impacto[0]["frecuencia_ejecucion"] == 1){
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
<script type="text/javascript">
	$(document).ready(function(){
		var proceso          = "<?php echo($proceso[0]['nombre']);?>";		
		var iddocumento	     = "<?php echo($_REQUEST['iddoc']);?>";		
		var fecha_revision   = "<?php echo($proceso[0]['fecha_revision']);?>";
		var fecha_aprobacion = "<?php echo($proceso[0]['fecha_aprobacion']);?>";		
		
		if(!fecha_revision){
			$('#tabla_revisado_por').hide();
			$('#revisado_por').after('<br />')
		}
		
		if(!fecha_aprobacion){
			$('#tabla_aprobado_por').hide();
		}		
		
		$("#revisado_por").click(function(){			
			if (confirm("¿Desea confirmar el proceso "+proceso+"?")){				
				$.ajax({
					url: 'actualizar_feha_revision_aprobacion.php',
					type: 'POST',
					async: false,
					dataType: 'html',
					data: {
						iddocumento: iddocumento,
						tipo	   : 'revisado'
					},
					success: function(datos){			
						$('#fecha_revision').html('');
						$('#fecha_revision').html(datos);
						$('#tabla_revisado_por').show();
					}
				});
			}
		});
		 
		$("#aprobado_por").click(function(){
			if (confirm("¿Desea confirmar el proceso "+proceso+"?")){
				$.ajax({
					url: 'actualizar_feha_revision_aprobacion.php',
					type: 'POST',
					async: false,
					dataType: 'html',
					data: {
						iddocumento: iddocumento,
						tipo	   : 'aprobado'
					},
					success: function(datos){						
						$('#fecha_aprobacion').html('');
						$('#fecha_aprobacion').html(datos);
						$('#tabla_aprobado_por').show();
					}
				});
			}			
		});
		
		hs.Expander.prototype.onAfterClose = function(sender){
			$.ajax({
				url: 'actualizar_feha_revision_aprobacion.php',
				type: 'POST',
				async: false,
				dataType: 'json',
				data: {
					iddocumento: iddocumento,
					tipo	   : 'chequeo'
				},
				success: function(datos){
					console.log(datos);
					if(!datos.fecha_aprobacion){
						$('#tabla_aprobado_por').hide();
					}
					if(!datos.fecha_revision){
						$('#tabla_revisado_por').hide();
					}				
				}
			});		
		};
	});
</script>
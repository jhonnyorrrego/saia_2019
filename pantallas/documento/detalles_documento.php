<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
?>
<!DOCTYPE html>
<?php
echo(librerias_html5());
echo(estilo_bootstrap());
include_once($ruta_db_superior."pantallas/documento/librerias.php");
include_once($ruta_db_superior."pantallas/documento/librerias_flujo.php");
include_once($ruta_db_superior."pantallas/ejecutor/librerias.php");
include_once($ruta_db_superior."pantallas/flujo/librerias.php");
include_once($ruta_db_superior."pantallas/almacenamiento/librerias.php");
include_once($ruta_db_superior."pantallas/expediente/librerias.php");
include_once($ruta_db_superior."pantallas/anexos/librerias.php");
include_once($ruta_db_superior."pantallas/tareas/librerias.php");
include_once($ruta_db_superior."pantallas/workflow/librerias.php");
if(@$_REQUEST["iddoc"]){
	$iddocumento=$_REQUEST["iddoc"];
}
$documento=busca_filtro_tabla("","documento","iddocumento=".$iddocumento,"",$conn);
$documento_origen_flujo=documento_origen_flujo($iddocumento,$documento[0]["plantilla"]);
$pasos["numcampos"]=0;
if($documento_origen_flujo["numcampos"]){
	$pasos=busca_filtro_tabla("","paso","diagram_iddiagram=".$documento_origen_flujo[0]["diagram_iddiagram"]." AND estado=1","",$conn);
	$flujo=estado_flujo_instancia($documento_origen_flujo[0]["idpaso_documento"]);
	$pasos_documento=busca_filtro_tabla("*,".  fecha_db_obtener("fecha_limite","Y-m-d")." AS fecha_limite2","paso_documento","diagram_iddiagram_instance=".$flujo[0]["iddiagram_instance"],"idpaso_documento",$conn);
}
?>
<style type="text/css">
.well{ margin-bottom: 3px; min-height: 11px; padding: 10px;}.alert{ margin-bottom: 3px;  padding: 10px;}  body{ font-size:12px; line-height:100%;}.navbar-fixed-top, .navbar-fixed-bottom{ position: fixed;} .navbar-fixed-top, .navbar-fixed-bottom, .navbar-static-top{margin-right: 0px; margin-left: 0px;}
.texto-azul{ color:#3176c8}
.pull-center.navbar .nav,.pull-center.navbar .nav > li { float:none; display:inline-block; *display:inline;    *zoom:1; vertical-align: top;}
.pull-center .navbar-inner {text-align:center;}
.pull-center .dropdown-menu {text-align: left;}
.pull-center{text-align:center;}
.table th, .table td {line-height: 10px;text-align: left;}
.collapse .in { overflow:auto; }
</style>
<body>
<div class="container">
	<div>
<?php
if(is_object($documento[0]["fecha"])){
   $documento[0]["fecha"]=$documento[0]["fecha"]->format("Y-m-d");
}
echo(origen_documento($documento[0]["iddocumento"],$documento[0]["numero"],$documento[0]["ejecutor"],$documento[0]["tipo_radicado"],$documento[0]["estado"],$documento[0]["serie"],$documento[0]["tipo_ejecutor"])); ?>
<?php echo(fecha_creacion_documento($documento[0]["fecha"],$documento[0]["plantilla"],$documento[0]["iddocumento"])); ?><br></div>
<div class="row">

	<!--div class="pull-left"><b>Proceso: </b><?php echo(nombre_flujo($iddocumento,$documento[0]["plantilla"])); ?></div>
	<b><div class="texto-azul pull-right paso_actual"></div></b>
</div>
	<br />
	<div style="text-align: justify;"><?php echo(codifica_encabezado(html_entity_decode($documento[0]["descripcion"])));?></div><br />
	<div class="btn-group pull-center"><?php echo(barra_adicional_documento($iddocumento));?></div><br /--><br />
<div data-toggle="collapse" data-target="#div_info_doc" style="cursor:pointer;">
  <i class="icon-minus-sign"></i>  <b>Informaci&oacute;n del documento</b>
</div>
<div id="div_info_doc"  class="collapse in opcion_informacion">
<table class="table table-bordered">
  <tr>
    <td width="40%" class="prettyprint">
      <b>N&uacute;mero de radicado:</b>
    </td>
    <td>
       <?php echo($documento[0]["numero"]);?>
    </td>
    <td class="prettyprint">
      <b>Estado: </b>
    </td>
    <td>
      <?php echo($documento[0]["estado"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Tipo de documento:</b>
    </td>
    <td>
       <?php echo(serie_documento($documento[0]["serie"]));?>
    </td>
    <td class="prettyprint">
      <b>Almacenado en el expediente:</b>
    </td>
    <td>
<?php
$exp_documento=busca_filtro_tabla("","expediente_doc","documento_iddocumento in(".$iddocumento.")","",$conn);
if($exp_documento["numcampos"]){
	$exp_doc=extrae_campo($exp_documento,"expediente_idexpediente","U");
	$nombres_expedientes=busca_filtro_tabla("nombre","expediente a","idexpediente in(".implode(",",$exp_doc).")","",$conn);
	$nombres_exp=array_unique(extrae_campo($nombres_expedientes,"nombre"));
	echo("<ul><li>".ucwords(strtolower(implode("</li><li>",$nombres_exp)))."</li></ul>");
}
else{
	echo("Documento sin almacenar");
}
?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Aprobado por:</b>
    </td>
    <td colspan="3">
       <?php
			$aprobado = busca_filtro_tabla("nombres, apellidos, ".fecha_db_obtener("A.fecha","Y-m-d")." as fecha","buzon_salida A, funcionario B","B.funcionario_codigo=A.origen AND nombre LIKE 'APROBADO' AND A.archivo_idarchivo=".$iddocumento,"",$conn);
			if($aprobado['numcampos']){
				$fecha=date_parse($aprobado[0]['fecha']);
				$fecha = mostrar_fecha_saia($fecha["day"]."-".$fecha["month"]."-".$fecha["year"]);
				echo('<table><tr style="border: 0px;"><td style="border: 0px;">'.ucwords(strtolower($aprobado[0]['nombres']." ".$aprobado[0]['apellidos'])).'</td><td style="border: 0px;"> El '.$fecha.'</td></tr></table>');
			}else{
				echo('<table><tr style="border: 0px;"><td style="border: 0px;">Pendiente</td></tr></table>');
			}

       ?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Revisado por:</b>
    </td>
    <td colspan="3">
       <?php
       $revisado = busca_filtro_tabla("nombres, apellidos, ".fecha_db_obtener("A.fecha","Y-m-d")." as fecha","buzon_salida A, funcionario B","B.funcionario_codigo=A.origen AND nombre LIKE 'REVISADO' AND A.archivo_idarchivo=".$iddocumento,"",$conn);
       		if($revisado['numcampos']){
       			echo('<table>');
       			for($i=0; $i < $revisado['numcampos']; $i++){
       				$fecha=date_parse($revisado[$i]['fecha']);
					$fecha = mostrar_fecha_saia($fecha["day"]."-".$fecha["month"]."-".$fecha["year"]);
					echo('<tr style="border: 0px;"><td style="border: 0px;">'.ucwords(strtolower($revisado[0]['nombres']." ".$revisado[0]['apellidos'])).'</td><td style="border: 0px; padding: 0px;">El '.$fecha.'</td></tr>');
       			}
				echo('</table>');
       		}
       ?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Elaborado por:</b>
    </td>
    <td colspan="3">
       <?php
        $elaborado = busca_filtro_tabla("nombres, apellidos, ".fecha_db_obtener("A.fecha","Y-m-d")." as fecha","documento A, funcionario B","B.funcionario_codigo=A.ejecutor AND A.iddocumento=".$iddocumento,"",$conn);
       	$fecha=date_parse($elaborado[0]['fecha']);
				$fecha = mostrar_fecha_saia($fecha["day"]."-".$fecha["month"]."-".$fecha["year"]);
				echo('<table><tr style="border: 0px;"><td style="border: 0px;">'.ucwords(strtolower($elaborado[0]['nombres']." ".$elaborado[0]['apellidos'])).'</td><td style="border: 0px;">El '.$fecha.'</td></tr></table>');
       ?>
    </td>
  </tr>
</table>
</div>
<?php
if($documento_origen_flujo["numcampos"]){
?>
<!-- div data-toggle="collapse" data-target="#div_info_flujo">
  < i class="icon-plus-sign"></i >  <b>Informaci&oacute;n del Flujo</b>
</div -->
<div id="div_info_flujo"  class="collapse  opcion_informacion">
<table class="table table-bordered">
  <tr>
    <td width="20%" class="prettyprint">
      <b>Flujo</b>
    </td>
    <td>
      <?php
      echo(nombre_flujo($iddocumento,$documento[0]["plantilla"]));
      ?>
    </td>
    <td class="prettyprint">
      <b>Vencimiento</b>
    </td>
    <td>
      <?php
      	echo(fecha_barra_documento($iddocumento));
      ?>
    </td>
  </tr>
  <tr>
  	<td><b>Actual</b></td>
  	<td colspan="2">
  		<div id="nombre_paso_actual"></div>
		</td>
  	<td><div class="paso_actual"></div></td>
  </tr>
  <tr class="prettyprint">
    <td>
    	<div class="pull-center">Paso</div>

    </td>
    <td>
	  <div class="pull-center">Nombre del paso</div>
    </td>
    <td colspan="2">
    	<div class="pull-center">Responsable del paso</div>
    </td>
  </tr>
  <?php
  $datos_paso_documento=extrae_campo($pasos_documento,"paso_idpaso","U");
  $texto='';
  $paso_actual=$pasos["numcampos"];
  for($i=0;$i<$pasos["numcampos"];$i++){
  	$parametros_paso_documento["dato"]=1;
		$estado_paso="btn-warning";
		$esta=array_search($pasos[$i]["idpaso"],$datos_paso_documento);
		$responsable_paso='';
		if($esta!==false){
			$estado_paso_documento = estado_paso_documento($pasos_documento[$esta]["idpaso_documento"]);
			$estado=$estado_paso_documento[0]["estado_paso_documento"];
			if($estado==3 || $estado==5 || $estado==7)
			    $estado_paso="btn-danger";
			elseif ($estado==1 || $estado==2){
			 	$estado_paso="btn-success";
				$responsable_paso=responsable_paso($pasos_documento[$esta]["idpaso_documento"]);
			}
			else
			    $estado_paso="btn-warning";
			$nombre_paso_actual=$pasos[$i]["nombre_paso"];
	 	}
	 	else{
			$paso_actual=$i;
	 	}
		if($responsable_paso==''){
			$responsable_paso='Sin asignar';
		}
		$texto.='<tr>';
		$texto.='<td><div class="pull-center">'.($i+1).'</div></td>';
		$texto.='<td>'.$pasos[$i]["nombre_paso"].'</td>';
		$texto.='<td colspan="2">'.$responsable_paso.'</td>';
		$texto.='</tr>';
  }
	$cadena_paso_actual="Paso ".$paso_actual." de ".$i;
  echo($texto);
  ?>
</table>
</div>
<?php
}
//$ubucación_fisica= busca_filtro_tabla("","","","",$conn);
$ubucación_fisica['numcampos'] = 0;
$despacho= busca_filtro_tabla("","salidas","estado<>0 AND documento_iddocumento=".$iddocumento,"",$conn);
if($ubucación_fisica['numcampos'] || $despacho['numcampos']){
?>
<div data-toggle="collapse" data-target="#div_info_disposicion">
  <i class="icon-minus-sign"></i>  <b>Disposici&oacute;n del documento</b>
</div>
<div id="div_info_disposicion"  class="collapse in opcion_informacion">
<table class="table table-bordered" id="listado_disposicion">
<!--tr>
	<td class="prettyprint">
		Ubicaci&oacute;n f&iacute;sica
	</td>
	<td>

	</td>
</tr-->
<tr>
	<td class="prettyprint">
		Despachos
	</td>
	<td>
		<?php
			if($despacho['numcampos']){
				for ($i=0; $i < $despacho['numcampos']; $i++) {
					$anexos=busca_filtro_tabla("","anexos","documento_iddocumento=".$iddocumento,"idanexos desc",$conn);
					if(is_object($despacho[$i]["fecha_despacho"])){
            $despacho[$i]["fecha_despacho"]=$despacho[$i]["fecha_despacho"]->format("Y-m-d");
          }
					$empresa = busca_filtro_tabla("nombre","ejecutor","idejecutor=".$despacho[$i]["empresa"],"",$conn);
					if($despacho[$i]['tipo_despacho']==2){ //Mensajeria Interna
						$responsable = busca_filtro_tabla(concatenar_cadena_sql(array("nombres","''","apellidos"))." as nombre","funcionario","idfuncionario=".$despacho[$i]["responsable"],"",$conn); //Mensajeros
					}else{ //Mensajeria Externa
						$responsable = busca_filtro_tabla("nombre","ejecutor","idejecutor=".$despacho[$i]["responsable"],"",$conn);
					}
					$tipo_despacho=array(1=>"Mensajeria Externa",2=>"Mensajeria Interna",3=>"Entrega Personal");
					$texto="Tipo Despacho: ".$tipo_despacho[$despacho[$i]['tipo_despacho']]." <br />";					
					$texto .= "Fecha: ".$despacho[$i]['fecha_despacho']."<br />";
					//$texto .= "Destino: <br />";
					$texto .= "Empresa de mensajeria: ".$empresa[0]['nombre']."<br />";
					$texto .= "Responsable: ".$responsable[0]['nombre']."<br />";
					$texto .= "Gu&iacute;a: ".$despacho[$i]['numero_guia']."<br />";
					if($despacho[$i]['notas']){
						$texto .= "Observaciones: ".$despacho[$i]['notas']."<br />";
					}
					if($anexos['numcampos'] && $despacho[$i]['tipo_despacho']==1)
					$texto .= "Soporte: <a href='".$ruta_db_superior."anexosdigitales/parsea_accion_archivo.php?idanexo=".$anexos[0]['idanexos']."&accion=descargar'>".$anexos[0]['etiqueta']."</a><br />";
					echo("<div class='well'>".$texto."</div>");
				}
			}
		?>
	</td>
</tr>
</table>
</div>
<?php
}
$consulta_otrainformacion = 0; //busca_filtro_tabla("","","","",$conn);
if($consulta_otrainformacion){
?>

<div data-toggle="collapse" data-target="#div_info_adicional">
  <i class="icon-minus-sign"></i>  <b>Otra Informaci&oacute;n</b>
</div>
<div id="div_info_adicional"  class="collapse in opcion_informacion">
<table class="table table-bordered" id="listado_otra_informacion">
</table>
</div>
</div>
<?php
}
echo(librerias_jquery("1.7"));
echo(librerias_tooltips());
echo(librerias_bootstrap());
echo(librerias_acciones_kaiten());
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#nombre_paso_actual").html("<?php echo($nombre_paso_actual);?>");
	$(".paso_actual").html("<?php echo($cadena_paso_actual);?>");
	iniciar_tooltip();
    $(".opcion_informacion").on("hide",function(){
      $(this).prev().children("i").removeClass();
      $(this).prev().children("i").addClass("icon-plus-sign");
    });
    $(".opcion_informacion").on("show",function(){
      $(this).prev().children("i").removeClass();
      $(this).prev().children("i").addClass("icon-minus-sign");
    });
    $(".documento_actual",parent.document).removeClass("alert-info");
    $(".documento_actual",parent.document).removeClass("documento_actual");
    $("#resultado_pantalla_<?php echo($iddocumento);?>",parent.document).addClass("documento_actual").addClass("alert-info");
});
</script>
</body>

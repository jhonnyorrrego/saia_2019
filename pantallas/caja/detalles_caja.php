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
include_once($ruta_db_superior."pantallas/caja/librerias.php");
include_once($ruta_db_superior."pantallas/anexos/librerias.php");
include_once($ruta_db_superior."pantallas/tareas/librerias.php");
include_once($ruta_db_superior."pantallas/workflow/librerias.php");
echo(librerias_jquery("1.7"));
if(@$_REQUEST["idcaja"]){
	$idcaja=$_REQUEST["idcaja"];	
} 
$caja=busca_filtro_tabla("","caja","idcaja=".$idcaja,"",$conn);
//print_r($caja["sql"]);
?>   
<style>
.well{ margin-bottom: 3px; min-height: 11px; padding: 10px;}.alert{ margin-bottom: 3px;  padding: 10px;}  body{ font-size:12px; line-height:100%;}.navbar-fixed-top, .navbar-fixed-bottom{ position: fixed;} .navbar-fixed-top, .navbar-fixed-bottom, .navbar-static-top{margin-right: 0px; margin-left: 0px;}
.texto-azul{ color:#3176c8}
.pull-center.navbar .nav,.pull-center.navbar .nav > li { float:none; display:inline-block; *display:inline;    *zoom:1; vertical-align: top;}
.pull-center .navbar-inner {text-align:center;}
.pull-center .dropdown-menu {text-align: left;}
.pull-center{text-align:center;}
.table th, .table td {line-height: 10px;text-align: left;}
</style>
<body>
<div class="container"> 
<div data-toggle="collapse" data-target="#div_info_caja">
  <i class="icon-minus-sign"></i>  <b>Informaci&oacute;n del caja</b>
</div><br />
<div id="div_info_caja"  class="collapse in opcion_informacion"> 
<table class="table table-bordered">
	<tr>
    <td class="prettyprint">
      <b>Ubicaci&oacute;n:</b>
    </td>
    <td colspan="3">
<?php 
	$ubicacion=array(1=>'Central',2=>'Gesti&oacute;n',3=>'Historico');
       echo($ubicacion[$caja[0]["ubicacion"]]);
?>
    </td>
  </tr>
	<tr>
    <td class="prettyprint">
      <b>Codigo:</b>
    </td>
    <td colspan="3">
       <?php /*echo($caja[0]["codigo_serie"]."-".$caja[0]["codigo_dependencia"]."-".*/
       echo $caja[0]["no_consecutivo"];?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Fondo:</b>
    </td>
    <td colspan="3">
       <?php echo($caja[0]["fondo"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Seccion:</b>
    </td>
    <td colspan="3">
       <?php echo($caja[0]["seccion"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Subseccion:</b>
    </td>
    <td colspan="3">
       <?php echo($caja[0]["subseccion"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Ubicaci&oacute;n exacta:</b>
    </td>
    <td colspan="3">
       <?php echo($caja[0]["division"]);?>
    </td>
  </tr>
  <tr>
<?php
$expedientes=busca_filtro_tabla("es.serie_idserie","expediente e, entidad_serie es","e.fk_entidad_serie=es.identidad_serie and fk_idcaja=".$caja[0]["idcaja"],"",$conn);
if($expedientes["numcampos"]){
	$listado_series = array();
	for($i=0;$i<$expedientes["numcampos"];$i++){
		$series=busca_filtro_tabla("nombre","serie","idserie=".$expedientes[$i]["serie_idserie"],"",$conn);
		$listado_series[]=$series[0]["nombre"];
	}
}
$listado_series=array_unique($listado_series);
$listado_series=implode(", ", $listado_series);
//$nombre_serie=busca_filtro_tabla("","serie a","a.idserie=".$caja[0]["serie_idserie"],"",$conn);
?>
    <td class="prettyprint">
      <b>Serie vinculada:</b>
    </td>
    <td colspan="3">
       <?php echo($listado_series);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>No carpetas:</b>
    </td>
    <td colspan="3">
       <?php echo consultar_numero_carpetas_caja($caja[0]["idcaja"])?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Fecha extrema inicial:</b>
    </td>
    <td colspan="3">
       <?php echo calcular_fecha_extrema_inicial($caja[0]["idcaja"]) ?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Fecha extrema final:</b>
    </td>
    <td colspan="3">
       <?php echo calcular_fecha_extrema_final($caja[0]["idcaja"])  ?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Estanter&iacute;a:</b>
    </td>
    <td colspan="3">
       <?php echo($caja[0]["modulo"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Entrepa&ntilde;o:</b>
    </td>
    <td colspan="3">
       <?php echo($caja[0]["panel"]);?>
    </td>
  </tr>
   <tr>
    <td class="prettyprint">
      <b>Nivel:</b>
    </td>
    <td colspan="3">
       <?php echo($caja[0]["nivel"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Material:</b>
    </td>
    <td colspan="3">
       <?php echo consulta_material_caja($caja[0]["material"])?>
    </td>
  <tr>
    <td class="prettyprint">
      <b>Seguridad:</b>
    </td>
    <td colspan="3">
<?php 
	$seguridad=array(1=>'Confidencial',2=>'Publica', 3=>'Rutinario', 4=>'Restringido al cargo asignado');
       echo($seguridad[$caja[0]["seguridad"]]);
?>
    </td>
  </tr>
  <?php
  $transferencia_doc=busca_filtro_tabla("","ft_transferencia_doc a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ACTIVO') and ( a.expediente_vinculado like 'cajas_%')","a.idft_transferencia_doc DESC",$conn);
  if($transferencia_doc["numcampos"]){
  	
  ?>
  <tr>
  	<td class="prettyprint"><b>Transferencia documental</b></td>
  	<td colspan="3">
  	    <?php
  	        for($i=0;$i<$transferencia_doc['numcampos'];$i++){
                $ids_caja = trim($transferencia_doc[$i]["expediente_vinculado"], "cajas_");  
  	            $vector_cajas=explode(',',$ids_caja);
  	            
  	            if(in_array($caja[0]["idcaja"],$vector_cajas)){
      	            if(is_object($transferencia_doc[$i]["fecha"]))$transferencia_doc[$i]["fecha"]=$transferencia_doc[$i]["fecha"]->format('Y-m-d H:i');
      	            ?>
      	                <a class="previo_high" enlace="<?php echo($ruta_db_superior.$transferencia_doc[$i]["pdf"]); ?>" style="cursor:pointer">Ver transferencia No <?php echo($transferencia_doc[$i]["numero"]); ?> (<?php echo($transferencia_doc[$i]["fecha"]); ?>)</a>
      	                <br>
      	            <?php
  	            }
  	        }
  	    ?>
  	    
  	
  	</td>
  </tr>
  <script>
		$(document).ready(function(){
			$(".previo_high").click(function(e){
				var enlace=$(this).attr("enlace");
				top.hs.htmlExpand(this, { objectType: 'iframe',width: 1000, height: 600,contentId:'cuerpo_paso', preserveContent:false, src:"pantallas/expediente/visor_pdf.php?ruta="+enlace,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header'});
				
			});
		});
		</script>
  <?php } ?>  
  
  
</table>
</div>
</div>
<?php
echo(librerias_tooltips());
echo(librerias_bootstrap());
echo(librerias_acciones_kaiten());
?>
<script type="text/javascript">
$(document).ready(function(){		
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
  $("#resultado_pantalla_<?php echo($idcaja);?>",parent.document).addClass("documento_actual").addClass("alert-info");    
});
</script>
</body>

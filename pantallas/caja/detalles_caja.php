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
    <td width="40%" class="prettyprint">
      <b>N&uacute;mero de la caja:</b>
    </td>
    <td>
       <?php echo($caja[0]["numero"]);?>
    </td>    
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Ubicaci&oacute;n:</b>
    </td>
    <td colspan="3">
       <?php echo($caja[0]["ubicacion"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Estanter&iacute;a:</b>
    </td>
    <td colspan="3">
       <?php echo($caja[0]["estanteria"]);?>
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
      <b>Panel:</b>
    </td>
    <td colspan="3">
       <?php echo($caja[0]["panel"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Material:</b>
    </td>
    <td colspan="3">
       <?php echo($caja[0]["material"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Seguridad:</b>
    </td>
    <td colspan="3">
       <?php echo($caja[0]["seguridad"]);?>
    </td>
  </tr>
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

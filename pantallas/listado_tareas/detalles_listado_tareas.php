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
echo(librerias_jquery("1.7"));
echo(librerias_html5());
echo(estilo_bootstrap()); 
include_once($ruta_db_superior."pantallas/documento/librerias.php");
include_once($ruta_db_superior."pantallas/listado_tareas/librerias.php");


if(@$_REQUEST["idlistado_tareas"]){
	$idlistado_tareas=$_REQUEST["idlistado_tareas"];
} 
$listado_tareas=busca_filtro_tabla("","listado_tareas a","idlistado_tareas=".$idlistado_tareas,"",$conn);

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
<div data-toggle="collapse" data-target="#div_info_listado_tareas">
  <i class="icon-minus-sign"></i>  <b>Informaci&oacute;n del Listado de Tareas</b>
</div><br />

<div id="div_info_listado_tareas"  class="collapse in opcion_informacion"> 
	
<table class="table table-bordered">
  <tr>
  	
    <td width="40%" class="prettyprint">
      <b>Nombre del Listado de Tareas:</b>
    </td>
    <td>
       <?php echo html_entity_decode($listado_tareas[0]["nombre_lista"]);?>
    </td>    
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Descripci&oacute;n del Listado de Tareas:</b>
    </td>
    <td colspan="3">
       <?php echo (html_entity_decode($listado_tareas[0]["descripcion_lista"]));?>
       
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Creador:</b>
    </td>
    <td colspan="3">
       <?php echo codifica_encabezado(html_entity_decode(creador_listado($listado_tareas[0]["creador_lista"])));?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Cliente:</b>
    </td>
    <td colspan="3">
       <?php  echo codifica_encabezado(html_entity_decode(mostrar_cliente_proyecto($listado_tareas[0]["cliente_proyecto"])));?>
    </td>
  </tr>
  
  <tr>
    <td class="prettyprint">
      <b>Macroproceso/Proceso:</b>
    </td>
    <td colspan="3">
       <?php  echo codifica_encabezado(html_entity_decode(mostrar_macroproceso($listado_tareas[0]["macro_proceso"])));?>
    </td>
  </tr>
  
  <tr>
    <td class="prettyprint">
      <b>Permisos:</b>
    </td>
    <td colspan="3">
       <?php  echo mostrar_funcionarios_permiso($idlistado_tareas);?>
    </td>
  </tr>
  
</table>

</div>

<?php 
if($listado_tareas["numcampos"]){
?>
<div class="container"> 
<div data-toggle="collapse" data-target="#div_info_contenido">
  <i class="icon-minus-sign"></i>  <b>Informaci&oacute;n contenido</b>
</div><br />
<div id="div_info_contenido"  class="collapse in opcion_informacion"> 
<table class="table table-bordered">
  <tr>
    <td class="prettyprint" width="40%">
      <b>N&uacute;mero de tareas asociadas al listado:</b>
    </td>
    <td colspan="3">
       <?php 
       $expedientes_hijos=busca_filtro_tabla("count(*) AS cant_hijos","tareas_listado","generica=0 AND cod_padre=0 AND listado_tareas_fk=".$idlistado_tareas,"",$conn);
       echo($expedientes_hijos[0]["cant_hijos"]);?>
    </td>
  </tr>
</table>
</div>
<?php 
}
?>
</div>
<?php
echo(librerias_bootstrap());
?>
<script type="text/javascript">
$(document).ready(function(){		

    $(".opcion_informacion").on("hide",function(){
    	
      $(this).prev().prev().children("i").removeClass();
      $(this).prev().prev().children("i").addClass("icon-plus-sign");
    });
    $(".opcion_informacion").on("show",function(){
    	
      $(this).prev().prev().children("i").removeClass();
      $(this).prev().prev().children("i").addClass("icon-minus-sign");
    });
});
</script>


<?php

if(@$_REQUEST['idlistado_tareas']){

?>
<script>
  $(".documento_actual",parent.document).removeClass("alert-info");
  $(".documento_actual",parent.document).removeClass("documento_actual");
  $("#resultado_pantalla_<?php echo($_REQUEST['idlistado_tareas']);?>",parent.document).children().addClass("documento_actual").addClass("alert-info");
  
</script>
<?php
	
}


?>


</body>
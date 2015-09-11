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
echo(librerias_jquery("1.7"));
if(@$_REQUEST["idexpediente"]){
	$idexpediente=$_REQUEST["idexpediente"];	
} 
$expediente=busca_filtro_tabla("a.*,".fecha_db_obtener("a.fecha","Y-m-d")." AS fecha, ".fecha_db_obtener("a.fecha_extrema_i","Y-m-d")." as fecha_extrema_i, ".fecha_db_obtener("a.fecha_extrema_f","Y-m-d")." as fecha_extrema_f","expediente a","idexpediente=".$idexpediente,"",$conn);
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
<div data-toggle="collapse" data-target="#div_info_expediente">
  <i class="icon-minus-sign"></i>  <b>Informaci&oacute;n del expediente</b>
</div><br />
<div id="div_info_expediente"  class="collapse in opcion_informacion"> 
<table class="table table-bordered">
  <tr>
    <td width="40%" class="prettyprint">
      <b>Nombre del expediente:</b>
    </td>
    <td>
       <?php echo($expediente[0]["nombre"]);?>
    </td>    
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Fecha de creaci&oacute;n:</b>
    </td>
    <td colspan="3">
       <?php echo($expediente[0]["fecha"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Descripci&oacute;n del expediente:</b>
    </td>
    <td colspan="3">
       <?php echo($expediente[0]["descripcion"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">    	
      <b>Expediente superior:</b>
    </td>
    <td colspan="3">
       <?php 
        if($expediente[0]["cod_padre"]){
          $padre=busca_filtro_tabla("","expediente","idexpediente=".$expediente[0]["cod_padre"],"",$conn);
          if($padre["numcampos"]){
            echo($padre[0]["nombre"]);
          }
        }  
        else{
          echo("---");
        }  
       ?>
    </td>
  </tr>
  <tr>
  	<td class="prettyprint"><b>Creador del expediente:</b></td>
  	<td colspan="3">
  	<?php if($expediente[0]["propietario"]){
  		$nombres=busca_filtro_tabla("","funcionario A","A.funcionario_codigo=".$expediente[0]["propietario"],"",$conn);
  		echo(ucwords(strtolower($nombres[0]["nombres"]." ".$nombres[0]["apellidos"])));
  	}
		else{
			echo("<span style='color:red'>Expediente creado por el sistema</span>");
		}
  	?>
  	</td>
  </tr>
  <tr>
  	<td class="prettyprint">    	
      <b>Vinculado a la caja:</b>
    </td>
    <td>
    	<?php 
        if($expediente[0]["fk_idcaja"]){
          $caja=busca_filtro_tabla("","caja","idcaja=".$expediente[0]["fk_idcaja"],"",$conn);
          if($caja["numcampos"]){
            echo($caja[0]["numero"]." - ".$caja[0]["ubicacion"]);
          }
        }  
        else{
          echo("---");
        }  
       ?>
    </td>
  </tr>
</table>
</div>
<?php 
$almacenamiento["numcampos"]=0;
if($almacenamiento["numcampos"]){
?>
<div class="container"> 
<div data-toggle="collapse" data-target="#div_info_almacenamiento">
  <i class="icon-minus-sign"></i>  <b>Informaci&oacute;n almacenamiento</b>
</div><br />
<div id="div_info_almacenamiento"  class="collapse in opcion_informacion"> 
<table class="table table-bordered">
  <tr>
    <td width="40%" class="prettyprint">
      <b>Ubicaci&oacute;n:</b>
    </td>
    <td>
       <?php echo($almacenamiento[0]["ubicacion"]);?>
    </td>    
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Estanter&iacute;a:</b>
    </td>
    <td colspan="3">
       <?php echo($almacenamiento[0]["estantetia"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Nivel:</b>
    </td>
    <td colspan="3">
       <?php echo($almacenamiento[0]["nivel"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">    	
      <b>Panel:</b>
    </td>
    <td colspan="3">
      <?php echo($almacenamiento[0]["panel"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Caja:</b>
    </td>
    <td colspan="3">
       <?php echo($almacenamiento[0]["caja"]);?>
    </td>
  </tr> 
</table>
</div>
<?php 
}
$contenido["numcampos"]=1;
if($contenido["numcampos"]){
?>
<div class="container"> 
<div data-toggle="collapse" data-target="#div_info_contenido">
  <i class="icon-minus-sign"></i>  <b>Informaci&oacute;n contenido</b>
</div><br />
<div id="div_info_contenido"  class="collapse in opcion_informacion"> 
<table class="table table-bordered">
  <tr>
    <td width="40%" class="prettyprint">
      <b>N&uacute;mero de documentos almacenados:</b>
    </td>
    <td>
       <?php
      $expedientes=arreglo_expedientes_asignados();
			$arreglo=array();
			obtener_expedientes_padre($idexpediente,$expedientes);
			$arreglo=array_merge($arreglo,array($idexpediente));
			//return(implode(",",$arreglo));
			$documentos=busca_filtro_tabla("count(*) as cantidad","expediente_doc A, documento B","A.expediente_idexpediente in(".implode(",",$arreglo).") AND A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO')","",$conn);
			//return($cantidad["sql"]);
			
			if(!$documentos["numcampos"])$documentos[0]["cantidad"]=0;
				echo($documentos[0]["cantidad"]);
			?>
    </td>    
  </tr>
  <tr>
    <td class="prettyprint">
      <b>N&uacute;mero de expedientes:</b>
    </td>
    <td colspan="3">
       <?php 
       $expedientes_hijos=busca_filtro_tabla("count(*) AS cant_hijos","expediente","cod_padre=".$idexpediente,"",$conn);
       echo($expedientes_hijos[0]["cant_hijos"]);?>
    </td>
  </tr>
  <?php          
  if($documentos_almacenados[0]["cant_doc"]){
    $fecha_max=busca_filtro_tabla(fecha_db_obtener("MAX(A.fecha)","Y-m-d")." AS fecha_max","documento A,expediente_doc B","A.iddocumento=B.documento_iddocumento AND B.expediente_idexpediente=".$idexpediente,"",$conn);
    $fecha_min=busca_filtro_tabla(fecha_db_obtener("MIN(A.fecha)","Y-m-d")." AS fecha_min","documento A,expediente_doc B","A.iddocumento=B.documento_iddocumento AND B.expediente_idexpediente=".$idexpediente,"",$conn);
  ?>
  <tr>
    <td class="prettyprint">
      <b>Fecha m&iacute;nima de documento:</b>
    </td>
    <td colspan="3">
       <?php echo($fecha_min[0]["fecha_min"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">    	
      <b>Fecha m&aacute;xima de documento:</b>
    </td>
    <td colspan="3">
      <?php echo($fecha_max[0]["fecha_max"]);?>
    </td>
  </tr>
  <?php
  }
  ?>
</table>
</div>
<?php 
}
?>
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
  $("#resultado_pantalla_<?php echo($idexpediente);?>",parent.document).addClass("documento_actual").addClass("alert-info");    
});
</script>
</body>
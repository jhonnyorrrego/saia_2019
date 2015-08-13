<?php
if(!@$_SESSION["LOGIN".LLAVE_SAIA]){
  @session_start();
  $_SESSION["LOGIN".LLAVE_SAIA]="cerok";
  $_SESSION["usuario_actual"]="1"; 
}
include_once("header.php");
include_once("db.php");
$inicio=busca_filtro_tabla("valor","configuracion","nombre='inicio_actualizacion'","",$conn);
if($inicio["numcampos"])
  $sql="update configuracion set valor='".date("Y-m-d H:i:s")."' where nombre='inicio_actualizacion'";
else
  $sql="insert into configuracion(nombre,valor) values('inicio_actualizacion','".date("Y-m-d H:i:s")."')";  
phpmkr_query($sql,$conn);
$sql="update configuracion set valor='".date("Y")."-12-31' where nombre='actualizacion_fin_anio'";
phpmkr_query($sql,$conn);
 
?>
<script type="text/javascript" src="js/jquery.js"></script>
<center><b>ACTUALIZACIONES POR CAMBIO DE A&Ntilde;O </b>
  <br>
  <br>
  <font color=red>Por Favor espere mientras se finaliza el proceso
    <br>Esto puede tardar Varios minutos
    <br>Gracias
  </font>
</center><br><br>
<div align=center id='estado'>
</div>
<script>
$().ready(function() {
$("#estado").append("Actualizando Contadores..."); 
$.ajax({
   type: "POST",
   url: "tareas_cambio_anio.php",
   data:"ejecutar_funcion=actualizar_contadores",
   async: false,
   success: function(msg){
     $("#estado").append( msg );
   }
 });   
 $("#estado").append("Actualizando festivos..."); 
$.ajax({
   type: "POST",
   url: "tareas_cambio_anio.php",
   data:"ejecutar_funcion=actualizar_festivos",
   async: false,
   success: function(msg){
     $("#estado").append( msg );
   }
 });
 
 $("#estado").append("<br>Actualizar fecha final de los roles de los funcionarios activos...");
$.ajax({
   type: "POST",
   url: "tareas_cambio_anio.php",
   data:"ejecutar_funcion=actualizar_rol",
   async: false,
   success: function(msg){
     $("#estado").append( msg );
   }
 });/*
 $("#estado").append("<br>Eliminando documentos Iniciados...");
$.ajax({
   type: "POST",
   url: "tareas_cambio_anio.php",
   data:"ejecutar_funcion=eliminar_ingresos",
   async: false,
   success: function(msg){
     $("#estado").append( msg );
   }
 });
$("#estado").append("<br>Eliminando documentos sin Transferir...");
$.ajax({
   type: "POST",
   url: "tareas_cambio_anio.php",
   data:"ejecutar_funcion=eliminar_no_transferidos",
   async: false,
   success: function(msg){
     $("#estado").append( msg );
   }
 });
$("#estado").append("<br>Vaciando log...");
$.ajax({
   type: "POST",
   url: "tareas_cambio_anio.php",
   data:"ejecutar_funcion=limpiar_evento",
   async: false,
   success: function(msg){
     $("#estado").append( msg );
   }
 });
$("#estado").append("<br>Vaciando log acceso...");
$.ajax({
   type: "POST",
   url: "tareas_cambio_anio.php",
   data:"ejecutar_funcion=guardar_log_acceso_archivo",
   async: false,
   success: function(msg){
     $("#estado").append( msg );
   }
 });

 $("#estado").append("<br>Eliminando borradores...");
$.ajax({
   type: "POST",
   url: "tareas_cambio_anio.php",
   data:"ejecutar_funcion=eliminar_borradores",
   async: false,
   success: function(msg){
     $("#estado").append( msg );
   }
 });
$("#estado").append("<br>Eliminando documentos con estado Eliminado...");
$.ajax({
   type: "POST",
   url: "tareas_cambio_anio.php",
   data:"ejecutar_funcion=borrar_eliminados",
   async: false,
   success: function(msg){
     $("#estado").append( msg );
   }
 });
$("#estado").append("<br>Terminar documentos pendientes con fecha de transferencia menor a 1 Noviembre 2009...");
$.ajax({
   type: "POST",
   url: "tareas_cambio_anio.php",
   data:"ejecutar_funcion=terminar_pendientes",
   async: false,
   success: function(msg){
     $("#estado").append( msg );
   }
 });  */
///va de ultimo
alert("Proceso finalizado");
$.ajax({
   type: "POST",
   url: "tareas_cambio_anio.php",
   data:"ejecutar_funcion=finalizar_actualizacion",
   async: false,
   success: function(msg){
     $("#estado").append( msg );
   }
 }); 
}); 
</script>
<?php

include_once("footer.php");
?>
<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."db.php");

function botones_tiempo($idformato,$iddoc,$campo)
{
 $formato=busca_filtro_tabla("nombre_tabla","formato","idformato=$idformato",""); 
?>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script>
$().ready(function() {

$("#iniciar").click(function(){
  $("#iniciar").attr("disabled","disabled");
     $("#detener").attr("disabled","");
     $("#terminar").attr("disabled","disabled");
  $.ajax({
   type: "POST",
   url: "../librerias/funciones_tiempo.php",
   data: "funcion=iniciar&iddoc=<?php echo $iddoc; ?>",
   success: function(msg){
     alert( "Se inicia el conteo." ); 
   }
 });  
});

$("#detener").click(function(){
  $("#detener").attr("disabled","disabled")
  $("#iniciar").attr("disabled","")
  $("#terminar").attr("disabled","")
  $.ajax({
   type: "POST",
   url: "../librerias/funciones_tiempo.php",
   data: "funcion=detener&iddoc=<?php echo $iddoc ?>",
   success: function(msg){
     alert( "Se detiene el conteo." );
   }
 });  
});
/*
$("#terminar").click(function(){
  $("#terminar").attr("disabled","disabled");
    $("#botones_tiempo").html("Calculando");
  $.ajax({
   type: "POST",
   url: "../librerias/funciones_tiempo.php",
   data: "funcion=terminar&iddoc=<?php echo $iddoc; ?>&campo=<?php echo $campo; ?>&tabla=<?php echo $formato[0][0]; ?>",
   success: function(msg){
    $("#botones_tiempo").html("Tiempo Empleado: "+msg+" Min");
   }
 }); 
});
 */
});
</script>
<?php 
 $iniciado=busca_filtro_tabla("count(*)","tabla_tiempos","documento_iddocumento=$iddoc and fecha_final is null","");
 $finalizado=busca_filtro_tabla("count(*)","tabla_tiempos","documento_iddocumento=$iddoc and fecha_final is not null","");
  
 $valor=busca_filtro_tabla($campo,$formato[0][0],"documento_iddocumento=$iddoc",""); 
 
 if($valor[0][0]=="")
  {
   echo '<div id="botones_tiempo">';
   if(!$iniciado[0][0]&& !$finalizado[0][0])
      echo "<font color='red'>No ha empezado a registrar el tiempo.<br /></font>";
   echo "<input type='button' id='iniciar' value='Iniciar' ";
   if($iniciado[0][0])
    echo " disabled='disabled' ";
   echo ">   ";
   
   echo "<input type='button' id='detener' value='Detener' ";
   if(!$iniciado[0][0])
    echo " disabled='disabled' ";
   echo ">   " ;
   
  }
 else
  echo "Tiempo Empleado: ".$valor[0][0]." Min";       
}

function iniciar()
{
 $sql="insert into tabla_tiempos(fecha_inicial,documento_iddocumento) values(".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",'".$_REQUEST["iddoc"]."')";
 phpmkr_query($sql);
 //echo $sql; 
}
function detener()
{$sql="update tabla_tiempos set fecha_final=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s")." where documento_iddocumento='".$_REQUEST["iddoc"]."' and fecha_final is null";
 phpmkr_query($sql); 
 //echo $sql;
}
function terminar_conteo($idformato,$iddoc,$campo,$tabla)
{$sql="update tabla_tiempos set fecha_final=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s")." where documento_iddocumento='".$iddoc."' and fecha_final is null";
 //echo $sql;
 phpmkr_query($sql);   
 $tiempos=busca_filtro_tabla(resta_horas("fecha_final","fecha_inicial"),"tabla_tiempos","documento_iddocumento=".$iddoc,"");
  
 $horas=0;
 $minutos=0;
 $segundos=0;
 for($i=0;$i<$tiempos["numcampos"];$i++)
   {$cadena=explode(":",$tiempos[$i][0]);
    $horas+=$cadena[0];
    $minutos+=$cadena[1];
    $segundos+=$cadena[2];
   }
 $total=$minutos+($horas*60)+intval($segundos/60);
 $sql="update ".$tabla." set ".$campo."='$total' where documento_iddocumento=".$iddoc;
  phpmkr_query($sql);
  //echo "<br />".$sql;
 $sql="delete from tabla_tiempos where documento_iddocumento=".$iddoc;
  phpmkr_query($sql); 
 // echo $total;
// die();
}

if(@$_REQUEST["funcion"] && $_REQUEST["funcion"]!='aprobar')
 echo $_REQUEST["funcion"]();
?>
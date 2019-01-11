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
function nombre_mensajero_distribucion_fisica($nombre_mensajero){
  $dato=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$nombre_mensajero,"",$conn);
  $texto=$dato[0]["nombres"]." ".$dato[0]["apellidos"];
  return($texto);
}
function recibido_despacho_distribucion($fecha_recibido,$usuario_recibido,$idft_distribucion_fisica){
  global $ruta_db_superior;
  $texto='';
  if($fecha_recibido=="fecha_recibido"){
    $texto.='<script type="text/javascript">
    $(document).ready(function(){
      $("#ft_distribucion'.$idft_distribucion_fisica.'").click(function(){
       $.ajax({
          type:"POST",
          url: "'.$ruta_db_superior.'formatos/distribucion_fisica/guardar_accion.php",
          data: "idft_distribucion_fisica='.$idft_distribucion_fisica.'&accion=2",
          success: function(data){
             $("#recibido'.$idft_distribucion_fisica.'").html(data);
          }
        });
      });
    });
  </script>';
  $texto.='<div id="recibido'.$idft_distribucion_fisica.'"><div style="width:20px;" tipodf="recibido" idft_distribucion_fisica="'.$idft_distribucion_fisica.'" id="ft_distribucion'.$idft_distribucion_fisica.'" class="btn-mini btn-info btn"><i class="icon-check"></i></div></div>';
    return($texto);
  }
  else{
    $texto='';
    $texto.='Fecha: '.$fecha_recibido."<br />";
    $usuario=busca_filtro_tabla("","vfuncionario_dc","idfuncionario=".$usuario_recibido,"",$conn);
    $texto.='Por: '.$usuario[0]["nombres"]." ".$usuario[0]["apellidos"];
    return($texto);  
  }
}
function entregado_despacho_distribucion($fecha_entregado,$usuario_entregado,$idft_distribucion_fisica){
  global $ruta_db_superior;
  $texto='';
  if($fecha_entregado=="fecha_entregado"){
    $texto.='<script type="text/javascript">
    $(document).ready(function(){
      $("#distribucion'.$idft_distribucion_fisica.'").click(function(){
       $.ajax({
          type:"POST",
          url: "'.$ruta_db_superior.'formatos/distribucion_fisica/guardar_accion.php",
          data: "idft_distribucion_fisica='.$idft_distribucion_fisica.'&accion=1",
          success: function(data){
             $("#entregado'.$idft_distribucion_fisica.'").html(data);
          }
        });
      });
    });
  </script>'; 
  $texto.='<div id="entregado'.$idft_distribucion_fisica.'"><div style="width:20px;" tipodf="entregado" id="distribucion'.$idft_distribucion_fisica.'"  idft_distribucion_fisica="'.$idft_distribucion_fisica.'"  class="btn-mini btn-info btn"><i class="icon-check"></i></div>';
    return($texto);
  }
  else{
    $texto='';
    $texto.='Fecha: '.$fecha_entregado."<br />";
    $usuario=busca_filtro_tabla("","vfuncionario_dc","idfuncionario=".$usuario_entregado,"",$conn);
    $texto.='Por: '.$usuario[0]["nombres"]." ".$usuario[0]["apellidos"];
    return($texto);  
  }
}
function nivel_urgencia_despacho($nivel_urgencia){
  if($nivel_urgencia==1){
    return('<div class="btn-mini btn-danger" style="text-align:center;">URGENTE</div>');
  }
  else{
    return('<div class="btn-mini btn-info" style="text-align:center;">NORMAL</div>');
  }
}

?>
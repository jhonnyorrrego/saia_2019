<?php
include_once("../../db.php");
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
include_once ($ruta_db_superior . "assets/librerias.php");
echo jquery();
echo bootstrap();

?>
<link href="../../assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../../assets/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
<link class="main-stylesheet" href="../../assets/theme/pages/css/pages.css" rel="stylesheet" type="text/css" />

<?php
$texto='<script type="text/javascript">      
    $("#pais_ejecutor_'.$_REQUEST["campo"].'").change(function(){
      actualiza_ciudad_'.$_REQUEST["campo"].'($("#pais_ejecutor_'.$_REQUEST["campo"].'").find('."':selected'".').val(),0);
    });
    $("#departamento_ejecutor_'.$_REQUEST["campo"].'").change(function(){
      actualiza_ciudad_'.$_REQUEST["campo"].'($("#pais_ejecutor_'.$_REQUEST["campo"].'").find('."':selected'".').val(),$("#departamento_ejecutor_'.$_REQUEST["campo"].'").find('."':selected'".').val());
    }); 
    function actualiza_ciudad_'.$_REQUEST["campo"].'(pais,departamento){
      $.ajax({
        type:'."'POST'".',
        url:'."'".$ruta_db_superior."formatos/librerias/generar_ciudades.php'".',
        data:'."'pais='+pais+'&departamento='+departamento+'&campo=".$_REQUEST["campo"]."',".'
        success: function(datos,exito){
        $("#div_titulo_ejecutor").find(".select2").remove();
          $("#div_'.$_REQUEST["campo"].'_ejecutor").empty();
          $("#div_'.$_REQUEST["campo"].'_ejecutor").append(datos);
        }
      });
    }
  </script>
  <script src="../../assets/theme/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
<script src="../../assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="../../assets/theme/assets/plugins/select2/js/select2.full.min.js"></script>
<script src="../../assets/theme/pages/js/pages.js"></script>';
$paises=busca_filtro_tabla("","pais","","",$conn);
$texto.='<div class="row"><div class="col"><div class="row"><div class="col-auto px-1"><select data-init-plugin="select2" name="pais_ejecutor_'.$_REQUEST["campo"].'" id="pais_ejecutor_'.$_REQUEST["campo"].'">';
for($i=0;$i<$paises["numcampos"];$i++){
  $texto.='<option value="'.$paises[$i]["idpais"].'"';
  if($paises[$i]["idpais"]==@$_REQUEST["pais"])
    $texto.=" SELECTED ";
  $texto.=">".$paises[$i]["nombre"].'</option>';  
}
$texto.='</select></div><div class="col-auto px-1">';
if(@$_REQUEST["pais"]){
  $pais=$_REQUEST["pais"];
}
else{
  $pais=$paises[0]["idpais"];
}
$departamentos=busca_filtro_tabla("","departamento","pais_idpais=".$pais,"lower(nombre)",$conn);
$texto.='<select data-init-plugin="select2" name="departamento_ejecutor_'.$_REQUEST["campo"].'" id="departamento_ejecutor_'.$_REQUEST["campo"].'">';
if($departamentos["numcampos"]){
  
  for($i=0;$i<$departamentos["numcampos"];$i++){
    $texto.='<option value="'.$departamentos[$i]["iddepartamento"].'"';
    if($departamentos[$i]["iddepartamento"]==$_REQUEST["departamento"])
     $texto.=" SELECTED ";
    $texto.=">".$departamentos[$i]["nombre"].'</option>';  
  }
  $texto.='</select></div><div class="col-auto px-1">';
  if(@$_REQUEST["departamento"]){
    $departamento=$_REQUEST["departamento"];
  }
  else{ 
    $departamento=$departamentos[0]["iddepartamento"];
  }  
  $municipios=busca_filtro_tabla("","municipio","departamento_iddepartamento=".$departamento,"lower(nombre)",$conn);
  if($municipios["numcampos"]){
    $texto.='<select data-init-plugin="select2" name="'.$_REQUEST["campo"].'" id="'.$_REQUEST["campo"].'">';
    for($i=0;$i<$municipios["numcampos"];$i++){
      $texto.='<option value="'.$municipios[$i]["idmunicipio"].'"';
      $texto.=">".$municipios[$i]["nombre"].'</option>';  
    }   
    $texto.='</select></div></div></div></div>';
  }
}
else{
  $texto.='<option value="0">Por favor seleccione otro</option></select></div></div></div></div>';
}
echo($texto);
?>

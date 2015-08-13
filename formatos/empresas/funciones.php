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

function empresa_nombre($idformato,$iddoc){
  global $conn;
$consulta=busca_filtro_tabla("","ft_empresas","idft_empresas=".$_REQUEST["iddoc"],"",$conn);
$ejecutor=busca_filtro_tabla("","datos_ejecutor a, ejecutor b","a.ejecutor_idejecutor=b.idejecutor and a.iddatos_ejecutor=".$consulta[0]["empresa"],"",$conn);
echo($ejecutor[0]["nombre"]); 
}


function cargar_empresa($idformato,$iddoc){
  global $conn;
 
 $consulta=busca_filtro_tabla("","ft_empresas","idft_empresas=".$_REQUEST["iddoc"],"",$conn);
/*
echo "<script type='text/javascript'>
$().ready(function() {
$('#empresa').val('".$consulta[0]["empresa"]."');
direccion=$('#frame_empresa').attr('src');
$('#frame_empresa').attr('src',direccion+'&destinos=".$consulta[0]["empresa"]."');
});
</script>"; 
  */
  }


function redireccionar_adicionar($idformato,$iddoc){
  global $conn;
 
  /*print_r($_REQUEST);
  die();*/
  //abrir_url($ruta_db_superior."formatos/informe_analisis/mostrar_informe_dia.php?key=".$anterior[0]["origen"],"_parent");
  }


?>

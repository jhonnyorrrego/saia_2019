<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
//include_once($ruta_db_superior."db.php");
//include_once($ruta_db_superior."librerias_saia.php");
?>
<form class="form-horizontal" action="carga_anexos.php" method="post" name="carga_Anexos" id="carga_Anexos" enctype="multipart/form-data"> 
  <div class="control-group">    
    <div class="controls">      
      <input type="file" name="nombre_archivo_cliente" /><br /> 
      <input type="submit" name="enviar" value="Enviar" />
    </div>
  </div>
</form>
<?php
if(is_uploaded_file(@$_FILES['nombre_archivo_cliente']['tmp_name'])){
  $nombre_directorio = "anexos/";
  $nombre_archivo = $_FILES['nombre_archivo_cliente']['name'];
 
  $nombre_completo = $nombre_directorio.$nombre_archivo;
   if (is_file($nombre_completo)){
     $idUnico = time();
     $nombre_archivo = $idUnico . "-" . $nombre_archivo;
  }
  move_uploaded_file(@$_FILES['nombre_archivo_cliente']['tmp_name'], $nombre_directorio.$nombre_archivo);
} 
else
  print ("No se ha podido subir el archivo");

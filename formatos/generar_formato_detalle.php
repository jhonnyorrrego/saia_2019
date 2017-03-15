<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."class_transferencia.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

include_once($ruta_db_superior."db.php");

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("formato","iddoc","idformato");
include_once($ruta_db_superior."librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());

include_once($ruta_db_superior."formatos/librerias/header_formato.php");
if(@$_REQUEST["almacenar"]=="true" && $_REQUEST["ruta"]!="" && @$_REQUEST["formato"]){
$enlace_adicion="";
  if(!crear_archivo($_REQUEST["ruta"],"<?php include_once('../librerias/estilo_formulario.php'); include_once('../librerias/funciones_formatos_generales.php');?".">".limpia_tabla($_REQUEST["archivo"])."<?php listado_hijos_formato(".$_REQUEST["formato"].',$_REQUEST["iddoc"]); ?'.">")){
    alerta("<br>Archivo no se ha podido crear<br>");
  }
}
if(@$_REQUEST["idformato"]){
  $formato=busca_filtro_tabla("","formato","idformato=".$_REQUEST["idformato"],"",$conn);
  if($formato["numcampos"]){
    if($formato[0]["nombre"]=="proceso"){
      redirecciona($ruta_db_superior."formatos/".$formato[0]["nombre"]."/previo_".$formato[0]["ruta_mostrar"]."?editar=1");
    }
    $ruta=$formato[0]["nombre"]."/previo_".$formato[0]["ruta_mostrar"];
    if(is_file($ruta)){
      $bufer = file_get_contents($ruta);
    }
    else {
      if(!crear_archivo($ruta,""))
        echo("<br>Archivo no se ha podido crear<br>");
    }
  }
?>
<form name="crear_archivo" id="crear_archivo" action="" method="post" >
<!--select name="idformato">
<?php
$formatos=busca_filtro_tabla("","formato","1=1","",$conn);
for($i=0;$i<$formatos["numcampos"];$i++){
  echo('<option value="'.$formatos[$i]["idformato"].'" ');
  if($formatos[$i]["idformato"]==$_REQUEST["idformato"]){
    echo(" SELECTED ");
  }
  echo(">".$formatos[$i]["etiqueta"]."</option>");
}
?>
</select-->
<textarea name="archivo" class="tiny_avanzado"><?php echo($bufer);?></textarea><br />
Ruta:<input type="text" size="50"  name="ruta" value="<?php echo($ruta);?>" readonly="true">
<input type="hidden" name="almacenar" value="true">
<input type="hidden" name="formato" value="<?php echo($_REQUEST["idformato"]); ?>">
<br /><input type="submit" value="Crear">
</form>
<?php
}
encriptar_sqli("crear_archivo",1,"form_info",$ruta_db_superior);
?>
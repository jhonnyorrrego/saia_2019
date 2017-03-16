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
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("iddoc","key");
desencriptar_sqli('form_info');
echo(librerias_jquery());
if((@$_REQUEST["iddoc"] || @$_REQUEST["key"]) && @$_REQUEST["no_menu"]!=1){
	if(!@$_REQUEST["iddoc"])$_REQUEST["iddoc"]=@$_REQUEST["key"];
	include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
	menu_principal_documento($_REQUEST["iddoc"]);
}
?>
<script src="multiple-file-upload/jquery-1.2.6.js" type="text/javascript"></script>
<script type="text/javascript" src="multiple-file-upload/jquery.MultiFile_DOC.js"></script>
<script type="text/javascript" src="highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = 'highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<style type=\"text/css\">
</style>
<?php
include_once("funciones_archivo.php");
include_once("librerias_saia.php");
//echo(estilo_bootstrap());
if(!isset($_REQUEST["menu"])||$_REQUEST["menu"]!="0") // Si esta en menu_ordenar omite el header el footer y el menu
{
include_once("../header.php");
menu_ordenar($_REQUEST["key"]);
	} 
echo "<br>";
if(isset($_REQUEST["key"]))
 {
   $iddocumento=$_REQUEST["key"];
   echo "<div class='row-fluid'><div align='center'>".listar_anexos_documento($iddocumento)."</div>";
	} 
else
{
  echo "No se recibio la informacion del documento";
	} 
 
if(isset($_REQUEST["Adicionar"])) // Se procesa el formulario
  {

    $permisos=$_REQUEST["permisos_anexos"];
    //procesar_anexos($iddocumento,$permisos);
    cargar_archivo($iddocumento,$permisos);
    if(!isset($_REQUEST["menu"])||$_REQUEST["menu"]!="0") // Si esta en menu_ordenar omite el header el footer y el menu
    {
      ?>
      <script>
      /*$(document).ready(function(){
        $("#adjuntos_documento",window.parent.arbol_formato).click();
      });*/
      </script>
      <?php
      abrir_url("anexos_documento.php?key=".$iddocumento."&adicional=".rand(),"_self");
     }
    else 
    { 
      abrir_url("../ordenar.php?accion=mostrar&key=".$iddocumento,"centro");
     }
    exit();
  }

global $extensiones; // Extensiones por defecto inicializadas en funciones archivo
if($extensiones =='' || $extensiones =='NULL')
{
 $extensiones='jpg|gif|doc|ppt|xls|txt|pdf|pps|crd|cad|xlsx|docx|pptx|ppsx|pps|ppsx|swf|flv';
 }
     
?>
<br>
<div align="center">
<form name="anexos_documento" id="anexos_documento" action="anexos_documento.php" method="POST" enctype="multipart/form-data" >
<input type="hidden" value="" id="permisos_anexos" name="permisos_anexos"/>
<input type="hidden" value="<?php echo $iddocumento; ?>" id="key" name="key"/>
<input type="hidden" value="<?php if(isset($_REQUEST["menu"])) echo $_REQUEST["menu"]; else echo "1"; ?>" id="menu" name="menu"/>
<table width="255px" border='0' cellspacing=2 cellpadding=2>
<tr>
<td class='encabezado_list'>Adicionar Anexos<td>
</tr>
<tr>
<td class="celda_transparente" align='center'><input type="file" name="anexos[]" class="multi" accept="<?php echo $extensiones;?>"></td>
</tr>
<tr><td align='center'><input type="hidden" value="Adicionar" name="Adicionar"><input type="submit" value="Adicionar" name="Adicionar"> </td></tr>
</table>
</form>
</div>
</div>
<?php

if(!isset($_REQUEST["menu"])||$_REQUEST["menu"]!="0") // Si esta en menu_ordenar omite el footer y el header
{
   include_once("../footer.php");
 }


?>

<?php 

function procesar_anexos($iddoc,$permisos_anexos)
{
 global $conn;
$resultado=NULL;
$larchivos=array();
$permisos=array();
$aux_permisos=explode("|",$permisos_anexos);

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

$salir=$ruta_db_superior;   

for($i=0;$i<count($aux_permisos);$i++)
   {$fila=explode(";",$aux_permisos[$i]);
    $permisos[$fila[0]]["propio"]=$fila[1];
    $permisos[$fila[0]]["dependencia"]=$fila[2];
    $permisos[$fila[0]]["cargo"]=$fila[3];
    $permisos[$fila[0]]["total"]=$fila[4];    
   }

 $config = busca_filtro_tabla("valor","configuracion","nombre='tipo_almacenamiento'","",$conn);
if($config["numcampos"]){
    $tipo_almacenamiento=$config[0]["valor"];
  }
  else
    $tipo_almacenamiento="archivo"; // Si no encuentra el registro en configuracion almacena en archivo
    
    for($j=0;$_FILES['anexos']['name'][$j];$j++){
      if(is_uploaded_file($_FILES['anexos']['tmp_name'][$j]) && $_FILES['anexos']['size'][$j]){
        $nombre=$_FILES['anexos']['name'][$j];
	$datos_anexo=pathinfo($_FILES['anexos']['name'][$j]);
        $temp_filename = time().".".$datos_anexo["extension"];
        $dir_anexos=selecciona_ruta_anexos("",$iddoc,$tipo_almacenamiento); // Ruta para descarga ..
	$dir_anexos_tmp=$dir_anexos; 
	$dir_anexos=$dir_anexos;
	
  if(!is_dir($salir.$dir_anexos))
     mkdir($salir.$dir_anexos,0777);    
     
        if (file_exists($salir.$dir_anexos . $temp_filename)){
          $tmpVar = 1;
  	  		while(file_exists($salir.$dir_anexos. $tmpVar . '_' . $temp_filename)){
  				  $tmpVar++;
  	   		}
          $temp_filename=$tmpVar . '_' . $temp_filename;
        }
      
        if(is_file($_FILES['anexos']['tmp_name'][$j]) && is_dir($salir.$dir_anexos))
          $resultado=rename($_FILES['anexos']['tmp_name'][$j],$salir.$dir_anexos.$temp_filename);
        chmod($salir.$dir_anexos.$temp_filename,PERMISOS_CARPETAS);
        if($resultado){
        $dato_formato=array("","");
        if($tipo_almacenamiento=="archivo"){ // Los anexos estan guardados en archivos
            $sql="INSERT INTO anexos(documento_iddocumento,ruta,tipo,etiqueta".$dato_formato[0].") values(".$iddoc.",'".$dir_anexos_tmp.$temp_filename."','".$datos_anexo["extension"]."','".$nombre."'".$dato_formato[1].")";
     	    phpmkr_query(($sql),$conn) or alerta("No se puede Adicionar el Anexo ".$_FILES['anexos']['name'][$j],'error',4000);
            $idanexo=phpmkr_insert_id();
          }
          elseif($tipo_almacenamiento=="db"){
            phpmkr_query("INSERT INTO binario(nombre_original) VALUES ('$nombre')", $conn);
            $idbin = phpmkr_insert_id();

            $fcont=fopen($salir.$dir_anexos.$temp_filename,"rb");
            $cont=fread($fcont,filesize($salir.$dir_anexos.$temp_filename));
	   //$campo,$tabla,$condicion,$contenido,$tipo,$conn,$log=1
      if(guardar_lob("datos","binario","idbinario=$idbin",$cont,"archivo",$conn))
           {
          	 phpmkr_query("INSERT INTO anexos(ruta,documento_iddocumento,tipo,etiqueta,formato,campos_formato) VALUES ('$idbin',".$iddoc.",'".$datos_anexo["extension"]."','".$nombre."','".$idformato."','".$campo[$i]["idcampos_formato"]."')", $conn);
          	
             $idanexo=phpmkr_insert_id();
          	 if($idanexo){
			 // EN EL MOMENTO SE HACE ALMACENAMIENTO DUAL
              //unlink($dir_anexos.$temp_filename); // Se elimina el temporal .. el blob se almaceno correctamente
             }
             else alerta("No se puede Adicionar el Anexo ".$_FILES['anexos']['name'][$j],'error',4000);
          	}
          }

          if($idanexo){ // SE ASIGNAN LOS PERMISOS
          
            if(array_key_exists ($nombre , $permisos ))
              {$propio=$permisos[$nombre]["propio"];
               $dependencia=$permisos[$nombre]["dependencia"];
               $cargo=$permisos[$nombre]["cargo"];
               $total=$permisos[$nombre]["total"];
              }
            else
              {$propio="lem";
               $dependencia="";
               $cargo="";
               $total="l";
              }  
            $sql_permiso="insert into permiso_anexo(anexos_idanexos,idpropietario,caracteristica_propio,caracteristica_dependencia,caracteristica_cargo,caracteristica_total) values('$idanexo','".usuario_actual("idfuncionario")."','$propio','$dependencia','$cargo','$total')";
            phpmkr_query($sql_permiso,$conn);
          
          }
        }
        else {
          alerta("Se ha generado un error al tratar de copiar el archivo ".$nombre,'error',4000);
        }
      } // Fin  if is uploaded
    } // Fin for
 
return;
}
encriptar_sqli("anexos_documento",1,"form_info",$ruta_db_superior);
?>

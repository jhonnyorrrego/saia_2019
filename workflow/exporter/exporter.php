<?php
//error_reporting(E_ALL);
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
/**
 * @see http://xmlgraphics.apache.org/batik/tools/rasterizer.html
 */ 
$t1 = microtime ();

//$exportType = 'pdf'; //Can be jpg | png | pdf
$exportType = $_REQUEST['tipo']; //Can be jpg | png | pdf

if(!empty($_GET['cerrar']))
	$cerrar = $_GET['cerrar'];

//$folder = dirname(__FILE__);
$folder = "../diagramas";
crear_destino($ruta_db_superior.$folder);
//chmod(0777,$folder);
$imagen = $_SESSION['imagen'];

//Fake SVG file
$data = '<?xml version="1.0" encoding="ISO-8859-1" standalone="no"?'.'>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN"
    "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">'.$imagen;
//Generate an unique SVG file into the system's temporary folder
$ui = uniqid();
$tempSVG = $ruta_db_superior."temporal_".$_SESSION["LOGIN".LLAVE_SAIA]."/".$ui.'.svg';
//chmod(0777,$tempSVG);
$handle = fopen($tempSVG, "w");
fwrite($handle, $data);
fclose($handle);

$tempExp = $folder . "/".@$_REQUEST["diagrama"]."_".$ui; 
$command = '';
$fecha_hoy = date("Y-m-d");
//$hora_hoy = date("H:i");
switch ($exportType) {
    case 'jpg':
        $tempExp.=".jpg";
		$metodo_export = busca_filtro_tabla("","configuracion","nombre='flujo'","",$conn);
		if($metodo_export[0]["valor"] == "imagemagic"){
        	$command = sprintf('convert  %s  %s', $tempSVG, $ruta_db_superior.$tempExp);
		}
		else{
      if(SO=='windows'){
  			$command = sprintf('C:\Progra~1\Java\jre6\bin\java.exe -jar batik-rasterizer.jar -m image/jpeg -q .99 %s -d %s', $tempSVG, $ruta_db_superior.$tempExp);
      }
      else{
        $command = sprintf('java -jar batik-rasterizer.jar -m image/jpeg -q .99 %s -d %s', $tempSVG, $ruta_db_superior.$tempExp);
      }
		}
        break;
    case 'tiff':
        exit("Tiff not implemented");
        break;
    case 'pdf':
        $tempExp.=".pdf";
        $command = sprintf('java -jar batik-rasterizer.jar -m application/pdf %s -d %s', $tempSVG, $tempExp);
        break;
    case 'png': //flow to default
    default:
        $tempExp .= ".png";
        $command = sprintf('convert %s -d %s', $tempSVG, $ruta_db_superior.$tempExp);
}

echo $command;
$respuesta=system($command,$retval);
echo $retval;
unlink($tempSVG);
$fecha_hora = date("Y-m-d h:i:s");
$idfun = usuario_actual("idfuncionario");
$diagram = $_SESSION["id_diagramaxxx"];
$sql = "INSERT INTO diagram_history(ruta_imagen,fecha,responsable,diagram_iddiagram) values('$tempExp',".fecha_db_almacenar($fecha_hora,'Y-m-d H:i:s').",'$idfun','$diagram')";

phpmkr_query($sql,$conn);

$figuras = busca_filtro_tabla("distinct(figura_idfigura)","paso_temporal","diagram_iddiagram=".$diagram,"",$conn);
for($i=0;$i<$figuras["numcampos"];$i++){
  $nombre = busca_filtro_tabla("","paso_temporal","figura_idfigura=".$figuras[$i]["figura_idfigura"],"idpaso_temporal desc",$conn);
  
  $paso = busca_filtro_tabla("","paso","diagram_iddiagram=$diagram and idfigura=".$nombre[0]["figura_idfigura"],"",$conn);
  if($paso["numcampos"] > 0){
    $sql = "UPDATE paso SET nombre_paso='".$nombre[0]['nombre_paso']."',posicion='".$nombre[0]['posicion']."' WHERE idfigura=".$nombre[0]["figura_idfigura"]." and diagram_iddiagram=".$nombre[0]["diagram_iddiagram"];
  }
  else{
    $sql = "INSERT INTO paso (nombre_paso,posicion,idfigura,diagram_iddiagram) values ('".$nombre[0]['nombre_paso']."','".$nombre[0]["posicion"]."',".$nombre[0]["figura_idfigura"].",".$nombre[0]["diagram_iddiagram"].")";
  }
  
  phpmkr_query($sql);
  $sql = "DELETE FROM paso_temporal WHERE figura_idfigura=".$nombre[0]["figura_idfigura"]." and diagram_iddiagram=".$nombre[0]["diagram_iddiagram"];
  phpmkr_query($sql);
}

$conectores = busca_filtro_tabla("distinct(idconector)","paso_enlace_temporal","diagram_iddiagram=".$diagram,"",$conn);
for($j=0;$j<$conectores["numcampos"];$j++){
    $nombre = busca_filtro_tabla("","paso_enlace_temporal","idconector=".$conectores[$j]["idconector"],"idpaso_enlace_temporal",$conn);
    
    $paso = busca_filtro_tabla("","paso_enlace","diagram_iddiagram=".$diagram." and idconector=".$nombre[0]["idconector"],"",$conn);

//-------------------------Sacando los id pasos del origen y destino de las idfiguras-------------
        
    $idpasorigen = busca_filtro_tabla("idpaso","paso","diagram_iddiagram=".$nombre[0]["diagram_iddiagram"]." and idfigura=".$nombre[0]["origen"],"",$conn);
    if($idpasorigen["numcampos"] > 0)
        $nombre[0]["origen"] = $idpasorigen[0]["idpaso"];
    
    
    $idpasodestino = busca_filtro_tabla("idpaso","paso","diagram_iddiagram=".$nombre[0]["diagram_iddiagram"]." and idfigura=".$nombre[0]["destino"],"",$conn);
    if($idpasodestino["numcampos"] > 0)
        $nombre[0]["destino"] = $idpasodestino[0]["idpaso"];
    

//------------------------------------------------------------------------------------------------     
    
    if($paso["numcampos"] > 0){
        $sql = "UPDATE paso_enlace SET origen='".$nombre[0]["origen"]."', destino='".$nombre[0]["destino"]."' WHERE idconector=".$nombre[0]["idconector"]." and diagram_iddiagram=".$nombre[0]["diagram_iddiagram"];
    }
    else{
      $sql = "INSERT INTO paso_enlace (origen,destino,idconector,diagram_iddiagram) values('".$nombre[0]["origen"]."','".$nombre[0]["destino"]."',".$nombre[0]["idconector"].",".$nombre[0]["diagram_iddiagram"].")";
    }
    phpmkr_query($sql);
    $sql = "DELETE FROM paso_enlace_temporal WHERE idconector=".$nombre[0]["idconector"]." and diagram_iddiagram=".$nombre[0]["diagram_iddiagram"];
    phpmkr_query($sql);
}

//unset = $_SESSION['imagen'];

//$t = microtime() - $t1;
//print "\nTime: $t microseconds";
if(@$cerrar != "no")
	echo "<script>window.close();</script>";
else
	echo "<script>window.location='../diagram/".$fecha_hoy."_".$ui.".".$exportType."'</script>";
?>

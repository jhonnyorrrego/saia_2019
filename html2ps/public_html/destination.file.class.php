<?php
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
  header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
  header("Cache-Control: post-check=0, pre-check=0", true); 
  header("Pragma: no-cache"); // HTTP/1.0 
class DestinationFile extends Destination {
  var $_link_text;
  
  function DestinationFile($filename, $link_text = null) {
    $this->Destination($filename);

    $this->_link_text = $link_text;
  }

  function process($tmp_filename, $content_type) 
  {  
    $max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
   
//   crear_destino($ruta_db_superior."../pdf/");
	$ruta_almacenamiento=ruta_almacenamiento("pdf");
    $ruta_almacenamiento2=ruta_almacenamiento("pdf",0);

   if(isset($_REQUEST["nombre_archivo"]) && $_REQUEST["nombre_archivo"])
    { $dest_filename =$ruta_db_superior.$_REQUEST["nombre_archivo"].".pdf";
    }
   else
     {include_once($ruta_db_superior."db.php");
      $doc = busca_filtro_tabla(fecha_db_obtener('fecha','Y-m')." as fecha,estado","documento","iddocumento=".$_REQUEST["iddoc"],"",$conn);
    if($doc[0]["estado"]=='ACTIVO')
     $dir= $ruta_db_superior."temporal_".$_SESSION["LOGIN".LLAVE_SAIA]."/";    
    else   
     $dir= $ruta_almacenamiento.$doc[0]["estado"]."/".$doc[0]["fecha"]."/".$_REQUEST["iddoc"]."/pdf/";
    //echo $dir."<br />";
    crear_destino($dir); 
    $dest_filename =$dir.$this->filename_escape($this->get_filename()).".".$content_type->default_extension;
     //$dest_filename =$ruta_db_superior."../pdf/".$this->filename_escape($this->get_filename()).".".$content_type->default_extension;
//echo $dest_filename;
	
    if(is_file($dest_filename))
       unlink($dest_filename);
     }
     //die($tmp_filename);
    if(rename($tmp_filename, $dest_filename))
      {echo  $dest_filename;
       $nombre=$dir.basename($dest_filename);
       if($doc[0]["estado"]!="ACTIVO"){
       		$firma_digital = busca_filtro_tabla("","documento A, formato B","iddocumento=".$_REQUEST["iddoc"]." and lower(A.plantilla)=lower(B.nombre) and B.firma_digital=1","",$conn);
		   if($firma_digital["numcampos"] > 0){
	        	include_once($ruta_db_superior."digital_signed/estampado_tiempo.php");
				proceso_estampado_pdf($dest_filename);
			}
    	}   
       if(isset($_REQUEST["background"]) && $_REQUEST["background"]==1)
          {$ruta1=$ruta_db_superior."ordenar.php?accion=mostrar&mostrar_formato=1&key=".$_REQUEST["iddoc"];
           $ruta2=$dest_filename;
           echo "<script>
                 if(window.name=='centro')
                   window.location='".$ruta1."';
                 else
                   window.location='".$ruta2."';  
                 </script>";
          }
       elseif(isset($_REQUEST["background"]) && $_REQUEST["background"]==2)
          {//redirecciona($dest_filename);
          
           redirecciona($ruta_db_superior."exportar_seleccionar_impresion.php?seleccion=".$_REQUEST["seleccion"]."&nombre_archivo=".$_REQUEST["nombre_archivo"].".pdf&orientacion=".$_REQUEST["orientacion"]."&papel=".$_REQUEST["papel"]);
           die();
          }
       elseif(isset($_REQUEST["versionamiento"])&&$_REQUEST["versionamiento"])
          die("||".$nombre);

      if (!is_file($dest_filename)) 
         { alerta("ERROR AL CREAR EL PDF");
         }
      else{
        
        redirecciona($dest_filename."?rnd=".rand(0,100));
        die();
       } 
      }
    else  
     alerta("ERROR AL CREAR EL PDF1");

  }
}
?>

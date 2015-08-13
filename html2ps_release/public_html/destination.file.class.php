<?php
class DestinationFile extends Destination {
  var $_link_text;
  
  function DestinationFile($filename, $link_text = null) {
    $this->Destination($filename);

    $this->_link_text = $link_text;
  }

  function process($tmp_filename, $content_type) 
  {
   $pos=substr_count($_SERVER["PHP_SELF"],"/");
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
   $salir=str_repeat("../",$pos-3);
   $salir = $ruta_db_superior;
   if(strpos($this->get_filename(),"BORRADOR"))
    $estado="ACTIVO";
   else
    $estado = "APROBADO";
   $num = $_REQUEST["iddoc"];
   $fecha = substr($this->get_filename(),-10,7);
   $fecha = str_replace('_','-',$fecha);    
    if(!is_dir($ruta_db_superior.RUTA_PDFS."$estado"))
      mkdir($ruta_db_superior.RUTA_PDFS."$estado",0777);
    if(!is_dir($ruta_db_superior.RUTA_PDFS."$estado/$fecha"))
      mkdir($ruta_db_superior.RUTA_PDFS."$estado/$fecha",0777);  
    if(!is_dir($ruta_db_superior.RUTA_PDFS."$estado/$fecha/$num"))
      mkdir($ruta_db_superior.RUTA_PDFS."$estado/$fecha/$num",0777);
    if(!is_dir($ruta_db_superior.RUTA_PDFS."$estado/$fecha/$num/pdf"))
      mkdir($ruta_db_superior.RUTA_PDFS."$estado/$fecha/$num/pdf",0777);     
   if(!isset($_REQUEST['nombre_archivo']))
      $dest_filename =$ruta_db_superior.RUTA_PDFS."$estado/$fecha/$num/pdf/".$this->filename_escape($this->get_filename()).".".$content_type->default_extension;  
    else
      $dest_filename=$ruta_db_superior.$_REQUEST["nombre_archivo"];
    if(is_file($dest_filename))
       unlink($dest_filename);
    if(rename($tmp_filename, $dest_filename))
      {      
      $nombre=$ruta_db_superior.RUTA_PDFS."$estado/$fecha/$num/pdf/".basename($dest_filename); 
      $nombre2= "$estado/$fecha/$num/pdf/".basename($dest_filename);   
      //alerta($nombre);
      if (!is_file($nombre)&&!isset($_REQUEST["nombre_archivo"])) 
         { alerta("ERROR AL CREAR EL PDF");
         }
      else
       {//die();
        //alerta("PDF CREADO SATISFACTORIAMENTE");
        if(isset($_REQUEST["background"]) && $_REQUEST["background"]==1)
          redirecciona($ruta_db_superior."vacio.php");
       if(isset($_REQUEST["background"]) && $_REQUEST["background"]==2)
          { //die($ruta_db_superior."exportar_seleccionar_impresion.php?seleccion=".$_REQUEST["seleccion"]."&nombre_archivo=".$_REQUEST["nombre_archivo"]."&orientacion=".$_REQUEST["orientacion"]."&papel=".$_REQUEST["papel"]);  
           redirecciona($ruta_db_superior."exportar_seleccionar_impresion.php?seleccion=".$_REQUEST["seleccion"]."&nombre_archivo=".$_REQUEST["nombre_archivo"]."&orientacion=".$_REQUEST["orientacion"]."&papel=".$_REQUEST["papel"]);
           die();
          }
        else
          redirecciona($nombre);        
       } 
      }
    else   alerta(" ERROR AL CREAR EL PDF. ");
/*
    copy($tmp_filename, $dest_filename);

    $text = $this->_link_text;
    $text = preg_replace('/%link%/', 'file://'.$dest_filename, $text);
    $text = preg_replace('/%name%/', $this->get_filename(), $text);
    print $text;
    ../out/179_BORRADOR_CARTA_2008_08_22.pdf
    */
  }
}
?>

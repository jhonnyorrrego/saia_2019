<?php
@session_start();
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
?> 

<script>
/*<Clase>
<Nombre>crear_pdfs</Nombre>
<Parametros>destinos:iddatos_ejecutor de los destinos seleccionados;iddoc: id del documento;usuario:login del usuario logueado actualmente;adicionales: parametros como tipo de papel, margenes,etc</Parametros>
<Responsabilidades>Genera con ajax por separado un pdf para cada destino de la carta y al terminar llama esta misma pagina con un parametro distinto, para ejecutar el codigo que los une<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function crear_pdfs(destinos,iddoc,usuario,adicionales)
{lista=destinos.split(",");
 for(i=0;i<lista.length;i++){
  adicionales_envio="destinos="+lista[i]+"&iddoc="+iddoc+"&plantilla=carta&nombre_archivo=temporal_"+usuario+"/carta"+iddoc+"_"+i+adicionales;
  ingresa=llamado("html2ps.php","llamado",adicionales_envio);
 }
if(ingresa)
  window.location="generar_carta.php?iddoc="+iddoc+"&unir=1&cuantos="+i+adicionales;   
}

function llamado(url, id_contenedor,parametros)
{var pagina_requerida = false
 if (window.XMLHttpRequest)
	{// Si es Mozilla, Safari etc
	 pagina_requerida = new XMLHttpRequest();
	}
 else if (window.ActiveXObject)
	{ // pero si es IE
	 try
		{pagina_requerida = new ActiveXObject("Msxml2.XMLHTTP");
		}
	 catch (e)
		{ // en caso que sea una versión antigua
		 try
			{pagina_requerida = new ActiveXObject("Microsoft.XMLHTTP");
			}
		 catch (e){}
		}
 	}
 else
	return false
 pagina_requerida.onreadystatechange=function(){ // función de respuesta
   	if(pagina_requerida.readyState==4)
     {
  		if(pagina_requerida.status==200)
          {
    			 cargarpagina(pagina_requerida, id_contenedor);
    		  }
       else if(pagina_requerida.status==404)
          {
  			   document.write("La página no existe");
  		    }
  	  }

   }

 pagina_requerida.open('POST', url, false); // asignamos los métodos open y send
 pagina_requerida.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 pagina_requerida.send(parametros);
return(true);
}            
/*
<Clase>
<Nombre>cargarpagina
<Parametros>pagina_requerida-objeto XMLHttpRequest ;id_contenedor-id del componente donde se pondrán los datos
<Responsabilidades> poner la información requerida en su sitio en la pagina xhtml
<Notas>
<Excepciones>si no se encuentra un elemento con el id id_contenedor genera un error,
si hay errores en el codigo html presenta problemas
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function cargarpagina(pagina_requerida, id_contenedor)
  {
   if (pagina_requerida.readyState == 4 && (pagina_requerida.status==200 || window.location.href.indexOf("http")==-1))
      document.getElementById(id_contenedor).innerHTML=pagina_requerida.responseText;
  }
</script>
<?php
include_once($ruta_db_superior."db.php");
$login=usuario_actual("login");
//print_r($_REQUEST);
//echo("entra a generar carta");
if(isset($_REQUEST["unir"]))
{
 include_once('../fpdf/fpdf.php');
 include_once($ruta_db_superior.'manipular_pdf/fpdi.php');

 class concat_pdf extends FPDI {

    var $files = array();

    function setFiles($files) {
        $this->files = $files;
    }

    function concat() {
        foreach($this->files AS $file) {
            $pagecount = $this->setSourceFile($file);
            for ($i = 1; $i <= $pagecount; $i++) {
                 $tplidx = $this->ImportPage($i);
                 $s = $this->getTemplatesize($tplidx);
                 if($_REQUEST["orientacion"])
                   $orientacion="L";
                 else
                   $orientacion="P";

                 $this->AddPage($orientacion, array($s['w'], $s['h']));
                 $this->useTemplate($tplidx);
            }
        }
    }

}
$listado=array();
crear_destino($ruta_db_superior."temporal_".$login);
 /*se concatenan los pdf de todos los destinos*/
for($i=0;$i<$_REQUEST["cuantos"];$i++)
  $listado[]=$ruta_db_superior."temporal_".$login."/carta".$_REQUEST["iddoc"]."_$i.pdf";
//print_r($listado);
  $orientacion="P";
  $papel="Letter";
  if(isset($_REQUEST["orientacion"]))
     {if($_REQUEST["orientacion"])
         $orientacion="L";
     }
  if(isset($_REQUEST["papel"]))
     {$papel=$_REQUEST["papel"];
     }
  $pdf =& new concat_pdf($orientacion,"mm",$papel);
  $pdf->SetXY(0, 0);  
  $pdf->setFiles($listado);  
  $pdf->concat();
  $nombre=$ruta_db_superior."temporal_".$login."/carta".$_REQUEST["iddoc"].".pdf";
//die("encontrado:".is_file($nombre));
  $pdf->Output($nombre, 'F');

  if(is_file($nombre))
  {for($i=0;$i<$_REQUEST["cuantos"];$i++)
      unlink($ruta_db_superior."temporal_".$login."/carta".$_REQUEST["iddoc"]."_$i.pdf");
  //print_r($_REQUEST);
   if(!isset($_REQUEST["seleccion"]))
    {$datos_doc=busca_filtro_tabla("pdf,iddocumento,estado,plantilla,".fecha_db_obtener('fecha','Y-m-d')." as fecha,".fecha_db_obtener('fecha','Y-m')." as fecha2,numero ",DB.".documento","iddocumento=".$_REQUEST["iddoc"],"",$conn);
     if($datos_doc[0]["numero"]>0)
      {$datos_doc[0]["nombre"]=$datos_doc[0]["plantilla"]."_";
       $datos_doc[0]["nombre"].=$datos_doc[0]["numero"]."_".str_replace("-","_",$datos_doc[0]["fecha"]);  
       $nombre2="../".$datos_doc[0]["estado"]."/".$datos_doc[0]["fecha2"]."/".$datos_doc[0]["iddocumento"]."/pdf/".$datos_doc[0]["nombre"].".pdf";
        //chmod($nombre,PERMISOS_ARCHIVOS);
        crear_destino($ruta_db_superior."../".$datos_doc[0]["estado"]."/".$datos_doc[0]["fecha2"]."/".$datos_doc[0]["iddocumento"]."/pdf");
     if(is_file($ruta_db_superior.$nombre2))
       unlink($ruta_db_superior.$nombre2);
     if(rename($nombre,$ruta_db_superior.$nombre2))
         {$sql="update ".DB.".documento set pdf='$nombre2' where iddocumento='".$datos_doc[0]["iddocumento"]."'";
          phpmkr_query($sql,$conn);
          $nombre=$ruta_db_superior.$nombre2;
         }
       else
         die("fallo al copiar archivo");
      }
    }
   else
    {redirecciona($ruta_db_superior."exportar_seleccionar_impresion.php?nombre_archivo=".str_replace("../","",$nombre)."&papel=".$_REQUEST["papel"]."&orientacion=".$_REQUEST["orientacion"]."&seleccion=".$_REQUEST["seleccion"]);
     die();
    }    
   redirecciona($nombre);
  }
 
}
else
{    /*hace un llamado a la funcion de javascript que crea el pdf para cada uno de los destinos*/
echo "<label style='font-family:verdana;font-size:x-small;color:gray'>Generando Pdf...</label>";
/*$destinos=busca_filtro_tabla("destinos","ft_carta","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);  */
crear_destino($ruta_db_superior."temporal_".$login);
if(!is_dir($ruta_db_superior."temporal_".usuario_actual("login")))
  {mkdir($ruta_db_superior."temporal_".usuario_actual("login"));
   chmod($ruta_db_superior."temporal_".usuario_actual("login"),PERMISOS_CARPETAS);
  }
$adicionales="";
if(isset($_REQUEST["vista"]))
  $adicionales.="&vista=".$_REQUEST["vista"];
if(isset($_REQUEST["seleccion"]))
  $adicionales.="&margenes=".$_REQUEST["margenes"]."&font_size=".$_REQUEST["font_size"]."&orientacion=".$_REQUEST["orientacion"]."&papel=".$_REQUEST["papel"]."&tipo=6&ocultar_firmas=".$_REQUEST["ocultar_firmas"]."&seleccion=".$_REQUEST["seleccion"];
if(@$_REQUEST["varios_destinos"])
$script="<script >crear_pdfs('".$_REQUEST["varios_destinos"]."','".$_REQUEST["iddoc"]."','".$login."','$adicionales');</script><div name='llamado' id='llamado'>
</div>";
echo $script;
}
?>

<?php
include_once("db.php");

?>
<script text="javascript">
function mostrar_archivos(archivos)
{
  //var e = parent.document.getElementById("mostrar_archivos");
  //alert(archivos);
  if(archivos != undefined)
    llamado("upload.php","mostrar_archivos","enviado=2&archivo="+archivos);
  //document.getElementById("comple"+idcomponente).style.display="inline";
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
		{ // en caso que sea una versi�n antigua
		 try
			{pagina_requerida = new ActiveXObject("Microsoft.XMLHTTP");
			}
		 catch (e){}
		}
 	}
 else
	return false
 pagina_requerida.onreadystatechange=function(){ // funci�n de respuesta
   	if(pagina_requerida.readyState==4)
     { 	
  		if(pagina_requerida.status==200)
          {
    			 cargarpagina(pagina_requerida, id_contenedor);
    		  }
       else if(pagina_requerida.status==404)
          {
  			   document.write("La p�gina no existe");
  		    }
  	  }
   
   }
 
 pagina_requerida.open('POST', url, true); // asignamos los m�todos open y send
 pagina_requerida.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 pagina_requerida.send(parametros);

}
function cargarpagina(pagina_requerida, id_contenedor)
  {
   if (pagina_requerida.readyState == 4 && (pagina_requerida.status==200 || window.location.href.indexOf("http")==-1))
      parent.document.getElementById(id_contenedor).innerHTML=pagina_requerida.responseText;
  }
</script>
<?php
function examinar()
  {echo '<form name="subir" id="subir" method="post" enctype="multipart/form-data" action="upload.php">
         <table align="center" style="font: 9px verdana" width="100%"" height="100%">
         <tr>
           <td valign=middle>
             <input type="file" name="archivo" id="archivo" >
             <input type="submit" name="Guardar" value="GUARDAR" style="font: 9px verdana">';
    if(isset($_REQUEST["iddoc"])){   
      echo "<input type='hidden' name='iddoc' value='".$_REQUEST["iddoc"]."'>";
    }  
    if(isset($_REQUEST["calidad"])){
      echo '</td>
        	 <td bgcolor="#F5F5F5" >
              TIPO DE ANEXO<br />
              <input type=radio name="tipo_anexo" value="BASE" checked >Base<br />
              <input type=radio name="tipo_anexo" value="DOCUMENTO" >Documento<br />
              <input type=radio name="tipo_anexo" value="REGISTRO" >Registro<br />
           </td><input type=hidden name="calidad" value="1" ><input type=hidden name="enviado" value="1" >';

      }
      else{ 
        echo '<input type=hidden name="enviado" value="1" ><input type="hidden" name="tipo_anexo" value="BASE">';
      }       
      echo '</tr>
          </table>
         </form>
         ';
  }
function upload()
  {global $conn;
  	$config = busca_filtro_tabla("valor","configuracion","nombre='tipo_almacenamiento'","",$conn);
       if($config["numcampos"])
        {
        	$tipo_almacenamiento=$config[0]["valor"];
        }
       else 
           $tipo_almacenamiento="archivo"; // Si no encuentra el registro en configuracion almacena en archivo
  
   if (is_uploaded_file($_FILES['archivo']['tmp_name']) && $_FILES['archivo']['size']>0)
      {global $conn;
       //valido si se permite el upload de este tipo de archivo
       $nombre=$_FILES['archivo']['name'];
       $datos_archivo = pathinfo($nombre);
       $extension = $datos_archivo['extension'];    
       $ext=strtolower($extension);
       $error=0;   
       $extensiones=busca_filtro_tabla("lower(A.valor) as valor","configuracion A"," A.nombre='extensiones_upload'","",$conn);
       if($extensiones<>"")
          {$extensiones2=explode(",",strtoupper($extensiones[0]["valor"]));
           if(!in_array(strtoupper($ext),$extensiones2))
              {echo "<center>Este tipo de archivo no est&aacute; entre los permitidos (".$extensiones[0]["valor"].")</center>";
               $error=1;
              }
          }
         // Nombre aleatorio
         if(isset($_REQUEST["iddoc"]))
           $dir_anexos="../anexos/".$_REQUEST["iddoc"]."/";
         else
           {if(!is_dir("../anexos/temporal/"))
              {mkdir("../anexos/temporal/",PERMISOS_CARPETAS);
               chmod("../anexos/temporal/",PERMISOS_CARPETAS);
              }
            $dir_anexos="../anexos/temporal/";
           }

         $temp_filename = time().".".$ext;
         if (file_exists($dir_anexos . $temp_filename)) 
			{  $tmpVar = 1;
	  			   while(file_exists($dir_anexos. $tmpVar . '_' . $temp_filename)) 
	  			   	{
					  $tmpVar++;
	   			    }
               $temp_filename=$tmpVar . '_' . $temp_filename;
  		    }
             
        //  echo $dir_anexos.$temp_filename;die();
       if(!is_dir($dir_anexos))   
         mkdir($dir_anexos,0775);
         
       $resultado=copy($_FILES['archivo']['tmp_name'],$dir_anexos.$temp_filename);
       if($resultado && $error==0)
          {if(array_key_exists("iddoc",$_REQUEST)) 
            {
              if($tipo_almacenamiento=="archivo") // Los anexos estan guardados en archivos 	
		          { 	
                    phpmkr_query(("insert into anexos(documento_iddocumento,ruta,tipo,etiqueta) values(".$_REQUEST["iddoc"].",'".$dir_anexos.$temp_filename."','".$_REQUEST["tipo_anexo"]."','".$nombre."'".")"),$conn);
                    $versionado=busca_filtro_tabla("*","documento_version","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
		          }
		       elseif($tipo_almacenamiento=="db") 
		          { phpmkr_query("INSERT INTO binario(nombre) VALUES ('$nombre')", $conn);
	    	      	$idbin = phpmkr_insert_id();
	    	      	$fcont=fopen($dir_anexos.$temp_filename,"rb");
	    	      	$cont=fread($fcont,filesize($dir_anexos.$temp_filename));
	    	      	if(guardar_lob("datos","binario","idbinario=$idbin",$cont,"archivo",$conn))
	    	      	{	unlink($dir_anexos.$temp_filename); // Se elimina el temporal .. el blob se almaceno correctamente
	    	      		phpmkr_query("INSERT INTO anexos(ruta,documento_iddocumento,tipo,etiqueta) VALUES ('$idbin',".$_REQUEST["iddoc"].",'".$_REQUEST["tipo_anexo"]."','".$nombre."')", $conn);    	      		
	    	      	}
			       	
		          } 
             echo "<center>Archivo guardado correctamente.</center>
                   <script>
                   parent.document.getElementById('listar_archivos').src=parent.document.getElementById('listar_archivos').src;
                   </script>";
            }
           else
             {echo "<center>Archivo guardado correctamente.</center>
                   <script>
                   var casilla=parent.document.getElementById('archivos');
                   mostrar_archivos();
                   if(casilla.value=='')
                      casilla.value+='".$temp_filename.";".$nombre.";".$_REQUEST["tipo_anexo"].";';
                   else
                      casilla.value+=',".$temp_filename.";".$nombre.";".$_REQUEST["tipo_anexo"]."';
                    mostrar_archivos(casilla.value);  
                   </script>";
            }
           
          }
       else
          echo "<center>No se pudo guardar el archivo</center>";
      } 
   else
       alerta("No se pudo guardar el archivo");   
   echo "<center><a href='upload.php";
   
   if(isset($_REQUEST["iddoc"]))
      {echo "?iddoc=".$_REQUEST["iddoc"];
       if(isset($_REQUEST["calidad"]))
        {echo "&calidad=1";
        }
      }
   if(isset($_REQUEST["calidad"]))
      {echo "?calidad=1";
      }
   echo "'>Adjuntar otro</a></center>";         
  }
  
  function mostrar_upload($archivos)
  {
    if(strstr($archivos,','))
     {$nombres = explode(',',$archivos); 
      for($i=0; $i<count($nombres); $i++)
         {$datos=explode(";",$nombres[$i]);
          echo "<li> ".$datos[1]."<br />";
         }
     }
    else 
     {$datos=explode(";",$archivos);
          echo "<li> ".$datos[1]."<br />";
     }
  }   
    
?>
<body bgcolor="#F5F5F5" >
<font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
<?php
if((!array_key_exists("enviado",$_REQUEST) or $_REQUEST["enviado"]=="0"))
   examinar();
elseif($_REQUEST["enviado"]=="1")
   upload();
else
  mostrar_upload($_REQUEST["archivo"]);    
?>
</font>
</body>

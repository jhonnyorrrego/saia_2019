<?php
//Almacena un archvios binario y retorna un id 
function almacena_binario_db($archivo,$descripcion)
{
  
  $sKeyWrk = NULL;
    //  Insercion en la tabla binario
 
 if(is_file($archivo)) //  Verificacion
    { 
      $datos_archivo = pathinfo($archivo);
		$nombre_original=$datos_archivo['basename'];
  
	$strsql = "INSERT INTO binario (descripcion,nombre_original) values('".$descripcion."','".$nombre_original."')";
   //echo $strsql;
	phpmkr_query($strsql);
   $sKeyWrk=phpmkr_insert_id();
  
   if($sKeyWrk!=NULL) // Re - Verificacion
    {   
         $fileHandle = fopen($archivo, "rb");
         $fileContent = fread($fileHandle,filesize($archivo));
			fclose($fileHandle);
			$theValue = addslashes($fileContent);
			//Borrar el archivo 
 		   //@unlink($_FILES["x_firma"]["tmp_name"]);
			guardar_lob("datos","binario","idbinario=".$sKeyWrk,$theValue,"archivo");
			
 
      }
  
  if($sKeyWrk!=NULL)
   { 
     $datos=busca_filtro_tabla("datos","binario","binario.idbinario=".$sKeyWrk,"");
	  if($datos["numcampos"])
	   {
	    $dat=stripslashes($datos[0]["datos"]);
	    if(strcmp($dat,$fileContent)==0)  // Comparacion con segurirdad binaria para garantizar que no se pierde la informacion 
	      {
	        echo "<br> ----------------- Comprobacion Binaria Exitosa"; 
	      }
	     else 
	      { echo "<br> ----------------- El binario presenta diferencias con el archivo original. Datos documento :".$nombre." Datos archivo :".$archivo;
			  // Se elimina el binario inconsistente
           $strsql = "DELETE FROM binario WHERE idbinario=".$sKeyWrk;
           phpmkr_query($strsql);
			  $sKeyWrk =NULL;
	        alerta("No se Pudo almacenar el archivo :".$nombre_original."en la base de datos",'error',4000);
	          
	      } 
	   }  
	  
   }
 
 } // Fin if isfile
 
return($sKeyWrk);
}

function mostrar_miniatura($idpag)
{
   $datos=busca_filtro_tabla("idbinario_min","pagina","where id_pagina=".$idpag,"");
   
   if( $datos["numcampos"]>0 &&  $datos[0]["idbinario_min"] != NULL)
    { 
      $datos_min=busca_filtro_tabla("datos","binario","where idbinaria=".$idpag,"");
    }  
    
}

?>


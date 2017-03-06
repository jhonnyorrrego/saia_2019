<?php

/*function guardar_lob($campo,$tabla,$condicion,$contenido,$tipo,$conn)
{ 
  $resultado=TRUE;
//  die($campo.$tabla.$condicion.$contenido);
  if(MOTOR=="Oracle")
    {$sql = "SELECT
           $campo
        FROM
           $tabla
        WHERE
           $condicion
        FOR UPDATE ";
     //die($sql);
      $stmt = oci_parse($conn->Conn->conn, $sql);
      // Execute the statement using OCI_DEFAULT (begin a transaction)
      oci_execute($stmt, OCI_DEFAULT) or print_r(OCIError ($stmt));
      
      // Fetch the SELECTed row
      if ( FALSE === ($row = oci_fetch_assoc($stmt) ) ) 
        {
         oci_rollback($conn->Conn->conn);
         alerta("No se pudo modificar el campo.");
         $resultado=FALSE;
        }
      
      // Discard the existing LOB contents
      
      if ( !$row[strtoupper($campo)]->truncate() ) 
        {
          oci_rollback($conn->Conn->conn);
          alerta("No se pudo modificar el campo.");
          $resultado=FALSE;
        }

      // Now save a value to the LOB
      if($tipo=="texto")//para campos clob como en los formatos
        {$contenido=limpia_tabla($contenido);
         if ( !$row[strtoupper($campo)]->save(trim((($contenido))))) 
          {  oci_rollback($conn->Conn->conn);
             $resultado=FALSE;
          }
         else 
         oci_commit($conn->Conn->conn);  
        }
      elseif($tipo=="archivo")//para campos blob como la firma
        {if ( !$row[strtoupper($campo)]->save($contenido)) 
           { oci_rollback($conn->Conn->conn);
             $resultado=FALSE;
           }  
         else 
           oci_commit($conn->Conn->conn);  
        }      
      //oci_free_statement($stmt);
      //$row[strtoupper($campo)]->free();
    }
 if(MOTOR=="MySql")
    {if($tipo=="archivo")
       {$sql="update $tabla set $campo='".$contenido."' where $condicion";
        mysql_query($sql,$conn->Conn->conn);
        // TODO verificar resultado de la insecion $resultado=FALSE; 
       }
     elseif($tipo=="texto")
        {$contenido=codifica_encabezado(limpia_tabla($contenido));
         $sql="update $tabla set $campo='".$contenido."' where $condicion";
         mysql_query($sql,$conn->Conn->conn);
        }
    }
 return($resultado);   
}
*/
//Almacena un archvios binario y retorna un id 
function almacena_binario_db($archivo,$descripcion)
{
  global $conn;
  $sKeyWrk = NULL;
    //  Insercion en la tabla binario
 
 if(is_file($archivo)) //  Verificacion
    { 
      $datos_archivo = pathinfo($archivo);
		$nombre_original=$datos_archivo['basename'];
  
	$strsql = "INSERT INTO binario (descripcion,nombre_original) values('".$descripcion."','".$nombre_original."')";
   //echo $strsql;
	phpmkr_query($strsql,$conn);
   $sKeyWrk=phpmkr_insert_id();
  
   if($sKeyWrk!=NULL) // Re - Verificacion
    {   
         $fileHandle = fopen($archivo, "rb");
         $fileContent = fread($fileHandle,filesize($archivo));
			fclose($fileHandle);
			$theValue = addslashes($fileContent);
			//Borrar el archivo 
 		   //@unlink($_FILES["x_firma"]["tmp_name"]);
			guardar_lob("datos","binario","idbinario=".$sKeyWrk,$theValue,"archivo",$conn);
			
 
      }
  
  if($sKeyWrk!=NULL)
   { 
     $datos=busca_filtro_tabla("datos","binario","binario.idbinario=".$sKeyWrk,"",$conn);
	  if($datos["numcampos"])
	   {
	    $dat=stripslashes($datos[0]["datos"]);
	    if(strcmp($dat,$fileContent)==0)  // Comparacion con segurirdad binaria para garantizar que no se pierde la informacion 
	      {
	        //echo "<br> ----------------- Comprobacion Binaria Exitosa";
	      }
	     else 
	      { echo "<br> ----------------- El binario presenta diferencias con el archivo original. Datos documento :".$nombre." Datos archivo :".$archivo;
			  // Se elimina el binario inconsistente
           $strsql = "DELETE FROM binario WHERE idbinario=".$sKeyWrk;
           phpmkr_query($strsql,$conn);
			  $sKeyWrk =NULL;
	        alerta("No se Pudo almacenar el archivo :".$nombre_original."en la base de datos");
	          
	      } 
	   }  
	  
   }
 
 } // Fin if isfile
 
return($sKeyWrk);
}

function mostrar_miniatura($idpag)
{
   $datos=busca_filtro_tabla("idbinario_min","pagina","where id_pagina=".$idpag,"",$conn);
   
   if( $datos["numcampos"]>0 &&  $datos[0]["idbinario_min"] != NULL)
    { 
      $datos_min=busca_filtro_tabla("datos","binario","where idbinaria=".$idpag,"",$conn);
    }  
    
}

?>
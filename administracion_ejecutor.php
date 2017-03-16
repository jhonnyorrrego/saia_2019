<?php
  include ("header.php");
  include_once("db.php");
  include ("phpmkrfn.php");
  if($_POST["envio"] == "Insertar"){
    if($_POST['vaciar'] == "1")
    {
       $conn->Ejecutar_Sql("truncate ejecutor");
       $conn->Ejecutar_Sql("truncate datos_ejecutor");
    }
    else
    {
      if(is_uploaded_file($_FILES['archivo']['tmp_name'])){
        copy($_FILES['archivo']['tmp_name'],$_FILES['archivo']['name']);
        $archivo = fopen($_FILES['archivo']['name'],'r');
        //$i = 1;
        $actual = date('Y-m-d h:i:s');  
        while($linea = fgetcsv($archivo,0,",")){  
          $columna1 = $linea[0];
          $datos = 0;
          $existe = 0; 
          /*$columna2 = $linea[1];  
          $columna3 = $linea[2];  
          $columna4 = $linea[3];
          $columna5 = $linea[4];*/
          $datos = explode(';',$columna1);
          $existe = busca_filtro_tabla("idejecutor","ejecutor","identificacion='".$datos[0]."'","",$conn);
         
          if($existe['numcampos'] > 0){
          
            // $conn->Ejecutar_Sql("UPDATE ejecutor set nombre='".$datos[1]."' WHERE idejecutor=".$existe[0]['idejecutor']);
            // $conn->Ejecutar_Sql("UPDATE datos_ejecutor set direccion='".$datos[2]."', telefono='".$datos[4]."', ciudad='".$datos[3]."' WHERE ejecutor_idejecutor=".$existe[0]['idejecutor']);
            $conn->Ejecutar_Sql("UPDATE ejecutor set nombre='".($datos[1])."' WHERE idejecutor=".$existe[0]['idejecutor']);
            $conn->Ejecutar_Sql("UPDATE datos_ejecutor set direccion='".($datos[2])."', telefono='".$datos[4]."', ciudad='".$datos[3]."' WHERE ejecutor_idejecutor=".$existe[0]['idejecutor']);
          }
          else
          {
            $conn->Ejecutar_Sql("INSERT INTO ejecutor(identificacion,nombre,fecha_ingreso) values('".$datos[0]."','".($datos[1])."','".$actual."')");
            
            $idejecutor = $conn->ultimo_insert();
            
            $conn->Ejecutar_Sql("INSERT INTO datos_ejecutor(ejecutor_idejecutor,direccion,telefono,ciudad) values('".$idejecutor."','".($datos[2])."','".$datos[4]."','".$datos[3]."')");
          } 
        }  
        fclose($archivo);
        
      }
    }
  }
  echo "  <form method='post' enctype='multipart/form-data'>
          <table width='30%'><tr><td class='encabezado' colspan='2'><center>Anexar ejecutores</center></td>
            </tr>
            <tr>
              <td class='encabezado'>Adjunte el archivo csv</td>
              <td><input type='file' name='archivo'></td>
            </tr>
            <tr>
              <td class='encabezado'>Vaciar tablas?</td>
              <td><input type='checkbox' value='1' name='vaciar'></td>
            </tr>
            <tr>
              <td><input type='submit' value='Insertar' name='envio'></td>
            </tr>
          </table>
        </form>";
  //include_once("footer.php");
?>
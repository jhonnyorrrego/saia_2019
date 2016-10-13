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

include_once("db.php");
function listar_tablas_externa($conn2=NULL,$tabla=NULL){
if($conn2->Conn->Motor=="Oracle"){
  $sql2="select TABLE_NAME from DBA_TABLES WHERE OWNER='".$conn2->Conn->Usuario."'";
  if($tabla){
    $sql2.=" AND TABLE_NAME='".strtoupper($tabla)."'";
  } 
}
if($conn2->Conn->Motor=="MySql"){
  $sql2="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema =  '".$conn2->Conn->Db."' AND table_type='BASE TABLE'";
  if($tabla){
    $sql2.="  AND  table_name LIKE '".strtoupper($tabla)."'";
  }
}
$sql2.=' ORDER BY table_name ';
$listado=$conn2->Ejecutar_Sql($sql2); 
$lista_tablas["tablas"]=array();
$lista_tablas["cantidad"]=0;
while($fila=phpmkr_fetch_array_externo($listado,$conn2)){
  array_push($lista_tablas["tablas"],$fila[0]);
  $lista_tablas["cantidad"]++;
}  
return($lista_tablas);
}
function listar_campos_tabla_externa($tabla=NULL,$conn2=NULL,$campo=Null){
   if($tabla==NULL)
      $tabla=$_REQUEST["tabla"];
   if($conn2->Conn->Motor=="MySql"){
      $sql2="SELECT COLUMN_NAME AS Field, COLUMN_TYPE AS Type, IS_NULLABLE AS Null_, COLUMN_DEFAULT AS Default_ FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$tabla."' AND table_schema = '".$conn2->Conn->Db."'";
      if($campo)
        $sql2.=" AND column_name LIKE '".$campo."'";      
      $sql2.=' ORDER BY Field';
      $datos_tabla=$conn2->Ejecutar_Sql($sql2);
    }
    else if($conn2->Conn->Motor=="Oracle"){
      $sql2="SELECT column_name  Field, data_type Type, nullable Null_, data_default Default_,data_length,data_precision FROM user_tab_columns WHERE table_name='".strtoupper($tabla)."'";
      if($campo)
        $sql2.=" AND column_name ='".strtoupper($campo)."'";
      $sql2.=' ORDER BY Field';
      $datos_tabla=$conn2->Ejecutar_Sql($sql2); 
    }
   $lista_campos["campos"]=array();
   $lista_campos["cantidad"]=0;
   while($fila=phpmkr_fetch_array_externo($datos_tabla,$conn2)){
   if($fila[1]<>'DATE'){
    if($conn2->Conn->Motor=="Oracle"){
      if($fila[5]=="")
           $fila[1].='('.$fila[4].')';
          else
           $fila[1].='('.$fila[5].')';
     }  
   }
       array_push($lista_campos["campos"],array($fila[0],$fila[1],$fila[2],$fila[3]));
       $lista_campos["cantidad"]++;
      } 
   return($lista_campos);   
}  
function guardar_lob_externa($campo,$tabla,$condicion,$contenido,$tipo,$conn2,$log=1){ 
  $resultado=TRUE;
  
  if(MOTOR=="Oracle")
    {$sql = "SELECT
           $campo
        FROM
           ".DB.".$tabla
        WHERE
           $condicion
        FOR UPDATE ";

      $stmt = oci_parse($conn2->Conn->conn, $sql);
      // Execute the statement using OCI_DEFAULT (begin a transaction)
      oci_execute($stmt, OCI_DEFAULT) or print_r(OCIError ($stmt));
      
      // Fetch the SELECTed row
      if ( FALSE === ($row = oci_fetch_assoc($stmt) ) ) 
        {
         oci_rollback($conn2->Conn->conn);
         alerta("No se pudo modificar el campo.");
         echo $sql;
         die();
         //die("tabla:$tabla  campo:$campo condicion:$condicion");
         $resultado=FALSE;
        }
       else
      {// Now save a value to the LOB
      if($tipo=="texto")//para campos clob como en los formatos
        { //echo strtoupper($campo)."<br />";
        if($row[strtoupper($campo)]->size()>0)
            $contenido_actual=htmlspecialchars_decode($row[strtoupper($campo)]->read($row[strtoupper($campo)]->size()));
         else
            $contenido_actual="";  
            if($contenido_actual<>$contenido)
           { if ($row[strtoupper($campo)]->size()>0 && !$row[strtoupper($campo)]->truncate() ) 
                {
                  oci_rollback($conn2->Conn->conn);
                  alerta("No se pudo modificar el campo.");
                  $resultado=FALSE;
                }
            else    
               {$contenido=limpia_tabla($contenido);
                if ( !$row[strtoupper($campo)]->save(trim(htmlentities(utf8_decode($contenido))))) 
                  {  oci_rollback($conn2->Conn->conn);
                     $resultado=FALSE;
                  }
                else 
                  oci_commit($conn2->Conn->conn);  
                //*********** guardo el log en la base de datos **********************
                preg_match("/.*=(.*)/", strtolower($condicion), $resultados);
                $llave=trim($resultados[1]);

                if($log)
                  {$sqleve="INSERT INTO ".DB.".evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado) VALUES('".usuario_actual("funcionario_codigo")."',to_date('".date('Y-m-d H:i:s')."','YYYY-MM-DD HH24:MI:SS') ,'MODIFICAR', '$tabla', $llave, '0')";
                  
                   $conn2->Ejecutar_Sql($sqleve);
                   $registro=$conn2->Ultimo_Insert();
                   $texto_ant="DECLARE
cont$   CLOB;
BEGIN
    UPDATE $tabla SET $campo=EMPTY_CLOB() 
    WHERE $condicion;
    SELECT $campo
         INTO cont$
         FROM $tabla
        WHERE $condicion
   FOR UPDATE;
   DBMS_LOB.WRITE (cont$, DBMS_LOB.getlength('$contenido_actual'), 1, '$contenido_actual');
COMMIT;   
END";
                   $texto_sig="DECLARE
cont$   CLOB;
BEGIN
UPDATE $tabla SET $campo=EMPTY_CLOB() 
WHERE $condicion;
SELECT $campo
     INTO cont$
     FROM $tabla
    WHERE $condicion
FOR UPDATE;
DBMS_LOB.WRITE (cont$, DBMS_LOB.getlength('$contenido'), 1, '$contenido');
COMMIT;
END";    
                   guardar_lob('codigo_sql','evento',"idevento=".$registro,$texto_sig,'texto',$conn2,0);
                   guardar_lob('detalle','evento',"idevento=".$registro,$texto_ant,'texto',$conn2,0);
                   $archivo="$registro|||".usuario_actual("funcionario_codigo")."|||".date('Y-m-d H:i:s')."|||MODIFICAR|||$tabla|||0|||$texto_ant|||$llave|||$texto_sig";
                   evento_archivo($archivo);
                   //*********************************
                
                }  
              }
           }  

        }
      elseif($tipo=="archivo")//para campos blob como la firma
        {//echo ($campo.$tabla.$condicion.$contenido);
        $contenido=addslashes($contenido);
         if ( !$row[strtoupper($campo)]->truncate() ) 
            {
              oci_rollback($conn2->Conn->conn);
              alerta("No se pudo modificar el campo.");
              $resultado=FALSE;
            }
         if ( !$row[strtoupper($campo)]->save($contenido)) 
           { oci_rollback($conn2->Conn->conn);
            alerta("No se pudo modificar el campo.");
             $resultado=FALSE;
           }  
         else 
           oci_commit($conn2->Conn->conn);  
  
        }      
      oci_free_statement($stmt);
      $row[strtoupper($campo)]->free();
     } 
    }
 if(MOTOR=="MySql")
    {if($tipo=="archivo")
       {$sql="update $tabla set $campo='".addslashes($contenido)."' where $condicion";
        mysqli_query($conn2->Conn->conn, $sql);
        // TODO verificar resultado de la insecion $resultado=FALSE; 
       }
     elseif($tipo=="texto")
        {$contenido=utf8_encode(limpia_tabla($contenido));
         $sql="update $tabla set $campo='".addslashes(stripslashes($contenido))."' where $condicion";
        if($log)
            {preg_match("/.*=(.*)/", strtolower($condicion), $resultados);
             $llave=trim($resultados[1]);
             $anterior=busca_filtro_tabla("$campo","$tabla","$condicion","",$conn2);
             $sql_anterior="update $tabla set $campo='".addslashes(stripslashes($anterior[0][0]))."' where $condicion";

             $sqleve="INSERT INTO ".DB.".evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado,detalle,codigo_sql) VALUES('".usuario_actual("funcionario_codigo")."','".date('Y-m-d H:i:s')."','MODIFICAR', '$tabla', $llave, '0','".addslashes($sql_anterior)."','".addslashes($sql)."')"; 
             $conn2->Ejecutar_Sql($sqleve);
             $registro=$conn2->Ultimo_Insert();
             if($registro)
               {
                $archivo="$registro|||".usuario_actual("funcionario_codigo")."|||".date('Y-m-d H:i:s')."|||MODIFICAR|||$tabla|||0|||".addslashes($sql_anterior)."|||$llave|||".addslashes($sql);
                evento_archivo($archivo);
               }
            }         
         mysqli_query($conn2->Conn->conn, $sql) or die(mysqli_error($conn2->Conn->conn));
        }
    }
 return($resultado);   
}
/*
<Clase>
<Nombre>phpmkr_db_connect
<Parametros>$HOST: Equipo en el que se encuentra la base de datos
            $USER: nombre del usuario con el cual se realizar?la conexi?
            $PASS: contrase? del usuario
            $DB: Nombre de la base de datos, o del esquema
            $MOTOR: Motor con el que se realiza la conexion, Oracle o MySql
<Responsabilidades> Establecer una conexi? entre la base de datos y la aplicacion
<Notas> Hace uso de las clases SQL y conexion, retornando el objeto SQL inicializado,
        con el cual se pueden ejecutar los queries en la base de datos.
<Excepciones>Error al conectarse con la Base de datos, se debe a que no se encuentra disponible o existe algun error en los par?etros
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function phpmkr_db_connect_externo($HOST=HOST,$USER=USER,$PASS=PASS,$DB=DB,$MOTOR=MOTOR,$PORT=PORT,$BASEDATOS=BASEDATOS,$TABLESPACE=''){
$datos=array('basedatos'=>$BASEDATOS,'db'=>$DB,'motor'=>$MOTOR,'host'=>$HOST,'user'=>$USER,'pass'=>$PASS,'port'=>$PORT,'tablespace'=>$TABLESPACE);
$con2=new conexion($datos);
$conn2=new SQL($con2,$MOTOR);
if($conn2 && $conn2->Conn){
  return ($conn2);
}
else if(!$conn2){
  error("Error al Tratar de Crear el SQL.".$conn2->consulta);
  return FALSE;
}
else{
   error("Error al conectarse con la Base de datos.".$conn2->consulta);
   return FALSE;
}
}

/*
<Clase>
<Nombre>phpmkr_db_close
<Parametros>$conn: objeto que contiene la conexion a la base de datos
<Responsabilidades>Cerrar la conexi? actual
<Notas>Examina que la conexion exista y si es asi se encarga de cerrarla
<Excepciones>Error al cerrar la base de datos. Si la conexion que se quiere cerrar no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function phpmkr_db_close_externo($conn2)
{
    $conn2->Conn->Desconecta();
}

/*
<Clase>
<Nombre>phpmkr_query
<Parametros>strsql: cadena que contiene la sentencia sql a ejecutar
            conectar: objeto que contiene la conexion con la base de datos
<Responsabilidades>ejecutar la sentencia sql y guardar el registro de dicha transaccion en el log, es decir, en la tabla evento
<Notas>Examina la cadena y realiza las acciones dependiendo del tipo de evento que se quiera realizar sobre la base de datos
       Ejecuta la cadena misma y otra que inserta el registro en la tabla que lleva el log de las acciones realizadas.
<Excepciones>Error al ejecutar la busqueda. Si la conexion sobre la que se quiere ejecutar la cadena no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function phpmkr_query_externo($strsql,$conn2){ 
if(!get_magic_quotes_gpc()) // SI NO ESTAN ACTIVADAS LAS MAGIC QUOTES DE PHP ESCAPA LA SECUENCIA SQL
    $strsql=stripslashes($strsql);
  $rs=Null;
  if($conn2){ 
  $sqleve="";
  $sql = trim($strsql);
  $sql = str_replace(" =","=",$sql);
  $sql = str_replace("= ","=",$sql);
  $accion = strtoupper(substr($sql,0,strpos($sql,' '))); 
  $llave=0;  
  $tabla = ""; 
  $string_detalle="";
  
  if ($accion<>"SELECT")
   $func = usuario_actual("funcionario_codigo");
  else
    $rs=$conn2->Ejecutar_Sql($strsql);
  $sqleve=""; 
  
 switch($accion)
  {
    case("SELECT"):
      $strsql=htmlspecialchars_decode(htmlentities(utf8_decode($strsql)));
    break;
    /*case("INSERT"):
       $values=substr($strsql,strpos("VALUES",strtoupper($strsql)+6));
       
       $rs=$conn->Ejecutar_Sql(htmlspecialchars_decode(htmlentities(utf8_decode($strsql))));
       
       $llave = $conn->Ultimo_Insert();
      // die("<br />$strsql<br />llave:".$llave);
       preg_match("/insert into (\w*\.)*(\w+)/", strtolower($strsql), $resultados);
       if(isset($resultados[2]))
       $tabla=$resultados[2];
       else
         {preg_match("/insert all into (\w*\.)*(\w+)/", strtolower($strsql), $resultados);
          if(isset($resultados[2]))
            $tabla=$resultados[2];
          else
            break;  
         }
         
       //guardo el evento
       $sqleve="INSERT INTO ".DB.".evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado) VALUES('".$func."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'ADICIONAR', '$tabla', $llave, '0')";  
       //die($sqleve);
       $conn->Ejecutar_Sql($sqleve);
       $registro=$conn->Ultimo_Insert();
      
       if($registro)
       {
       guardar_lob('codigo_sql','evento',"idevento=".$registro,$strsql,'texto',$conn,0);
       $archivo="$registro|||$func|||".date('Y-m-d H:i:s')."|||ADICIONAR|||$tabla|||0|||NULL|||$llave|||$strsql";
       evento_archivo($archivo);
       }
      break; 
    case('UPDATE'):
       preg_match("/update (\w*\.)*(\w+)/", strtolower($strsql), $resultados);
       $tabla=$resultados[2];
       preg_match("/where (.+)=(.*)/", strtolower($strsql), $resultados);
       $llave=trim($resultados[2]);
       $campo_llave=$resultados[1];
       $detalle=busca_filtro_tabla("",$tabla,$campo_llave."=".$llave,"",$conn);
                  
       $rs=$conn->Ejecutar_Sql(htmlspecialchars_decode(htmlentities(utf8_decode($strsql)))); 
       $detalle2=busca_filtro_tabla("",$tabla,$campo_llave."=".$llave,"",$conn);
       //************ miro cuales campos cambiaron en la tabla  ****************
       $nombres_campos=array();
       if($detalle["numcampos"])
          $nombres_campos=array_keys($detalle[0]);
       $cambios=array();
       if($detalle2["numcampos"]&&$detalle["numcampos"])
       {
        for($i=0;$i<(count($detalle[0])/2);$i++)
           {
            if($detalle[0][$i]<>$detalle2[0][$i])
              $cambios[]=$nombres_campos[($i*2)+1]."='".utf8_encode(html_entity_decode(htmlspecialchars_decode($detalle[0][$i])))."'";          
           }
       }    
       $diferencias="update $tabla set ".implode(", ",$cambios)." where ".$campo_llave."=".$llave;    
      
       //guardo el evento
       if(count($cambios))    
          {if(!is_numeric($llave))
              $llave=$detalle[0]["id".$tabla];
           $sqleve="INSERT INTO ".DB.".evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado) VALUES('".$func."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'MODIFICAR', '$tabla', ".intval($llave).", '0')"; 

           $conn->Ejecutar_Sql($sqleve);

           $registro=$conn->Ultimo_Insert();
           //die("registro:$registro");
           if($registro)
           {
            guardar_lob('codigo_sql','evento',"idevento=".$registro,$strsql,'texto',$conn,0);
            guardar_lob('detalle','evento',"idevento=".$registro,$diferencias,'texto',$conn,0);
            $archivo="$registro|||$func|||".date('Y-m-d H:i:s')."|||MODIFICAR|||$tabla|||0|||$diferencias|||$llave|||$strsql";
            evento_archivo($archivo);
           }
          }            
      break;  
    case('DELETE'):
       preg_match("/delete from (\w*\.)*(\w+)/", strtolower($strsql), $resultados);
       $tabla=$resultados[2];
       preg_match("/where (.+)=(.*)/", strtolower($strsql), $resultados);
       $llave=trim($resultados[2]);
       $campo_llave=$resultados[1];
       $detalle=busca_filtro_tabla("",$tabla,$campo_llave."=".$llave,"",$conn);
       $rs=$conn->Ejecutar_Sql(htmlspecialchars_decode(htmlentities(utf8_decode($strsql)))); 
       
       if($detalle["numcampos"]>0)
         {$nombres_campos=array_keys($detalle[0]);
          $datos1=array();
          $datos2=array();
          for($i=0;$i<(count($detalle[0])/2);$i++)
             {
              if($detalle[0][$i]<>$detalle2[0][$i])
                {$datos1[]=$nombres_campos[($i*2)+1];
                 $datos2[]="'".utf8_encode(html_entity_decode(htmlspecialchars_decode($detalle[0][$i])))."'";     
                }     
             }         
          $string_detalle="insert into $tabla(".implode(",",$datos1).") values(".implode(",",$datos2).")";
          
          $sqleve="INSERT INTO ".DB.".evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado) VALUES('".$func."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'ELIMINAR', '$tabla', $llave, '0')";
          $conn->Ejecutar_Sql($sqleve);
          $registro=$conn->Ultimo_Insert();
          if($registro)
          {
           guardar_lob('codigo_sql','evento',"idevento=".$registro,$strsql,'texto',$conn,0);
           guardar_lob('detalle','evento',"idevento=".$registro,$string_detalle,'texto',$conn,0);
           $archivo="$registro|||$func|||".date('Y-m-d H:i:s')."|||ELIMINAR|||$tabla|||0|||$string_detalle|||$llave|||$strsql";
           evento_archivo($archivo);
          } 
         }    
     break; 
   default:
   $rs=$conn->Ejecutar_Sql($strsql);
   break;  */ 
  }  
  if ($accion<>"SELECT") 
    phpmkr_free_result_externo($rs);
   return $rs; 
  }
}
/*
<Clase>
<Nombre>phpmkr_num_fields
<Parametros>$rs puntero que contiene el resultado de una consulta
<Responsabilidades>Retornar el numero de columnas que contiene $rs
<Notas>
<Excepciones>Error en el numero de campos, Si la conexion con la base de datos no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function phpmkr_num_fields_externo($rs,$conn2){ 
 return($conn2->Numero_Campos($rs));
}

/*
<Clase>
<Nombre>phpmkr_field_type
<Parametros>$rs: resultado de la consulta, $pos: posicion de la columna
<Responsabilidades>Retorna el tipo de campo de la columna $pos en $rs
<Notas>
<Excepciones>Tipos de campo. Si la conexion con la base de dats no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function phpmkr_field_type_externo($rs,$pos,$conn2){ 
 return($conn2->Tipo_Campo($rs,$pos));
}

/*
<Clase>
<Nombre>phpmkr_field_name
<Parametros>$rs: objeto que contiene la consulta, $pos: posicion de la consulta
<Responsabilidades>Retornar el nombre de la columna $pos en la busqueda $rs
<Notas>
<Excepciones>Error en nombre del campo. Si en la conexion con la base de datos no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/

function phpmkr_field_name_externo($rs,$pos,$conn2){ 
 return($conn2->Nombre_Campo($rs,$pos));
}

/*
<Clase>
<Nombre>phpmkr_num_rows
<Parametros>$rs: objeto que contiene la consulta
<Responsabilidades>Retornar el numero de filas de la consulta
<Notas>Esta funcion no esta disponible por el momento para Oracle
<Excepciones>Error en numero de filas. Si la conexion con la base datos no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/

function phpmkr_num_rows_externo($rs,$conn2){
    if($conn2){
      if(!$rs&&$conn2->res)
       $rs = $conn2->res;
     return $conn2->Numero_Filas($rs);
    } 
  else{
     alerta("Error en numero de filas.".$rs->sql);
     return FALSE;
  }      
}

/*
<Clase>
<Nombre>phpmkr_fetch_array
<Parametros>$rs: objeto que contiene la consulta
<Responsabilidades> Retornar un arreglo que contiene la siguiente fila de $rs
<Notas>
<Excepciones>Error en capturar resultado en arreglo. Si la conexion con la base de datos no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function phpmkr_fetch_array_externo($rs,$conn2){
    if($conn2){
      if(!$rs&&$conn2->res)
       $rs = $conn2->res;
       $retorno=$conn2->sacar_fila($rs);
     return $retorno;
    } 
  else{
     alerta("Error en capturar resultado en arreglo.".$rs->sql);
     return FALSE;
  }      
}

/*
<Clase>
<Nombre>phpmkr_fetch_row
<Parametros>$rs: objeto que contiene la consulta
<Responsabilidades>Retonar la siguiente fila de $rs en un arreglo
<Notas>pmpmkr_fetch_row y phpmkr_fetch_array hacen exactamente lo mismo
<Excepciones>Error en capturar el resultado del arreglo, si la conexion con la base de datos no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/

function phpmkr_fetch_row_externo($rs,$conn2){
    if($conn2){
      if(!$rs&&$conn2->res)
       $rs = $conn2->res;
       $retorno=$conn2->sacar_fila($rs);
     return $retorno;
    } 
  else{
     alerta("Error en capturar resultado en arreglo.".$rs->sql);
     return FALSE;
  }      

}

/*
<Clase>
<Nombre>phpmkr_free_result
<Parametros>$rs: objeto que contiene la consulta
<Responsabilidades>libera el objeto $rs
<Notas>
<Excepciones>Error al liberar el resultado, si la conexion con la base de datos no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function phpmkr_free_result_externo($rs,$conn2){
 if($conn2->motor=="MySql")
      @mysqli_free_result($conn2->res);
 else if($conn2->motor=="Oracle")
    @OCIFreeStatement($conn2->res);   
}

/*
<Clase>
<Nombre>phpmkr_insert_id
<Parametros>
<Responsabilidades>retonar la llave primaria del ultimo registro insertado
<Notas>
<Excepciones>Error al buscar la ultima insercion. Si no existe la conexion con la base de datos
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
/*function phpmkr_insert_id_externo($conn2){
  if($conn2){
    $evento = $conn2->ultimo_insert;
    $buscar = busca_filtro_tabla("*",DB.".evento","idevento=".$evento,"",$conn2);
    return $buscar[0]["registro_id"];
  }
  else{
     alerta("Error al buscar la ultima insercion.".$rs->sql);
     return FALSE;
  }      
} */

/*
<Clase>
<Nombre>phpmkr_error
<Parametros>
<Responsabilidades>invoca la funcion error de la clase sql
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function phpmkr_error_externo($conn2){
 if($conn2->motor=="MySql")
     {if($conn2->error<>"")
      echo  ($conn2->error." en \"".$conn2->consulta."\"");
     }
 else if($conn2->motor=="Oracle")
  {if($conn2->error<>"")
      echo  ($conn2->error["message"]." en \"".$conn2->consulta."\"");   
  } 
}


/*
<Clase>
<Nombre>busca_filtro_tabla
<Parametros>$campos: columnas que se van a seleccionar
            $tabla: Tabla(s) desde la(s) que se va a seleccionar los datos
            $filtro: where de la consulta
            $orden: columna por la que se ordenaran los datos
<Responsabilidades>Invocar la busqueda a la base de datos y retornar el resultado de la misma en un arreglo
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function busca_filtro_tabla_externo($campos,$tabla,$filtro,$orden,$conn2){
  if(!$conn2){
    $conn2=phpmkr_db_connect();
  }
  $retorno=array();
  $temp=array();
  $retorno["tabla"]=$tabla;
  $sql="Select ";
  if($campos)
    $sql.=$campos;
  else $sql.="*";
  if($tabla)      
    $sql.=" FROM ".$tabla;

  if($filtro)
    $sql.=" WHERE ".str_replace('"',"'",$filtro);
  if($orden){
    if(substr($orden,0,5)=="GROUP")
      $sql.=" ".$orden;
    else  
      $sql.=" ORDER BY ".$orden;
  }
  $sql=htmlspecialchars_decode(htmlentities(utf8_decode($sql)));
  $rs=$conn2->Ejecutar_Sql($sql);
  $temp=phpmkr_fetch_array_externo($rs,$conn2);
  $retorno["sql"]=$sql;
  for($i=0;$temp;$temp=phpmkr_fetch_array_externo($rs,$conn2),$i++)
    array_push($retorno,$temp);
  $retorno["numcampos"]=$i;  
  phpmkr_free_result_externo($rs,$conn2);
  return($retorno);
}
/*
<Clase>
<Nombre>busca_filtro_tabla_limit
<Parametros>$campos: columnas que se van a seleccionar
            $tabla: Tabla(s) desde la(s) que se va a seleccionar los datos
            $filtro: where de la consulta
            $orden: columna por la que se ordenaran los datos
<Responsabilidades>Invocar la busqueda a la base de datos y retornar el resultado de la misma en un arreglo
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function busca_filtro_tabla_limit_externo($campos,$tabla,$filtro,$orden,$inicio,$registros,$conn2){
  if(!$conn2){
    $conn2=phpmkr_db_connect();
  }
  $retorno=array();
  $temp=array();
  $retorno["tabla"]=$tabla;
  $sql="Select ";
  if($campos)
    $sql.=$campos;
  else $sql.="*";
  if($tabla)
    $sql.=" FROM ".$tabla;

  if($filtro)
    $sql.=" WHERE ".str_replace('"',"'",$filtro);
  if($orden){ 
      $sql.=$orden;
  }
  $sql=htmlspecialchars_decode(htmlentities(utf8_decode($sql)));
  $rs=$conn2->Ejecutar_Limit($sql,$inicio,($inicio+$registros),$conn2);  
  $temp=phpmkr_fetch_array_externo($rs,$conn2);

  $retorno["sql"]=$sql;
  
  for($i=0;$temp;$temp=phpmkr_fetch_array_externo($rs,$conn2),$i++)
    array_push($retorno,$temp);
  $retorno["numcampos"]=$i;  
  phpmkr_free_result_externo($rs,$conn2);
  return($retorno);
}

function ejecuta_filtro_tabla_externo($sql2,$conn2){
  $retorno=array();
  $rs=$conn2->Ejecutar_Sql($sql2) or alerta("Error en Bsqueda de Proceso SQL: $sql2");
  $temp=phpmkr_fetch_array_externo($rs,$conn2);
  $i=0;
  if($temp){
    array_push($retorno,$temp); 
    $i++;
  }  
  for($temp;$temp=phpmkr_fetch_array_externo($rs,$conn2);$i++)
   array_push($retorno,$temp );
  $retorno["numcampos"]=$i; 
  phpmkr_free_result($rs,$conn2);
  return ($retorno);
}
/*
<Clase>
<Nombre>evento
<Parametros>$tabla: Tabla sobre la que se realiza el evento
            $accion: Tipo de evento que se realiza
            $sql: sentencia que se ejecut?
            $llave: llave primaria del registro sobre el que se realiza la accion
<Responsabilidades>llevar a cabo la accion y registrar el evento en el log
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
/*function evento($tabla,$evento,$strsql,$llave)
{ global $conn;
  $sql = trim($strsql);
  $sql = str_replace('','',$sql);
  $accion = strtoupper(substr($sql,0,strpos($sql,' ')));    
  $tabla = ""; 
  $llave=0; $string_detalle="";
  if ($accion<>"SELECT")
   $func = usuario_actual("funcionario_codigo");
   //echo $strsql;   
  $strsql=htmlspecialchars_decode(htmlentities(utf8_decode($strsql)));
  //echo "<br />".$strsql;    
  $rs = $conn->Ejecutar_Sql_Noresult($strsql);
    return $rs;
}  */

/*
<Clase>
<Nombre>ejecuta_sql
<Parametros>$sql: sentencia que se ejecuta, $con: conexion sobre la que se ejecutar?la sentencia
<Responsabilidades>Ejecuta una sentencia insert y retorna la llave de lo que acaba de insertar
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
/*function ejecuta_sql($sql,$conn2){
phpmkr_query_externo($sql,$conn2);
$id=phpmkr_insert_id();
if($id>0){ 
  return($id);
} 
else
  return false;  
phpmkr_free_result();      
}
*/
/*
<Clase>
<Nombre>ejecuta_filtro
<Parametros>$sql: sentencia que se ejecuta, $con: conexion sobre la que se ejecutar?la sentencia
<Responsabilidades>Ejecuta una sentencia insert y retorna la llave de lo que acaba de insertar
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function ejecuta_filtro_externo($sql1,$conn2){
global $sql;
$sql=$sql1;
$rs=@phpmkr_query($sql,$conn2);
$resultado["numcampos"]=@phpmkr_num_rows($rs,$conn2);
if($resultado["numcampos"]){
  $resultado=@phpmkr_fetch_array($rs,$conn2);
  $resultado["numcampos"]=@phpmkr_num_rows($rs,$conn2);
}   
return($resultado);
}
/*
<Clase>
<Nombre>fecha_db 
<Parametros> $formato : formato de la fecha a obtener en fromato tipo PHP; 
<Responsabilidades> Retornar la cadena adecuada dependiendo del motor para las consultas 
de tipo select
<Notas>
<Excepciones>
<Salida>cadena lista para compementar las secuecias  ejem  TO_CHAR(fecha_ini,'DD-MM-YYYY')
<Pre-condiciones>
<Post-condiciones>
*/ 
function fecha_db_externo($conn2,$campo,$formato = NULL){ 
if(!$formato)
  $formato="Y-m-d";  // formato por defecto php
if($conn2->motor=="Oracle"){   
  $reemplazos=array('d'=>'DD','m'=>'MM','y'=>'YY','Y'=>'YYYY','h'=>'HH','H'=>'HH24','i'=>'MI','s'=>'SS','M'=>'MON','yyyy'=>'YYYY'  );
  $resfecha=$formato;
  foreach ($reemplazos as $ph => $mot){ 
    $resfecha=ereg_replace("^$ph([-/:])", "$mot\\1", $resfecha);
    $resfecha=ereg_replace("( )$ph([-/:])", "\\1$mot\\2", $resfecha);
    $resfecha=ereg_replace("^$ph", "$mot", $resfecha);
    $resfecha=ereg_replace("([-/:])$ph([-/:])", "\\1$mot\\2", $resfecha);
    $resfecha=ereg_replace("([-/:])$ph$", "\\1$mot", $resfecha);
    $resfecha=ereg_replace("$ph( )", "$mot\\1", $resfecha); // espacio entre fecha y hora            
  }          
} 
elseif($conn2->motor=="MySql"){        
  $reemplazos=array('d'=>'%d','m'=>'%m','y'=>'%y','Y'=>'%Y','h'=>'%h','H'=>'%H','i'=>'%i','s'=>'%s','M'=>'%b','yyyy'=>'%Y');
  $resfecha=$formato;
  foreach ($reemplazos as $ph => $mot){ 
    $resfecha=ereg_replace("^$ph([-/:])", "$mot\\1", $resfecha);
    $resfecha=ereg_replace("( )$ph([-/:])", "\\1$mot\\2", $resfecha);
    $resfecha=ereg_replace("^$ph", "$mot", $resfecha);
    $resfecha=ereg_replace("([-/:])$ph([-/:])", "\\1$mot\\2", $resfecha);
    $resfecha=ereg_replace("([-/:])$ph$", "\\1$mot", $resfecha);
    $resfecha=ereg_replace("$ph( )", "$mot\\1", $resfecha); // espacio entre fecha y hora
  } 
  $fsql="DATE_FORMAT($campo,'$resfecha')";
}
return $fsql;       
} // Fin Funcion fecha_db_obtener
/*
<Clase>
<Nombre>fecha_db_obtener
<Parametros> campo : Campo de la tabla con la fecha a obrener; $formato : formato de la fecha a obtener en fromato tipo PHP; 
<Responsabilidades> Retornar la cadena adecuada dependiendo del motor para las consultas 
de tipo select
<Notas>
<Excepciones>
<Salida>cadena lista para compementar las secuecias  ejem  TO_CHAR(fecha_ini,'DD-MM-YYYY')
<Pre-condiciones>
<Post-condiciones>
*/
 
function fecha_db_obtener_externo( $conn2, $campo, $formato = NULL){ 
if(!$formato)
  $formato="Y-m-d";  // formato por defecto php
if($conn2->motor=="Oracle"){   
  $reemplazos=array('Y'=>'YYYY','yyyy'=>'YYYY','d'=>'DD','M'=>'MON','m'=>'MM','y'=>'YY','H'=>'HH24','h'=>'HH','i'=>'MI','s'=>'SS'  );
  $resfecha=$formato;
  foreach ($reemplazos as $ph => $mot){
    $resfecha=ereg_replace("$ph", "$mot", $resfecha);
  } 
  $fsql="TO_CHAR($campo,'$resfecha')";     
} 
elseif($conn2->motor=="MySql"){  
  $reemplazos=array('d'=>'%d','m'=>'%m','y'=>'%y','Y'=>'%Y','h'=>'%h','H'=>'%H','i'=>'%i','s'=>'%s','M'=>'%b','yyyy'=>'%Y');
  $resfecha=$formato;
  foreach ($reemplazos as $ph => $mot){ 
    $resfecha=ereg_replace("^$ph([-/:])", "$mot\\1", $resfecha);
    $resfecha=ereg_replace("( )$ph([-/:])", "\\1$mot\\2", $resfecha);
    $resfecha=ereg_replace("^$ph", "$mot", $resfecha);
    $resfecha=ereg_replace("([-/:])$ph([-/:])", "\\1$mot\\2", $resfecha);
    $resfecha=ereg_replace("([-/:])$ph$", "\\1$mot", $resfecha);
    $resfecha=ereg_replace("$ph( )", "$mot\\1", $resfecha); // espacio entre fecha y hora
  } 
  $fsql="DATE_FORMAT($campo,'$resfecha')";
}
return $fsql;       
} // Fin Funcion fecha_db_obtener
/*
<Clase>
<Nombre>fecha_db_almacenar
<Parametros> fecha : fecha a almacenar conxsecuente al fromato; $formato : formato de la fecha a almacenar tipo PHP; 
<Responsabilidades> Retornar la cadena adecuada dependiendo del motor para las consultas 
de tipo select
<Notas>
<Excepciones>
<Salida>cadena lista para insertar en la BD
<Pre-condiciones>
<Post-condiciones>
*/
function fecha_db_almacenar_externo($conn2, $fecha, $formato = NULL){ 
  if(!$fecha || $fecha==""){
    $fecha=date($formato);
  }
  if(!$formato)
        $formato="Y-m-d";  // formato por defecto php
  
  if($conn2->motor=="Oracle")
    {   
         $reemplazos=array('d'=>'DD','m'=>'MM','y'=>'YY','Y'=>'YYYY','h'=>'HH','H'=>'HH24','i'=>'MI','s'=>'SS','M'=>'MON','yyyy'=>'YYYY'  );
         $resfecha=$formato;
         foreach ($reemplazos as $ph => $mot)
          { // echo $ph," = ",$mot,"<br>","^$ph([-/:])", "%Y\\1","<br>";
            $resfecha=ereg_replace("^$ph([-/:])", "$mot\\1", $resfecha);
            $resfecha=ereg_replace("( )$ph([-/:])", "\\1$mot\\2", $resfecha);
            $resfecha=ereg_replace("([-/:])$ph([-/:])", "\\1$mot\\2", $resfecha);
            $resfecha=ereg_replace("([-/:])$ph$", "\\1$mot", $resfecha);
            $resfecha=ereg_replace("$ph( )", "$mot\\1", $resfecha); // espacio entre fecha y hora
          }                     
        $fsql="TO_DATE('$fecha','$resfecha')";      
     } 
    elseif($conn2->motor=="MySql"){
            $reemplazos=array('d'=>'%d','m'=>'%m','y'=>'%y','Y'=>'%Y','h'=>'%H','H'=>'%H','i'=>'%i','s'=>'%s','M'=>'%b','yyyy'=>'%Y'  );
            $resfecha=$formato;
             foreach ($reemplazos as $ph => $mot)
             { // echo $ph," = ",$mot,"<br>","^$ph([-/:])", "%Y\\1","<br>";
                $resfecha=ereg_replace("^$ph([-/:])", "$mot\\1", $resfecha);
                $resfecha=ereg_replace("( )$ph([-/:])", "\\1$mot\\2", $resfecha);
                $resfecha=ereg_replace("([-/:])$ph([-/:])", "\\1$mot\\2", $resfecha);
                $resfecha=ereg_replace("([-/:])$ph$", "\\1$mot", $resfecha);
                $resfecha=ereg_replace("$ph( )", "$mot\\1", $resfecha); // espacio entre fecha y hora
             }                   
            $fsql="DATE_FORMAT('$fecha','$resfecha')";          
         }
         return $fsql;      
} // Fin Funcion fecha_db_almacenar
 
 function suma_fechas_externo($conn2,$fecha1,$cantidad,$tipo="") {
   if($conn2->motor=="Oracle")
   {if($tipo=="" || $tipo=="DAY")
        return "$fecha1+$cantidad"; 
    else if($tipo=="MONTH")
        return "ADD_MONTHS($fecha1,$cantidad)"; 
    else if($tipo=="YEAR")
        return "ADD_MONTHS($fecha1,$cantidad*12)"; 
   }
  elseif($conn2->motor=="MySql"){ 
    if($tipo=="")
      $tipo='DAY';    
     return "DATE_ADD($fecha1, INTERVAL $cantidad $tipo)";
   }   
 } 
 function resta_fechas_externo($conn2,$fecha1,$fecha2)
 {
   if($conn2->motor=="Oracle")
   {if($fecha2 == "")
     $fecha2= "sysdate";    
    return "$fecha1-$fecha2 ";   
   }
  elseif($conn2->motor=="MySql")   
   { if($fecha2 == "")
     $fecha2= "CURDATE()";       
     return "DATEDIFF($fecha1,$fecha2)";
   }   
 }
?>

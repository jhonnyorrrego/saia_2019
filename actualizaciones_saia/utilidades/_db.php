<?php
require_once("../../define.php");
require_once("../../conexion.php");
require_once("../../sql.php");
$JABBER=Null;
if(!isset($_SESSION["LOGIN".LLAVE_SAIA])){
  @session_start();
  @ob_start();
}   
//print_r(session_id());
$error=array();
$dat_orig=0;
$sql="";
$vigencia="2007";
$tablespace="SAIA";
$conn=NULL;
$conn=phpmkr_db_connect();

//$_SESSION['EDITA']=1;
$key=1;
 
$usuactual=@$_SESSION["LOGIN".LLAVE_SAIA];

if(isset($_SESSION["LOGIN".LLAVE_SAIA])&&$_SESSION["LOGIN".LLAVE_SAIA] && !@$_SESSION["conexion_remota"]){
$_SESSION["usuario_actual"]=usuario_actual("funcionario_codigo");      
//Almacenar la variable del usuario actual
$usuactual=@$_SESSION["LOGIN".LLAVE_SAIA];
}
/*
<Clase>
<Nombre>registrar_accion_digitalizacion
<Parametros>$iddoc:id del documento;$accion:accion ejecutada;$justificacion: descripcion que se llena cuando se borra una pagina
<Responsabilidades>crea un registro de cierta accion sobre cierto documento en la tabla digitalizacion
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function registrar_accion_digitalizacion($iddoc,$accion,$justificacion='')
{global $conn;
 $usu=usuario_actual("funcionario_codigo");
 $fecha=fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s');
 $sql="insert into ".DB.".digitalizacion(funcionario,documento_iddocumento,accion,justificacion,fecha) values('$usu','$iddoc','$accion','$justificacion',$fecha)" ;
 phpmkr_query($sql,$conn);
}
//me dice cual es la ruta del archivo recibido, partiendo desde la posicion actual
function compara_ruta_archivos($buscado)
{$info= pathinfo($_SERVER["PHP_SELF"]);
 $uno=explode("/",$info["dirname"]);
 $dos=explode("/",$buscado);
 $igual=array();
 if(count($uno)>count($dos))
    $j=count($dos);
 else 
    $j=count($uno);
 $espacios=0;
 for($i=1;$i<$j;$i++)
   {if($uno[$i]==$dos[$i])
      {$igual[]=$uno[$i];
      }
   }   
 $igual=implode("/",$igual);  
 $nueva_actual=str_replace("/".$igual,"",$info["dirname"]);
 $nueva_buscada=str_replace("/".$igual."/","",$buscado);
 $distanciauno=count(explode("/",$nueva_actual));
 for($i=1;$i<$distanciauno;$i++)
     $ruta="../".$ruta;
 $ruta=str_replace("//","/",$ruta.$nueva_buscada);
 return($ruta);
}
/*
<Clase>
<Nombre>mayusculas
<Parametros>$texto-cadena que deseo pasar a mayusculas
<Responsabilidades>convierte una cadena de texto a mayusculas
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function mayusculas($texto)
{$texto_nuevo=strtoupper($texto);
 $texto_nuevo=str_replace("ACUTE;","acute;",$texto_nuevo);
 $texto_nuevo=str_replace("TILDE;","tilde;",$texto_nuevo);
 $texto_nuevo=str_replace("&IQUEST;","&iquest;",$texto_nuevo);
 $texto_nuevo=str_replace("UML;","uml;",$texto_nuevo);
 return($texto_nuevo);
}

function leido($codigo,$llave){
global $conn;
$pendiente = busca_filtro_tabla(fecha_db_obtener("fecha_inicial","Y-m-d H:i:s")." as fecha_inicial","asignacion","documento_iddocumento=".$llave." and llave_entidad=".$codigo,"fecha_inicial DESC",$conn);
//print_r($pendiente);
 if($pendiente["numcampos"]>0)
{ 
 $leido = busca_filtro_tabla("nombre,idtransferencia","buzon_salida","archivo_idarchivo='$llave' and destino='$codigo' and nombre='LEIDO' AND fecha >= ".fecha_db_almacenar($pendiente[0]["fecha_inicial"],"Y-m-d H:i:s"),"",$conn);
//print_r($leido);  
 if(!$leido["numcampos"])
 {
    $insertar="insert into ".DB.".buzon_salida(archivo_idarchivo,nombre,fecha,origen,tipo_origen,destino,tipo_destino,tipo)";
    $insertar.=" values(".$llave.",'LEIDO',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",$codigo,1,$codigo,1,'DOCUMENTO')";
    //echo $insertar."<br /><br />";
    phpmkr_query($insertar, $conn) or error("Fallo la busqueda" . phpmkr_error() . ' SQL buzon_salida:' . $insertar);  
               
    $insertar="insert into ".DB.".buzon_entrada(archivo_idarchivo,nombre,fecha,origen,tipo_origen,destino,tipo_destino,tipo)";
    $insertar.=" values(".$llave.",'LEIDO',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",$codigo,1,".$codigo.",1,'DOCUMENTO')";
    //echo $insertar."<br /><br />";
    phpmkr_query($insertar, $conn) or error("Fallo la busqueda" . phpmkr_error() . ' SQL buzon_entrada:' . $insertar);
   }
 }

}
/*function limpia_td($td)
{
 if(strpos($td[1],"border: windowtext 0.5pt solid")===FALSE)
    {$pat="/[a-zA-Z]*=\".*?\"/";
     preg_match_all($pat, $td[0], $coincidencias, PREG_OFFSET_CAPTURE);
   //  print_r($coincidencias);
     $reemplazo=array(0=>"style=\" border: windowtext 0.5pt solid; ");
     $cerrado=0;
     for($i=0;$i<count($coincidencias[0]);$i++)
        {if(strpos($coincidencias[0][$i][0],"style")===FALSE)
           $reemplazo[]=$coincidencias[0][$i][0];
         else
           {$parametros=explode('"',$coincidencias[0][$i][0]);
            $parametros=explode(';',$parametros[1]);
            for($j=0;$j<count($parametros);$j++)
               {if(strpos($parametros[$j],"border")==false)
                  $vector[]=$parametros[$j];
               }
            $reemplazo[0].=implode(";",$vector)."\" ";
            $cerrado=1;
           }  
        }
     if($cerrado==0)   
        $reemplazo[0].="\" ";
     $td="<td ".implode(" ",$reemplazo).">";
     return($td);
    }
 else return ("<td ".$td[1].">");
}
*/
function limpia_tabla($tabla)
{ $max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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

 include_once($ruta_db_superior."kses-0.2.3/kses.php");

 $allowed = array('table' => array('cellpadding' => 1, 
                                   'cellspacing' => 1, 
                                   'border' => 1,
                                   'align' => 1, 
                                   'width' => 1,
                                   'height' => 1,
                                   'style' => 1),
                   'tr' => array('width' => 1,
                                 'height' => 1),
                   'td' => array('valign' => 1, 
                                 'align' => 1, 
                                 'rowspan' => 1, 
                                 'colspan' => 1,
                                 'width' => 1,
                                 'height' => 1,
                                 'class'=>array('maxlen' => 100),
                                 'style'=>array()
                                ),
                   'p'=>array('style'=>array('maxlen' => 100)),
                   'span'=>array('style'=>array('maxlen' => 100)),
                   'ul'=>array(),
                   'ol'=>array(),
                   'li'=>array('style'=>array('maxlen' => 100)),
                   'img'=>array('src'=>1, 'alt'=>1),
                   'br'=>array(),   
                   'b'=>array(),  
                   'em'=>array(),          
                   'hr'=>array(),
                   'pagebreak'=>array(),
                   'strong' => array()
                  );
                             
$tabla=stripslashes($tabla);
$tabla=kses($tabla, $allowed);
return($tabla);
}


function listar_campos_tabla($tabla=NULL)
  {global $conn;
   if($tabla==NULL)
      $tabla=$_REQUEST["tabla"];
   if(MOTOR=="MySql"){
      $datos_tabla=$conn->Ejecutar_Sql("DESCRIBE ".$tabla);

    }
    else if(MOTOR=="Oracle"){
      $datos_tabla=$conn->Ejecutar_Sql("SELECT column_name  Field, data_type Type, nullable Null_, data_default Default_ FROM user_tab_columns WHERE table_name='".strtoupper($tabla)."' ORDER BY column_name ASC");
    }
   
   $lista_campos=array();
   while($fila=phpmkr_fetch_array($datos_tabla))
      {
       $lista_campos[]=$fila[0];
      }
   return($lista_campos);   
  }  /*
function listar_campos_tabla($tabla=NULL)
  {global $conn;
   if($tabla==NULL)
      $tabla=$_REQUEST["tabla"];
   if(MOTOR=="MySql"){
      $datos_tabla=phpmkr_query("DESCRIBE ".$tabla,$conn);

    }
    else if(MOTOR=="Oracle"){
      $datos_tabla=phpmkr_query("SELECT column_name AS Field FROM user_tab_columns WHERE table_name='".strtoupper($tabla)."' ORDER BY column_name ASC",$conn);
    }
  
   $lista_campos=array();
   for($i=0;$i<=phpmkr_num_fields($datos_tabla);$i++)
      {$fila=phpmkr_fetch_array($datos_tabla);
       $lista_campos[]=$fila[0];
      }
   return($lista_campos);   
  }  */
function guardar_lob($campo,$tabla,$condicion,$contenido,$tipo,$conn,$log=1)
{ 
  $resultado=TRUE;
  
  if(MOTOR=="Oracle")
    {$sql = "SELECT
           $campo
        FROM
           ".DB.".$tabla
        WHERE
           $condicion
        FOR UPDATE ";

      $stmt = oci_parse($conn->Conn->conn, $sql);
      // Execute the statement using OCI_DEFAULT (begin a transaction)
      oci_execute($stmt, OCI_DEFAULT) or print_r(OCIError ($stmt));
      
      // Fetch the SELECTed row
      if ( FALSE === ($row = oci_fetch_assoc($stmt) ) ) 
        {
         oci_rollback($conn->Conn->conn);
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
                  oci_rollback($conn->Conn->conn);
                  alerta("No se pudo modificar el campo.");
                  $resultado=FALSE;
                }
            else    
               {$contenido=limpia_tabla($contenido);
                if ( !$row[strtoupper($campo)]->save(trim(htmlentities(utf8_decode($contenido))))) 
                  {  oci_rollback($conn->Conn->conn);
                     $resultado=FALSE;
                  }
                else 
                  oci_commit($conn->Conn->conn);  
                //*********** guardo el log en la base de datos **********************
                preg_match("/.*=(.*)/", strtolower($condicion), $resultados);
                $llave=trim($resultados[1]);

                if($log)
                  {$sqleve="INSERT INTO ".DB.".evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado) VALUES('".usuario_actual("funcionario_codigo")."',to_date('".date('Y-m-d H:i:s')."','YYYY-MM-DD HH24:MI:SS') ,'MODIFICAR', '$tabla', $llave, '0')";
                  
                   $conn->Ejecutar_Sql($sqleve);
                   $registro=$conn->Ultimo_Insert();
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
                   guardar_lob('codigo_sql','evento',"idevento=".$registro,$texto_sig,'texto',$conn,0);
                   guardar_lob('detalle','evento',"idevento=".$registro,$texto_ant,'texto',$conn,0);
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
              oci_rollback($conn->Conn->conn);
              alerta("No se pudo modificar el campo.");
              $resultado=FALSE;
            }
         if ( !$row[strtoupper($campo)]->save($contenido)) 
           { oci_rollback($conn->Conn->conn);
            alerta("No se pudo modificar el campo.");
             $resultado=FALSE;
           }  
         else 
           oci_commit($conn->Conn->conn);  
  
        }      
      oci_free_statement($stmt);
      $row[strtoupper($campo)]->free();
     } 
    }
 if(MOTOR=="MySql")
    {if($tipo=="archivo")
       {$sql="update $tabla set $campo='".addslashes($contenido)."' where $condicion";
        mysqli_query($conn->Conn->conn, $sql);
        // TODO verificar resultado de la insecion $resultado=FALSE; 
       }
     elseif($tipo=="texto")
        {$contenido=utf8_encode(limpia_tabla($contenido));
         $sql="update $tabla set $campo='".addslashes(stripslashes($contenido))."' where $condicion";
        if($log)
            {preg_match("/.*=(.*)/", strtolower($condicion), $resultados);
             $llave=trim($resultados[1]);
             $anterior=busca_filtro_tabla("$campo","$tabla","$condicion","",$conn);
             $sql_anterior="update $tabla set $campo='".addslashes(stripslashes($anterior[0][0]))."' where $condicion";

             $sqleve="INSERT INTO ".DB.".evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado,detalle,codigo_sql) VALUES('".usuario_actual("funcionario_codigo")."','".date('Y-m-d H:i:s')."','MODIFICAR', '$tabla', $llave, '0','".addslashes($sql_anterior)."','".addslashes($sql)."')"; 
             $conn->Ejecutar_Sql($sqleve);
             $registro=$conn->Ultimo_Insert();
             if($registro)
               {
                $archivo="$registro|||".usuario_actual("funcionario_codigo")."|||".date('Y-m-d H:i:s')."|||MODIFICAR|||$tabla|||0|||".addslashes($sql_anterior)."|||$llave|||".addslashes($sql);
                evento_archivo($archivo);
               }
            }         
         mysqli_query($conn->Conn->conn, $sql) or die(mysqli_error($conn->Conn->conn));
        }
    }
 return($resultado);   
}
function evento_archivo($cadena)
{global $conn;
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
$nombre="$ruta_db_superior../evento/".DB."_log_".date("Y_m_d").".txt";
/* if(dirname($_SERVER["PHP_SELF"])=="/".RUTA_SCRIPT)
    $nombre="../evento/".DB."_log_".date("Y_m_d").".txt";
 else
    {$prof=substr_count(str_replace("/".RUTA_SCRIPT."/","",$_SERVER["PHP_SELF"]),'/');
     $nombre=str_repeat("../",$prof+1)."evento/".DB."_log_".date("Y_m_d").".txt";
    }*/
 $contenido="";
 if(is_file($nombre))
    {$link=fopen($nombre,"ab");
     $contenido=$cadena."*|*";
    }
 else
    {$link=fopen($nombre,"wb");
     $contenido="idevento|||funcionario_codigo|||fecha|||evento|||tabla_e|||estado|||detalle|||registro_id|||codigo_sql*|*".$cadena."*|*";
    }
 fwrite($link,$contenido);
 fclose($link);

}
/*
<Clase>
<Nombre>sesion
<Parametros>
<Responsabilidades>Definir los encabezados para la aplicacion a lo largo de la sesion
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function formato_cargo($nombre_cargo)
{
$cargo="";
$pal = split(" ",strtolower($nombre_cargo));
for($i=0; $i<count($pal); $i++)
{
if($pal[$i]=="del" || $pal[$i]=="de" || $pal[$i]=="y" || $pal[$i]=="en" || $pal[$i]=="al" || $pal[$i]=="los" || $pal[$i]=="a")
$cargo.=$pal[$i]." ";
else if($pal[$i]=="ii" || $pal[$i]=="iii" || $pal[$i]=="iv" || $pal[$i]=="vi" || $pal[$i]=="vii" || $pal[$i]=="ix" || $pal[$i]=="viii")
$cargo.=strtoupper($pal[$i])." ";
else
{
$tilde = array("+�","+�","+�","+�","+�","+�");
$reemplazo = array("{+�", "+�", "+�","+�","+�","+�");
$pal[$i]= str_replace($tilde, $reemplazo, $pal[$i]);
$cargo.= ucwords($pal[$i])."&nbsp;";
}


}
return ($cargo);
}


/*
<Clase>
<Nombre>phpmkr_db_connect
<Parametros>$HOST: Equipo en el que se encuentra la base de datos
            $USER: nombre del usuario con el cual se realizar�+�la conexi�+�
            $PASS: contrase�+� del usuario
            $DB: Nombre de la base de datos, o del esquema
            $MOTOR: Motor con el que se realiza la conexion, Oracle o MySql
<Responsabilidades> Establecer una conexi�+� entre la base de datos y la aplicacion
<Notas> Hace uso de las clases SQL y conexion, retornando el objeto SQL inicializado,
        con el cual se pueden ejecutar los queries en la base de datos.
<Excepciones>Error al conectarse con la Base de datos, se debe a que no se encuentra disponible o existe algun error en los par�+�etros
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function phpmkr_db_connect($HOST=HOST,$USER=USER,$PASS=PASS,$DB=DB,$MOTOR=MOTOR,$PORT=PORT,$BASEDATOS=BASEDATOS,$TABLESPACE=TABLESPACE)
{
global $conn;
   if(!$conn)
  {
    $datos=array('basedatos'=>$BASEDATOS,'db'=>$DB,'motor'=>$MOTOR,'host'=>$HOST,'user'=>$USER,'pass'=>$PASS,'port'=>$PORT);
    $con=new conexion($datos);
    $conn=new SQL($con,$MOTOR);
    if($conn && $conn->Conn){
      return ($conn);
    }
    else if(!$conn){
      error("Error al Tratar de Crear el SQL.".$conn->consulta);
      return FALSE;
    }
    else{
       error("Error al conectarse con la Base de datos.".$conn->consulta);
       return FALSE;
    }
  }
  else return(TRUE);      
}


/*
<Clase>
<Nombre>phpmkr_db_close
<Parametros>$conn: objeto que contiene la conexion a la base de datos
<Responsabilidades>Cerrar la conexi�+� actual
<Notas>Examina que la conexion exista y si es asi se encarga de cerrarla
<Excepciones>Error al cerrar la base de datos. Si la conexion que se quiere cerrar no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function phpmkr_db_close($conn)
{
	$conn->Conn->Desconecta();
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
function phpmkr_query($strsql)
{ 
global $conn;

if(!get_magic_quotes_gpc()) // SI NO ESTAN ACTIVADAS LAS MAGIC QUOTES DE PHP ESCAPA LA SECUENCIA SQL
    $strsql=stripslashes($strsql);

  $rs=Null;
  if($conn){ 
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
    $rs=$conn->Ejecutar_Sql($strsql);
  $sqleve=""; 
  
 switch($accion)
  {
    case("SELECT"):
      $strsql=htmlspecialchars_decode(htmlentities(utf8_decode($strsql)));
      break;
    case("INSERT"):
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
   break;   
  }  
  if ($accion<>"SELECT") 
    phpmkr_free_result($rs);
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
function phpmkr_num_fields($rs)
{global $conn; 
 return($conn->Numero_Campos($rs));
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
function phpmkr_field_type($rs,$pos)
{global $conn; 
 return($conn->Tipo_Campo($rs,$pos));
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

function phpmkr_field_name($rs,$pos)
{global $conn; 
 return($conn->Nombre_Campo($rs,$pos));
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

function phpmkr_num_rows($rs)
{
  global $conn;
	if($conn){
	  if(!$rs&&$conn->res)
	   $rs = $conn->res;
	 
	 return $conn->Numero_Filas($rs);
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
function phpmkr_fetch_array($rs)
{
  global $conn;
	if($conn){
	  if(!$rs&&$conn->res)
	   $rs = $conn->res;
	   $retorno=$conn->sacar_fila($rs);
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

function phpmkr_fetch_row($rs)
{
  global $conn;
	if($conn){
	  if(!$rs&&$conn->res)
	   $rs = $conn->res;
	   $retorno=$conn->sacar_fila($rs);
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
function phpmkr_free_result($rs)
{global $conn;
 if($conn->motor=="MySql")
	  @mysqli_free_result($conn->res);
 else if($conn->motor=="Oracle")
    @OCIFreeStatement($conn->res);	  
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
function phpmkr_insert_id()
{
global $conn;
  if($conn)
  {
    $evento = $conn->ultimo_insert;
    $buscar = busca_filtro_tabla("*",DB.".evento","idevento=".$evento,"",$conn);
    //print_r($buscar); die();
    return $buscar[0]["registro_id"];
  }
  else{
     alerta("Error al buscar la ultima insercion.".$rs->sql);
     return FALSE;
  }      
}

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
function phpmkr_error()
{global $conn;

 if($conn->motor=="MySql")
	 {if($conn->error<>"")
      echo  ($conn->error." en \"".$conn->consulta."\"");
	 }
 else if($conn->motor=="Oracle")
  {if($conn->error<>"")
      echo  ($conn->error["message"]." en \"".$conn->consulta."\"");   
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
function busca_filtro_tabla($campos,$tabla,$filtro,$orden,$conn){
  global $sql,$conn;
  if(!$conn){
    $conn=phpmkr_db_connect();
  }
  $retorno=array();
  $temp=array();
  $retorno["tabla"]=$tabla;
  switch ($tabla)
  {
    case ("dependencia2"):
      $tabla = "dependencia";
      break;
    case ("cargo2"):
      $tabla="cargo";
      break;
    case ("cargo3"):
      $tabla="dependencia_cargo";
      break; 
    case ("funcionario2"):
      $tabla="funcionario";
      break;    
  }
  $sql="Select ";
  if($campos)
    $sql.=$campos;
  else $sql.="*";
  if($tabla)
    $sql.=" FROM ".$tabla;

  if($filtro)
    $sql.=" WHERE ".str_replace('"',"'",$filtro);
  if($orden)
  {
    if(substr($orden,0,5)=="GROUP")
      $sql.=" ".$orden;
    else  
      $sql.=" ORDER BY ".$orden;
  }
  $sql=htmlspecialchars_decode(htmlentities(utf8_decode($sql)));
  $rs=$conn->Ejecutar_Sql($sql);
  $temp=phpmkr_fetch_array($rs);

  $retorno["sql"]=$sql;
  
  for($i=0;$temp;$temp=phpmkr_fetch_array($rs),$i++)
    array_push($retorno,$temp);
  $retorno["numcampos"]=$i;  
  phpmkr_free_result($rs);
  return($retorno);
}

/*
<Clase>
<Nombre>evento
<Parametros>$tabla: Tabla sobre la que se realiza el evento
            $accion: Tipo de evento que se realiza
            $sql: sentencia que se ejecut�+�
            $llave: llave primaria del registro sobre el que se realiza la accion
<Responsabilidades>llevar a cabo la accion y registrar el evento en el log
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function evento($tabla,$evento,$strsql,$llave)
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
}

/*
<Clase>
<Nombre>ejecuta_sql
<Parametros>$sql: sentencia que se ejecuta, $con: conexion sobre la que se ejecutar�+�la sentencia
<Responsabilidades>Ejecuta una sentencia insert y retorna la llave de lo que acaba de insertar
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function ejecuta_sql($sql)
{global $conn;
 phpmkr_query($sql,$conn);
 $id=phpmkr_insert_id();
 if($id>0)
 { 
  return($id);
 } 
 else
  return false;  
 phpmkr_free_result();      
}

/*
<Clase>
<Nombre>ejecuta_filtro
<Parametros>$sql: sentencia que se ejecuta, $con: conexion sobre la que se ejecutar�+�la sentencia
<Responsabilidades>Ejecuta una sentencia insert y retorna la llave de lo que acaba de insertar
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function ejecuta_filtro($sql1,$con)
{
//echo($sql."<BR>");
global $sql;
$sql=$sql1;
$rs=@phpmkr_query($sql,$con);
$resultado["numcampos"]=@phpmkr_num_rows($rs);
if($resultado["numcampos"]){
  $resultado=@phpmkr_fetch_array($rs);
  $resultado["numcampos"]=@phpmkr_num_rows($rs);
}	
//print_r($resultado);
return($resultado);
}

/*
<Clase>
<Nombre>delimita
<Parametros>$cad: cadena, $long: longitud que se desea delimitar
<Responsabilidades>cortar la cadena $cad para que no sobrepase la longitud $long
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function delimita($cad,$long) 
{
if( strlen($cad) < $long) 
  return($cad);
else return(substr($cad,0,$long-3)."<B> ... </B>");
}

/*
<Clase>
<Nombre>busca_tabla
<Parametros>$tabla: tabla sobre la que realiza la busqueda
            $idtabla: identificador del registro que se quiere obtener
<Responsabilidades> Obtener en un arreglo el registro cuyo identificador es $idtabla de la tabla $tabla
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function busca_tabla($tabla,$idtabla){
global $sql,$conn;
$retorno=array();
$temp=array();
$retorno["tabla"]=$tabla;
switch ($tabla)
{
 case ("dependencia2"):
  $tabla = "dependencia";
  break;
 case ("cargo2"):
  $tabla="cargo";
  break;
 case ("cargo3"):
  $tabla="dependencia_cargo";
  break; 
 case ("funcionario2"):
  $tabla="funcionario";
 break;    
}
$motor=MOTOR;
if($motor=="MySql")
{
 $campos=str_replace("to_char","",$campos);
}
$sql="Select DISTINCT * FROM ".$tabla." WHERE id".$tabla."=".$idtabla;
$rs=phpmkr_query($sql,$conn) or error("Error en Bsqueda de Proceso SQL: $sql");
$temp=phpmkr_fetch_array($rs);
for($i=0;$temp;$temp=phpmkr_fetch_array($rs),$i++)
 array_push($retorno,$temp);
$retorno["numcampos"]=$i; 
phpmkr_free_result($rs);
return($retorno);
}

/*
<Clase>
<Nombre>busca_toda_tabla
<Parametros>$tabla: tabla en la que se quiere buscar, $conn: conexion activa
<Responsabilidades>obtener en un arreglo todo el contenido de la tabla
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function busca_toda_tabla($tabla,$conn){
global $sql;
$retorno=array();
$temp=array();
$retorno["tabla"]=$tabla;
/*if($tabla=='funcionario'||*/
if($tabla=='cuenta')
{
phpmkr_query("use intranet",$conn) or error("CONEXION CON intranet");
if($tabla=='funcionario')
$sql="Select DISTINCT cuenta_id AS id, cuenta_nombre AS nombre, cuenta_apellido AS apellido, ximma_cargos_empleados.cargo_descripcion AS cargo, ximma_dependencias.dependencia_nombre AS dependencia, ximma_dependencias.dependencia_id AS dependencia_codigo  FROM ximma_cuentas, ximma_cuentas_info, ximma_cargos_empleados ,ximma_dependencias WHERE ximma_cuentas_info.info_cargo=ximma_cargos_empleados.cargo_id AND ximma_cuentas.cuenta_login=ximma_cuentas_info.info_login AND ximma_dependencias.dependencia_id=ximma_cuentas_info.info_dependencia ORDER BY nombre";
else if($tabla=='cuenta')
$sql="SELECT DISTINCT * ,cuenta_id AS id FROM ximma_cuentas ORDER BY cuenta_login";
$rs=phpmkr_query($sql,$conn) or error("Error en Bsqueda de Proceso SQL: $sql");
phpmkr_query("use ".DB,$conn);
$temp=phpmkr_fetch_array($rs);
$retorno["numcampos"]=phpmkr_num_rows($rs);
for(;$temp;$temp=phpmkr_fetch_array($rs))
 array_push($retorno,$temp);
phpmkr_free_result($rs);
}
else 
{
switch ($tabla)
{
 case ("dependencia2"):
  $tabla = "dependencia";
  break;
 case ("cargo2"):
  $tabla="cargo";
  break;
 case ("cargo3"):
  $tabla="dependencia_cargo";
  break; 
 case ("funcionario2"):
  $tabla="funcionario";
 break;    
}
$sql="Select DISTINCT * FROM ".$tabla;
$rs=phpmkr_query($sql,$conn) or error("Error en Bsqueda de Proceso SQL: $sql");
$temp=phpmkr_fetch_array($rs);
$retorno["numcampos"]=phpmkr_num_rows($rs);
for(;$temp;$temp=phpmkr_fetch_array($rs))
 array_push($retorno,$temp);
phpmkr_free_result($rs);
}
return($retorno);
}
/*Retorna un arreglo ordenado ascendentemente extrayendo el campo de una matriz que debe tener 2 niveles sacando 1 el campo del segundo nivel esto se utiliza principalmente para retornos tipo BD el arreglo es el arreglo origen, el campo es el campo a buscar y la bandera es U=unico, M=mayusculas, m=minusculas, D=ordenado Descendente*/

function extrae_campo($arreglo,$campo,$banderas="U,M"){
//print_r($arreglo);
$retorno=array();
for($i=0;$i<$arreglo["numcampos"];$i++){
  if($arreglo[$i][$campo]<>"")
   $retorno[$i]=$arreglo[$i][$campo];
}
$band=explode(",",$banderas);
//print_r($band);
$cont=count($band);
for($j=0;$j<$cont;$j++){
  switch($band[$j]){
    case "U" : 
      $retorno_aplicado=array_unique($retorno);
      $retorno=$retorno_aplicado;
      sort($retorno,SORT_ASC);
    break;  
    case "M":
      unset($retorno_aplicado);
      $retorno_aplicado=array();
      $retorno_aplicado=array_map('strtoupper', $retorno);
      $retorno=$retorno_aplicado;
      sort($retorno,SORT_ASC);
    break;
    case "m":
      unset($retorno_aplicado);
      $retorno_aplicado=array();
      $retorno_aplicado=array_map('strtolower', $retorno);
      $retorno=$retorno_aplicado;
      sort($retorno,SORT_ASC);
    break;
    case "D":
      sort($retorno,SORT_DESC);
    break;       
  }
}
return($retorno);
}
/*
<Clase>
<Nombre>sincronizar_carpetas
<Parametros>$conn: conexion activa con la base de datos
<Responsabilidades>Esta funcion genera una sincronizacion de la carpeta temporal, tomando las imagenes e indexandolas
                   de forma automatica si no logra encontrar el tipo documental lo envia a  una carpeta sin indexacion 
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function sincronizar_carpetas($tipo,$conn)
{
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
include_once($ruta_db_superior."binario_func.php");
$rutas=array();
$dir = "";
$dir2="";
$copiar=0;
$peso=2000000;
$tabla="pagina";
$estado="";
$configuracion=busca_filtro_tabla("*",DB.".configuracion A","A.tipo='ruta' OR A.tipo='imagen' OR A.tipo='peso'","A.idconfiguracion DESC",$conn);
  for($i=0;$i<$configuracion["numcampos"];$i++){
  switch($configuracion[$i]["nombre"]){
  case "ruta_temporal": 
  $dir=$configuracion[$i]["valor"]."_".$_SESSION["LOGIN".LLAVE_SAIA];
  break;
  case "ruta_documentos": 
  $dir2=$configuracion[$i]["valor"];
  break;
  case "copia": 
  if(is_numeric($configuracion[$i]["valor"]))
  $copia=$configuracion[$i]["valor"];
  else $copia=0;
  break;
  case "genera_pdf": 
  if(is_numeric($configuracion[$i]["valor"])){ 
  $pdf=$configuracion[$i]["valor"];
  }
  else $pdf=0;
  break;
  case "ancho_imagen":
  if(is_numeric($configuracion[$i]["valor"])){
  $imgancho=$configuracion[$i]["valor"];
  }
  else $imgancho=600;
  break; 
  case "alto_imagen":
  if(is_numeric($configuracion[$i]["valor"])){
  $imgalto=$configuracion[$i]["valor"];
  }
  else $imgalto=700;
  break;
  case "ancho_miniatura":
  if(is_numeric($configuracion[$i]["valor"])){
  $miniatura_ancho=$configuracion[$i]["valor"];
  }
  else $miniatura_ancho=90;
  break;
  case "alto_miniatura":
  if(is_numeric($configuracion[$i]["valor"])){
  $miniatura_alto=$configuracion[$i]["valor"];
  }
  else $miniatura_alto=120;
  break;
  
  } 
 }
/// Define si se almacena en la BD o en archivos

 $config = busca_filtro_tabla("valor","configuracion","nombre='tipo_almacenamiento'","",$conn);
  if($config["numcampos"])
   {
     $tipo_almacenamiento=$config[0]['valor'];
    }
  else 
    $tipo_almacenamiento="archivo"; // Si no encuentra el registro en configuracion almacena en archivo
      
if($tipo_almacenamiento=="archivo") // Se alcenan paginas y miniaturas en la BD 
{
   if(is_dir($dir))  //ruta_temporal
	 $directorio=opendir("$dir");
   else
     $directorio=null;
	 
  if($directorio) //ruta_temporal
	{ 
	$cont=1;
	$ruta="";
	$cad="";
	$cad_temp="";
	$numero_pagina = "";
	/// Aqui toca recorrer la carpeta que se elija como temporal para buscar el listado de las paginas que se van a subir a la base de datos.
	//$archivo = readdir($directorio);
	 while ($archivo = readdir($directorio)) 
  { 
   if ($archivo !="." && $archivo !=".." && !is_dir($archivo))
      $archivos[]=$archivo;   
  } 
natsort ($archivos); // Con ksort($entradas) mostras los menos recientes
	foreach ($archivos as $archivo)	
	{
	$dir3="";
	$ruta=$dir."/".$archivo;
	$path=pathinfo($ruta);
	if($archivo && $archivo!="." && $archivo!=".." && is_file("$archivo")!="dir" && (strtolower($path['extension'])=='jpg' || strtolower($path['extension'])=='jpeg') && @filesize($archivo)<=$peso)
	{
	/*cad define el nombre de la organizacion de las carpetas y el criterio de almacenamiento, sin embargo debe ser cambiando luego de
	definir el codigo del documento*/
	$ic=strrpos($path["basename"],"#");
	$fc=strrpos($path["basename"],")");
	$cad=substr($path["basename"],$ic+1,$fc-$ic-1);
	$punto=strrpos($path["basename"],".");
	$cadpunto=substr($path["basename"],0,$punto);
	$pag=strrpos($cadpunto,"g");
	$cont=substr($cadpunto,$pag+1);
	if($cad==""){
	$cad="0";
	}
	$fieldList["id_documento"] = $cad;
	if($estado == "")
  { $datos_doc = busca_filtro_tabla("estado,".fecha_db_obtener('fecha','Y-m')." as fecha,iddocumento","documento","iddocumento=".$fieldList["id_documento"],"",$conn);      
	  $estado = $datos_doc[0]["estado"];
	  $fecha = $datos_doc[0]["fecha"];	  
	}
	$num = busca_filtro_tabla("A.pagina",DB.".".$tabla." A","A.id_documento=".$fieldList["id_documento"]." AND pagina=".$cont,"",$conn);
	$iddocumento = $fieldList["id_documento"];
	if($num["numcampos"] && $cad_temp==""){
	  $paginas=busca_filtro_tabla("A.pagina,A.ruta",DB.".".$tabla." A","A.id_documento=".$fieldList["id_documento"],"A.pagina",$conn);
	  $num_paginas_antes = $paginas["numcampos"]; //Se consulta el numero de paginas antes de la accion.
	  $paginas_temporales=array();
	    for($h=0;$h<$paginas["numcampos"];$h++){
	    $punto2=strrpos($paginas[$h]["ruta"],".");
	    $cadpunto2=substr($paginas[$h]["ruta"],0,$punto2);
	    $pag2=strrpos($cadpunto2,"g");
	    $cont2=substr($cadpunto2,$pag2+1);
	    array_push($paginas_temporales,$cont2);
	    array_push($paginas_temporales,$paginas[$h]["pagina"]);
	    //print_r($paginas_temporales);echo "<br><br><br>";
	    }
	  sort($paginas_temporales);
	  $cont3=count($paginas_temporales);
	  $cad_temp=$paginas_temporales[$cont3-1];
	  $numero_pagina = $paginas["numcampos"];
  }
	//Este es el punto dode se puede hacer el cambio de carpeta en cad donde se almacenaran fisicamente las imagenes.
	$cad2=$fieldList["id_documento"];
	$dir3="../".$estado."/".$fecha."/".$cad2."/".$dir2."/";	
  $ruta_dir = "../".$estado."/".$fecha."/".$cad2;  
	crear_destino($dir3);
	/*if(!is_dir($dir3)){
	if(mkdir($dir3,0777))
	$dir3="../".$dir2."/".$cad2."/";
	else $dir3="../documentos/error/".$cad2; 
	}*/
	//chmod($ruta,0775); 
	/*Me lleva hasta la Ultima pagina del documento.*/
	if($numero_pagina<>"")
	 $numero_pagina=intval($numero_pagina)+1;
	else
   $numero_pagina=1;
	if($cad_temp<>""){
	$cont=intval($cad_temp)+intval($cont);
	}
	if(cambia_tam($ruta,$dir3."doc".$fieldList["id_documento"]."pag".$cont.".jpg",$imgancho,$imgalto,1))
	{
	@unlink($ruta);
	$ruta2=$dir3."doc".$fieldList["id_documento"]."pag".$cont.".jpg";
	//$dirminiatura="../miniaturas/documentos/"; 
	$dirminiatura=$ruta_dir."/miniaturas";
  if(!is_dir($dirminiatura."/")){
	if(!mkdir($dirminiatura."/",0777))
	{
	alerta("Problemas al crear la carpeta ".$dirminiatura."/"." de de Imagenes-Miniaturas Por favor Comuniquese con su Administrador");
	}
	}
		chmod($dirminiatura."/",0777); 
		$fieldList["imagen"]=cambia_tam($ruta2,$dirminiatura."/doc".$fieldList["id_documento"]."pag".$cont.".jpg",$miniatura_ancho,$miniatura_alto,0);		

		array_push($rutas,$fieldList["id_documento"]);
		$fieldList["ruta"]=$ruta2;
		$fieldList["pagina"] = $numero_pagina;
		$strsql = "INSERT INTO ".DB.".$tipo(id_documento,imagen,pagina,ruta) VALUES (".$fieldList["id_documento"].",'".$fieldList["imagen"]."',".$fieldList["pagina"].", '".$fieldList["ruta"]."')";
		//die($strsql);
		phpmkr_query($strsql, $conn) or error("PROBLEMAS AL EJECUTAR LA B?QUEDA de INSERCION" . phpmkr_error() . ' SQL:' . $strsql);
	  $idpag=phpmkr_insert_id();
	  registrar_accion_digitalizacion($fieldList["id_documento"],'ADICION PAGINA',"Identificador: $idpag, Nombre: ".basename($fieldList["imagen"]));	

	} 
	else error("Existen Problemas al Cargar el Archivo: $ruta");
	}
	else if(is_file($archivo) && filesize($archivo)>$peso)
	alerta($archivo." Excede el tamanio permitido! Por Favor comuniquese con el Administrador del Sistema");
	$archivo = readdir($directorio); 
	} 
	closedir($directorio);
	
	/* Por ahora no se necesita generar el PDF solo se reuiere el lmacenamineto de las imagenes,
	en caso puntual se requerira para la etapa de gestion documental */
	if($pdf){
	$rutas=array_unique($rutas);
	for($i=0;isset($rutas[$i]);$i++){
	$rutaD=$rutas[$i];
	$nombrepdf=busca_tabla("archivo",$rutaD);
	if($nombrepdf["numcampos"]){
	$namepdf= $dir3."/".$rutaD."/".$nombrepdf[0]["titulo"].".pdf";
	$tipo=$nombrepdf[0]["tipo_documental_idtipo_documental"];
	}
	else {
	$namepdf="documentos/".$rutaD."/Sin_indexar.pdf";
	$tipo=0;
	}
	$namepdf=str_replace(" ","_",$namepdf); 
	if(dbToPdf($namepdf,"pagina","id_documento",$fieldList["id_documento"],$conn)){
	if(is_file($namepdf)){
	$strsql="UPDATE ".DB.".archivo SET pdf='$namepdf' WHERE idarchivo='$rutaD'";
	//en esta linea no esta funcionando el javascript
	phpmkr_query($strsql, $conn) or error("PROBLEMAS AL EJECUTAR LA ACTUALIZACION (SINCRONIZAR CARPETAS):".$strsql);
	//transferir_archivo($rutaD,"12",$tipo); 
	}
	}
	else
	{
	error("NO SE GENERO EL PDF: $rutaD");
	
	} 
	}   
	} // Fin if PDF
	} //Fin If directorio 
} // Fin if tipo almacenamiento
elseif($tipo_almacenamiento=="db") // Se almacena en la base de datos 
{
 if(is_dir($dir))
  	  $directorio=opendir("$dir");
	 else
	  $directorio=null;

	  if($directorio)
		{
		 $cont=1;
		 $ruta="";
		 $cad="";
		 $cad_temp="";
	 /// Aqui toca recorrer la carpeta que se elija como temporal para buscar el listado de las paginas que se van a subir a la base de datos.
		$archivo = readdir($directorio);

	   while ($archivo)
		{
   	  $dir3="";
		  $ruta=$dir."/".$archivo;
		  $path=pathinfo($ruta);
		if($archivo && $archivo!="." && $archivo!=".." && is_file("$archivo")!="dir" && (strtolower($path['extension'])=='jpg' || strtolower($path['extension'])=='jpeg') && @filesize($archivo)<=$peso)
		{
		/*cad define el nombre de la organizacion de las carpetas y el criterio de almacenamiento, sin embargo debe ser cambiando luego de
		definir el codigo del documento*/
		 $ic=strrpos($path["basename"],"#");
		 $fc=strrpos($path["basename"],")");
		 $cad=substr($path["basename"],$ic+1,$fc-$ic-1);
		 $punto=strrpos($path["basename"],".");
		$cadpunto=substr($path["basename"],0,$punto);
		$pag=strrpos($cadpunto,"g");
		$cont=substr($cadpunto,$pag+1);
		if($cad==""){
		$cad="0";
	   }
		$fieldList["id_documento"] = $cad;
		$num = busca_filtro_tabla("A.pagina",DB.".".$tabla." A","A.id_documento=".$fieldList["id_documento"]." AND pagina=".$cont,"",$conn);
		if($num["numcampos"] && $cad_temp==""){
		  $paginas=busca_filtro_tabla("A.pagina,A.ruta",DB.".".$tabla." A","A.id_documento=".$fieldList["id_documento"],"A.pagina",$conn);
		  $paginas_temporales=array();
		    for($h=0;$h<$paginas["numcampos"];$h++){
		    $punto2=strrpos($paginas[$h]["ruta"],".");
		    $cadpunto2=substr($paginas[$h]["ruta"],0,$punto2);
		    $pag2=strrpos($cadpunto2,"g");
		    $cont2=substr($cadpunto2,$pag2+1);
		    array_push($paginas_temporales,$cont2);
		    array_push($paginas_temporales,$paginas[$h]["pagina"]);
		    //print_r($paginas_temporales);echo "<br><br><br>";

		    }
		  sort($paginas_temporales);
		  $cont3=count($paginas_temporales);
		  $cad_temp=$paginas_temporales[$cont3-1];
		}
		//Este es el punto dode se puede hacer el cambio de carpeta en cad donde se almacenaran fisicamente las imagenes.

	 	$cad2=$fieldList["id_documento"];
		$dir3="../".$dir2."/".$cad2."/";

		if(!is_dir($dir3)){
		if(mkdir($dir3,0777))
		$dir3="../".$dir2."/".$cad2."/";
		else $dir3="../documentos/error/".$cad2;
		}
	 	//chmod($ruta,0775);

		/*Me lleva hasta la Ultima pagina del documento.*/

	 	if($cad_temp<>""){

	 	$cont=intval($cad_temp)+intval($cont);
		}
		if(cambia_tam($ruta,$dir3."doc".$fieldList["id_documento"]."pag".$cont.".jpg",$imgancho,$imgalto,1))
		{
	 	@unlink($ruta);
		$ruta2=$dir3."doc".$fieldList["id_documento"]."pag".$cont.".jpg";
		$dirminiatura="../miniaturas/documentos/";
		if(!is_dir($dirminiatura.$fieldList["id_documento"]."/")){
		if(!mkdir($dirminiatura.$fieldList["id_documento"]."/",0777))
		{
	 	alerta("Problemas al crear la carpeta ".$dirminiatura.$fieldList["id_documento"]."/"." de de Imagenes-Miniaturas Por favor Comuniquese con su Administrador");
		}
		}

			chmod($dirminiatura.$fieldList["id_documento"]."/",0777);
			$fieldList["imagen"]=cambia_tam($ruta2,$dirminiatura.$fieldList["id_documento"]."/doc".$fieldList["id_documento"]."pag".$cont.".jpg",$miniatura_ancho,$miniatura_alto,0);
	 		array_push($rutas,$fieldList["id_documento"]);
			$fieldList["ruta"]=$ruta2;
			$fieldList["pagina"] = $cont;

		/************************* Almacenamiento en Bd ******************************************/
		// Nota por el momento se mantienen los archivos como medida de seguridad
		// Perlo luego se debe realizar un unlink a la miniatura y a la pagina  para
		// Eliminar
	 	// Se crea esta funcionalidad  manteniendo la funcionalidad ay creada de almacenamiento en archivos
		//almacena_binario_db($archivo,$descripcion)

 		 $descripcion="MINIATURA_".$fieldList["id_documento"];
		 $idbinario_min= almacena_binario_db($fieldList["imagen"],$descripcion);
		 $descripcion="PAGINA_".$fieldList["id_documento"];
		 $idbinario_pag= almacena_binario_db($fieldList["ruta"],$descripcion);
		 if($idbinario_min && $idbinario_pag)
		  {
		    $strsql = "INSERT INTO ".DB.".$tipo(id_documento,idbinario_min,pagina,idbinario_pag,imagen,ruta) VALUES (".$fieldList["id_documento"].",'".$idbinario_min."',".$fieldList["pagina"].", '".$idbinario_pag."','".$fieldList["imagen"]."','".$fieldList["ruta"]."')";
		   // die($strsql);
		  	 phpmkr_query($strsql, $conn) or error("PROBLEMAS AL EJECUTAR LA B?QUEDA de INSERCION" . phpmkr_error() . ' SQL:' . $strsql);
       $idpag=phpmkr_insert_id();
	 registrar_accion_digitalizacion($fieldList["id_documento"],'ADICION PAGINA',"Identificador: $idpag, Nombre: ".basename($fieldList["imagen"]));	

		  }
	    else
	      alerta ("Error al almacenar el archivo Por favor verifique que el archivo sea accesible y este correctamente almacenado");
		  /*****************************************************************************************/
	 	}
		else error("Existen Problemas al Cargar el Archivo: $ruta");
		}
		else if(filesize($archivo)>$peso)
		alerta($archivo." Excede el tamanio permitido! Por Favor comuniquese con el Administrador del Sistema");
		$archivo = readdir($directorio);
		}
		closedir($directorio);

		/* Por ahora no se necesita generar el PDF solo se reuiere el lmacenamineto de las imagenes,
		en caso puntual se requerira para la etapa de gestion documental */
		if($pdf){
		$rutas=array_unique($rutas);
		for($i=0;isset($rutas[$i]);$i++){
		$rutaD=$rutas[$i];
		$nombrepdf=busca_tabla("archivo",$rutaD);
		if($nombrepdf["numcampos"]){
		$namepdf= $dir3."/".$rutaD."/".$nombrepdf[0]["titulo"].".pdf";
		$tipo=$nombrepdf[0]["tipo_documental_idtipo_documental"];
		}
		else {
		$namepdf="documentos/".$rutaD."/Sin_indexar.pdf";
		$tipo=0;
		}
		$namepdf=str_replace(" ","_",$namepdf);
		if(dbToPdf($namepdf,"pagina","id_documento",$fieldList["id_documento"],$conn)){
		if(is_file($namepdf)){
		$strsql="UPDATE ".DB.".archivo SET pdf='$namepdf' WHERE idarchivo='$rutaD'";
		//en esta linea no esta funcionando el javascript

		phpmkr_query($strsql, $conn) or error("PROBLEMAS AL EJECUTAR LA ACTUALIZACION (SINCRONIZAR CARPETAS):".$strsql);
		//transferir_archivo($rutaD,"12",$tipo);

		}
		}
		else
		{
		error("NO SE GENERO EL PDF: $rutaD");

		}
		}
		} // Fin if PDF

		} //Fin If directorio
}// Fin else
//else error("No Existe Directorio -Sincroniza Carpeta");
// Se valida el numero total de paginas para asegurar el exito de la accion
$num_total = busca_filtro_tabla("","pagina","id_documento=".$iddocumento,"",$conn); 
if($num_total["numcampos"]==$num_paginas_antes)
   alerta("Ocurrio un problema al almacenar los documento. Por favor repetir el proceso, si continuan los problemas comuniquese con el administrador");
return(TRUE);
}

/*Manipulacion de Imagenes*/
/*
<Clase>
<Nombre>cambia_tam
<Parametros>$nombreorig: nombre de la imagen
            $nombredest: nombre de la nueva imagen
            $nwidth: ancho del a nueva imagen
            $nheight: alto de la nueva imagen
            $tipo: 
<Responsabilidades>cambiar el tama�+� de la imagen, generando una nueva de las dimensiones deseadas
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function cambia_tam($nombreorig,$nombredest,$nwidth,$nheight,$tipo){
$ext='jpg';
// Se obtienen las nuevas dimensiones
list($width, $height) = getimagesize($nombreorig);
if ($nwidth && ($width < $height)) {
$nwidth = ($nheight / $height) * $width;
} else {
$nheight = ($nwidth / $width) * $height;
} 
$image_p = imagecreatetruecolor($nwidth,$nheight); 
imagecolorallocate ($image_p, 255, 255, 255); 
if($ext=='gif'){ 
$image = imagecreatefromgif($nombreorig);///nombre del archivo origen
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
imagegif($image_p, $nombredest);///nombre del destino
imagedestroy($image_p);
imagedestroy($image); 
return($nombredest); 
}
else
{
$image = imagecreatefromjpeg($nombreorig);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
imagejpeg($image_p, $nombredest, 80);///nombre del destino
imagedestroy($image_p);
imagedestroy($image);
return($nombredest);
}
imagedestroy($image_p);
imagedestroy($image);
return(Null);
}

/*
<Clase>
<Nombre>error
<Parametros>$cad: cadena de error
<Responsabilidades>Imprimir la cadena de error
<Notas>Esta Funcion realiza la insercion de el error generado en una rreglo que debe mostrarse en alguna instancia 
       puede ser en una marquesina en la parte inferior
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function error($cad)
{
  if(DEBUGEAR)
   echo ($cad."<BR>");
   $archivo=fopen ("errores.txt" , "w");
   fwrite($archivo,$cad."\n\r");
   fclose($archivo);
}
/*
<Clase>
<Nombre>imprime_error
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function imprime_error()
{
global $error;
if(!empty($error))
  echo( implode($error,"<BR><BR>"));
$error=Null;
die();
}

/*
<Clase>
<Nombre>abrir_url
<Parametros>$location: url, $target: frame
<Responsabilidades>Esta Funcion Abre una pagina en el frame objetivo con open si no existe un frame objetivo trata de abri la pagina en un frame llamado "centro"
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function abrir_url($location,$target)
{
if($target){
?>
<script language="javascript">
	window.open("<?php print($location);?>","<?php print($target);?>");
</script>
<?php
}
else {
?>
<script language="javascript">
	window.open("<?php print($location);?>","centro");
</script>
<?php
}
}

/*
<Clase>
<Nombre>redirecciona
<Parametros>$location: pagina a abrir
<Responsabilidades> Esta Funcion Abre una pagina con location
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function redirecciona($location){
?>
<script language="javascript">
	window.location="<?php print($location);?>";
</script>
<?php
exit();
}

function enviar_mensaje($origen,$usuarios,$mensaje,$tipo_envio)
{  
  //////// *********************
   return(true);
  //////// ********************
 global $conn;
 
  $i=0;
  $enviar=0;
  $em=FALSE;
  $eci=FALSE;
  $ece=FALSE;
  $mensajeria=busca_filtro_tabla("valor",DB.".configuracion","nombre='mensajeria'","",$conn);
  for($j=0;$j<count($tipo_envio);$j++)
  {
    switch($tipo_envio[$j])
    {
      case "msg": $em=TRUE;
                  break;
      case "e-interno": $eci=TRUE;
                        break;
    }
  }  
  //$em = TRUE;
  //$eci = TRUE;
  $to = array();
  $email=busca_filtro_tabla("valor",DB.".configuracion","nombre='servidor_correo'","",$conn);
  for($i=0; isset($usuarios[$i])&&$usuarios[$i]; $i++)
  { 
   $funcionario=busca_filtro_tabla("login","funcionario","funcionario_codigo='".$usuarios[$i]."'","",$conn);
   if($funcionario["numcampos"])
   {
     $login[]=$funcionario[0]["login"];
     array_push($to,$funcionario[0]["login"]."@".$email[0]["valor"]);
   }    
  }  
  
  if($mensajeria["numcampos"]&&$em)
  { 
    
     include_once("mensajeria/class.jabber.envio.php");
      if (!$jab->connect(JABBER_SERVER)) {
      alerta("No se puede conectar al servico de Mensajeria");
      }
      // now, tell the Jabber class to begin its execution loop
      $jab->execute(CBK_FREQ,RUN_TIME);
      $i=0;
      $mensaje2=ucfirst($mensaje);
      while( isset($login[$i]) && $login[$i] )
      { 
       // OJO CAMBIAR EN EL CLIENTE COMENTAR ESTA LINEA Y DECOMENTAR LA SIGUIENTE       
        $jab->message("0k"."@".JABBER_SERVER,"chat",NULL,utf8_encode(html_entity_decode($mensaje2)));
       //$jab->message($login[$i]."@".JABBER_SERVER,"chat",NULL,utf8_encode(html_entity_decode($mensaje2)));        
        
        $i++;
      }
      $jab->disconnect();
  }  
  if($eci)
  {        
    //if($email["numcampos"])
    //{       
      if(count($to))
      { 
        $mailto=implode(",",$to);        
        require("email/mail.inc.php");
        // Creacion del Correo a Enviar
        $mail = new MyMailer;
        //$mail->Host = $email[0]["valor"];
        // Contenido del Correo
        //$mail->AddAddress($mailto."@".$email[0]["valor"], "$mailto");
        $mail->AddAddress("soportesaia@risaralda.gov.co","$mailto");                
        $mail->Subject = "Gestion de Archivos - SAIA";
        $mail->Body = ucfirst($mensaje);
       // alerta($mail->Host." - ".$mail->AddAddress." - ".$mail->Subject);        
        if(!$mail->Send())
        {
          Alerta("Existe un error al hacer la notificacion por correo");          
        } 
       // echo "Mensaje enviado";
       return true;
      }
    //}
  }
}

/*
<Clase>
<Nombre>contador
<Parametros>$cad: tipo de contador
<Responsabilidades>Buscar el contador correpondiente y hacer la debida actualizacion
<Notas>
<Excepciones>NO EXISTE UN CONSECUTIVO LLAMADO. Cuando el contador que llega como par�+�etro no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function contador($cad)
{
global $sql, $conn;
$cuenta=busca_filtro_tabla("A.consecutivo,A.idcontador",DB.".contador A","A.nombre='".$cad."'","",$conn);
if($cuenta["numcampos"]){
$consecutivo=$cuenta[0]["consecutivo"];
 $sql="UPDATE ".DB.".contador SET consecutivo=consecutivo+1 WHERE idcontador = ".$cuenta[0]["idcontador"];

 phpmkr_query($sql,$conn);
 return($cuenta);	
}  
else {
error("NO EXISTE UN CONSECUTIVO LLAMADO ".$cad);
return(0);
}
}

/*
<Clase>
<Nombre>muestra_contador
<Parametros>$cad: nombre del contador a consultar
<Responsabilidades>Retorna el valor del contador
<Notas>
<Excepciones>NO EXISTE UN CONSECUTIVO LLAMADO. Si no existe el contador que se quiere invocar
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function muestra_contador($cad)
{
global $sql,$conn;
$cuenta=busca_filtro_tabla("A.consecutivo,A.idcontador",DB.".contador A","A.nombre='".$cad."'","",$conn);
if($cuenta["numcampos"]){
$consecutivo=$cuenta[0]["consecutivo"];
return($consecutivo);	
}  
else {
error("NO EXISTE UN CONSECUTIVO LLAMADO ".$cad);
return(0);
}
}

/*
<Clase>
<Nombre>usuario_actual
<Parametros>$campo: columna del usuario que se quiere obtener
<Responsabilidades>Establece la informacion del usuario que tiene session actual
<Notas>
<Excepciones>No se encuentra el funcionario en el sistema, por favor comuniquese con el administrador
             Si no existe session en el momento
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function usuario_actual($campo){
global $usuactual,$sql,$conn;

if(!isset($_SESSION["LOGIN".LLAVE_SAIA]))
   salir(utf8_decode("La sesion ha expirado, por favor ingrese de nuevo."));
   
if($usuactual<>""){
$dato=busca_filtro_tabla("A.*,A.idfuncionario AS id",DB.".funcionario A","A.login='".$usuactual."'","",$conn);

if($dato["numcampos"])
  return($dato[0][$campo]);
else
  salir("No se encuentra el funcionario en el sistema, por favor comuniquese con el administrador");
}
}

/*
<Clase>
<Nombre>salir
<Parametros>$texto: texto que saldr�+�en pantalla
<Responsabilidades>Sacar la razon de la salida del sistema, redireccionando a la pagina de login
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function salir($texto){
global $usuactual,$conn;
if($texto)
  alerta($texto);  
$usuactual="";  
$conn->Conn->Desconecta();
@session_unset();
@session_destroy();
abrir_url("http://intranet.risaralda.gov.co:100","_top");
}

/*  
Para que funcione esto se debe hacer este cambio en la base de datos.
ALTER TABLE documento ADD estado ENUM( 'INICIADO', 'ACTIVO', 'TERMINADO', 'PROGRAMADO', 'INACTIVO', 'ELIMINADO' ) DEFAULT 'INICIADO' NOT NULL
UPDATE DOCUMENTO SET estado='ACTIVO' WHERE estado='INICIADO';  
*/
/*
<Clase>
<Nombre>generar_ingreso
<Parametros>$tipo_contador: siempre llega con el valor de radicacion de entrada
<Responsabilidades>hacer la insercion de un registro en la tabla documento, para que posteriormente se le actualicen sus datos
<Notas>Trabaja para la parte de colilla
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function generar_ingreso($tipo_contador){ 
global $conn;
  // Field numero
	$contador=contador($tipo_contador);
	$fieldList["numero"] = $contador[0]["consecutivo"];
  $fieldList["tipo_radicado"] = $contador[0]["idcontador"];
  $fieldList["estado"] = "'INICIADO'";
	// Field fecha
	$fieldList["fecha"] = fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s');
	$fieldList["fecha_creacion"] = fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s');

  // Field paginas
	$fieldList["paginas"] = 1;
	// insert into database	
	$strsql = "INSERT INTO ".DB.".documento (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";

	//$doc=evento("DOCUMENTO","ADICIONAR",$strsql,0)or error("PROBLEMAS AL EJECUTAR LA BUSQUEDA" . phpmkr_error() . ' SQL:' . $strsql);
	//die($strsql);
  $doc = ejecuta_sql($strsql);	
  registrar_accion_digitalizacion($doc,'CREACION DOCUMENTO');
return $doc;
}

/*
<Clase>
<Nombre>ingresar_documento
<Parametros>$doc: identificador del documento;
            $tipo_contador: tipo de radicacion a realizar
            $arreglo: nuevos datos del documento
            $destino: 
            $archivos: son los anexos al documento
<Responsabilidades>Insertar un documento en la base de datos y sus respectivos anexos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function ingresar_documento($doc,$tipo_contador,$arreglo,$destino,$archivos=NULL){  
  global $conn;
	$contador=busca_filtro_tabla("*",DB.".contador A","A.nombre='".$tipo_contador."'","",$conn);
  $estado=busca_filtro_tabla("estado","documento","iddocumento=$doc","",$conn);
  if($estado[0]["estado"]=="INICIADO")
     $arreglo["estado"] = "'ACTIVO'";
  else
     $arreglo["estado"] = "'".$estado[0]["estado"]."'";

  if($contador["numcampos"]){
  $arreglo["tipo_radicado"] = $contador[0]["idcontador"];  //consecutivo
      if($contador[0]["idcontador"]==2){
      $arreglo["estado"] = "'APROBADO'";  
    }

  }
  else $arreglo["tipo_radicado"]=0;
	  $sKey=$doc;
		$strsql = "UPDATE ".DB.".documento SET ";
		foreach ($arreglo as $key=>$temp) {
		if($temp<>"")
			$strsql .= "$key = $temp, ";
		}
		if (substr($strsql, -2) == ", ") {
			$strsql = substr($strsql, 0, strlen($strsql)-2);
		}
		$sKeyWrk = "" . addslashes($sKey) . "";
		$strsql .= " WHERE iddocumento =". $sKeyWrk;    	
//evento("DOCUMENTO","MODIFICAR",$strsql,$sKey)or error("PROBLEMAS AL EJECUTAR LA BUSQUEDA" . phpmkr_error() . ' SQL:' . $strsql);
phpmkr_query($strsql,$conn);
    registrar_accion_digitalizacion($doc,'LLENADO DATOS');
	 if($archivos<>NULL && $archivos<>"")
      {
       /*  Manejo anterior de los anexos ... cuando el frame ya los almacenaba  
       $archivos=explode(",",$archivos);
       foreach($archivos as $nombre)
          {$datos_anexo=explode(";",$nombre);
           $sql="insert into ".DB.".anexos(ruta,documento_iddocumento,tipo) values('anexos/".$datos_anexo[0]."',$sKeyWrk,'".$datos_anexo[1]."')";
           $resultado=evento("ANEXOS","ADICIONAR",$sql,0) or error("PROBLEMAS CON EL ANEXO: $nombre");
          }
       */          
       /// Nuevo Procesamiento de anexos ... los anexos seran almacenados en documento edit..  
  
      }
return $doc;
}

/*
<Clase>
<Nombre>genera_ruta
<Parametros>$destino: identificador del funcionario que recibe el documento
            $tipo: tipo documental del documento asociado
            $doc: identificador del documento
<Responsabilidades>insertar en la ruta y en el buzon_salida los registros de la ruta correspondiente
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function genera_ruta($destino,$tipo,$doc){
global $conn;
$valores=array();
$idruta=0;  
for($i=0;$i<count($destino)-1;$i++)
{
  if(isset($destino[$i+1]))
  {
    $sql="INSERT INTO ".DB.".ruta(origen,tipo,destino,idtipo_documental,condicion_transferencia,documento_iddocumento,tipo_origen,tipo_destino,obligatorio) VALUES('".$destino[$i]['codigo']."','ACTIVO','".$destino[$i+1]['codigo']."',".$tipo.",'".$destino[$i]["condicion"]."','".$doc."',".$destino[$i]['tipo'].",".$destino[$i+1]['tipo'].",".$destino[$i]['obligatorio'].")";

    phpmkr_query($sql,$conn) or error("No se puede Generar una Ruta entre los funcionarios ".$destino[$i]['codigo']." y ".$destino[$i+1]['codigo']);
    $idruta=phpmkr_insert_id();
    if($idruta)
    {  
      $valores["archivo_idarchivo"]="'".$doc."'";
      $valores["nombre"]="'POR_APROBAR'";
      $valores["destino"]="'".$destino[$i]["codigo"]."'";
      $valores["tipo_destino"]="'".$destino[$i]["tipo"]."'";
      $valores["fecha"]=fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s');
      $valores["origen"]="'".$destino[$i+1]["codigo"]."'";
      $valores["tipo_origen"]="'".$destino[$i+1]["tipo"]."'";
      $valores["tipo"]="'DOCUMENTO'";
      $valores["activo"]=1;
      $valores["ruta_idruta"]=$idruta;
      $campos=implode(",",array_keys($valores));
      $values=implode(",",array_values($valores));
      $sql = "INSERT INTO ".DB.".buzon_entrada($campos) VALUES($values)"; 
      phpmkr_query($sql,$conn) or error("No se puede Generar una Ruta entre los funcionarios ".$destino[$i]['codigo']." y ".$destino[$i+1]['codigo']);
    }  
  }
} 
return TRUE;
}

/*
<Clase>
<Nombre>busca_cargo_funcionario
<Parametros>$tipo: filtro de la busqueda
            $dato:
            $dependencia:
            $conn: Conexion activa con la base de datos
<Responsabilidades>Funcion  que retorna el origen completo de un funcionario incluyendo los codigos de dependencia y cargo
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function busca_cargo_funcionario($tipo,$dato,$dependencia,$conn)
{
global $sql;
$datorig=array();
$datorig["numcampos"]=0;
$filtro="";
if($tipo=='nit' || $tipo==2){
$filtro="A.nit='".$dato."'";
}
else if($tipo=='id' || $tipo==1){
$filtro="A.funcionario_codigo=".$dato;
}
else if($tipo=='login' || $tipo==3){
$filtro="A.login='".$dato."'";
}
if($tipo=='nit'||$tipo=='id'||$tipo=='login' || $tipo==1 || $tipo==2 || $tipo==3){
$temp=busca_filtro_tabla("*",DB.".funcionario A",$filtro,"",$conn);
if($temp["numcampos"]==0)
  error("Datos del Funcionario Origen de Dependencia no Existe");
else {
$dorig=$temp[0]['idfuncionario'];
$datorig=busca_filtro_tabla("d.*,c.*,f.*,f.estado AS estado_f,d.estado AS estado_d",DB.".dependencia_cargo d, ".DB.".cargo c, ".DB.".funcionario f","d.funcionario_idfuncionario=f.idfuncionario AND c.idcargo=d.cargo_idcargo AND f.idfuncionario='".$dorig."'","f.estado ASC",$conn);
}
}
else if($tipo=="cargo" || $tipo==4){
$datorig=busca_filtro_tabla("A.iddependencia_cargo",DB.".dependencia_cargo A","A.cargo_idcargo=$dato AND A.dependencia_iddependencia=".$dependencia,"A.estado",$conn);
if($datorig["numcampos"])
  $datorig=busca_cargo_funcionario(5,$datorig[0]["iddependencia_cargo"],"");
else alerta(utf8_encode("No existe nadie en +�sta dependencia con el cargo especificado"));
}
else if($tipo=='iddependencia_cargo' || $tipo==5){
  $datorig=busca_filtro_tabla("*,f.estado as estado_f,d.estado as estado_d",DB.".dependencia_cargo d,".DB.".funcionario f,".DB.".cargo c","dependencia_cargo d,funcionario f,cargo","c.idcargo=d.cargo_idcargo AND f.idfuncionario=d.funcionario_idfuncionario AND d.iddependencia_cargo=".$dato,"f.estado",$conn);
}
else $datorig[0]['iddependencia_cargo']=$dato;
    if($temp["numcampos"])
        $datorig[0]=array_merge((array)$datorig[0],(array)$temp[0]);
return($datorig);
}

/*
<Clase>
<Nombre>agregar_destino_ruta
<Parametros>$arreglo: arreglo en el que se van a introducir los datos
            $tipo,$nit_usuario,$dependencia,$condicion,$orden: datos que se le introduciran al arreglo
<Responsabilidades>adiciona un nuevo componente de la ruta recibe el arreglo donde almacena el listado de rutas 
                   el tipo de destino, el codigo de destino, la dependencia a la que pertenece y la condicion de transferencia
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function agregar_destino_ruta($arreglo,$tipo,$nit_usuario,$dependencia,$condicion,$orden)
{
 global $conn;
 $temp2["tipo"]=$tipo;
 $temp2["codigo"]=$nit_usuario;
 if($dependencia<>""&&$dependencia<>NULL)
  $temp2["dependencia"]=$dependencia;
 else $temp2["dependencia"]=1;
 $temp2["condicion"]=$condicion;  
 $temp2["obligatorio"]=$orden;
  array_push($arreglo,$temp2);
return($arreglo);
}

/*
<Clase>
<Nombre>alerta_javascript
<Parametros>$mensaje: mensaje de la alerta
            $back: numero de paginas a devolver
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function alerta_javascript ($mensaje, $back)
{ 
 ?>
<script type="text/javascript">
<!--
alert("<?php echo($mensaje);?>");
<?php echo "window.history.go(-".$back.")";?>;
//-->
</script>
<?php
}
function alerta($mensaje)
{ 
 ?>
<script type="text/javascript">
<!--
alert("<?php echo $mensaje ;?>");
//-->
</script>
<?php
}
/*
<Clase>
<Nombre>volver
<Parametros>$back: numero de paginas a volver
<Responsabilidades>Devolver la aplicacion $back numero de paginas
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function volver($back)
{
 ?>
<script type="text/javascript">
<!--
<?php echo "window.history.go(-".$back.")";?>;
//-->
</script>
<?php
}


class PERMISO{
var $login;
var $conn;
var $acceso_propio;
var $acceso_grupo;
var $acceso_total;
var $idfuncionario;
var $funcionario_codigo;
var $perfil;

/*
<Clase>PERMISO
<Nombre>PERMISO
<Parametros>
<Responsabilidades>Inicializar el objeto permiso actual
<Notas>
<Excepciones>No se Puede Encontrar el Funcionario para Permisos. Si no se encuentra el funcionario en la base de datos
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function PERMISO(){
global $usuario_actual,$conn;
if(!isset($_SESSION["LOGIN".LLAVE_SAIA]))
   salir("La sesion ha expirado, por favor ingrese de nuevo.");
$this->login=@$_SESSION["LOGIN".LLAVE_SAIA];
$this->conn=$conn;
if($this->acceso_root()){
  $this->idfuncionario=0;
  $this->funcionario_codigo=0;
  $this->perfil = 1;
  return(TRUE);
}
else {
  $funcionario=busca_filtro_tabla("A.idfuncionario,A.funcionario_codigo,A.perfil",DB.".funcionario A","A.login='".$this->login."'","",$this->conn);
  if($funcionario["numcampos"]){
    $this->idfuncionario=$funcionario[0]["idfuncionario"];
    $this->funcionario_codigo=$funcionario[0]["funcionario_codigo"];
    $this->perfil=$funcionario[0]["perfil"];
  return(TRUE);
  } 
}
if(!isset($_SESSION["LOGIN".LLAVE_SAIA]))
 salir("No se Puede Encontrar el Funcionario para Permisos");
else 
 alerta("No se Puede Encontrar el Funcionario para Permisos");
return(FALSE);
}

/*
<Clase>PERMISO
<Nombre>acceso_root
<Parametros>
<Responsabilidades>buscar el login del administrador
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function acceso_root(){
$configuracion=busca_filtro_tabla("A.valor,A.fecha",DB.".configuracion A","A.tipo='usuario' AND A.nombre='login_administrador'","",$this->conn);
if($configuracion["numcampos"] && $this->login==$configuracion[0]["valor"])
  return(TRUE);
else return(FALSE);  
}

/*
<Clase>PERMISO
<Nombre>acceso_usuario_documento
<Parametros>
<Responsabilidades>inicializa el objeto actual con los permisos que tiene dicho usuario para el documento
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function acceso_usuario_documento(){
global $sql;
if($this->acceso_root()){
  $this->acceso_total="l,a,m,e";
  return(TRUE);  
  }
$acceso=busca_filtro_tabla("*",DB.".funcionario A,".DB.".permiso B,".DB.".modulo C","C.nombre='transferir' AND C.idmodulo=B.modulo_idmodulo AND A.idfuncionario=B.funcionario_idfuncionario AND A.login='".$this->login."'","",$this->conn);
for($i=0;$i<$acceso["numcampos"];$i++){
  $this->acceso_propio=$acceso[$i]["caracteristica_propio"];
  $this->acceso_grupo=$acceso[$i]["caracteristica_grupo"];
  $this->acceso_total=$acceso[$i]["caracteristica_total"];
}
return(TRUE);
}

/*
<Clase>PERMISO
<Nombre>permiso_usuario
<Parametros>$tabla: tabla sobre la que se verifica el permiso
            $accion: accion a realizar sobre la tabla
<Responsabilidades>Verificar si el usuario actual tiene permiso para realizar $accion sobre $tabla
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function permiso_usuario($tabla,$accion){
  global $sql;
  $permiso["numcampos"]=0;
  if($this->acceso_root()&&$accion==1){
      return(TRUE);
  }
  if(isset($tabla) && $tabla<>"" && isset($accion)&& $accion<>""&& $this->login<>""){  
   $permisos=busca_filtro_tabla("*","funcionario,permiso,modulo","funcionario.idfuncionario=permiso.funcionario_idfuncionario AND modulo.idmodulo=permiso.modulo_idmodulo AND funcionario.login='".$this->login."' and funcionario.estado=1 AND accion='".$accion."' AND modulo.nombre='".$tabla."'","",$this->conn);
    if($permisos["numcampos"]){
      return(TRUE);
    }
    else 
    return(false);
  }
  else if(isset($tabla) && $tabla<>""){
    return($this->acceso_modulo_perfil($tabla));
  }  
  return(FALSE);
}

/*
<Clase>PERMISO
<Nombre>asignar_usuario
<Parametros>$login1: nuevo login
<Responsabilidades>Asignar un nuevo login al objeto actual
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function asignar_usuario($login1){
$this->login=$login1;
}

/*
<Clase>PERMISO
<Nombre>verifica
<Parametros>$clave: clave a verificar
<Responsabilidades>Verifica que el login y la clave de acceso existan y concuerden
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function verifica($clave){
  global $sql;
  $dato=busca_filtro_tabla("*",DB.".funcionario A","A.login='".$this->login."' AND A.clave='".$clave."'","",$this->conn);
  if($dato["numcampos"]>0)
    return (TRUE);
  return(FALSE);   
}
/*
<Clase>PERMISO
<Nombre>acceso_modulo
<Parametros>$nombre: nombre del modulo
<Responsabilidades> Verificar que el permiso para el usuario actual en el modulo $nombre existen
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function acceso_modulo($nombre){
$dato=busca_filtro_tabla("modulo.nombre","permiso,modulo","permiso.modulo_idmodulo=modulo.idmodulo AND permiso.funcionario_idfuncionario=".$this->idfuncionario." AND modulo.nombre='".$nombre."'","",$this->conn);
//print_r($dato);
if($dato["numcampos"])
  return(TRUE);
return(FALSE);
}

/*
<Clase>PERMISO
<Nombre>acceso_modulo_perfil
<Parametros>$nombre: nombre modulo
<Responsabilidades>Verifica si el usuario actual posee permisos a un modulo con nombre=nombre en permiso_perfil
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function acceso_modulo_perfil($nombre)
{
 $dato=busca_filtro_tabla("modulo.nombre","modulo,permiso_perfil","permiso_perfil.modulo_idmodulo=modulo.idmodulo AND permiso_perfil.perfil_idperfil=".$this->perfil." AND modulo.nombre='".$nombre."'","",$this->conn);
// print_r($dato);
 if($this->acceso_root()){
      return(TRUE);
  }
if($dato["numcampos"])
  {$denegado=$this->permiso_usuario($nombre,'0');
   if($denegado)
     return(FALSE);
   else  
     return(TRUE);
  }
else  
  return($this->acceso_modulo($nombre)); 
}
}

/*
<Clase>
<Nombre>agrega_boton
<Parametros>$nombre: 
            $imagen:
            $dir:
            $destino:
            $texto:
            $acceso:
            $modulo:
<Responsabilidades>verificar que tenga permisos el usuario e insertar el boton correspondiente
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function agrega_boton($nombre,$imagen,$dir,$destino,$texto,$acceso,$modulo,$retorno=0){

global $conn;
$cadena="";
if($modulo!=""){ 
  if($modulo=="formatos")
    {$ayuda = busca_filtro_tabla("f.ayuda",DB.".formato f","f.nombre='".strtolower($nombre)."'","",$conn);     
    }       
  else
    $ayuda = busca_filtro_tabla("A.ayuda",DB.".modulo A","A.nombre='$modulo'","",$conn);
  $ok=FALSE;
  $perm=new PERMISO();
  $ok=$perm->permiso_usuario($modulo,$acceso);
  //echo($ok."hh");
}
else if(isset($_SESSION["LOGIN".LLAVE_SAIA])) 
  $ok=1;
else $ok=0;   
if($ok){  
  if($dir=="" || $dir==NULL)
    $dir="#";
    //||!is_file($imagen)
  if($imagen==""||$imagen==NULL){
      $imagen="botones/configuracion/default.gif";
    }
  if($nombre=="" || $nombre==NULL)
    $nombre ="boton";
  if($destino=="" || $destino==NULL)
    $destino="_self";
  if($texto=="" || $texto==NULL)
    $texto="";
  $alto=65;
  $ancho=65;
  $texto=str_replace("_"," ",$texto);
  $texto=mayusculas($texto);
  $alt=$texto;
  $alt=str_replace("<BR>"," ",$alt);
  $ayuda = busca_filtro_tabla("A.ayuda",DB.".modulo A","A.nombre='$modulo'","",$conn);
  if($nombre=="texto"){
    $cadena='<a title="'.$ayuda[0]["ayuda"].'" href="'.$dir.'" target="'.$destino.'"><span class="phpmaker">'.$texto.'</span></a>&nbsp;&nbsp;';
  }
  else {
    $cadena='<a title="'.$ayuda[0]["ayuda"].'" href="'.$dir.'" target="'.$destino.'"><span class="phpmaker"> <img src="'.$imagen.'"></span></a>&nbsp;&nbsp;';
  }
}

if($retorno){
  return($cadena);
}
else {
  echo($cadena);
  return(TRUE);
}
}

function agrega_boton2($nombre="Boton",$imagen="../../botones/configuracion/default.gif",$dir="#",$destino="_self",$texto="",$acceso="",$modulo="",$click=""){
global $usuactual;
global $conn; 
$acceso=1;  
if($modulo!=""){
  $ok=FALSE;
  $perm=new PERMISO();
  $ok=$perm->acceso_modulo_perfil($modulo);
}
else if(isset($_SESSION["LOGIN".LLAVE_SAIA]))
  $ok=1;
else $ok=0;
if($ok){
  
  $ayuda = busca_filtro_tabla("",DB.".modulo A","lower(A.nombre)=lower('$modulo') and cod_padre=64","",$conn);
  $etiqueta_html="a";
  $parametros=explode("-",$_REQUEST["nodo"]);
  $formato=busca_filtro_tabla("nombre_tabla","formato","idformato like '".$parametros[0]."'","",$conn);
  if(is_numeric($parametros[2]))
  $doc=busca_filtro_tabla("documento_iddocumento",$formato[0]["nombre_tabla"],"id".$formato[0]["nombre_tabla"]."=".$parametros[2],"",$conn);

  if($click!=""){
    $dir="JavaScript:$click";
  }
  else
    $dir="../../".str_replace('@key@',$doc[0][0],$ayuda[0]["enlace"]);
   
  if($nombre=="texto"){
    echo('&nbsp;<'.$etiqueta_html.' href="'.$dir.'" target="'.$destino.'" '.$click.' ><span class="phpmaker"> '.$texto.'</span></'.$etiqueta_html.'>&nbsp;');
  }
  else {

  if($ayuda[0]["imagen"]=="")
    $ayuda[0]["imagen"] =$imagen;
  else
    $ayuda[0]["imagen"] ="../../".$ayuda[0]["imagen"];  
  if($ayuda[0]["etiqueta"]=="")
    $alt =strip_tags(utf8_encode($texto));
  else
    $alt=strip_tags($ayuda[0]["etiqueta"]);
    
  if(strpos($dir,".php")!==false && $destino=="detalles")
    {if(strpos($dir,"?")!==false)
       $dir.="&no_menu=1";
     else
       $dir.="?no_menu=1";
    }  
  echo('&nbsp;<'.$etiqueta_html.' href="'.$dir.'" ><img width=16 height=16 src="'.$ayuda[0]["imagen"].'" alt="'.$alt.'" border="0"  hspace="0" vspace="0" ></'.$etiqueta_html.'>&nbsp;');
  }
  return(TRUE);
}
return(FALSE);
}
/*
<Clase>
<Nombre>menu_pagina
<Parametros>
<Responsabilidades>poner los botones correspondientes en el menu de la pagina
<Notas>se hace segun el usuario tega permisos o no
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function menu_pagina()
{ 
  echo '<table border="0" cellpadding="2" cellspacing="5" align="left"><tr><td align="center">';
  agrega_boton("botones/configuracion","botones/comentarios/ver_documentos.gif\" width='32px' height=\"32px","ordenar.php?accion=mostrar","centro","MOSTRAR","","mostrar_documentos");
  echo '</td><td align="center">'; 
  agrega_boton("botones/configuracion","botones/comentarios/ordenar.gif\" width='32px' height=\"32px","ordenar.php","centro","ORDENAR","","ordenar_pag");
  echo '<td><td align="center">'; 
  agrega_boton("botones/configuracion","botones/comentarios/adicionar.gif\" width='32px' height=\"32px","paginaadd.php?x_enlace=mostrar","centro","ADICIONAR","","adicionar_pag");
  echo '</td><td align="center">';
  agrega_boton("botones/configuracion","imagenes/notas.gif\" width='32px' height=\"32px","comentario_img.php?accion=adicionar","centro","ADICIONAR NOTA","","adicionar_comentario");
  echo '</td><td align="center">';
  agrega_boton("botones/configuracion","imagenes/Modificar.gif\" width='32px' height=\"32px","comentario_img.php","centro","EDITAR NOTA","","administrar_comentario");
  echo '</td><td align="center">';
  agrega_boton("botones/configuracion","imagenes/administrar_notas.gif\" width='32px' height=\"32px","factura/responder.php","centro","RESPONDER","","responder");
echo '</td><td align="center">';
  agrega_boton("botones/configuracion","botones/documentacion/transferir.gif\" width='32px' height=\"32px","transferenciaadd.php?doc=".$_REQUEST["key"],"centro","TRANSFERIR","","transferir");  
  echo '</td><td align="center">';  
  agrega_boton("botones/configuracion","botones/comentarios/volver.gif\" width='32px' height=\"32px","documentoview.php","centro","VOLVER","","detalles");  
  echo '</td></tr></table><br /><br /><br /><br /><br /><br />';
}

/*
<Clase>
<Nombre>prepara_sql
<Parametros>$arreglo: arreglo con las valores
            $separador: caracter que separar�+�los datos
<Responsabilidades>prepara la cadena de los values para el INSERT
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function prepara_sql($arreglo,$separador){
if(is_array($arreglo)){
  $aux_arreglo = array_values($arreglo);
  $values ="'".($aux_arreglo[0])."'";
  for($i=1; $i<count($arreglo); $i++)
    $values .= $separador." '".($aux_arreglo[$i])."'";
  return($values);
  }
return(FALSE);
}

/*
<Clase>
<Nombre>actualizar_funcionarios
<Parametros>
<Responsabilidades>Hacer la actualizacion de funcionarios, dependencias, roles y cargos a partir de la informacion que se recolect�+�de la intranet
                  Tambien invoca a la funcion que carga los permisos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function actualizar_funcionarios(){
global $conn,$sql;
$listado_temporal_funcionario=busca_filtro_tabla("*",DB.".temporal_funcionario","1=1","",$conn);
$conf_admin=busca_filtro_tabla("*",DB.".configuracion A","A.nombre='login_administrador'","",$conn);
$sql="update ".DB.".funcionario set estado=0 WHERE login<>'".$conf_admin[0]["valor"]."'";
ejecuta_sql($sql,$conn);
$sql="update ".DB.".dependencia_cargo set estado=0";
ejecuta_sql($sql,$conn);
$dias=0;
$fecha_correo="";
$envio_correo=FALSE;
$valores_pendientes=busca_filtro_tabla("*",DB.".configuracion A","A.tipo ='pendientes'","",$conn);
for($j=0;$j<$valores_pendientes["numcampos"];$j++)
  switch($valores_pendientes[$j]["nombre"]){
    case "dias_correo_pendientes":
      $dias=$valores_pendientes[$j]["valor"];
    break;
    case "fecha_correo_pendientes":
      $fecha_correo=$valores_pendientes[$j]["valor"];
    break;
    case "enviar_correo_pendientes":
      $envio_correo=$valores_pendientes[$j]["valor"];
    break;
  }
if($envio_correo){
  if($fecha_correo && $dias){
    switch($conn->motor){
      case "MySql": $sql="Select ADDDATE('$fecha_correo',INTERVAL $dias DAY) AS dias";
      break;
      case "Oracle": $sql="Select '$fecha_correo' + $dias AS dias";
    }
    $fecha_envio=ejecuta_filtro($sql,$conn);
    if($fecha_envio["numcampos"]&&$fecha_envio["dias"]<=date('Y-m-d'))
      $envio_correo=TRUE;
    else $envio_correo=FALSE;  
  }
  else $envio_correo=FALSE;
}
for($i=0;$i<$listado_temporal_funcionario["numcampos"];$i++)
{
  $idfuncionario=0; $idcargo=0;$iddependencia=0;$iddependencia_cargo=0;
  $funcionario=busca_filtro_tabla("A.idfuncionario,A.funcionario_codigo",DB.".funcionario A","A.funcionario_codigo=".$listado_temporal_funcionario[$i]["codigo_intranet"],"",$conn);
  $cargo=busca_filtro_tabla("A.idcargo,A.nombre",DB.".cargo A","A.nombre LIKE '".$listado_temporal_funcionario[$i]["cargo"]."'","A.nombre ASC",$conn);
  $dependencia=busca_filtro_tabla("*",DB.".dependencia A","A.tipo=1 AND A.codigo LIKE '".$listado_temporal_funcionario[$i]["cod_centro"]."'","",$conn);
  $padre=busca_filtro_tabla("A.iddependencia",DB.".dependencia A","A.codigo='".$listado_temporal_funcionario[$i]["cod_padre"]."'","",$conn);
  if(!$padre["numcampos"]){
      $padre[0]["iddependencia"]=1;
    }
  if($funcionario["numcampos"]){
    $sql="update ".DB.".funcionario set estado=1,login='".$listado_temporal_funcionario[$i]["login"]."',nombres='".$listado_temporal_funcionario[$i]["nombres"]."',apellidos='".$listado_temporal_funcionario[$i]["apellidos"]."',nit='".trim(str_replace(".","",$listado_temporal_funcionario[$i]["nit"]))."' WHERE idfuncionario=".$funcionario[0]["idfuncionario"];
    ejecuta_sql(utf8_encode($sql),$conn);
    $idfuncionario=$funcionario[0]["idfuncionario"];
  }
  else{
    $sql="INSERT INTO ".DB.".funcionario(funcionario_codigo,login,nombres,apellidos,estado,clave,nit) VALUES('".$listado_temporal_funcionario[$i]["codigo_intranet"]."','".$listado_temporal_funcionario[$i]["login"]."','".$listado_temporal_funcionario[$i]["nombres"]."','".$listado_temporal_funcionario[$i]["apellidos"]."',1,'".$listado_temporal_funcionario[$i]["login"]."','".trim(str_replace(".","",$listado_temporal_funcionario[$i]["nit"]))."')";
    $idfuncionario=ejecuta_sql(utf8_encode($sql),$conn);
    //echo($sql);
  }
 //validacion para enviar alertas al correo de los funcionarios que tienen un documento sin leer durante mas de un dia o un documento sin contestar durante mas de dos dias.
  if($envio_correo){    
     $sql_pendientes = "SELECT DISTINCT ADDDATE(B.fecha,INTERVAL $dias DAY ) AS fecha,B.descripcion,B.numero,A.origen,A.destino FROM ".DB.".buzon_entrada A, ".DB.".documento B WHERE A.archivo_idarchivo NOT IN (SELECT e.archivo_idarchivo FROM buzon_entrada e INNER JOIN buzon_salida s ON e.origen = s.origen AND e.archivo_idarchivo = s.archivo_idarchivo WHERE e.origen =".$listado_temporal_funcionario[$i]["codigo_intranet"]." GROUP BY e.archivo_idarchivo HAVING max( s.fecha ) > max( e.fecha ))AND A.origen =".$listado_temporal_funcionario[$i]["codigo_intranet"]." and A.archivo_idarchivo=B.iddocumento AND A.nombre<>'TERMINADO' AND B.estado <> 'ELIMINADO' ORDER BY fecha";       
     $rs_pendientes = phpmkr_query($sql_pendientes,$conn) or die("Fall�+�la bsqueda" . phpmkr_error() . ' SQL:' . $sql_pendientes);
     while($row = @phpmkr_fetch_array($rs_pendientes)){ //print_r($row);
       $origen = $listado_temporal_funcionario[$i]["codigo_intranet"];
       $fecha = $row["fecha"];
       if($fecha > date("Y-m-d")){   //   die();
         include_once("email/mail.inc.php"); 
          $mail = new MyMailer;
          // Contenido del Correo
          $mail->AddAddress("saia@camarapereira.org.co", $listado_temporal_funcionario[$i]["login"]);
          $mail->Subject = "Recordatorio - Gestion de Archivos - SAIA";
          $funcionario=busca_filtro_tabla("A.nombres,A.apellidos",DB.".funcionario A","A.funcionario_codigo=".$row["destino"],"",$conn);
          $mail->Body    = "Por favor leer los documentos que tiene pendientes en el sistema de Archivos (SAIA): \n\r NUMERO DE RADICADO: ".$row["numero"].".  \n\r RESUMEN: ".$row["descripcion"].". \n\r ENVIADO POR: ".$funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"];        
          if(!$mail->Send()){
             alerta("Ocurrio un error al tratar de enviar el mensaje");
             return(FALSE);
          }        
       }     
     } 
  $sql_pendientes = "Update ".DB.".configuracion SET valor='".date("Y-m-d")."' WHERE nombre='fecha_correo_pendientes'";
  ejecuta_sql($sql_pendientes,$conn);
  }  
  //fin de cambios 
  if($cargo["numcampos"]){
    $idcargo=$cargo[0]["idcargo"];
  }
  else{
    $sql="INSERT INTO ".DB.".cargo(nombre) VALUES('".$listado_temporal_funcionario[$i]["cargo"]."')";
    $idcargo=ejecuta_sql(utf8_encode($sql),$conn);
  }
  if($dependencia["numcampos"]){
    $iddependencia=$dependencia[0]["iddependencia"];
    $sql="UPDATE ".DB.".dependencia SET estado=1,codigo='".$listado_temporal_funcionario[$i]["cod_centro"]."',nombre='".$listado_temporal_funcionario[$i]["dependencia"]."',cod_padre='".$padre[0]["iddependencia"]."', WHERE iddependencia=".$dependencia[0]["iddependencia"];
    ejecuta_sql(utf8_encode($sql),$conn);
  }
  else {
    $sql="INSERT INTO ".DB.".dependencia(nombre,codigo,cod_padre) VALUES('".$listado_temporal_funcionario[$i]["dependencia"]."','".$listado_temporal_funcionario[$i]["cod_centro"]."','".$padre[0]["iddependencia"]."')";
    $iddependencia=ejecuta_sql(utf8_encode($sql),$conn);  
  }
  $dependencia_cargo=busca_filtro_tabla("*",DB.".dependencia_cargo A","A.funcionario_idfuncionario=".$idfuncionario." AND A.cargo_idcargo=".$idcargo." AND A.dependencia_iddependencia=".$iddependencia,"",$conn);    
  if($dependencia_cargo["numcampos"]){
    $sql="UPDATE ".DB.".dependencia_cargo SET estado=1 WHERE iddependencia_cargo=".$dependencia_cargo[0]["iddependencia_cargo"];
    ejecuta_sql(utf8_encode($sql),$conn);
        //echo($sql);
  }
  else{
    $sql="INSERT INTO ".DB.".dependencia_cargo(funcionario_idfuncionario,cargo_idcargo,dependencia_iddependencia,fecha_inicial) VALUES('$idfuncionario','$idcargo','$iddependencia','".date("Y-m-d")."')";
    ejecuta_sql(utf8_encode($sql),$conn);
  }
}
cargar_permisos();
return(TRUE);
}

/*
<Clase>
<Nombre>cargar_permisos
<Parametros>
<Responsabilidades>Actualiza los permisos en la base de datos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/  
function cargar_permisos(){
global $conn;
phpmkr_query("DELETE FROM ".DB.".PERMISO WHERE TIPO='0'",$conn);
phpmkr_query("INSERT INTO ".DB.".PERMISO(MODULO_IDMODULO,FUNCIONARIO_IDFUNCIONARIO,CARACTERISTICA_TOTAL,CARACTERISTICA_GRUPO,CARACTERISTICA_PROPIO, TIPO) SELECT A.MODULO_IDMODULO, B.IDFUNCIONARIO, A.CARACTERISTICA_TOTAL,A.CARACTERISTICA_GRUPO,A.CARACTERISTICA_PROPIO,'0' FROM ".DB.".PERMISO_PERFIL A, ".DB.".FUNCIONARIO B WHERE A.PERFIL_IDPERFIL = B.PERFIL AND B.ESTADO=1",$conn);
}

/*
<Clase>
<Nombre>cargar_permisos_funcionario
<Parametros>
<Responsabilidades>Actualiza los permisos en la base de datos para un funcionario dado
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>

function cargar_permisos_funcionario($idfuncionario){
global $conn;
phpmkr_query("DELETE FROM ".DB.".PERMISO A WHERE FUNCIONARIO_IDFUNCIONARIO=".$idfuncionario." AND TIPO='0'",$conn);
phpmkr_query("INSERT INTO ".DB.".PERMISO(MODULO_IDMODULO,FUNCIONARIO_IDFUNCIONARIO,CARACTERISTICA_TOTAL,CARACTERISTICA_GRUPO,CARACTERISTICA_PROPIO, TIPO) SELECT A.MODULO_IDMODULO, B.IDFUNCIONARIO, A.CARACTERISTICA_TOTAL,A.CARACTERISTICA_GRUPO,A.CARACTERISTICA_PROPIO,'0' FROM ".DB.".PERMISO_PERFIL A, ".DB.".FUNCIONARIO B WHERE A.PERFIL_IDPERFIL = B.PERFIL AND B.ESTADO=1 AND B.idfuncionario=".$idfuncionario,$conn);

}

/*
<Clase>
<Nombre>actualiza_contador
<Parametros>$fecha:
<Responsabilidades>Pone el todos los contadores a uno
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/  

function actualiza_contador($fecha){
global $conn;
global $sql;
  ejecuta_filtro("UPDATE ".DB.".contador SET consecutivo=1",$conn);
  $anio=ejecuta_filtro("SELECT ADDDATE('".$fecha."', INTERVAL 1 YEAR) AS year",$conn);
  ejecuta_filtro("UPDATE ".DB.".configuracion SET valor='".$anio["year"]."' WHERE nombre='fecha_inicio_contador'",$conn);  
}

/*
<Clase>
<Nombre>valida_envio
<Parametros>$llave:
            $default:
            $tipo:
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/  

function valida_envio($llave="",$default,$tipo=3){
if(isset($_GET[$llave])&&$_GET[$llave]&&($tipo==1||$tipo==3))
  return($_GET[$llave]);
else if(isset($_POST[$llave])&&$_POST[$llave]&&($tipo==2||$tipo==3))
  return($_POST[$llave]);  
else return($default);
}

// Recibe el tipo de entidad y el identificador y devuelve el nombre de la entidad Ej: si el tipo es 2 es dependencia, la funcion devolvera el nombre de la dependencia identificada con el $id
/*
<Clase>
<Nombre>nodo_ruta
<Parametros>$tipo: tipo de entidad
            $id: identificador de la entidad
<Responsabilidades> Determinar segun el tipo el nombre de la entidad
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/  
function nodo_ruta($tipo,$id)
{global $conn; 
 switch($tipo)
 {
  case("1"): //funcionario
    $buscar = busca_filtro_tabla("A.nombres, A.apellidos",DB.".funcionario A","A.funcionario_codigo=$id","",$conn);
    if($buscar["numcampos"]>0)
      $nombre = $buscar[0]["nombres"]." ".$buscar[0]["apellidos"];
    else
      $nombre="funcionario no definido";  
  break;
  case("2"): //dependencia
    $buscar = busca_tabla("dependencia",$id);
    if($buscar["numcampos"]>0)
      $nombre = $buscar[0]["nombre"];
    else
      $nombre="Dependencia no definida";        
  break;
  case(3): //ejecutor
  $buscar = busca_tabla("ejecutor",$id);
    if($buscar["numcampos"]>0)
      $nombre = $buscar[0]["nombre"];
    else
      $nombre="Ejecutor no definido";        
  break;
  case(4): //Cargo
   $buscar = busca_tabla("cargo",$id);
    if($buscar["numcampos"]>0)
      $nombre = $buscar[0]["nombre"];
    else
      $nombre="Cargo no definida";        
  break;
  case(5):
  $buscar = busca_tabla("dependencia_cargo",$id);
    if($buscar["numcampos"]>0)
      {
       $nombre = nodo_ruta(4,$buscar[0]["cargo_idcargo"]);
       $nombre .= nodo_ruta(2,$buscar[0]["dependencia_iddependencia"]);       
      }     
    else
      $nombre="Rol no definido";        
  break;  
 }
 return $nombre; 
}

/*
<Clase>
<Nombre>convertir_formato_fecha
<Parametros>$foriginal:
            $fdestino:
            $cadena:
            $soriginal:
            $sdestino:
<Responsabilidades>convierte una fecha al formato indicado
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/  
function convertir_formato_fecha($foriginal,$fdestino,$cadena,$soriginal,$sdestino){
  switch($foriginal){
  case "yyyy".$soriginal."mm".$soriginal."dd":
    $yyy=substr($cadena,0,4);
    $mm=substr($cadena,5,2);
    $dd=substr($cadena,7);
    $cad=convertir_fecha($yyy,$mm,$dd,$sdestino,$fdestino);
  break;
  case "dd".$soriginal."mm".$soriginal."yyyy":
    $dd=substr($cadena,0,2);
    $mm=substr($cadena,3,2);
    $yyy=substr($cadena,6);    
    $cad=convertir_fecha($yyy,$mm,$dd,$sdestino,$fdestino);
  break;    
  }
 return($cad); 
}

/*
<Clase>
<Nombre>convertir_fecha
<Parametros>$y: a�+�; $m: mes; d: dia; $sep: caracter que separa; $formato: formato en que se quiere la fecha
<Responsabilidades> armar la cadena de la fecha con el formato deseado
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/  
function convertir_fecha($y,$m,$d,$sep,$formato){
//echo($y.",".$m.",".$d);
$cad="";
  switch($formato){
    case "yyyy".$sep."mm".$sep."dd":
    alerta("HH");
      $cad=$y.$sep.$m.$sep.$d;
    break;
    case "dd".$sep."mm".$sep."yyyy":
      alerta("HH");
      $cad=$d.$sep.$m.$sep.$y;
    break;
  }
 //echo($cad); 
return($cad);
}

/*
<Clase>
<Nombre>fecha_in
<Parametros>$fecha: fecha que se desea formatear; $motor: de base de datos
<Responsabilidades> Formatear una cadena para insertarla en la base de datos segun el motor que se use
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function fecha_in($fecha, $motor=MOTOR)
{
  switch($motor)
  {
    case "MySql":
      return $fecha;
    case "Oracle":
      return "to_date($fecha,'YYYY-MM-DD HH24:MI:SS')";
  }
}

/*
<Clase>
<Nombre>fecha_out
<Parametros>$columna: nombre de la columna a extraer; $motor: motor de base de datos actual
<Responsabilidades> organizar la cadena para pedir una columna de tipo date a la base de datos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function fecha_out($columna, $motor=MOTOR)
{
  switch($motor)
  {
    case "MySql":
      return $columna;
    case "Oracle":
      return "to_char($columna,'YYYY-MM-DD HH24:MI:SS')";
  }
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
 
function fecha_db($campo, $formato = NULL)
 { global $conn;
   
   if(!$formato)
        $formato="Y-m-d";  // formato por defecto php
  
  if($conn->motor=="Oracle")
    {   
         $reemplazos=array('d'=>'DD','m'=>'MM','y'=>'YY','Y'=>'YYYY','h'=>'HH','H'=>'HH24','i'=>'MI','s'=>'SS','M'=>'MON','yyyy'=>'YYYY'  );
         $resfecha=$formato;
         foreach ($reemplazos as $ph => $mot)
          { // echo $ph," = ",$mot,"<br>","^$ph([-/:])", "%Y\\1","<br>";
            $resfecha=ereg_replace("^$ph([-/:])", "$mot\\1", $resfecha);
            $resfecha=ereg_replace("( )$ph([-/:])", "\\1$mot\\2", $resfecha);
            $resfecha=ereg_replace("^$ph", "$mot", $resfecha);
            $resfecha=ereg_replace("([-/:])$ph([-/:])", "\\1$mot\\2", $resfecha);
            $resfecha=ereg_replace("([-/:])$ph$", "\\1$mot", $resfecha);
            $resfecha=ereg_replace("$ph( )", "$mot\\1", $resfecha); // espacio entre fecha y hora            
          }		     
 	 } 
   	elseif($conn->motor=="MySql")    	  		  
    	 {  //TO_DATE(TO_CHAR(sysdate,'dd/mm/yyyy '))
    	   
            $reemplazos=array('d'=>'%d','m'=>'%m','y'=>'%y','Y'=>'%Y','h'=>'%h','H'=>'%H','i'=>'%i','s'=>'%s','M'=>'%b','yyyy'=>'%Y');
            $resfecha=$formato;
             foreach ($reemplazos as $ph => $mot)
             { // echo $ph," = ",$mot,"<br>","^$ph([-/:])", "%Y\\1","<br>";
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
 
function fecha_db_obtener($campo, $formato = NULL)
 { global $conn;
   
   if(!$formato)
        $formato="Y-m-d";  // formato por defecto php
  
  if($conn->motor=="Oracle")
    {   
         $reemplazos=array('Y'=>'YYYY','yyyy'=>'YYYY','d'=>'DD','M'=>'MON','m'=>'MM','y'=>'YY','H'=>'HH24','h'=>'HH','i'=>'MI','s'=>'SS'  );
         $resfecha=$formato;
         foreach ($reemplazos as $ph => $mot)
          {/*
            $resfecha=ereg_replace("^$ph([-/:])", "$mot\\1", $resfecha);
            $resfecha=ereg_replace("( )$ph([-/:])", "\\1$mot\\2", $resfecha);
            $resfecha=ereg_replace("^$ph", "$mot", $resfecha);
            $resfecha=ereg_replace("([-/:])$ph([-/:])", "\\1$mot\\2", $resfecha);
            $resfecha=ereg_replace("([-/:])$ph$", "\\1$mot", $resfecha);
            $resfecha=ereg_replace("$ph( )", "$mot\\1", $resfecha); // espacio entre fecha y hora        
            */
            $resfecha=ereg_replace("$ph", "$mot", $resfecha);

          } 
          $fsql="TO_CHAR($campo,'$resfecha')";
 		     
 	 } 
   	elseif($conn->motor=="MySql")    	  		  
    	 {  //TO_DATE(TO_CHAR(sysdate,'dd/mm/yyyy '))
    	   
            $reemplazos=array('d'=>'%d','m'=>'%m','y'=>'%y','Y'=>'%Y','h'=>'%h','H'=>'%H','i'=>'%i','s'=>'%s','M'=>'%b','yyyy'=>'%Y');
            $resfecha=$formato;
             foreach ($reemplazos as $ph => $mot)
             { // echo $ph," = ",$mot,"<br>","^$ph([-/:])", "%Y\\1","<br>";
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
 
function fecha_db_almacenar($fecha, $formato = NULL)
 { global $conn;
 
  if(!$fecha || $fecha==""){
    $fecha=date($formato);
  }
  if(!$formato)
        $formato="Y-m-d";  // formato por defecto php
  
  if($conn->motor=="Oracle")
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
   	elseif($conn->motor=="MySql")    	  		  
    	 {  //TO_DATE(TO_CHAR(sysdate,'dd/mm/yyyy '))
    	   
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
 
 function case_fecha($dato,$compara,$valor1,$valor2)
 {
  global $conn;
   if($conn->motor=="Oracle")
   {
    return("decode($dato,$compara,$valor1,$valor2)");    
   }
  elseif($conn->motor=="MySql") 
   {  if($compara="" || $compara==0)
         $compara=">0";       
      return("IF($dato$compara,$valor2,$valor1)");
   } 
  }

 function suma_fechas($fecha1,$cantidad,$tipo="") 
 {
  global $conn;
   if($conn->motor=="Oracle")
   {if($tipo=="" || $tipo=="DAY")
        return "$fecha1+$cantidad"; 
    else if($tipo=="MONTH")
        return "ADD_MONTHS($fecha1,$cantidad)"; 
    else if($tipo=="YEAR")
        return "ADD_MONTHS($fecha1,$cantidad*12)"; 
   }
  elseif($conn->motor=="MySql")   
   { if($tipo=="")
      $tipo='DAY';    
     return "DATE_ADD($fecha1, INTERVAL $cantidad $tipo)";
   }   
 }
 
 function resta_fechas($fecha1,$fecha2)
 {
  global $conn;
   if($conn->motor=="Oracle")
   {if($fecha2 == "")
     $fecha2= "sysdate";    
    return "$fecha1-$fecha2 ";   
   }
  elseif($conn->motor=="MySql")   
   { if($fecha2 == "")
     $fecha2= "CURDATE()";       
     return "DATEDIFF($fecha1,$fecha2)";
   }   
 }
 
 
/*
<Clase>
<Nombre>
<Parametros>
<Responsabilidades> 
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function dbToPdf($nameFile, $tabla,$campo,$idcampo,$conn)
{
require('fpdf.php');
$listado=busca_filtro_tabla(" * ",$tabla,"$campo=$idcampo","pagina",$conn);
if($listado["numcampos"])
{
//Coordenadas X, Y iniciales en las que se ubicar�+�la imagen
define("X0",0.5);
define("Y0",0.3);
//Ancho y alto de la imagen (ajustada a una hoja de tama�+� carta)
define("W",215);
define("H",278.4);
$pag=0;
for($i=0;isset($listado[$i]);$i++)
{
  $path=pathinfo($listado[$i]["ruta"]);
  if($path && is_dir($path["dirname"])){
    if(is_file($path["dirname"]."/".$path["basename"])){
      if($path["extension"]=="jpg"){
      if($pag==0)
        $pdf=new FPDF("P","mm","Letter");
      $pag++;
      $pdf->AddPage();  
      $pdf->Image($listado[$i]["ruta"],X0,Y0,W,H);
      }
    }
  }
}
if($pag>0){
  $pdf->Output($nameFile);
  return(TRUE);
}
}
return(FALSE);
}

/*Modificaciones que se realizan para Almacenar y manejar Sesion*/
function getRealIP(){
   $client_ip=servidor_remoto();
   if( @$_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
   {

      // los proxys van a+�adiendo al final de esta cabecera
      // las direcciones ip que van "ocultando". Para localizar la ip real
      // del usuario se comienza a mirar por el principio hasta encontrar
      // una direcci+�n ip que no sea del rango privado. En caso de no
      // encontrarse ninguna se toma como valor el REMOTE_ADDR

      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);

      reset($entries);
      while (list(, $entry) = each($entries))
      {
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
         {
            // http://www.faqs.org/rfcs/rfc1918.html
            $private_ip = array(
                  '/^0\./',
                  '/^127\.0\.0\.1/',
                  '/^192\.168\..*/',
                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                  '/^10\..*/');

            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);

            if ($client_ip != $found_ip)
            {
               $client_ip = $found_ip;
               break;
            }
         }
      }
   }
   return $client_ip;
}

function almacenar_sesion($exito,$login){
global $conn;
if($login==""){
  $login=usuario_actual("login");
  $id=usuario_actual("id");
}
$iplocal=getRealIP();
$ipremoto=servidor_remoto();
if($iplocal=="" || $ipremoto==""){
  if($iplocal=="")
      $iplocal=$ipremoto;
  else $ipremoto=$iplocal;
}
if(!$exito){
$sql="INSERT INTO ".DB.".log_acceso(iplocal,ipremota,login,exito,fecha) VALUES('$iplocal','$ipremoto','".$login."',0,".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").")";
}
$idsesion=ultima_sesion();
$accion="";
//$sql="";
if($idsesion==""){
  $accion="INSERTA";
}
else {
  $accion="ACTUALIZA";
}

$datos_sesion=datos_sesion();
//if($datos_sesion["ruta"]!=""){
  switch($accion){
    case "INSERTA":
      $sql="INSERT INTO ".DB.".log_acceso(iplocal,ipremota,login,exito,idsesion_php,sesion_php,fecha) VALUES('$iplocal','$ipremoto','".$login."',".$exito.",'".session_id()."','".$datos_sesion["datos"]."',".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").")";
    break;
    case "ACTUALIZA":
      $sql="UPDATE ".DB.".log_acceso A SET A.sesion_php='".$datos_sesion["ruta"]."' WHERE idlog_acceso=".$idsesion;
    break;
  }
//}
//echo($sql);
if($sql!=""){
  $conn->Ejecutar_Sql($sql);
}
else{
  if($datos_sesion["ruta"]=="")
    alerta("Ruta de Sesion, no definida. Por favor comunicarle al Administrador del sistema");
  if($datos_sesion["datos"]=="")
    alerta("Su sesion no fue encontrada. Por favor comunicarle al Administrador del sistema");
}
return("");
}
function datos_sesion(){
$datos=array();
$datos["ruta"]= "";
$datos["datos"] = "";
global $conn;
  //$path_sesion=$conn->Ejecutar_sql("SELECT A.valor FROM ".DB.".configuracion A WHERE A.nombre='ruta_sesion'");
  $path_sesion["numcampos"]=1;
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
  $path_sesion[0]=$ruta_db_superior."../../tmp";
  $archivo_sesion="/sess_".session_id();
//  if($path_sesion["numcampos"]){
		$sess_file = $path_sesion[0].$archivo_sesion;
		$datos["ruta"]= $sess_file;

		if(is_file($datos["ruta"])){
		  $destino=crear_destino($ruta_db_superior."../sesiones/".date("Y-m-d")."/");
		  //alerta($destino.$archivo_sesion);
		  $gestor = file_get_contents ($datos["ruta"]);
/*		  print_r($gestor);
      $contenido = fwrite($gestor, "CASI",filesize($datos["ruta"]));
  */
      //fclose($gestor);
      $archivo_sesion2=$archivo_sesion;
      $i=0;
      while(is_file($destino.$archivo_sesion2.".0k")){
       $i++;
       $archivo_sesion2=$archivo_sesion."_".$i;
      }
		  if(copy($datos["ruta"],$destino.$archivo_sesion2.".0k")){
		    $datos["datos"]=$destino.$archivo_sesion2;
		    return($datos);
		  }
		  else {
        alerta("No se puede guardar la sesion");
        return($datos);
      }
		}
		else{
      //alerta("No se encuentra el archivo de sesion");
    }

    /*if ($fp = @fopen($sess_file, "r")) {
      $datos["datos"]= fread($fp, filesize($sess_file));
      return($datos);
    } else {
      alerta("No cargo la sesion de ".$sess_file);
      return($datos); // Debe devolver "" aqu&iacute;_
    } */

//  }
return ("");
}
function crear_archivo($nombre,$texto=NULL,$modo='wb'){
  global $cont;
  $cont++;
  $path=pathinfo($nombre);

  $ruta_dir=explode("/",$path["dirname"]);
  $cont1=count($ruta_dir);
  if($cont1){
    $ruta=$ruta_dir[0];

    for($i=0;$i<$cont1;$i++){
      if(!is_dir($ruta)){
        if(mkdir($ruta,0777)){
          chmod($ruta,0777);
          if(isset($ruta_dir[$i+1]))
            $ruta.="/".$ruta_dir[$i+1];
        }
        else{
          alerta("Problemas al generar las carpetas");
          return(false);
        }
      }
      else {
        if(isset($ruta_dir[$i+1]))
          $ruta.="/".$ruta_dir[$i+1];
      }
    }
  }
  $f=fopen($nombre,$modo);
  if($f){
    chmod($nombre,0777);
    $texto=str_replace("? >","?".">",$texto);
    if(fwrite($f,$texto,strlen($texto))){
      fclose($f);
      return($nombre);
    }
    else {
      fclose($f);
    }
  }
  else{
    alerta('No se puede crear el archivo: '.$nombre);
  }
  return(false);
}
function crear_destino($destino){
  $arreglo=explode("/",$destino);
  if(is_array($arreglo)){
   $cont=count($arreglo);
   for($i=0;$i<$cont;$i++){
    if(!is_dir($arreglo[$i])){
      if(!mkdir($arreglo[$i],0777)){
        alerta("no es posible crear la carpeta");
        return("");
      }
      else if(isset($arreglo[($i+1)]))
        $arreglo[($i+1)]=$arreglo[$i]."/".$arreglo[($i+1)];
      }
    else if(isset($arreglo[($i+1)]))
        $arreglo[($i+1)]=$arreglo[$i]."/".$arreglo[($i+1)];
    }
  }
 return($destino);
}
function ultima_sesion(){
global $conn;
$iplocal=getRealIP();
$ipremoto=servidor_remoto();
$conexion=$conn->Ejecutar_sql("Select A.idsesion_php FROM ".DB.".log_acceso A WHERE A.iplocal='".$iplocal."' AND A.ipremota='".$ipremoto."' AND fecha_cierre IS NULL ORDER BY A.fecha DESC");
if($conexion["numcampos"]){
 return($conexion[0]["idsesion_php"]);
}
return("");
}

function cerrar_sesion(){
global $conn;
$iplocal=getRealIP();
$ipremoto=servidor_remoto();
$sql="UPDATE ".DB.".log_acceso A SET A.fecha_cierre=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s")." WHERE iplocal='".$iplocal."' AND ipremota='".$ipremoto."' AND fecha_cierre IS NULL AND exito=1";
$conn->Ejecutar_sql($sql);
//alerta("SALIDA SEGURA");
}

function cargar_sesion(){
//////Esta funcion debe recargar los datos de la sesion almacenados en la base de datos
}

function servidor_remoto(){
$client_ip = "unknown";
$client_ip =
   ( !empty($_SERVER['REMOTE_ADDR']) ) ?
      $_SERVER['REMOTE_ADDR']
      :
      ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
         $_ENV['REMOTE_ADDR']
         :
         "unknown" );
return ($client_ip);
}
/*Fin de manejo de sesion*/

function armar_busqueda_sql($campos,$tablas,$where="",$orden="",$tipo_orden="DESC",$group="",$limit_init="",$desp=10){
if(MOTOR=="MySQL"){
  $sql="SELECT ".$campos." FROM ".$tablas;
  if($where !=""){
    $sql.=" WHERE ".$where;
    if($orden!=""){
      $sql.=" ORDER BY ".$orden." ".$tipo_orden;
      if($group!=""){
        $sql.=" GROUP BY ".$group;
      }
    }
  }
  if($limit_ini!=""){
    $sql.=" LIMIT ".$limit_ini.",".$desp;
  }
}
return($sql);
}

/*Funcion que busca todas las dependencias hijas de una dependencia o grupo de dependencias se debe enviar un arreglo en todos los casos*/
/*function dependencias_hijas($dep_base,$retorno){
global $conn,$sql;
array_push($retorno,$dep_base);
$dependencia=busca_filtro_tabla("","dependencia","cod_padre IN(".implode(",",$dep_base).")","",$conn);
if($dependencia["numcampos"]){
  $dep_hijas=extrae_campo($dependencia,"iddependencia","U");
  return(dependencias_hijas($dep_hijas,$retorno));
}
return($retorno);
}
/*Funcion que busca todas las dependencias padre de una dependencia o grupo de dependencias se debe enviar un arreglo en todos los casos

function dependencias_padre($dep_base){
global $conn,$sql;
$retorno=array();
if($dep_base){
  $dependencia=busca_filtro_tabla("","dependencia","iddependencia IN(".implode(",",$dep_base).")","",$conn);
  echo($sql."<br />");
  if($dependencia["numcampos"] && $dependencia[0]["cod_padre"]){
    $cod_padre=extrae_campo($dependencia,"cod_padre","U");
    return(dependencias_padre($cod_padre));
  }
}
array_push($retorno,$dep_base);
return($retorno);
}*/
function cerrar_ventana(){
?>
<script>
  window.close();
</script>
<?php
}
function ejecuta_filtro_tabla($sql2,$conn){
  $retorno=array();
  $rs=$conn->Ejecutar_Sql($sql2) or alerta("Error en Bsqueda de Proceso SQL: $sql2");
  $temp=phpmkr_fetch_array($rs);
  $i=0;
  if($temp){
    array_push($retorno,$temp); 
    $i++;
  }  
  for($temp;$temp=phpmkr_fetch_array($rs);$i++)
   array_push($retorno,$temp );
  $retorno["numcampos"]=$i; 
  phpmkr_free_result($rs);
  return ($retorno);
}

function menu_ordenar($key,$retorno=0)
{global $conn;
 $tipo=busca_filtro_tabla("plantilla","documento","iddocumento=$key","",$conn);
if($tipo[0]["plantilla"]<>"")
  return("");
else
{$texto="";
if($key){
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
$ruta_menu="menu/menu.php?modulo=64&color=black&key=".$key;
$texto= "<div  align='center'>
<iframe src='".$ruta_db_superior.$ruta_menu."' allowtransparency='yes' width='100%' height='55px' border=0 frameborder='0' scrolling='No' >
</iframe>
</div>";
}
if($retorno){
  return($texto);
}
else echo($texto);
}
}

function dirToPdf($nameFile, $dir)
{ 
require_once('html2ps/public_html/fpdf/fpdf.php');
// error("'$nameFile'---------'$dir'");
//Coordenadas X, Y iniciales en las que se ubicar+� la imagen
define("X0",0.5);
define("Y0",0.3);
//Ancho y alto de la imagen (ajustada a una hoja de tama+�o carta)
define("W",215);
define("H",278.4);
if (is_dir($dir)) {
if ($pdir = opendir($dir)) {
$pags=0;
while (($archivo = readdir($pdir)) !== false) {
//si el archivo es un "." o ".." o no es una imagen .jpeg ni .jpg 
if (($archivo=="." || $archivo=="..") || (!eregi(".jpeg",$archivo) && !eregi(".jpg",$archivo)))
continue;
$archivos[] = $archivo;
}
if(isset($archivos)){
sort($archivos);
foreach($archivos as $archivo) {
//creation of the pdf file
if ($pags==0)
$pdf=new FPDF("P","mm","Letter");
$pags++;
$pdf->AddPage();
//adition of an image to a page
$pdf->Image($dir."/".$archivo,X0,Y0,W,H);
//linea de confirmacion:
//echo "este es el archivo: {$archivo} <br>";
}
//creation of the final pdf file
$pdf->Output($nameFile);
closedir($pdir);
return $nameFile;
}
}
else return(FALSE);
}
else return(FALSE);
}
function fecha_actual(){
  return(fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s"));
}
?>

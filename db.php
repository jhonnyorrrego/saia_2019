<?php
require_once("define.php");
require_once("conexion.php");
require_once("sql.php");
if(!isset($_SESSION["LOGIN".LLAVE_SAIA])){
  @session_start();
  @ob_start();
}


if(@$_REQUEST['idfunc'] && !isset($_SESSION["LOGIN".LLAVE_SAIA])){
    $fun=busca_filtro_tabla("login,funcionario_codigo","funcionario","idfuncionario=".$_REQUEST['idfunc'],"",$conn);
    $_SESSION["LOGIN" . LLAVE_SAIA] = $fun[0]['login'];
    $_SESSION["usuario_actual"] = $fun[0]['funcionario_codigo'];

    global $usuactual;
    $usuactual = $fun[0]['login'];
}

//print_r(session_id());
$error=array();
$dat_orig=0;
$sql="";
$conn=NULL;
$conn=phpmkr_db_connect();
//Almacenar la variable del usuario actual
$usuactual=@$_SESSION["LOGIN".LLAVE_SAIA];
if(isset($_SESSION["LOGIN".LLAVE_SAIA])&&$_SESSION["LOGIN".LLAVE_SAIA]){
$_SESSION["usuario_actual"]=usuario_actual("funcionario_codigo");
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
 $sql="insert into digitalizacion(funcionario,documento_iddocumento,accion,justificacion,fecha) values('$usu','$iddoc','$accion','$justificacion',$fecha)" ;
 phpmkr_query($sql,$conn);
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
/*<Clase>
<Nombre>compara_ruta_archivos</Nombre>
<Parametros>$buscado:nombre del archivo</Parametros>
<Responsabilidades>me devuelve la ruta relativa del archivo<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
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
/*<Clase>
<Nombre>leido</Nombre>
<Parametros>$codigo:codigo del funcionario;$llave:id del documento</Parametros>
<Responsabilidades>Marca el documento como leido por la persona que corresponda<Responsabilidades>
<Notas>hace una transferencia del usuario actual para el mismo con el estado LEIDO</Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function leido($codigo,$llave){
global $conn;
	$pendiente = busca_filtro_tabla(fecha_db_obtener("fecha_inicial","Y-m-d H:i:s")." as fecha_inicial","asignacion","documento_iddocumento=".$llave." and llave_entidad=".$codigo,"fecha_inicial DESC",$conn);
	if($pendiente["numcampos"]>0){
		$leido = busca_filtro_tabla("nombre,idtransferencia","buzon_entrada","archivo_idarchivo=$llave and origen=$codigo and nombre='LEIDO' AND fecha >= ".fecha_db_almacenar($pendiente[0]["fecha_inicial"],"Y-m-d H:i:s"),"",$conn);
		if(!$leido["numcampos"]){
		$insertar="insert into buzon_salida(archivo_idarchivo,nombre,fecha,origen,tipo_origen,destino,tipo_destino,tipo)";
		$insertar.=" values(".$llave.",'LEIDO',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",$codigo,1,$codigo,1,'DOCUMENTO')";
		phpmkr_query($insertar, $conn) or error("Fallo la busqueda" . phpmkr_error() . ' SQL buzon_salida:' . $insertar);
		$insertar="insert into buzon_entrada(archivo_idarchivo,nombre,fecha,origen,tipo_origen,destino,tipo_destino,tipo)";
		$insertar.=" values(".$llave.",'LEIDO',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",$codigo,1,".$codigo.",1,'DOCUMENTO')";
		phpmkr_query($insertar, $conn) or error("Fallo la busqueda" . phpmkr_error() . ' SQL buzon_entrada:' . $insertar);
		}
	}else{
		$leido = busca_filtro_tabla("nombre,idtransferencia","buzon_salida","archivo_idarchivo=$llave and destino='$codigo'","fecha desc",$conn);
		if(!$leido["numcampos"] || $leido[0]["nombre"]<>"LEIDO"){
			$insertar="insert into buzon_salida(archivo_idarchivo,nombre,fecha,origen,tipo_origen,destino,tipo_destino,tipo)";
			$insertar.=" values(".$llave.",'LEIDO',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",$codigo,1,$codigo,1,'DOCUMENTO')";
			phpmkr_query($insertar, $conn) or error("Fallo la busqueda" . phpmkr_error() . ' SQL buzon_salida:' . $insertar);
			$insertar="insert into buzon_entrada(archivo_idarchivo,nombre,fecha,origen,tipo_origen,destino,tipo_destino,tipo)";
			$insertar.=" values(".$llave.",'LEIDO',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",$codigo,1,".$codigo.",1,'DOCUMENTO')";
			phpmkr_query($insertar, $conn) or error("Fallo la busqueda" . phpmkr_error() . ' SQL buzon_entrada:' . $insertar);
		}
	}
}
/*<Clase>
<Nombre>limpia_tabla</Nombre>
<Parametros>$tabla: codigo html</Parametros>
<Responsabilidades>limpiar el codigo html, dejar solo las etiquetas estandar<Responsabilidades>
<Notas>solo se permiten ciertas etiquetas en los campos de tipo textarea, aqui se quitan los elementos no permitidos</Notas>
<Excepciones></Excepciones>
<Salida>codigo html aceptado</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function limpia_tabla($tabla)
{ $max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
                   'img'=>array('src'=>1, 'alt'=>1,'width'=>1,'height'=>1),
                   'br'=>array(),
                   'b'=>array(),
                   'em'=>array(),
                   'hr'=>array(),
                   'pagebreak'=>array(),//<!-- pagebreak -->
                   'strong' => array(),
                   'sup' => array(),
                   'sub' => array(),
                   'a' => array('href'=>1, 'target'=>1)
                  );

$tabla=stripslashes($tabla);
$tabla=str_replace('<!-- pagebreak -->','pagebreak',$tabla);
$tabla=kses($tabla, $allowed);
$tabla=str_replace('pagebreak','<!-- pagebreak -->',$tabla);
return($tabla);
}
/*<Clase>
<Nombre>listar_campos_tabla</Nombre>
<Parametros>$tabla:nombre de la tabla</Parametros>
<Responsabilidades>crea una lista con los nombres de los campos de una tabla<Responsabilidades>
<Notas>el nombre de la tabla puede llegar por parametro o por el request</Notas>
<Excepciones></Excepciones>
<Salida>vector con los nombres de los campos de la tabla especificada</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function listar_campos_tabla($tabla=NULL,$tipo_retorno=0)
  {global $conn;   
  	if($tabla==NULL)
      $tabla=$_REQUEST["tabla"];
   if(MOTOR=="MySql"){
      $datos_tabla=$conn->Ejecutar_Sql("DESCRIBE ".$tabla);
	   while($fila=phpmkr_fetch_array($datos_tabla)){// print_r($fila);
        if($tipo_retorno){
            $lista_campos[]=array_map(strtolower,$fila);    
        }   
        else{
            $lista_campos[]=strtolower($fila[0]);
       }
      }   
   		return($lista_campos);
    }
   else if(MOTOR=="Oracle"){
	      $datos_tabla=$conn->Ejecutar_Sql("SELECT column_name AS Field FROM user_tab_columns WHERE table_name='".strtoupper($tabla)."' ORDER BY column_name ASC");
	      $lista_campos=array();
	  	  while($fila=phpmkr_fetch_array($datos_tabla)) {
			  if($tipo_retorno){
                    $lista_campos[]=array_map(strtolower,$fila);    
                }   
                else{
                    $lista_campos[]=strtolower($fila[0]);
               }
	      }
	   	  return($lista_campos);  
	  }
	  else{
	   	return($conn->Busca_Tabla());
	  }
  } 
/*
<Clase>
<Nombre>guardar_lob</Nombre>
<Parametros>$campo:nombre del campo;$tabla:nombre de la tabla;$condicion:condicion de actualización;$contenido:texto a insertar o actualizar;$tipo:puede ser 'texto' o 'archivo';$conn:objeto de conexion;$log:si se debe guardar lo hecho en el log, puede ser 0 o 1</Parametros>
<Responsabilidades>Se encarga de insertar y actualizar los campos de tipo CLOB<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>*/
function guardar_lob($campo,$tabla,$condicion,$contenido,$tipo,$conn,$log=1){
  global $conn;
  $resultado=TRUE;
  if(MOTOR=="Oracle"){
    $sql = "SELECT ".$campo." FROM ".$tabla." WHERE ".$condicion." FOR UPDATE";
    $stmt = OCIParse($conn->Conn->conn, $sql) or print_r(OCIError ($stmt));
    // Execute the statement using OCI_DEFAULT (begin a transaction)
    OCIExecute($stmt, OCI_DEFAULT) or print_r(OCIError ($stmt));
    // Fetch the SELECTed row
    OCIFetchInto($stmt,$row,OCI_ASSOC);
    
	if(!count($row)){  //soluciona el problema del size() & ya no se necesita el emty_clob() en bd en los campos clob NULL, los campos obligatorios siguen dependendiendo de empty_clob() como valor predeterminado.
		oci_rollback($conn->Conn->conn);
		oci_free_statement($stmt);
		$clob_blob='clob';
		if($tipo=='archivo'){
			$clob_blob='blob';
		}		
    	$up_clob="UPDATE ".$tabla." SET ".$campo."=empty_".$clob_blob."() WHERE ".$condicion;
		$conn->Ejecutar_Sql($up_clob);
	    $stmt = OCIParse($conn->Conn->conn, $sql) or print_r(OCIError ($stmt));
	    // Execute the statement using OCI_DEFAULT (begin a transaction)
	    OCIExecute($stmt, OCI_DEFAULT) or print_r(OCIError ($stmt));
	    // Fetch the SELECTed row
	    OCIFetchInto($stmt,$row,OCI_ASSOC);		
	}    
    
    if(FALSE ===$row){
      OCIRollback($conn->Conn->conn);
      alerta("No se pudo modificar el campo.");
      die($sql);
      $resultado=FALSE;
    }
    else{// Now save a value to the LOB
      if($tipo=="texto"){//para campos clob como en los formatos
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
                if ( !$row[strtoupper($campo)]->save(trim((($contenido)))))
                  {  oci_rollback($conn->Conn->conn);
                     $resultado=FALSE;
                  }
                else
                  oci_commit($conn->Conn->conn);
                //*********** guardo el log en la base de datos **********************
                preg_match("/.*=(.*)/", strtolower($condicion), $resultados);
                $llave=trim($resultados[1]);

                if($log)
                  {$sqleve="INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado) VALUES('".usuario_actual("funcionario_codigo")."',to_date('".date('Y-m-d H:i:s')."','YYYY-MM-DD HH24:MI:SS') ,'MODIFICAR', '$tabla', $llave, '0')";

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
        /*if(lower($campo)=="firma")
         $contenido=addslashes($contenido); */
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
 elseif(MOTOR=="MySql")
    {if($tipo=="archivo")
       {$sql="update $tabla set $campo='".addslashes($contenido)."' where $condicion";
        mysqli_query($conn->Conn->conn,$sql);
        // TODO verificar resultado de la insecion $resultado=FALSE;
       }
     elseif($tipo=="texto")
        {$contenido=codifica_encabezado(limpia_tabla($contenido));
         $sql="update $tabla set $campo='".addslashes(stripslashes($contenido))."' where $condicion";
        if($log)
            {preg_match("/.*=(.*)/", strtolower($condicion), $resultados);
             $llave=trim($resultados[1]);
             $anterior=busca_filtro_tabla($campo,$tabla,$condicion,"",$conn);
             $sql_anterior="update $tabla set $campo='".addslashes(stripslashes($anterior[0][0]))."' where $condicion";

             $sqleve="INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado,detalle,codigo_sql) VALUES('".usuario_actual("funcionario_codigo")."','".date('Y-m-d H:i:s')."','MODIFICAR', '$tabla', $llave, '0','".addslashes($sql_anterior)."','".addslashes($sql)."')";
             $conn->Ejecutar_Sql($sqleve);
             $registro=$conn->Ultimo_Insert();
             if($registro)
               {
                $archivo="$registro|||".usuario_actual("funcionario_codigo")."|||".date('Y-m-d H:i:s')."|||MODIFICAR|||$tabla|||0|||".addslashes($sql_anterior)."|||$llave|||".addslashes($sql);
                evento_archivo($archivo);
               }
            }
         mysqli_query($conn->Conn->conn,$sql) or die(mysqli_error($conn->Conn->conn));
        }
    }
  elseif(MOTOR=="SqlServer" || MOTOR=="MSSql" ){
    if($tipo=="archivo"){
      $dato=busca_filtro_tabla("$campo","$tabla","$condicion","",$conn);
		//CODIFICA EL ARCHIVO PARA SER GUARDADO
      $fileData = $contenido;
      $fileData = unpack("H*hex",$fileData);
      $content = "0x" . $fileData['hex'];

      if($dato[0][0]==""){
        $sql="UPDATE ".$tabla." SET ".$campo." .write(convert(varbinary(max),'XXX'),0,NULL) WHERE ".$condicion;
        $conn->ejecutar_sql($sql);
      }
      $sql="UPDATE ".$tabla." SET ".$campo." = ".$content." WHERE ".$condicion;
      $conn->ejecutar_sql($sql);
    }
    elseif($tipo=="texto"){
      $contenido=codifica_encabezado(limpia_tabla($contenido));
      $sql="update $tabla set $campo='".str_replace("'",'"',stripslashes($contenido))."' where $condicion";
      if($log){
        preg_match("/.*=(.*)/", strtolower($condicion), $resultados);
        $llave=trim($resultados[1]);
        $anterior=busca_filtro_tabla("$campo","$tabla","$condicion","",$conn);
        $sql_anterior="update $tabla set $campo='".str_replace("'",'"',stripslashes($anterior[0][0]))."' where $condicion";
        $sqleve="INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado,detalle,codigo_sql) VALUES('".usuario_actual("funcionario_codigo")."','".date('Y-m-d H:i:s')."','MODIFICAR', '$tabla', $llave, '0','".addslashes($sql_anterior)."','".addslashes($sql)."')";
        $conn->Ejecutar_Sql($sqleve);
        $registro=$conn->Ultimo_Insert();
        if($registro){
          $archivo="$registro|||".usuario_actual("funcionario_codigo")."|||".date('Y-m-d H:i:s')."|||MODIFICAR|||$tabla|||0|||".addslashes($sql_anterior)."|||$llave|||".addslashes($sql);
          evento_archivo($archivo);
        }
      }
      if(MOTOR=="SqlServer")
      {sqlsrv_query($conn->Conn->conn,"USE ".$conn->Conn->Db);
       sqlsrv_query($conn->Conn->conn,$sql) or die("consulta fallida ---- $sql ".implode("<br />",sqlsrv_errors()));
      }
      else
        {mssql_query($sql,$conn->Conn->conn) or die("consulta fallida ---- $sql ".implode("<br />",mssql_get_last_message()));
        }
    }
  }
 return($resultado);
}
/*
<Clase>
<Nombre>evento_archivo</Nombre>
<Parametros>$cadena:cadena con los datos que se insertaron en la bd</Parametros>
<Responsabilidades>Guarda en un archivo la copia de los eventos registrados en el log, cada vez que se inserta un registro<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>*/
function evento_archivo($cadena){
  global $conn;
  $max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
  $ruta_db_superior=$ruta="";
  while($max_salida>0){
    if(is_file($ruta."db.php")){
      $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
  }
  /*$ruta_evento=busca_filtro_tabla("valor","configuracion","nombre like 'ruta_evento'","",$conn);

  $nombre=$ruta_db_superior."../".$ruta_evento[0]['valor']."/".DB."_log_".date("Y_m_d").".txt";*/
  $nombre=$ruta_db_superior.RUTA_BACKUP_EVENTO.DB."_log_".date("Y_m_d").".txt";
  if(!@is_file($nombre))
    crear_archivo($nombre);
  $contenido="";
  if(is_file($nombre)){
    $link=fopen($nombre,"ab");
    $contenido=$cadena."*|*";
  }
  else{
    $link=fopen($nombre,"wb");
    $contenido="idevento|||funcionario_codigo|||fecha|||evento|||tabla_e|||estado|||detalle|||registro_id|||codigo_sql*|*".$cadena."*|*";
  }
  fwrite($link,$contenido);
  fclose($link);
}
/*
<Clase>
<Nombre>formato_cargo</Nombre>
<Parametros>$nombre_cargo:texto que corresponde al nombre de un cargo</Parametros>
<Responsabilidades>Formatea con ciertas caracteristicas el texto recibido<Responsabilidades>
<Notas>valida que los números romanos queden en mayuscula sostenida, pero los articulos no, las demás palabras con mayúscula inicial</Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>*/
function formato_cargo($nombre_cargo){
$cargo="";
$pal='';
if($nombre_cargo!='')
  $pal = explode(" ",strtolower($nombre_cargo));
$cant=count($pal);
for($i=0; $i<$cant; $i++){
if($pal[$i]=="del" || $pal[$i]=="de" || $pal[$i]=="y" || $pal[$i]=="en" || $pal[$i]=="al" || $pal[$i]=="los" || $pal[$i]=="a")
$cargo.=$pal[$i]." ";
else if($pal[$i]=="ii" || $pal[$i]=="iii" || $pal[$i]=="iv" || $pal[$i]=="vi" || $pal[$i]=="vii" || $pal[$i]=="ix" || $pal[$i]=="viii")
$cargo.=strtoupper($pal[$i])." ";
else
{
$tilde = array("Á","É","Í","Ó","Ú","Ñ");
$reemplazo = array("{á", "é", "í","ó","ú","ñ");
$pal[$i]= str_replace($tilde, $reemplazo, $pal[$i]);
$cargo.= ucwords($pal[$i])." ";
}
}
return ($cargo);
}


/*
<Clase>
<Nombre>phpmkr_db_connect
<Parametros>$HOST: Equipo en el que se encuentra la base de datos
            $USER: nombre del usuario con el cual se realizar�la conexi�
            $PASS: contraseña del usuario
            $DB: Nombre de la base de datos, o del esquema
            $MOTOR: Motor con el que se realiza la conexion, Oracle o MySql
<Responsabilidades> Establecer una conexión entre la base de datos y la aplicacion
<Notas> Hace uso de las clases SQL y conexion, retornando el objeto SQL inicializado,
        con el cual se pueden ejecutar los queries en la base de datos.
<Excepciones>Error al conectarse con la Base de datos, se debe a que no se encuentra disponible o existe algun error en los par�etros
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function phpmkr_db_connect($HOST=HOST,$USER=USER,$PASS=PASS,$DB=DB,$MOTOR=MOTOR,$PORT=PORT,$BASEDATOS=BASEDATOS)
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
<Responsabilidades>Cerrar la conexi� actual
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
function phpmkr_query($strsql){
global $conn;

	if(!get_magic_quotes_gpc()) // SI NO ESTAN ACTIVADAS LAS MAGIC QUOTES DE PHP ESCAPA LA SECUENCIA SQL
		$strsql = stripslashes($strsql);
	$rs = Null;
	if($conn) {
		$sqleve = "";
		$sql = trim($strsql);
		$sql = str_replace(" =", "=", $sql);
		$sql = str_replace("= ", "=", $sql);
		$accion = strtoupper(substr($sql, 0, strpos($sql, ' ')));
		$llave = 0;
		$tabla = "";
		$string_detalle = "";
		if($accion != "SELECT") {
	        $func = usuario_actual("funcionario_codigo");

		} else {
			$rs = $conn->Ejecutar_Sql($strsql);
		}

		$sqleve = "";
		switch($accion) {
			case ("SELECT"):
				$strsql = htmlspecialchars_decode((($strsql)));
				break;
			case ("INSERT"):

				$values = substr($strsql, strpos("VALUES", strtoupper($strsql) + 6));
				//$rs = $conn->Ejecutar_Sql(htmlspecialchars_decode((($strsql))));
				$rs = $conn->Ejecutar_Sql($strsql);

				$llave = $conn->Ultimo_Insert();
				preg_match("/insert into (\w*\.)*(\w+)/", strtolower($strsql), $resultados);
				if(isset($resultados[2])) {
					$tabla = $resultados[2];
				} else {
					preg_match("/insert all into (\w*\.)*(\w+)/", strtolower($strsql), $resultados);
					if(isset($resultados[2])) {
						$tabla = $resultados[2];
					} else {
						break;
					}
				}
				guardar_evento($strsql, $llave, $tabla, $func, "ADICIONAR");
				break;
			case ('UPDATE'):
				preg_match("/update (\w*\.)*(\w+)/", strtolower($strsql), $resultados);
				$tabla = $resultados[2];
				//preg_match("/where (.+)=(.*)/", strtolower($strsql), $resultados);
				preg_match("/where (.+)=([\w]+|'[\w]+')/", strtolower($strsql), $resultados);
				$llave = trim($resultados[2]);
				$llave = str_replace("'","",$llave);
				$campo_llave = $resultados[1];
				$detalle = busca_filtro_tabla("", $tabla, $campo_llave . "=" . $llave, "", $conn);
				$rs = $conn->Ejecutar_Sql(((($strsql))));
				$detalle2 = busca_filtro_tabla("", $tabla, $campo_llave . "=" . $llave, "", $conn);
				// ************ miro cuales campos cambiaron en la tabla ****************
				$nombres_campos = array();
				if($detalle["numcampos"]) {
					$nombres_campos = array_keys($detalle[0]);
				}
				$cambios = array();
				if($detalle2["numcampos"] && $detalle["numcampos"]) {
					for($i = 0; $i < (count($detalle[0]) / 2); $i++) {
						if($detalle[0][$i] != $detalle2[0][$i])
							$cambios[] = $nombres_campos[($i * 2) + 1] . "='" . codifica_encabezado(html_entity_decode(htmlspecialchars_decode($detalle[0][$i]))) . "'";
					}
				}
				$diferencias = "update $tabla set " . implode(", ", $cambios) . " where " . $campo_llave . "=" . $llave;
				// guardo el evento
				if(count($cambios)) {
					if(!is_numeric($llave)) {
						$llave = $detalle[0]["id" . $tabla];
					}
					guardar_evento($strsql, intval($llave), $tabla, $func, "MODIFICAR", $diferencias);
				}
				break;
			case ('DELETE'):
				preg_match("/delete from (\w*\.)*(\w+)/", strtolower($strsql), $resultados);
				$tabla = $resultados[2];
				//preg_match("/where (.+)=(.*)/", strtolower($strsql), $resultados);
				preg_match("/where (.+)=([\w]+|'[\w]+')/", strtolower($strsql), $resultados);
				$llave = trim($resultados[2]);
				$llave = str_replace("'","",$llave);
				$campo_llave = $resultados[1];
				$detalle = busca_filtro_tabla("", $tabla, $campo_llave . "=" . $llave, "", $conn);
				$rs = $conn->Ejecutar_Sql(htmlspecialchars_decode((($strsql))));
				if($detalle["numcampos"] > 0) {
					$nombres_campos = array_keys($detalle[0]);
					$datos1 = array();
					$datos2 = array();
					for($i = 0; $i < (count($detalle[0]) / 2); $i++) {
						if($detalle[0][$i] != $detalle2[0][$i]) {
							$datos1[] = $nombres_campos[($i * 2) + 1];
							$datos2[] = "'" . codifica_encabezado(html_entity_decode(htmlspecialchars_decode($detalle[0][$i]))) . "'";
						}
					}
					$string_detalle = "insert into $tabla(" . implode(",", $datos1) . ") values(" . implode(",", $datos2) . ")";

					guardar_evento($strsql, $llave, $tabla, $func, "ELIMINAR", $string_detalle);
				}
				break;
			default:
				$rs = $conn->Ejecutar_Sql($strsql);
				break;
		}

		if($accion != "SELECT") {
			phpmkr_free_result($rs);
			if(DEBUGEAR_FLUJOS) {
				error($strsql);
			}
		}

		return $rs;
	}
}


/**
 * @param strsql
 * @param llave
 * @param tabla
 * @param func
 * @param archivo
 */

function guardar_evento($strsql, $llave, $tabla, $func, $accion, $diferencias=null) {
	global $conn;

	$sqleve = "INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado,codigo_sql,detalle) VALUES('" . $func . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",'$accion', '$tabla', $llave, '0','','')";

	$conn->Ejecutar_Sql($sqleve);
	$registro = $conn->Ultimo_Insert();
	if($registro) {
		guardar_lob('codigo_sql', 'evento', "idevento=" . $registro, $strsql, 'texto', $conn, 0);
		if($accion == "MODIFICAR" || $accion == "ELIMINAR") {
			guardar_lob('detalle', 'evento', "idevento=" . $registro, $diferencias, 'texto', $conn, 0);
		}
		if(empty($diferencias)) {
			$diferencias = "NULL";
		}
		$archivo = "$registro|||$func|||" . date('Y-m-d H:i:s') . "|||$accion|||$tabla|||0|||$diferencias|||$llave|||$strsql";
		evento_archivo($archivo);
	}
	//20160915. Actualizar el estado del documento en el ft
	if($tabla == "documento" && $accion == "MODIFICAR") {
		actualizar_estado_formato($llave);
	}
}

function actualizar_estado_formato($iddoc) {
	global $conn;
	$datos_doc = busca_filtro_tabla("", "documento d", "iddocumento=$iddoc", "", $conn);
	if($datos_doc["numcampos"]) {
		$formato = strtolower($datos_doc[0]["plantilla"]);
		$idestado = obtener_estado_documento($iddoc);
		if($idestado) {
			$campos_formato = busca_filtro_tabla("f.idformato, cf.nombre", "formato f join campos_formato cf on f.idformato = cf.formato_idformato", "f.nombre='" . $formato . "' and cf.nombre='estado_documento'", "", $conn);
			//El formato si tiene el campo estado_documento
			if($campos_formato["numcampos"]) {
				$sql1 = "update ft_$formato set estado_documento=$idestado where documento_iddocumento=$iddoc";
				phpmkr_query($sql1) or die($sql1);
			} else {
				//print_r($campos_formato);
			}
		} else {
		    die("No se encontro el estado para el documento $iddoc");
		}
	} else {
	    print_r($datos_doc);
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
function phpmkr_num_fields($rs){
global $conn;
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
function phpmkr_field_type($rs,$pos){
global $conn;
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
function phpmkr_field_name($rs,$pos){
global $conn;
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
function phpmkr_num_rows($rs){
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
function phpmkr_fetch_array($rs){
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
function phpmkr_fetch_row($rs){
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
function phpmkr_free_result($rs){
global $conn;
$conn->liberar_resultado($rs);
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
function phpmkr_insert_id(){
global $conn;
if($conn){
  if($conn->motor=="Oracle"){
  	$evento = $conn->ultimo_insert();
  }
  else{
  	$evento = $conn->ultimo_insert;
  }
  $buscar = busca_filtro_tabla("*","evento","idevento=".$evento,"",$conn);
  if($buscar["numcampos"])
    return $buscar[0]["registro_id"];
  else{
    //alerta(" Error al recuperar id ".$evento);
  }
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
function phpmkr_error(){
global $conn;
if($conn->motor=="MySql"){
  if($conn->error<>"")
    echo  ($conn->error." en \"".$conn->consulta."\"");
}
else if($conn->motor=="Oracle"){
  if($conn->error<>"")
    echo  ($conn->error["message"]." en \"".$conn->consulta."\"");
  }
  else if($conn->motor=="SqlServer" || $conn->motor=="MSSql"){
    if($conn->error<>"")
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
switch ($tabla){
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
else
  $sql.="*";
if($tabla)
  $sql.=" FROM ".$tabla;
if($filtro)
  $sql.=" WHERE ".str_replace('"',"'",$filtro);
if($orden){
  if(substr(strtolower($orden),0,5)=="group")
    $sql.=" ".$orden;
  else
    $sql.=" ORDER BY ".$orden;
}
$sql=htmlspecialchars_decode((($sql)));
$rs=$conn->Ejecutar_Sql($sql);
$temp=phpmkr_fetch_array($rs);
$retorno["sql"]=$sql;
for($i=0;$temp;$temp=phpmkr_fetch_array($rs),$i++)
  array_push($retorno,$temp);
$retorno["numcampos"]=$i;
phpmkr_free_result($rs);
if(DEBUGEAR_FLUJOS && strpos($tabla,'funcionario')===FALSE && strpos($tabla,'evento')===FALSE){
  error(print_r($retorno,true));
}
return($retorno);
}
/*
<Clase>
<Nombre>busca_filtro_tabla
<Parametros>$campos: columnas que se van a seleccionar
            $tabla: Tabla(s) desde la(s) que se va a seleccionar los datos
            $filtro: where de la consulta
            $orden: columna por la que se ordenaran los datos
            $inici: No registro donde inicia la consulta
            $registros:cantidad de registros que deben consultarse
<Responsabilidades>Invocar la busqueda a la base de datos y retornar el resultado de la misma en un arreglo
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function busca_filtro_tabla_limit($campos,$tabla,$filtro,$orden,$inicio,$registros,$conn){
  global $sql,$conn;
  if(!$conn){
    $conn=phpmkr_db_connect();
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
  $sql=htmlspecialchars_decode((($sql)));
  $rs=$conn->Ejecutar_Limit($sql,$inicio,($inicio+$registros),$conn);
  $temp=phpmkr_fetch_array($rs);

  $retorno["sql"]=$sql;

  for($i=0;$temp;$temp=phpmkr_fetch_array($rs),$i++)
    array_push($retorno,$temp);
  $retorno["numcampos"]=$i;
  phpmkr_free_result($rs);
  if(DEBUGEAR_FLUJOS && strpos($tabla,'funcionario')===FALSE){
    error(print_r($retorno,true));
  }
  return($retorno);
}
/*
<Clase>
<Nombre>evento
<Parametros>$tabla: Tabla sobre la que se realiza el evento
            $accion: Tipo de evento que se realiza
            $sql: sentencia que se ejecut�
            $llave: llave primaria del registro sobre el que se realiza la accion
<Responsabilidades>llevar a cabo la accion y registrar el evento en el log
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function evento($tabla,$evento,$strsql,$llave){
global $conn;
$sql = trim($strsql);
$sql = str_replace('','',$sql);
$accion = strtoupper(substr($sql,0,strpos($sql,' ')));
$tabla = "";
$llave=0; $string_detalle="";
if ($accion<>"SELECT")
 $func = usuario_actual("funcionario_codigo");
$strsql=htmlspecialchars_decode((($strsql)));
$rs = $conn->Ejecutar_Sql_Noresult($strsql);
return $rs;
}
/*
<Clase>
<Nombre>ejecuta_sql
<Parametros>$sql: sentencia que se ejecuta, $con: conexion sobre la que se ejecuta la sentencia
<Responsabilidades>Ejecuta una sentencia insert y retorna la llave de lo que acaba de insertar
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function ejecuta_sql($sql){
global $conn;


phpmkr_query($sql,$conn);
$id=phpmkr_insert_id();
if($id>0){
  return($id);
}
else
  return false;
phpmkr_free_result();
}
/*
<Clase>
<Nombre>ejecuta_filtro
<Parametros>$sql: sentencia que se ejecuta, $con: conexion sobre la que se ejecutar�la sentencia
<Responsabilidades>Ejecuta una sentencia insert y retorna la llave de lo que acaba de insertar
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function ejecuta_filtro($sql1,$con){
global $sql;
$sql=$sql1;
$rs=@phpmkr_query($sql,$con);
$resultado["numcampos"]=@phpmkr_num_rows($rs);
if($resultado["numcampos"]){
  $resultado=@phpmkr_fetch_array($rs);
  $resultado["numcampos"]=@phpmkr_num_rows($rs);
}
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
function delimita($cad,$long) {
if( strlen($cad) < $long)
  return($cad);
else
  return(substr($cad,0,$long-3)."<B> ... </B>");
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
switch ($tabla){
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
$rs=phpmkr_query($sql,$conn) or error("Error en Busqueda de Proceso SQL: $sql");
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
/*
<Clase>
<Nombre>extrae_campo</Nombre>
<Parametros>$arreglo:es el arreglo origen, generalmente devuelto por busca_filtro_tabla;$campo: campo a buscar; bandera:parámetro adicionarl U=unico, M=mayusculas, m=minusculas, D=ordenado Descendente</Parametros>
<Responsabilidades>Retorna un arreglo ordenado ascendentemente extrayendo el campo de una matriz que debe tener 2 niveles sacando 1 el campo del segundo nivel esto se utiliza principalmente para retornos tipo BD <Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>*/
function extrae_campo($arreglo,$campo,$banderas="U,M"){
$retorno=array();
for($i=0;$i<$arreglo["numcampos"];$i++){
  $retorno[$i]=$arreglo[$i][$campo];
}
$band=explode(",",$banderas);
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
function sincronizar_carpetas($tipo, $conn) {
	$idimagenes = array();
	$max_salida = 6;
	$ruta_db_superior = $ruta = "";
	while ($max_salida > 0) {
		if (is_file($ruta . "db.php")) {
			$ruta_db_superior = $ruta;
		}
		$ruta .= "../";
		$max_salida--;
	}
	include_once ($ruta_db_superior . "binario_func.php");
	$rutas = array();
	$dir = "";
	$dir2 = "";
	$copiar = 0;
	$peso = 2000000;
	$tabla = "pagina";
	$estado = "";
	$configuracion = busca_filtro_tabla("*", "configuracion A", "A.tipo='ruta' OR A.tipo='imagen' OR A.tipo='peso'", "A.idconfiguracion DESC", $conn);
	for ($i = 0; $i < $configuracion["numcampos"]; $i++) {
		switch($configuracion[$i]["nombre"]) {
			case "ruta_temporal" :
				$dir = $configuracion[$i]["valor"] . "_" . $_SESSION["LOGIN" . LLAVE_SAIA];
				break;
			case "ruta_documentos" :
				$dir2 = $configuracion[$i]["valor"];
				break;
			case "copia" :
				if (is_numeric($configuracion[$i]["valor"]))
					$copia = $configuracion[$i]["valor"];
				else
					$copia = 0;
				break;
			case "genera_pdf" :
				if (is_numeric($configuracion[$i]["valor"])) {
					$pdf = $configuracion[$i]["valor"];
				} else
					$pdf = 0;
				break;
			case "ancho_imagen" :
				if (is_numeric($configuracion[$i]["valor"])) {
					$imgancho = $configuracion[$i]["valor"];
				} else
					$imgancho = 600;
				break;
			case "alto_imagen" :
				if (is_numeric($configuracion[$i]["valor"])) {
					$imgalto = $configuracion[$i]["valor"];
				} else
					$imgalto = 700;
				break;
			case "ancho_miniatura" :
				if (is_numeric($configuracion[$i]["valor"])) {
					$miniatura_ancho = $configuracion[$i]["valor"];
				} else
					$miniatura_ancho = 90;
				break;
			case "alto_miniatura" :
				if (is_numeric($configuracion[$i]["valor"])) {
					$miniatura_alto = $configuracion[$i]["valor"];
				} else
					$miniatura_alto = 120;
				break;
		}
	}
	//Define si se almacena en la BD o en archivos

	$config = busca_filtro_tabla("valor", "configuracion", "nombre='tipo_almacenamiento'", "", $conn);
	if ($config["numcampos"]) {
		$tipo_almacenamiento = $config[0]['valor'];
	} else {// Si no encuentra el registro en configuracion almacena en archivo
		$tipo_almacenamiento = "archivo";
	}

	if ($tipo_almacenamiento == "archivo") {// Se alcenan paginas y miniaturas en la BD
		include_once($ruta_db_superior . "pantallas/lib/librerias_archivo.php");

		if (is_dir($ruta_db_superior . $dir))//ruta_temporal
			$directorio = opendir($ruta_db_superior . $dir);
		else
			$directorio = null;

		if ($directorio) {//ruta_temporal
			$cont = 1;
			$ruta = "";
			$cad = "";
			$cad_temp = "";
			$numero_pagina = "";
			//Aqui toca recorrer la carpeta que se elija como temporal para buscar el listado de las paginas que se van a subir a la base de datos.
			while ($archivo = readdir($directorio)) {
				if ($archivo != "." && $archivo != ".." && !is_dir($archivo))
					$archivos[] = $archivo;
			}
			natsort($archivos);

			foreach ($archivos as $archivo) {
				$estado = "";
				$dir3 = "";
				$ruta = $ruta_db_superior . $dir . "/" . $archivo;
				$path = pathinfo($ruta);
				if ($archivo && $archivo != "." && $archivo != ".." && is_file("$archivo") != "dir" && (strtolower($path['extension']) == 'jpg' || strtolower($path['extension']) == 'jpeg') && @filesize($archivo) <= $peso) {

					$ic = strrpos($path["basename"], "#");
					$fc = strrpos($path["basename"], ")");
					$cad = substr($path["basename"], $ic + 1, $fc - $ic - 1);
					$punto = strrpos($path["basename"], ".");
					$cadpunto = substr($path["basename"], 0, $punto);
					$pag = strrpos($cadpunto, "g");
					$cont = substr($cadpunto, $pag + 1);
					if ($cad == "") {
						$cad = "0";
					}
					$fieldList["id_documento"] = $cad;

					$datos_doc = busca_filtro_tabla("estado," . fecha_db_obtener('fecha', 'Y-m') . " as fecha,iddocumento", "documento", "iddocumento=" . $fieldList["id_documento"], "", $conn);
					$estado = $datos_doc[0]["estado"];
					$fecha = $datos_doc[0]["fecha"];

					$paginas = busca_filtro_tabla("A.pagina,A.ruta", "" . $tabla . " A", "A.id_documento=" . $fieldList["id_documento"], "A.pagina", $conn);
					$numero_pagina = $paginas["numcampos"];

					//Este es el punto donde se puede hacer el cambio de carpeta en cad donde se almacenaran fisicamente las imagenes.
					$ruta_imagenes = ruta_almacenamiento("imagenes");
					$cad2 = $fieldList["id_documento"];
					$formato_ruta = aplicar_plantilla_ruta_documento($cad2);
					$dir3 = $ruta_imagenes . $formato_ruta . "/" . $dir2 . "/";
					//$dir3 = $ruta_imagenes . $estado . "/" . $fecha . "/" . $cad2 . "/" . $dir2 . "/";

					$ruta_dir = $ruta_imagenes. $formato_ruta;
					//$ruta_dir = $ruta_imagenes . $estado . "/" . $fecha . "/" . $cad2;
					crear_destino($dir3);

					if ($numero_pagina != "")
						$numero_pagina = intval($numero_pagina) + 1;
					else
						$numero_pagina = 1;

					if (cambia_tam($ruta, $dir3 . "doc" . $fieldList["id_documento"] . "pag" . $numero_pagina . ".jpg", $imgancho, $imgalto, 1)) {
						@unlink($ruta);
						$ruta2 = $dir3 . "doc" . $fieldList["id_documento"] . "pag" . $numero_pagina . ".jpg";
						$dirminiatura = $ruta_dir . "/miniaturas";
						if (!is_dir($dirminiatura . "/")) {
							if (!mkdir($dirminiatura . "/", 0777)) {
								alerta("Problemas al crear la carpeta " . $dirminiatura . "/" . " de de Imagenes-Miniaturas Por favor Comuniquese con su Administrador");
							}
						}
						chmod($dirminiatura . "/", PERMISOS_CARPETAS);
                        $ruta_min = cambia_tam($ruta2, $dirminiatura . "/doc" . $fieldList["id_documento"] . "pag" . $numero_pagina . ".jpg", $miniatura_ancho, $miniatura_alto, 0);

						$fieldList["imagen"] = preg_replace("%^" . $ruta_db_superior . "%", "", $ruta_min);

						array_push($rutas, $fieldList["id_documento"]);
						$fieldList["ruta"] = preg_replace("%^" . $ruta_db_superior . "%", "", $ruta2);
						$fieldList["pagina"] = $numero_pagina;

						$campo_adicional = "";
						$valor_adicional = "";
						if ($tipo == "pagina") {
							$campo_adicional = ",fecha_pagina";
							$valor_adicional = "," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
						}
						$strsql = "INSERT INTO $tipo(id_documento,imagen,pagina,ruta " . $campo_adicional . ") VALUES (" . $fieldList["id_documento"] . ",'" . $fieldList["imagen"] . "'," . $fieldList["pagina"] . ", '" . $fieldList["ruta"] . "' " . $valor_adicional . ")";
						phpmkr_query($strsql, $conn) or error("PROBLEMAS AL EJECUTAR LA BUSQUEDA de INSERCION" . phpmkr_error() . ' SQL:' . $strsql);
						$idpag = phpmkr_insert_id();
						array_push($idimagenes, $idpag);
						registrar_accion_digitalizacion($fieldList["id_documento"], 'ADICION PAGINA', "Identificador: $idpag, Nombre: " . basename($fieldList["imagen"]));
					} else {
						error("Existen Problemas al Cargar el Archivo: $ruta");
					}
				} else if (is_file($archivo) && filesize($archivo) > $peso) {
					alerta($archivo . " Excede el tamanio permitido! Por Favor comuniquese con el Administrador del Sistema");
				}
				$archivo = readdir($directorio);
			}
			closedir($directorio);
		} //Fin If directorio

		//aqui desarrollo para subir digitalizacion de PDF,DOCX,ETC
		if (is_dir($ruta_db_superior . $dir))//ruta_temporal
			$directorio = opendir($ruta_db_superior . $dir);
		else
			$directorio = null;

		if ($directorio) {//ruta_temporal
			$cont = 1;
			$ruta = "";
			$cad = "";
			$cad_temp = "";
			$numero_pagina = "";
			//Aqui toca recorrer la carpeta que se elija como temporal para buscar el listado de las paginas que se van a subir a la base de datos.
			while ($archivo = readdir($directorio)) {
				if ($archivo != "." && $archivo != ".." && !is_dir($archivo))
					$archivos[] = $archivo;
			}
			natsort($archivos);

			$archivos_anexos=array();
			$extension_image=array('jpg','jpeg');
			$cant=count($archivos);
			for($i=0;$i<$cant;$i++){
				$extension=explode('.',$archivos[$i]);
				$extension=array_map('strtolower', $extension);
				if( !in_array($extension[($cant-1)],$extension_image) ){
					$archivos_anexos[]=$archivos[$i];
					unset($archivos[$i]);
				}
			}
			$archivos=array_values($archivos);
			$archivos_anexos=array_unique($archivos_anexos);
			//$ruta_tem=busca_filtro_tabla("","configuracion","nombre='ruta_temporal'","",$conn);
			$ruta_temporal= $dir;
			foreach ($archivos_anexos as $archivo) {
				$ruta_archivo=$ruta_db_superior.$ruta_temporal.'/'.$archivo;
				if(file_exists($ruta_archivo)){
					$ic = strrpos($archivo, "#");
					$fc = strrpos($archivo, ")");
					$cad = substr($archivo, $ic + 1, $fc - $ic - 1);
                    //No se puede usar $_REQUEST porque la funcion se puede invocar desde un webservice
					if(!empty($cad)) {
						vincular_anexo_documento(intval($cad),$ruta_temporal.'/'.$archivo);
						unlink($ruta_archivo);
					}
				} //fin if file_exist
			} //recorriendo directorio
		} //fin if directorio

	} elseif ($tipo_almacenamiento == "db") {// Se almacena en la base de datos
		if (is_dir($dir))
			$directorio = opendir("$dir");
		else
			$directorio = null;

		if ($directorio) {
			$cont = 1;
			$ruta = "";
			$cad = "";
			$cad_temp = "";
			/// Aqui toca recorrer la carpeta que se elija como temporal para buscar el listado de las paginas que se van a subir a la base de datos.
			$archivo = readdir($directorio);

			while ($archivo) {
				$dir3 = "";
				$ruta = $dir . "/" . $archivo;
				$path = pathinfo($ruta);
				if ($archivo && $archivo != "." && $archivo != ".." && is_file("$archivo") != "dir" && (strtolower($path['extension']) == 'jpg' || strtolower($path['extension']) == 'jpeg') && @filesize($archivo) <= $peso) {
					//cad define el nombre de la organizacion de las carpetas y el criterio de almacenamiento, sin embargo debe ser cambiando luego de definir el codigo del documento
					$ic = strrpos($path["basename"], "#");
					$fc = strrpos($path["basename"], ")");
					$cad = substr($path["basename"], $ic + 1, $fc - $ic - 1);
					$punto = strrpos($path["basename"], ".");
					$cadpunto = substr($path["basename"], 0, $punto);
					$pag = strrpos($cadpunto, "g");
					$cont = substr($cadpunto, $pag + 1);
					if ($cad == "") {
						$cad = "0";
					}
					$fieldList["id_documento"] = $cad;
					$num = busca_filtro_tabla("A.pagina", "" . $tabla . " A", "A.id_documento=" . $fieldList["id_documento"] . " AND pagina=" . $cont, "", $conn);
					if ($num["numcampos"] && $cad_temp == "") {
						$paginas = busca_filtro_tabla("A.pagina,A.ruta", "" . $tabla . " A", "A.id_documento=" . $fieldList["id_documento"], "A.pagina", $conn);
						$paginas_temporales = array();
						for ($h = 0; $h < $paginas["numcampos"]; $h++) {
							$punto2 = strrpos($paginas[$h]["ruta"], ".");
							$cadpunto2 = substr($paginas[$h]["ruta"], 0, $punto2);
							$pag2 = strrpos($cadpunto2, "g");
							$cont2 = substr($cadpunto2, $pag2 + 1);
							array_push($paginas_temporales, $cont2);
							array_push($paginas_temporales, $paginas[$h]["pagina"]);
						}
						sort($paginas_temporales);
						$cont3 = count($paginas_temporales);
						$cad_temp = $paginas_temporales[$cont3 - 1];
					}
					//Este es el punto dode se puede hacer el cambio de carpeta en cad donde se almacenaran fisicamente las imagenes.
					$cad2 = $fieldList["id_documento"];
					$dir3 = "../" . $dir2 . "/" . $cad2 . "/";

					if (!is_dir($dir3)) {
						if (mkdir($dir3, 0777))
							$dir3 = "../" . $dir2 . "/" . $cad2 . "/";
						else
							$dir3 = "../documentos/error/" . $cad2;
					}
					//Me lleva hasta la Ultima pagina del documento.
					if ($cad_temp != "") {
						$cont = intval($cad_temp) + intval($cont);
					}
					if (cambia_tam($ruta, $dir3 . "doc" . $fieldList["id_documento"] . "pag" . $cont . ".jpg", $imgancho, $imgalto, 1)) {
						@unlink($ruta);
						$ruta2 = $dir3 . "doc" . $fieldList["id_documento"] . "pag" . $cont . ".jpg";
						$dirminiatura = "../miniaturas/documentos/";
						if (!is_dir($dirminiatura . $fieldList["id_documento"] . "/")) {
							if (!mkdir($dirminiatura . $fieldList["id_documento"] . "/", PERMISOS_CARPETAS)) {
								alerta("Problemas al crear la carpeta " . $dirminiatura . $fieldList["id_documento"] . "/" . " de de Imagenes-Miniaturas Por favor Comuniquese con su Administrador");
							}
						}
						chmod($dirminiatura . $fieldList["id_documento"] . "/", PERMISOS_CARPETAS);
						$fieldList["imagen"] = cambia_tam($ruta2, $dirminiatura . $fieldList["id_documento"] . "/doc" . $fieldList["id_documento"] . "pag" . $cont . ".jpg", $miniatura_ancho, $miniatura_alto, 0);
						array_push($rutas, $fieldList["id_documento"]);
						$fieldList["ruta"] = $ruta2;
						$fieldList["pagina"] = $cont;

						$descripcion = "MINIATURA_" . $fieldList["id_documento"];
						$idbinario_min = almacena_binario_db($fieldList["imagen"], $descripcion);
						$descripcion = "PAGINA_" . $fieldList["id_documento"];
						$idbinario_pag = almacena_binario_db($fieldList["ruta"], $descripcion);
						if ($idbinario_min && $idbinario_pag) {
							$strsql = "INSERT INTO $tipo(id_documento,idbinario_min,pagina,idbinario_pag,imagen,ruta) VALUES (" . $fieldList["id_documento"] . ",'" . $idbinario_min . "'," . $fieldList["pagina"] . ", '" . $idbinario_pag . "','" . $fieldList["imagen"] . "','" . $fieldList["ruta"] . "')";
							phpmkr_query($strsql, $conn) or error("PROBLEMAS AL EJECUTAR LA B?QUEDA de INSERCION" . phpmkr_error() . ' SQL:' . $strsql);
							$idpag = phpmkr_insert_id();
							array_push($idimagenes, $idpag);
							registrar_accion_digitalizacion($fieldList["id_documento"], 'ADICION PAGINA', "Identificador: $idpag, Nombre: " . basename($fieldList["imagen"]));

						} else {
							alerta("Error al almacenar el archivo Por favor verifique que el archivo sea accesible y este correctamente almacenado");
						}
					} else {
						error("Existen Problemas al Cargar el Archivo: $ruta");
					}
				} else if (filesize($archivo) > $peso) {
					alerta($archivo . " Excede el tamanio permitido! Por Favor comuniquese con el Administrador del Sistema");
				}
				$archivo = readdir($directorio);
			}
			closedir($directorio);
		}
	}

	$config = busca_filtro_tabla("", "configuracion", "nombre='activar_estampado'", "", $conn);
	if ($fieldList["id_documento"] != '' && $config[0]["valor"] == 'TRUE') {
		if (is_file("digital_signed/estampado_tiempo.php")) {
			include_once ("digital_signed/estampado_tiempo.php");
			$retorno = estampar_imagen($idimagenes, $fieldList);
		}
	}

	return (TRUE);
}

function vincular_anexo_documento($iddoc,$ruta_origen,$etiqueta=''){
	global $conn,$ruta_db_superior;
	include_once($ruta_db_superior."anexosdigitales/funciones_archivo.php");
	$ruta_destino=selecciona_ruta_anexos("",$iddoc,'archivo');
	$nombre_extension = basename($ruta_db_superior.$ruta_origen);

	$vector_nombre_extension = explode('.',$nombre_extension);
	$extencion=$vector_nombre_extension[(count($vector_nombre_extension)-1)];
	$nombre_temporal=uniqid().".".$extencion;
	mkdir($ruta_db_superior.$ruta_destino,0777);
	/*$tmpVar = 1;
	while(file_exists($ruta_db_superior.$ruta_destino. $tmpVar . '_' . $nombre_temporal)){
		$tmpVar++;
	}
	$nombre_temporal=$tmpVar . '_' . $nombre_temporal;*/
	if(!copy($ruta_db_superior.$ruta_origen, $ruta_destino.$nombre_temporal)) {
	    return "error al copiar dede: " . $ruta_db_superior.$ruta_origen . " a " . $ruta_destino.$nombre_temporal;
	}

	$data_sql=array();
	$data_sql['documento_iddocumento']=$iddoc;

	$data_sql['ruta']=preg_replace("%^" . $ruta_db_superior . "%", "", $ruta_destino.$nombre_temporal);
	if($etiqueta!=''){
		$data_sql['etiqueta']=$etiqueta;
	}else{
		$data_sql['etiqueta']=$nombre_extension;
	}
	$data_sql['tipo']=$extencion;

	$datos_documento=busca_filtro_tabla("a.formato_idformato,b.idcampos_formato","documento a LEFT JOIN campos_formato b ON a.formato_idformato=b.formato_idformato","b.etiqueta_html='archivo' AND a.iddocumento=".$iddoc,"",$conn);
	$data_sql['formato']=Null;
	$data_sql['campos_formato']=Null;
	if($datos_documento['numcampos']){
		$data_sql['formato']=$datos_documento[0]['formato_idformato'];
		$data_sql['campos_formato']=$datos_documento[0]['idcampos_formato'];
	}
	$tabla="anexos";
	$strsql = "INSERT INTO ".$tabla." (fecha_anexo,"; //fecha_anexo
	$strsql .= implode(",", array_keys($data_sql));
	$strsql .= ") VALUES (".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'";	//fecha_anexo
	$strsql .= implode("','", array_values($data_sql));
	$strsql .= "')";
 	phpmkr_query($strsql,$conn);
	$idanexo=phpmkr_insert_id();


	$data_sql=array();
	$data_sql['anexos_idanexos']=$idanexo;
	$data_sql['idpropietario']=usuario_actual('idfuncionario');
	$data_sql['caracteristica_propio']='lem';
	$data_sql['caracteristica_total']='1';

	$tabla="permiso_anexo";
	$strsql = "INSERT INTO ".$tabla." (";
	$strsql .= implode(",", array_keys($data_sql));
	$strsql .= ") VALUES ('";
	$strsql .= implode("','", array_values($data_sql));
	$strsql .= "')";
	$sql1=$strsql;
	phpmkr_query($sql1);

	return($idanexo);
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
<Responsabilidades>cambiar el tama� de la imagen, generando una nueva de las dimensiones deseadas
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function cambia_tam($nombreorig,$nombredest,$nwidth,$nheight,$tipo=''){
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
function error($cad,$ruta="",$file="",$imprime_cadena=0){
  if(DEBUGEAR){
    if($imprime_cadena){
      echo ($cad."<BR>");
    }
    if($file==""){
      $file=str_replace(CARPETA_SAIA."/saia/","",$_SERVER["PHP_SELF"]);
    }
    if($ruta==""){
      //TODO: Falta validar el contraslash para windows en la ruta del archivo.
      $ruta=$_SERVER["DOCUMENT_ROOT"]."/".CARPETA_SAIA."/errores/".date("Ymd")."_".str_replace(".","_",$_SERVER["REMOTE_ADDR"]).")-(".str_replace("/","-",$file).").txt";
    }
    $size=file_put_contents($ruta,"[".date("Y-m-d H:i:s")."][".$file."]".$cad."\n\r",FILE_APPEND);
  }
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
function abrir_url($location,$target="_blank")
{
  if(!@$_SESSION['radicacion_masiva']){
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
    if(!@$_SESSION['radicacion_masiva']){
        ?>
        <script language="javascript">
        	window.location="<?php print($location);?>";
        </script>
        <?php
        exit();
    }

}
/*
<Clase>
<Nombre>enviar_mensaje</Nombre>
<Parametros>$origen:codigo del funcionario que envía el mensaje;$usuarios:codigos de los funcinarios destinos del mensaje;$mensaje:texto del mensaje;$tipo_envio:'msg'(mensajeria instantanea) o 'e-interno' (correo electrónico)</Parametros>
<Responsabilidades>Envía un mensaje instantáneo o de correo electrónico<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>*/
function enviar_mensaje($correo="",$tipo_usuario='codigo',$usuarios,$asunto="",$mensaje,$anexos=array(),$copia_oculta=0, $iddoc=''){
global $conn;

  $to = array();
	if($tipo_usuario=='codigo'){
		  for($i=0; isset($usuarios[$i])&&$usuarios[$i]; $i++){
	   $funcionario=busca_filtro_tabla("login,email","funcionario","funcionario_codigo='".$usuarios[$i]."'","",$conn);
	   if($funcionario["numcampos"]){
	     if($funcionario[0]["email"]){
	     	array_push($to,$funcionario[0]["email"]);
	     }
	   }
	  }
	}else{
		$cant=count($usuarios);
		for($i=0;$i<$cant;$i++){
			array_push($to,$usuarios[$i]);
		}
	}
 if(count($to)){
	include_once("PHPMaile/class.phpmailer.php");
	include_once("PHPMaile/language/phpmailer.lang-es.php");

	$configuracion_correo=busca_filtro_tabla("valor,nombre,encrypt","configuracion","nombre in('servidor_correo','puerto_servidor_correo','puerto_correo_salida','servidor_correo_salida','correo_notificacion','clave_correo_notificacion','asunto_defecto_correo')","",$conn);
	for($i=0;$i<$configuracion_correo['numcampos'];$i++){
		switch ($configuracion_correo[$i]['nombre']) {
			case 'servidor_correo':
				$servidor_correo=$configuracion_correo[$i]['valor'];
				break;
			case 'puerto_servidor_correo':
				$puerto_servidor_correo=$configuracion_correo[$i]['valor'];
				break;
			case 'puerto_correo_salida':
				$puerto_correo_salida=$configuracion_correo[$i]['valor'];
				break;
			case 'servidor_correo_salida':

				break;
			case 'correo_notificacion':
				$correo_notificacion=$configuracion_correo[$i]['valor'];
				break;
			case 'clave_correo_notificacion':
				if($configuracion_correo[$i]['encrypt']){
					include_once('pantallas/lib/librerias_cripto.php');
					$configuracion_correo[$i]['valor']=decrypt_blowfish($configuracion_correo[$i]['valor'],LLAVE_SAIA_CRYPTO);
				}
				$clave_correo_notificacion=$configuracion_correo[$i]['valor'];
				break;
			case 'asunto_defecto_correo':
				$asunto_defecto_correo=$configuracion_correo[$i]['valor'];
				break;
		}
	}

	switch ($correo) {
		default:
			$usuario_correo=$correo_notificacion;
			$pass_correo=$clave_correo_notificacion;
		break;
	}
 $mail = new PHPMailer ();
 $mail->IsSMTP();
// $mail->SMTPDebug  = 2;
 $mail->Host = $servidor_correo; //secure.emailsrvr.com - mail.rackspace.com
 $mail->Port = $puerto_correo_salida;
 $mail->SMTPAuth = true;
 $mail->Username = $usuario_correo;
 $mail->Password = $pass_correo;
 $mail->FromName = $usuario_correo;

 if($asunto!=""){
		$mail->Subject = $asunto;
	}else{
		$mail->Subject = $asunto_defecto_correo;
	}




  $config = busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","",$conn);
  $admin_saia= busca_filtro_tabla("valor","configuracion","nombre='login_administrador'","",$conn);
  $correo_admin=busca_filtro_tabla("email","funcionario","login='".$admin_saia[0]['valor']."'","",$conn);
  $texto_pie="
  	<table style='border:none; width:100%; font-size:11px;font-family:Roboto,Arial,Helvetica,sans-serif;color:#646464;vertical-align:middle;	padding: 10px;'>
		<tr>
			<td>
				Este email ha sido enviado automáticamente desde SAIA (Sistema de Administración Integral de Documentos y Procesos).
				<br>
				<br>
				Por favor, NO responda a este mail.
				<br>
				<br>
				Para obtener soporte o realizar preguntas, envié un correo electrónico a ".$correo_admin[0]['email']."
			</td>
			<td style='text-align:right;'>
				<img src='".PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/imagenes/saia_gray.png'>
			</td>
		</tr>
	</table>
";


  $inicio_style='
  <div id="fondo" style="   padding: 10px; 	background-color: #f5f5f5;	">

  	<div id="encabezado" style="background-color:'.$config[0]["valor"].';color:white ;  vertical-align:middle;   text-align: left;    font-weight: bold;  border-top-left-radius:5px;   border-top-right-radius:5px;   padding: 10px;">
  		NOTIFICACIÓN - SAIA
  	</div>

  	<div id="cuerpo" style="padding: 10px;background-color:white;">
  		<br>
  		<span style="font-weight:bold;color:'.$config[0]["valor"].';">'.$asunto.'</span>
  		<hr>
  		<br>';

  $fin_style='
  	</div>
  	<div  id="pie" style="font-size:11px;font-family:Roboto,Arial,Helvetica,sans-serif;color:#646464;vertical-align:middle;padding: 10px;">
  		'.$texto_pie.'
  	</div>
  </div>';

 $mensaje=$inicio_style.$mensaje.$fin_style;



 $mail->Body = $mensaje;
 $mail -> IsHTML (true);

 $mail->ClearAllRecipients();
 $mail->ClearAddresses();
 $para=array();

 foreach($to as $fila){
 	if($copia_oculta==1){
 		$mail->AddBCC($fila,$fila);
 	}else{
 		$mail->AddAddress($fila,$fila);
		$para[]=$fila;
	}
 }
 /*
 $mail->AddAddress("soporte@cerok.com","soporte@cerok.com");
 $mail->AddBCC("notificaciones@cerok.com","notificaciones@cerok.com");*/

  if(!empty($anexos)){
  	foreach($anexos as $fila){
  		$mail->AddAttachment($fila);
  	}
   }
   if(!$mail->Send()){
   	return($mail->ErrorInfo);
   }else{
   	if($iddoc){
	   	$radicador_salida=busca_filtro_tabla("","configuracion","nombre LIKE 'radicador_salida'","",$conn);
	    if($radicador_salida["numcampos"]){
	    	$funcionario=busca_filtro_tabla("","funcionario","login LIKE '".$radicador_salida[0]["valor"]."'","",$conn);
	      if($funcionario["numcampos"]){
	        $ejecutores=array($funcionario[0]["funcionario_codigo"]);
	      }
	      else {
	        $ejecutores=array(usuario_actual("funcionario_codigo"));
	      }
	    }
	    if(!count($ejecutores))
	      $ejecutores=array(usuario_actual("funcionario_codigo"));

			$otros["notas"]="'Documento enviado por e-mail por medio del correo: ".$mail->FromName;
		  if(count($para)){
		    $otros["notas"].= " Para :".implode(",",$para);
		  }
		  $otros["notas"].="'";
		  $datos["archivo_idarchivo"]=@$iddoc;
		  $datos["tipo_destino"]=1;
		  $datos["tipo"]="";
		  $datos["nombre"]="DISTRIBUCION";
		  transferir_archivo_prueba($datos,$ejecutores,$otros);
		}
   	return (true);
   }
  }
}

/*
<Clase>
<Nombre>contador
<Parametros>$cad: tipo de contador
<Responsabilidades>Buscar el contador correpondiente y hacer la debida actualizacion
<Notas>
<Excepciones>NO EXISTE UN CONSECUTIVO LLAMADO. Cuando el contador que llega como par�etro no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function contador($iddocumento,$cad){
global $sql, $conn;
	$contador=busca_filtro_tabla("","contador a","a.nombre='".$cad."'","",$conn);
	if(MOTOR=="MySql" || MOTOR=="Oracle"){
		$strsql="CALL sp_asignar_radicado(".$iddocumento.",".$contador[0]["idcontador"].")";
	}elseif(MOTOR=="SqlServer" || MOTOR=="MSSql"){
		$strsql="EXEC sp_asignar_radicado @iddoc=".$iddocumento.", @idcontador=".$contador[0]["idcontador"].";";
	}
  ejecuta_sql($strsql);
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
$cuenta=busca_filtro_tabla("A.consecutivo,A.idcontador","contador A","A.nombre='".$cad."'","",$conn);
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





if(!isset($_SESSION["LOGIN".LLAVE_SAIA])){
  salir(utf8_decode("Su sesi&oacute;n ha expirado, por favor ingrese de nuevo."));
}


if($usuactual<>""){
$dato=busca_filtro_tabla("A.*,A.idfuncionario AS id","funcionario A","A.login='".$usuactual."'","",$conn);

if($dato["numcampos"])
  return($dato[0][$campo]);
else
  salir("No se encuentra el funcionario en el sistema, por favor comuniquese con el administrador");
}
}

/*
<Clase>
<Nombre>salir
<Parametros>$texto: texto que saldr�en pantalla
<Responsabilidades>Sacar la razon de la salida del sistema, redireccionando a la pagina de login
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function salir($texto){
	global $usuactual,$conn;



	if($texto){
		$usuactual="";
		$conn->Conn->Desconecta();
		@session_unset();
		@session_destroy();
		abrir_url(PROTOCOLO_CONEXION.RUTA_PDF."/logout.php?texto_salir=".urlencode($texto),"_top");

	}else{
		$usuactual="";
		$conn->Conn->Desconecta();
		@session_unset();
		@session_destroy();
		abrir_url(PROTOCOLO_CONEXION.RUTA_PDF."/logout.php","_top");
	}
}


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
  $contador=busca_filtro_tabla("*","contador","lower(nombre)=lower('".$tipo_contador."')","",$conn);
  $fieldList["numero"] = 0;
  $fieldList["tipo_radicado"] = $contador[0]["idcontador"];
  $fieldList["estado"] = "'INICIADO'";
  $fieldList["plantilla"] ="''";
  // Field fecha
  $fieldList["fecha"] = fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s');
  $fieldList["fecha_creacion"] = fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s');

  // Field paginas
  $fieldList["paginas"] = 1;
  $strsql = "INSERT INTO documento (";
  $strsql .= implode(",", array_keys($fieldList));
  $strsql .= ") VALUES (";
  $strsql .= implode(",", array_values($fieldList));
  $strsql .= ")";
  $doc = ejecuta_sql($strsql);
  contador($doc,$tipo_contador);
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
	    $flujo: Es el flujo al que esta vinculado la radicacion. Viene desde el editar de la radicacion (documentoedit.php)
<Responsabilidades>Insertar un documento en la base de datos y sus respectivos anexos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function ingresar_documento($doc,$tipo_contador,$arreglo,$destino,$archivos=NULL,$flujo=NULL){
  global $conn;
	$contador=busca_filtro_tabla("*","contador A","A.nombre='".$tipo_contador."'","",$conn);
  $estado=busca_filtro_tabla("estado","documento","iddocumento=$doc","",$conn);
  if($estado[0]["estado"]=="INICIADO")
     $arreglo["estado"] = "'APROBADO'";
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
		$strsql = "UPDATE documento SET ";
		foreach ($arreglo as $key=>$temp) {
		if($temp<>"")
			$strsql .= "$key = $temp, ";
		}
		if (substr($strsql, -2) == ", ") {
			$strsql = substr($strsql, 0, strlen($strsql)-2);
		}
		$sKeyWrk = "" . addslashes($sKey) . "";
		$strsql .= " WHERE iddocumento =". $sKeyWrk;
    phpmkr_query($strsql,$conn);
    registrar_accion_digitalizacion($doc,'LLENADO DATOS');
	 if($archivos<>NULL && $archivos<>"")
      {
       /*  Manejo anterior de los anexos ... cuando el frame ya los almacenaba
       $archivos=explode(",",$archivos);
       foreach($archivos as $nombre)
          {$datos_anexo=explode(";",$nombre);
           $sql="insert into anexos(ruta,documento_iddocumento,tipo) values('anexos/".$datos_anexo[0]."',$sKeyWrk,'".$datos_anexo[1]."')";
           $resultado=evento("ANEXOS","ADICIONAR",$sql,0) or error("PROBLEMAS CON EL ANEXO: $nombre");
          }
       */
       /// Nuevo Procesamiento de anexos ... los anexos seran almacenados en documento edit..

      }
  global $ruta_db_superior;
  include_once($ruta_db_superior."workflow/libreria_paso.php");
  iniciar_flujo($doc,$flujo);
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
    $sql="INSERT INTO ruta(origen,tipo,destino,idtipo_documental,condicion_transferencia,documento_iddocumento,tipo_origen,tipo_destino,obligatorio) VALUES(".$destino[$i]['codigo'].",'ACTIVO',".$destino[$i+1]['codigo'].",".$tipo.",'".$destino[$i]["condicion"]."',".$doc.",".$destino[$i]['tipo'].",".$destino[$i+1]['tipo'].",".$destino[$i]['obligatorio'].")";

    phpmkr_query($sql,$conn) or error("No se puede Generar una Ruta entre los funcionarios ".$destino[$i]['codigo']." y ".$destino[$i+1]['codigo']);
    $idruta=phpmkr_insert_id();
    if($idruta)
    {
      $valores["archivo_idarchivo"]=$doc;
      $valores["nombre"]="'POR_APROBAR'";
      $valores["destino"]="'".codigo_rol($destino[$i]["codigo"],$destino[$i]["tipo"])."'";
      $valores["tipo_destino"]="'".$destino[$i]["tipo"]."'";
      $valores["fecha"]=fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s');
      $valores["origen"]="'".codigo_rol($destino[$i+1]["codigo"],$destino[$i+1]["tipo"])."'";
      $valores["tipo_origen"]="'".$destino[$i+1]["tipo"]."'";
      $valores["tipo"]="'DOCUMENTO'";
      $valores["activo"]=1;
      $valores["ruta_idruta"]=$idruta;
      $campos=implode(",",array_keys($valores));
      $values=implode(",",array_values($valores));
      $sql = "INSERT INTO buzon_entrada($campos) VALUES($values)";
      phpmkr_query($sql,$conn) or error("No se puede Generar una Ruta entre los funcionarios ".$destino[$i]['codigo']." y ".$destino[$i+1]['codigo']);
    }
  }
}
return TRUE;
}
/*
<Clase>
<Nombre>codigo_rol</Nombre>
<Parametros>$id:identificador de funcionario;$tipo:entidad</Parametros>
<Responsabilidades>busca el codigo del funcionario<Responsabilidades>
<Notas>Esta funcion se creo por la actualizacion de roles en SAIA</Notas>
<Excepciones></Excpciones>
<Salida>codigo del funcionario</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function codigo_rol($id,$tipo)
{ global $conn;
  if($tipo==5)
   $cod = busca_filtro_tabla("funcionario_codigo as cod","funcionario,dependencia_cargo","idfuncionario=funcionario_idfuncionario and iddependencia_cargo=$id","",$conn);
  else
   return $id;
  return($cod[0]["cod"]);
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
$temp=busca_filtro_tabla("*","funcionario A",$filtro,"",$conn);
if($temp["numcampos"]==0)
  error("Datos del Funcionario Origen de Dependencia no Existe");
else {
$dorig=$temp[0]['idfuncionario'];
$datorig=busca_filtro_tabla("d.*,c.*,f.*,f.estado AS estado_f,d.estado AS estado_d","dependencia_cargo d, cargo c, funcionario f","d.funcionario_idfuncionario=f.idfuncionario AND c.idcargo=d.cargo_idcargo AND f.idfuncionario='".$dorig."'","f.estado ASC",$conn);

}
}
else if($tipo=="cargo" || $tipo==4){
$datorig=busca_filtro_tabla("A.iddependencia_cargo","dependencia_cargo A","A.cargo_idcargo=$dato AND A.dependencia_iddependencia=".$dependencia,"A.estado",$conn);
if($datorig["numcampos"])
  $datorig=busca_cargo_funcionario(5,$datorig[0]["iddependencia_cargo"],"");
else alerta(codifica_encabezado("No existe nadie en ésta dependencia con el cargo especificado"));
}
else if($tipo=='iddependencia_cargo' || $tipo==5){
  $datorig=busca_filtro_tabla("*,f.estado as estado_f,d.estado as estado_d","dependencia_cargo d,funcionario f,cargo c","dependencia_cargo d,funcionario f,cargo","c.idcargo=d.cargo_idcargo AND f.idfuncionario=d.funcionario_idfuncionario AND d.iddependencia_cargo=".$dato,"f.estado",$conn);
}
else{
    $datorig[0]['iddependencia_cargo']=$dato;
}
    if($temp["numcampos"]){
        $datorig[0]=array_merge((array)$datorig[0],(array)$temp[0]);
    }

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
function alerta($mensaje,$tipo='success',$duraccion=3000){
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_superior_temporal=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_superior_temporal=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
	include_once('librerias_saia.php');
	global $raiz_saia;
	$raiz_saia=$ruta_superior_temporal;
	echo(librerias_notificaciones());

 ?>
<script>
notificacion_saia("<?php echo $mensaje ;?>","<?php echo($tipo); ?>",'',<?php echo($duraccion); ?>);
</script>
<?php
}


/*

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

 * /


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

/*
<Clase>
<Nombre>PERMISO</Nombre>
<Parametros></Parametros>
<Responsabilidades>Busca los permisos de un funcionario con respecto a un modulo<Responsabilidades>
<Notas>Esta clase busca los permisos por funcionario y por perfil</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
class PERMISO {
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
	function PERMISO() {
		global $usuario_actual, $conn;
		if (!isset($_SESSION["LOGIN" . LLAVE_SAIA]))
			salir("La sesi&oacute;n ha expirado, por favor ingrese de nuevo.");
		$this -> login = @$_SESSION["LOGIN" . LLAVE_SAIA];
		$this -> conn = $conn;
		if ($this -> acceso_root()) {
			$this -> idfuncionario = 0;
			$this -> funcionario_codigo = 0;
			$this -> perfil = 1;
			return (TRUE);
}
else {
			$funcionario = busca_filtro_tabla("A.idfuncionario,A.funcionario_codigo,A.perfil", "funcionario A", "A.login='" . $this -> login . "'", "", $this -> conn);
			if ($funcionario["numcampos"]) {
				$this -> idfuncionario = $funcionario[0]["idfuncionario"];
				$this -> funcionario_codigo = $funcionario[0]["funcionario_codigo"];
				$this -> perfil = $funcionario[0]["perfil"];
				return (TRUE);
			}
		}
		if (!isset($_SESSION["LOGIN" . LLAVE_SAIA]))
			salir("No se Puede Encontrar el Funcionario para Permisos");
		else
			alerta("No se Puede Encontrar el Funcionario para Permisos");
		return (FALSE);
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
	function acceso_root() {
		$configuracion = busca_filtro_tabla("A.valor,A.fecha", "configuracion A", "A.tipo='usuario' AND A.nombre='login_administrador'", "", $this -> conn);
		if ($configuracion["numcampos"] && $this -> login == $configuracion[0]["valor"])
			return (TRUE);
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
	function acceso_usuario_documento() {
		global $sql;
		if ($this -> acceso_root()) {
			$this -> acceso_total = "l,a,m,e";
			return (TRUE);
		}
		$acceso = busca_filtro_tabla("*", "funcionario A,permiso B,modulo C", "C.nombre='transferir' AND C.idmodulo=B.modulo_idmodulo AND A.idfuncionario=B.funcionario_idfuncionario AND A.login='" . $this -> login . "'", "", $this -> conn);
		for ($i = 0; $i < $acceso["numcampos"]; $i++) {
			$this -> acceso_propio = $acceso[$i]["caracteristica_propio"];
			$this -> acceso_grupo = $acceso[$i]["caracteristica_grupo"];
			$this -> acceso_total = $acceso[$i]["caracteristica_total"];
		}
		return (TRUE);
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
	function permiso_usuario($tabla, $accion) {
		global $sql;
		$permiso["numcampos"] = 0;
		if ($this -> acceso_root() && $accion == 1) {
			return (TRUE);
		}
		if (isset($tabla) && $tabla <> "" && @$accion <> "" && $this -> login <> "") {
			$permisos = busca_filtro_tabla("*", "funcionario,permiso,modulo", "funcionario.idfuncionario=permiso.funcionario_idfuncionario AND modulo.idmodulo=permiso.modulo_idmodulo AND funcionario.login='" . $this -> login . "' and funcionario.estado=1 AND accion='" . $accion . "' AND modulo.nombre='" . $tabla . "'", "", $this -> conn);
			if ($permisos["numcampos"]) {
				return (TRUE);
    }
    else
				return (false);
  }
  else if(isset($tabla) && $tabla<>""){
			return ($this -> acceso_modulo_perfil($tabla));
		}
		return (FALSE);
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
	function asignar_usuario($login1) {
		$this -> login = $login1;
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
	function verifica($clave) {
		global $sql;
		$dato = busca_filtro_tabla("*", "funcionario A", "A.login='" . $this -> login . "' AND A.clave='" . $clave . "'", "", $this -> conn);
		if ($dato["numcampos"] > 0)
			return (TRUE);
		return (FALSE);
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
	function acceso_modulo($nombre) {
		$dato = busca_filtro_tabla("modulo.nombre", "permiso,modulo", "permiso.modulo_idmodulo=modulo.idmodulo AND permiso.funcionario_idfuncionario=" . $this -> idfuncionario . " AND modulo.nombre='" . $nombre . "'", "", $this -> conn);
		if ($dato["numcampos"])
			return (TRUE);
		return (FALSE);
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
		$dato = busca_filtro_tabla("modulo.nombre", "modulo,permiso_perfil", "permiso_perfil.modulo_idmodulo=modulo.idmodulo AND permiso_perfil.perfil_idperfil in(" . $this -> perfil . ") AND modulo.nombre='" . $nombre . "'", "", $this -> conn);
		if ($this -> acceso_root()) {
			return (TRUE);
		}
if($dato["numcampos"])
  {$denegado=$this->permiso_usuario($nombre,'0');
			if ($denegado)
				return (FALSE);
			else
				return (TRUE);
  }
else
			return ($this -> acceso_modulo($nombre));
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
    {$ayuda = busca_filtro_tabla("f.ayuda","formato f","f.nombre='".strtolower($nombre)."'","",$conn);
    }
  else
    $ayuda = busca_filtro_tabla("A.ayuda","modulo A","A.nombre='$modulo'","",$conn);
  $ok=FALSE;
  $perm=new PERMISO();
  $ok=$perm->acceso_modulo_perfil($modulo,$acceso);

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
  $ayuda = busca_filtro_tabla("A.ayuda","modulo A","A.nombre='$modulo'","",$conn);
  if($nombre=="texto"){
    $cadena='<a title="'.@$ayuda[0]["ayuda"].'" href="'.$dir.'" target="'.$destino.'"><span class="phpmaker">'.$texto.'</span></a>&nbsp;&nbsp;';
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
/*
<Clase>
<Nombre>agrega_boton2</Nombre>
<Parametros>$nombre:tipo de enlace por boton o texto; $imagen:ruta de la imagen para el enlace; $dir:ruta del archivo (href) o accion(javascript); $destino:tipo de frame; $texto:etiqueta que se muestra; $acceso:valor 1 (No se utiliza este parametro);$modulo:nombre del modulo;$click:opcional, sentencias de javascript</Parametros>
<Responsabilidades>Permite el acceso en el sistema de un modulo dependiendo si tiene los permisos<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida>Muestra el enlace o boton para acceder el módulo</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
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

  $ayuda = busca_filtro_tabla("","modulo A","lower(A.nombre)=lower('$modulo') and cod_padre in(64,1043,1044,1045)","",$conn);
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

  if(@$ayuda[0]["imagen"]=="")
    $ayuda[0]["imagen"] =$imagen;
  else
    $ayuda[0]["imagen"] ="../../".$ayuda[0]["imagen"];
  if(@$ayuda[0]["etiqueta"]=="")
    $alt =strip_tags(codifica_encabezado($texto));
  else
    $alt=strip_tags(codifica_encabezado($ayuda[0]["etiqueta"]));

  if(strpos($dir,".php")!==false && $destino=="detalles")
    {if(strpos($dir,"?")!==false)
       $dir.="&no_menu=1";
     else
       $dir.="?no_menu=1";
    }
  echo('&nbsp;<'.$etiqueta_html.' href="'.$dir.'" ><img width=16 height=16 src="'.$ayuda[0]["imagen"].'" alt="'.$alt.'" title="'.$alt.'" border="0"  hspace="0" vspace="0" ></'.$etiqueta_html.'>&nbsp;');
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
            $separador: caracter que separar�los datos
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
  ejecuta_filtro("UPDATE contador SET consecutivo=1",$conn);
  $anio=ejecuta_filtro("SELECT ".suma_fecha($fecha,1,"YEAR")." AS year",$conn);
  ejecuta_filtro("UPDATE configuracion SET valor=".fecha_db_almacenar($anio["year"])." WHERE nombre='fecha_inicio_contador'",$conn);
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
<Parametros>$y: ano; $m: mes; d: dia; $sep: caracter que separa; $formato: formato en que se quiere la fecha
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
    break;
    case "Oracle":
      return "to_date($fecha,'YYYY-MM-DD HH24:MI:SS')";
    break;
    case "SqlServer":
      //20 equivale al estilo de la conversion
      return "CONVERT(datetime,'".$fecha."',20)";
    case "MSSql":
      //20 equivale al estilo de la conversion
      return "CONVERT(datetime,'".$fecha."',20)";
    break;

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
    case "SqlServer":
       //20 equivale al estilo de la conversion
      return "CONVERT(CHAR(19),'".$columna."',20)";
    case "MSSql":
       //20 equivale al estilo de la conversion
      return "CONVERT(CHAR(19),'".$columna."',20)";
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
          	$resfecha=preg_replace('/'.$ph.'/', "$mot", $resfecha);
            /*$resfecha=ereg_replace("^$ph([-/:])", "$mot\\1", $resfecha);
            $resfecha=ereg_replace("( )$ph([-/:])", "\\1$mot\\2", $resfecha);
            $resfecha=ereg_replace("^$ph", "$mot", $resfecha);
            $resfecha=ereg_replace("([-/:])$ph([-/:])", "\\1$mot\\2", $resfecha);
            $resfecha=ereg_replace("([-/:])$ph$", "\\1$mot", $resfecha);
            $resfecha=ereg_replace("$ph( )", "$mot\\1", $resfecha); // espacio entre fecha y hora*/
          }
 	 }
   	elseif($conn->motor=="MySql")
    	 {  //TO_DATE(TO_CHAR(sysdate,'dd/mm/yyyy '))

            $reemplazos=array('d'=>'%d','m'=>'%m','y'=>'%y','Y'=>'%Y','h'=>'%h','H'=>'%H','i'=>'%i','s'=>'%s','M'=>'%b','yyyy'=>'%Y');
            $resfecha=$formato;
             foreach ($reemplazos as $ph => $mot)
             { // echo $ph," = ",$mot,"<br>","^$ph([-/:])", "%Y\\1","<br>";
             	$resfecha=preg_replace('/'.$ph.'/', "$mot", $resfecha);
                /*$resfecha=ereg_replace("^$ph([-/:])", "$mot\\1", $resfecha);
                $resfecha=ereg_replace("( )$ph([-/:])", "\\1$mot\\2", $resfecha);
                $resfecha=ereg_replace("^$ph", "$mot", $resfecha);
         		$resfecha=ereg_replace("([-/:])$ph([-/:])", "\\1$mot\\2", $resfecha);
         		$resfecha=ereg_replace("([-/:])$ph$", "\\1$mot", $resfecha);
         		$resfecha=ereg_replace("$ph( )", "$mot\\1", $resfecha); // espacio entre fecha y hora*/
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
         foreach ($reemplazos as $ph => $mot){
         	$resfecha=preg_replace('/'.$ph.'/', "$mot", $resfecha);
            //$resfecha=ereg_replace("$ph", "$mot", $resfecha);
          }
          $fsql="TO_CHAR($campo,'$resfecha')";

 	 }
   	elseif($conn->motor=="MySql")
    	 {  //TO_DATE(TO_CHAR(sysdate,'dd/mm/yyyy '))

            $reemplazos=array('d'=>'%d','m'=>'%m','y'=>'%y','Y'=>'%Y','h'=>'%h','H'=>'%H','i'=>'%i','s'=>'%s','M'=>'%b','yyyy'=>'%Y');
            $resfecha=$formato;
             foreach ($reemplazos as $ph => $mot)
             { // echo $ph," = ",$mot,"<br>","^$ph([-/:])", "%Y\\1","<br>";
             	$resfecha=preg_replace('/'.$ph.'/', "$mot", $resfecha);
             	/*$resfecha=preg_replace('/'.$ph.'/', "$mot", $resfecha);
                $resfecha=ereg_replace("^$ph([-/:])", "$mot\\1", $resfecha);
                $resfecha=ereg_replace("( )$ph([-/:])", "\\1$mot\\2", $resfecha);
                $resfecha=ereg_replace("^$ph", "$mot", $resfecha);
         		$resfecha=ereg_replace("([-/:])$ph([-/:])", "\\1$mot\\2", $resfecha);
         		$resfecha=ereg_replace("([-/:])$ph$", "\\1$mot", $resfecha);
         		$resfecha=ereg_replace("$ph( )", "$mot\\1", $resfecha); // espacio entre fecha y hora*/
             }
         $fsql="DATE_FORMAT($campo,'$resfecha')";
    	 }
    elseif($conn->motor=="SqlServer"||$conn->motor=="MSSql"){
      //solo se relacionan los principales si se requiere de cualquier otro se debe adicionar al switch
      switch($formato){
        case 'Y-m-d H:i:s':
          $fsql="CONVERT(CHAR(19),".$campo.",120) ";
        break;
        case 'Y-m-d H:i':
          $fsql="CONVERT(CHAR(16),".$campo.",20)";
        break;
        case 'H:i:s':
          $fsql="CONVERT(CHAR(8),".$campo.",108)";
        break;
        case 'h:i:s':
          $fsql="SUBSTRING(CONVERT(CHAR(20),".$campo.",100),12,20)";
        break;
        case 'd/m/Y-H:i:s':
          $fsql="CONVERT(CHAR(255),".$campo.",103)+'-'+SUBSTRING(CONVERT(CHAR(20),".$campo.",100),12,20)";
        break;
        default:
          //deafault Y-m-d Standar
           $fsql=" CONVERT(VARCHAR(10), ".$campo.", 120) ";
        break;
      }
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

 if(is_object($fecha)){
   $fecha=$fecha->format($formato);
 }

  if(!$fecha || $fecha==""){
    $fecha=date($formato);
  }
  if(!$formato)
        $formato="Y-m-d";  // formato por defecto php

  if($conn->motor=="Oracle")
    {
    		
    	$mystring = $fecha;
		$findme   = 'TO_DATE';
		$pos = strpos($mystring, $findme);
		if ($pos === false) {
         $reemplazos=array('M'=>'MON','H'=>'HH24','d'=>'DD','m'=>'MM','Y'=>'YYYY','y'=>'YY','h'=>'HH','i'=>'MI','s'=>'SS','yyyy'=>'YYYY' );
         $resfecha=$formato;
         foreach ($reemplazos as $ph => $mot)
          { // echo $ph," = ",$mot,"<br>","^$ph([-/:])", "%Y\\1","<br>";
          	$resfecha=preg_replace('/'.$ph.'/', "$mot", $resfecha);
          	/*$resfecha=ereg_replace("^$ph([-/:])", "$mot\\1", $resfecha);
          	$resfecha=ereg_replace("( )$ph([-/:])", "\\1$mot\\2", $resfecha);
            $resfecha=ereg_replace("([-/:])$ph([-/:])", "\\1$mot\\2", $resfecha);
            $resfecha=ereg_replace("([-/:])$ph$", "\\1$mot", $resfecha);
            $resfecha=ereg_replace("$ph( )", "$mot\\1", $resfecha); // espacio entre fecha y hora*/
          }

	   	$fsql="TO_DATE('$fecha','$resfecha')";

		}ELSE{
			$fsql=$fecha;
		}
		
 	 }
   	elseif($conn->motor=="MySql")
    	 {  //TO_DATE(TO_CHAR(sysdate,'dd/mm/yyyy '))

    	$mystring = $fecha;
		$findme   = 'DATE_FORMAT';
		$pos = strpos($mystring, $findme);
		if ($pos === false) {            $reemplazos=array('d'=>'%d','m'=>'%m','y'=>'%y','Y'=>'%Y','h'=>'%H','H'=>'%H','i'=>'%i','s'=>'%s','M'=>'%b','yyyy'=>'%Y'  );
            $resfecha=$formato;
             foreach ($reemplazos as $ph => $mot)
             { // echo $ph," = ",$mot,"<br>","^$ph([-/:])", "%Y\\1","<br>";
             	$resfecha=preg_replace('/'.$ph.'/', "$mot", $resfecha);
                /*$resfecha=ereg_replace("^$ph([-/:])", "$mot\\1", $resfecha);
                $resfecha=ereg_replace("( )$ph([-/:])", "\\1$mot\\2", $resfecha);
         		$resfecha=ereg_replace("([-/:])$ph([-/:])", "\\1$mot\\2", $resfecha);
         		$resfecha=ereg_replace("([-/:])$ph$", "\\1$mot", $resfecha);
         		$resfecha=ereg_replace("$ph( )", "$mot\\1", $resfecha); // espacio entre fecha y hora*/
             }

    	 	$fsql="DATE_FORMAT('$fecha','$resfecha')";
		}else{
			$fsql=$fecha;
		}	
    	 }
  elseif($conn->motor=="SqlServer"||$conn->motor=="MSSql"){
      //solo se relacionan los principales si se requiere de cualquier otro se debe adicionar al switch
      switch($formato){
        case 'Y-m-d H:i:s':
          $fsql="CONVERT(datetime,'".$fecha."',20)";
        break;
        case 'Y-m-d H:i':
          $fsql="CONVERT(datetime,'".$fecha."',20)";
        break;
        case 'H:i:s':
          $fsql="CONVERT(time,'".$fecha."',20)";
        break;
       	case 'd-m-y':
          $fsql=" CONVERT(datetime, '".$fecha."', 3) ";
        break;
        default:
          //deafault Y-m-d Standar
           $fsql="CONVERT(datetime,'".$fecha."',20)";
        break;
      }

    }
    	 return $fsql;

} // Fin Funcion fecha_db_almacenar
/*<Clase>
<Nombre>case_fecha</Nombre>
<Parametros>$dato:nombre del campo;$compara:valor con el que se va a comparar;$valor1:valor a mostrar si la comparacion da verdadero;$valor2:valor a devolver si la comparacion da falso</Parametros>
<Responsabilidades>Crea la cadena Sql requerida para el enmascaramiento de los datos<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida>Cadena Sql</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
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
  elseif($conn->motor=="SqlServer" || $conn->motor=="MSSql")
   {  if($compara="" || $compara==0)
         $compara=">0";
      return("CASE WHEN $dato$compara THEN $valor2 ELSE $valor1 END");
   }
  }
/*<Clase>
<Nombre>suma_fechas</Nombre>
<Parametros>$fecha1:fecha inicial;$cantidad:cantidad de tiempo a sumarle;$tipo:tipo de medida de tiempo usada 'DAY','YEAR','MONTH'</Parametros>
<Responsabilidades>Crea la cadena sql que se necesita para sumar cierta cantidad de tiempo a una fecha determinada<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida>Cadena Sql</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
 function suma_fechas($fecha1,$cantidad,$tipo="")
 {
  global $conn;
   if($conn->motor=="Oracle"){
    if($tipo=="HOUR"){
      return "$fecha1+($cantidad/24)";
    }
    if($tipo=="" || $tipo=="DAY")
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
  elseif($conn->motor=="SqlServer" ||$conn->motor=="MSSql")
   { if($tipo=="")
      $tipo='DAY';
     return "DATEADD($tipo,$cantidad,$fecha1)";
   }
 }
/*<Clase>
<Nombre>resta_fechas</Nombre>
<Parametros>$fecha1:fecha inicial;$fecha2:fecha a restar</Parametros>
<Responsabilidades>Crea la cadena Sql para calcular el numero de dias de diferencia entre dos fechas<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida>Cadena Sql</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
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
   elseif($conn->motor=="SqlServer" || $conn->motor=="MSSql")
   { if($fecha2 == "")
     $fecha2= "CURRENT_TIMESTAMP";
     return "DATEDIFF(DAY,$fecha2,$fecha1)";
   }
 }
 /*<Clase>
<Nombre>resta_horas</Nombre>
<Parametros>$fecha1:fecha inicial;$fecha2:fecha a restar</Parametros>
<Responsabilidades>Crea la cadena para calcular el numero de horas de diferencia entre dos fechas<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function resta_horas($fecha1,$fecha2)
 {
  global $conn;
   if($conn->motor=="Oracle")
   {if($fecha2 == "")
     $fecha2= "sysdate";
    return "($fecha1-$fecha2)*24";
   }
  elseif($conn->motor=="MySql")
   { if($fecha2 == "")
     $fecha2= "CURDATE()";
     return "timediff($fecha1,$fecha2)";
   }
  elseif($conn->motor=="SqlServer" ||$conn->motor=="MSSql")
   { if($fecha2 == "")
     $fecha2= "CURRENT_TIMESTAMP";
     return "DATEDIFF(HOUR,$fecha2,$fecha1)";
   }


 }

/*<Clase>
<Nombre>fecha_actual</Nombre>
<Parametros></Parametros>
<Responsabilidades>Crea la cadena SQL para calcular la fecha actual (hoy)<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida>Fecha y Hora Actual en la funcion SQL respectiva</Salida>
<Pre-condiciones>debe estar definido el motor de base de datos<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function fecha_actual($fecha1,$fecha2){
global $conn;
if($conn->motor=="Oracle")
  return "sysdate";
elseif($conn->motor=="MySql")
   return "CURDATE()";
elseif($conn->motor=="SqlServer" || $conn->motor=="MSSql")
   return "CONVERT(CHAR(10),CURRENT_TIMESTAMP,20)";
}
///Recibe la fecha inicial y la fecha que se debe controlar o fecha de referencia, si tiempo =1 es que la fecha iniicial esta por encima ese tiempo de la fecha de control ejemplo si fecha_inicial=2010-11-11 y fecha_control=2011-12-11 quiere decir que ha pasado 1 año , 1 mes y 0 dias desde la fecha inicial a la de control
function compara_fechas($fecha_control,$fecha_inicial){
global $conn;
if(!strlen($fecha_control)){
    $fecha_control = date('Y-m-d');
 }
 if(MOTOR=='MSSql' || MOTOR=='SqlServer'){
 	$resultado=ejecuta_filtro_tabla("SELECT ".resta_fechas("'".$fecha_control."'","'".$fecha_inicial."'")." AS diff",$conn);
 }
 else{
 	$resultado=ejecuta_filtro_tabla("SELECT ".resta_fechas("'".$fecha_control."'","'".$fecha_inicial."'")." AS diff FROM dual",$conn);
 }
 return($resultado);
 // separamos en partes las fechas
 $array_inicial = date_parse($fecha_inicial );
 $array_actual = date_parse($fecha_control);
 $anos =  $array_actual["year"] - $array_inicial["year"]; // calculamos años
 $meses = $array_actual["month"] - $array_inicial["month"]; // calculamos meses
 $dias =  $array_actual["day"] - $array_inicial["day"]; // calculamos días
 //ajuste de posible negativo en $días
if ($dias<0){
  --$meses;
  if($meses<0){
    $anos--;
    $meses=$meses + 12;
    if($array_actua["month"]==1)
      $mes_actual=12;
    else
      $mes_actual=($array_actual["month"]-1);
  }
  $mes = mktime( 0, 0, 0, $mes_actual,1, $array_actual["year"]  );
  $dias=$dias + date('t',$mes);
}
if($anos<0){
  $tiempo=1;
  $anos=abs($anos);
}
else{
  $tiempo=0;
}
return(array("year"=>$anos,"month"=>$meses,"day"=>$dias,"tiempo"=>$tiempo));
}
/*<Clase>
<Nombre>dbToPdf</Nombre>
<Parametros>$nameFile:nombre del archivo a crear;$tabla:nombre de la tabla;$campo:nombre del campo;$idcampo:valor del campo;$conn:objeto de conexion</Parametros>
<Responsabilidades>Crea un pdf con las paginas escaneadas de un documento<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida>Si tiene paginas devuelve true de lo contrario false</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function dbToPdf($nameFile, $tabla,$campo,$idcampo,$conn){
require('fpdf.php');
$listado=busca_filtro_tabla(" * ",$tabla,"$campo=$idcampo","pagina",$conn);
if($listado["numcampos"]){
  //Coordenadas X, Y iniciales en las que se ubicar la imagen
  define("X0",0.5);
  define("Y0",0.3);
  //Ancho y alto de la imagen (ajustada a una hoja de tamaño  carta)
  define("W",215);
  define("H",278.4);
  $pag=0;
  for($i=0;isset($listado[$i]);$i++){
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
/*<Clase>
<Nombre>getRealIP</Nombre>
<Parametros></Parametros>
<Responsabilidades>Busca la ip real de la maquina cliente<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida>Ip real</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
/*Modificaciones que se realizan para Almacenar y manejar Sesion*/
function getRealIP(){
if( @$_SERVER['HTTP_X_FORWARDED_FOR'] != '' ){
  $client_ip=servidor_remoto();
  // los proxys van añadiendo al final de esta cabecera
  // las direcciones ip que van "ocultando". Para localizar la ip real
  // del usuario se comienza a mirar por el principio hasta encontrar
  // una dirección ip que no sea del rango privado. En caso de no
  // encontrarse ninguna se toma como valor el REMOTE_ADDR
  $entries = preg_split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
  reset($entries);
  while (list(, $entry) = each($entries)){
    $entry = trim($entry);
    if(preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) ){
      $private_ip = array(
        '/^0\./',
        '/^127\.0\.0\.1/',
        '/^192\.168\..*/',
        '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
        '/^10\..*/'
      );
      $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
      if ($client_ip != $found_ip){
        $client_ip = $found_ip;
        break;
      }
    }
  }
}
else{
  $client_ip=servidor_remoto();
}
return $client_ip;
}
/*<Clase>
<Nombre>almacenar_sesion</Nombre>
<Parametros>$exito:variable que indica si el logueo tuvo exito o no;$login:login del usuario que intenta loguearse</Parametros>
<Responsabilidades>Guarda en la bd el registro de los intentos de ingreso a saia<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function almacenar_sesion($exito,$login){
global $conn;
$datos=array();
if($login==""){
  $login=usuario_actual("login");
  $id=usuario_actual("id");
  $idfun_intentetos=usuario_actual("idfuncionario");
}
$iplocal=getRealIP();
$ipremoto=servidor_remoto();
if($iplocal=="" || $ipremoto==""){
  if($iplocal=="")
      $iplocal=$ipremoto;
  else $ipremoto=$iplocal;
}
if(!$exito){
	$intentos=busca_filtro_tabla("intento_login, idfuncionario, estado","funcionario a","a.login='".$login."'","",$conn);
	if($intentos["numcampos"] && $intentos[0]["estado"]!=0){//Desarrollo de validacion de intentos al loguearse
		if(!$intentos[0]["intento_login"])$consecutivo=1;
		else $consecutivo=$intentos[0]["intento_login"]+1;
		$sql2="UPDATE funcionario SET intento_login=".$consecutivo." WHERE idfuncionario=".$intentos[0]["idfuncionario"];
		$conn->Ejecutar_Sql($sql2);
		$configuracion=busca_filtro_tabla("","configuracion a","a.nombre='intentos_login'","",$conn);
		if($consecutivo>=$configuracion[0]["valor"]){
			$correo_admin=busca_filtro_tabla("", "configuracion a", "a.nombre='correo_administrador'", "", $conn);
			$sql3="INSERT INTO lista_negra_acceso(login,iplocal,ipremota,fecha)VALUES('".$login."', '".$iplocal."', '".$ipremoto."', ".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").")";
			$conn->Ejecutar_Sql($sql3);
			$sql4="UPDATE funcionario SET estado='0' WHERE idfuncionario=".$intentos[0]["idfuncionario"];
			$conn->Ejecutar_Sql($sql4);
			//alerta("Usuario inactivado por exceso de intentos. Favor comunicarse con el administrador");
			$datos["mensaje"]="Usuario inactivado por exceso de intentos. Favor comunicarse con el administrador ".$correo_admin[0]["valor"];
		}
	}
  $sql="INSERT INTO log_acceso(iplocal,ipremota,login,exito,fecha) VALUES('$iplocal','$ipremoto','".$login."',0,".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").")";
}
else{
	$sql2="UPDATE funcionario SET intento_login=0 WHERE idfuncionario=".$idfun_intentetos;
	$conn->Ejecutar_Sql($sql2);
}
$idsesion=ultima_sesion();
$accion="";
if($idsesion==""){
  $accion="INSERTA";
}
else {
  $accion="ACTUALIZA";
}
$datos_sesion=datos_sesion();
switch($accion){
  case "INSERTA":
    $sql="INSERT INTO log_acceso(iplocal,ipremota,login,exito,idsesion_php,sesion_php,fecha) VALUES('$iplocal','$ipremoto','".$login."',".$exito.",'".session_id()."','".$datos_sesion["datos"]."',".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").")";
  break;
  case "ACTUALIZA":
    $sql="UPDATE log_acceso A SET A.sesion_php='".$datos_sesion["ruta"]."' WHERE A.idlog_acceso=".$idsesion;
  break;
}
if($sql!=""){
  $conn->Ejecutar_Sql($sql);
}
else{
  if($datos_sesion["ruta"]=="")
    alerta("Ruta de Sesion, no definida. Por favor comunicarle al Administrador del sistema");
  if($datos_sesion["datos"]=="")
    alerta("Su sesion no fue encontrada. Por favor comunicarle al Administrador del sistema");
}
return($datos);
}
/*<Clase>
<Nombre>datos_sesion</Nombre>
<Parametros></Parametros>
<Responsabilidades>Crea una copia del archivo de sesion en la carpeta sesiones<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function datos_sesion(){
global $conn;
return ("");
/*$datos=array();
$datos["ruta"]= "";
$datos["datos"] = "";
$path_sesion["numcampos"]=1;
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
$path_sesion[0]=session_save_path();
$archivo_sesion="/sess_".session_id();
$sess_file = $path_sesion[0].$archivo_sesion;
$datos["ruta"]= $sess_file;
if(is_file($datos["ruta"])){
  $destino=crear_destino($ruta_db_superior."../sesiones/".date("Y-m-d")."/");
  $gestor = file_get_contents ($datos["ruta"]);
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
    //alerta("No se puede guardar la sesion");
    return($datos);
  }
}
else{
  //alerta("No se encuentra el archivo de sesion");
}
*/
}
/*<Clase>
<Nombre>crear_archivo</Nombre>
<Parametros>$nombre:nombre del archivo a crear;$texto: texto que se va a copiar dentro del archivo;$modo:modo de apertura del archivo</Parametros>
<Responsabilidades>Crea un archivo con cierto texto dentro<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function crear_archivo($nombre,$texto=NULL,$modo='wb'){
global $cont;
$cont++;
//echo("Creando Archivo ".$nombre);
$path=pathinfo($nombre);
$ruta_dir=explode("/",$path["dirname"]);
$cont1=count($ruta_dir);
if($cont1){
  $ruta=$ruta_dir[0];
  for($i=0;$i<$cont1;$i++){
    if(!is_dir($ruta)){
      if(mkdir($ruta,PERMISOS_CARPETAS)){
        chmod($ruta,PERMISOS_CARPETAS);
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
  chmod($nombre,PERMISOS_ARCHIVOS);
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
/*<Clase>
<Nombre>crear_destino</Nombre>
<Parametros>$destino:estructura de carpetas a crear</Parametros>
<Responsabilidades>Crea un conjunto de carpetas con cierta jerarquia<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function crear_destino($destino){
  $arreglo=explode("/",$destino);
  if(is_array($arreglo)){
   $cont=count($arreglo);
   for($i=0;$i<$cont;$i++){
    if(!is_dir($arreglo[$i])){
      chmod($arreglo[$i-1],PERMISOS_CARPETAS);
      if(!mkdir($arreglo[$i],PERMISOS_CARPETAS)){
        alerta("no es posible crear la carpeta ".$destino);
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
/*<Clase>
<Nombre>ultima_sesion</Nombre>
<Parametros></Parametros>
<Responsabilidades>Busca la ultima sesion sin cerrar hecha desde cierta ip<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function ultima_sesion(){
global $conn;
$iplocal=getRealIP();
$ipremoto=servidor_remoto();
$conexion=$conn->Ejecutar_sql("Select A.idsesion_php FROM log_acceso A WHERE A.iplocal='".$iplocal."' AND A.ipremota='".$ipremoto."' AND fecha_cierre IS NULL AND A.exito=1 ORDER BY A.fecha DESC");
if($conexion->num_rows){
 $dato=$conn->sacar_fila();
 return($dato["idsesion_php"]);
}
return("");
}
/*<Clase>
<Nombre>cerrar_sesion</Nombre>
<Parametros></Parametros>
<Responsabilidades>Guarda la fecha de cierre del ultimo logue exitoso desde cierto equipo<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function cerrar_sesion(){
global $conn;
$iplocal=getRealIP();
$ipremoto=servidor_remoto();
$sql="UPDATE log_acceso SET fecha_cierre=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s")." WHERE iplocal='".$iplocal."' AND ipremota='".$ipremoto."' AND fecha_cierre IS NULL AND exito=1";
$conn->Ejecutar_sql($sql);
}
/*<Clase>
<Nombre>cerrar_sesiones_activas</Nombre>
<Parametros>$login</Parametros>
<Responsabilidades>Guarda la fecha de cierre del ultimo logueo<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function cerrar_sesiones_activas($login){
global $conn;
$sql="UPDATE log_acceso SET fecha_cierre=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s")." WHERE fecha_cierre IS NULL AND exito=1 AND login='".$login."'";
$conn->Ejecutar_sql($sql);
}

/*<Clase>
<Nombre>cargar_sesion</Nombre>
<Parametros></Parametros>
<Responsabilidades>Esta funcion debe recargar los datos de la sesion almacenados en la base de datos<Responsabilidades>
<Notas>No se utiliza</Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function cargar_sesion(){
return;
}
/*<Clase>
<Nombre>servidor_remoto</Nombre>
<Parametros></Parametros>
<Responsabilidades><Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function servidor_remoto(){
$client_ip = "unknown";
$client_ip =
(!empty($_SERVER['REMOTE_ADDR']) ) ?
  $_SERVER['REMOTE_ADDR']:
  (( !empty($_ENV['REMOTE_ADDR']) ) ?
    $_ENV['REMOTE_ADDR']:
     "unknown" );
return ($client_ip);
}
/*Fin de manejo de sesion*/
/*
<Clase>
<Nombre>cerrar_ventana</Nombre>
<Parametros></Parametros>
<Responsabilidades>Cierra ventana del navegador<Responsabilidades>
<Notas>javascript</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function cerrar_ventana(){
?>
<script>
  window.close();
</script>
<?php
}
/*<Clase>
<Nombre>ejecuta_filtro_tabla</Nombre>
<Parametros>$sql2:sentencia sql;$conn:objeto de conexion</Parametros>
<Responsabilidades>Ejecuta una sentencia sql y devuelve un vector con los datos encontrados<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase> */
function ejecuta_filtro_tabla($sql2,$conn){
  $retorno=array();
  $rs=$conn->Ejecutar_Sql($sql2) or alerta("Error en Busqueda de Proceso SQL: $sql2");
  $temp=phpmkr_fetch_array($rs);
  $i=0;
  if($temp){
    array_push($retorno,$temp);
    $i++;
  }
  for($temp;$temp=phpmkr_fetch_array($rs);$i++)
    array_push($retorno,$temp );
  $retorno["numcampos"]=$i;
  $retorno["sql"]=$sql2;
  phpmkr_free_result($rs);
  return ($retorno);
}
/*<Clase>
<Nombre>menu_ordenar</Nombre>
<Parametros>$key:id del documento;$retorno:indica si se hace un retun(1), o un echo (0);$exp:id del expediente</Parametros>
<Responsabilidades>Imprime los iconos del menu intermedio de los documentos que no son formatos<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function menu_ordenar($key,$retorno=0,$exp=0){
global $conn;
if($key)
$tipo=busca_filtro_tabla("plantilla","documento","iddocumento=$key","",$conn);
if(@$tipo[0]["plantilla"]=="" || @$_REQUEST["mostrar_menu"]){
  $texto="";
  if($key){
    $max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
    $ruta_db_superior=$ruta="";
    while($max_salida>0){
      if(is_file($ruta."db.php")){
        $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
      }
      $ruta.="../";
      $max_salida--;
    }
    $ruta_menu="menu/menu.php?modulo=64&color=black&key=".$key."&exp=$exp";
    $texto= "<div  align='center'>
    <iframe src='".$ruta_db_superior.$ruta_menu."' allowtransparency='yes' width='100%' height='55px' border=0 frameborder='0' scrolling='No' >
    </iframe>
    </div>";
  }
  if($retorno){
    return($texto);
  }
  else
    echo($texto);
}
else{
  return("");
}
}
/*<Clase>
<Nombre>dirToPdf</Nombre>
<Parametros>$nameFile:nombre del archivo a crear;$dir: carpeta que contiene las imagenes</Parametros>
<Responsabilidades>Crea un pdf con las imagenes jpg de la carpeta especificada<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function dirToPdf($nameFile, $dir){
require_once('html2ps/public_html/fpdf/fpdf.php');
//Coordenadas X, Y iniciales en las que se ubicará la imagen
define("X0",0.5);
define("Y0",0.3);
//Ancho y alto de la imagen (ajustada a una hoja de tamaño carta)
define("W",215);
define("H",278.4);
if(is_dir($dir)) {
  if ($pdir = opendir($dir)) {
    $pags=0;
    while (($archivo = readdir($pdir)) !== false) {
      //si el archivo es un "." o ".." o no es una imagen .jpeg ni .jpg
      //if (($archivo=="." || $archivo=="..") || (!eregi(".jpeg",$archivo) && !eregi(".jpg",$archivo)))
      if (($archivo=="." || $archivo=="..") || (!preg_match("/.jpeg/i",$archivo) && !preg_match("/.jpg/i",$archivo)))
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
      }
      //creation of the final pdf file
      $pdf->Output($nameFile);
      closedir($pdir);
      return $nameFile;
    }
  }
  else
    return(FALSE);
}
else
  return(FALSE);
}

function ruta_almacenamiento($tipo,$raiz=1) {

	$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
	$ruta_db_superior=$ruta="";
	while($max_salida>0){
	  if(is_file($ruta."db.php")){
	    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	  }
	  $ruta.="../";
	  $max_salida--;
	}

	if($raiz){
	    $ruta_raiz=$ruta_db_superior;
	}else{
	    $ruta_raiz='';
	}


	switch($tipo){
	  case 'archivos':
	    crear_destino($ruta_db_superior.RUTA_ARCHIVOS);
	    return($ruta_raiz.RUTA_ARCHIVOS);
	  break;
	  case 'pdf':
	    crear_destino($ruta_db_superior.RUTA_PDFS);
	    return($ruta_raiz.RUTA_PDFS);
	  break;
	  case 'imagenes':
	    crear_destino($ruta_db_superior.RUTA_IMAGENES);
	    return($ruta_raiz.RUTA_IMAGENES);
	  break;
	  case 'versiones':
	    crear_destino($ruta_db_superior.RUTA_VERSIONES);
	    return($ruta_raiz.RUTA_VERSIONES);
	  break;
	}
}

function limpiar_cadena_sql($cadena){
  switch(MOTOR){
    case 'SqlServer':
      return('RTRIM(LTRIM(lower('.$cadena.')))');
    break;
	case 'MSSql':
      return('RTRIM(LTRIM(lower('.$cadena.')))');
    break;
    default:
      return('trim(lower('.$cadena.'))');
    break;
  }
}
/*Se debe enviar la cadena completa si es una cadena de texto la que se debe concatenar se deben adicionar las comillas simples ' */
function concatenar_cadena_sql($arreglo_cadena){
  $cadena_final='';
  switch(MOTOR){
    case 'SqlServer':
      return(implode("+",$arreglo_cadena));
    break;
		case 'MSSql':
      return(implode("+",$arreglo_cadena));
    break;
    case 'Oracle':
	    return(implode("||",$arreglo_cadena));
		break;    
    default:
      if(@$arreglo_cadena[($i+1)]==""){
        return($arreglo_cadena[0]);
      }
      $cant=count($arreglo_cadena);
      for($i=0;$i<$cant;$i++){
        if($i>0){
          $cadena_final.=",";
        }
        $cadena_final.="CONCAT(".$arreglo_cadena[$i];
        if(@$arreglo_cadena[($i+2)]==""){
          $cadena_final.=",".$arreglo_cadena[($i+1)];
          $i++;
        }
      }
      for(;$i>1;$i--){
        $cadena_final.=')';
      }
      return($cadena_final);
    break;
  }
}

function obtener_reemplazo($fun_codigo=0,$tipo=0){
  global $conn;
  //$fun_codigo= funcionario_codigo del usuario a consultar
  //$tipo=0 para validar contra antiguo y 1 para validar contra nuevo
  $retorno=array();
  $retorno['exito']=0;
  if($tipo){
    $reemplazo=busca_filtro_tabla("nuevo,idreemplazo_saia","reemplazo_saia","antiguo=".$fun_codigo." and estado=1","",$conn);
  }else{
    $reemplazo=busca_filtro_tabla("antiguo,idreemplazo_saia","reemplazo_saia","nuevo=".$fun_codigo." and estado=1","",$conn);
  }
  if($reemplazo['numcampos']){
    $retorno['exito']=1;
    $retorno['funcionario_codigo']=extrae_campo($reemplazo,0);
    $retorno['idreemplazo']=extrae_campo($reemplazo,1);
  }
  return($retorno);
}

/*
 * Se crea esta funcion ya que en algunos servidores (Pavimentar nuevo) no funciona el rename cuando el destino existe(No realiza el reemplazo)
 *
 * Mauricio orrego 28/04/2015
 */
function rename_saia($origen,$destino){
	if(!rename($origen,$destino)){
  	if(copy ($origen,$destino)){
    	unlink($origen);
      return TRUE;
    }
    return FALSE;
 	}
 	return TRUE;
}
/*EN ALGUNOS CLIENTES SE TIENE PROBLEMA CON LA CODIFICACION, ESTO LO SOLUCIONA DE FORMA GENERICA*/
function codifica_encabezado($texto){
	if(CODIFICA_ENCABEZADO){
		return(utf8_encode($texto));
	}else{
		return($texto);
	}
}
function decodifica_encabezado($texto){
	if(CODIFICA_ENCABEZADO){
		return(utf8_decode($texto));
	}else{
		return($texto);
	}
}

function obtener_estado_documento($iddoc) {
	global $conn;
	if(empty($iddoc)) {
		return false;
	}
	$estado_doc = busca_filtro_tabla("ed.*", "documento d join estado_documento ed on d.estado = ed.estado", "d.iddocumento=$iddoc and en_uso=1", "", $conn);
	if($estado_doc["numcampos"]) {
		return $estado_doc[0]["idestado_documento"];
	}
	return false;
}

function parsear_cadena($cadena1){
global $conn;
$cadena1=str_replace("|+|"," AND ",$cadena1);
$cadena1=str_replace("|=|"," = ",$cadena1);
$cadena1=str_replace("|like|"," like ",$cadena1);
$cadena1=str_replace("|-|"," OR ",$cadena1);
$cadena1=str_replace("|<|"," < ",$cadena1);
$cadena1=str_replace("|>|"," > ",$cadena1);
$cadena1=str_replace("|>=|"," >= ",$cadena1);
$cadena1=str_replace("|<=|"," <= ",$cadena1);
$cadena1=str_replace("|in|"," in ",$cadena1);
$cadena1=str_replace("||"," LIKE ",$cadena1);
return $cadena1;
}

function obtener_codigo_hash_pdf($archivo,$algoritmo="crc32",$tmp=0){
    global $ruta_db_superior;

    if($tmp){
        $ruta_db_superior='';
    }
   // return( hash_file($algoritmo,$ruta_db_superior.$archivo) );
   return( md5_file($ruta_db_superior.$archivo) );
}
function parsear_comilla_sencilla_cadena($cadena){
	global $conn;
	$cadena_original=$cadena;
	$cadena_sinespacios=trim($cadena);
	$cadena_minuscula=strtolower($cadena_sinespacios);
	$parseada=0;
	if( substr($cadena_minuscula,0,6)=='select' ){
		$findme   = "'";
		$pos = strpos($cadena, $findme);
		if ($pos !== false) {  //fue encontrada
			$motor=$conn->motor;
			$vector_replaces=array('Oracle'=>"''",'MySql'=>"''",'SqlServer'=>"''",'MSSql'=>"''");
			$cadena=str_replace("'",$vector_replaces[$motor],$cadena);
			$parseada=1;
		}
	}else{
		$findme   = "'";
		$pos = strpos($cadena, $findme);
		if ($pos !== false) {  //fue encontrada
			$cadena=str_replace("'","''",$cadena);
			$parseada=1;
		}
	}
	if($parseada){
		return($cadena);
	}else{
		return($cadena_original);
	}
}

?>

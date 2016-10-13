<?php
include_once("conexion.php");
class SQL
{
    var $consulta,$motor;
    var $Conn;
    var $res=NULL;
    var $error=NULL;
    var $nombres_campos=array();
    var $tipos_campos=array();
    var $numcampos=NULL;
    var $numfilas=NULL;
    var $ultimo_insert=NULL;
    var $filas=0;
/*
<Clase>SQL
<Nombre>SQL.
<Parametros>conn Recibe el objeto que tiene la conexion; motorBd Es el motor de base de datos que se está utilizando.
<Responsabilidades>Constructor de la clase SQL.
<Notas> Asocia las variables de la clase conexion que llegan como parametros con los de la clase SQL.
<Excepciones>
<Salida>
<Pre-condiciones>debe existir una conexion a la base de datos
<Post-condiciones>
*/
  function SQL($conn, $motorBd)
  	{
          $this->Conn = $conn;
          $this->motor = $motorBd;
  	}
/*
<Clase>SQL
<Nombre>Buscar.
<Parametros>campos-las columnas a buscar; tablas-las tablas en las que se hará la búsqueda;
where-el filtro de la búsqueda; order_by-parametro para el orden.
<Responsabilidades>Enmascarar una búsqueda de tipo select para cualquier motor,
dependiendo del motor llama a la funcion que corresponda.
<Notas>
<Excepciones> las generadas por errores en la consulta, o permisos sobre las bd
<Salida>devuelve una matriz con el resultado de la consulta
<Pre-condiciones>
<Post-condiciones>
*/
  function Buscar($campos,$tablas,$where,$order_by)
    {
        switch ($this->motor)
        {
            case "MySql":
                return($this->Buscar_MySql($campos, $tablas, $where, $order_by));
                break;
        }
    }
/*
<Clase>SQL
<Nombre>Buscar_MySql.
<Parametros>campos-las columnas a buscar; tablas-las tablas en las que se hará la búsqueda;
where-el filtro de la búsqueda; order_by-parametro para el orden.
<Responsabilidades>ejecutar consulta de selección para mysql
<Notas>
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generará una excepcion
<Salida>una matriz con los resultados de la consulta
la matriz es del tipo: resultado[0]['campo']='valor'
<Pre-condiciones>
<Post-condiciones>
*/
   function Buscar_MySql($campos, $tablas, $where, $order_by)
    {
        if ($campos == "" || $campos == null)
            $campos = "*";
        $this->consulta = "SELECT " . $campos . " FROM " . $tablas;
        if ($where != "" && $where != null)
            $this->consulta.= " WHERE ".$where;
        if ($order_by != "" && $order_by != null)
            $this->consulta.=" ORDER BY ".$order_by;
         // ejecucion de la consulta, a $this->res se le asigna el resource
        $this->res=mysqli_query($this->Conn->conn,$this->consulta);
        //se le asignan a $resultado los valores obtenidos
        if($this->Numero_Filas()>0)
          {for($i=0;$i<$this->Numero_Filas();$i++)
              $resultado[]=mysqli_fetch_array($this->res,MYSQL_ASSOC);
           return $resultado;
        	}
       //se retorna la matriz
       else
          return(false);
   }
/*
<Clase>SQL
<Nombre>Buscar_SqlServer.
<Parametros>campos-las columnas a buscar; tablas-las tablas en las que se hará la búsqueda;
where-el filtro de la búsqueda; order_by-parametro para el orden.
<Responsabilidades>ejecutar consulta de selección para mysql
<Notas>
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generará una excepcion
<Salida>una matriz con los resultados de la consulta
la matriz es del tipo: resultado[0]['campo']='valor'
<Pre-condiciones>
<Post-condiciones>
*/
   function Buscar_SqlServer($campos, $tablas, $where, $order_by)
    {
        if ($campos == "" || $campos == null)
            $campos = "*";
        $this->consulta = "SELECT " . $campos . " FROM " . $tablas;
        if ($where != "" && $where != null)
            $this->consulta.= " WHERE ".$where;
        if ($order_by != "" && $order_by != null)
            $this->consulta.=" ORDER BY ".$order_by;
         // ejecucion de la consulta, a $this->res se le asigna el resource
        sqlsrv_query($this->Conn->conn,"USE ".$this->Conn->Db);
        $this->res=sqlsrv_query($this->Conn->conn,$this->consulta);
        //se le asignan a $resultado los valores obtenidos
        if($this->Numero_Filas()>0)
          {for($i=0;$i<$this->Numero_Filas();$i++)
              $resultado[]=sqlsrv_fetch_array($this->res,SQLSRV_FETCH_ASSOC);
           return $resultado;
        	}
       //se retorna la matriz
       else
          return(false);
   }
   function Buscar_MSSql($campos, $tablas, $where, $order_by)
    {
        if ($campos == "" || $campos == null)
            $campos = "*";
        $this->consulta = "SELECT " . $campos . " FROM " . $tablas;
        if ($where != "" && $where != null)
            $this->consulta.= " WHERE ".$where;
        if ($order_by != "" && $order_by != null)
            $this->consulta.=" ORDER BY ".$order_by;
         // ejecucion de la consulta, a $this->res se le asigna el resource
        mssql_query("USE ".$this->Conn->Db,$this->Conn->conn);
        $this->res=mssql_query($this->consulta,$this->Conn->conn);
        //se le asignan a $resultado los valores obtenidos
        if($this->Numero_Filas()>0)
          {for($i=0;$i<$this->Numero_Filas();$i++)
              $resultado[]=mssql_fetch_array($this->res,MSSQL_ASSOC);
           return $resultado;
        	}
       //se retorna la matriz
       else
          return(false);
   }
/*
<Clase>SQL
<Nombre>Buscar_Oracle.
<Parametros>campos-las columnas a buscar; tablas-las tablas en las que se hará la búsqueda;
where-el filtro de la búsqueda; order_by-parametro para el orden.
<Responsabilidades>ejecutar consulta de selección para mysql
<Notas>
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generará una excepcion
<Salida>una matriz con los resultados de la consulta
la matriz es del tipo: resultado[0]['campo']='valor'
<Pre-condiciones>
<Post-condiciones>
*/
 function Buscar_Oracle($campos, $tablas, $where, $order_by)
    {
        if ($campos == "" || $campos == null)
            $campos = "*";
        $this->consulta = "SELECT " . $campos . " FROM " . $tablas;
        if ($where != "" && $where != null)
            $this->consulta.= " WHERE ".$where;
        if ($order_by != "" && $order_by != null)
            $this->consulta.=" ORDER BY ".$order_by;
         // ejecucion de la consulta, a $this->res se le asigna el resource
        $this->res=$this->Ejecutar_Sql($this->consulta);
        //se le asignan a $resultado los valores obtenidos
         $i=0;
         $resultado=array();
         for(;($arreglo=$this->sacar_fila($this->res));$i++){
            $arreglo=array_change_key_case($arreglo, CASE_LOWER);
            array_push($resultado,$arreglo);
          }
         $resultado["numcampos"]=$i;
         $this->filas=$i;
        if($i)
          return $resultado;
        else
         return(FALSE);
   }
   /*
<Clase>SQL
<Nombre>ejecutar_sql.
<Parametros>sql-cadena con el codigo a ejecutar
<Responsabilidades>dependiendo del motor llama la función que ejecutar el comando recibido en la cadena sql
<Notas>Se utiliza generalmente para busquedas cuyos comandos se optienen de referencias que están en la base de datos,
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generará una excepcion
<Salida>el objeto de conexion
<Pre-condiciones>
<Post-condiciones>la matriz con los valores del resultado se obtiene por medio de la función Resultado
*/
  function  Ejecutar_Sql_Noresult($sql)
    { $sql = html_entity_decode(htmlentities(utf8_decode($sql)));
      switch ($this->motor)
        {
           case "MySql":
                return($this->Ejecutar_Sql_MySql($sql,"2"));
                break;
           case "Oracle":
                return($this->Ejecutar_Sql_Oracle($sql,"2"));
                break;
           case "SqlServer":
                return($this->Ejecutar_Sql_SqlServer($sql,"2"));
                break;
           case "MSSql":
                return($this->Ejecutar_Sql_MSSql($sql,"2"));
                break;
        }
    }
function liberar_resultado($rs){
  if($this->motor=="MySql")
    $this->liberar_resultado_mysql($rs);
  else if($this->motor=="Oracle")
    $this->liberar_resultado_oracle($rs);
  else if($this->motor=="SqlServer")
    $this->liberar_resultado_sqlserver($rs);
  else if($this->motor=="MSSql")
    $this->liberar_resultado_MSSql($rs);
}
function liberar_resultado_mysql($rs){
  if(!$rs){
    $rs=$this->res;
  }
  @mysqli_free_result($rs);
}
function liberar_resultado_oracle($rs){
  if(!$rs){
    $rs=$this->res;
  }
  @OCIFreeStatement($rs);
}
function liberar_resultado_sqlserver($rs){
  if(!$rs){
    $rs=$this->res;
  }
  @sqlsrv_cancel($rs);
}
function liberar_resultado_MSSql($rs){
  if(!$rs){
    $rs=$this->res;
  }
  @ mssql_free_result($rs);
}
/*
<Clase>SQL
<Nombre>ejecutar_sql.
<Parametros>sql-cadena con el codigo a ejecutar
<Responsabilidades>dependiendo del motor llama la función que ejecutar el comando recibido en la cadena sql
<Notas>Se utiliza generalmente para busquedas cuyos comandos se optienen de referencias que están en la base de datos,
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generará una excepcion
<Salida>una matriz con los resultados de la consulta, indices numericos y asociativos
<Pre-condiciones>
<Post-condiciones>la matriz con los valores del resultado se obtiene por medio de la función Resultado
*/
 function  Ejecutar_Sql($sql)
    {
      //alerta($_SERVER['SCRIPT_NAME']."--".$sql);
        switch ($this->motor)
        {
            case "MySql":
               
                return($this->Ejecutar_Sql_MySql($sql));
            break;
            case "Oracle":
                return($this->Ejecutar_Sql_Oracle($sql));
            break;
            case "SqlServer":
                return($this->Ejecutar_Sql_SqlServer($sql));
            break;
            case "MSSql":
                return($this->Ejecutar_Sql_MSSql($sql));
            break;
        }

    }
/*
<Clase>SQL
<Nombre>ejecutar_sql_MySql
<Parametros>sql-cadena con el codigo a ejecutar
<Responsabilidades>ejecutar el comando recibido en la cadena sql
<Notas>Se utiliza generalmente para busquedas cuyos comandos se optienen de referencias que están en la base de datos,
la matriz con los valores del resultado se obtiene por medio de la función Resultado
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generará una excepcion
<Salida>
<Pre-condiciones>
<Post-condiciones>la matriz con los valores del resultado se obtiene por medio de la función Resultado
*/
  function Ejecutar_Sql_MySql($sql)
    {
        
        
        $this->filas=0;
     if($sql && $sql<>"" && $this->Conn->conn){

         $this->res=mysqli_query($this->Conn->conn,$sql); //or die("ERROR SQL  en ".$_SERVER["PHP_SELF"]." ->".$sql);// or error//("Error al Ejecutar:  $sql --- ".mysql_error());
         
         if( $this->res===false ){
             
         }
         
        if($this->res){
         if(strpos(strtolower($sql),"insert")!==false)
            $this->ultimo_insert=$this->Ultimo_Insert_Mysql();
         else if(strpos(strtolower($sql),"select")!==false)
            {$this->ultimo_insert=0;
             $this->filas=$this->res->num_rows;
            }
         else
            {$this->ultimo_insert=0;
            }

          $this->consulta=trim($sql);
          //$fin=strpos($this->consulta," ");
          //$accion=substr($this->consulta,0,$fin); 
        }
        
       
        return($this->res);
      }
    }
  function Ejecutar_Sql_SqlServer($sql)
  { $this->filas=0;
     if($sql && $sql<>""){
        sqlsrv_query($this->Conn->conn,"USE ".$this->Conn->Db);
        $this->res=sqlsrv_query($this->Conn->conn,$sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
        if($this->res){
          $filas=sqlsrv_num_rows($this->res) or print_r(sqlsrv_errors());
          if(strpos(strtolower($sql),"insert")!==false)
            $this->ultimo_insert=$this->Ultimo_Insert_SqlServer();
          else if(strpos(strtolower($sql),"select")!==false){
             $this->ultimo_insert=0;
             $this->filas=$filas;
            }
          else
            {$this->ultimo_insert=0;
            }

          $this->consulta=trim($sql);
          $fin=strpos($this->consulta," ");
          $accion=substr($this->consulta,0,$fin);
        }
        return($this->res);
      }
    }
function Ejecutar_Sql_MSSql($sql)
  { $this->filas=0;
     if($sql && $sql<>""){
        //mssql_query("USE ".$this->Conn->Db,$this->Conn->conn);
        $this->res=mssql_query($sql,$this->Conn->conn);
        //echo $sql.'<br />';
        //print_r(mssql_get_last_message());
        if($this->res){
          if($this->res<>1)
            $filas=mssql_num_rows($this->res);
          if(strpos(strtolower($sql),"insert")!==false)
            $this->ultimo_insert=$this->Ultimo_Insert_MSSql();
          else if(strpos(strtolower($sql),"select")!==false){
             $this->ultimo_insert=0;
             $this->filas=$filas;
            }
          else
            {$this->ultimo_insert=0;
            }

          $this->consulta=trim($sql);
          $fin=strpos($this->consulta," ");
          $accion=substr($this->consulta,0,$fin);
        }
        return($this->res);
      }
    }
 function Ejecutar_Sql_Oracle($sql){
      $this->consulta=$sql;
      $rs=@OCIParse($this->Conn->conn,$sql);
      if($rs)
        {
          if(@OCIExecute($rs,OCI_COMMIT_ON_SUCCESS))
            {$this->res=$rs;

             if(strpos(strtolower($sql),"insert")!==false)
                {$this->ultimo_insert=$this->Ultimo_Insert_Oracle();
                }
			if(strpos(strtolower($sql),"alter")!==false){

				}
             else
                {
                	$this->ultimo_insert=0;
                }
            }
        }
      if(strpos(strtolower($sql),'select')!==false)
         {
          $rs2=@OCIParse($this->Conn->conn,"select count(*) as contarfilas from(".$sql.")");

          if(!OCIExecute($rs2,OCI_COMMIT_ON_SUCCESS))
             {
             //print_r($sql);
			 //die();
             }
          $temp=$this->sacar_fila($rs2);
          $this->filas=$temp["contarfilas"];
         }
      return($rs);
    }

 function sacar_fila($rs=Null)
  {
   if($rs)
     $this->res=$rs;
    switch($this->motor)
    {
      case "MySql":
        if($arreglo=@mysqli_fetch_array($this->res,MYSQLI_BOTH)){
           $this->filas++;
          return($arreglo);
        }
        else return(FALSE);
      break;
      case "Oracle":
        $arreglo=array();
        if(@OCIFetchInto ($this->res,$arreglo,OCI_ASSOC+OCI_NUM+OCI_RETURN_NULLS+OCI_RETURN_LOBS)){
          $arreglo=array_change_key_case($arreglo, CASE_LOWER);
          $this->filas++;
          return($arreglo);
        }
        else {
			//print_r(oci_error($this->res));
        	return(FALSE);
		}
      break;
      case "SqlServer":
        if($arreglo=@sqlsrv_fetch_array($this->res,SQLSRV_FETCH_BOTH)){
           $this->filas++;
          return($arreglo);
        }
        else return(FALSE);
      break;
      case "MSSql":
        if($arreglo=@mssql_fetch_array($this->res,MSSQL_BOTH)){
           $this->filas++;
          return(array_map("trim",$arreglo));
        }
        else return(FALSE);
      break;
    }
  }

function sacar_fila_vector($rs=Null)
  {
   if($rs==Null)
     $rs=$this->res;
    switch($this->motor)
    {
      case "MySql":
        if($arreglo=@mysqli_fetch_row($rs)){
          return($arreglo);
        }
        else return(FALSE);
      break;
      case "Oracle":
        if(@OCIFetchInto($rs, $arreglo, OCI_NUM)){
            return($arreglo);
        }
        else return(FALSE);
      break;
      case "SqlServer":
        if($arreglo=@sqlsrv_fetch_array($rs,SQLSRV_FETCH_NUMERIC)){
          return($arreglo);
        }
        else return(FALSE);
      break;
      case "MSSql":
        if($arreglo=@mssql_fetch_array($rs,MSSQL_NUM)){
          return($arreglo);
        }
        else return(FALSE);
      break;
    }
  }
/*
<Clase>SQL
<Nombre>Insertar.
<Parametros>campos-los campos a insertar; tabla-nombre de la tabla donde se hará la inserción;
valores-los valores a insertar
<Responsabilidades>Llamar a la funcion que corresponda al motor de base de datos para realizar la inserción
<Notas>Enmascarada para agregar otros motores de bases de datos
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
  function  Insertar($campos, $tabla, $valores)
    { $valores = html_entity_decode(htmlentities(utf8_decode($valores)));
        switch ($this->motor)
        {
            case "MySql":
              $this->Insertar_MySql($campos, $tabla, $valores);
            break;
            case "SqlServer":
              $this->Insertar_SqlServer($campos, $tabla, $valores);
            break;
            case "MSSql":
              $this->Insertar_MSSql($campos, $tabla, $valores);
            break;
        }
    }
/*
<Clase>SQL
<Nombre>Insertar_MySql.
<Parametros>campos-los campos a insertar; tabla-nombre de la tabla donde se hará la inserción;
valores-los valores a insertar
<Responsabilidades>Ejecutar una consulta del tipo insert en una base de datos mysql
<Notas>
<Excepciones>Cualquier problema con la ejecucion del INSERT generará una excepcion
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
  function Insertar_MySql($campos, $tabla, $valores){
    if ($campos == "" || $campos == null)
         $insert = "INSERT INTO " . $tabla . " VALUES (" . $valores . ")";
    else
         $insert = "INSERT INTO " . $tabla . "(" . $campos . ") VALUES (" . $valores . ")";
    $this->res=mysqli_query($this->Conn->conn,$insert);
    $this->Guardar_log($insert);
  }
/*
<Clase>SQL
<Nombre>Insertar_SqlServer.
<Parametros>campos-los campos a insertar; tabla-nombre de la tabla donde se hará la inserción;
valores-los valores a insertar
<Responsabilidades>Ejecutar una consulta del tipo insert en una base de datos sql server
<Notas>
<Excepciones>Cualquier problema con la ejecucion del INSERT generará una excepcion
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
  function Insertar_SqlServer($campos, $tabla, $valores){
    if ($campos == "" || $campos == null)
         $insert = "INSERT INTO " . $tabla . " VALUES (" . $valores . ")";
    else
         $insert = "INSERT INTO " . $tabla . "(" . $campos . ") VALUES (" . $valores . ")";
    sqlsrv_query($this->Conn->conn,"USE ".$this->Conn->Db);
    $this->res=sqlsrv_query($this->Conn->conn,$insert);
    $this->Guardar_log($insert);
  }
  function Insertar_MSSql($campos, $tabla, $valores){
    if ($campos == "" || $campos == null)
         $insert = "INSERT INTO " . $tabla . " VALUES (" . $valores . ")";
    else
         $insert = "INSERT INTO " . $tabla . "(" . $campos . ") VALUES (" . $valores . ")";
    mssql_query("USE ".$this->Conn->Db,$this->Conn->conn);
    $this->res=mssql_query($insert,$this->Conn->conn);
    $this->Guardar_log($insert);
  }

/*
<Clase>SQL
<Nombre>Modificar.
<Parametros>tabla-nombre de la tabla donde se hará la modificacion;
 actualizaciones-Aquellos registros que serán modificados y sus nuevos valores;
 where-filtro de los registros que serán modificados
<Responsabilidades>Llamar a la funcion que corresponda al motor de base de datos para realizar la modificacion
<Notas>Enmascarada para agregar otros motores de bases de datos
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
  function Modificar($tabla, $actualizaciones, $where){
    $actualizaciones = html_entity_decode(htmlentities(utf8_decode($actualizaciones)));
    switch ($this->motor){
        case "MySql":
          $this->Modificar_MySql($tabla, $actualizaciones, $where);
        break;
        case "SqlServer":
          $this->Modificar_SqlServer($tabla, $actualizaciones, $where);
        break;
        case "MSSql":
          $this->Modificar_MSSql($tabla, $actualizaciones, $where);
        break;
    }
  }
/*
<Clase>SQL
<Nombre>Modificar_MySql.
<Parametros>tabla-nombre de la tabla donde se hará la modificacion;
 actualizaciones-Aquellos registros que serán modificados y sus nuevos valores;
 where-filtro de los registros que serán modificados
<Responsabilidades>Ejecutar una sentencia de tipo UPDATE en una base de datos MySql
<Notas>
<Excepciones>Cualquier problema con la ejecucion del UPDATE generará una excepcion
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
  //función update para mysql
  function Modificar_MySql($tabla, $actualizaciones, $where)
    {
       if ($where != null && $where != "")
           $update = "UPDATE " . $tabla." SET " . $actualizaciones . " WHERE " . $where;
       else
           $update = "UPDATE " . $tabla . " SET " . $actualizaciones;
       // ejecucion de la consulta
       $this->Guardar_log($update);
       $this->res=mysqli_query($this->Conn->conn,$update);
        //
    }
/*
<Clase>SQL
<Nombre>Modificar_SqlServer.
<Parametros>tabla-nombre de la tabla donde se hará la modificacion;
 actualizaciones-Aquellos registros que serán modificados y sus nuevos valores;
 where-filtro de los registros que serán modificados
<Responsabilidades>Ejecutar una sentencia de tipo UPDATE en una base de datos Sql Server
<Notas>
<Excepciones>Cualquier problema con la ejecucion del UPDATE generará una excepcion
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
  function Modificar_SqlServer($tabla, $actualizaciones, $where)
    {
       if ($where != null && $where != "")
           $update = "UPDATE " . $tabla." SET " . $actualizaciones . " WHERE " . $where;
       else
           $update = "UPDATE " . $tabla . " SET " . $actualizaciones;
       $this->Guardar_log($update);
       sqlsrv_query($this->Conn->conn,"USE ".$this->Conn->Db);
       $this->res=sqlsrv_query($this->Conn->conn,$update);
    }
  function Modificar_MSSql($tabla, $actualizaciones, $where)
    {
       if ($where != null && $where != "")
           $update = "UPDATE " . $tabla." SET " . $actualizaciones . " WHERE " . $where;
       else
           $update = "UPDATE " . $tabla . " SET " . $actualizaciones;
       $this->Guardar_log($update);
       mssql_query("USE ".$this->Conn->Db,$this->Conn->conn);
       $this->res=mssql_query($update,$this->Conn->conn);
    }

/*
<Clase>SQL
<Nombre>ejecutar_sql_tipo.
<Parametros>sql-cadena con el codigo a ejecutar
<Responsabilidades>según el motor llamar a la función que ejecutará la cadena sql
<Notas>el vector retornado es del tipo. resultado[0]='campo',resultado[1]='valor_campo'...
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
  //ejecuta un sql que debe devuelve un solo registro
  function Ejecutar_Sql_Tipo($sql)
    { $sql = html_entity_decode(htmlentities(utf8_decode($sql)));
      switch ($this->motor)
          {
              case "MySql":
                return($this->Ejecutar_Sql_Tipo_MySql($sql));
              break;
              case "SqlServer":
                return($this->Ejecutar_Sql_Tipo_SqlServer($sql));
              break;
              case "MSSql":
                return($this->Ejecutar_Sql_Tipo_MSSql($sql));
              break;

          }

    }
/*
<Clase>SQL
<Nombre>ejecutar_sql_tipo_MySql.
<Parametros>sql-cadena con el codigo a ejecutar
<Responsabilidades>Ejecuta una consulta sql
<Notas>el vector retornado es del tipo. resultado[0]='campo',resultado[1]='valor_campo'...
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos
<Salida>un vector con los resultados de la consulta
<Pre-condiciones>
<Post-condiciones>
*/
  function Ejecutar_Sql_Tipo_MySql($sql)
    {$this->consulta=$sql;
     $this->res=mysqli_query($this->Conn->conn,$this->consulta);
      $this->Guardar_log($sql);
     while($fila=mysqli_fetch_row($this->res))
        {foreach($fila as $valor)
            $resultado[]=$valor;
        }
     return $resultado;
    }
/*
<Clase>SQL
<Nombre>ejecutar_sql_tipo_SqlServer.
<Parametros>sql-cadena con el codigo a ejecutar
<Responsabilidades>Ejecuta una consulta sql
<Notas>el vector retornado es del tipo. resultado[0]='campo',resultado[1]='valor_campo'...
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos
<Salida>un vector con los resultados de la consulta
<Pre-condiciones>
<Post-condiciones>
*/
  function Ejecutar_Sql_Tipo_SqlServer($sql)
    {$this->consulta=$sql;
    sqlsrv_query($this->Conn->conn,"USE ".$this->Conn->Db);
     $this->res=sqlsrv_query($this->Conn->conn,$this->consulta);
      $this->Guardar_log($sql);
     while($fila=sqlsrv_fetch_array($this->res,SQLSRV_FETCH_NUMERIC))
        {foreach($fila as $valor)
            $resultado[]=$valor;
        }
     return $resultado;
    }
  function Ejecutar_Sql_Tipo_MSSql($sql)
    {$this->consulta=$sql;
    mssql_query("USE ".$this->Conn->Db,$this->Conn->conn);
     $this->res=mssql_query($this->consulta,$this->Conn->conn);
      $this->Guardar_log($sql);
     while($fila=mssql_fetch_array($this->res,MSSQL_NUM))
        {foreach($fila as $valor)
            $resultado[]=$valor;
        }
     return $resultado;
    }

/*
<Clase>SQL
<Nombre>Eliminar.
<Parametros>tabla-nombre de la tabla donde se hará la eliminacion; where-cuales son los registros a eliminar
<Responsabilidades>Llamar a la funcion que corresponda al motor de base de datos para realizar la eliminacion
<Notas>Enmascarada para agregar otros motores de bases de datos
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
  function Eliminar($tabla, $where)
    {
        switch ($this->motor)
          {
            case "MySql":
               $this->Eliminar_MySql($tabla, $where);
            break;
            case "SqlServer":
               $this->Eliminar_SqlServer($tabla, $where);
            break;
            case "MSSql":
               $this->Eliminar_MSSql($tabla, $where);
            break;
          }
    }
/*
<Clase>SQL
<Nombre>Eliminar_MySql.
<Parametros>tabla-nombre de la tabla donde se hará la eliminacion; where-cuales son los registros a eliminar
<Responsabilidades>Ejecutar una sentencia DELETE en una base de datos MySql
<Notas>
<Excepciones>Cualquier problema con la ejecucion del DELETE generará una excepcion
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
  function Eliminar_MySql($tabla, $where)
    {
        if ($where != null && $where != "")
            $delete = "DELETE FROM " . $tabla . " WHERE " . $where;
        else
            $delete = "DELETE FROM " . $tabla;
       // ejecucion de la consulta
       $this->Guardar_log($delete);
       $this->res=mysqli_query($this->Conn->conn,$delete);
       //
    }
/*
<Clase>SQL
<Nombre>Eliminar_SqlServer.
<Parametros>tabla-nombre de la tabla donde se hará la eliminacion; where-cuales son los registros a eliminar
<Responsabilidades>Ejecutar una sentencia DELETE en una base de datos SqlServer
<Notas>
<Excepciones>Cualquier problema con la ejecucion del DELETE generará una excepcion
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
  function Eliminar_SqlServer($tabla, $where)
    {
        if ($where != null && $where != "")
            $delete = "DELETE FROM " . $tabla . " WHERE " . $where;
        else
            $delete = "DELETE FROM " . $tabla;
       // ejecucion de la consulta
       $this->Guardar_log($delete);
       sqlsrv_query($this->Conn->conn,"USE ".$this->Conn->Db);
       $this->res=sqlsrv_query($this->Conn->conn,$delete);
       //
    }
  function Eliminar_MSSql($tabla, $where)
    {
        if ($where != null && $where != "")
            $delete = "DELETE FROM " . $tabla . " WHERE " . $where;
        else
            $delete = "DELETE FROM " . $tabla;
       // ejecucion de la consulta
       $this->Guardar_log($delete);
       mssql_query("USE ".$this->Conn->Db,$this->Conn->conn);
       $this->res=mssql_query($delete,$this->Conn->conn);
       //
    }
/*
<Clase>SQL
<Nombre>Resultado.
<Parametros>
<Responsabilidades>Retornar en una matriz el resultado de la última consulta
<Notas>se utiliza para obtener los resultados de la función Ejecutar_Sql
<Excepciones>
<Salida>devuelve una matriz asociativa con los valores de la última consulta
<Pre-condiciones>$this->res debe apuntar al objeto de consulta utilizado la última vez
<Post-condiciones>
*/
  function Resultado_MySql()
    {$resultado["sql"]=$this->consulta;
     $resultado["numcampos"]=$this->Numero_Filas();
       if($this->Numero_Filas()>0)
          {for($i=0;$i<$this->Numero_Filas();$i++)
              {$resultado[$i]=mysqli_fetch_array($this->res,MYSQLI_ASSOC);
               $j=0;
               foreach($resultado[$i] as $key=>$valor)
                  {$resultado[$i][$j]=$resultado[$i][$key];
                   $j++;
                  }
              }


        	}
      return $resultado;
       //se retorna la matriz
      /* else
          return(false);*/
    }
  function Resultado_SqlServer()
    {$resultado["sql"]=$this->consulta;
     $resultado["numcampos"]=$this->Numero_Filas();
       if($this->Numero_Filas()>0)
          {for($i=0;$i<$this->Numero_Filas();$i++)
              {$resultado[$i]=sqlsrv_fetch_array($this->res,SQLSRV_FETCH_ASSOC);
               $j=0;
               foreach($resultado[$i] as $key=>$valor)
                  {$resultado[$i][$j]=$resultado[$i][$key];
                   $j++;
                  }
              }
        	}
      return $resultado;
    }
  function Resultado_MSSql()
    {$resultado["sql"]=$this->consulta;
     $resultado["numcampos"]=$this->Numero_Filas();
       if($this->Numero_Filas()>0)
          {for($i=0;$i<$this->Numero_Filas();$i++)
              {$resultado[$i]=mssql_fetch_array($this->res,MSSQL_ASSO);
               $j=0;
               foreach($resultado[$i] as $key=>$valor)
                  {$resultado[$i][$j]=$resultado[$i][$key];
                   $j++;
                  }
              }
        	}
      return $resultado;
    }
/*
<Clase>SQL
<Nombre>Rows_Count
<Parametros>
<Responsabilidades>Retornar el número de filas afectadas en la última consulta
<Notas>se utiliza después de la función Insertar
<Excepciones>
<Salida>número de filas devueltas en la última consulta
<Pre-condiciones>$this->res debe apuntar al objeto de consulta utilizado la última vez
<Post-condiciones>
*/
  function Rows_Count()
    {mysqli_affected_rows ($this->res);
    }
/*
<Clase>SQL
<Nombre>Numero_Filas
<Parametros>
<Responsabilidades>Retornar el número de filas devueltas en la última consulta
<Notas>se utiliza después de la función ejecutar_sql
<Excepciones>
<Salida>número de filas devueltas en la última consulta
<Pre-condiciones>$this->res debe apuntar al objeto de consulta utilizado la última vez
<Post-condiciones>
*/
  function Numero_Filas($rs=Null){
      return($this->filas);
    }
/*
<Clase>SQL
<Nombre>Tipo_Campo
<Parametros>pos-posición del campo en el array resultado
<Responsabilidades>llama a la funcion requerida dependiendo del motor de bd
<Notas>se utiliza después de la función ejecutar_sql
<Excepciones>
<Salida>tipo del campos especificado
<Pre-condiciones>$this->res debe apuntar al objeto de consulta utilizado la última vez
<Post-condiciones>
*/
  function Tipo_Campo($rs,$pos){
     if($this->motor=="Oracle")
       return(oci_field_type($rs,$pos+1));
     elseif($this->motor=="MySql"){
       $dato=mysqli_fetch_field_direct($rs,$pos);
       return($dato->type);
     }
     elseif($this->motor=="SqlServer"){
      $dato=sqlsrv_field_metadata($rs);
      return($dato[$pos]["Type"]);
    }
    elseif($this->motor=="MSSql"){
      $dato=mssql_field_type($rs,$pos);
      return($dato);
    }
  }

/*
<Clase>SQL
<Nombre>Nombre_Campo
<Parametros>pos-posición del campo en el array resultado
<Responsabilidades>llama a la funcion requerida dependiendo del motor de bd
<Notas>se utiliza después de la función ejecutar_sql
<Excepciones>
<Salida>nombre del campos especificado
<Pre-condiciones>$this->res debe apuntar al objeto de consulta utilizado la última vez
<Post-condiciones>
*/

  function Nombre_Campo($rs,$pos){
    if($this->motor=="Oracle")
      return(strtolower(oci_field_name($rs,$pos+1)));
    elseif($this->motor=="MySql"){
       $dato=mysqli_fetch_field_direct($rs,$pos);
       return($dato->name);
    }
    elseif($this->motor=="SqlServer"){
      $dato=sqlsrv_field_metadata($rs);
      return($dato[$pos]["Name"]);
    }
    elseif($this->motor=="MSSql"){
      $dato=mssql_field_name($rs,$pos);
      return($dato);
    }
  }

/*
<Clase>SQL
<Nombre>Lista_Tabla
<Parametros>db-nombre de la base de datos a listar
<Responsabilidades>Retornar en una matriz las tablas de la base de datos especificada
<Notas>
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generará una excepcion
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/

  function Lista_Tabla($db){
    if($this->motor=="MySql"){
       $this->res=mysqli_query($this->Conn->conn,"SHOW TABLES"); //or die("Error en la Ejecucución del Proceso SQL: ".mysql_error());
       while($row=mysqli_fetch_row($this->res))
       $resultado[]=$row[0];
    }
    else if($this->motor=="MSSql"){
      mssql_query("USE ".$this->Conn->Db,$this->Conn->conn);
      $this->res=mssql_query("select name AS nombre from sysobjects where type='U'",$this->Conn->conn) or die("Error en la Ejecucucion del Proceso MSSQL: ".mssql_get_last_message());
      while($row=mssql_fetch_array($this->res,MSSQL_NUM))
        $resultado[]=$row[0];
      asort($resultado);
    }
     else if($this->motor=="SqlServer"){
       sqlsrv_query($this->Conn->conn,"USE ".$this->Conn->Db);
       $this->res=sqlsrv_query($this->Conn->conn,"select name AS nombre from sysobjects where type='U'");
       while($row=sqlsrv_fetch_array($this->res,SQLSRV_FETCH_NUMERIC))
            $resultado[]=$row[0];
       asort($resultado);
     }
    return($resultado);
  }
/*
<Clase>SQL
<Nombre>Lista_Bd
<Parametros>
<Responsabilidades>Retornar en una matriz la lista de las bases de datos existentes
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
  function Lista_Bd(){
     $this->res=mysqli_query($this->Conn->conn,"SHOW DATABASES") or die("Error ".mysqli_error($this->Conn->conn));
     while($row=mysqli_fetch_row($this->res))
          $resultado[]=$row[0];
     asort($resultado);
     return($resultado);
    }
/*
<Clase>SQL
<Nombre>Busca_Tabla
<Parametros>tabla-nombre de la tabla a examinar
<Responsabilidades>segun el motor llama la función correspondiente
<Notas>
<Excepciones>
<Salida>matriz con la lista de los campos de una tabla
<Pre-condiciones>
<Post-condiciones>
*/
  function Busca_tabla($tabla,$campo=""){
    if(!$tabla && @$_REQUEST["tabla"])
      $tabla=$_REQUEST["tabla"];
    else if(!$tabla)
    	return(false);
    switch ($this->motor){
      case "MySql":
        return($this->Busca_tabla_MySql($tabla,$campo));
      break;
      case "Oracle":
        return($this->Busca_tabla_Oracle($tabla,$campo));
      break;
      case "SqlServer":
        return($this->Busca_tabla_SqlServer($tabla,$campo));
      break;
      case "MSSql":
        return($this->Busca_tabla_MSSql($tabla,$campo));
      break;
    }
  }
/*
<Clase>SQL
<Nombre>Busca_Tabla
<Parametros>tabla-nombre de la tabla a examinar
<Responsabilidades>Retornar en una matriz la lista de los campos de una tabla
<Notas>
<Excepciones>
<Salida>matriz con la lista de los campos de una tabla
<Pre-condiciones>
<Post-condiciones>
*/
  function Busca_tabla_MySql($tabla,$campo){
  	$this->consulta="show columns from ".$tabla;
    $this->res=mysqli_query($this->Conn->conn,$this->consulta);
    $resultado=array();
    $i=0;
    while($row=mysqli_fetch_row($this->res)){
   		if($campo && $campo==$row[0]){
   			array_push($resultado,$row[0]);
  			$i++;
   		}
   		else if($campo==''){
   			array_push($resultado,$row[0]);
   			$i++;
   		}
    }
    asort($resultado);
    $resultado["numcampos"]=$i;
    return($resultado);
  }
  function Busca_tabla_Oracle($tabla,$campo=''){
  	$where_campo='';
  	if($campo!=''){
  		$where_campo=" AND column_name='".$campo."'";
  	}
    $this->consulta="SELECT column_name AS Field FROM user_tab_columns WHERE table_name='".strtoupper($tabla)."' ".$where_campo." ORDER BY column_name ASC";
    $this->res=$this->Ejecutar_Sql($this->consulta);
    //se le asignan a $resultado los valores obtenidos
    $i=0;
    $resultado=array();
    for(;($arreglo=$this->sacar_fila($this->res));$i++){
      $arreglo=array_change_key_case($arreglo, CASE_LOWER);
      array_push($resultado,$arreglo);
    }
    $resultado["numcampos"]=$i;
    $this->filas=$i;
    if($i)
      return $resultado;
    else
     return(FALSE);
  }
	function Busca_tabla_SqlServer($tabla,$campo){
	  global $conn;
	  if($campo!=""){
	    $this->consulta="select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME like '".$tabla."' AND COLUMN_NAME='".$campo."'";
	  }else{
	    $this->consulta="select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME like '".$tabla."'";
	  }
	  sqlsrv_query($this->Conn->conn,"USE ".$this->Conn->Db) or die ($this->consulta);
	  $this->res=sqlsrv_query($this->Conn->conn,$this->consulta);
	  while($row=sqlsrv_fetch_array($this->res,SQLSRV_FETCH_NUMERIC))
	  $resultado[]=$row[0]; 
	  
	  asort($resultado);      
	  return($resultado);
	}
    function Busca_tabla_MSSql($tabla){
    global $conn;
    $this->consulta="select COLUMN_NAME from information_schema.columns WHERE TABLE_NAME LIKE '".$tabla."'";
    //echo "select * from information_schema.columns WHERE TABLE_NAME LIKE '".$tabla."'<br />";
     mssql_query("USE ".$this->Conn->Db,$this->Conn->conn) or die ($this->consulta);
     $this->res=mssql_query($this->consulta,$this->Conn->conn);
     while($row=mssql_fetch_array($this->res,MSSQL_NUM))
          $resultado[]=$row[0];
     asort($resultado);
     return($resultado);
    }
/*
<Clase>SQL
<Nombre>Buscar_Limit
<Parametros>campos-los campos a buscar; tablas-tablas donde se realizará la busqueda;
 where-filtro de la búsqueda; order_by-columna para el orden; limit-numero de registros a recuperar
<Responsabilidades>segun el motor llama la función correspondiente
<Notas>Funciona igual que Buscar_MySql pero con el parametro limit, fue necesaria su creacion al no tener en cuenta este parametro con anterioridad
<Excepciones>Cualquier problema con la ejecucion del SELECT generará una excepcion
<Salida>una matriz con los "limit" resultados de la busqueda
<Pre-condiciones>
<Post-condiciones>
*/
  //devuelve los primeros $limit registros de la consulta en un array
  function Ejecutar_Limit($sql,$inicio,$fin,$conn,$orden="")
    {switch ($this->motor)
        {
            case "MySql":
               return($this->Ejecutar_Limit_MySql($sql,$inicio,$fin,$conn));
            break;
            case "Oracle":
               return($this->Ejecutar_Limit_Oracle($sql,$inicio,$fin,$conn));
            break;
            case "SqlServer":
               return($this->Ejecutar_Limit_SqlServer($sql,$inicio,$fin,$conn));
            break;
            case "MSSql":
               return($this->Ejecutar_Limit_MSSql($sql,$inicio,$fin,$conn,$orden));
            break;
        }
    }
/*
<Clase>SQL
<Nombre>Ejecutar_Limit_MySql
<Parametros>$sql-consulta a ejecutar; $inicio-primer registro a buscar; $fin-ultimo registro a buscar;
$conn-objeto de tipo sql
<Responsabilidades>Realizar la busqueda de cierta cantidad de filas de una tabla
<Notas>Funciona igual que Buscar_MySql pero con el parametro limit, fue necesaria su creacion al no tener en cuenta este parametro con anterioridad
<Excepciones>Cualquier problema con la ejecucion del SELECT generará una excepcion
<Salida>una matriz con los "limit" resultados de la busqueda
<Pre-condiciones>
<Post-condiciones>
*/
  //devuelve los registro en el rango $inicio:$fin de la consulta, para mysql
  function Ejecutar_Limit_MySql($sql,$inicio,$fin,$conn)
    {
     $cuantos=$fin-$inicio+1;
     if($inicio<0)
      $inicio = 0;

     $consulta = "$sql LIMIT $inicio,$cuantos";
	 $consulta=str_replace("key","'key'",$consulta);
   //echo $consulta;
     $res=mysqli_query($conn->Conn->conn,$consulta);// or die("consulta fallida ".mysqli_error($conn->Conn->conn));
     return($res);
    }
/*
<Clase>SQL
<Nombre>Ejecutar_Limit_SqlServer
<Parametros>$sql-consulta a ejecutar; $inicio-primer registro a buscar; $fin-ultimo registro a buscar;
$conn-objeto de tipo sql
<Responsabilidades>Realizar la busqueda de cierta cantidad de filas de una tabla
<Notas>Funciona igual que Buscar_SqlServer pero con el parametro limit, fue necesaria su creacion al no tener en cuenta este parametro con anterioridad
<Excepciones>Cualquier problema con la ejecucion del SELECT generará una excepcion
<Salida>una matriz con los "limit" resultados de la busqueda
<Pre-condiciones>
<Post-condiciones>
*/
  //devuelve los registro en el rango $inicio:$fin de la consulta, para SqlServer
function Ejecutar_Limit_SqlServer($sql,$inicio,$fin,$conn){
	$consulta=trim($sql);
	$search=array("ORDER BY","order by");	$replace=array("order by","order by");
	if(strpos(str_replace($search, $replace, $consulta),"order by")>0){
		$sql_count=substr($consulta,0,strpos(str_replace($search, $replace, $consulta),"order by"));
		$parte_orden=substr($consulta,strpos(str_replace($search, $replace, $consulta),"order by"));

		$array_order=explode(",", $parte_orden); $cant=count($array_order);
		$orders=array();
		for($i=0;$i<$cant;$i++) {
			$valor=explode(".", $array_order[$i]);
			if(strpos(trim($array_order[$i]),".")>0){
				if($i==0){
					$orders[]="order by ".$valor[1];
				}else{
					$orders[]=$valor[1];
				}
			}else{
				$orders[]=$valor[0];
			}
		}
		$order=implode(",", $orders);
	}else{
		$sql_count=$consulta;
		$order="order by (select 1)";
	}

	sqlsrv_query($conn->Conn->conn,"USE ".$this->Conn->Db);
	$complemento = substr($sql_count,strpos($sql_count,' '));
	/*$sql_cantidad="SELECT COUNT(*) as cant FROM (".$sql_count.") cantidad_reg";
	$res_cant=sqlsrv_query($conn->Conn->conn,$sql_cantidad) or die("consulta fallida. ---- $sql_cantidad ");
	$total=sqlsrv_fetch_array($res_cant,SQLSRV_FETCH_NUMERIC);
	$cant=intval($total[0]);*/
	//$select=str_replace("/*union*/", "TOP ".$cant, "SELECT TOP ".$cant.$complemento); //UTILIZADO PARA LOS UNION
	$select="SELECT ".$complemento;
	if($fin<($inicio+1)){
		$fin=($inicio+1);
	}

	$consulta="WITH informacion_tabla AS(
	SELECT *,ROW_NUMBER() OVER(".$order.") as numfila__oculto FROM (".$select.") datos
	) SELECT * FROM informacion_tabla WHERE numfila__oculto BETWEEN ".($inicio+1)." AND ".($fin);

	 $res=sqlsrv_query($conn->Conn->conn,$consulta) or die("consulta fallida. ---- $consulta ");
	 return($res);
}


function Ejecutar_Limit_MSSql($sql,$inicio,$fin,$conn){
	$consulta=trim($sql);
	$search=array("ORDER BY","order by");	$replace=array("order by","order by");
	if(strpos(str_replace($search, $replace, $consulta),"order by")>0){
		$sql_count=substr($consulta,0,strpos(str_replace($search, $replace, $consulta),"order by"));
		$parte_orden=substr($consulta,strpos(str_replace($search, $replace, $consulta),"order by"));

		$array_order=explode(",", $parte_orden); $cant=count($array_order);
		$orders=array();
		for($i=0;$i<$cant;$i++) {
			$valor=explode(".", $array_order[$i]);
			if(strpos(trim($array_order[$i]),".")>0){
				if($i==0){
					$orders[]="order by ".$valor[1];
				}else{
					$orders[]=$valor[1];
				}
			}else{
				$orders[]=$valor[0];
			}
		}
		$order=implode(",", $orders);
	}else{
		$sql_count=$consulta;
		$order="order by (select 1)";
	}

	mssql_query("USE ".$this->Conn->Db,$conn->Conn->conn);
	$complemento = substr($sql_count,strpos($sql_count,' '));
	/*$sql_cantidad="SELECT COUNT(*) as cant FROM (".$sql_count.") cantidad_reg";
	$res_cant=mssql_query($sql_cantidad,$conn->Conn->conn) or die("consulta fallida ---- $sql_cantidad ");
	$total=mssql_fetch_array($res_cant,MSSQL_NUM);
	$cant=intval($total[0]);*/
	//$select=str_replace("/*union*/", "TOP ".$cant, "SELECT TOP ".$cant.$complemento); //UTILIZADO PARA LOS UNION
	$select="SELECT ".$complemento;

	if($fin<($inicio+1)){
		$fin=($inicio+1);
	}
	$consulta="WITH informacion_tabla AS(
	SELECT *,ROW_NUMBER() OVER(".$order.") as numfila__oculto FROM (".$select.") datos
	) SELECT * FROM informacion_tabla WHERE numfila__oculto BETWEEN ".($inicio+1)." AND ".($fin);

   $res=mssql_query($consulta,$conn->Conn->conn) or die("consulta fallida ---- $consulta ");
   return($res);
}

/*
<Clase>SQL
<Nombre>Ejecutar_Limit_Oracle
<Parametros>$sql-consulta a ejecutar; $inicio-primer registro a buscar; $fin-ultimo registro a buscar;
$conn-objeto de tipo sql
<Responsabilidades>Realizar la busqueda de cierta cantidad de filas de una tabla
<Notas>Funciona igual que Buscar_MySql pero con el parametro limit, fue necesaria su creacion al no tener en cuenta este parametro con anterioridad
<Excepciones>Cualquier problema con la ejecucion del SELECT generará una excepcion
<Salida>una matriz con los "limit" resultados de la busqueda
<Pre-condiciones>
<Post-condiciones>
*/
  //devuelve los registro en el rango $inicio:$fin de la consulta, para oracle
  function Ejecutar_Limit_Oracle($sql,$inicio,$fin,$conn)
    {$inicio=$inicio+1;
     $fin+=1;
     $cuantos=$fin-$inicio;
     $sql = "SELECT *
             FROM (SELECT a.*, ROWNUM FILA
                   FROM ($sql) a
                   WHERE ROWNUM <= $fin)
             WHERE FILA >= $inicio";
     $stmt = OCIParse($conn->Conn->conn,$sql);
    // echo $sql;
     if(!OCIExecute($stmt,OCI_COMMIT_ON_SUCCESS))
      $this->error=OCIError();
     return $stmt;
    }
/*
<Clase>SQL
<Nombre>total_registros_tabla.
<Parametros>tabla-nombre de la tabla a consultar
<Responsabilidades>llama a la función deseada
<Notas>
<Excepciones>Cualquier problema con la ejecucion del comando generará una excepcion
<Salida>devuelve un entero con el numero de filas de la tabla
<Pre-condiciones>
<Post-condiciones>
*/
  function Total_Registros_Tabla($tabla)
    {switch ($this->motor)
        {
            case "MySql":
               return($this->Total_Registros_Tabla_MySql($tabla));
            break;
            case "SqlServer":
               return($this->Total_Registros_Tabla_SqlServer($tabla));
            break;
            case "MSSql":
               return($this->Total_Registros_Tabla_MSSql($tabla));
            break;
        }
    }
/*
<Clase>SQL
<Nombre>total_registros_tabla.
<Parametros>tabla-nombre de la tabla a consultar
<Responsabilidades>consultar el número total de registros de una tabla para mysql
<Notas>
<Excepciones>Cualquier problema con la ejecucion del comando generará una excepcion
<Salida>devuelve un entero con el numero de filas de la tabla
<Pre-condiciones>
<Post-condiciones>
*/
  function Total_Registros_Tabla_MySql($tabla){
     $this->consulta="SELECT COUNT( * ) AS TOTAL FROM ".$tabla;
     $this->res=mysqli_query($this->Conn->conn,$this->consulta) ;
     $total=mysqli_fetch_row($this->res);
     return($total[0]);
    }
/*
<Clase>SQL
<Nombre>total_registros_tabla.
<Parametros>tabla-nombre de la tabla a consultar
<Responsabilidades>consultar el número total de registros de una tabla para SqlServer
<Notas>
<Excepciones>Cualquier problema con la ejecucion del comando generará una excepcion
<Salida>devuelve un entero con el numero de filas de la tabla
<Pre-condiciones>
<Post-condiciones>
*/
  function Total_Registros_Tabla_SqlServer($tabla)
    {$this->consulta="SELECT COUNT( * ) AS TOTAL FROM ".$tabla;
     sqlsrv_query($this->Conn->conn,"USE ".$this->Conn->Db);
     $this->res=sqlsrv_query($this->Conn->conn,$this->consulta) ;
     $total=sqlsrv_fetch_array($this->res,SQLSRV_FETCH_NUMERIC);
     return($total[0]);
    }
  function Total_Registros_Tabla_MSSql($tabla)
    {$this->consulta="SELECT COUNT( * ) AS TOTAL FROM ".$tabla;
     mssql_query("USE ".$this->Conn->Db,$this->Conn->conn);
     $this->res=mssql_query($this->consulta,$this->Conn->conn) ;
     $total=mssql_fetch_array($this->res,MSSQL_NUM);
     return($total[0]);
    }

/*
<Clase>SQL
<Nombre>Numero_Campos
<Parametros>
<Responsabilidades>segun el motor llama la función deseada
<Notas>se utiliza después de la hacer una consulta de seleccion (select)
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
  function Numero_Campos($rs){
    if(!$rs){
      return(0);
    }
    if($this->motor=="Oracle")
      return(OCINumCols($rs));
    elseif($this->motor=="MySql")
      return($rs->field_count);
    elseif($this->motor=="SqlServer"){
      $numero=sqlsrv_num_fields($rs);
      return($numero);
    }
    elseif($this->motor=="MSSql"){
      $numero=mssql_num_fields($rs);
      return($numero);
    }
  } // Fin Funcion General Ultimo Insert


/*
<Clase>SQL
<Nombre>Ultimo_Insert
<Parametros>
<Responsabilidades>segun el motor llama la función deseada
<Notas>se utiliza después de la función insert
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
 function Ultimo_Insert()
    {
      switch ($this->motor)
        {
            case "MySql":
               return($this->Ultimo_Insert_Mysql());
            break;
            case "Oracle";
               return($this->Ultimo_Insert_Oracle());
            break;
            case "SqlServer";
               return($this->Ultimo_Insert_SqlServer());
            break;
            case "MSSql";
               return($this->Ultimo_Insert_MSSql());
            break;
        }
        return FALSE;
    } // Fin Funcion General Ultimo Insert

/*
<Clase>SQL
<Nombre>Ultimo_Insert_Mysql
<Parametros>
<Responsabilidades>Retornar el identificador del ultimo registro insertado
<Notas>se utiliza después de la función insert
<Excepciones>
<Salida>identificador del ultimo registro insertado
<Pre-condiciones>
<Post-condiciones>
*/
  function Ultimo_Insert_Mysql()
    { 
    	return @mysqli_insert_id($this->Conn->conn);
    }

/*
<Clase>SQL
<Nombre>Ultimo_Insert_SqlServer
<Parametros>
<Responsabilidades>Retornar el identificador del ultimo registro insertado
<Notas>se utiliza después de la función insert
<Excepciones>
<Salida>identificador del ultimo registro insertado
<Pre-condiciones>
<Post-condiciones>
*/
  function Ultimo_Insert_SqlServer() {
     sqlsrv_query($this->Conn->conn,"USE ".$this->Conn->Db);
     $this->res=sqlsrv_query($this->Conn->conn,"SELECT @@identity") or print_r(sqlsrv_errors()) ;
     $total=sqlsrv_fetch_array($this->res,SQLSRV_FETCH_NUMERIC) or print_r(sqlsrv_errors());
     return($total[0]);
    }
  function Ultimo_Insert_MSSql() {
     mssql_query("USE ".$this->Conn->Db,$this->Conn->conn);
     $this->res=mssql_query("SELECT @@identity",$this->Conn->conn) or print_r(mssql_get_last_message()) ;
     $total=mssql_fetch_array($this->res,MSSQL_NUM) or print_r(mssql_get_last_message());
     //print_r($total);
     return($total[0]);
    }
/*
<Clase>SQL
<Nombre>Ultimo_Insert_Oracle
<Parametros>
<Responsabilidades>Retornar el identificador del ultimo registro insertado
<Notas>se utiliza después de la función insert
<Excepciones>
<Salida>identificador del ultimo registro insertado
<Pre-condiciones>
<Post-condiciones>
*/
  function Ultimo_Insert_Oracle()
    {
     $identificador=0;
     $sql = $this->consulta;
     $this->consulta=trim($sql);
     $fin=strpos($this->consulta," ");
     $accion=strtoupper(substr($this->consulta,0,$fin));

     switch($accion){
       case "SELECT":
          $identificador=0;
         break;
       case "UPDATE":
         $identificador=0;
       break;
       case "INSERT":
          $posinto=strpos(strtoupper($this->consulta), "INTO");
          $posval=strpos(strtoupper($this->consulta), "VALUES");
          $tabla=substr($this->consulta,$posinto+4,$posval-$posinto);
          $tabla=trim($tabla);

          $parent=strpos($tabla,"(");
          if($parent)
            $tabla=substr($tabla,0,$parent);

          $tabla=trim($tabla);
          $posicion=strpos($tabla,".");
		  if($posicion){
		  	$long=strlen($tabla);
		  	$tabla=substr($tabla,($posicion+1),$long);
		  }
          if(strlen($tabla)>26)
             $aux=substr($tabla,0,26);
          else
          $aux=$tabla;
          $sql_id="SELECT ".$aux."_SEQ.currval FROM DUAL";

          $rs_temp=@OCIParse($this->Conn->conn,$sql_id);
          if(@OCIExecute($rs_temp)){
            @OCIFetchInto ($rs_temp,$arreglo,OCI_NUM);
            $identificador=$arreglo[0];

          }

          @OCIFreeStatement($rs_temp);
          @ocicancel($rs_temp);
        break;
        }
      return($identificador);
    }

  function Guardar_log($strsql){
    global $conn;
    $sqleve="";
    $sql = trim($strsql);
    $sql = str_replace('','',$sql);
    $accion = strtoupper(substr($sql,0,strpos($sql,' ')));
    //echo   $strsql;
    if($accion == 'SELECT')
      return false;
    $tabla = "";
    $llave=0;
    $string_detalle="";
    $func = $_SESSION["usuario_actual"];
    $this->ultimo_insert=0;
    if(isset($_SESSION)){
      $fecha=fecha_db_almacenar(date("Y-m-d h:i:s"),"Y-m-d h:i:s");
      if($sqleve<>""){
        if($this->motor=="MySql"){
          $result=mysqli_query($this->Conn->conn,$sqleve) ;
          if(!$result)
            die(" Error en la consulta: ".mysqli_error($this->Conn->conn));
        }
        else if($this->motor=="SqlServer"){
          sqlsrv_query($this->Conn->conn,"USE ".$this->Conn->Db);
          $result=sqlsrv_query($this->Conn->conn,$sqleve) ;
          if(!$result)
            die(" Error en la consulta: ".sqlsrv_errors());
        }
        else if($this->motor=="MSSql"){
          mssql_query("USE ".$this->Conn->Db,$this->Conn->conn);
          $result=mssql_query($sqleve,$this->Conn->conn) ;
          if(!$result)
            die(" Error en la consulta: ".mssql_get_last_message());
        }
        elseif($this->motor=="Oracle"){//echo $sqleve;
          $rs=@ OCIParse($this->Conn->conn,$sqleve);
          if($rs){
            if(@OCIExecute($rs,OCI_COMMIT_ON_SUCCESS)){
              $this->res=$rs;
            }
            else {
              $this->error=OCIError($rs);
            }
          }
        }
        $registro=$conn->Ultimo_Insert();
      }
    }
  }
}
?>
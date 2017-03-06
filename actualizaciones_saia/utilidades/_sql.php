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
<Parametros>conn Recibe el objeto que tiene la conexion; motorBd Es el motor de base de datos que se est� utilizando.
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
<Parametros>campos-las columnas a buscar; tablas-las tablas en las que se har� la b�squeda;
where-el filtro de la b�squeda; order_by-parametro para el orden.
<Responsabilidades>Enmascarar una b�squeda de tipo select para cualquier motor, 
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
<Parametros>campos-las columnas a buscar; tablas-las tablas en las que se har� la b�squeda;
where-el filtro de la b�squeda; order_by-parametro para el orden.
<Responsabilidades>ejecutar consulta de selecci�n para mysql
<Notas>
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generar� una excepcion
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
        $this->res=mysqli_query($this->Conn, $this->consulta);
        //se le asignan a $resultado los valores obtenidos 
        if($this->Numero_Filas()>0)
          {for($i=0;$i<$this->Numero_Filas();$i++)
              $resultado[]=mysqli_fetch_array($this->res, MYSQLI_ASSOC);              
           return $resultado;   
        	} 
       //se retorna la matriz 	
       else
          return(false);
   }
/*
<Clase>SQL
<Nombre>Buscar_Oracle.
<Parametros>campos-las columnas a buscar; tablas-las tablas en las que se har� la b�squeda;
where-el filtro de la b�squeda; order_by-parametro para el orden.
<Responsabilidades>ejecutar consulta de selecci�n para mysql
<Notas>
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generar� una excepcion
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
<Responsabilidades>dependiendo del motor llama la funci�n que ejecutar el comando recibido en la cadena sql
<Notas>Se utiliza generalmente para busquedas cuyos comandos se optienen de referencias que est�n en la base de datos,
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generar� una excepcion
<Salida>el objeto de conexion
<Pre-condiciones>
<Post-condiciones>la matriz con los valores del resultado se obtiene por medio de la funci�n Resultado
*/ 
  function  Ejecutar_Sql_Noresult($sql)
    { $sql = html_entity_decode((utf8_decode($sql)));
      switch ($this->motor)
        {
           case "MySql":
                return($this->Ejecutar_Sql_MySql($sql,"2"));
                break;
           case "Oracle":
                return($this->Ejecutar_Sql_Oracle($sql,"2"));
                break;     
        }
    }
/*
<Clase>SQL
<Nombre>ejecutar_sql.
<Parametros>sql-cadena con el codigo a ejecutar
<Responsabilidades>dependiendo del motor llama la funci�n que ejecutar el comando recibido en la cadena sql
<Notas>Se utiliza generalmente para busquedas cuyos comandos se optienen de referencias que est�n en la base de datos,
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generar� una excepcion
<Salida>una matriz con los resultados de la consulta, indices numericos y asociativos
<Pre-condiciones>
<Post-condiciones>la matriz con los valores del resultado se obtiene por medio de la funci�n Resultado
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
        }
        
    }
/*
<Clase>SQL
<Nombre>ejecutar_sql_MySql
<Parametros>sql-cadena con el codigo a ejecutar
<Responsabilidades>ejecutar el comando recibido en la cadena sql
<Notas>Se utiliza generalmente para busquedas cuyos comandos se optienen de referencias que est�n en la base de datos,
la matriz con los valores del resultado se obtiene por medio de la funci�n Resultado
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generar� una excepcion
<Salida>
<Pre-condiciones>
<Post-condiciones>la matriz con los valores del resultado se obtiene por medio de la funci�n Resultado
*/      
  function Ejecutar_Sql_MySql($sql)
    {$this->filas=0;
     if($sql && $sql<>""){
        $this->res=mysqli_query($this->Conn->conn, $sql);// or error("Error al Ejecutar:  $sql --- ".mysql_error());
        if($this->res)
        {if(strpos(strtolower($sql),"insert")!==false) 
            $this->ultimo_insert=$this->Ultimo_Insert_Mysql();
         else if(strpos(strtolower($sql),"select")!==false)
            {$this->ultimo_insert=0;  
             $this->filas=mysqli_num_rows($this->res);
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
    
 function Ejecutar_Sql_Oracle($sql)
    {//echo $sql;
      $this->consulta=$sql;
      $rs=@OCIParse($this->Conn->conn,$sql);
      if($rs)
        {
          if(@OCIExecute($rs,OCI_COMMIT_ON_SUCCESS))
            {$this->res=$rs; 

             if(strpos(strtolower($sql),"insert")!==false)
                {$this->ultimo_insert=$this->Ultimo_Insert_Oracle();
                 //echo $this->ultimo_insert;
                 //die($this->consulta);
                }
             else
                {$this->ultimo_insert=0;
                }   
            }
        /*  else
           {print_r(OCIError ($rs));
            echo ($_SERVER["PHP_SELF"]."<br />".$sql);
           } */
        }   
    /* else
       {print_r(OCIError ($rs)); 
          echo ($_SERVER["PHP_SELF"]."<br />".$sql);
       }*/
      if(strpos(strtolower($sql),'select')!==false)
         {//echo "select count(*) as contarfilas from(".$sql.")<br />";
          $rs2=@OCIParse($this->Conn->conn,"select count(*) as contarfilas from(".$sql.")");  
                                                 
          if(!OCIExecute($rs2,OCI_COMMIT_ON_SUCCESS))
             {//print_r(OCIError ($rs));
              //echo ($_SERVER["PHP_SELF"]."<br />".$sql);
             }
         
          $temp=phpmkr_fetch_array($rs2);
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
        if($arreglo=@mysqli_fetch_array($this->res, MYSQLI_BOTH)){
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
      if(@OCIFetchInto($rs, $arreglo, OCI_NUM)) 
        {
          return($arreglo);
        }  
      else 
          {
           return(FALSE);
          } 
      break;
    }
  }            
/*
<Clase>SQL
<Nombre>Insertar.
<Parametros>campos-los campos a insertar; tabla-nombre de la tabla donde se har� la inserci�n;
valores-los valores a insertar
<Responsabilidades>Llamar a la funcion que corresponda al motor de base de datos para realizar la inserci�n
<Notas>Enmascarada para agregar otros motores de bases de datos
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/   
  function  Insertar($campos, $tabla, $valores)
    { $valores = html_entity_decode((utf8_decode($valores)));
        switch ($this->motor)
        {
            case "MySql":
                $this->Insertar_MySql($campos, $tabla, $valores);
                break;
        }
    }
/*
<Clase>SQL
<Nombre>Insertar_MySql.
<Parametros>campos-los campos a insertar; tabla-nombre de la tabla donde se har� la inserci�n;
valores-los valores a insertar
<Responsabilidades>Ejecutar una consulta del tipo insert en una base de datos mysql
<Notas>
<Excepciones>Cualquier problema con la ejecucion del INSERT generar� una excepcion
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/  
  function Insertar_MySql($campos, $tabla, $valores)
    {
      //$funcionario=usuario_actual("id");
      if ($campos == "" || $campos == null)
           $insert = "INSERT INTO " . $tabla . " VALUES (" . $valores . ")";
      else
           $insert = "INSERT INTO " . $tabla . "(" . $campos . ") VALUES (" . $valores . ")";
       // ejecucion de la consulta
       //echo($insert); die();
      $this->res=mysqli_query($this->Conn, $insert);    
       $this->Guardar_log($insert);
      //$llave = this->Ultimo_Insert();
      
      // copia en del log, en la tabla evento
      //$evento = "INSERT INTO evento (`funcionario_codigo`, `fecha`, `evento`, `tabla`, `codigo`, `estado`,`detalle`) VALUES('".$funcionario."','".date('Y-m-d H:i:s')."' ,'ADICIONAR', '$tabla', $llave, '0','')";
      
      //$this->res=mysql_query($evento,$this->Conn) or die("Error: ".mysql_error());
    }
/*
<Clase>SQL
<Nombre>Modificar.
<Parametros>tabla-nombre de la tabla donde se har� la modificacion;
 actualizaciones-Aquellos registros que ser�n modificados y sus nuevos valores;
 where-filtro de los registros que ser�n modificados
<Responsabilidades>Llamar a la funcion que corresponda al motor de base de datos para realizar la modificacion
<Notas>Enmascarada para agregar otros motores de bases de datos
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/      
  function Modificar($tabla, $actualizaciones, $where)
    { $actualizaciones = html_entity_decode((utf8_decode($actualizaciones)));
        switch ($this->motor)
        {
            case "MySql":
              $this->Modificar_MySql($tabla, $actualizaciones, $where);
              break;
        }
    }
/*
<Clase>SQL
<Nombre>Modificar_MySql.
<Parametros>tabla-nombre de la tabla donde se har� la modificacion;
 actualizaciones-Aquellos registros que ser�n modificados y sus nuevos valores;
 where-filtro de los registros que ser�n modificados
<Responsabilidades>Ejecutar una sentencia de tipo UPDATE en una base de datos MySql
<Notas>
<Excepciones>Cualquier problema con la ejecucion del UPDATE generar� una excepcion
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
  //funci�n update para mysql
  function Modificar_MySql($tabla, $actualizaciones, $where)
    {
       if ($where != null && $where != "")
           $update = "UPDATE " . $tabla." SET " . $actualizaciones . " WHERE " . $where;
       else
           $update = "UPDATE " . $tabla . " SET " . $actualizaciones;
       // ejecucion de la consulta      
       $this->Guardar_log($update);
       $this->res=mysqli_query($this->Conn, $update);        
        // 
    }
/*
<Clase>SQL
<Nombre>ejecutar_sql_tipo.
<Parametros>sql-cadena con el codigo a ejecutar
<Responsabilidades>seg�n el motor llamar a la funci�n que ejecutar� la cadena sql
<Notas>el vector retornado es del tipo. resultado[0]='campo',resultado[1]='valor_campo'...
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
  //ejecuta un sql que debe devuelve un solo registro
  function Ejecutar_Sql_Tipo($sql)
    { $sql = html_entity_decode((utf8_decode($sql)));
      switch ($this->motor)
          {
              case "MySql":
                return($this->Ejecutar_Sql_Tipo_MySql($sql));
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
     $this->res=mysqli_query($this->Conn, $this->consulta);
      $this->Guardar_log($sql);
     while($fila=mysqli_fetch_row($this->res))
        {foreach($fila as $valor)  
            $resultado[]=$valor;
        }  
     return $resultado;
    }
/*
<Clase>SQL
<Nombre>Eliminar.
<Parametros>tabla-nombre de la tabla donde se har� la eliminacion; where-cuales son los registros a eliminar
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
          }
    }
/*
<Clase>SQL
<Nombre>Eliminar_MySql.
<Parametros>tabla-nombre de la tabla donde se har� la eliminacion; where-cuales son los registros a eliminar
<Responsabilidades>Ejecutar una sentencia DELETE en una base de datos MySql
<Notas>
<Excepciones>Cualquier problema con la ejecucion del DELETE generar� una excepcion
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
       $this->res=mysqli_query($this->Conn, $delete);
       //
    }
/*
<Clase>SQL
<Nombre>Resultado.
<Parametros>
<Responsabilidades>Retornar en una matriz el resultado de la �ltima consulta
<Notas>se utiliza para obtener los resultados de la funci�n Ejecutar_Sql
<Excepciones>
<Salida>devuelve una matriz asociativa con los valores de la �ltima consulta
<Pre-condiciones>$this->res debe apuntar al objeto de consulta utilizado la �ltima vez
<Post-condiciones>
*/    
  function Resultado_MySql()
    {$resultado["sql"]=$this->consulta;  
     $resultado["numcampos"]=$this->Numero_Filas();
       if($this->Numero_Filas()>0)
          {for($i=0;$i<$this->Numero_Filas();$i++)
              {$resultado[$i]=mysqli_fetch_array($this->res, MYSQLI_ASSOC);
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
/*
<Clase>SQL
<Nombre>Rows_Count
<Parametros>
<Responsabilidades>Retornar el n�mero de filas afectadas en la �ltima consulta
<Notas>se utiliza despu�s de la funci�n Insertar
<Excepciones>
<Salida>n�mero de filas devueltas en la �ltima consulta
<Pre-condiciones>$this->res debe apuntar al objeto de consulta utilizado la �ltima vez
<Post-condiciones>
*/
  function Rows_Count()
    {mysqli_affected_rows($this->res);
    }
/*
<Clase>SQL
<Nombre>Numero_Filas
<Parametros>
<Responsabilidades>Retornar el n�mero de filas devueltas en la �ltima consulta
<Notas>se utiliza despu�s de la funci�n ejecutar_sql
<Excepciones>
<Salida>n�mero de filas devueltas en la �ltima consulta
<Pre-condiciones>$this->res debe apuntar al objeto de consulta utilizado la �ltima vez
<Post-condiciones>
*/    
  function Numero_Filas($rs=Null)
    {
      return($this->filas);
    }
/*
<Clase>SQL
<Nombre>Tipo_Campo
<Parametros>pos-posici�n del campo en el array resultado
<Responsabilidades>llama a la funcion requerida dependiendo del motor de bd
<Notas>se utiliza despu�s de la funci�n ejecutar_sql
<Excepciones>
<Salida>tipo del campos especificado
<Pre-condiciones>$this->res debe apuntar al objeto de consulta utilizado la �ltima vez
<Post-condiciones>
*/     
  function Tipo_Campo($rs,$pos)
    {
     if($this->motor=="Oracle")
       return(oci_field_type($rs,$pos+1));
     elseif($this->motor=="MySql")
       return(((is_object($___mysqli_tmp = mysqli_fetch_field_direct($rs, 0)) && !is_null($___mysqli_tmp = $___mysqli_tmp->type)) ? ((($___mysqli_tmp = (string)(substr(( (($___mysqli_tmp == MYSQLI_TYPE_STRING) || ($___mysqli_tmp == MYSQLI_TYPE_VAR_STRING) ) ? "string " : "" ) . ( (in_array($___mysqli_tmp, array(MYSQLI_TYPE_TINY, MYSQLI_TYPE_SHORT, MYSQLI_TYPE_LONG, MYSQLI_TYPE_LONGLONG, MYSQLI_TYPE_INT24))) ? "int " : "" ) . ( (in_array($___mysqli_tmp, array(MYSQLI_TYPE_FLOAT, MYSQLI_TYPE_DOUBLE, MYSQLI_TYPE_DECIMAL, ((defined("MYSQLI_TYPE_NEWDECIMAL")) ? constant("MYSQLI_TYPE_NEWDECIMAL") : -1)))) ? "real " : "" ) . ( ($___mysqli_tmp == MYSQLI_TYPE_TIMESTAMP) ? "timestamp " : "" ) . ( ($___mysqli_tmp == MYSQLI_TYPE_YEAR) ? "year " : "" ) . ( (($___mysqli_tmp == MYSQLI_TYPE_DATE) || ($___mysqli_tmp == MYSQLI_TYPE_NEWDATE) ) ? "date " : "" ) . ( ($___mysqli_tmp == MYSQLI_TYPE_TIME) ? "time " : "" ) . ( ($___mysqli_tmp == MYSQLI_TYPE_SET) ? "set " : "" ) . ( ($___mysqli_tmp == MYSQLI_TYPE_ENUM) ? "enum " : "" ) . ( ($___mysqli_tmp == MYSQLI_TYPE_GEOMETRY) ? "geometry " : "" ) . ( ($___mysqli_tmp == MYSQLI_TYPE_DATETIME) ? "datetime " : "" ) . ( (in_array($___mysqli_tmp, array(MYSQLI_TYPE_TINY_BLOB, MYSQLI_TYPE_BLOB, MYSQLI_TYPE_MEDIUM_BLOB, MYSQLI_TYPE_LONG_BLOB))) ? "blob " : "" ) . ( ($___mysqli_tmp == MYSQLI_TYPE_NULL) ? "null " : "" ), 0, -1))) == "") ? "unknown" : $___mysqli_tmp) : false)); 
    }

/*
<Clase>SQL
<Nombre>Nombre_Campo
<Parametros>pos-posici�n del campo en el array resultado
<Responsabilidades>llama a la funcion requerida dependiendo del motor de bd
<Notas>se utiliza despu�s de la funci�n ejecutar_sql
<Excepciones>
<Salida>nombre del campos especificado
<Pre-condiciones>$this->res debe apuntar al objeto de consulta utilizado la �ltima vez
<Post-condiciones>
*/     

  function Nombre_Campo($rs,$pos)
    {if($this->motor=="Oracle")
       return(strtolower(oci_field_name($rs,$pos+1)));
     elseif($this->motor=="MySql")
       return(((($___mysqli_tmp = mysqli_fetch_field_direct($rs, $pos)->name) && (!is_null($___mysqli_tmp))) ? $___mysqli_tmp : false));   
    }

/*
<Clase>SQL
<Nombre>Lista_Tabla
<Parametros>db-nombre de la base de datos a listar
<Responsabilidades>Retornar en una matriz las tablas de la base de datos especificada
<Notas>
<Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generar� una excepcion
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/  
  function Lista_Tabla($db)
    {$this->res=mysqli_query($GLOBALS["___mysqli_ston"], "SHOW TABLES FROM $db") or die("Error en la Ejecucui�n del Proceso SQL: ".((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
     while($row=mysqli_fetch_row($this->res))
          $resultado[]=$row[0]; 
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
  function Lista_Bd()
    {$this->res=(($___mysqli_tmp = mysqli_query($this->Conn, "SHOW DATABASES")) ? $___mysqli_tmp : false) or die("Error ".((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
     while($row=mysqli_fetch_row($this->res))
          $resultado[]=$row[0]; 
     asort($resultado);
     return($resultado);
    }
/*
<Clase>SQL
<Nombre>Busca_Tabla
<Parametros>tabla-nombre de la tabla a examinar
<Responsabilidades>segun el motor llama la funci�n correspondiente
<Notas>
<Excepciones>
<Salida>matriz con la lista de los campos de una tabla
<Pre-condiciones>
<Post-condiciones>
*/
  function Busca_Tabla($tabla) 
    {  switch ($this->motor)
        {
            case "MySql":
               return($this->Busca_tabla_MySql($tabla));
                break;
        } 
    }
/*
<Clase>SQL
<Nombre>Busca_Tabla_MySql
<Parametros>tabla-nombre de la tabla a examinar
<Responsabilidades>Retornar en una matriz la lista de los campos de una tabla
<Notas>
<Excepciones>
<Salida>matriz con la lista de los campos de una tabla
<Pre-condiciones>
<Post-condiciones>
*/    
  function Busca_tabla_MySql($tabla)
    {$this->consulta="show columns from ".$tabla;
     $this->res=mysqli_query($this->Conn, $this->consulta);
     while($row=mysqli_fetch_row($this->res))
          $resultado[]=$row[0]; 
     asort($resultado);      
     return($resultado);
    }
/*
<Clase>SQL
<Nombre>Buscar_Limit
<Parametros>campos-los campos a buscar; tablas-tablas donde se realizar� la busqueda;
 where-filtro de la b�squeda; order_by-columna para el orden; limit-numero de registros a recuperar
<Responsabilidades>segun el motor llama la funci�n correspondiente
<Notas>Funciona igual que Buscar_MySql pero con el parametro limit, fue necesaria su creacion al no tener en cuenta este parametro con anterioridad
<Excepciones>Cualquier problema con la ejecucion del SELECT generar� una excepcion
<Salida>una matriz con los "limit" resultados de la busqueda
<Pre-condiciones>
<Post-condiciones>
*/    
  //devuelve los primeros $limit registros de la consulta en un array
  function Ejecutar_Limit($sql,$inicio,$fin,$conn)
    {switch ($this->motor)
        {
            case "MySql":
               return($this->Ejecutar_Limit_MySql($sql,$inicio,$fin,$conn));
               break;
            case "Oracle":
               return($this->Ejecutar_Limit_Oracle($sql,$inicio,$fin,$conn));
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
<Excepciones>Cualquier problema con la ejecucion del SELECT generar� una excepcion
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
     $res=mysqli_query($conn->Conn->conn, $consulta) or die("consulta fallida ".((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
     return($res);
    }
/*
<Clase>SQL
<Nombre>Ejecutar_Limit_Oracle
<Parametros>$sql-consulta a ejecutar; $inicio-primer registro a buscar; $fin-ultimo registro a buscar;
$conn-objeto de tipo sql
<Responsabilidades>Realizar la busqueda de cierta cantidad de filas de una tabla
<Notas>Funciona igual que Buscar_MySql pero con el parametro limit, fue necesaria su creacion al no tener en cuenta este parametro con anterioridad
<Excepciones>Cualquier problema con la ejecucion del SELECT generar� una excepcion
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
<Responsabilidades>llama a la funci�n deseada
<Notas>
<Excepciones>Cualquier problema con la ejecucion del comando generar� una excepcion
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
        } 
    }
/*
<Clase>SQL
<Nombre>total_registros_tabla.
<Parametros>tabla-nombre de la tabla a consultar
<Responsabilidades>consultar el n�mero total de registros de una tabla para mysql
<Notas>
<Excepciones>Cualquier problema con la ejecucion del comando generar� una excepcion
<Salida>devuelve un entero con el numero de filas de la tabla
<Pre-condiciones>
<Post-condiciones>
*/    
  function Total_Registros_Tabla_MySql($tabla)
    {$this->consulta="SELECT COUNT( * ) AS TOTAL FROM ".$tabla;
     $this->res=mysqli_query($this->Conn, $this->consulta) ;
     $total=mysqli_fetch_row($this->res);
     return($total[0]);
    }
/*
<Clase>SQL
<Nombre>Numero_Campos
<Parametros>
<Responsabilidades>segun el motor llama la funci�n deseada
<Notas>se utiliza despu�s de la hacer una consulta de seleccion (select)
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/   
   function Numero_Campos($rs)
    {if($this->motor=="Oracle")
       return(OCINumCols($rs));
     elseif($this->motor=="MySql")
       return((($___mysqli_tmp = mysqli_num_fields($rs)) ? $___mysqli_tmp : false));
    } // Fin Funcion General Ultimo Insert 
    

/*
<Clase>SQL
<Nombre>Ultimo_Insert
<Parametros>
<Responsabilidades>segun el motor llama la funci�n deseada
<Notas>se utiliza despu�s de la funci�n insert
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
        }
        return FALSE; 
    } // Fin Funcion General Ultimo Insert
  
/*
<Clase>SQL
<Nombre>Ultimo_Insert_Mysql
<Parametros>
<Responsabilidades>Retornar el identificador del ultimo registro insertado
<Notas>se utiliza despu�s de la funci�n insert
<Excepciones>
<Salida>identificador del ultimo registro insertado
<Pre-condiciones>
<Post-condiciones>
*/  
  function Ultimo_Insert_Mysql() 
    {// alerta(@mysql_insert_id());
    	return @((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
    }  
/*
<Clase>SQL
<Nombre>Ultimo_Insert_Oracle
<Parametros>
<Responsabilidades>Retornar el identificador del ultimo registro insertado
<Notas>se utiliza despu�s de la funci�n insert
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
          $posinto=strpos(strtoupper($this->consulta), ".");
          $posval=strpos(strtoupper($this->consulta), "VALUES");
          $tabla=substr($this->consulta,$posinto+1,$posval-$posinto);
          $tabla=trim($tabla);          
          $parent=strpos($tabla,"(");
          if($parent)
            $tabla=substr($tabla,0,$parent);
        
          $tabla=trim($tabla);  
          if(strlen($tabla)>26)
             $aux=substr($tabla,0,26);
          else
             $aux=$tabla;        
          $sql_id="SELECT ".DB.".".$aux."_SEQ.currval FROM DUAL";
          $rs_temp=@OCIParse($this->Conn->conn,$sql_id);
          if(@OCIExecute($rs_temp)){
            @OCIFetchInto ($rs_temp,$arreglo,OCI_NUM);
            $identificador=$arreglo[0]; 
            //print_r($arreglo);
          }
          /*else
           print_r(OCIError ($rs_temp)); */
          @OCIFreeStatement($rs_temp);
          @ocicancel($rs_temp);

        break;        
        }
      return($identificador);
    }

function Guardar_log($strsql)
  {global $conn;
  $sqleve="";
  $sql = trim($strsql);
  $sql = str_replace('`','',$sql);
  $accion = strtoupper(substr($sql,0,strpos($sql,' '))); 
  //echo   $strsql;
  if($accion == 'SELECT')
    return false;
  //else
   // die($strsql);  
  $tabla = ""; 
  $llave=0; 
  $string_detalle="";  
  $func = $_SESSION["usuario_actual"];
  $this->ultimo_insert=0;

  if(isset($_SESSION)){  
   $fecha=fecha_db_almacenar(date("Y-m-d h:i:s"),"Y-m-d h:i:s");
   
     if($sqleve<>"")     
       {
        if($this->motor=="MySql")  
           {
            $result=mysqli_query($this->Conn->conn, $sqleve) ;
            if(!$result)
               die(" Error en la consulta: ".((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))); 
           }
        elseif($this->motor=="Oracle")  
          {//echo $sqleve;
           $rs=@OCIParse($this->Conn->conn,$sqleve);
           if($rs)
            {
              if(@OCIExecute($rs,OCI_COMMIT_ON_SUCCESS))
                {$this->res=$rs;
                } 
              else 
                {$this->error=OCIError($rs);         
                }
            }
          }
        $registro=$conn->Ultimo_Insert();
          
       }  
  }
  }     
}
?>

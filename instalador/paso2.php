<?php  
  include_once("../sql.php");
  $sql=file_get_contents("saia.sql");
  $retorno=splitsql($sql);
  $datos=array('basedatos'=>@$REQUEST["BASEDATOS"],'db'=>@$REQUEST["DB"],'motor'=>@$REQUEST["MOTOR"],'host'=>@$REQUEST["HOST"],'user'=>@$REQUEST["USER"],'pass'=>@$REQUEST["PASS"],'port'=>@$REQUEST["PORT"]);
  $conexion=new conexion($datos);
  $conn2=new SQL($conexion,@$REQUEST["MOTOR"]);
  if($conn2 && $conn2->Conn){
    $sql="CREATE DATABASE ".@$REQUEST["BASEDATOS"];
    $conn2->conn->Ejecutar_Sql($sql);
    $conexion->Reconexion();
    foreach($retorno as $key=>$value){
      $conn2->conn->Ejecutar_Sql($value);  
    }      
  }
  else{
     error("Error al conectarse con la Base de datos.".$conn->consulta);
     return FALSE;
  }
  
	function splitSql($sql)
	{
		$sql = trim($sql);
		$sql = preg_replace("/\n\#[^\n]*/", '', "\n".$sql);
		$buffer = array ();
		$ret = array ();
		$in_string = false;

		for ($i = 0; $i < strlen($sql) - 1; $i ++) {
			if ($sql[$i] == ";" && !$in_string)
			{
				$ret[] = substr($sql, 0, $i);
				$sql = substr($sql, $i +1);
				$i = 0;
			}

			if ($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\")
			{
				$in_string = false;
			}
			elseif (!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset ($buffer[0]) || $buffer[0] != "\\"))
			{
				$in_string = $sql[$i];
			}
			if (isset ($buffer[1]))
			{
				$buffer[0] = $buffer[1];
			}
			$buffer[1] = $sql[$i];
		}

		if (!empty ($sql))
		{
			$ret[] = $sql;
		}
		return ($ret);
	}
?>
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
include_once($ruta_db_superior."db.php");
switch($_REQUEST["opcion"])
{case '1':
 $padre=busca_filtro_tabla("ejecutor,tipo_radicado,plantilla","documento","iddocumento=".$_REQUEST["adicionales"],"",$conn);
 if($_REQUEST["formato_origen"]!='' && $_REQUEST["adicionales"]!=""){
 	$padre=busca_filtro_tabla("ejecutor,tipo_radicado,plantilla, b.*","documento a, ft_".$_REQUEST["formato_origen"]." b","iddocumento=".$_REQUEST["adicionales"]." AND documento_iddocumento=iddocumento","",$conn);
	 
	 if($padre["numcampos"]){
	 	echo "1|".$padre[0][$_REQUEST["campo"]];
	 }
	 else{
	 	$padre=busca_filtro_tabla("ejecutor,tipo_radicado,plantilla","documento a","iddocumento=".$_REQUEST["adicionales"],"",$conn);
		if($padre["numcampos"]){
			echo "1|".$padre[0]["ejecutor"];
		}
		else{
			echo "0";
		}
	 }
 }
 else if($padre[0]["tipo_radicado"]==1 && $_REQUEST["adicionales"])
    echo "1|".$padre[0]["ejecutor"];
 else
   echo "0"; 
 break;
 case '2':
  header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename=remitentes.csv');
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  echo $_REQUEST["destinos"]."||".$_REQUEST["copias"];
 break;
 case '3':
	 include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
   ?>
   <form action="" name="form1" enctype="multipart/form-data" method="post">
   <input type="file" name="archivo" >
   <input type="submit" value="Cargar" >
   <input type="hidden" value="4" name="opcion" >
   </form>
   <table>
   	<tr>
   		<td>Tener en cuenta:</td>
   	</tr>
   	<tr>
   		<td>
   			<ul>
   				<li>Se debe crear el excel</li>
   				<li>El excel debe tener 9 columnas como lo muestra el siguiente ejemplo <a href="carga.xls" target="_blank">ejemplo.xls</a></li>
   				<li>Despu&eacute;s de tener el excel de esta manera, se debe exportar al formato "csv", con la opci&oacute;n delimitado por coma (,)</li>
   				<li>Notas:<br />
   				1. El archivo de excel siempre debe tener las 9 columnas, en caso de que no exista datos para esa columna se debe dejar vacio y la columna se conserva.<br />
   				2. Los datos no deben contener caracteres especiales y el caracter coma(,) ya que este es el delimitador de las columnas.<br />
   				Nota: Se deben seguir las instrucciones para que los datos sean cargados sin inconvenientes.
   				</li>
   				<li>Posterior a estos pasos, ya se puede subir el archivo para que los remitentes sean cargados</li>
   				<li>Dar clic en cargar</li>
   			</ul>
   		</td>
   	</tr>
   </table>
   <?php
 break; 
 case '4':
    if($_FILES["archivo"]["error"])
      alerta("No se pudo cargar el archivo");
    else{
    	$link=fopen($_FILES["archivo"]["tmp_name"],'r');
    	$valores=array();
			$a=0;
			while($linea=fgetcsv($link,0,",")){
				$a++;
				if($a==1)continue;
				$valores[]=datos_proveedor($linea[0],$linea[1],$linea[2],$linea[3],$linea[4],$linea[5],$linea[6],$linea[7],$linea[8]);
			}
      fclose($link);
      $cant=count($valores);
			if($cant>=1){
      	echo "<script>window.parent.document.getElementById('destinos').value='".implode(",",$valores)."';
              window.parent.document.getElementById('frame_destinos').src='../librerias/acciones_ejecutor.php?formulario_autocompletar=formulario_formatos&campo_autocompletar=copia&tabla=ft_carta&campos_auto=nombre,identificacion&tipo=multiple&campos=cargo,empresa,direccion,telefono,email,titulo,ciudad&destinos=".implode(",",$valores)."';
        </script>";
			}
      echo "<script>window.parent.hs.close();</script>";   
		}  
	break;
}
function datos_proveedor($nombre,$identificacion,$cargo,$empresa,$direccion,$telefono,$email,$titulo,$ciudad){
  global $conn;
  unset($_POST);
	
	$search=array("ñ","Ñ");
	$replace=array("&ntilde;","&Ntilde;");
	$nombre=html_entity_decode(str_replace($search, $replace, $nombre));
	$cargo=html_entity_decode(str_replace($search, $replace, $cargo));
	$empresa=html_entity_decode(str_replace($search, $replace, $empresa));
	$direccion=html_entity_decode(str_replace($search, $replace, $direccion));
	$email=str_replace($search, $replace, $email);
	$titulo=html_entity_decode(str_replace($search, $replace, $titulo));
	
	$nombre=($nombre);
	$cargo=($cargo);
	$empresa=($empresa);
	$direccion=($direccion);
	$email=($email);
	$titulo=($titulo);
  
  $campos_ejecutor=array();
  if($cargo){
    $campos_ejecutor[]="cargo";
    $_POST["cargo"]=$cargo;
  }
  if($empresa){
    $campos_ejecutor[]="empresa";
    $_POST["empresa"]=$empresa;
  }
  if($direccion){
    $campos_ejecutor[]="direccion";
    $_POST["direccion"]=$direccion;
  }
  if($telefono){
    $campos_ejecutor[]="telefono";
    $_POST["telefono"]=$telefono;
  }
  if($email){
    $campos_ejecutor[]="email";
    $_POST["email"]=$email;
  }
  if($titulo){
    $campos_ejecutor[]="titulo";
    $_POST["titulo"]=$titulo;
  }
  if($ciudad){
    $campos_ejecutor[]="ciudad";
    $valor=busca_filtro_tabla("","municipio A","A.nombre like '".$ciudad."'","",$conn);
    $_POST["ciudad"]=$valor[0]["idmunicipio"];
  }
  if($nombre){
    $nombre=trim(str_replace(",","",$nombre));
  }
  if($identificacion){
    $identificacion=trim(str_replace(",","",$identificacion));
  }
  $ejecutor["numcampos"]=0;
  if(trim($identificacion)<>""){
    $ejecutor=busca_filtro_tabla("","ejecutor","identificacion LIKE '".@$identificacion."'" ,"",$conn);
  
    if(!$ejecutor["numcampos"]){
      $ejecutor=busca_filtro_tabla("","ejecutor","lower(nombre) LIKE lower('".@$nombre."') and (identificacion is null or identificacion='')","",$conn);
    }
  }
  elseif(trim($nombre)<>""){
    $ejecutor=busca_filtro_tabla("","ejecutor","lower(nombre) LIKE lower('".@$nombre."')","",$conn);
  }
  if($ejecutor["numcampos"]){
    $otros=""; 
    if(isset($identificacion)&&$identificacion&&$identificacion<>"undefined"){
      $otros.=",identificacion='".$identificacion."'";
    }
    $sql="UPDATE ejecutor SET nombre ='".@$nombre."'".$otros." WHERE idejecutor=".$ejecutor[0]["idejecutor"];
    phpmkr_query($sql);
    $idejecutor=$ejecutor[0]["idejecutor"];
  }
  else{
    $sql="INSERT INTO ejecutor(nombre,identificacion)VALUES('".@$nombre."','".@$identificacion."')";
    phpmkr_query($sql);
		$idejecutor=phpmkr_insert_id();
    $insertado=1;
  }
  $campos_excluidos=array("nombre","identificacion");
  $campos_ejecutor=array_diff($campos_ejecutor,$campos_excluidos);
  sort($campos_ejecutor);
  $campos_todos=array("direccion","telefono","email","cargo","empresa","ciudad","titulo","codigo");
  
  $condicion_actualiza="";
  for($i=0;$i<count($campos_ejecutor);$i++){
    if(isset($_POST[$campos_ejecutor[$i]])){
      if($_POST[$campos_ejecutor[$i]])
        $condicion_actualiza.=' AND '.$campos_ejecutor[$i]."='".$_POST[$campos_ejecutor[$i]]."'";
      else{
        $condicion_actualiza.=' AND ('.$campos_ejecutor[$i]." IS NULL or ".$campos_ejecutor[$i]."='')";
      }
    }  
  }
  $datos_ejecutor=busca_filtro_tabla("","datos_ejecutor","ejecutor_idejecutor=".$idejecutor.$condicion_actualiza,"",$conn);

  if((!$datos_ejecutor["numcampos"] ||$insertado) && $condicion_actualiza!=""){
    $datos_ejecutor=busca_filtro_tabla("","datos_ejecutor","ejecutor_idejecutor=".$idejecutor,"iddatos_ejecutor desc",$conn);
    $campos=array();
    $valores=array();
    
    if(!isset($_POST["ciudad"])|| strtolower($_POST["ciudad"])=="undefined"){
      $config=busca_filtro_tabla("valor","configuracion","lower(nombre) like 'ciudad'","",$conn);
      if($config["numcampos"])
        $_POST["ciudad"]=$config[0][0];
      else
        $_POST["ciudad"]=658;
    }
  
  
    for($i=0;$i<=count($campos_todos);$i++){
      if($campos_todos[$i]<>"fecha_nacimiento"){
        if(isset($_POST[$campos_todos[$i]])&&in_array($campos_todos[$i],$campos_ejecutor)){
          array_push($valores,$_POST[$campos_todos[$i]]);
          array_push($campos,$campos_todos[$i]);
          $actualizado=1;
        }
        else if($datos_ejecutor["numcampos"] && $datos_ejecutor[0][$campos_todos[$i]]<>""){
          array_push($valores,$datos_ejecutor[0][$campos_todos[$i]]);
          array_push($campos,$campos_todos[$i]);
        }
      }     
    }
    if($actualizado){
      $valor_insertar="'".implode("','",str_replace("'","''",$valores))."',";
      $campos_insertar=implode(",",$campos).",";
    }
    $sql='INSERT INTO datos_ejecutor('.$campos_insertar."ejecutor_idejecutor,fecha) VALUES(".$valor_insertar.$idejecutor.",".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").")";
    phpmkr_query($sql);
    
    $iddatos_ejecutor=phpmkr_insert_id();
  }
  else if($datos_ejecutor["numcampos"]){
    $iddatos_ejecutor=$datos_ejecutor[0]["iddatos_ejecutor"];
  }
  unset($_POST);
  return($iddatos_ejecutor);
}
?>

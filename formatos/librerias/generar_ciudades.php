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

include_once $ruta_db_superior . 'core/autoload.php';

if(isset($_POST["ciudad"])){
  $pais=busca_filtro_tabla("idpais,nombre","pais","lower(nombre) LIKE '%".strtolower((html_entity_decode(($_POST["pais"]))))."%'","",$conn);
  if($pais["numcampos"] != 0){
    $idpais = $pais[0]["idpais"];
  }else{
    phpmkr_query("INSERT INTO pais (nombre) VALUES ('" . $_POST["pais"] . "')",$conn);
    $idpais = phpmkr_insert_id();
  }

  $dep = busca_filtro_tabla("iddepartamento","departamento","lower(nombre) LIKE '%" . strtolower($_POST["provincia"]) . "%' and pais_idpais = " . $idpais,"",$conn); 
  if($dep["numcampos"] != 0){ 
    $iddep = $dep[0]["iddepartamento"];
  }
  else{ 
    phpmkr_query("INSERT INTO departamento (nombre,pais_idpais) VALUES ('" . $_POST['provincia'] . "', " . $idpais .")",$conn);
    $iddep = phpmkr_insert_id();
  }      

  $municipio = busca_filtro_tabla("idmunicipio","municipio","lower(nombre) LIKE '%" . strtolower($_POST["ciudad"]) . "%' and departamento_iddepartamento = " . $iddep,"",$conn);
  if($dep["numcampos"] != 0){
    $idmun = $municipio[0]["idmunicipio"];
  }else{
    phpmkr_query("INSERT INTO municipio (nombre,departamento_iddepartamento) VALUES ('" . $_POST['ciudad'] . "', " . $iddep . " )",$conn);
    $idmun = phpmkr_insert_id(); 
  }
   
}else if(isset($_REQUEST["ubicacion"])){
  $info ='';
  $pais = busca_filtro_tabla("idpais,nombre","pais","","nombre asc",$conn);
  $info .='<option value="0">Por favor seleccione</option>';
  for ($i=0; $i < $pais["numcampos"] ; $i++) { 
    $info .= '<option value="'.  $pais[$i]['idpais'] .'">' . $pais[$i]['nombre'] . '</option>';
  }
  echo($info);
}else if(isset($_REQUEST["pais"])){
  $info ='';
  $departamento = busca_filtro_tabla("iddepartamento,nombre","departamento","pais_idpais = " . $_REQUEST["pais"],"nombre asc",$conn);
  $info .='<option value="0">Por favor seleccione</option>';
  for ($i=0; $i < $departamento["numcampos"] ; $i++) { 
    $info .= '<option value="'.  $departamento[$i]['iddepartamento'] .'">' . $departamento[$i]['nombre'] . '</option>';
  }
  echo($info);
}else if(isset($_REQUEST["departamento"])){
  $info ='';
  $departamento = busca_filtro_tabla("idmunicipio,nombre","municipio","departamento_iddepartamento = " . $_REQUEST["departamento"],"nombre asc",$conn);
  $info .='<option value="0">Por favor seleccione</option>';
  for ($i=0; $i < $departamento["numcampos"] ; $i++) { 
    $info .= '<option value="'.  $departamento[$i]['idmunicipio'] .'">' . $departamento[$i]['nombre'] . '</option>';
  }
  echo($info);
}

?>


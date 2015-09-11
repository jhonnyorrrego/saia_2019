<?php
include_once("db.php");
include_once("define.php");
set_time_limit(0);
$fecha_inicio="";
/*Feha donde se inicia a realizar el backup de la informacion*/
$fecha_final="";
/*Feha donde se termina el backup de la informacion*/
$destino_scriptdb="";
/* Nombre del Archivo que tendra el Dump de la Base de Datos por defecto nombreBD_fecha.sql*/
$destino="";
/* Nombre completo del Archivo a ser comprimido por defecto debe ser fecha(inicial)_fecha(final).zip*/
$origen="";
/* Carpeta o listado de Carpetas para ser Comprimida*/
$tipo_backup=@$_REQUEST["tipo_backup"];
/* Tipo de backup a realizar
                          1 Completo
                          2 Incremental de la ultima fecha de actualizacion(configuracion BD).
                          3 Fechas desde Fecha inicial hasta Fecha Final(Solicitadas al Usuario).
                          4 Eliminados */
if(@$_REQUEST["items"])
  $items=$_REQUEST["items"];
else $items="b,p,s,a,l,f";
/*Cada de los metodos anteriores se puede sacar de cada una de los siguientes items ellos pueden ir agrupados en un Check box:
                          b Base de Datos
                          p Paginas
                          s Scripts
                          a Adjuntos
                          l Logs
                          f PDF-este esta pendiente*/
$ldocumentos="";
/*Variable que almacena el listado de documentos a los que se le debe sacar el backup*/
$extension_zip="zip";
/*variable que define la extension de los archivos comprimidos -validado por el SO que debe estar en define*/
$ruta_bk="../backup";
crear_destino($ruta_bk);  
/*Variable que define la ubicacion de cada uno de los backups*/

include_once("configuracion_backup.php");
switch($tipo_backup){
  case 1:
    completo();
  break;
  case 2:
    incremental();
  break;
  case 3:
    fechas();
  break;
  case 4:
    eliminados();
  break;
  case 5:
    realizar_copia_diaria();  
  break;
  default:
    alerta("No se define tipo de Backup");
  break;
}
die("Copia Finalizada");

function completo(){
global $fecha_inicio,$fecha_final,$items,$destino_scriptdb,$destino_scripts,
  $destino_paginas,$destino_logs,$destino_anexos,$ruta_bk,$fecha_copia,$dominio_servidor,$usuario_ftp,$clave_ftp,$ruta_origen_datos,$ruta_destino_datos,$borrar_origen,$copiar_ftp,$empresa; 
  echo "Ejecutando backup completo de $empresa<br />"; 
$ruta_bk=RUTA_BACKUP."copia_completa"; 
crear_destino($ruta_bk);
$ruta_origen_datos=RUTA_BACKUP."copia_completa";
$ruta_destino_datos="backups/$empresa/copia_completa";
//$copiar_ftp=0;
if(realizar_copia()){
  $origen_zip=$destino_scriptdb.".zip ".$destino_scripts.".zip ".$destino_paginas.".zip ".$destino_logs.".zip ".$destino_anexos.".zip ";
  //comprimir($origen_zip,$ruta_bk."/bksaia-".$fecha_copia,1);
  actualiza_configuracion("fecha_backup",date("Y-m-d H:i:s"));  
  if($copiar_ftp)
     include_once("tarea_copiar_carpeta_ftp.php");
  return(TRUE);
}
return(FALSE);
}
function incremental(){
global $fecha_inicio,$fecha_final,$destino_scriptdb,$destino_scripts,
  $destino_paginas,$destino_logs,$destino_anexos,$ruta_bk,$fecha_copia;
$config=busca_configuracion("fecha_backup",date("Y-m-d H:i:s"));
if($config["numcampos"]){
  $fecha_inicio=$config[0]["valor"];
  $fecha_final=date("Y-m-d H:i:s");
  if(realizar_copia()){
    $origen_zip=$destino_scriptdb.".zip ".$destino_scripts.".zip ".$destino_paginas.".zip ".$destino_logs.".zip ".$destino_anexos.".zip ";
    comprimir($origen_zip,$ruta_bk."/bksaia-".$fecha_copia,1);
    actualiza_configuracion("fecha_backup",date("Y-m-d H:i:s"));
    return(TRUE);
  }
}
return(FALSE);
}

function fechas(){
global $fecha_inicio,$fecha_final,$destino_scriptdb,$destino_scripts,
  $destino_paginas,$destino_logs,$destino_anexos,$ruta_bk,$fecha_copia;
if(@$_REQUEST["fecha_inicio"])
  $fecha_inicio=$_REQUEST["fecha_inicio"];
if(@$_REQUEST["fecha_final"])
  $fecha_final=$_REQUEST["fecha_final"];
  if(realizar_copia()){
    $origen_zip=$destino_scriptdb.".zip ".$destino_scripts.".zip ".$destino_paginas.".zip ".$destino_logs.".zip ".$destino_anexos.".zip ";
    comprimir($origen_zip,$ruta_bk."/bksaia-".$fecha_copia,1);
    actualiza_configuracion("fecha_backup",date("Y-m-d H:i:s"));
    return(TRUE);
  }
return(FALSE);
}
/*function fecha_in($fecha){
return($fecha);
}

function fecha_out($fecha){
return($fecha);
} */
function realizar_copia_diaria(){
global $fecha_inicio,$fecha_final,$items,$destino_scriptdb,$destino_scripts,
$destino_paginas,$destino_logs,$destino_anexos,$ldocumentos,$extension_zip,$conn,$ruta_bk,$fecha_copia,$dominio_servidor,$usuario_ftp,$clave_ftp,$ruta_origen_datos,$ruta_destino_datos,$borrar_origen,$copiar_ftp,$empresa;
$fecha_inicio=date("Y-m-d"); 
$fecha_final=date("Y-m-d"); 
$fecha_copia=date("Y-m-d-H-i");
echo "Ejecutando copia diaria de $empresa";
$ruta_bk=RUTA_BACKUP."copias_diarias/".date("Y")."/".date("m")."/".date("d");
crear_destino($ruta_bk);
$litems=explode(",",$items);
$origen_zip=" ";
$fechas="";
if($fecha_inicio<>""){
  $fechas.=" AND ".fecha_db_obtener("evento.fecha","Y-m-d")." >='$fecha_inicio'";
}
if($fecha_final<>""){
  $fechas.=" AND ".fecha_db_obtener("evento.fecha","Y-m-d")." <='$fecha_final'";
}
if($fecha_inicio<>"" && $fecha_final<>"")
  {$eventos_doc=busca_filtro_tabla("distinct registro_id,tabla_e","evento"," tabla_e ='documento' ".$fechas,"",$conn);   

   $eventos_pag=busca_filtro_tabla("distinct id_documento","evento,pagina"," tabla_e ='pagina' and consecutivo=registro_id ".$fechas,"",$conn); 
   $eventos_anexo=busca_filtro_tabla("distinct documento_iddocumento","evento,anexos","tabla_e ='anexos' and idanexos=registro_id ".$fechas,"",$conn); 
   $ldocumentos=array_merge(extrae_campo($eventos_doc,"registro_id",""),extrae_campo($eventos_pag,"id_documento",""),extrae_campo($eventos_anexo,"documento_iddocumento",""));
   $ldocumentos=array_unique($ldocumentos);
   sort($ldocumentos);
  }
else $ldocumento["numcampos"]=0;
if($ldocumento["numcampos"]){
  $ldocumentos=extrae_campo($ldocumento,"iddocumento","U");
}
elseif(!is_array($ldocumentos)) 
  $ldocumentos="";

for($i=0;$i<count($litems);$i++){
  switch($litems[$i]){
    case "b":
      if(bk_base_datos()){
      }
    break;
    case "p":
      if(bk_paginas()){
      }
    break;
    case "s":
      if(bk_scripts()){
      }
    break;
    case "a":
      if(bk_adjuntos()){
      }
    break;
    case "l":
      if(bk_logs()){
      }
    break;
    case "f":
      if(bk_pdfs()){
      }
    break;
  }
}
if($copiar_ftp)
include_once("tarea_copiar_carpeta_ftp.php");
return(TRUE);
}
function realizar_copia(){
global $fecha_inicio,$fecha_final,$items,$destino_scriptdb,$destino_scripts,
  $destino_paginas,$destino_logs,$destino_anexos,$ldocumentos,$extension_zip,$conn,$ruta_bk,$fecha_copia;
 
$fecha_copia=date("Y-m-d-H-i");
if($ruta_bk==""){
$destino=busca_configuracion("ruta_copias","../backup");
if($destino["numcampos"]){
  $ruta_bk=$destino[0]["valor"];
}  
}
$litems=explode(",",$items);
$origen_zip=" ";
$where="A.iddocumento=B.documento_iddocumento A.estado NOT IN('ELIMINADO')";
if($fecha_inicio<>""){
  $where.=" AND fecha >='".fecha_out($fecha_inicio)."'";
}
if($fecha_final<>""){
  $where.=" AND fecha <='".fecha_out($fecha_final)."'";
}
if($fecha_inicio<>"" && $fecha_final<>"")
  $ldocumento=busca_filtro_tabla("A.iddocumento","documento A",$where,"fecha ASC",$conn);
else $ldocumento["numcampos"]=0;
if($ldocumento["numcampos"]){
  $ldocumentos=extrae_campo($ldocumento,"iddocumento","U");
}
else $ldocumentos="";
for($i=0;$i<count($litems);$i++){
  switch($litems[$i]){
   case "b":
      if(bk_base_datos()){
      }
    break;      
    case "p":
      if(bk_paginas()){
      }
    break;
   case "s":
      if(bk_scripts()){
      }
    break;
    case "a":
      if(bk_adjuntos()){
      }
    break;
   case "l":
      if(bk_logs()){
      }
   break;
     case "f":
      if(bk_pdfs()){
      }
    break; 
  }
}
return(TRUE);
}
/*Esta funcion debe ir en DB y sirve para modiifcar el valor de una configuracion si no existe la crea revisar la funcion busca_configuracion*/
function actualiza_configuracion($nombre,$valor){
global $conn;
  $config=busca_configuracion($nombre,$valor);
  if($config["numcampos"]){
    $sql="UPDATE configuracion SET valor='".$valor."' WHERE idconfiguracion=".$config[0]["idconfiguracion"];
    //echo($sql);
    if(ejecuta_sql($sql,$conn))
      return(TRUE);
  }
return FALSE;
}
function bk_base_datos(){
global $ruta_bk,$fecha_copia;
$destino_scriptdb=$ruta_bk."/".DB.$fecha_copia; 
verifica_ruta($destino_scriptdb);
 
switch(MOTOR){
  case "MySql":
    //if(is_file("mysqldump.exe")){
      $comando="mysqldump ".DB." -u".USER." -p".PASS." -r ".$destino_scriptdb;
      ejecuta_comando($comando);
      if(is_file($destino_scriptdb)){
        comprimir($destino_scriptdb,$destino_scriptdb,1);
        return(TRUE);
      }
      else {
        alerta("Archivo Destino no creado");
        return(FALSE);
      }
   /* }
    else{
      alerta("archivo mysqldump no existe");
      return(FALSE);
    }   */
  break;
  case "Oracle":
    $comando="SET NLS_LANG=AMERICAN_AMERICA.WE8ISO8859P1";
    ejecuta_comando($comando);
    $comando="EXP ".USER."/".PASS."@".BASEDATOS." FILE=".$destino_scriptdb.".dmp BUFFER=2000000 LOG=".$destino_scriptdb.".log OWNER=".USER;
    ejecuta_comando($comando);
    if(is_file($destino_scriptdb.".dmp") && is_file($destino_scriptdb.".log")){
      comprimir($destino_scriptdb.".dmp ".$destino_scriptdb.".log",$destino_scriptdb,1);
      return(TRUE);
    }
    else return(FALSE);
  break;
}
return(FALSE);
}
function bk_paginas(){
global $fecha_inicio,$fecha_final,$conn,$destino_paginas,$ldocumentos,$ruta_bk,$fecha_copia;
$ruta_docs="";
$ruta_miniaturas="";

  $origen_zip_docs="";
if($ldocumentos<>"")
  $paginas=busca_filtro_tabla("imagen,ruta","pagina","id_documento in(".implode(",",$ldocumentos).")","",$conn);
else
  {$paginas=busca_filtro_tabla("imagen,ruta","pagina","","",$conn);
  }

  $carpetas=array();
  for($i=0;$i<$paginas["numcampos"];$i++)
    {$path=pathinfo($paginas[$i]["ruta"]);
     $carpetas[]=$path["dirname"];
     $path=pathinfo($paginas[$i]["imagen"]);
     $carpetas[]=$path["dirname"];
    }
 $carpetas=array_unique($carpetas);
 sort($carpetas);
 $origen_zip_docs=implode(" ",$carpetas);

$destino_paginas=$ruta_bk."/imagenes_documentos-".$fecha_copia;
if($origen_zip_docs)
return(comprimir($origen_zip_docs,$destino_paginas));
}

function bk_eliminados(){
global $destino_scriptdb,$fecha_copia;
$destino_scriptdb="eliminados-".$fecha_copia;
verifica_ruta($destino_scriptdb);
switch(MOTOR){
  case "MySql":
    if(is_file("mysqldump.exe")){
      $comando="mysqldump ".DB." -u".USER." -p".PASS." -r ".$destino_scriptdb;
      ejecuta_comando($comando);
      if(is_file($destino_scriptdb)){
        comprimir($destino_scriptdb,$destino_scriptdb,1);
        return(TRUE);
      }
      else {
        alerta("Archivo Destino no creado");
        return(FALSE);
      }
    }
    else{
      alerta("archivo mysqldump no existe");
      return(FALSE);
    }
  break;
  case "Oracle":
    $comando="SET NLS_LANG=AMERICAN_AMERICA.WE8ISO8859P1";
    ejecuta_comando($comando);
    $ldocs=busca_filtro_tabla("","documento","estado='ELIMINADO'","",$conn);
    if($ldocs["numcampos"]){
      $docs=extrae_campos($ldocs,"iddocumento","U");
      $comando="EXP ".USER."/".PASS."@".BASEDATOS." FILE=".$destino_scriptdb."_documentos_eliminados.dmp tables=documento query=\"where iddocumento IN(".implode(",",$docs).")\" BUFFER=2000000 LOG=".$destino_scriptdb."documento_eliminados.log OWNER=".USER;
      ejecuta_comando($comando);
      $comando="EXP ".USER."/".PASS."@".BASEDATOS." FILE=".$destino_scriptdb."_buzon_salida_eliminados.dmp tables=buzon_salida query=\"where archivo_idarchivo IN(".implode(",",$docs).")\" BUFFER=2000000 LOG=".$destino_scriptdb."documento_eliminados.log OWNER=".USER;
      ejecuta_comando($comando);
      $comando="EXP ".USER."/".PASS."@".BASEDATOS." FILE=".$destino_scriptdb."_buzon_salida_eliminados.dmp tables=buzon_entrada query=\"where archivo_idarchivo IN(".implode(",",$docs).")\" BUFFER=2000000 LOG=".$destino_scriptdb."documento_eliminados.log OWNER=".USER;
      ejecuta_comando($comando);
      $paginas=busca_filtro_tabla("","pagina","documento_id IN(".implode(",",$docs).")","",$conn);
      if($paginas["numcampos"]){
        $lpaginas=extrae_campos($paginas,"ruta","");
        $lminiaturas=extrae_campos($paginas,"ruta_pagina","");
      }
      if(is_file($destino_scriptdb."_documentos_eliminados.dmp") && is_file($destino_scriptdb."_buzon_salida_eliminados.log")&& is_file($destino_scriptdb."_buzon_entrada_eliminados.log")){

        comprimir($destino_scriptdb.".dmp ".$destino_scriptdb.".log".implode(" ",$lminiaturas).implode(" ",$lpaginas),$destino_scriptdb,1);
        return(TRUE);
      }
      else return(FALSE);
    }
    else return(FALSE);
  break;
}
return(FALSE);
}
function bk_scripts($diaria=0){
global $conn,$destino_scripts,$ruta_bk,$fecha_copia,$fecha_inicio,$fecha_final;
  $destino_scripts=$ruta_bk."/scripts_".CARPETA_SAIA."-".$fecha_copia;
if($diaria==0)//copio toda la carpeta
 {
  $origen_zip="../".CARPETA_SAIA;
  return(comprimir($origen_zip,$destino_scripts));
 }
else //copio solo los modificados en el d�a
 {$lista=array();
  $lista=revisar_cambios_archivos("../".CARPETA_SAIA,$lista);
  if(count($lista))
    {return(comprimir(implode(" ",$lista),$destino_scripts));
    }
  else
    return (true);  
 }                                                                              
}
function revisar_cambios_archivos($carpeta,$lista)
{$carpetas_excluidas=array("html2ps/public_html/cache","html2ps/public_html/temp","error_log");
 if(!$dh = @opendir($carpeta))
    { 
        return;
    } 
    while (false !== ($obj = readdir($dh))) 
    { 
        if($obj == '.' || $obj == '..' || in_array($obj,$carpetas_excluidas) ) 
        { 
            continue; 
        } 
 
       if (is_dir($carpeta . '/' . $obj))
         {revisar_cambios_archivos($carpeta . '/' . $obj,$lista);  
         }
        else
         {$datos=date("Y-m-d",filemtime($carpeta . '/' . $obj));
          
          if($datos==date('Y-m-d'))
            $lista[]=$carpeta . '/' . $obj;
         }       
    } 

    closedir($dh);   
    return($lista);
}
function bk_pdfs(){
global $ldocumentos,$fecha_copia,$ruta_bk;
$archivos=array();
if($ldocumentos<>""){
  $origen_zip_docs="";
  $numcampos=count($ldocumentos);
  
  for($i=0;$i<$numcampos;$i++){
    $pdf=busca_filtro_tabla("pdf","documento","iddocumento =".$ldocumentos[$i]." and pdf is not null","",$conn);
    if($pdf["numcampos"]<>"")
       {$path=pathinfo($pdf[0]["pdf"]);
        $archivos[]=$path["dirname"];
       }
     }
  }
else
{$pdf=busca_filtro_tabla("pdf","documento","pdf is not null","",$conn);

 for($i=0;$i<$pdf["numcampos"];$i++)
   {$path=pathinfo($pdf[$i]["pdf"]);
    $archivos[]=$path["dirname"];
   }
}
$archivos=array_unique($archivos);
sort($archivos);

$origen_zip_anexos=implode(" ",$archivos);
$destino_anexos=$ruta_bk."/pdf-".$fecha_copia;
if($archivos)
return(comprimir($origen_zip_anexos,$destino_anexos));
else
return true;
}
function bk_adjuntos(){
global $conn,$destino_anexos,$ldocumentos,$ruta_bk,$extension_zip,$fecha_copia;
$origen_zip_anexos="";

$destino=busca_configuracion("ruta_anexos","anexos");
if($destino["numcampos"]){
  $origen_zip_anexos=$destino[0]["valor"];
}                
$anexos_docs="";

if($ldocumentos<>""){
  $origen_zip_docs="";
  $numcampos=count($ldocumentos);
$carpetas=array();  
  for($i=0;$i<$numcampos;$i++){
    $anexos=busca_filtro_tabla("*","anexos","documento_iddocumento=".$ldocumentos[$i],"",$conn);
   
    $anexos_docs="";
    for($j=0;$j<$anexos["numcampos"];$j++){
      {$path=pathinfo($anexos[$j]["ruta"]);
       $carpetas[]=$path["dirname"];
      }
    }
  }
}
else
{$anexos=busca_filtro_tabla("*","anexos","","",$conn);
 $anexos_docs="";
  for($j=0;$j<$anexos["numcampos"];$j++){
    {$path=pathinfo($anexos[$j]["ruta"]);
     $carpetas[]=$path["dirname"];
    }
  }
}
$carpetas=array_unique($carpetas);
sort($carpetas);

$origen_zip_anexos=implode(" ",$carpetas);
$destino_anexos=$ruta_bk."/anexos-".$fecha_copia;
if($carpetas)
return(comprimir($origen_zip_anexos,$destino_anexos));
else 
 return true;
}

function bk_logs(){
global $destino_logs,$conn,$fecha_copia,$ruta_bk,$conn,$sql,$fecha_inicio,$fecha_final;
$destino_logs=$ruta_bk."/saia_log-".$fecha_copia;
$exp_logs="saia_log-".$fecha_copia;

$ruta=busca_configuracion("ruta_bin_sql","/var/lib/mysql/data/".DB."/");

$ruta_bin_sql=$ruta[0]["valor"];

switch(MOTOR){
  case "MySql":
    if($fecha_final&&$fecha_inicio)
      $comando="mysqldump  -u".USER." -p".PASS." -r ".$destino_logs.".dmp ".DB.' evento -w"date_format(fecha,\'%Y-%m-%d\')>=\''.$fecha_inicio.'\' and date_format(fecha,\'%Y-%m-%d\')<=\''.$fecha_final.'\'"';
    else
      $comando="mysqldump  -u".USER." -p".PASS." -r ".$destino_logs.".dmp ".DB.' evento';  
    ejecuta_comando($comando);   
    if(is_file($destino_logs.".dmp")){
     //ejecuta_sql("delete from evento where ".fecha_db_obtener("fecha","Y-m-d")." <='$fecha_final' and ".fecha_db_obtener("fecha","Y-m-d")." >='$fecha_inicio';",$conn);
      comprimir($destino_logs.".dmp ",$destino_logs,1);
      return(TRUE);
    }
    else return(FALSE);
  break;
  case "Oracle":
    /*FALTA REVISAR COMO CONOCER LA RUTA DONDE ALMACENA LOS EXPORT ORACLE*/
    $comando="SET NLS_LANG=AMERICAN_AMERICA.WE8ISO8859P1";
    ejecuta_comando($comando,$conn);
    $config="";
    if($fecha_final&&$fecha_inicio)
      {$archi=fopen("param_export.par","wb");
       fwrite($archi,'QUERY="where '.fecha_db_obtener("fecha","Y-m-d")." <='$fecha_final' and ".fecha_db_obtener("fecha","Y-m-d")." >='$fecha_inicio'\"");
       fclose($archi);
       $config=" parfile=param_export.par";
      }
    $comando="EXP ".USER."/".PASS."@".BASEDATOS." FILE=".$destino_logs.".dmp TABLES=evento $config LOG=".$destino_logs.".log ";
    ejecuta_comando($comando,$conn);     
    if(is_file($destino_logs.".dmp") && is_file($destino_logs.".log")){
      //ejecuta_sql("delete from evento where ".fecha_db_obtener("fecha","Y-m-d")." <='$fecha_final' and ".fecha_db_obtener("fecha","Y-m-d")." >='$fecha_inicio';",$conn);
      comprimir($destino_logs.".dmp ".$destino_logs.".log",$destino_logs,1);
      return(TRUE);
    }
    else return(FALSE);
  break;
}
return(FALSE);
}

/*
Origen es el listado de carpetas o archivos a comprimir
destino es el archivo comprimido final.
*/
function comprimir($origen,$destino,$elimina=0,$excluidos=""){
global $extension_zip;

if(SO=="linux"){
  $extension=".tar";
  $comando="tar -cvf ".$destino.$extension." ".$origen;
  ejecuta_comando($comando);
}
else if(SO=="windows"){
  $extension=".zip";
  if(is_file("zip.exe")){
    $comando="zip ".$destino.$extension." -r9 ".$origen;
    ejecuta_comando($comando);
  }
  else{
    alerta("No es posible Generar el Archivo Falta el archivo zip.exe");
    return(FALSE);
  }
}
//echo($comando."<br />");
if(is_file($destino.$extension)){
  chmod($destino.$extension,0775);
  if($elimina){
    $eliminados=explode(" ",$origen);
    $cont=count($eliminados);
    for($i=0;$i<$cont;$i++){
      if(is_file($eliminados[$i]))
        unlink($eliminados[$i]);
   }
  }
  return(TRUE);
}
else{
 alerta("Se ha generado un Error al tratar de comprimir el archivo ".$destino.$extension);
 return(FALSE);
}
return(FALSE);
}
function ejecuta_comando($comando){
exec($comando);
}
function busca_configuracion($nombre,$default){
global $conn;
  $conf=busca_filtro_tabla("idconfiguracion,valor", "configuracion","nombre LIKE '".$nombre."'","",$conn);
  if($conf["numcampos"]){
    return($conf);
  }
  return(array("numcampos"=>1,array("valor"=>$default)));
}
function verifica_ruta($ruta){
$dir=pathinfo($ruta);
$directorios=explode("/",$dir["dirname"]);
$cont=count($directorios);
$dir1="";
for($i=0;$i<$cont;$i++){
  $dir1.=$directorios[$i]."/";
  if(!is_dir($dir1) && $directorios[$i]!=".." && $directorios[$i]!="."){
    if(mkdir($dir1,0777))
      return(TRUE);
    else{
     alerta("La carpeta ".$ruta." No se ha podido Crear.");
     return(FALSE);
    }
  }
}
}
?>

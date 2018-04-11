<?php
if(!isset($_SESSION))
  session_start();
include_once("header.php");
include_once("db.php");
include_once("class_transferencia.php");
function listado_destinos($value){
  $destinos=array();
  $destinos_aux=split(",",$value);
  $num_destino = count($destinos_aux);
  for($i=0; $i<$num_destino&&$i<100; $i++)
  {
   $filtro = strpos($destinos_aux[$i],'_');
   if($filtro)
      $destinos_aux[$i]=substr($destinos_aux[$i],0,$filtro);     
   $dependencia = strpos($destinos_aux[$i],'#');
   if($dependencia)
      {$destinos1 = buscar_funcionarios(substr($destinos_aux[$i],0,strlen($destinos_aux[$i])-1), $destinos);
       $destinos=array_merge((array)$destinos1,$destinos);
      }
   else
      array_push($destinos,$destinos_aux[$i]);
  } 
 $destinos = array_unique($destinos);
 return($destinos);
}
function formulario()
{
 global $conn;
 $destinos="'".implode("','",explode(",",$_REQUEST["destinos"]))."'";   
 $datos_doc=busca_filtro_tabla("numero,descripcion","documento","iddocumento=".$_REQUEST["iddoc"],"",$conn);
 $nombres=busca_filtro_tabla("funcionario_codigo,nombres,apellidos,'original' as tipo_envio","funcionario"," funcionario_codigo in(".$destinos.")","nombres,apellidos",$conn);
 $destinos_copias="'".implode("','",explode(",",$_REQUEST["copias"]))."'";   
 $nombres_copias=busca_filtro_tabla("funcionario_codigo,nombres,apellidos,'copia' as tipo_envio","funcionario"," funcionario_codigo in(".$destinos_copias.")","nombres,apellidos",$conn);
 echo "USTED ESTA A PUNTO DE ENVIAR EL DOCUMENTO NUMERO '".$datos_doc[0]["numero"]."' CON EL ASUNTO '".$datos_doc[0]["descripcion"]."' <br />A <b>".$nombres["numcampos"]." DESTINOS COMO ORIGINAL</b> Y A <b>".$nombres_copias["numcampos"]." DESTINOS COMO COPIAS</b>. <br />USTED EST&Aacute; SEGURO DE ESTE ENV&Iacute;O?<br />
 SI ESTA SEGURO HAGA CLIC EN ENVIAR, DE LO CONTRARIO PUEDE SACAR DE LA LISTA LAS PERSONAS A QUIEN NO VA DIRIGIDO EL DOCUMENTO O PUEDE HACER CLIC EN CANCELAR PARA ELEGIR UN NUEVO DESTINO.<br /><form name='form1' id='form1' method='post' action='confirmar_transferencia.php' >
      <table align='center'>
      <tr class='encabezado_list'><td ></td><td></td><td>DESTINO</td><td>tipo de env&iacute;o</td></tr>";
 imprime_nombres($nombres,0);
 imprime_nombres($nombres_copias,$nombres["numcampos"]); 
 echo "<tr><td colspan=2 align='center'>
      <input type='hidden' id='lista_destinos' name='lista_destinos' value=''>
      <input type='hidden' id='iddoc' name='iddoc' value='".@$_REQUEST["iddoc"]."'>
      <input type='hidden' id='notas' name='notas' value='".@$_REQUEST["notas"]."'>
      <input type='hidden' id='mensaje' name='mensaje' value='".@$_REQUEST["mensaje"]."'>
      <input type='hidden' name='tipo_envio' value='".@$_REQUEST["tipo_envio"]."'>'
      <input type='hidden' id='ver_notas' name='ver_notas' value='".@$_REQUEST["x_ver_nota"]."'>
      <input type='hidden' name='transferir' value='1'>
      <input type='button' onclick='validar_destinos();' value='Enviar'>
      <input type='button' onclick='window.location=".'"transferenciaadd.php?doc='.$_REQUEST["iddoc"].'&mostrar=1"'.";' value='Cancelar'></td></tr></table></form>";
 }
 
 function imprime_nombres($vector,$inicio){
  
  for($i=0;$i<$vector["numcampos"];$i++,$inicio++)
  {
   echo "<tr><td align='center'>".($inicio+1).".</td><td> <input type='checkbox' id='destino$inicio' name='destino$inicio' value='".$vector[$i]["funcionario_codigo"]."' checked='true' ></td>
         <td><label for='destino$inicio' >".$vector[$i]["nombres"]." ".$vector[$i]["apellidos"]."</label></td>
         <td><label for='destino$inicio' >".$vector[$i]["tipo_envio"]."</label></td></tr>";
  }
 }
function transferir()
{
  global $conn;
  $destinos=explode(",",$_REQUEST["lista_destinos"]);
  $datos["archivo_idarchivo"]=$_REQUEST["iddoc"];
  $datos["tipo_destino"]=1;
  $datos["tipo"]="";
  $datos["origen"]=usuario_actual("funcionario_codigo");
  $datos["ver_notas"]=$_REQUEST["ver_notas"];
  $datos["nombre"]="TRANSFERIDO";
  $otros["notas"]="'".$_REQUEST["notas"]."'";
  transferir_archivo_prueba($datos,$destinos,$otros);
  redirecciona("doctransflist.php?doc=".$_REQUEST["iddoc"]);
   die();
}
?>
<script>
function validar_destinos()
{var elegidos="";
 for(i=0;i<document.getElementById("form1").elements.length;i=i+1)
    {objeto=document.getElementById("form1").elements[i];
     if(objeto.checked==true)
        {
         if(elegidos=="")
            elegidos+=objeto.value;
         else
            elegidos+=","+objeto.value;   
        }
    }
 if(elegidos=="")
    alert("Seleccione por lo menos un destino o haga click en cancelar.");
 else
   {document.getElementById("lista_destinos").value=elegidos;
    form1.submit();
   }      
}
</script>
<?php
if(isset($_REQUEST["transferir"]) && $_REQUEST["transferir"]==1)
  transferir();
else
  formulario();  
include_once("footer.php");
?>

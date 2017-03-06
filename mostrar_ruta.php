<?php 
/*
<Archivo>
<Nombre>mostrar_ruta.php</Nombre> 
<Parametros>$_POST["editar_firma"]:iddocumento el cual se le va a editar la ruta, $_POST["obligatorio$i"]:variable que guarda 1, 0 (obligatorio de cada registro), $_POST["idruta$i"]:idruta de cada registro, $_POST["plantilla"]:tipo de plantilla del documento</Parametros>
<ruta>saia1.06/mostrar_ruta.php</ruta>
<Responsabilidades>Muestra la ruta del documento con su obligatoriedad en cada registro, y permite editar dicha obligatoriedad. (Mostrar fimras o no en el documento)<Responsabilidades>
<Notas></Notas>
<Salida>Muestra una tabla en pantalla con la informacion de la ruta del documento: origen, destino, obligatoriedad y con opcion de cambiar esto (si firma o no)</Salida>
</Archivo>
*/
session_start();
if(@$_REQUEST["iddoc"] || @$_REQUEST["key"] || @$_REQUEST["doc"]){
  $_REQUEST["iddoc"]=@$_REQUEST["doc"];
  include_once("pantallas/documento/menu_principal_documento.php");
  echo(menu_principal_documento(@$_REQUEST["iddoc"],@$_REQUEST["vista"]));
}
else{
  include("db.php");
}
//include_once("header.php");
$config = busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","",$conn); 
 if($config["numcampos"])
 {  $style = "
     <style type=\"text/css\">
     <!--INPUT, TEXTAREA, SELECT 
     {
        font-family: Verdana,Tahoma,arial; 
        font-size: 10px; 
        /*text-transform:Uppercase;*/
       } 
       .phpmaker 
       {
       font-family: Verdana,Tahoma,arial; 
       font-size: 9px; 
       /*text-transform:Uppercase;*/
       } 
       .encabezado 
       {
       background-color:".$config[0]["valor"]."; 
       color:white ; 
       padding:10px; 
       text-align: left;	
       } 
       .encabezado_list 
       { 
       background-color:".$config[0]["valor"]."; 
       color:white ; 
       vertical-align:middle;
       text-align: center;
       font-weight: bold;	
       }
       table thead td 
       {
		    font-weight:bold;
    		cursor:pointer;
    		background-color:".$config[0]["valor"].";
    		text-align: center;
        font-family: Verdana,Tahoma,arial; 
        font-size: 9px;
        /*text-transform:Uppercase;*/
        vertical-align:middle;    
    	 }
    	 table tbody td 
       {	
    		font-family: Verdana,Tahoma,arial; 
        font-size: 9px;
    	 }
       -->
       </style>";
  echo $style;
  } 
if(isset($_POST["editar_firma"])){ 
 // Se guardan los cambios en la tabla ruta campo obligatorio.
 $i=0;
 while(isset($_POST["obligatorio$i"])) {
 	$sql1 = "UPDATE ruta SET obligatorio=".$_POST["obligatorio$i"]." WHERE idruta=".$_POST["idruta$i"];
  phpmkr_query($sql1);
  $i++;
 }
 $_POST["plantilla"]=strtolower($_POST["plantilla"]);
 if($_POST["plantilla"]=='memorando' || $_POST["plantilla"]=='circular'){
     $busca_remitente = busca_filtro_tabla("origen","ruta","documento_iddocumento=".$_POST["editar_firma"]." and obligatorio=1 and tipo='ACTIVO'","idruta desc",$conn);
     
    $lista = $busca_remitente[0][0];
    $sql2="update ".$_POST["plantilla"]." set origen='".$lista."' where documento_iddocumento=".$_POST["editar_firma"];
    phpmkr_query($sql2,$conn);       
  } 
  $datos_formato=busca_filtro_tabla("","formato a","a.nombre='".$_POST["plantilla"]."'","",$conn);
  if($datos_formato[0]["mostrar_pdf"]==1){
  	redirecciona("pantallas/documento/visor_documento.php?iddoc=".$_POST["editar_firma"]."&actualizar_pdf=1");
  	die();
  }
  if($datos_formato[0]["mostrar_pdf"]==2){		
  	$iddoc=$_POST["editar_firma"];		
  	$ruta_db_superior='';		
	$_REQUEST['from_externo']=1;
  	include_once($ruta_db_superior.'pantallas/lib/PhpWord/exportar_word.php');  			
  	redirecciona("pantallas/documento/visor_documento.php?iddoc=".$_POST["editar_firma"]."&pdf_word=1");		
		die();
  }
 redirecciona("formatos/".$_POST["plantilla"]."/mostrar_".$_POST["plantilla"].".php?iddoc=".$_POST["editar_firma"]); 
} 
 
$tipo = @$_GET["tipo"];
$iddoc = $_GET["doc"];
$detalles = busca_filtro_tabla("plantilla","documento","iddocumento=$iddoc","",$conn);
$ruta_actual=busca_filtro_tabla("A.*,destino as destino1,origen as origen1,tipo_origen,tipo_destino","ruta A","A.documento_iddocumento=".$iddoc." AND A.tipo='ACTIVO'","idruta",$conn);

if(!$ruta_actual["numcampos"]){
	$ruta_actual=busca_filtro_tabla("destino as origen1, origen as destino1,1 as obligatorio, 1 as tipo_origen, 1 as tipo_destino","buzon_entrada","nombre='POR_APROBAR' and archivo_idarchivo=$iddoc","",$conn);
  $unafirma=1;
}
 echo '<A NAME="inicio"></A>';   
$origen = @$ruta_actual[0]["origen1"];  

	$plantilla=busca_filtro_tabla("","documento A, formato B","lower(A.plantilla)=lower(B.nombre) AND A.iddocumento=".$iddoc,"",$conn);
	  
 echo("<div style='bgcolor:blue;'><span class='phpmaker'>Ruta actual asignada al documento </span></div><br><br>");
 echo "<span class='phpmaker'><a href='formatos/".$plantilla[0]["nombre"]."/".$plantilla[0]["ruta_mostrar"]."?iddoc=".$iddoc."&idformato=".$plantilla[0]["idformato"]."'>Regresar al Documento</a></span><br /><br />";
 if($ruta_actual["numcampos"]>0){
  ?>
    <form name='mostrar_ruta' method="POST" action="mostrar_ruta.php">
    <input type="hidden" name="editar_firma" value="<?php echo $iddoc; ?>">
    <table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
    	<!-- Table header -->
    	<tr class="encabezado_list">
    		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
            DE
    		</span></td>
    		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
    	     PARA 
    		</span></td>
    		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
          FUNCIONARIO
    		</span></td>
    		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
          OPCIONES DE FIRMA
    		</span></td>
    	</tr>
      <?php      
        for($i=0;$i<$ruta_actual["numcampos"];$i++){
        	$sItemRowClass = " bgcolor=\"#FFFFFF\"";
        	// Display alternate color for rows
        	if ($i % 2 <> 0) {
        		$sItemRowClass = " bgcolor=\"#F5F5F5\"";
        	}        	
          echo('<tr'.$sItemRowClass.'><td><span class="phpmaker" >'.codifica_encabezado(busca_entidad_ruta($ruta_actual[$i]["tipo_origen"],$ruta_actual[$i]["origen1"]))."</span></td>");
          echo('<td><span class="phpmaker" >'.codifica_encabezado(busca_entidad_ruta($ruta_actual[$i]["tipo_destino"],$ruta_actual[$i]["destino1"]))."</span></td>");
          
          echo('<td><span class="phpmaker" >'.codifica_encabezado(busca_entidad_ruta($ruta_actual[$i]["tipo_origen"],$ruta_actual[$i]["origen1"]))."</span></td>");
          echo '<td bgcolor="#F5F5F5">
              <table border="0"><tr>
      <td >
      <label title="La Firma electronica se muestra en el documento" for="si'.$i.'">
      <input type="radio" name="obligatorio'.$i.'" id="si'.$i.'" value="1" ';
      if($ruta_actual[$i]["obligatorio"]==1)
        echo ' checked ';
      echo '>Firma visible</label>
      </td></tr><tr><td ><label title="Se incluye en parte inferior del documento :  Reviso : Funcionario - Cargo se indica si la revision esta pendiente o ya se realizo" for="rv'.$i.'">
      <input type="radio" name="obligatorio'.$i.'" id="rv'.$i.'" value="2" ' ;
      if($ruta_actual[$i]["obligatorio"]==2)
        echo ' checked ';
      echo '>Revisado</label>
      </td></tr>';
      echo '<tr><td><label title="Se encarga de adicionar una firma externa" for="rv'.$i.'"><input type="radio" name="obligatorio'.$i.'" id="no'.$i.'" value="5" ';
      if($ruta_actual[$i]["obligatorio"]==5)
        echo ' checked ';
      echo'>Firma externa</label></td>';
      echo '<tr><td><label title="El funcionario debe aprobar el documento para el tramite del mismo y su aprobacion, pero no aparecen ni su firma ni su revisado en el documento" for="no'.$i.'">
      <input type="radio" name="obligatorio'.$i.'" id="no'.$i.'" value="0" ';
      if($ruta_actual[$i]["obligatorio"]==0)
        echo ' checked ';
      echo '>Ninguna</label></span>
      </td></tr>
      </table>
      <input type="hidden" name="idruta'.$i.'" value="'.$ruta_actual[$i]["idruta"].'">  
        </td></tr>';
        }
        echo '<input type="hidden" name="plantilla" value="'.$detalles[0]["plantilla"].'">';
       
       echo "<tr><td colspan='4' bgcolor='f5f5f5' align='center'><input type='submit' value='GUARDAR CAMBIOS'></td></tr>";
        if(!isset($unafirma)){
          echo "<tr><td colspan=4 bgcolor=\"#F5F5F5\"><table width=100%><tr><td><a href=formatos/librerias/rutaadd.php?doc=$iddoc&origen=$origen&tipo_origen=".$ruta_actual[0]["tipo_origen"]."&rehacer=editar_ruta&reset_ruta=true&cargar=1 onclick='javascript:if(confirm(\"Esta seguro de eliminar los responsables y volver a asignarlos?\")) return true; else return false;'>Reasignar Responsables</a></td><td colspan='1' bgcolor=\"#F5F5F5\" aling='right'><a href='formatos/librerias/rutaadd.php?doc=$iddoc&cancelar=ruta&plantilla=".$detalles[0]["plantilla"]."' onclick='javascript:if(confirm(\"Esta seguro que solo usted debe firmar este documento?\")) return true; else return false;'>Firma &uacute;nica de quien prepara</a></td></tr></table></td></tr>"; 
        } 
          
 }
 if(isset($unafirma) || !$ruta_actual["numcampos"]){
    $origen = $_SESSION["usuario_actual"];
    echo "<table border='0' cellspacing='1' cellpadding='4' bgcolor='#CCCCCC'>";
    $formato_doc=busca_filtro_tabla("A.nombre_tabla","formato A, documento B","B.iddocumento=".$iddoc." AND lower(A.nombre)=lower(B.plantilla)","",$conn);    
    $usuario_origen = busca_filtro_tabla("dependencia",$formato_doc[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"",$conn);
    echo "<tr><td colspan='4' bgcolor=\"#F5F5F5\"><a href=formatos/librerias/rutaadd.php?doc=$iddoc&origen=".$usuario_origen[0][0]."&rehacer=crear_ruta&reset_ruta=true&cargar=1  onclick='javascript:if(confirm(\"Esta seguro de que otra persona debe revisar y firmar el documento.?\")) return true; else return false;'>Reasignar Responsables</a></td><td colspan='1' bgcolor=\"#F5F5F5\" aling='right'><a href='formatos/librerias/rutaadd.php?doc=$iddoc&cancelar=ruta&plantilla=".$detalles[0]["plantilla"]."' onclick='javascript:if(confirm(\"Esta seguro que solo usted debe firmar este documento?\")) return true; else return false;'>Firma &uacute;nica de quien prepara</a></td></tr>";
  } 
      ?>	
    </table>   
    </form>
<?php
include_once("footer.php");

/*
<Clase>
<Nombre>busca_entidad_ruta</Nombre> 
<Parametros>$tipo: Tipo de entidad; $llave : identificador de la identidad
</Parametros>
<Responsabilidades>Segun la entidad realiza la busqueda del funcionario<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida>Nombres y apellidos que corresponde a la llave de la entidad</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function busca_entidad_ruta($tipo,$llave){
global $conn;
switch($tipo){
  case 1:// Funcionario
    $dato=busca_filtro_tabla("A.nombres, A.apellidos","funcionario A","A.funcionario_codigo='".$llave."'","",$conn);
    if($dato["numcampos"])
      return($dato[0]["nombres"]." ".$dato[0]["apellidos"]);
    else return("Funcionario no encontrado");
   break;
  case 5:
    $dato=busca_filtro_tabla("A.nombres, A.apellidos","funcionario A,dependencia_cargo","A.idfuncionario=funcionario_idfuncionario and iddependencia_cargo='".$llave."'","",$conn);
  
    if($dato["numcampos"])
      return($dato[0]["nombres"]." ".$dato[0]["apellidos"]);
    else return("Funcionario no encontrado");
  break;   
}
}
?>

<?php
include_once("db.php");
include_once("class_transferencia.php");
include_once("formatos/librerias/estilo_formulario.php");
					
// Initialize common variables

$x_nombre = Null;
$x_fecha = Null;
$x_notas = Null;
$x_copia= Null;
$x_ver_nota= Null;
$x_tipo_envio = Null;

if(isset($_REQUEST["a_add"]) && $_REQUEST["a_add"]!="")
{  guardar_transferencias();
   abrir_url($_REQUEST["retorno"],"_parent");
}

if(isset($_REQUEST["docs"]) && $_REQUEST["docs"]!="")
{ //print_r($_REQUEST);die();
  $iddocs = substr($_REQUEST["docs"],0,-1);
  mostrar_documentos($iddocs);
  formulario($iddocs);
}
?>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) 
{ 
  var list_funcionarios = tree2.getAllChecked();   
  var funcionarios = list_funcionarios.split(",");  
  var func ="";
  var copia="";  
  var ruta="";  
  var aux_ruta;  
  for(i=0; i<funcionarios.length; i++)
  { 
   if(funcionarios[i]!="")
     {     
      aux_ruta =funcionarios[i].indexOf("%");            
      if(aux_ruta != -1)
       { ruta=funcionarios[i].substring(aux_ruta+1);
         funcionarios[i]=funcionarios[i].substring(0,aux_ruta);         
       }          
      if(func=="")  
        func = funcionarios[i];
      else
        func += ","+funcionarios[i];
     }        
  }  
    EW_this.x_funcionario_destino.value=func;  
  if(EW_this.x_funcionario_destino && EW_this.x_funcionario_destino.value == "")
   { alert("Por favor ingresar un funcionario o dependencia destino para transferir el documento");
    return false;
   } 
return true;
}

function no_palitos(evt)
  {
   evt = (evt) ? evt : event;
   var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
       ((evt.which) ? evt.which : 0));
   if (charCode == 124){       
      return false;
   }
   return true;
  } 
//-->
</script>
<?php
function mostrar_documentos($iddocs)
{ global $conn; 
  echo "<span class='internos'>&nbsp;&nbsp;Transferencia Masiva de documentos</span><br><br>";
  $datos_doc = busca_filtro_tabla("numero,descripcion,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha","documento","iddocumento in ($iddocs)","fecha DESC",$conn);  
  echo "<table border='1' style='border-collapse:collapse' width='85%'><tr class='encabezado_list'><td colspan='3'>Documentos a Transferir</td></tr>
        <tr class='encabezado_list'><td>Radicado</td><td>Descripci&oacute;n</td><td>Fecha</td></tr>";
  for($i=0; $i<$datos_doc["numcampos"]; $i++)
  {
   echo "<tr><td>".$datos_doc[$i]["numero"]."</td><td>".$datos_doc[$i]["descripcion"]."</td><td>".$datos_doc[$i]["fecha"]."</td></tr>";
  }
  echo "</table>"; 
 return true;
}

function formulario($iddocs)
{
 echo '<form name="transferencias" id="transferencias" action="transferenciaadd_plantillas.php" method="post" onSubmit="return EW_checkMyForm(this);">
       <table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">	     
	     <input type="hidden" name="docs" value="'.$iddocs.'">	
		   <td class="encabezado" title="Es la fecha del sistema, en la que se est&aacute; realizando la operaci&oacute;n"><span class="phpmaker" style="color: #FFFFFF;">FECHA</span></td>
		   <td bgcolor="#F5F5F5"><span class="phpmaker">'.date("Y-m-d H:i:s").'</td>
       <input type="hidden" name="x_fecha" id="x_fecha" value="'.date("Y-m-d H:i:s").'">
       <input type="hidden" name="x_funcionario_destino" id="x_funcionario_destino">
       <input type="hidden" name="x_copia" id="x_copia" value="0">';
      ?>   
       <tr>
       <td class="encabezado" title="Seleccione a quien va a enviar el documento. Puede seleccionar toda la empresa, toda una dependencia o los funcionarios destino"><span class="phpmaker" style="color: #FFFFFF;">DESTINO</span></td>
       <td bgcolor="#F5F5F5"><link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
        <script type="text/javascript" src="js/dhtmlXCommon.js"></script>
       	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
      			<span class="phpmaker">
      			      Buscar:<br><input type="text" id="stext" width="200px" size="20">      
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,1)">
      <img src="botones/general/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,0,1)">
      <img src="botones/general/buscar.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value)">
      <img src="botones/general/siguiente.png"border="0px"></a>
<br /><br />
      				<div id="treeboxbox_tree2"></div>				
      	<script type="text/javascript">
        <!--		
      			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","100%",0);
      			tree2.setImagePath("imgs/");
      			tree2.enableIEImageFix(true);
      			tree2.enableCheckBoxes(1);
      			tree2.enableThreeStateCheckboxes(true);
            tree2.enableSmartXMLParsing(true);
      			tree2.loadXML("test.php");
        -->					
      	</script>
      	</td></tr>	
   <?php   	
	if($x_serie<>0)
	{
  	$copia = busca_filtro_tabla("copia","serie","idserie=$x_serie AND copia=1","",$conn);
  
  	if($copia["numcampos"]>0)
  	{ $permiso_copia=new PERMISO();
  
  	 if($permiso_copia->acceso_modulo("envio_copias"))	
      {  
     echo '<tr>
           <td class="encabezado" title="Selecciona un funcionarios, si desea hacer una copia del documento"><span class="phpmaker" style="color: #FFFFFF;">COPIA A </span></td>
        	<td bgcolor="#F5F5F5"><span class="phpmaker">
        	<div id="treeboxbox_tree_copia"></div>				
        	<script type="text/javascript">
          <!--					
        			tree_copia=new dhtmlXTreeObject("treeboxbox_tree_copia","100%","100%",0);
        			tree_copia.setImagePath("imgs/");
        			tree_copia.enableIEImageFix(true);
        			tree_copia.enableCheckBoxes(1);
        			tree_copia.enableThreeStateCheckboxes(true);
        			tree_copia.setXMLAutoLoading("test.php");
        			tree_copia.loadXML("test.php");
          -->					
        	</script>
        	</td></tr>';    
      }
    } 
  }
  $x_nombre="TRANSFERIDO";
  echo '<input type="hidden" name="x_nombre" value="'.htmlspecialchars($x_nombre).'">';
 ?>		
	<tr>
		<td class="encabezado" title="Espacio para escribir una nota en caso de que sea necesario hacer una aclaraci&oacute;n particular con la transferencia" ><span class="phpmaker" style="color: #FFFFFF;">OBSERVACIONES</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<textarea cols="55" rows="5" id="x_notas" name="x_notas"><?php echo @$x_notas; ?></textarea>
</span></td>
	</tr>
		<!--tr>
		<td class="encabezado" title="Enviar documento por otro m&eacute;todo como mensajer&iacute;a instant&aacute;nea, correo electr&oacute;nico externo, correo electr&oacute;nico interno"><span class="phpmaker" style="color: #FFFFFF;">MEDIO DE NOTIFICACI&Oacute;N </span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
      <input type="checkbox" name="x_tipo_envio[]" id="x_tipo_envio" value="msg" >Mensajer&iacute;a Instant&aacute;nea<br />
      <input type="checkbox" name="x_tipo_envio[]" id="x_tipo_envio" value="e-interno">Correo Electr&oacute;nico Interno<br />
    </span>
    </td>
	</tr-->
	<tr>
		<td class="encabezado" title=""><span class="phpmaker" style="color: #FFFFFF;">OBSERVACIONES VISIBLES PARA TODOS?</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <input type=radio name="x_ver_nota" value="1" id="si"><label for="si">SI</label> 
    <input type=radio name="x_ver_nota" value="0" id="no" checked><label for="no">NO</label>
    </span></td>
    	</tr>
    </table>
    <p>
    <input type="hidden" name="a_add" value="A">
    <input type="hidden" name="retorno" value="<?php echo $_REQUEST["retorno"]; ?>">
    <input type="submit" name="Action" value="CONTINUAR">
    
    </form>
<?php 
}

function guardar_transferencias() {
	global $conn;
	$list_destinos = $_REQUEST["x_funcionario_destino"];
	$list_docs = $_REQUEST["docs"];
	$datos["fecha"] = $_REQUEST["x_fecha"];
	$datos["nombre"] = $_REQUEST["x_nombre"];
	$datos_adicionales["notas"] = "'" . $_REQUEST["x_notas"] . "'";
	$tipo_envio = $_REQUEST["x_tipo_envio"];
	$datos["ver_notas"] = $_REQUEST["x_ver_nota"];
	$datos["tipo_destino"] = 1;
	$destinos_aux = array();
	$dep = array();
	$destinos = explode(",", $list_destinos);
	$docs = explode(",", $list_docs);
	$dep = array();
	for ($i = 0; $i < count($destinos); $i++) {
		$filtro = strpos($destinos[$i], '_');
		if ($filtro)
			$destinos[$i] = substr($destinos[$i], 0, $filtro);
		$dependencia = strpos($destinos[$i], '#');
		if ($dependencia) {
			unset($destinos[$i]);
		}
	}

	$destinos_aux = $destinos;
	$max_destinos = busca_filtro_tabla("valor", "configuracion", "nombre='max_transferencias'", "", $conn);
	if (!$max_destinos["numcampos"]) {$max_destinos[0]["valor"] = 10;
	}
	if (count($destinos) > $max_destinos[0]["valor"]) {
		$permiso = busca_filtro_tabla("", "funcionario_validacion a", "funcionario_idfuncionario=" . usuario_actual('idfuncionario') . " and tipo='1'", "", $conn);
		if (!$permiso["numcampos"] && usuario_actual('login') != 'cerok') {
			alerta("Usted no puede enviar el documento a mas de " . $max_destinos[0]["valor"] . " persona(s)");
			redirecciona("transferenciaadd_plantillas.php?docs=" . implode(",", $docs) . "&retorno=pantallas/buscador_principal.php?idbusqueda=5");
			die();
		}
	}

	for ($i = 0; $i < count($docs); $i++) {
		$datos["archivo_idarchivo"] = $docs[$i];
		transferir_archivo_prueba($datos, $destinos_aux, $datos_adicionales, $_REQUEST["retorno"]);
	}
}
?>

<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
include_once($ruta_db_superior."formatos/librerias/header_formato.php");
include_once($ruta_db_superior."formatos/librerias/funciones.php"); 

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("idformato","idformato_ruta");
include_once($ruta_db_superior."librerias_saia.php");
$validar_enteros=array("idformato");
desencriptar_sqli('form_info');
echo(librerias_jquery());
?>
<link rel="STYLESHEET" type="text/css" href="<?php echo $ruta_db_superior; ?>css/dhtmlXTree.css">
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/dhtmlXTree.js"></script>
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/jquery.validate.js"></script>
<style>
body, table{
	font-family: Verdana,Tahoma,arial;
	font-size: 9px;
}
</style>
<?php
encabezado();

if(@$_REQUEST["accion"]=='adicionar'){
	formulario_adicionar();
}
if(@$_REQUEST["accion"]=='registrar_adicionar'){
	registrar_adicionar();
}
if(@$_REQUEST["accion"]=='editar'){
	formulario_editar();
}
if(@$_REQUEST["accion"]=='registrar_editar'){
	registrar_editar();
}
if(@$_REQUEST["accion"]=='eliminar'){
	eliminar();
}
formulario();

function encabezado(){
	global $conn,$ruta_db_superior;
	$idformato=$_REQUEST["idformato"];
	$formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);
	?>
	<form method="post" name="formulario_ruta" id="formulario_ruta">
	<b><?php echo mayusculas($formato[0]["etiqueta"]); ?></b> (<?php echo ($formato[0]["nombre"]); ?>)<br><br>
	<a href="formatoview.php?key=<?php echo $_REQUEST["idformato"]; ?>">Regresar</a>&nbsp;&nbsp;
	<a href="rutas_automaticas.php?idformato=<?php echo $_REQUEST["idformato"]; ?>&accion=adicionar">Adicionar Ruta</a>
	<?php
}
function formulario(){
	global $conn,$ruta_db_superior;
	$idformato=$_REQUEST["idformato"];
	$formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);
	?>
	<form method="post" name="formulario_ruta" id="formulario_ruta">
	<table name="tabla_ruta" id="name="tabla_ruta" cellspacing="1" cellpadding="4" border="0" bgcolor="#CCCCCC" style="width:600px;font-family:arial">
		<tr class="encabezado_list">
			<td>TIPO DE CAMPO</td>
			<td>FUNCIONARIO</td>
			<td>OPCIONES DE FIRMA</td>
			<td>ORDEN</td>
			<td colspan="2">ACCIONES</td>
		</tr>
		<?php
		$datos=busca_filtro_tabla("","formato_ruta","formato_idformato=".$idformato,"orden",$conn);
		for($i=0;$i<$datos["numcampos"];$i++){
			if($datos[$i]["entidad"]==1){
				$origen=busca_filtro_tabla("","funcionario","funcionario_codigo=".$datos[$i]["llave"],"",$conn);
				if($origen["numcampos"])
          $nombre_origen="<b>Funcionario</b><br>".ucwords(strtolower($origen[0]["nombres"])).' '.ucwords(strtolower($origen[0]["apellidos"]));
			}
			else if($datos[$i]["entidad"]==4){
				$origen=busca_filtro_tabla("","cargo","idcargo=".$datos[$i]["llave"],"",$conn);
				if($origen["numcampos"])$nombre_origen="<b>Cargo</b><br>".ucwords(strtolower($origen[0]["nombre"]));
			}
			else if($datos[$i]["entidad"]==5){
				$origen=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$datos[$i]["llave"],"",$conn);
				if($origen["numcampos"]){
          $nombre_origen="<b>Rol</b><br>".ucwords(strtolower($origen[0]["nombres"])).' '.ucwords(strtolower($origen[0]["apellidos"]));
          if($origen[0]["estado_dc"]==0 || $origen[0]["estado"]==0){
            $usuario=busca_filtro_tabla("","vfuncionario_dc","iddependencia=".$origen[0]["iddependencia"]." AND idcargo=".$origen[0]["idcargo"]." AND estado_dc=1 AND estado=1","",$conn);
            if($usuario["numcampos"]){
              $nombre_origen.="<br><b>Reasignado a:</b><br>".ucwords(strtolower($usuario[0]["nombres"])).' '.ucwords(strtolower($usuario[0]["apellidos"]));
            }
            else{
              $nombre_origen.='<br><b> Sin usuario para reasignar</b>';
            }
          }
        }  
			}
			$checked1='';
			$checked2='';
			$checked0='';
			if($datos[$i]["firma"]==1)$checked1='checked';
			if($datos[$i]["firma"]==2)$checked2='checked';
			if($datos[$i]["firma"]==0)$checked0='checked';
			
			if($datos[$i]["tipo_campo"]==1){
				$tipo_camp="Dato fijo";
			}
			if($datos[$i]["tipo_campo"]==2){
				$tipo_camp="Traido de un<br>campo del formato";
				$campo=busca_filtro_tabla("","campos_formato","idcampos_formato=".$datos[$i]["llave"],"",$conn);
				$nombre_origen="<b>Campo</b><br>".ucfirst(strtolower($campo[0]["etiqueta"]));
			}
			if($datos[$i]["tipo_campo"]==3){
				$tipo_camp="Traido de una<br>funcion";
				$nombre_origen="<b>funcion</b><br>".(strtolower($datos[$i]["funcion"]));
			}
			
			echo '<tr bgcolor="#FFFFFF">';
			echo '<td style="text-align:center">'.$tipo_camp.'</td>';
			echo '<td style="text-align:center">'.$nombre_origen.'</td>';
			echo '<td>
			<input type="radio" disabled name="firma'.$datos[$i]["orden"].'" value="1" '.$checked1.'>Firma visible<br>
			<input type="radio" disabled name="firma'.$datos[$i]["orden"].'" value="2" '.$checked2.'>Revisado<br>
			<input type="radio" disabled name="firma'.$datos[$i]["orden"].'" value="0" '.$checked0.'>Ninguna
			</td>';
			echo '<td style="text-align:center">'.$datos[$i]["orden"].'</td>';
			echo '<td style="text-align:center"><a href="rutas_automaticas.php?accion=editar&idformato='.$idformato.'&idformato_ruta='.$datos[$i]["idformato_ruta"].'">Editar</a></td>';
			echo '<td style="text-align:center"><a href="rutas_automaticas.php?accion=eliminar&idformato='.$idformato.'&idformato_ruta='.$datos[$i]["idformato_ruta"].'">Eliminar</a></td>';
			echo '</tr>';
		}
		?>
	</table>
	</form>
	<?php
}
function formulario_adicionar(){
	global $conn,$ruta_db_superior;
	$idformato=$_REQUEST["idformato"];
	$formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);
	$orden=busca_filtro_tabla("MAX(orden) as ultimo","formato_ruta","formato_idformato=".$_REQUEST["idformato"],"",$conn);
	
	$checked1='checked';
	$checked2='';
	$checked3='';
	?>
	<form method="post" name="formulario_ruta" id="formulario_ruta" action="rutas_automaticas.php">
	<table name="tabla_ruta" id="tabla_ruta" cellspacing="1" cellpadding="4" border="0" bgcolor="#CCCCCC" style="width:600px;font-family:arial">
		<tr>
			<td class="encabezado" width="30%">Tipo de campo</td>
			<td bgcolor="#FFFFFF">
				<input type="radio" name="tipo" value="1" checked>Funcionarios fijos<br>
				<input type="radio" name="tipo" value="2">Tomados de un campo<br>
				<input type="radio" name="tipo" value="3">Sacado de funcion
			</td>
		</tr>
		<tr id="fila_entidad">
			<td class="encabezado">Entidad</td>
			<td bgcolor="#FFFFFF">
				<input type="radio" name="entidad" id="entidad0" value="1" checked>Funcionario<br>
				<!--input type="radio" name="entidad" value="2">Dependencia<br-->
				<!--input type="radio" name="entidad" value="4">Cargo<br-->
				<input type="radio" name="entidad" value="5">Rol
			</td>
		</tr>
		<tr id="fila_ruta" style="display:none">
			<td class="encabezado">Ruta libreria</td>
			<td bgcolor="#FFFFFF">
				<input type="text" name="ruta" value="formatos/<?php echo $formato[0]["nombre"]; ?>/funciones.php" style="width:100%">
			</td>
		</tr>
		<tr id="fila_llave">
			<td class="encabezado">Llave entidad</td>
			<td bgcolor="#FFFFFF" id="arbol_1"><?php echo arbol('llave'); ?></td>
			<td bgcolor="#FFFFFF" id="lista_1" style="display:none"><?php echo lista($datos[0]["llave"],$idformato); ?></td>
		</tr>
		<tr id="fila_funcion" style="display:none">
			<td class="encabezado">Nombre funcion</td>
			<td bgcolor="#FFFFFF" id="arbol_1"><input type="text" name="funcion" style="width:100%"></td>
		</tr>
		<tr>
			<td class="encabezado">Firma</td>
			<td bgcolor="#FFFFFF">
			<input type="radio" name="firma" value="1" <?php echo $checked1; ?>>Firma visible<br>
			<input type="radio" name="firma" value="2" <?php echo $checked2; ?>>Revisado<br>
			<input type="radio" name="firma" value="0" <?php echo $checked0; ?>>Ninguna
				
			</td>
		</tr>
		<tr>
			<td class="encabezado">Orden</td>
			<td bgcolor="#FFFFFF"><input type="text" name="orden" id="orden" class="required" value="<?php echo ($orden[0]["ultimo"]+1); ?>"></td>
		</tr>
		<tr>
			<td colspan="2" bgcolor="#FFFFFF"><input type="submit" value="Adicionar"></td>
		</tr>
	</table>
	<input type="hidden" name="accion" value="registrar_adicionar">
	<input type="hidden" name="idformato" value="<?php echo $_REQUEST["idformato"]; ?>">
	</form>
	<script>
	$().ready(function(){
		$('#formulario_ruta').validate({
			submitHandler: function(form) {
				<?php encriptar_sqli("formulario_ruta",0,"form_info",$ruta_db_superior);?>
			    form.submit();
			    
			  }
		});
	});
	$('input[name$="entidad"]').click(function(){
		if(this.value==5){
			treellave.deleteChildItems(0);
			treellave.loadXML("<?php echo $ruta_db_superior; ?>test.php?sin_padre=1&rol=1");
		}
    if(this.value==1){
			treellave.deleteChildItems(0);
			treellave.loadXML("<?php echo $ruta_db_superior; ?>test.php?sin_padre=1");
		}
		if(this.value==2){
			treellave.deleteChildItems(0);
   			treellave.loadXML("<?php echo $ruta_db_superior; ?>test_serie.php?tabla=dependencia");
		}
		if(this.value==4){
			treellave.deleteChildItems(0);
   			treellave.loadXML("<?php echo $ruta_db_superior; ?>test_serie.php?tabla=cargo&estado=1");
		}
	});
	$('input[name$="tipo"]').click(function(){
		if(this.value==1){
			$("#lista_1").hide();
			$("#arbol_1").show();
			$("#lista_formatos").removeAttr("name");
			
			$("#fila_entidad").show();
			$("#fila_llave").show();
			$("#fila_ruta").hide();
			$("#fila_funcion").hide();
		}
		if(this.value==2){
			$("#arbol_1").hide();
			$("#lista_1").show();
			$("#lista_formatos").attr("name","llave");
			
			$("#fila_entidad").show();
			$("#fila_llave").show();
			$("#fila_ruta").hide();
			$("#fila_funcion").hide();
		}
		if(this.value==3){
			$("#fila_entidad").hide();
			$("#fila_llave").hide();
			$("#fila_ruta").show();
			$("#fila_funcion").show();
		}
	});
	</script>
	<?php
}
function formulario_editar(){
	global $conn,$ruta_db_superior;
	$idformato=$_REQUEST["idformato"];
	$formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);
	$datos=busca_filtro_tabla("","formato_ruta","idformato_ruta=".$_REQUEST["idformato_ruta"],"",$conn);
	$orden=busca_filtro_tabla("orden","formato_ruta","idformato_ruta=".$_REQUEST["idformato_ruta"],"",$conn);
	
	$checked1='';
	$checked2='';
	$checked3='';
	if($datos[0]["firma"]==1)$checked1='checked';
	if($datos[0]["firma"]==2)$checked2='checked';
	if($datos[0]["firma"]==0)$checked0='checked';
	
	$entidad1='';
	$entidad4='';
	$entidad5='';
	
	if($datos[0]["entidad"]==1){
		$archivo=Null;
		$entidad1='checked';
	}
	else if($datos[0]["entidad"]==4){
		$archivo=$ruta_db_superior."test_serie.php?tabla=cargo&seleccionado=".$datos[0]["llave"];
		$entidad4='checked';
	}
	else if($datos[0]["entidad"]==5){
		$archivo=Null;
		$entidad5='checked';
	}
	$tipo_campo1='';
	$tipo_campo2='';
	$tipo_campo3='';
	if($datos[0]["tipo_campo"]==1){
		$tipo_campo1='checked';
	}
	else if($datos[0]["tipo_campo"]==2){
		$tipo_campo2='checked';
	}
	else if($datos[0]["tipo_campo"]==3){
		$tipo_campo3='checked';
	}
	?>
	<form method="post" name="formulario_ruta" id="formulario_ruta" action="rutas_automaticas.php">
	<table name="tabla_ruta" id="name="tabla_ruta" cellspacing="1" cellpadding="4" border="0" bgcolor="#CCCCCC" style="width:600px;font-family:arial">
		<tr>
			<td class="encabezado" width="30%">Tipo de campo</td>
			<td bgcolor="#FFFFFF">
				<input type="radio" name="tipo" value="1" <?php echo $tipo_campo1; ?>>Funcionarios fijos<br>
				<input type="radio" name="tipo" value="2" id="tipo2" <?php echo $tipo_campo2; ?>>Tomados de un campo<br>
				<input type="radio" name="tipo" value="3" id="tipo3" <?php echo $tipo_campo3; ?>>Sacado de funcion
			</td>
		</tr>
		<tr id="fila_entidad">
			<td class="encabezado">Entidad</td>
			<td bgcolor="#FFFFFF">
				<input type="radio" name="entidad" value="1" <?php echo $entidad1; ?>>Funcionario<br>
				<!--input type="radio" name="entidad" value="2">Dependencia<br-->
				<!--input type="radio" name="entidad" value="4" <?php echo $entidad4; ?>>Cargo<br-->
				<input type="radio" name="entidad" value="5" <?php echo $entidad5; ?>>Rol
			</td>
		</tr>
		<tr id="fila_ruta" style="display:none">
			<td class="encabezado">Ruta libreria</td>
			<td bgcolor="#FFFFFF">
				<input type="text" name="ruta" value="<?php echo $datos[0]["ruta"]; ?>" style="width:100%">
			</td>
		</tr>
		<tr id="fila_llave">
			<td class="encabezado">Llave entidad</td>
			<td bgcolor="#FFFFFF" id="arbol_1"><?php echo arbol('llave',$datos[0]["llave"],$datos[0]["entidad"],$archivo); ?></td>
			<td bgcolor="#FFFFFF" id="lista_1" style="display:none"><?php echo lista($datos[0]["llave"],$idformato); ?></td>
		</tr>
		<tr id="fila_funcion" style="display:none">
			<td class="encabezado">Nombre funcion</td>
			<td bgcolor="#FFFFFF" id="arbol_1"><input type="text" value="<?php echo $datos[0]["funcion"]; ?>" name="funcion" style="width:100%"></td>
		</tr>
		<tr>
			<td class="encabezado">Firma</td>
			<td bgcolor="#FFFFFF">
			<input type="radio" name="firma" value="1" <?php echo $checked1; ?>>Firma visible<br>
			<input type="radio" name="firma" value="2" <?php echo $checked2; ?>>Revisado<br>
			<input type="radio" name="firma" value="0" <?php echo $checked0; ?>>Ninguna
				
			</td>
		</tr>
		<tr>
			<td class="encabezado">Orden</td>
			<td bgcolor="#FFFFFF"><input type="text" name="orden" id="orden" value="<?php echo ($orden[0]["orden"]); ?>"></td>
		</tr>
		<tr>
			<td colspan="2" bgcolor="#FFFFFF"><input type="submit" value="Editar"></td>
		</tr>
	</table>
	<input type="hidden" name="accion" value="registrar_editar">
	<input type="hidden" name="idformato_ruta" value="<?php echo $_REQUEST["idformato_ruta"]; ?>">
	<input type="hidden" name="idformato" value="<?php echo $_REQUEST["idformato"]; ?>">
	</form>
	<script>
	$('input[name$="entidad"]').click(function(){
		if(this.value==1){
			treellave.deleteChildItems(0);
			treellave.loadXML("<?php echo $ruta_db_superior; ?>test.php?sin_padre=1");
		}
    if(this.value==5){
			treellave.deleteChildItems(0);
			treellave.loadXML("<?php echo $ruta_db_superior; ?>test.php?sin_padre=1&rol=1");
		}
		if(this.value==2){
			treellave.deleteChildItems(0);
   			treellave.loadXML("<?php echo $ruta_db_superior; ?>test_serie.php?tabla=dependencia");
		}
		if(this.value==4){
			treellave.deleteChildItems(0);
   			treellave.loadXML("<?php echo $ruta_db_superior; ?>test_serie.php?tabla=cargo&estado=1");
		}
	});
	$('input[name$="tipo"]').click(function(){
		if(this.value==1){
			$("#lista_1").hide();
			$("#arbol_1").show();
			$("#lista_formatos").removeAttr("name");
			
			$("#fila_entidad").show();
			$("#fila_llave").show();
			$("#fila_ruta").hide();
			$("#fila_funcion").hide();
		}
		if(this.value==2){
			$("#arbol_1").hide();
			$("#lista_1").show();
			$("#lista_formatos").attr("name","llave");
			
			$("#fila_entidad").show();
			$("#fila_llave").show();
			$("#fila_ruta").hide();
			$("#fila_funcion").hide();
		}
		if(this.value==3){
			$("#fila_entidad").hide();
			$("#fila_llave").hide();
			$("#fila_ruta").show();
			$("#fila_funcion").show();
		}
	});
	$("#tipo2").click(function(){
		$("#arbol_1").hide();
		$("#lista_1").show();
		$("#lista_formatos").attr("name","llave");
	});
	$("#tipo3").click(function(){
		$("#fila_entidad").hide();
		$("#fila_llave").hide();
		$("#fila_ruta").show();
		$("#fila_funcion").show();
	});
	<?php if($datos[0]["tipo_campo"]==2){ ?>
	$("#tipo2").click();
	<?php } ?>
	<?php if($datos[0]["tipo_campo"]==3){ ?>
	$("#tipo3").click();
	<?php } ?>
	</script>
	<?php
	encriptar_sqli("formulario_ruta",1,"form_info",$ruta_db_superior);
}
function registrar_adicionar(){
	global $ruta_db_superior;
	$fun=$_REQUEST["llave"];
	$firma=$_REQUEST["firma"];
	$orden=$_REQUEST["orden"];
	$entidad=$_REQUEST["entidad"];
	$tipo_campo=$_REQUEST["tipo"];
	$ruta=$_REQUEST["ruta"];
	$funcion=$_REQUEST["funcion"];
	$idruta=$_REQUEST["idformato_ruta"];
	$idformato=$_REQUEST["idformato"];
	$formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);
	$sql="insert into formato_ruta (llave, firma, orden, entidad, formato_idformato, tipo_campo, ruta, funcion) values ('".$fun."', '".$firma."', '".$orden."', '".$entidad."', '".$idformato."' , '".$tipo_campo."', '".$ruta."', '".$funcion."')";
	
	guardar_traza($sql,$formato[0]["nombre_tabla"]);
	phpmkr_query($sql);
	redirecciona("rutas_automaticas.php?idformato=".$idformato);
}


function registrar_editar(){
	global $ruta_db_superior;
	$fun=$_REQUEST["llave"];
	$firma=$_REQUEST["firma"];
	$orden=$_REQUEST["orden"];
	$entidad=$_REQUEST["entidad"];
	$tipo_campo=$_REQUEST["tipo"];
	$ruta=$_REQUEST["ruta"];
	$funcion=$_REQUEST["funcion"];
	$idruta=$_REQUEST["idformato_ruta"];
	$idformato=$_REQUEST["idformato"];
	$formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);
	$sql="update formato_ruta set llave='".$fun."', firma='".$firma."', orden='".$orden."', entidad='".$entidad."', tipo_campo='".$tipo_campo."', ruta='".$ruta."', funcion='".$funcion."' where idformato_ruta=".$idruta;
	guardar_traza($sql,$formato[0]["nombre_tabla"]);
	phpmkr_query($sql);
	redirecciona("rutas_automaticas.php?idformato=".$idformato);
}
function eliminar(){
	$idruta=$_REQUEST["idformato_ruta"];
	$idformato=$_REQUEST["idformato"];
	$sql1="delete from formato_ruta where idformato_ruta=".$idruta;
	$formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);
	guardar_traza($sql1,$formato[0]["nombre_tabla"]);
	phpmkr_query($sql1);
	redirecciona("rutas_automaticas.php?idformato=".$idformato);
}


function arbol($nombre,$seleccionado=Null,$entidad=Null,$archivo=Null){
	global $ruta_db_superior;
	if(!$archivo){
		$archivo=$ruta_db_superior."test.php?sin_padre=1&seleccionado=".$seleccionado;
	}
	if($seleccionado){
		if($entidad==1){
			$nombres=busca_filtro_tabla("","funcionario","funcionario_codigo=".$seleccionado,"",$conn);
			$cadena=ucwords(strtolower($nombres[0]["nombres"]))." ".ucwords(strtolower($nombres[0]["apellidos"]));
		}
    else if($entidad==5){
			$nombres=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$seleccionado,"",$conn);
			$cadena=ucwords(strtolower($nombres[0]["nombres"]))." ".ucwords(strtolower($nombres[0]["apellidos"]));
		}
		else if($entidad==4){
			$nombres=busca_filtro_tabla("","cargo","idcargo=".$seleccionado,"",$conn);
			$cadena=ucwords(strtolower($nombres[0]["nombre"]));
		}
		echo $cadena."<br>";
	}
	?>
	<input type="hidden" class="required" name="<?php echo $nombre; ?>" id="<?php echo $nombre; ?>" value="<?php echo $seleccionado; ?>">
			<span class="phpmaker">
			      Buscar:<br><input type="text" id="stext" width="200px" size="20">      
      <a href="javascript:void(0)" onclick="tree<?php echo $nombre; ?>.findItem(document.getElementById('stext').value,1)">
      <img src="<?php echo $ruta_db_superior; ?>botones/general/anterior.png" border="0px" alt="Anterior"></a>
      <a href="javascript:void(0)" onclick="tree<?php echo $nombre; ?>.findItem(document.getElementById('stext').value,0,1)">
      <img src="<?php echo $ruta_db_superior; ?>botones/general/buscar.png" border="0px" alt="Buscar"></a>
      <a href="javascript:void(0)" onclick="tree<?php echo $nombre; ?>.findItem(document.getElementById('stext').value)">
      <img src="<?php echo $ruta_db_superior; ?>botones/general/siguiente.png" border="0px" alt="Siguiente"></a><br />
<br />
         <div id="esperando_func">
    <img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
				<div id="treeboxbox_tree<?php echo $nombre; ?>"></div>				
	<script type="text/javascript">
  <!--
  		var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree<?php echo $nombre; ?>=new dhtmlXTreeObject("treeboxbox_tree<?php echo $nombre; ?>","100%","100%",0);
			tree<?php echo $nombre; ?>.setImagePath("<?php echo $ruta_db_superior; ?>imgs/");
			tree<?php echo $nombre; ?>.enableIEImageFix(true);
			tree<?php echo $nombre; ?>.enableCheckBoxes(1);
      tree<?php echo $nombre; ?>.enableRadioButtons(true);
			tree<?php echo $nombre; ?>.setOnLoadingStart(cargando_func);
      tree<?php echo $nombre; ?>.setOnLoadingEnd(fin_cargando_func);
      tree<?php echo $nombre; ?>.enableSmartXMLParsing(true);
			tree<?php echo $nombre; ?>.loadXML("<?php echo $archivo; ?>");
			tree<?php echo $nombre; ?>.setOnCheckHandler(onNodeSelect_tree<?php echo $nombre; ?>);
        function onNodeSelect_tree<?php echo $nombre; ?>(nodeId)
        {valor_destino=document.getElementById("<?php echo $nombre; ?>");
         if(tree<?php echo $nombre; ?>.isItemChecked(nodeId))
           {if(valor_destino.value!=="")
            tree<?php echo $nombre; ?>.setCheck(valor_destino.value,false);
            if(nodeId.indexOf("_")!=-1)
               nodeId=nodeId.substr(0,nodeId.indexOf("_"));
            valor_destino.value=nodeId;
           }
         else
           {valor_destino.value="";
           }
        }
			function fin_cargando_func() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_func")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_func")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_func"]');
        document.poppedLayer.style.display = "none";
      }

      function cargando_func() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_func")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_func")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_func"]');
        document.poppedLayer.style.display = "";
      }
	-->					
	</script>
	<?php
}
function lista($seleccionado,$idformato){
	global $ruta_db_superior;
	$campos=busca_filtro_tabla("","campos_formato","formato_idformato=".$idformato." and etiqueta_html in ('arbol','select')","",$conn);
	?>
	<select id="lista_formatos">
	<?php
	for($i=0;$i<$campos["numcampos"];$i++){
		$selected='';
		if($campos[$i]["idcampos_formato"]==$seleccionado)$selected=' selected ';
		?>
		<option value="<?php echo $campos[$i]["idcampos_formato"]; ?>" <?php echo $selected; ?>><?php echo ucwords(strtolower($campos[$i]["etiqueta"])); ?></option>
		<?php
	}
	?>
	</select>
	<?php
}
?>
<?php
/*
<Archivo>
<Nombre>despachar_admin.php</Nombre> 
<Parametros>$_REQUEST["doc"]:iddocumento, $_REQUEST["funcion_despacho"]:nobre dde la funcion a ejecutor</Parametros>
<ruta>saia1.06/despachar_admin.php</ruta>
<Responsabilidades>administra las salidas de un documento, adiciona, edita y lista las salidas<Responsabilidades>
<Notas>En mensajeria interna salen los funcionario que esten en SAIA y que su cargo sea mensajero tipo_despacho=2</Notas>
<Salida></Salida>
</Archivo>
*/

$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }

include_once("db.php");
include_once("pantallas/lib/librerias_cripto.php");
$validar_enteros=array("doc","idsalidas","id");
include_once("librerias_saia.php");
desencriptar_sqli('form_info');
$doc_menu=@$_REQUEST["doc"];
include_once("pantallas/documento/menu_principal_documento.php");
echo(menu_principal_documento($doc_menu,1));

include_once("header.php");
include_once("class_transferencia.php");
include_once("class.funcionarios.php");
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<script language="javascript" type="text/javascript">
////////////////////////////////////////////Autocompletar con jquery /////////////////////////////////////
$().ready(function() {
   function formatItem(row) {
		return row[1] + " (<strong>Documento: " + row[2] + "</strong>)";
	}
	function formatResult(row) {
		return row[1].replace(/(<.+?>)/gi, '');
	}
  
	$("#auto0").autocomplete('formatos/librerias/seleccionar_ejecutor.php?tipo=nombre', {
		width: 500,
		max:10,
    scroll: true,
		scrollHeight: 150,
		matchContains: true,
    minChars:4,
    formatItem: formatItem,
    formatResult: function(row) {
		return row[4];
		}
	});
	$("#auto0").result(function(event, data, formatted) {
		if (data){
      $("#empresa").val(data[0]);	
		}
	});
 $("#auto1").autocomplete('formatos/librerias/seleccionar_ejecutor.php?tipo=nombre', {
		width: 500,
		max:10,
    scroll: true,
		scrollHeight: 150,
		matchContains: true,
    minChars:4,
    formatItem: formatItem,
    formatResult: function(row) {
		return row[4];
		}
	});
	$("#auto1").result(function(event, data, formatted) {
		if (data){
      $("#responsable").val(data[0]);	
		}
	});
});
</script>
<?php
if(isset($_REQUEST["doc"]))
  $x_doc=$_REQUEST["doc"];
else if(isset($_SESSION["iddoc"]))
  $x_doc=$_SESSION["iddoc"];

if(isset($_REQUEST["anular_despacho"]))
  anular_despacho() ;

 mostrar_despacho();

 mostrar_despacho_radicacion(); 
 if(isset($_REQUEST["funcion_despacho"]))    
   echo $_REQUEST["funcion_despacho"]();
 echo("<br/><br/>");
/*
<Clase>
<Nombre>anular_despacho</Nombre> 
<Parametros>$_REQUEST["idsalidas"]:identificador del despacho</Parametros>
<Responsabilidades>pone el estado de un despacho en 0 para que no se muestre en el listado<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function anular_despacho()
{global $conn;
 //$sql="update salidas set estado=0 where idsalida='".$_REQUEST["idsalidas"]."'";
 $sql="DELETE FROM salidas WHERE idsalida=".$_REQUEST["idsalidas"];
 phpmkr_query($sql,$conn);
 alerta("Despacho anulado.");
}  

/*
<Clase>
<Nombre>mostrar_despacho</Nombre> 
<Parametros>$_REQUEST["doc"]:iddocumento</Parametros>
<Responsabilidades>Muestra un listado de las salidas de un documento<Responsabilidades>
<Notas>Esta se ejecuta pora un POSIT</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function mostrar_despacho()
{
 global $conn;
$x_doc=$_REQUEST["doc"];
 menu_ordenar($_REQUEST["doc"]);
 
 echo '<br /><br /><span class="internos">DESPACHO DE DOCUMENTOS<br><br></span>';
 $documento = busca_filtro_tabla("numero,descripcion","documento","iddocumento=$x_doc","",$conn);
 
 echo "<table borde=0><tr><td class='encabezado'>N&Uacute;MERO DE DOCUMENTO</td><td bgcolor='#f5f5f5'>".$documento[0]["numero"]."</td></tr><tr><td class='encabezado'>DESCRIPCI&Oacute;N</td><td bgcolor='#f5f5f5'>".($documento[0]["descripcion"])."</td></tr></table><br /><br /><a href='despachar_admin.php?funcion_despacho=adicionar_despacho&doc=$x_doc'>Adicionar Despacho</a><br /><br />"; 
 $despacho = busca_filtro_tabla("*","salidas","documento_iddocumento=$x_doc and estado=1","",$conn); 
  if($despacho["numcampos"]>0)
  {
   echo "<table border='0' width='70%' align='center'>
         <tr class='encabezado_list'><td>Fecha</td><td>N&uacute;mero de Gu&iacute;a</td>
         <td>Empresa</td><td>Responsable</td><td>Tipo de Despacho</td><td>Notas</td><td></td></tr>";
   for($i=0; $i<$despacho["numcampos"]; $i++)
    {
     if($despacho[$i]["tipo_despacho"]!=2)
     { $empresa=busca_filtro_tabla("idejecutor,nombre","ejecutor","idejecutor in ('".$despacho[$i]["responsable"]."','".$despacho[$i]["empresa"]."')","",$conn);     
       echo "<tr><td>".$despacho[$i]["fecha_despacho"]."</td><td>".$despacho[$i]["numero_guia"]."</td><td>";
       if($despacho[$i]["empresa"]== $empresa[1]["idejecutor"])
         echo $empresa[1]["nombre"]."</td><td>".$empresa[0]["nombre"]."</td>";
       else  
         echo $empresa[0]["nombre"]."</td><td>".$empresa[1]["nombre"]."</td>";
     }
     else
     { $responsable = busca_filtro_tabla("nombres,apellidos","funcionario","idfuncionario=".$despacho[$i]["responsable"],"",$conn);      
       echo "<tr><td>".$despacho[$i]["fecha_despacho"]."</td><td>&nbsp;</td><td>&nbsp;</td><td>".$responsable[0]["nombres"]." ".$responsable[0]["apellidos"]."</td>";
     }
     switch($despacho[$i]["tipo_despacho"])
     {
      case 1:
       $tipo="Mensajeria Externa";
      break;
      case 2:
       $tipo="Mensajeria Interna";
      break;
      case 3:
       $tipo="Entrega Personal";
      break;
     }
     echo "<td>$tipo</td><td>".$despacho[$i]["notas"]."</td><td><a href='despachar_admin.php?idsalidas=".$despacho[$i]["idsalida"]."&anular_despacho=1&doc=$x_doc'>Anular</a></td></tr>";   
    }
    echo "</table>";      
  }
  else
   echo "El documento no ha sido despachado";
}

/*
<Clase>
<Nombre>adicionar_despacho</Nombre> 
<Parametros></Parametros>
<Responsabilidades>formulario para adicioar un despacho o salida<Responsabilidades>
<Notas>Variable global $x_doc: iddocumento</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function adicionar_despacho()
{ 
 global $x_doc;
 global $conn;
 echo "<form id='despachar_admin' name='despachar_admin' action='despachar_admin.php' method='POST' onSubmit='return validar_despacho(this);'>
       <table border='0'><tr class='encabezado_list'><td colspan='4' align='center'>
       <b>ADICI&Oacute;N DE DESPACHO</b></td></tr>       
       <input type='hidden' value='$x_doc' name='x_doc'>
       <input type='hidden' value='$x_doc' name='doc'>
       <input type='hidden' value='transferir' name='funcion_despacho'>
       <tr><td class='encabezado'>N&Uacute;MERO DE GU&Iacute;A</td><td colspan='2' bgcolor='#F5F5F5'><input type='text' name='guia' id='guia'></td></tr>
       <tr><td class='encabezado'>EMPRESA</td><td colspan='2' bgcolor='#F5F5F5'><input type='hidden' id='empresa' name='empresa0'>
         <input type=\"text\" size=53 name=\"x_empresa0\" id=\"auto0\" >
                   </td></tr>
       <tr><td class='encabezado'>RESPONSABLE</td><td colspan='2' bgcolor='#F5F5F5'>
       <input type='hidden' id='responsable' name='responsable0'>
       <input type=\"text\" size=53 name=\"x_responsable0\" id=\"auto1\" >
</td></tr>";
  ?>  
  <tr> 
        <td class="encabezado" title="Seleccione el tipo de env&iacute;o: Mensajer&iacute;a Externa, Mensajer&iacute;a Interna o Entrega Personal"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span>
        <span  style="color: #FFFFFF;">TIPO DE MENSAJER&Iacute;A</span>
            </font>
        </td>
        <td bgcolor="#F5F5F5">
          <font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
          <span >  
          Mensajer&iacute;a Externa 
          <input type="radio" name="x_tipo_despacho" value="1" CHECKED OnClick="muestra_mensajero(0);"><br />          
          <?php
            $mensajero=array();
            $mensajero=busca_filtro_tabla("funcionario_idfuncionario","dependencia_cargo,cargo","lower(nombre)='mensajero' and dependencia_cargo.estado=1 and cargo_idcargo=idcargo","",$conn);            
          
            if($mensajero["numcampos"] > 0)
            {
          ?>
          Mensajer&iacute;a Interna    
          <input type="radio" name="x_tipo_despacho" value="2" OnClick="muestra_mensajero(1);"><br />
          <!--span>Entrega Personal&nbsp;&nbsp;&nbsp;
          <input type="radio" name="x_tipo_despacho" value="3" OnClick="muestra_mensajero(0);"-->
          <?php } ?>        
          </span></font></td>
          <td bgcolor="#F5F5F5">
          <div name="mensajero" id="mensajero" style="visibility:hidden;">
              <?php
              if($mensajero["numcampos"]>0){
                echo('Mensajeros:&nbsp;&nbsp;<select name="x_mensajero" id="x_mensajero"><option value="">Seleccionar...</option>');
                for($i=0; $i<$mensajero["numcampos"]; $i++){
                $dato_mensajero=busca_filtro_tabla("A.idfuncionario,A.nombres,A.apellidos","funcionario A","A.idfuncionario=".$mensajero[$i][0],"",$conn);                
                if($dato_mensajero["numcampos"])              
                  echo("<option value=".$dato_mensajero[0]["idfuncionario"].">".$dato_mensajero[0]["nombres"]." ".$dato_mensajero[0]["apellidos"]."</option>");
                }
                echo('</select>');
              }              
              ?>
          </div>
         </td> 
         </tr>
         <tr>
         <td class="encabezado" title=""><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span>
        <span  style="color: #FFFFFF;">NOTAS</span>
        </td>
         <td bgcolor="#F5F5F5" colspan="2">
          <textarea name="notas" cols="45" rows="5"></textarea>
         </td> 
      </tr>
  
  <?php            
  echo "<tr><td colspan='4' align='center'><br /><input type='submit' value='Adicionar'></td></tr>
       </table>
       </form>";
}
/*
<Clase>
<Nombre>editar_despacho</Nombre> 
<Parametros></Parametros>
<Responsabilidades>formulario para editar un despacho o salida<Responsabilidades>
<Notas>Variable global $x_doc: iddocumento</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function editar_despacho()
{ 
 global $x_doc;
 global $conn;
 $formulario="";
 $id = $_REQUEST["id"];
 $despacho = busca_filtro_tabla("*","salidas","idsalida=$id","",$conn);
 $empresa[0]["nombre"]="";
 $responsable[0]["nombre"]="";
 if($despacho[0]["tipo_despacho"]==2)
 {
  $mensajero=array();
  $mensajero=busca_funcionarios("cargo","mensajero");
  $nmensajeros=count($mensajero);
  if($nmensajeros){
    $formulario.='<tr><td class="encabezado">Mensajeros:&nbsp;&nbsp;</td><td><select name="x_mensajero" id="x_mensajero">';
    for($i=0;$i<$nmensajeros;$i++)
    {
    $dato_mensajero=busca_filtro_tabla("A.idfuncionario,A.nombres,A.apellidos","funcionario A","A.idfuncionario=".$mensajero[$i],"",$conn);                
    if($dato_mensajero["numcampos"])              
      $formulario.= "<option value=".$dato_mensajero[0]["idfuncionario"];
    if($dato_mensajero[0]["idfuncionario"]==$despacho[0]["responsable"])
      $formulario.= " selected";        
    $formulario.= ">".$dato_mensajero[0]["nombres"]." ".$dato_mensajero[0]["apellidos"]."</option>";
    }
    $formulario.='</select></td></tr>';
  }
  else
  { $formulario.= "No existen mensajeros registrados.";
     return true;
  }   
 }
 else
 {
 if($despacho[0]["empresa"]!="")
   $empresa = busca_filtro_tabla("nombre","ejecutor","idejecutor=".$despacho[0]["empresa"],"",$conn);
 if($despacho[0]["responsable"]!="")
   $responsable = busca_filtro_tabla("nombre","ejecutor","idejecutor=".$despacho[0]["responsable"],"",$conn);
 $formulario = "<tr><td class='encabezado'>N&uacute;mero Gu&iacute;a</td><td>
       <input type='text' name='guia' value='".$despacho[0]["numero_guia"]."'></td></tr>
        <tr><td class='encabezado'>Empresa</td><td><input type='hidden' name='empresa0'>
       <div id=\"lista0\" onmouseout=\"v=1;\" onmouseover=\"v=0;\">
       <input type=\"text\" size=53 name=\"x_empresa0\" id=\"auto0\" value='".$empresa[0]["nombre"]."' autocomplete=off onkeyup=\"if(Teclados(event,'0') == 1)
      {autocompletar('0',auto0.value,'3','empresa0');}\" onkeydown = \"document.getElementById('empresa0').value='';ParaelTab(event,'0','empresa0');\" 
       onfocus=\"document.getElementById('comple0').style.visibility='visible';\" onblur=\"eliminarespacio(this);\">
       </div><div id=\"comple0\" name=\"comple0\" style=\"position:absolute\" 
       onmouseout=\"document.getElementById('comple0').style.display='none';\"></div>
       </td></tr>
<tr><td class='encabezado'>Responsable</td><td><input type='hidden' name='responsable0'>
<div id=\"lista1\" onmouseout=\"v=1;\" onmouseover=\"v=0;\">
      <input type=\"text\" size=53 name=\"x_responsable0\" value='".$responsable[0]["nombre"]."' id=\"auto1\" autocomplete=off onkeyup=\"if(Teclados(event,'1') == 1)
      {autocompletar('1',auto1.value,'3','responsable0');}\" onkeydown = \"document.getElementById('responsable0').value='';ParaelTab(event,'1','responsable0');\" 
       onfocus=\"document.getElementById('comple1').style.visibility='visible';\" onblur=\"eliminarespacio(this);\">
       </div><div id=\"comple1\" name=\"comple1\" style=\"position:absolute\" 
       onmouseout=\"document.getElementById('comple1').style.display='none';\"></div></td></tr>";
 }  
 echo "<form id='despachar_admin' name='despachar_admin' action='despachar_admin.php' method='POST'>
       <table border='0'>       
       <input type='hidden' value='$x_doc' name='x_doc'>
       <input type='hidden' value='transferir' name='funcion_despacho'>
       <input type='hidden' value='$id' name='editar'>
       $formulario       
       <tr><td colspan='4'><input type='submit' value='Guardar Cambios'></td></tr>
       </table>
       </form>";
}
encriptar_sqli("despachar_admin",1);
/*
<Clase>
<Nombre>transferir</Nombre> 
<Parametros></Parametros>
<Responsabilidades>Inserta los despachos, los edita realiza la transferencia con nombre DISTRIBUCION del usuario al radicador_salida y envia el mensaje por correo si esta configurado.<Responsabilidades>
<Notas>Variable global $x_doc: iddocumento</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones>Estar configurado el radicador de salida, correo despacho par aenviar la notificacion por correo<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function transferir()
{
  global $conn,$sql; 
  global $x_doc;
  //print_r($_REQUEST);
  $notificacion = false;   
  $envio = busca_filtro_tabla("valor","configuracion","nombre='correo_despacho'","",$conn);
  if($envio["numcampos"]>0 && $envio[0]["valor"]==1)
   $notificacion = true;  
  $x_tipo_despacho = @$_REQUEST["x_tipo_despacho"];
  $x_mensajero = @$_REQUEST["x_mensajero"];       
  $empresa=@$_REQUEST["x_empresa0"];  
  $guia=@$_REQUEST["guia"];  
  $responsable=(htmlspecialchars_decode(html_entity_decode((trim($_REQUEST["x_responsable0"])))));
  if($responsable!="")
  {$lresponsable=busca_filtro_tabla("A.*","ejecutor A","A.nombre LIKE '".$responsable."'","",$conn); 
  if($lresponsable["numcampos"] ){
    $idresponsable=$lresponsable[0]["idejecutor"];
  } 
  else if($responsable<>"")
  {
    $sql="INSERT INTO ejecutor(nombre) VALUES('".$responsable."')";    
    phpmkr_query($sql,$conn);
    $idresponsable=phpmkr_insert_id();
  }  
  $lempresa=busca_filtro_tabla("A.*","ejecutor A","A.nombre LIKE'".$empresa."'","",$conn); 
  if($lempresa["numcampos"] ){
    $idempresa=$lempresa[0]["idejecutor"];
  }
  else if($empresa<>""){
    $sql="INSERT INTO ejecutor(nombre) VALUES('".$empresa."')";
    phpmkr_query($sql,$conn);
    $idempresa=phpmkr_insert_id();
  }
  }  
  if($idresponsable<>"" || $x_tipo_despacho==2){
    if($x_tipo_despacho==2)
    {    
    $sql="INSERT INTO salidas(documento_iddocumento,responsable,fecha_despacho,tipo_despacho,notas) VALUES ($x_doc,$x_mensajero,".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",'$x_tipo_despacho','".$_REQUEST["notas"]."')";
      $otros["notas"]="'Documento despachado utilizando mensajeria interna'";     
    } 
    else   
    { $datos["origen"]=usuario_actual("funcionario_codigo");
      $enviado=usuario_actual("login");
      $ejecutores=array();    
      /*$ejecutor["numcampos"]=0;
      $ejecutor=busca_filtro_tabla("ejecutor","documento","iddocumento=".$x_doc,"",$conn);
      if($ejecutor["numcampos"])
      {
         array_push($ejecutores,$ejecutor[0]["ejecutor"]);
         $ejecutores=array_unique($ejecutores);
      }*/
      $radicador_salida=busca_filtro_tabla("","configuracion","nombre LIKE 'radicador_salida'","",$conn);
      if($radicador_salida["numcampos"]){
        $funcionario=busca_filtro_tabla("","funcionario","login LIKE '".$radicador_salida[0]["valor"]."'","",$conn);
        if($funcionario["numcampos"]){
          $ejecutores=array($funcionario[0]["funcionario_codigo"]);
        }
      }
      if(!count($ejecutores))
        $ejecutores=array(usuario_actual("funcionario_codigo"));
      if($idempresa=="")
         $valores="'".$guia."','".$x_doc."',NULL,'$idresponsable'";
      elseif($idresponsable=="")
         $valores="'".$guia."','".$x_doc."','".$idempresa."',NULL";
      else 
         $valores="'".$guia."','".$x_doc."','".$idempresa."','$idresponsable'";    
      $valores.= ",".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s");
	
	  $x_notas=@$_REQUEST['notas'];
      $sql="INSERT INTO salidas(numero_guia,documento_iddocumento,empresa,responsable,fecha_despacho,tipo_despacho,notas) VALUES (".$valores.",'$x_tipo_despacho','".$x_notas."')";
	  
	  
	  
      $otros["notas"]="'Documento despachado";
      if($empresa!="")
        $otros["notas"].=" En $empresa ";
      if($responsable!="")
        $otros["notas"].=" ($responsable)";
      $otros["notas"].=" con Guia: $guia Por $enviado'";
    } 
    if(isset($_REQUEST["editar"]))
    { if($idempresa=="")
         $idempresa = "NULL";        
       $sql = "UPDATE salidas SET numero_guia='$guia',empresa=$idempresa,responsable=$idresponsable WHERE idsalida=".$_REQUEST["editar"];        
        phpmkr_query($sql,$conn);
    } 
    else
    {  //die("aqui entra $sql");
        phpmkr_query($sql,$conn);
         $sql="update documento set estado='GESTION' ,tipo_despacho='$x_tipo_despacho' where iddocumento=".$x_doc;      
        phpmkr_query($sql,$conn);
        $datos["archivo_idarchivo"]=$x_doc;
        $datos["tipo_destino"]=1;
        $datos["tipo"]="";
        $datos["nombre"]="DISTRIBUCION";
        transferir_archivo_prueba($datos,$ejecutores,$otros);
        //Envio de notificacion sobre el despacho de un documento al ejecutor
        if($notificacion)
        {
        $documento_mns = busca_filtro_tabla("descripcion,plantilla,tipo_radicado","documento","iddocumento=".$x_doc,"",$conn);
        if($documento_mns["numcampos"] && $documento_mns[0]["tipo_radicado"]!=1){
          array_push($ejecutores,$documento_mns[0]["ejecutor"]);
        }
        $mensaje = "Tiene un nuevo documento para su revision: Tipo: ".ucfirst($documento_mns[0]["plantilla"])." - Descripcion: ".$documento_mns[0]["descripcion"];
        $x_tipo_envio[] = 'msg';
        $x_tipo_envio[] = 'e-interno';                         
        $destino_mns[0] = $ejecutores;             
        enviar_mensaje("origen",$destino_mns,$mensaje);
       }
    }     
  }
  else {
    alerta("No se puede realizar el despacho");
  }  
  
  redirecciona("despachar_admin.php?doc=$x_doc");
}
?>
<script>

function muestra_mensajero(op){
if(op==1)
  { document.getElementById("mensajero").style.visibility="visible";    
    document.getElementById("guia").disabled=true;
    document.getElementById("auto0").disabled=true;
    document.getElementById("auto1").disabled=true;
  }
else   
  { document.getElementById("mensajero").style.visibility="hidden";
    document.getElementById("guia").disabled=false;
    document.getElementById("auto0").disabled=false;
    document.getElementById("auto1").disabled=false;
  }
}

function validar_despacho(f)
{  
 if(f.x_tipo_despacho[1].checked)
 { 
  if(f.x_mensajero.value=="")
  { alert("Debe seleccionar a un mensajero interno responsable del despacho");
    return false;
  }   
 }
 else
 {
  if(f.x_responsable0.value=="")   
   { alert("Debe existir un responsable para el despacho");
     return false;
   }
 } 
 return true;      
}

elementoSeleccionado=0;
v=1;

/*
<Clase>
<Nombre>llamado
<Parametros>url-pagina que se quiere cargar; id_contenedor-id del elemento donde se van a escribir los resultados;
parametros-par�metros que ser�n pasados por el post a la pagina que vamos a llamar
<Responsabilidades>llamado asincrono a la pagina (ajax)
<Notas>utiliza la funci�n cargarpagina
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function llamado(url, id_contenedor,parametros)
{var pagina_requerida = false
 if (window.XMLHttpRequest) 
	{// Si es Mozilla, Safari etc
	 pagina_requerida = new XMLHttpRequest();
	} 
 else if (window.ActiveXObject)
	{ // pero si es IE
	 try 
		{pagina_requerida = new ActiveXObject("Msxml2.XMLHTTP");
		} 
	 catch (e)
		{ // en caso que sea una versi�n antigua
		 try
			{pagina_requerida = new ActiveXObject("Microsoft.XMLHTTP");
			}
		 catch (e){}
		}
 	}
 else
	return false
 pagina_requerida.onreadystatechange=function(){ // funci�n de respuesta
   	if(pagina_requerida.readyState==4)
     { 	
  		if(pagina_requerida.status==200)
          {
    			 cargarpagina(pagina_requerida, id_contenedor);
    		  }
       else if(pagina_requerida.status==404)
          {
  			   document.write("La p�gina no existe");
  		    }
  	  }
   
   }
 
 pagina_requerida.open('POST', url, true); // asignamos los m�todos open y send
 pagina_requerida.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 pagina_requerida.send(parametros);

}
/*
<Clase>
<Nombre>cargarpagina
<Parametros>pagina_requerida-objeto XMLHttpRequest ;id_contenedor-id del componente donde se pondr�n los datos
<Responsabilidades> poner la informaci�n requerida en su sitio en la pagina xhtml
<Notas>
<Excepciones>si no se encuentra un elemento con el id id_contenedor genera un error,
si hay errores en el codigo html presenta problemas
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function cargarpagina(pagina_requerida, id_contenedor)
  {
   if (pagina_requerida.readyState == 4 && (pagina_requerida.status==200 || window.location.href.indexOf("http")==-1))
      document.getElementById(id_contenedor).innerHTML=pagina_requerida.responseText;
  }


/*
<Clase>
<Nombre>mouseFuera
<Parametros>numero-del elemento sobre el cual se encontraba el mouse
<Responsabilidades>Des-selecciono el elemento actualmente seleccionado, si es que hay alguno
<Notas>se utiliza para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function mouseFuera(numero)
{
	if(elementoSeleccionado!=0) 
    {
	    document.getElementById("d" + numero + "comp" + elementoSeleccionado).style.color="#000000";
	  }
}

/*
<Clase>
<Nombre>mouseDentro
<Parametros>elemento-sobre el cual est� el mouse;numero-del elemento sobre el cual se encuentra el mouse
<Responsabilidades>Establezco el nuevo elemento seleccionado
<Notas>se utiliza para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function mouseDentro(elemento, numero)
{
	mouseFuera(numero);
	elemento.style.color="#CC0000";
	elemento.style.cursor="pointer";
	elementoSeleccionado=elemento.title;
}

/*
<Clase>
<Nombre> autocompletar
<Parametros>idcomponente-id del componente;digitado-valor digitado
<Responsabilidades>llama la funci�n en php que consulta la bd y llena la lista de opciones
<Notas>para el autocompletar
<Excepciones>
<Salida>una lista de los valores coincidentes
<Pre-condiciones>
<Post-condiciones>
*/ 
function autocompletar(idcomponente, digitado,tipo,nombre)
{
  llamado("Autocompletar.php","comple"+idcomponente,"op=autocompl&idcomponente="+idcomponente+"&digitado="+digitado+"&depende=1&tipo="+tipo+"&nombre="+nombre);
  document.getElementById("comple"+idcomponente).style.display="inline";
}
/*
<Clase>
<Nombre>Teclados
<Parametros>
<Responsabilidades>llama las funciones necesarias dependiendo de la tecla
<Notas>Para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function Teclados(evento,numero)
{
	var teclaPresionada=(document.all) ? evento.keyCode : evento.which;

  switch(teclaPresionada)
	{ //para la flecha abajo
		case 40:
		if(elementoSeleccionado<document.getElementById("interno" + numero).childNodes.length-1)
		{
			mouseDentro(document.getElementById("d" + numero + "comp" + (parseInt(elementoSeleccionado)+1)), numero);
		}
		return 0;
		//para la flecha arriba
		case 38:
		if(elementoSeleccionado>1)
		{
			mouseDentro(document.getElementById("d" + numero + "comp" + (parseInt(elementoSeleccionado)-1)), numero);
		}
		return 0;
		//para el tab
		case 9:
		return 0;
		
		default: elementoSeleccionado=0;return 1;
	}
}

/*
<Clase>
<Nombre>ParaelTab
<Parametros>
<Responsabilidades>autocompletar con el valor seleccionado al presionar tab
<Notas>Para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function ParaelTab(evento,numero,nombre)
{
	var teclaPresionada=(document.all) ? evento.keyCode : evento.which;
	if(teclaPresionada==9 || teclaPresionada==13)
	{
	 if(elementoSeleccionado!=0)
		  {
       clickLista(document.getElementById("d" + numero + "comp" + elementoSeleccionado),"auto"+numero, "comple"+numero, document.getElementById("d"+numero+"valor"+elementoSeleccionado).value,nombre);
		  }
	 if(teclaPresionada==13)
		{
		  if(document.all)
		  {
        evento.keyCode=9;
      }
      else
      {
        evento.preventDefault();
        evento.stopPropagation();
      }
      
		}
	}
}

/*
<Clase>
<Nombre>clickLista
<Parametros>elemento-seleccionado; inputLista-input donde se pondr� el valor; divLista-div con las opciones
<Responsabilidades>Se ejecuta cuando se hace clic en algun elemento de la lista. Se coloca en el input el
	valor del elemento clickeado
<Notas>Para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function clickLista(elemento,inputLista, divLista,codigo,nombre)
{	v=1;
	valor=elemento.innerHTML; 
	pos=valor.indexOf("(");
	if(pos>0)
	{valor=valor.substring(0,pos);
	}
	document.getElementById(inputLista).value=valor;
	document.getElementById(divLista).style.display="none"; 
	elemento.style.backgroundColor="#EAEAEA"; 
	elementoSeleccionado = 0;
	document.getElementById(nombre).value=codigo;
}

function eliminarespacio(elemento)
{
  var cadena = elemento.value;
  var inicio = 0, j=0;
  var nuevo="", palabra="";
  for(var i=0; i<cadena.length; i++)
  {
    if(cadena.charAt(i)==" ")
    {
      nuevo += palabra + " ";
      palabra = "";
      while(cadena.charAt(i)==" " && i<cadena.length)
        i++;
      i--;
    }
    else
      palabra += cadena.charAt(i);
  }
  nuevo += palabra;
  elemento.value = nuevo;
}
</script>
<?php include_once("footer.php"); ?>


<?php 

function mostrar_despacho_radicacion(){
	global $conn,$ruta_db_superior;
	$html='<br><br><table class="table" style="width:100%;">';
	$iddoc=@$_REQUEST['doc'];
	$formato_radicacion=busca_filtro_tabla("b.nombre","documento a, formato b","lower(a.plantilla)=b.nombre AND a.iddocumento=".$iddoc,"",$conn);
	if($formato_radicacion[0]['nombre']=='radicacion_entrada'){
		$html.='<tr><th class="encabezado_list" style="text-align:center;" colspan="5">Despacho de Correspondencia</th></tr>';
		$html.='
			<tr>
				<th class="encabezado_list" style="text-align:center;">Numero Planilla</th>
				<th class="encabezado_list" style="text-align:center;">Fecha de Creaci&oacute;n</th>
				<th class="encabezado_list" style="text-align:center;">Mensajero</th>
				<th class="encabezado_list" style="text-align:center;">Recorrido</th>
				<th class="encabezado_list" style="text-align:center;">Novedad</th>
			</tr>';		
		$datos_radicacion=busca_filtro_tabla("idft_radicacion_entrada","documento a, ft_radicacion_entrada b","a.iddocumento=b.documento_iddocumento AND b.documento_iddocumento=".$iddoc,"",$conn);
		$destino_radicacion=busca_filtro_tabla("idft_destino_radicacion","ft_destino_radicacion","ft_radicacion_entrada=".$datos_radicacion[0]['idft_radicacion_entrada'],"",$conn);
		for($i=0;$i<$destino_radicacion['numcampos'];$i++){
			$idft_destino_radicacion=$destino_radicacion[$i]['idft_destino_radicacion'];
			$planillas=busca_filtro_tabla("c.numero,c.iddocumento,c.descripcion,b.mensajero,b.idft_despacho_ingresados","ft_item_despacho_ingres a,ft_despacho_ingresados b, documento c","a.ft_despacho_ingresados=b.idft_despacho_ingresados AND b.documento_iddocumento=c.iddocumento AND c.estado NOT IN('ELIMINADO','ANULADO') AND a.ft_destino_radicacio=".$idft_destino_radicacion,"",$conn);
        	if($planillas['numcampos']){
            	for($j=0;$j<$planillas['numcampos'];$j++){
            		$funcionario=busca_filtro_tabla("nombres,apellidos","vfuncionario_dc","iddependencia_cargo=".$planillas[$j]['mensajero'],"",$conn);
            		$idformato_despacho_ingresados=busca_filtro_tabla("","documento a, formato b","lower(a.plantilla)=b.nombre AND a.iddocumento=".$planillas[$j]['iddocumento'],"",$conn);
            		$tiene_novedades=busca_filtro_tabla("novedad,documento_iddocumento","ft_novedad_despacho","ft_despacho_ingresados=".$planillas[$j]['idft_despacho_ingresados'],"",$conn);
					$cadena_novedad='Sin Novedad';
            		if($tiene_novedades['numcampos']){
            			$cadena_novedad='';
            			for($x=0;$x<$tiene_novedades['numcampos'];$x++){
            				$titulo_novedad=ucwords(strtolower(codifica_encabezado(html_entity_decode($tiene_novedades[$x]['novedad']))));
            				$cadena_novedad='<div class="link kenlace_saia" enlace="ordenar.php?key='.$tiene_novedades[$x]['documento_iddocumento'].'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="Novedad '.$titulo_novedad.'"><span class="badge">'.$titulo_novedad.'</span></div><br>';
            			}			
            		}
            		
                	$html.='
                		<tr>
                			<td><div class="link kenlace_saia" enlace="ordenar.php?key='.$planillas[$j]['iddocumento'].'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado '.$planillas[$j]['numero'].'"><center><span class="badge">'.$planillas[$j]['numero'].'</span></center></div>
                			</td>                		
                			<td>'.codifica_encabezado(html_entity_decode($planillas[$j]['descripcion'])).'</td>
                			<td>'.codifica_encabezado(html_entity_decode($funcionario[0]['nombres'].' '.$funcionario[0]['apellidos'])).'</td>
                			<td>'.mostrar_valor_campo('tipo_recorrido',$idformato_despacho_ingresados[0]['idformato'],$planillas[$j]['iddocumento'],1).'</td>
                			<td>'.$cadena_novedad.'</td>
                		</tr>';
            	} //fin for planillas
        	} //fin if planillas numcampos			
		} //fin for $destino_radicacion		
	} //fin if formato=='radicacion_entrada'
	$html.='</table>';
	echo($html);
} //fin function

?>
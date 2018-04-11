<?php include_once("db.php");
if(@$_SESSION["LOGIN".LLAVE_SAIA]){
	$fecha_actualiza=busca_filtro_tabla("valor,MAX(fecha)","configuracion","tipo='fecha' AND nombre='fecha_creacion_funcionario'","GROUP BY fecha",$conn);	
	//print_r($fecha_actualiza);
	if($fecha_actualiza["numcampos"] && $fecha_actualiza[0]["valor"]<date("Y-m-d")){
    cargar_funcionarios();
    if(actualizar_funcionarios())
    {
      ejecuta_sql("UPDATE configuracion SET valor='".date("Y-m-d")."' WHERE configuracion.nombre='fecha_creacion_funcionario'",$conn);
     //poner aqui lo de la generacion de xml tree
     include_once("test4");
    }
  }
  $fecha_actualiza=busca_filtro_tabla("valor,MAX(fecha)","configuracion","tipo='fecha' AND nombre='fecha_inicio_contador'","GROUP BY fecha",$conn);
  if($fecha_actualiza["numcampos"] && $fecha_actualiza[0]["valor"]<date("Y-m-d")){
   actualiza_contador($fecha_actualiza[0]["valor"]);
  }
}  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>SAIA-CAMARA DE COMERCIO DE PEREIRA</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body topmargin="0">
<div align="center">
  <table width="978" height="530" border="0" cellspacing="0"  cellpadding="0" background="imagenes/fondot.png" id="tabla" style="background-repeat: no-repeat; background-position:top" >
    <tr>
      <td>&nbsp;</td>
      <td height="80">&nbsp; </td>
      <td height="80" colspan="2" valign="top"> 
        <table>
          <tr> 
            <td valign="top" align="center"> 
              <?php
          agrega_boton("botones/boton","botones/general/volver.gif","botones.php?llave=1","centro","VOLVER","","");
          ?>
            </td>
            <td valign="top" align="center"> 
              <?php
          agrega_boton("botones/boton","botones/general/radicacion.gif","botones.php?llave=2","menu","RADICACION","","radicacion");
          ?>
            </td>
            <td valign="top" align="center"> 
              <?php 
          agrega_boton("botones/boton","botones/general/configuracion.gif","botones.php?llave=3","menu","ADMINISTRAR","","configuracion");
          ?>
            </td>
            <td valign="top" align="center"> 
              <?php
          agrega_boton("botones/boton","botones/general/documentacion.gif","botones.php?llave=4","menu","LISTADO DOCUMENTOS","","transferencia");
          ?>
            </td>
            <td valign="top" align="center"> 
              <?php
          agrega_boton("botones/boton","botones/general/cerrar.gif","logout.php?llave=1","centro","CERRAR SESION","","");
          ?>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td width="13" align="right">&nbsp;</td>
      <td width="117" height="500" align="right"> 
        <iframe name="menu" height="100%" width="100%" scrolling="auto" frameborder="0" src="lateral.php"></iframe> 
      </td>
      <td width="840" height="500" align="center"> 
        <iframe name="centro" height="100%" width="100%" scrolling="auto" frameborder="0" src="login.php"></iframe></td>
      <td width="8" align="center">&nbsp;</td>
    </tr>
  </table>
</div>
</body>
</html>

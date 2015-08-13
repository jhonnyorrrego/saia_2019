<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head runat="server" >
<title>MenuMatic Vertical Example</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body topmargin="0"  marginheight="0" topmargin="0" vspace="0"
marginwidth="0" leftmargin="0" hspace="0" style="margin:0; padding:0">
<html>
<head>
<title>..::ADMINISTRADOR DE ARCHIVO::.. </title>
<script type="text/javascript" src="../js/jquery.js"></script>
</head>
<body>
<form action='paso1.php' method='POST' onsubmit="return envio_formulario(this);">
<table>
  <tr>
    <td>
      Nombre de la nueva instalaci&oacute;n
    </td>
    <td>
      <input type='text' name='nombre' id='nombre'>
    </td>
  </tr>  
  <tr>
    <td>
      Sistema Operativo
    </td>
    <td>
      <select name='SO' id='SO'>
        <option value='Linux' selected>Linux</option>
        <option value='Windows'>Windows</option>
      </select>
    </td>
  </tr>
  <tr>
    <td>
      Motor de la base de datos
    </td>
    <td>
      <select name='MOTOR' id='MOTOR'>
        <option value='MySql' selected>Mysql</option>
        <option value='Oracle'>Oracle</option>
      </select>
    </td>
  </tr>  
  <tr>
    <td>
      Puerto para conexi&oacute; a la base de datos
    </td>
    <td>
      <input type='text' name='PORT' id='PORT' value="3306">
    </td>
  </tr>

  <tr>
    <td>
      Host de la base de datos
    </td>
    <td>
      <input type='text' name='HOST' id='HOST' value="localhost">
    </td>
  </tr>
  <tr>
    <td>
      Nombre de la Base de datos
    </td>
    <td>                                                     
      <input type='text' name='BASEDATOS' id='BASEDATOS'>      
    </td>
  </tr>
  <tr>
    <td>
      Instancia de la base de Datos (solo Oracle)
    </td>
    <td>
      <input type='text' name='DB' id='DB' disabled="disabled">
    </td>
  </tr>  
  <tr>
    <td>
      Tablespace de la base de Datos (solo Oracle)
    </td>
    <td>
      <input type='text' name='TABLESPACE' id='TABLESPACE' disabled="disabled">
    </td>
  </tr>  
  <tr>
    <td>
      Usuario de la base de datos
    </td>
    <td>
      <input type='text' name='USER' id='USER'>
    </td>
  </tr>
  <tr>
    <td>
      Contrase&ntilde;a de la base de datos
    </td>
    <td>
      <input type='password' name='PASS'>
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <input type="submit" value="INSTALAR">
    </td>
  </tr>
</table>
</form>
<script type="text/javascript">
function envio_formulario(formulario){
  $('#DB').removeAttr('disabled'); 
  $('#TABLESPACE').removeAttr('disabled');
  return (true);
}
$('#MOTOR').change(function () {
          var str = "";
          str=$("option:selected",this).val();
          if(str=='Oracle'){
            $('#PORT').val('1521');
            $('#DB').removeAttr('disabled'); 
            $('#TABLESPACE').removeAttr('disabled');
          }
          else {
            $('#PORT').val('3306');
            $('#DB').attr('disabled','disabled');
            $('#TABLESPACE').attr('disabled','disabled');
          }
        });
$('#BASEDATOS').blur(function() {
  var str=$('#BASEDATOS').val();
  $('#DB').val(str); 
  $('#TABLESPACE').val(str);  
});        
</script>
</body>
</html>

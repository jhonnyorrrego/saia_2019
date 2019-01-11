<?php 
include_once("header.php");
include_once("db.php");
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<script> 
 $().ready(function() {
    $("#link_todos").click(function(){
      $("#listado").attr("src","ingresoslist.php"); 
    });
    $("#link_adicionar").click(function(){
      $("#listado").attr("src","ingreso_elementos.php"); 
    }); 
	function formatItem(row) {
		return row[0]+"("+row[1]+")";
	}
	function formatResult(row) {
		return row[1].replace(/(<.+?>)/gi, '');
	}
	$("#ejecutor").autocomplete('formatos/item_elemento_ingreso/buscar_seriales.php?ejecutor=1', {
		width: 500,
		max:20,
    scroll: true,
		scrollHeight: 150,
		matchContains: true,
    minChars:2,
    formatItem: formatItem,
    formatResult: function(row) {
		return row[0];
		}
	});
	$("#ejecutor").result(function(event, data, formatted) {
		if (data){
      $("#listado").attr("src","ingresoslist.php?ejecutor="+data[2]); 
    }
	});
	$("#elemento").autocomplete('formatos/item_elemento_ingreso/buscar_seriales.php', {
		width: 500,
		max:20,
    scroll: true,
		scrollHeight: 150,
		matchContains: true,
    minChars:2,
    formatItem: formatItem,
    formatResult: function(row) {
		return row[0];
		}
	});
	$("#elemento").result(function(event, data, formatted) {
		if (data){
      $("#listado").attr("src","ingresoslist.php?elemento="+data[0]); 
    }
	});
 });
 </script>
 <?php
 $ok=FALSE;
 $perm=new PERMISO();
 $ok=$perm->acceso_modulo_perfil("asignar_salida_elementos");
 ?>  
</script>
<br><br><b>LISTADO DE INGRESOS/SALIDAS PENDIENTES</b><br><br>
<table width="100%" align="center" border="1" style="border-collapse:collapse">
 <tr align="center">
  <?php if($ok) { ?><td><a id="link_adicionar" href="#">Adicionar Ingreso/Salida</a></td><?php } ?>
  <td><a id="link_todos" href="#">Pendientes por Ingreso/Salida</a></td>
  <td><b>Responsable del Ingreso/Salida:</b> <input type="text" id="ejecutor"></td>
  <td><b>Elemento(serie/codigo):</b> <input type="text" id="elemento"></td>
 </tr> 
 <tr>
  <td colspan="4">
  <iframe id="listado" src="ingresoslist.php" width="100%" height="350px" frameborder="0"></iframe>
  </td>
 </tr>
</table>
<?php 
include_once("footer.php");
?>
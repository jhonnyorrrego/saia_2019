<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo librerias_jquery("1.7");

//-------------------------formato para adicion------------------------
if(isset($_REQUEST["adicionar"]) )  {
   include_once("librerias/header_formato.php");
   include_once("../header.php");
   include_once("librerias/funciones.php");
    ?>
<script type="text/javascript">
	jQuery.noConflict();
	(function($) {
		$(function() {
			$("#guardar").click(function() {
				if ($('#etiqueta').val() != '') {
					$.ajax({
						type : 'POST',
						url : 'librerias/validar_unico.php',
						data : 'nombre=etiqueta&valor=' + $('#etiqueta').val() + '&tabla=encabezado_formato',
						success : function(datos, exito) {
							if (datos == 0) {
								alert('La etiqueta se encuentra repetida');
								$('#etiqueta').val("");
							} else
								form1.submit();
						}
					});
				} else {
					alert('Debe digitar un valor en el campo etiqueta');
				}
			})
		});
	})(jQuery); 
</script>

    <form name="form1" action='encabezadoadd.php' method='post'>
    <table border='0' width='100%' align='center'>
    <tr>
    <td class='encabezado'>ETIQUETA*
    </td>
    <td>
    <input type='text' name='etiqueta' id='etiqueta' value=''>
    </td>
    </tr><tr>
    <td class='encabezado'>CONTENIDO
    </td>
    <td>
    <textarea name='contenido' class="tiny_avanzado"></textarea>
    <input type='hidden' name='guardar' value='1'>
    </td>
    </tr><tr>
    <td colspan='2' align='center'>
    <input type='button' value='Guardar' id='guardar' name='guardar' >
    </td>
    </tr>
    </table>
    </form>
    <?php
  }
//--------------------------formato para edicion-------------------------------  
if(isset($_REQUEST["editar"])&& $_REQUEST["id"]){
   include_once("librerias/header_formato.php");
   include_once("../header.php");
  $contenido=busca_filtro_tabla("contenido,etiqueta","encabezado_formato","idencabezado_formato=".$_REQUEST["id"],"",$conn);
  ?> 
    <form name="form1" action='encabezadoadd.php' method='post'>
    <table border='0' width='100%' align='center'>
    <tr>
    <td class='encabezado'>ETIQUETA*
    </td>
    <td>
    <input type='text' readonly=true name='etiqueta' id='etiqueta' value='<?php echo $contenido[0]["etiqueta"]; ?>'>
    </td>
    </tr><tr>
    <td class='encabezado'>CONTENIDO
    </td>
    <td>
    <textarea name='contenido' class="tiny_avanzado"><?php echo stripslashes($contenido[0]["contenido"]); ?></textarea>
    <input type='hidden' name='actualizar' value='1'>
    <input type='hidden' name='id' value='<?php echo $_REQUEST["id"]; ?>'>
    </td>
    </tr><tr>
    <td colspan='2' align='center'>
    <input type='submit' value='Actualizar' >
    </td>
    </tr>
    </table>
    </form>
    <?php
  }
//-------------hacer la insercion del encabezado nuevo en la bd---------------------------      
 if(isset($_REQUEST["guardar"]))
  {
 	include_once("librerias/funciones.php");
   $sql="insert into encabezado_formato(etiqueta,contenido) values('".$_REQUEST["etiqueta"]."','".addslashes(stripslashes($_REQUEST["contenido"]))."')";
    //echo $sql;
    guardar_traza($sql);
    phpmkr_query($sql,$conn);
    $id=phpmkr_insert_id();
    redirecciona("encabezadoadd.php?listar=1");     
  }   
//-------------hacer la actualizacion del encabezado en la bd---------------------------
if(isset($_REQUEST["actualizar"]))
  {
	include_once("librerias/funciones.php");
   $sql="update encabezado_formato set contenido='".addslashes(stripslashes($_REQUEST["contenido"]))."' where idencabezado_formato=".$_REQUEST["id"];
   guardar_traza($sql);
   phpmkr_query($sql,$conn);
   redirecciona("encabezadoadd.php?listar=1");     
  }  
//-------------listar todos los encabezados con sus opciones-----------------------------  
if(isset($_REQUEST["listar"]))
  {
include_once("librerias/header_formato.php");
include_once("../header.php");
   ?>
<script type="text/javascript">
	$(document).ready(function() {
		$("a").click(function() {
			if ($(this).attr("tipo") == "editar")
				window.location = "encabezadoadd.php?editar=1&id=" + $(this).attr("registro");
			else if ($(this).attr("tipo") == "seleccionar") {
				campo = window.opener.document.getElementById("casilla").value;
				window.opener.document.getElementById(campo).value = $(this).attr("registro");
				window.opener.document.getElementById(campo + "_mostrar").innerHTML = $(this).attr("etiqueta");
				window.close();
			} else {
				enlace = $(this).attr("tipo");
				if (enlace == "ver")
					consulta = "select contenido from encabezado_formato where idencabezado_formato=" + $(this).attr("registro");
				if (enlace == "eliminar")
					consulta = "delete from encabezado_formato where idencabezado_formato=" + $(this).attr("registro");

				$.ajax({
					type : 'POST',
					url : 'encabezadoadd.php',
					data : 'consultasql=' + consulta,
					success : function(datos, exito) {
						$("#mostrar_contenido").html(datos);
						if (enlace == "eliminar")
							window.location = "encabezadoadd.php?listar=1";
					}
				})

			}
		})
	})
</script>
<style>
a {color:blue;
   text-decoration:underline;
   cursor:pointer;
  }
</style>
<?php
    $lista=busca_filtro_tabla('','encabezado_formato','','etiqueta',$conn);
    echo "<a href='encabezadoadd.php?adicionar=1'>Adicionar</a><br /> <br />";
    if($lista["numcampos"])
    	{echo "<form name=form1>
		<table border=1 cellpadding=5 style='border-collapse:collapse' align='center'>
		<tr class=encabezado_list><td>ETIQUETA</td><td colspan=4>OPCIONES</td></tr>";
	  for($i=0;$i<$lista['numcampos'];$i++)
	  	{echo "<tr><td>".$lista[$i]["etiqueta"]."<input type=hidden name=codigo$i value='".$lista[$i]["contenido"]."'></td>
			<td align=center><a tipo='ver' registro='".$lista[$i]["idencabezado_formato"]."'>Ver</a></td>
			<td align=center><a tipo='editar' registro='".$lista[$i]["idencabezado_formato"]."'>Editar</a></td>
			<td align=center ><a tipo='eliminar' registro='".$lista[$i]["idencabezado_formato"]."'>Eliminar</a></td>
      <td align=center ><a tipo='seleccionar' etiqueta='".$lista[$i]["etiqueta"]."' registro='".$lista[$i]["idencabezado_formato"]."'>Seleccionar</a></td>
      </tr>";
		}
	  echo "<tr><td colspan=5>
          <div id='mostrar_contenido' name='mostrar_contenido'>
          </div>
		    </td></tr></table></form>";
	}
    else
    	{echo "No se encontraron registros.";
	}
	
  } 

  //--------------ejecutar el sql enviado y escribir el resultado en pantalla---------------    
  if(isset($_REQUEST["consultasql"]))
    {include_once("../db.php");
  	include_once("librerias/funciones.php");
  guardar_traza($_REQUEST["consultasql"]);
     $rs=phpmkr_query($_REQUEST["consultasql"],$conn);
     $resultado=phpmkr_fetch_row($rs);
     echo stripslashes($resultado[0]);
    }  
?>

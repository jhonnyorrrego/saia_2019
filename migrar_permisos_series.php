<script>
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
		{ // en caso que sea una versión antigua
		 try
			{pagina_requerida = new ActiveXObject("Microsoft.XMLHTTP");
			}
		 catch (e){}
		}
 	}
 else
	return false
 pagina_requerida.onreadystatechange=function(){ // función de respuesta
   	if(pagina_requerida.readyState==4)
     {
  		if(pagina_requerida.status==200)
          {
    			 cargarpagina(pagina_requerida, id_contenedor);
    		  }
       else if(pagina_requerida.status==404)
          {
  			   document.write("La página no existe");
  		    }
  	  }
    else document.write("<img src='imagenes/cargando.gif'>");
   }

 pagina_requerida.open('POST', url, false); // asignamos los métodos open y send
 pagina_requerida.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 pagina_requerida.send(parametros);

}
/*
<Clase>
<Nombre>cargarpagina
<Parametros>pagina_requerida-objeto XMLHttpRequest ;id_contenedor-id del componente donde se pondrán los datos
<Responsabilidades> poner la información requerida en su sitio en la pagina xhtml
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
</script>
<?php
include_once("db.php");
$series=busca_filtro_tabla("serie_idserie,entidad_identidad,llave_entidad","entidad_serie","estado=1","",$conn);

echo "<script>";
for($i=0;$i<$series["numcampos"];$i++)
echo "llamado('asignarserie.php','llamado','segunda=1&reservados=".$series[$i]["serie_idserie"]."&entidad=".$series[$i]["llave_entidad"]."&tipo_entidad=".$series[$i]["entidad_identidad"]."&origen=dependencia');";

echo "</script>";
?>
<div name=llamado id=llamado>
</div>
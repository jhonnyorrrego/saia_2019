<?php include_once("db.php"); ?>
<script type="text/javascript" src="js/title2note.js"></script>
<style type="text/css">
    .phpmaker {
        font-family: Verdana;
        font-size: 11px;
    }

    .encabezado {
        background-color: #073A78;
        color: white;
        padding: 10px;
        text-align: left;
    }
</style>
<style type="text/css" media="screen">
    @import "css/title2note1.css";
</style>
<script type="text/javascript">
    <!-- function pagina_mostrar(doc,pag) {    parent.centroimg.location ="comentario_mostrar.php?key="+doc+"&pagina=pagina&num_pag="+pag;   } function pagina(doc,pag) {    parent.centroimg.location ="comentario_mostrar.php?key="+doc+"&pagina=pagina&num_pag="+pag;      } function imprimir(enlace) {   document.getElementById("tool").style.display="none";   //window.parent.centroimg.focus();      //open("menu_comentario.php");   //window.print();    }//funcion de ajax para actualizar la posicion del comentario en la imagen.     function llamado(url, id_contenedor,parametros,doc,pag)  {   var pagina_requerida = false   if (window.XMLHttpRequest)   	{// Si es Mozilla, Safari etc  	 pagina_requerida = new XMLHttpRequest();  	}    else if (window.ActiveXObject)  	{ // pero si es IE  	 try   		{pagina_requerida = new ActiveXObject("Msxml2.XMLHTTP");  		}   	 catch (e)  		{ // en caso que sea una versi�n antigua  		 try  			{pagina_requerida = new ActiveXObject("Microsoft.XMLHTTP");  			}  		 catch (e){}  		}   	}   else  	return false   pagina_requerida.onreadystatechange=function(){ // funci�n de respuesta   if(pagina_requerida.readyState==4)   { 	  	if(pagina_requerida.status==200)        {  			 cargarpagina(pagina_requerida, id_contenedor,doc,pag);  		  }     else if(pagina_requerida.status==404)        {  		   document.write("La p�gina no existe");  	    }    }     }    pagina_requerida.open('POST', url, true); // asignamos los m�todos open y send   pagina_requerida.setRequestHeader("Content-Type","application/x-www-form-urlencoded");   pagina_requerida.send(parametros);  }function cargarpagina(pagina_requerida, id_contenedor,doc,pag)  {   if (pagina_requerida.readyState == 4 && (pagina_requerida.status==200 || window.location.href.indexOf("http")==-1))            document.getElementById(id_contenedor).innerHTML=pagina_requerida.responseText;             }   --> 
</script><?php 
$doc = $_GET["key"];
$detalle_doc = busca_filtro_tabla("numero,serie,fecha,descripcion", "documento", "iddocumento=" . $doc, "", $conn); ?><div id="tool" style="display:block"><span class="phpmaker" margin-top="0">DOCUMENTO:&nbsp; <?php echo $detalle_doc[0]["numero"] . " - " . str_replace(chr(10), "<br>", $detalle_doc[0]["descripcion"]); ?></span>
    <HR>
    <table width="50%" border="1" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center"> <a href="javascript:void(0)" ; onclick="imprimir(<?php echo $doc; ?>)" target="centroimg"><img src="enlaces/imprimir.gif" border="0" ALT="Imprimir documento"></a> </td>
            <td align="center"> <a href="comentario_mostrar.php?key=<?php echo $doc . "&rotar=izq"; ?>" target="centroimg"><img src="botones/comentarios/rotar_derecha.gif" alt="Girar a la derecha" border="0"></a>&nbsp </td>
            <td align="center"> <a href="comentario_mostrar.php?key=<?php echo $doc . "&rotar=derecha"; ?>" target="centroimg"><img src="botones/comentarios/rotar_izquierda.gif" alt="Girar a la izquierda" border="0"></a>&nbsp </td>
            <td align="center" valign="middle"> <a href="comentario_mostrar.php?key=<?php echo $doc . "&pagina=inicio"; ?>" target="centroimg"><img src="imagenes/principio.gif" alt="Primera P&aacute;gina" border="0"></a> <a href="comentario_mostrar.php?key=<?php echo $doc . "&pagina=ant"; ?>" target="centroimg"><img src="imagenes/atras.gif" alt="P&aacute;gina anterior" border="0"></a>&nbsp; 
            <?php $pag = busca_filtro_tabla("consecutivo", "pagina", "id_documento=" . $doc, "pagina", $conn);
            $paginas = 0;
            if ($pag["numcampos"])     $paginas = $pag["numcampos"];
            $select_pag = "<select id=\"idpagina\" onchange=\"pagina(" . $doc . ",idpagina.value);\">";
            for ($i = 0; $i < $paginas; $i++) {
            $select_pag .= ("<option value=\"" . $pag[$i]["consecutivo"] . "\">" . ($i + 1) . "</option>");
            }
            echo $select_pag . "</select>";        ?> <a href="comentario_mostrar.php?key=<?php echo $doc . "&pagina=sig"; ?>" target="centroimg"><img src="imagenes/adelante.gif" alt="Siguiente P&aacute;gina" border="0"></a> <a href="comentario_mostrar.php?key=<?php echo $doc . "&pagina=fin"; ?>" target="centroimg"><img src="imagenes/final.gif" alt="&Uacute;ltima P&aacute;gina" border="0"></a>&nbsp; </td>
            <td align="center"> <?php agrega_boton("images", "images/eliminar_nota.gif", "paginadelete.php?doc=" . $doc, "centroimg", "Eliminar<br>Pagina", "", "eliminar_pagina");     ?>
        </tr>
    </table>
</div> <input type="button" name="prueba" onclick="imprimir('');"> 
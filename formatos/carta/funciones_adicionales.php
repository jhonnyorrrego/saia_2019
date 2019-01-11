<?php
include_once("../../db.php");
function elegir_destinos()
  {global $conn;
   include_once("../../header.php");
   $ciudad=busca_filtro_tabla("valor","configuracion","nombre='ciudad'","",$conn);
   if($ciudad["numcampos"])
      {$nombre_ciudad=busca_filtro_tabla("nombre","municipio","idmunicipio=".$ciudad[0]["valor"],"",$conn);
       $ciudad_valor=$ciudad[0][0];
       $ciudad_nombre=$nombre_ciudad[0][0];
      }
   else
      {alerta("La ciudad y departamento por defecto no se encuentran configurados");
       $ciudad_valor="658";
       $ciudad_nombre="Pereira";
      }
   $idejecutor="";
   $nombre="";
   $cargo="";
   $direccion="";
   $empresa="";
   $titulo="";
   
   $boton="Adicionar";
   if(isset($_REQUEST["idejecutor"]))
      {$datos=busca_filtro_tabla("",DB.".ejecutor,".DB.".datos_ejecutor","ejecutor_idejecutor=idejecutor and iddatos_ejecutor=".$_REQUEST["idejecutor"],"",$conn);
       $nombre=$datos[0]["nombre"].'" readonly="true';
       $cargo=$datos[0]["cargo"];
       $direccion=$datos[0]["direccion"];
       $titulo=$datos[0]["titulo"];
       $telefono=$datos[0]["telefono"];
       $email=$datos[0]["email"];
       $idejecutor=$datos[0]["iddatos_ejecutor"];
       $ciudad=busca_filtro_tabla("nombre","municipio","idmunicipio=".$datos[0]["ciudad"],"",$conn);
       $ciudad_nombre=$ciudad[0]["nombre"];
       $ciudad_valor=$datos[0]["ciudad"];
       $empresa=$datos[0]["empresa"];
       $boton="Guardar Cambios";
      }
   echo '<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
       <script>document.getElementById("header").style.display="none";
       </script>
       </script> <form name=form1 action="funciones_adicionales.php" method="post">
       <body bgcolor="#F5F5F5">
       <table width=100% align=center><tr> 
      <td class="phpmkr" bgcolor="#F5F5F5">NOMBRE:</td>
      <td bgcolor="#F5F5F5">
      <input type="hidden" name="nombre" id="nombre" value="'.$idejecutor.'" >
      <div id="lista2" onmouseout="v=1;" onmouseover="v=0;" >
        <input type="text" ';
  if(!isset($_REQUEST["editar"]))
      echo 'onblur="llenar_formulario();this.form.cargo.focus();"';
      
  echo ' size=53 name="mostrar" id="auto2" value="'.$nombre.'"';
  if(!isset($_REQUEST["editar"]))
  echo 'autocomplete=off onkeyup="if(Teclados(event,2) == 1){ document.getElementById('."'nombre').value='';".'
         autocompletar(2,auto2.value, 3); document.getElementById('."'comple2'".').style.display='."'block'".';}" 
         onkeydown = "ParaelTab(event,2)" onfocus="document.getElementById('."'comple2'".').style.display='."'block'".';"';
  echo '></div>
        <div id="comple2" style="position:absolute" onmouseout="document.getElementById('."'comple2'".').style.display='."'none'".';"></div>
      </td>
    </tr>
    <tr> 
      <td class="phpmkr" bgcolor="#F5F5F5">CARGO:</td>
      <td id="td_cargo" bgcolor="#F5F5F5"><input name="cargo" type="text" id="obligatorio" size="50" value="'.$cargo.'"></td>
    </tr>
        <tr> 
      <td class="phpmkr" bgcolor="#F5F5F5">EMPRESA:</td>
      <td id="td_empresa" bgcolor="#F5F5F5"><input name="empresa" type="text" id="obligatorio" size="50" value="'.$empresa.'"></td>
    </tr>

    <tr> 
      <td class="phpmkr" bgcolor="#F5F5F5">DIRECCI&Oacute;N:</td>
      <td id="td_direccion" bgcolor="#F5F5F5"><input name="direccion" type="text" id="obligatorio" size="50" value="'.$direccion.'"></td>
    </tr>
    <tr> 
      <td class="phpmkr" bgcolor="#F5F5F5">TEL&Eacute;FONO:</td>
      <td id="td_telefono" bgcolor="#F5F5F5"><input name="telefono" type="text" id="obligatorio" size="50" value="'.$telefono.'"></td>
    </tr>
    <tr> 
      <td class="phpmkr" bgcolor="#F5F5F5">EMAIL:</td>
      <td id="td_email" bgcolor="#F5F5F5">
      <input name="email" type="text" size="50" value="'.$email.'"></td>
    </tr>
        <tr> 
      <td class="phpmkr" bgcolor="#F5F5F5" width="21%">T&Iacute;TULO:</td>
      <td width="79%" bgcolor="#F5F5F5" id="td_titulo">';
     $titulos=array("Se&ntilde;or","Se&ntilde;ora","Doctor","Doctora","Ingeniera","Ingeniero");
           echo '<select name="titulo" id="obligatorio">';
           $encontrado=0;
           foreach($titulos as $fila)
              {if($fila==$titulo)
                  {echo "<option value='".$fila."' selected>".$fila."</option>";
                   $encontrado=1;
                  }
               else
                  echo "<option value='".$fila."'>".$fila."</option>";
              }
           if($encontrado==0 && $titulo<>"")
              echo "<option value='".$titulo."' selected>".$titulo."</option>";
           elseif($encontrado==0)
              echo "<option value='Señor' selected>Se&ntilde;or</option>";     
  
           echo '</select>&nbsp;&nbsp;
            <label style="text-decoration:underline;cursor: pointer" 
            onclick="document.getElementById('."'td_titulo'".').innerHTML='."'<td><input type=text name=titulo id=obligatorio></td>'".';">OTRO
            </label>';
 echo '</td>  
    </tr>
      <tr> 
      <td class="phpmkr" width="21%" height="23" bgcolor="#F5F5F5">CIUDAD RESIDENCIA</td>
      <td bgcolor="#F5F5F5">
      <table border=0>
      <tr>
      <td>
      DEPARTAMENTO:
      </td>
      <td>
      <select name="departamento2" id="departamento2" onchange="llamado('."'listar_ciudades.php','div_ciudad2','nombre=ciudad_destino&dep='".'+form1.departamento2.value);">
        <option selected>Seleccionar...</option>';

        $deptos=busca_filtro_tabla("iddepartamento,nombre",DB.".departamento","","nombre",$conn);
        if($deptos["numcampos"]>0)
          {for($i=0; $i<$deptos["numcampos"];$i++)
              echo "<option value='".$deptos[$i]["iddepartamento"]."'>".$deptos[$i]["nombre"]."</option>";
          }
      echo'</select>
           </td>
      <td>
      CIUDAD:
      </td>
      <td>
      <div id="div_ciudad2">
      <select name="ciudad_destino" id="obligatorio">
         <option value="'.$ciudad_valor.'" selected>'.$ciudad_nombre.'</option>
      </select>
      </div>
      </td>
      </tr>
      </table>
      </td >
      </tr></table>
      <input type="hidden" name="funcion" value="validar_destino">
      <input type="submit" value="'.$boton.'">';
   if(isset($_REQUEST["copia"]))
      echo '<input type="hidden" name="copia" value="1">';
   if(isset($_REQUEST["adicionar"]))
      {echo '<input type="hidden" name="adicionar" value="1">';
       echo "<input type='hidden' name='tabla' value='".$_REQUEST["tabla"]."'>
             <input type='hidden' name='iddoc' value='".$_REQUEST["iddoc"]."'>";
      }
   if(isset($_REQUEST["editar"]))
      {echo '<input type="hidden" name="editar" value="1">';
       echo "<input type='hidden' name='tabla' value='".$_REQUEST["tabla"]."'>
             <input type='hidden' name='iddoc' value='".$_REQUEST["iddoc"]."'>";
      }
   if(isset($_REQUEST["idejecutor"]))
      {echo "<input type='hidden' name='idejecutor' value='".$idejecutor."'>
      <input type='hidden' name='tabla' value='".$_REQUEST["tabla"]."'>
      <input type='hidden' name='iddoc' value='".$_REQUEST["iddoc"]."'>";
      }
   echo '</form>';

  }  
function validar_destino()
  {global $conn;
   echo '<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>';
  $llave=0;
  if(isset($_REQUEST["copia"]))
    {$campo="copia";
     $funcion="editar_copias";
    }
  elseif(isset($_REQUEST["iddoc"]))
    {$campo="destinos";
     $funcion="editar_destinos";
    }
  else
    {$campo="destinos";
     $funcion="elegir_destinos";
    }  
  if(isset($_REQUEST["eliminar"]))
    {   
     $destinos=busca_filtro_tabla($campo,$_REQUEST["tabla"],"documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
      $destino=explode(",",$destinos[0][$campo]);
      $nuevo_destino=array();
      foreach($destino as $fila)
        {if($fila<>$_REQUEST["idejecutor"])
             $nuevo_destino[]=$fila;
        }
      $nuevo_destino=implode(",",$nuevo_destino);  
      if($nuevo_destino<>"" || isset($_REQUEST["copia"]))
        {phpmkr_query("UPDATE ".DB.".".$_REQUEST["tabla"]." SET $campo='$nuevo_destino' WHERE documento_iddocumento=".$_REQUEST["iddoc"],$conn);
         echo "<script>validar_destino('".$_REQUEST["idejecutor"]."','','eliminar');</script>";
        }
      else
        {alerta("Debe quedar por lo menos un destino.");   
        } 
     redirecciona("funciones_adicionales.php?funcion=$funcion&iddoc=".$_REQUEST["iddoc"]."&tabla=".$_REQUEST["tabla"]);   
    }
  else
    {if(isset($_REQUEST["adicionar"]))
          $tipo="adicionar";   
      elseif(isset($_REQUEST["copia"]))
          $tipo="copia";   
      else 
          $tipo="";
     $x_cargoejecutor=(($_REQUEST["cargo"]));
     $x_direccionejecutor=(($_REQUEST["direccion"]));
     $x_emailejecutor=(($_REQUEST["email"]));
     $x_empresaejecutor=(($_REQUEST["empresa"]));
     $x_ciudadejecutor=$_REQUEST["ciudad_destino"];
     $x_telefonoejecutor=(($_REQUEST["telefono"]));
     $x_tituloejecutor=(($_REQUEST["titulo"]));
     $nombre=(($_REQUEST["mostrar"]));
     //si estoy adicionado
     if(!isset($_REQUEST["idejecutor"]))
        $value=$_REQUEST["nombre"];
     else   //si estoy desde la opcion editar el formato editar de la carta
        $value=$_REQUEST["idejecutor"];
        
     $ejecutor = busca_filtro_tabla("idejecutor","ejecutor,datos_ejecutor","ejecutor_idejecutor=idejecutor and iddatos_ejecutor='$value' and nombre like '".$nombre."'","",$conn);
    
      if($ejecutor["numcampos"]>0)
      {
      $repetido = busca_filtro_tabla("iddatos_ejecutor","ejecutor,datos_ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=$value and cargo='".$x_cargoejecutor."' and direccion='".$x_direccionejecutor."' and email='".$x_emailejecutor."' and ciudad='".$x_ciudadejecutor."' and titulo='".$x_tituloejecutor."' and empresa='".$x_empresaejecutor."'  and telefono='".$x_telefonoejecutor."'","",$conn);

      if($repetido["numcampos"]>0)
         $llave=$value;
      else   
       {$datos_viejos = busca_filtro_tabla("","ejecutor,datos_ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor='$value'","",$conn);

        phpmkr_query("INSERT INTO ".DB.".datos_ejecutor(ejecutor_idejecutor,telefono,fecha,cargo,empresa,direccion,email,titulo,ciudad) VALUES(".$ejecutor[0]["idejecutor"].",'".$x_telefonoejecutor."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'".$x_cargoejecutor."','$x_empresaejecutor','$x_direccionejecutor','$x_emailejecutor','$x_tituloejecutor','$x_ciudadejecutor')",$conn) or error("NO SE INSERTO EJECUTOR");         
    
       $llave=phpmkr_insert_id();
       }
      }
      elseif($_REQUEST["mostrar"]<>"")
      {   
        phpmkr_query("INSERT INTO ".DB.".ejecutor(nombre,fecha_ingreso) VALUES('".$nombre."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').")",$conn) or error("NO SE INSERTO EJECUTOR");
        $idejecutor=phpmkr_insert_id();
        phpmkr_query("INSERT INTO ".DB.".datos_ejecutor(ejecutor_idejecutor,fecha,cargo,direccion,empresa,titulo,email,ciudad,telefono) VALUES(".$idejecutor.",".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'".$x_cargoejecutor."','$x_direccionejecutor','$x_empresaejecutor','$x_tituloejecutor','$x_emailejecutor','$x_ciudadejecutor','$x_telefonoejecutor')",$conn) or error("NO SE INSERTO EJECUTOR"); 
       $llave=phpmkr_insert_id();  
      } 
    } 
    
  if(isset($_REQUEST["adicionar"]))
    {$destino=busca_filtro_tabla($campo,$_REQUEST["tabla"],"documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
     if($destino[0][$campo]<>"")
        $lista=explode(",",$destino[0][$campo]);
     $lista[]=$llave;
     $lista=array_unique($lista);
     $nuevo=implode(",",$lista);
     $update="update ".DB.".".$_REQUEST["tabla"]." set $campo='$nuevo' where documento_iddocumento=".$_REQUEST["iddoc"];
     phpmkr_query($update,$conn);
     $tipo="adicionar";
    }
   if(isset($_REQUEST["editar"]))
    {$tipo="editar";
      $destinos=busca_filtro_tabla($campo,$_REQUEST["tabla"],"documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
      $destino=explode(",",$destinos[0][$campo]);
      $nuevo_destino=array();
      foreach($destino as $fila)
        {if($fila<>$_REQUEST["idejecutor"])
             $nuevo_destino[]=$fila;
         else
             $nuevo_destino[]=$llave;   
        }
      $nuevo_destino=implode(",",$nuevo_destino);  
      if($nuevo_destino<>"" || isset($_REQUEST["copia"]))
        {phpmkr_query("UPDATE ".DB.".".$_REQUEST["tabla"]." SET $campo='$nuevo_destino' WHERE documento_iddocumento=".$_REQUEST["iddoc"],$conn);
        }
    } 
   echo "<script>validar_destino('".$llave."','".($_REQUEST["mostrar"])."','$tipo');</script>";
   if($tipo=="adicionar" || $tipo=="editar")
      redirecciona("funciones_adicionales.php?funcion=$funcion&iddoc=".$_REQUEST["iddoc"]."&tabla=".$_REQUEST["tabla"]);
   else if($tipo=="copia")
      redirecciona("funciones_adicionales.php?funcion=elegir_destinos&copia=1&iddoc=".$_REQUEST["iddoc"]."&tabla=".$_REQUEST["tabla"]);  
   else
      redirecciona("funciones_adicionales.php?funcion=$funcion&iddoc=".$_REQUEST["iddoc"]."&tabla=".$_REQUEST["tabla"]);
   }    
function editar_destinos()
{global $conn;
 include_once("../../header.php");
 $datos_carta=busca_filtro_tabla("",$_REQUEST["tabla"],"documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);

 echo'<script>document.getElementById("header").style.display="none";
       </script>
       <script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
       <body bgcolor="#F5F5F5">
      <form name="form1">
      <table border=1 width=100% bgcolor="#F5F5F5">
      <tr align=center>
      <td ><b>Nombre</b></td>
      <td><b>Eliminar</b></td>
      <td><b>Editar</b></td>
      </tr>';    
      $lista=explode(",",$datos_carta[0]["destinos"]);
      foreach($lista as $ejecutor)
        {$datos=busca_filtro_tabla("nombre,titulo,direccion,ciudad,cargo,empresa",DB.".datos_ejecutor,".DB.".ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=".$ejecutor,"",$conn);

         echo "<tr id='tr$ejecutor'><td>".ucwords($datos[0]["nombre"])."</td>
         <td align=center ><a href='funciones_adicionales.php?funcion=validar_destino&eliminar=1&iddoc=".$_REQUEST["iddoc"]."&tabla=".$_REQUEST["tabla"]."&idejecutor=$ejecutor'><img  src='../../imagenes/delete.gif' border=\"0\"></a></td>
         <td align=center><a href='funciones_adicionales.php?funcion=elegir_destinos&editar=1&idejecutor=$ejecutor&iddoc=".$_REQUEST["iddoc"]."&tabla=".$_REQUEST["tabla"]."'><img width='20' height='20' src='../../botones/configuracion/editar_ejecutor.png' border=\"0\"></a></td>
         </tr>";
        }
  echo '<tr><td></td></tr></table><a href="funciones_adicionales.php?funcion=elegir_destinos&adicionar=1&iddoc='.$_REQUEST["iddoc"]."&tabla=".$_REQUEST["tabla"].'"'.">Adicionar</a></form>";
} 
function editar_copias()
{global $conn;
 include_once("../../header.php");
 $datos_carta=busca_filtro_tabla("",$_REQUEST["tabla"],"documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
 echo'<script>document.getElementById("header").style.display="none";</script>
       <body bgcolor="#F5F5F5">
      <form name="form1">
      <table border=1 width=100% bgcolor="#F5F5F5">
      <tr align=center>
      <td ><b>Nombre</b></td>
      <td><b>Eliminar</b></td>
      <td><b>Editar</b></td>
      </tr>';    
      $lista=explode(",",$datos_carta[0]["copia"]);
    if($datos_carta[0]["copia"]<>"")
      {foreach($lista as $ejecutor)
        {$datos=busca_filtro_tabla("nombre","ejecutor,datos_ejecutor","ejecutor_idejecutor=idejecutor and iddatos_ejecutor=".$ejecutor,"",$conn);
         echo "<tr id='tr$ejecutor'><td>".ucwords($datos[0]["nombre"])."</td>
         <td align=center ><a href='funciones_adicionales.php?funcion=validar_destino&eliminar=1&copia=1&iddoc=".$_REQUEST["iddoc"]."&tabla=".$_REQUEST["tabla"]."&idejecutor=$ejecutor'><img  src='../../imagenes/delete.gif' border=\"0\"></a></td>
         <td align=center><a href='funciones_adicionales.php?funcion=elegir_destinos&editar=1&copia=1&idejecutor=$ejecutor&iddoc=".$_REQUEST["iddoc"]."&tabla=".$_REQUEST["tabla"]."'><img width='20' height='20' src='../../botones/configuracion/editar_ejecutor.png' border=\"0\"></a></td>
         </tr>";
        }
      }  
  echo '<tr><td></td></tr></table><a href="funciones_adicionales.php?funcion=elegir_destinos&adicionar=1&iddoc='.$_REQUEST["iddoc"]."&tabla=".$_REQUEST["tabla"]."&copia=1".'"'.">Adicionar</a></form>";
} 

if(isset($_REQUEST["funcion"]) && $_REQUEST["funcion"]<>"")  
    $_REQUEST["funcion"]();
?>
<script>

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
function ParaelTab(evento,numero)
{
	var teclaPresionada=(document.all) ? evento.keyCode : evento.which;
	if(teclaPresionada==9 || teclaPresionada==13)
	{
	 if(elementoSeleccionado!=0)
		  {
       clickLista(document.getElementById("d" + numero + "comp" + elementoSeleccionado), "auto" + numero, "comple" + numero, document.getElementById("d"+numero+"valor"+elementoSeleccionado).value);
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
      var nombrecargo = document.getElementsByName('cargo');
      nombrecargo[0].focus();
		}
	}
}

/*
<Clase>
<Nombre>clickLista
<Parametros>elemento-seleccionado; inputLista-input donde se pondrá el valor; divLista-div con las opciones
<Responsabilidades>Se ejecuta cuando se hace clic en algun elemento de la lista. Se coloca en el input el
	valor del elemento clickeado
<Notas>Para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function clickLista(elemento, inputLista, divLista,codigo)
{	v=1;
	valor=elemento.innerHTML;
	document.getElementById(inputLista).value=valor;
	document.getElementById(divLista).style.display="none"; 
	elemento.style.backgroundColor="#EAEAEA"; 
	elementoSeleccionado = 0;
	document.getElementById("nombre").value=codigo;
}
/*
<Clase>
<Nombre>eliminarespacio
<Parametros>elemento-componente el cual voy a validar
<Responsabilidades>valida que la propiedad value del componente no contenga varios espacios seguidos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
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
/*
<Clase>
<Nombre>llenar_formulario
<Parametros>
<Responsabilidades>autocompleta los campos direccion ciudad y cargo al llenar el campo nombre
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function llenar_formulario()
  {llamado("llenar_formulario.php","td_titulo","op=titulo&nombre="+document.getElementById("nombre").value);
   llamado("llenar_formulario.php","td_direccion","op=direccion&nombre="+document.getElementById("nombre").value);
   llamado("llenar_formulario.php","td_empresa","op=empresa&nombre="+document.getElementById("nombre").value);
   llamado("llenar_formulario.php","div_ciudad2","op=ciudad&nombre="+document.getElementById("nombre").value);
   llamado("llenar_formulario.php","td_cargo","op=cargo&nombre="+document.getElementById("nombre").value);
   llamado("llenar_formulario.php","td_telefono","op=telefono&nombre="+document.getElementById("nombre").value);
   llamado("llenar_formulario.php","td_email","op=email&nombre="+document.getElementById("nombre").value);
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
<Parametros>elemento-sobre el cual está el mouse;numero-del elemento sobre el cual se encuentra el mouse
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
</script>
<?php
include_once("../../footer.php");
?>

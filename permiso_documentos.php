<?php
/*
<Archivo>
<Nombre>permiso_documentos.php</Nombre> 
<Parametros>$_REQUEST["pantalla"]:tipo de buzon pendiente o proceso</Parametros>
<ruta>saia1.06/permiso_documentos.php</ruta>
<Responsabilidades>Muetra el select con los funcionarios a los cuale puede consultar sus respectivas bandejas de pendientes y procesos. Si el usuario de la session tiene el permiso del modulo permiso_busqueda_general puede ver los documentos de toda la empresa pero sino solo los que estn asignados en la tabla permiso_funcionario<Responsabilidades>
<Notas>Este archivo se llama del archivo encabezado_busqueda.php</Notas>
<Salida>Un select y boton Aceptar</Salida>
</Archivo>
*/
include_once("db.php");
?>
<script type="text/javascript" src="../js/dynamicoptionlist.js"></script>
<body onLoad="initDynamicOptionLists()">
<?php
if($_REQUEST["pantalla"]=='pendientes')
 $pantalla = "../pendienteslist.php";
else
  $pantalla = "../procesolist.php";
$acceso=false;
$permiso=new PERMISO();
$acceso=$permiso->permiso_usuario("permiso_busqueda_general","");
//$acceso=false; 

if($acceso)
{  //Para Funcionario administrador     
   echo '<br /><div style="position:absolute; top:80"><form name="jerarquia" method="POST" action="'.$pantalla.'" enctype="multipart/form-data">';
   $dep = busca_filtro_tabla("dependencia.*","dependencia,dependencia_cargo","iddependencia=dependencia_iddependencia and dependencia.estado=1","GROUP by iddependencia order by nombre",$conn);   
   echo "<table width='100%' style='flow:left'><tr><td>Dependencia:<select name='dependencia' id='dependencia'>";
   for($i=0; $i<$dep["numcampos"]; $i++)   
    echo "<option value='".$dep[$i]["iddependencia"]."'>".$dep[$i]["nombre"]."</option>";  
   echo "</select>&nbsp;&nbsp;"; 
   ?>
   <script>
     var c_hijos = new DynamicOptionList();
     c_hijos.addDependentFields('dependencia','permiso');
     </script>
     <?php echo "Funcionarios: "; echo genera_campo_listados(); ?>
      <select name="permiso" id="permiso" >                            
       <option value="">Seleccionar...</option>                            
       <script type="text/javascript"> c_hijos.printOptions("permiso");</script>                            
      </select>&nbsp;&nbsp;<input type="submit" name="Aceptar" value="Aceptar"></td></tr></table> </div>  
    <?php  
  }
 else
  {
   $id=usuario_actual("id");
    echo ("<div style='position:absolute; top:60px; left:200px;'>
          <form name='jerarquia' method='POST' action='$pantalla'>");          
          permisos_funcionario(usuario_actual("idfuncionario"));
          echo "</form></div>";
    }  
  echo "</form>"; 

/*
<Clase>
<Nombre>genera_campo_listados</Nombre> 
<Parametros></Parametros>
<Responsabilidades>se crea contenido de la lista de funcionarios por dependencia<Responsabilidades>
<Notas>Solo se utiliza cuando el funcionario tiene permisos como administrador que puede ver los documentos de toda la empresa, INCLUSO LOS DOCUMENTOS DE LOS FUNCIONARIOS QUE ESTAS INACTIVOS</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function genera_campo_listados()
{
global $conn;
$dep = busca_filtro_tabla("*","dependencia","estado=1","nombre",$conn);
  $texto="<script>";
  for($i=0;$i<$dep["numcampos"];$i++)
      {$hijo=busca_filtro_tabla("funcionario_codigo as codigo,nombres,apellidos","dependencia_cargo,funcionario","funcionario_idfuncionario=idfuncionario and dependencia_iddependencia=".$dep[$i]["iddependencia"],"nombres",$conn);
     
     if($hijo["numcampos"]>0)
       for($j=0;$j<$hijo["numcampos"];$j++)
          {
           $texto.=  'c_hijos.forValue("'.$dep[$i]["iddependencia"].'").addOptionsTextValue("'.codifica_encabezado(html_entity_decode($hijo[$j]["nombres"]." ".$hijo[$j]["apellidos"])).'","'.$hijo[$j]["codigo"].'");'; 
          }
      else
        $texto.='c_hijos.forValue("'.$dep[$i]["iddependencia"].'").addOptionsTextValue("No hay registros...","");';   
      }
  $texto.="</script>";
return($texto);
}
/*
<Clase>
<Nombre>permisos_funcionario</Nombre> 
<Parametros>$fun:codigo del funcionario</Parametros>
<Responsabilidades>creo contenido de la lista de funcionarios por dependencia<Responsabilidades>
<Notas>Solo se utiliza cuando el funcionario tiene permisos como administrador que puede ver los documentos de toda la empresa</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function permisos_funcionario($fun)
{ global $conn;
  $funs = busca_filtro_tabla("llave_compartida","permiso_funcionario","llave_propietaria=$fun and  ".fecha_db_obtener("vigencia_inicial","Y-m-d")." <= ".fecha_db_almacenar(date("Y-m-d"),'Y-m-d')." and ".fecha_db_obtener("vigencia_final","Y-m-d")." >=".fecha_db_almacenar(date("Y-m-d"),'Y-m-d'),"",$conn); 
  //print_r($funs);   
  $lista="";   
  if($funs["numcampos"]>0) 
  { for($i=0; $i<$funs["numcampos"]; $i++)
    {   
     if($lista=="")
      $lista = $funs[0]["llave_compartida"];
     else
      $lista .= ",".$funs[0]["llave_compartida"];
    }
    $datos = busca_filtro_tabla("distinct funcionario_codigo as cod,idfuncionario,nombres,apellidos,dependencia_iddependencia,nombre","funcionario,dependencia_cargo,dependencia","idfuncionario=funcionario_idfuncionario and  iddependencia=dependencia_iddependencia and funcionario_codigo in ($lista)","dependencia_iddependencia",$conn);
    
    $cont_dep=0;    
    $selectd='<br /><div style="position:absolute; top:0;z-index:5; width:800px"><script>
     var c_hijos = new DynamicOptionList();
     c_hijos.addDependentFields(\'dependencia\',\'permiso\');
     </script><select name="dependencia"><option value="">Seleccionar...</option>';
    $selectf='<script>'; 
    $dep = 0;

    for($i=0; $i<$datos["numcampos"]; $i++)
    { 
     if($dep!=$datos[$i]["dependencia_iddependencia"])     
       {$selectd .="<option value=".$datos[$i]["dependencia_iddependencia"].">".$datos[$i]["nombre"]."</option>";
         $cont_dep++;
        $dep = $datos[$i]["dependencia_iddependencia"]; 
       }   
       $selectf.=  'c_hijos.forValue("'.$datos[$i]["dependencia_iddependencia"].'").addOptionsTextValue("'.codifica_encabezado(html_entity_decode($datos[$i]["nombres"]." ".$datos[$i]["apellidos"])).'","'.$datos[$i]["cod"].'");'; ;    
    }  
   echo $selectd.'</select>'.$selectf.'</script><select name="permiso" id="permiso" >                            
       <option value="">Seleccionar...</option>                            
       <script type="text/javascript"> c_hijos.printOptions("permiso");</script>                            
      </select><input type="submit" value="Consultar" ></div><br /><br />';
  }         
 return true;
} 
?>

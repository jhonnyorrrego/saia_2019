<?php
include_once("../../db.php");
global $conn;
/*--------------------------------------------------------------------------------------
usado en el formato carta para el autocompletar.
busca el valor del campo $_POST["nombre"] en la tabla ejecutor, donde el nombre del 
ejecutor sea $_POST["nombre"], crea un cuadro de texto con el valor encontrado
--------------------------------------------------------------------------------------*/
$_POST["nombre"]=((trim($_POST["nombre"])));

if($_POST["op"]=="verificar")
  {$resultado=busca_filtro_tabla("idejecutor","ejecutor","lower(nombre)='".strtolower($_POST["nombre"])."'","",$conn);

    if($resultado["numcampos"]>0)
      {echo "<input name='nuevo' type='hidden' id='nuevo'value='0'>";
      }
    else
      {echo "<input name='nuevo' type='hidden' id='nuevo' value='1'>";
      } 
  } 
else
  {
   $resultado=busca_filtro_tabla("","datos_ejecutor","iddatos_ejecutor=".$_POST["nombre"],"iddatos_ejecutor desc",$conn);

   $ejecutor==busca_filtro_tabla("","ejecutor","idejecutor=".$resultado[0]['ejecutor_idejecutor'],"",$conn);
    if($resultado["numcampos"]>0 || $_POST["op"]=="titulo")
      {
       if($_POST["op"]=="ciudad")
          {if($resultado[0][$_POST["op"]]=="")
              {$ciudad=busca_filtro_tabla("valor","configuracion","nombre='ciudad'","",$conn);
               if($ciudad["numcampos"])
                  {$nombre_ciudad=busca_filtro_tabla("nombre","municipio","idmunicipio=".$ciudad[0]["valor"],"",$conn);
                   $valor[0]=$ciudad[0][0];
                   $valor[1]=$nombre_ciudad[0][0];
                  }
               else
                  {
                   $valor[0]="658";
                   $valor[1]="Pereira";
                  }
              }
           else
              {
               $valor[0]=$resultado[0][$_POST["op"]];   
               $ciudad=busca_filtro_tabla("nombre","municipio","idmunicipio=".$resultado[0][$_POST["op"]],"",$conn);
               $valor[1]=codifica_encabezado($ciudad[0]["nombre"]); 
              }
           echo '<select name="ciudad_destino" id="obligatorio">
                <option value="'.$valor[0].'" selected>'.$valor[1].'</option>
                </select>';
          } 
       elseif($_POST["op"]=="titulo")
          {$titulos=array("Se&ntilde;or","Se&ntilde;ora","Doctor","Doctora","Ingeniera","Ingeniero");
          
           echo '<select name="titulo" id="obligatorio">';

           $encontrado=0;
           foreach($titulos as $fila)
              {
               if($fila==$resultado[0]["titulo"])
                  {echo "<option value='".$fila."' selected>".$fila."</option>";
                   $encontrado=1;
                  }
               else
                  echo "<option value='".$fila."'>".$fila."</option>";
              }
           if($encontrado==0 && codifica_encabezado($resultado[0][$_POST["op"]])<>"")
              echo "<option value='".codifica_encabezado($resultado[0][$_POST["op"]])."' selected>".codifica_encabezado($resultado[0][$_POST["op"]])."</option>";
           elseif($encontrado==0)
              echo "<option value='Se&ntilde;or' selected>Se&ntilde;or</option>";     
  
           echo '</select>&nbsp;&nbsp;
            <label style="text-decoration:underline;cursor: pointer" 
            onclick="document.getElementById('."'td_titulo'".').innerHTML='."'<td><input type=text name=titulo id=obligatorio></td>'".';">OTRO
            </label>';
          }        
       else         
          echo "<input name='".$_POST["op"]."' type='text' id='".$_POST["op"]."' size='100' value='".codifica_encabezado($resultado[0][$_POST["op"]])."'>";
      }
    else
      {if($_POST["op"]=="ciudad")
          {$ciudad=busca_filtro_tabla("valor","configuracion","nombre='ciudad'","",$conn);
               if($ciudad["numcampos"])
                  {$nombre_ciudad=busca_filtro_tabla("nombre","municipio","idmunicipio=".$ciudad[0]["valor"],"",$conn);
                   $valor[0]=$ciudad[0][0];
                   $valor[1]=$nombre_ciudad[0][0];
                  }
               else
                  {
                   $valor[0]="658";
                   $valor[1]="Pereira";
                  }
           echo '<select name="ciudad_destino" id="obligatorio">
                <option value="'.$valor[0].'" selected>'.$valor[1].'</option>
                </select>';
          }
       else   
          echo "<input name='".$_POST["op"]."' type='text' id='".$_POST["op"]."' size='100' value=''>";
      }  
  }       
?>

<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");

function mostrar_destinos($idformato,$iddoc)
{global $conn; 
 $tabla=busca_filtro_tabla("nombre_tabla","formato","idformato=".$idformato,"",$conn);
 $resultado=busca_filtro_tabla("","".$tabla[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"",$conn);

  if(isset($_REQUEST["destino"]) && $_REQUEST["destino"]<>"" )
     {$ejecutor=busca_filtro_tabla("nombre,titulo,telefono,direccion,ciudad,cargo,empresa","datos_ejecutor,ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=".$_REQUEST["destino"],"",$conn);
    // print_r($ejecutor);
      $destinos=explode(",",$resultado[0]["destinos"]);
     } 
  elseif(strpos($resultado[0]["destinos"],",")>0)
    {$destinos=explode(",",$resultado[0]["destinos"]);
     $ejecutor=busca_filtro_tabla("nombre,titulo,telefono,direccion,ciudad,cargo,empresa","datos_ejecutor,ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=".$destinos[0],"",$conn);
    }
  else
    $ejecutor=busca_filtro_tabla("nombre,telefono,titulo,direccion,ciudad,cargo,empresa","datos_ejecutor,ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=".$resultado[0]["destinos"],"",$conn);

  $municipio=busca_filtro_tabla("nombre,departamento_iddepartamento","municipio","idmunicipio ='".strtolower($ejecutor[0]["ciudad"])."'","",$conn);
  $departamento[0]["nombre"]="";
  if($ejecutor[0]["ciudad"]!=883)
  { $departamento=busca_filtro_tabla("nombre,pais_idpais","departamento","iddepartamento=".$municipio[0]["departamento_iddepartamento"],"",$conn);  
    if($departamento[0]["paiso_idpais"]!=1)
     $pais = busca_filtro_tabla("nombre","pais","idpais=".$departamento[0]["pais_idpais"],"",$conn);
     if($departamento[0]["nombre"]==$municipio[0]["nombre"])
      $departamento[0]["nombre"]=$pais[0]['nombre'];
  } 

 if((!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"]==1) && isset($destinos))
     { ?>
     <div id="destinos">
     
     <?php
     echo 'Destinos:&nbsp;<select name="s_destinos" id="s_destinos" onchange="window.location='."'mostrar_carta.php?tipo=1&destino='+this.value+'&iddoc=".$iddoc."'".'">';
     $lista="'".implode("','",explode(",",$resultado[0]["destinos"]))."'";
     $destinos=busca_filtro_tabla("nombre,titulo,telefono,direccion,ciudad,cargo,empresa,iddatos_ejecutor","datos_ejecutor,ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor in(".$lista.")","nombre",$conn);
     echo "<option value=''>Seleccionar...</option>";
     for($i=0;$i<$destinos["numcampos"];$i++)
        echo "<option value=".$destinos[$i]["iddatos_ejecutor"].">".$destinos[$i]["nombre"]."</option>";
     ?>
     </select>
     </div><br />
     <?php
      }
  echo "<tr><td>
        ".$ejecutor[0]["titulo"]."<br />
        <b>".mayusculas($ejecutor[0]["nombre"])."</b><br />";
        if(ucwords($ejecutor[0]["cargo"])<>"")
            echo ($ejecutor[0]["cargo"])."<br />";
        if(ucwords($ejecutor[0]["empresa"])<>"")
            echo ($ejecutor[0]["empresa"])."<br />";
        if(ucwords($ejecutor[0]["direccion"])<>"")
            echo ($ejecutor[0]["direccion"])."<br />";
        if(ucwords($ejecutor[0]["telefono"])<>"")
            echo ($ejecutor[0]["telefono"])."<br />";                
        echo $municipio[0]["nombre"].", ".ucfirst(strtolower($departamento[0]["nombre"]))."</td>
        </tr>";    
}
function copias_carta($idformato,$idcampo,$iddoc=NULL)
{if($iddoc==NULL)
   {echo '<td bgcolor="#F5F5F5">
    <input type="hidden" name="copia" id="nombre_copias" id="nombre_copias" value="" >
    <b>DESTINOS ELEGIDOS:</b><br />
    <input type="text" id="destinos_copias" value="" size=150 readonly=true >
    <hr />
    <iframe name="frame_copias" id="frame_copias" src="funciones_adicionales.php?funcion=elegir_destinos&copia=1" width=100%  class=phpmkr border=0 frameborder="0" y framespacing="0">
    </iframe></td>';
   }
 else
   {echo '<td bgcolor="#F5F5F5"><iframe id="frame_copias" src="funciones_adicionales.php?funcion=editar_copias&iddoc='.$iddoc.'&tabla=ft_carta" width=100%  class=phpmkr border=0 frameborder="0" framespacing="0" >
            </iframe></td>';
   }   
}
function destinos_carta($idformato,$idcampo,$iddoc=NULL)
{global $conn;
 $tabla=busca_filtro_tabla("nombre_tabla","formato","idformato=$idformato","",$conn);
 if($iddoc==NULL)
    {echo '<td bgcolor="#F5F5F5">
     <input type="hidden" name="destinos" id="nombre" value="" obligatorio="obligatorio">
     <b>DESTINOS ELEGIDOS:</b><br />
     <input type="text" id="destinos_nombres" value="" size=150 readonly=true class="required" >
     <hr />
     <iframe name="frame_destinos" id="frame_destinos" src="funciones_adicionales.php?funcion=elegir_destinos" width=100% class=phpmkr border=0 frameborder="0" y framespacing="0">
     </iframe></td>';
    }
 else
    {echo '<td bgcolor="#F5F5F5"><iframe id="frame_destinos" src="funciones_adicionales.php?funcion=editar_destinos&iddoc='.$iddoc.'&tabla='.$tabla[0]["nombre_tabla"].'" width=100% class=phpmkr border=0 frameborder="0" framespacing="0" >
            </iframe></td>';
    }    
}
function mostrar_copias_carta($idformato,$iddoc=NULL)
{global $conn;

 $datos=busca_filtro_tabla("nombre,nombre_tabla","formato","idformato=$idformato","",$conn);
 $inf_memorando=busca_filtro_tabla("copia,copiainterna,vercopiainterna,".fecha_db_obtener('fecha_carta','Y-m-d'),$datos[0]["nombre_tabla"],"documento_iddocumento=$iddoc","",$conn); 
 if($inf_memorando[0]["copia"]<>"")
    {echo '<font size=2><br />Con Copia: ';
     $destinos=explode(",",$inf_memorando[0]["copia"]);
     $lista=array();
        	for($i=0;$i<count($destinos);$i++) 
            {$resultado=busca_filtro_tabla("e.nombre,direccion,m.nombre as ciudad","ejecutor e, municipio m,datos_ejecutor d","idejecutor=ejecutor_idejecutor and idmunicipio=d.ciudad and iddatos_ejecutor=".$destinos[$i],"",$conn);
            //print_r($resultado);            
          $lista[]=str_replace(", ,"," ",ucwords(strtolower($resultado[0]["nombre"].", ".$resultado[0]["direccion"].", ".$resultado[0]["ciudad"])));
          
                }
   $lista=implode("<br />",$lista);
   echo  $lista.'<br /><br /></font>';          
    }
  mostrar_copia_interna($inf_memorando[0]["copiainterna"],$inf_memorando[0]["vercopiainterna"],$inf_memorando[0]["fecha_carta"]);       
}

function mostrar_copia_interna($copia,$tipo="",$fecha)
{ 
 global $conn;
 if($tipo!="" && $tipo==0)
  $copia =""; 
 if($copia<>"")
    {// echo $copia;
     echo '<tr><td ><font size=2><br />Copia interna: ';
     $destinos=explode(",",$copia);
     $lista=array();
        	for($i=0;$i<count($destinos);$i++) 
            {//si el destino es una dependencia
             if(strpos($destinos[$i],"#")>0)
                {$resultado=busca_filtro_tabla("nombre","dependencia","iddependencia=".str_replace("#","",$destinos[$i]),"",$conn);
                 $lista[]=ucwords($resultado[0]["nombre"]); 
                }
             else//si el destino es un funcionario
                {//$resultado=busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,c.nombre","funcionario,cargo c,dependencia_cargo dc","dc.cargo_idcargo=c.idcargo and dc.funcionario_idfuncionario=idfuncionario and funcionario_codigo=".$destinos[$i],"",$conn);
                // $cargo=busca_filtro_tabla("nombre","cargo,dependencia_cargo","cargo_idcargo=idcargo and funcionario_idfuncionario=".$resultado[0]["idfuncionario"],"",$conn);
                 //$lista[]=("- ".(ucwords($resultado[0]["nombres"]." ".($resultado[0]["apellidos"])).", ").($cargo[0]["nombre"]));                 
                 $lista[]=cargos_memo($destinos[$i],$fecha,"para");
                }
            }
      if($i>1)
       echo "<br />";          
     echo (implode("<br /> ",$lista));       
     echo '</font></td>           
            </tr>';          
    }
 return true;      
}

function arbol_copia_interna($idformato,$idcampo,$iddoc=Null)
{
 global $conn;
 $campo=busca_filtro_tabla("","campos_formato","idcampos_formato=$idcampo","",$conn);
 $copia_interna=0;
 if($iddoc<>NULL)
    {$tabla=busca_filtro_tabla("nombre_tabla","formato","idformato=$idformato","",$conn);
     $valor=busca_filtro_tabla($campo[0]["nombre"].",vercopiainterna",$tabla[0]['nombre_tabla'],"documento_iddocumento=$iddoc","",$conn);
     
     if($valor[0]["vercopiainterna"])
        $copia_interna=1;
     $vector=explode(",",str_replace("#","d",$valor[0][0]));
     $valores=str_replace("#","d",$valor[0][0]);
     $ruta="../../test.php?seleccionado=$valores";
     $nombres=array();
     foreach($vector as $fila)
        {if(strpos($fila,'d')>0)
            {$datos=busca_filtro_tabla("nombre","dependencia","iddependencia=".str_replace("d","",$fila),"",$conn);
            $nombres[]=$datos[0]["nombre"];
            }
         else
            {$datos=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$fila,"",$conn);
             $nombres[]=$datos[0]["nombres"]." ".$datos[0]["apellidos"];;
            }   
        }
     $nombres= implode("<br />",$nombres);   
    }
 else
    {$ruta="../../test.php";   
     $valor[0][0]='';
     $nombres="";
    }
 $texto.='<td bgcolor="#F5F5F5">	'.$nombres.'<br /><br />
<div id="treeboxbox_'.$campo[0]["nombre"].'"></div>	';
//miro si ya estan incluidas las librerias del arbol
  $texto.= '<input type="hidden" name="'.$campo[0]["nombre"].'" id="'.$campo[0]["nombre"].'" ';
  if($campo[0]["obligatoriedad"])
      $texto.='obligatorio="obligatorio" ';
  else
      $texto.='obligatorio="" ';
  $texto.=' value="'.$valor[0][0].'" >	
  <script type="text/javascript">
  <!--		
			tree_'.$campo[0]["nombre"].'=new dhtmlXTreeObject("treeboxbox_'.$campo[0]["nombre"].'","100%","100%",0);
			tree_'.$campo[0]["nombre"].'.setImagePath("../../imgs/");
			tree_'.$campo[0]["nombre"].'.enableIEImageFix(true);
			tree_'.$campo[0]["nombre"].'.enableCheckBoxes(1);
			tree_'.$campo[0]["nombre"].'.enableThreeStateCheckboxes(true);			
			tree_'.$campo[0]["nombre"].'.setXMLAutoLoading("'.$ruta.'");
			tree_'.$campo[0]["nombre"].'.loadXML("'.$ruta.'");
      tree_'.$campo[0]["nombre"].'.setOnCheckHandler(onNodeSelect_'.$campo[0]["nombre"].');
      function onNodeSelect_'.$campo[0]["nombre"].'(nodeId)
      {valor=document.getElementById("'.$campo[0]["nombre"].'");
       pos=nodeId.indexOf("_");
       if(pos>0)
           nodeId=nodeId.substring(0,pos);
       if(valor.value!="")
         {
          existe=buscarItem(valor.value,nodeId);
          if(existe>=0)
            {nuevo=eliminarItem(valor.value,nodeId);
             valor.value=nuevo;
            }
          else
            valor.value+=","+nodeId;  
         } 
      else
         valor.value=nodeId;
      }	    
	--> 		
	</script>
  </td></tr>';
   echo $texto; 
  echo '<tr><td class="encabezado">VISIBLE LA COPIA INTERNA EN LA CARTA</td><td bgcolor="#F5F5F5"> <input type="radio" name="vercopiainterna" value="1" ';
  if($copia_interna)
     echo " checked ";
  echo '>Si&nbsp;&nbsp;<input type="radio" name="vercopiainterna" value="0" ';
  if(!$copia_interna)
     echo " checked ";
  echo '>No</td></tr>'; 
}
?>
<script>
/*
<Clase>
<Nombre> autocompletar
<Parametros>idcomponente-id del componente;digitado-valor digitado
<Responsabilidades>llama la función en php que consulta la bd y llena la lista de opciones
<Notas>para el autocompletar
<Excepciones>
<Salida>una lista de los valores coincidentes
<Pre-condiciones>
<Post-condiciones>
*/ 
function autocompletar(idcomponente,digitado,tipo)
{letras=digitado.length;
 if(letras!=1 && (letras%3)==0)
  {
  llamado("../../Autocompletar.php","comple"+idcomponente,"op=autocompl&idcomponente="+idcomponente+"&digitado="+digitado+"&depende=1&tipo="+tipo);
  document.getElementById("comple"+idcomponente).style.display="inline";
  }
}
</script>

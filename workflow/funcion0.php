<?php   
	session_start();
	/*$con = mysql_connect('localhost','ejecafet','dhemian-2009');
	$db = mysql_select_db('ejecafet_pruebas',$con); */
	
	$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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

?>
<html>
	<head>
		
		<script type="text/javascript" src="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />  
    <script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.js"></script>
		<script>                                       
		hs.graphicsDir = '<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
    hs.marginLeft = 620;
function validar_1_1()
			{
				var id_diagrama = "";
				 <? if( is_numeric($_SESSION['id_diagramaxxx'])){?>
                id_diagrama = <?=$_SESSION['id_diagramaxxx']?>;
                <? }?>
				if(id_diagrama == ""){
					alert('Debe guardar primero el diagrama');
					return false;
				}
				var formulario = document.formulario1;
				//aqui capturo la informacion que hay en cada campo
				var descripcion = formulario.descripcion.value;
				var responsable = formulario.copiainterna.value;
				var paso = formulario.paso.value;
				var idfigura = formulario.figura.value;
				var formatox = formulario.formato;
				
				//aqui dice que si alguno de los campos no se ha llenado que muestre un aviso diciendo que llene los campos
				if(descripcion.length == 0 || responsable.length == 0 || paso.length == 0)
				{
					$("#mostrario").html("<center><font color='red'>Llene los campos obligatorios</font></center>");
					$.post("funcion2.php",{idfigura : idfigura,descripcion_paso:descripcion},function(data){			
					alert(descripcion_paso);
				});
					return false;
				}
				
				document.formulario1.submit();
				//de aqui para abajo es simplemente mostrar una imagen de cargando y enviar los dos por metodo post.
				/*$("#formulario_figura").css("display","none");
				$("#cargando").css("display","inline");
				$("#mostrario").html("");
				$.post("funcion.php",{des : descripcion , res : responsable , pas : paso , figura : idfigura, formato : formatox},function(){
					$("#cargando").css("display","none");
					$("#formulario_figura").show("fast");
				});*/
				//document.getElementById("form1").reset();
				//});
			}
		</script>
	</head>
	<body bgcolor='white'>
<?	
	//Inicializo variables	
		$descripcion = "";
		$responsable = "";
		$paso = "";
		$figura = "";
		$listar = "no";
		$boton = "Enviar";
		$id_diagrama = "";
		$formatos = "";
		
		$descripcion = $_REQUEST['descripcion'];
		$responsable = $_REQUEST['copiainterna'];
		$paso = $_REQUEST['paso'];
		$figura = $_REQUEST['figura'];
		$borrar = "";
		$id_diagrama = $_REQUEST['id_diagrama'];
		$formatos = $_REQUEST['formato'];
		$paso_fin = $_REQUEST["paso_fin"];
		$formato = arreglar_formatos($formatos);
	
	if($_REQUEST['no_popup'] == "si"){
		$sel1 = busca_filtro_tabla("","paso","idfigura=".$figura." AND diagram_iddiagram=".$_SESSION['id_diagramaxxx'],"",$conn);
		//print_r($sel1);
    //echo substr($sel1[0]["descripcion"],0,150).'...<br>
    //<a href="funcion.php?figura='.$figura.'&id_diagrama='.$_SESSION['id_diagramaxxx'].'" id="ver_paso" class="iframe" >Ver mas...</a>';
    echo substr($sel1[0]["descripcion"],0,150).'...<br>
    <a href="admin_paso.php?idpaso='.$sel1[0]["idpaso"].'" id="ver_paso" class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 300, height:400} )">Ver mas...</a>';

	}
	else
	{
	 include_once($ruta_db_superior."header.php");
	 
  //include_once("cargando.php");
  include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
  global $conn;
		//if(!empty($_POST['des']))
		//{
	?>
	<script type="text/javascript">
  function validar_formu1()
  {
    var campo = document.formu1;
    if(campo.categoria.value.length == 0)
    {
      alert("Inserte alguna categoria");
      return false;
    }
    campo.seenvio.value="si";
    campo.submit();
  }
    </script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/dhtmlXTree.js"></script>
<link rel="STYLESHEET" type="text/css" href="<?php echo($ruta_db_superior);?>css/dhtmlXTree.css">
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/dhtmlXCommon.js"></script>
   <?
	//Busco la existencia de un registro donde id de la figura sea igual a una figura llamada y id del diagrama
	//Se hizo el where con id figura y diagrama ya que el id de la figura puede ser 1, y habran muchas figuras con ese id y modificaria todo.
	//La idea es solo modificar la figura de un diagrama no la figura de muchos diagramas.
			$arreglo1 = busca_filtro_tabla("*","paso","idfigura='".$figura."' AND diagram_iddiagram='".$id_diagrama."'","",$conn);
			//$arreglo1 = mysql_fetch_array($sel1);
	// Si la consulta no devolvio datos es porque no existe y se procede a insertar un nuevo registro.
			if($arreglo1["numcampos"] == 0){
				if(!empty($descripcion)){
					phpmkr_query("INSERT INTO paso(descripcion,responsable,nombre_paso,idfigura,diagram_iddiagram,paso_fin) VALUES('$descripcion','$responsable','$paso','$figura','$id_diagrama','$paso_fin')") or die ("Error en la insercion");
					$listar = "si";
					$ultimo_id = phpmkr_insert_id();
					
					foreach($formato as $format){
					   phpmkr_query("INSERT INTO formato_paso(formato,paso_idpaso) VALUES($format,$ultimo_id)");
          }
			//Aqui se hace la consulta para listarlo mas abajo de este archivo.
					//$sel1 = mysql_query("SELECT * FROM paso WHERE idfigura='".$figura."' AND diagram_iddiagram='".$id_diagrama."'");
					$arreglo1 = busca_filtro_tabla("*","paso","idfigura='".$figura."' AND diagram_iddiagram='".$id_diagrama."'","",$conn);
					//$arreglo1 = mysql_fetch_array($sel1);
					//mysql_query("INSERT INTO formato_paso VALUES('',)");
					echo "<script>window.location='funcion.php?figura=$figura&id_diagrama=$id_diagrama'</script>";
				}
			}
			else{
	//si la consulta devolvio datos o sea que hay que actualizar datos. O en otras palabras modificar.
				$listar = "si";
				$boton = "Modificar";
				if(!empty($descripcion)){
					phpmkr_query("UPDATE paso SET descripcion='".$descripcion."', responsable='".$responsable."', nombre_paso='".$paso."', paso_fin='".$paso_fin."' 
					WHERE idfigura=".$figura." AND diagram_iddiagram=".$id_diagrama);
					$ultimo_id = busca_filtro_tabla("","paso","idfigura=$figura AND diagram_iddiagram=$id_diagrama","");
					
					mysql_query("DELETE FROM formato_paso WHERE paso_idpaso=".$ultimo_id[0]["idpaso"]);
	
					foreach($formato as $format){
					   phpmkr_query("INSERT INTO formato_paso(formato,paso_idpaso) VALUES($format,".$ultimo_id[0]["idpaso"].")");
          }
					echo "<script>window.location='funcion.php?figura=$figura&id_diagrama=$id_diagrama'</script>";
				}
			}
		//}
		//Aqui llega el id de la figura despues de haberla suprimido
		//Aqui se recibe como parametro el id de la figura y teniendo en la sesion el id del diagrama a eliminar los datos de cierta figura
			$borrar = $_POST['borrar_figura'];
			if(!empty($borrar)){
				phpmkr_query("DELETE FROM paso WHERE idfigura='".$borrar."' AND diagram_iddiagram='".$id_diagrama."'");
			}
		
		cargar_copiainterna($figura,$id_diagrama);
		$responsable=busca_filtro_tabla("","paso","idfigura=".$figura." and diagram_iddiagram=".$id_diagrama,"",$conn);
		$seleccionados = $responsable[0]["responsable"];
		
		echo "<div id='cargando' style='display:none'><img src='assets/images/cargando.gif'></div>
	<div id='formulario_figura'>
			<form method='POST' name='formulario1' id='form1' onsubmit='validar_1_1();return false;'>
			   <br>
			   <a href='index.php?diagramId=$id_diagrama'>Cerrar</a>
			   <br><br>
				<table id='estructura' style='background:white;width:100%'>
				  <tr>
				    <td colspan='2' class='encabezado' style='text-align:center'><strong>Informacion del Paso</strong></td>
				  </tr>
					<tr>
						<td width='20%' class='encabezado'>Nombre del paso*</td>
						<td width='80%'><input type='text' class='text' name='paso' value='".$arreglo1[0][3]."' style='width:100%'></td>
					</tr>
					<tr>
						<td class='encabezado'>Descripcion*</td>
						<td><textarea class='text' name='descripcion' style='width:100%;height:70px'>".$arreglo1[0][1]."</textarea></td>
					</tr> 
					<tr>
						<td class='encabezado'>Responsable*</td><td>";
			
						?>	
			<?php include_once($ruta_db_superior."formatos/librerias/header_formato.php"); ?>
                          <br />  Buscar: <input type="text" id="stext_copiainterna" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_copiainterna.findItem(htmlentities(document.getElementById('stext_copiainterna').value),1)"> <img src="../botones/general/anterior.png"border="0px"></a>
                    <a href="javascript:void(0)" onclick="tree_copiainterna.findItem(htmlentities(document.getElementById('stext_copiainterna').value),0,1)"><img src="../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_copiainterna.findItem(htmlentities(document.getElementById('stext_copiainterna').value))"><img src="../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_copiainterna"><img src="../imagenes/cargando.gif"></div><div id="treeboxbox_copiainterna" height="90%"></div><input type="hidden"  name="copiainterna" id="copiainterna"   value="" ><label style="display:none" class="error" for="copiainterna">Campo obligatorio.</label>
                          <script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copiainterna=new dhtmlXTreeObject("treeboxbox_copiainterna","100%","100%",0);
                			tree_copiainterna.setImagePath("../imgs/");
                			tree_copiainterna.enableIEImageFix(true);tree_copiainterna.enableCheckBoxes(1);
                			tree_copiainterna.enableThreeStateCheckboxes(1);tree_copiainterna.setOnLoadingStart(cargando_copiainterna);
                      tree_copiainterna.setOnLoadingEnd(fin_cargando_copiainterna);tree_copiainterna.enableSmartXMLParsing(true);tree_copiainterna.loadXML("../test_funmap.php?rol=1&seleccionado=<?=$seleccionados ?>");
                	        
                      tree_copiainterna.setOnCheckHandler(onNodeSelect_copiainterna);
                      function onNodeSelect_copiainterna(nodeId)
                      {valor_destino=document.getElementById("copiainterna");
                       destinos=tree_copiainterna.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_copiainterna.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               
                               for(h=0;h<vectorh.length;h++)
                                  {if(vectorh[h].indexOf("_")!=-1)
                                      vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
                                   nuevo=eliminarItem(nuevo,vectorh[h]);
                                  } 
                              }
                          }
                       nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");   
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_copiainterna() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copiainterna")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copiainterna")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copiainterna"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_copiainterna() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copiainterna")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copiainterna")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copiainterna"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script>
<? echo "
						
						</td>
					</tr>
					<tr>
					 <td class='encabezado'>Formatos vinculados *</td><td>
					   <table width='100%'>";
	$formatos = busca_filtro_tabla("","formato","","",$conn);
	$buscando_check = busca_filtro_tabla("idpaso","paso","idfigura=$figura and diagram_iddiagram=$id_diagrama","",$conn);
            $tienen .="<ul>";	
	         for($i=0;$i<$formatos["numcampos"];$i++){
	             $check = busca_filtro_tabla("","formato_paso","paso_idpaso=".$buscando_check[0]["idpaso"]." and formato=".$formatos[$i]["idformato"],"",$conn);
	             if($i % 5 == 0)
	               echo "</tr><tr>";
	             echo "<td style='text-align:center'>";
	             if($check["numcampos"] > 0){
	               echo "<input type='checkbox' name='formato[$i]' value='".$formatos[$i]['idformato']."' checked='yes'><br>";
	               $tienen .= "<li>".$formatos[$i]['etiqueta']."</li>";
	            }
	             else
	               echo "<input type='checkbox' name='formato[$i]' value='".$formatos[$i]['idformato']."'><br>";
	             echo $formatos[$i]['etiqueta']."</td>";
           }
           $tienen.= "</ul>";
					   echo "</tr></table>
           </td>
					</tr>
					<tr>
					 <td class='encabezado'>Se termino el paso?</td>
           <td>";
           if($arreglo1[0][4] == ""){
               echo "
               <input type='radio' name='paso_fin' value='1'>Si<br>
               <input type='radio' name='paso_fin' value='2' checked>No</td>
               ";
          }
          else{
              if($arreglo1[0][4] == 1)
                $val1 = "checked";
              if($arreglo1[0][4] == 2)
                $val2 = "checked";
              echo "
               <input type='radio' name='paso_fin' value='1' $val1>Si<br>
               <input type='radio' name='paso_fin' value='2' $val2>No</td>
               "; 
          }
          echo " 
					</tr>
					<tr>
						<td><input type='button' value='".$boton."' onclick='validar_1_1()'></td>
					</tr>
					<tr>
						<td colspan='4' id='mostrario'></td>
					</tr>
					<input type='hidden' name='figura' value=".$_REQUEST['figura'].">
				</table>
			</form>
		</div><br>";
		if($listar == "si"){
		  $id = explode(",",$arreglo1[0][2]);
		  $funcio .= "<ul>";
		  for($i=0;$i<count($id);$i++){
		    if($id[$i] != ""){
    		    $funcionario = busca_filtro_tabla("b.nombres,b.apellidos","dependencia_cargo a,funcionario b","iddependencia_cargo=$id[$i] and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
            $funcio .= "<li>".$funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"]."</li>";
        }
		  }
		  if($arreglo1[0][4] == 1)
		    $fin = "Si";
		  if($arreglo1[0][4] == 2)
		    $fin = "No";
		  $funcio .= "</ul>";
			echo "<table width='100%' style='background:white'>";
			echo "<tr>";
			echo "<td width='20%' class='encabezado'>Nombre del paso:</td><td width='80%' style='border:1px solid #D8D8D8'>".$arreglo1[0][3]."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td class='encabezado'>Descripcion:</td><td style='border:1px solid #D8D8D8'>".$arreglo1[0][1]."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td class='encabezado'>Responsable:</td><td style='border:1px solid #D8D8D8'>".$funcio."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td class='encabezado'>Formatos Vinculados:</td><td style='border:1px solid #D8D8D8'>$tienen</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td class='encabezado'>Se termin&oacute; el paso</td><td style='border:1px solid #D8D8D8'>$fin</td>";
			echo "</tr>";
			echo "</table>";
		}
}
		include_once($ruta_db_superior."footer.php");
		
	
	function arreglar_formatos($arreglos){
	   if(count($arreglos)>0){
		    foreach($arreglos as $arreglo){
		        if($arreglo != ""){
		            $formato_limpio[]= $arreglo;
              }             
        }
        return $formato_limpio;
      }
    }
    function cargar_copiainterna($figura,$diagrama)
    {
        global $conn;

        $responsable=busca_filtro_tabla("","paso","idfigura=".$figura." and diagram_iddiagram=".$diagrama,"",$conn);
        $respon = explode(",",$responsable[0]["responsable"]);            
            
            echo"<script type='text/javascript'>
            $().ready(function() {
            $('#copiainterna').val('".$responsable[0]["responsable"]."');
            })";
            echo "</script>";
    
    }
?>
	</body>
</html>
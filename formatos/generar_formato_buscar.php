<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
$ruta_actual='../';
include_once($ruta_db_superior."librerias_saia.php");
if(@$_REQUEST["idformato"])
  $idformato=$_REQUEST["idformato"];
else {
  alerta("por favor seleccione un Formato a Generar");
  $redireccion="formatolist.php";
	if($archivo!=''){
		$redireccion=$archivo;
	}
  redirecciona($redireccion);
}
if(@$_REQUEST["crea"]){
  crear_formato_buscar($idformato,"buscar");
  $redireccion="funciones_formatolist.php?idformato=".$idformato;
	if($archivo!=''){
	$redireccion=$archivo;
	}
  redirecciona($redireccion);
}
/*<Clase>
<Nombre>crear_formato_buscar</Nombre>
<Parametros>$idformato:id del formato;$accion:buscar</Parametros>
<Responsabilidades>crear la interface para realizar las busquedas sobre los formatos<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function crear_formato_buscar($idformato,$accion){
  global $sql,$conn,$ruta_db_superior;
  $datos_detalles["numcampos"]=0;
  $texto='';
  $includes="";
	$incluidos=array();
  $obligatorio="";
  $formato=busca_filtro_tabla("*","formato A","A.idformato=".$idformato,"",$conn);
  if($formato["numcampos"]){
    $action='../librerias/funciones_buscador.php';
    $texto.='<legend id="label_formato" class="legend">B&uacute;squeda en formato '.$formato[0]["etiqueta"].'</legend><br /><br />';
    $librerias=array();
    if($formato[0]["librerias"] && $formato[0]["librerias"]<>""){
      $includes.=incluir($formato[0]["librerias"],"librerias",1);
    }
    $texto1='<?php include_once("'.$ruta_db_superior.'librerias/funciones_generales.php';
    $texto2='"); ? >';
	$includes.=$texto1.$texto2;
    //$includes.=incluir_libreria("funciones_formatos.js","javascript");
    if($formato[0]["estilos"] && $formato[0]["estilos"]<>""){
      $includes.=incluir($formato[0]["estilos"],"estilos",1);
    }
    if($formato[0]["javascript"] && $formato[0]["javascript"]<>""){
      $includes.=incluir($formato[0]["javascript"],"javascript",1);
    }
	$radio=0;

	$texto.=$includes;
    $arboles=0;
    $dependientes=0;
    $mascaras=0;
    $textareas=0;
    $autocompletar=0;
    $checkboxes=0;
    $ejecutores=0;
    $fecha=0;
    $archivo=0;
    $lista_enmascarados="";
    $listado_campos=array();
    $unico=array();
    $obliga="";
    $adicionales="";
	$campos_excluidos=array("'archivo'","'hidden'"/*,"'fecha'"*/);
	$cantidad_exclu=count($campos_excluidos);
	$filtro="";
	$campos_especiales=array();
	if($cantidad_exclu){
		$filtro=" AND etiqueta_html NOT IN (".implode(",",$campos_excluidos).") ";
	}
    $campos=busca_filtro_tabla("*","campos_formato A","A.acciones like '%".$accion[0]."%' and A.formato_idformato=".$idformato.$filtro,"orden ASC",$conn);
    //funciones creadas para el formato, pero que corresponden a nombres de campos
    //print_r($campos);die();
    $fun_campos=array();
    for($h=0;$h<$campos["numcampos"];$h++)
    {
      $saltar_campo=false;
     if($campos[$h]["etiqueta_html"]=="arbol")
        $arboles=1;
     elseif($campos[$h]["etiqueta_html"]=="textarea")
        $textareas=1;
     $obliga="";
     //******************** validaciones *****************
     $adicionales="";
     $longitud= busca_filtro_tabla("valor","caracteristicas_campos","tipo_caracteristica ='maxlength' and idcampos_formato=".$campos[$h]["idcampos_formato"],"",$conn);
     if($longitud["numcampos"])
       {if($longitud[0][0]>$campos[$h]["longitud"])
           $adicionales.="maxlength=\"".$campos[$h]["longitud"]."\" ";
        else
           $adicionales.="maxlength=\"".$longitud[0][0]."\" ";
       }
     elseif($campos[$h]["longitud"])
       $adicionales.="maxlength=\"".$campos[$h]["longitud"]."\" ";

     $caracteristicas=busca_filtro_tabla("","caracteristicas_campos","tipo_caracteristica not in('adicionales','class','maxlength') and idcampos_formato=".$campos[$h]["idcampos_formato"],"",$conn);
     for($c=0;$c<$caracteristicas["numcampos"];$c++)
        {
         $adicionales.=$caracteristicas[$c]["tipo_caracteristica"]."=\"".$caracteristicas[$c]["valor"]."\" ";
        }
      $class=busca_filtro_tabla("valor","caracteristicas_campos","tipo_caracteristica='class' and idcampos_formato=".$campos[$h]["idcampos_formato"],"",$conn);
      if($class["numcampos"])
            $adicionales.=" class=\"".$class[0][0]."\" ";
      //atributos adicionales
     $otros=busca_filtro_tabla("","caracteristicas_campos","tipo_caracteristica='adicionales' and idcampos_formato=".$campos[$h]["idcampos_formato"],"",$conn);
     if($otros["numcampos"])
        $adicionales.=$otros[0]["valor"];
     /**/
         {
           $valor="";
           switch($campos[$h]["etiqueta_html"])
           {
              case "password":
                $texto.='<div class="control-group"><label class="string control-label" style="font-size:9pt" for="'.$campos[$h]["nombre"].'"><b>'.$campos[$h]["etiqueta"].generar_comparacion($campos[$h]["tipo_dato"],$campos[$h]["nombre"]).'</b></label><div class="controls"><input type="password" name="'.$campos[$h]["nombre"].'" '.$obligatorio." $adicionales ".' value="'.$valor.'">';
                if($h<($campos["numcampos"]-1))
                	$texto.=generar_condicion($campos[$h]["nombre"]);
                $texto.='</div></div>';
              break;
              case "fecha":
                //si la fecha es obligatoria, que valide que no se vaya con solo ceros
                $adicionales=str_replace("required","dateISO",$adicionales);
                if($campos[$h]["tipo_dato"]=="DATE"){
                  $texto.='<div class="control-group">
                  <label class="string control-label" for="'.$campos[$h]["nombre"].'"><b>'.$campos[$h]["etiqueta"].'</b></label>
                  <input type="hidden" name="bksaiacondicion_g@'.$campos[$h]["nombre"].'_x" id="bksaiacondicion_g@'.$campos[$h]["nombre"].'_x" value=">=">
                  <div class="controls">
                  Entre <input type="text" '.$adicionales.' name="bqsaia_g@'.$campos[$h]["nombre"].'_x" id="'.$campos[$h]["nombre"].'_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio">';
                  $texto.='<?php selector_fecha("'.$campos[$h]["nombre"].'_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?'.'> y ';
                  $texto.='
                  <input type="hidden" name="bksaiacondicion_g@'.$campos[$h]["nombre"].'_y" id="bksaiacondicion_g@'.$campos[$h]["nombre"].'_y" value="<=">
                  <input type="text" '.$adicionales.' name="bqsaia_g@'.$campos[$h]["nombre"].'_y" id="'.$campos[$h]["nombre"].'_y" tipo="fecha" value="" style="width:100px" placeholder="Fin">';
                  $texto.='<?php selector_fecha("'.$campos[$h]["nombre"].'_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?'.'>';
									$datos_fecha[]="g@".$campos[$h]["nombre"]."_x";
									$datos_fecha[]="g@".$campos[$h]["nombre"]."_y";
                  $fecha++;
                }
                else if($campos[$h]["tipo_dato"]=="DATETIME"){
                  $texto.='<div class="control-group"><label class="string control-label" style="font-size:9pt" for="'.$campos[$h]["nombre"].'"><b>'.$campos[$h]["etiqueta"].generar_comparacion($campos[$h]["tipo_dato"],$campos[$h]["nombre"]).'</b></label><div class="controls">
                    ENTRE &nbsp;<input type="text" readonly="true" name="'.$campos[$h]["nombre"].'_1" '.$adicionales.' id="'.$campos[$h]["nombre"].'_1" value="';
                  $texto.='"><?php selector_fecha("'.$campos[$h]["nombre"].'_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?'.'>&nbsp;&nbsp; Y &nbsp;&nbsp;';
                  $texto.='<input type="text" readonly="true" name="'.$campos[$h]["nombre"].'_2" '.$adicionales.' id="'.$campos[$h]["nombre"].'_2" value="';

                  $texto.='"><?php selector_fecha("'.$campos[$h]["nombre"].'_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?'.'>';
                  $fecha++;
                }
                else alerta("No esta definido su formato de Fecha");

				if($h<($campos["numcampos"]-1))
                	$texto.=generar_condicion($campos[$h]["nombre"]);
                $texto.='</div></div>';
              break;
              case "radio":
              /* En los campos de este tipo se debe validar que valor contenga un listado con las siguentes caracteristicas*/
                $texto.='<div class="control-group"><label class="string control-label" style="font-size:9pt" for="'.$campos[$h]["nombre"].'"><b>'.$campos[$h]["etiqueta"].generar_comparacion($campos[$h]["tipo_dato"],"g@".$campos[$h]["nombre"]).'</b></label><div class="controls">';
                $texto.=arma_funcion("genera_campo_listados_editar",$idformato.",".$campos[$h]["idcampos_formato"],'buscar');

                if($h<($campos["numcampos"]-1))
                	$texto.=generar_condicion("g@".$campos[$h]["nombre"]);
				$radio=1;
                $texto.='</div></div>';
              break;
              case "checkbox":
                $texto.='<div class="control-group"><label class="string control-label" style="font-size:9pt" for="'.$campos[$h]["nombre"].'"><b>'.$campos[$h]["etiqueta"].generar_comparacion($campos[$h]["tipo_dato"],$campos[$h]["nombre"]).'</b></label><div class="controls">';
                $texto.=arma_funcion("genera_campo_listados_editar",$idformato.",".$campos[$h]["idcampos_formato"],'buscar');
				if($h<($campos["numcampos"]-1))
                	$texto.=generar_condicion($campos[$h]["nombre"]);
                $texto.='</div></div>';
                  $checkboxes++;
              break;
              case "select":
                $texto.='<div class="control-group"><label class="string control-label" style="font-size:9pt" for="'.$campos[$h]["nombre"].'"><b>'.$campos[$h]["etiqueta"].generar_comparacion($campos[$h]["tipo_dato"],"g@".$campos[$h]["nombre"]).'</b></label><div class="controls">';
                $texto.=arma_funcion("genera_campo_listados_editar",$idformato.",".$campos[$h]["idcampos_formato"],'buscar');

                if($h<($campos["numcampos"]-1))
                	$texto.=generar_condicion($campos[$h]["nombre"]);

                $texto.='</div></div>';
              break;
               case "dependientes":
              /*parametros:
              nombre del select padre; sql select padre| nombre del select hijo; sql select hijo....
              (ej: departamento;select iddepartamento as id,nombre from departamento order by nombre| municipio; select idmunicipio as id,nombre from municipio where departamento_iddepartamento=)*/
                $parametros=explode("|",$campos[$h]["valor"]);
                if(count($parametros)<2)
                  alerta("Por favor verifique los parametros de configuracion de su select dependiente ".$campos[$h]["etiqueta"].generar_comparacion($campos[$h]["tipo_dato"],$campos[$h]["nombre"]));
                else
                   {$texto.='<div class="control-group"><label class="string control-label" style="font-size:9pt" for="'.$campos[$h]["nombre"].'"><b>'.$campos[$h]["etiqueta"].generar_comparacion($campos[$h]["tipo_dato"],$campos[$h]["nombre"]).'</b></label><div class="controls">'.arma_funcion("genera_campo_listados_editar",$idformato.",".$campos[$h]["idcampos_formato"],'editar');

                   if($h<($campos["numcampos"]-1))
                	$texto.=generar_condicion($campos[$h]["nombre"]);

                   $texto.='</div></div>';
                    $dependientes++;
                   }
              break;
              case "autocompletar":
                /* parametros: campos a mostrar separados por comas; campo a guardar en el hidden; tabla
                  ej: nombres,apellidos;idfuncionario;funcionario

                  Queda pendiente La parte de la busqueda.
                */
                $texto.='<div class="control-group"><label class="string control-label" style="font-size:9pt" for="'.$campos[$h]["nombre"].'"><b>'.$campos[$h]["etiqueta"].generar_comparacion($campos[$h]["tipo_dato"],$campos[$h]["nombre"]).'</b></label><div class="controls">';
                $texto.='<input type="text" size="30" '.$adicionales.' value="" id="input'.$campos[$h]["idcampos_formato"].'" onkeyup="lookup(this.value,'.$campos[$h]["idcampos_formato"].');" onblur="fill(this.value,'.$campos[$h]["idcampos_formato"].');" />
                <div class="suggestionsBox" id="suggestions'.$campos[$h]["idcampos_formato"].'" style="display: none;">
				        <div class="suggestionList" id="list'.$campos[$h]["idcampos_formato"].'" >&nbsp;
        				</div>
        			  </div>
        			  <input '.$obligatorio.' type="text" name="'.$campos[$h]["nombre"].'" id="'.$campos[$h]["nombre"].'">
                ';

                if($h<($campos["numcampos"]-1))
                	$texto.=generar_condicion($campos[$h]["nombre"]);

                $texto.='</div></div>';
                $autocompletar++;
              break;
              case "etiqueta":
                $texto.='<div class="control-group"><label class="string control-label" style="font-size:9pt" for="'.$campos[$h]["nombre"].'"><b>'.$campos[$h]["etiqueta"].generar_comparacion($campos[$h]["tipo_dato"],$campos[$h]["nombre"]).'</b></label></div>';
              break;
               case "arbol":
               /*En campos valor se deben almacenar los siguientes datos:
                arreglo[0]:ruta de el xml
                arreglo[1]=1=> checkbox;arreglo[1]=2=>radiobutton
                arreglo[2] Modo calcular numero de nodos hijo
                arreglo[3] Forma de carga 0=>autoloading; 1=>smartXML
                arreglo[4] Busqueda
                arreglo[5] Almacenar 0=>iddato 1=>valordato
                arreglo[6] Tipo de arbol 0=>funcionarios 1=>series 2=>dependencias
                */
                $arreglo=explode(";",$campos[$h]["valor"]);
                //print_r($arreglo);
                /*print_r($campos[$h]);
                die("<br />".$campos[$h]["nombre"]."<br />".$campos[$h]["valor"]);*/
                if(isset($arreglo) && $arreglo[0]!=""){
                  $ruta="\"".$arreglo[0]."\"";
                }
                else{
                 $ruta="\"../arboles/test_dependencia.xml\"";
                 $arreglo[1]=0;
                 $arreglo[2]=0;
                 $arreglo[3]=0;
                 $arreglo[4]=1;
                }
                $texto.='<div class="control-group"><div class="controls"><b>'.$campos[$h]["etiqueta"].generar_comparacion($campos[$h]["tipo_dato"],$campos[$h]["nombre"]).'</b><div id="esperando_'.$campos[$h]["nombre"].'"><img src="../../imagenes/cargando.gif"></div>';
                $texto.='<div id="seleccionados"></div>';
                if($arreglo[4]){
                  $texto.='<input type="text" id="stext_'.$campos[$h]["nombre"].'" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_'.$campos[$h]["nombre"].'.findItem((document.getElementById(\'stext_'.$campos[$h]["nombre"].'\').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_'.$campos[$h]["nombre"].'.findItem((document.getElementById(\'stext_'.$campos[$h]["nombre"].'\').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_'.$campos[$h]["nombre"].'.findItem((document.getElementById(\'stext_'.$campos[$h]["nombre"].'\').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />';
                }
                $texto.='<div id="treeboxbox_'.$campos[$h]["nombre"].'" height=""></div>';
                //miro si ya estan incluidas las librerias del arbol
                $texto.= '<input type="hidden" '.$adicionales.' name="g@'.$campos[$h]["nombre"].'" id="'.$campos[$h]["nombre"].'"  ';
                $texto.=' value="" ><label style="display:none" class="error" for="'.$campos[$h]["nombre"].'">Campo obligatorio.</b></label>';
                $texto.='<script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_'.$campos[$h]["nombre"].'=new dhtmlXTreeObject("treeboxbox_'.$campos[$h]["nombre"].'","","",0);
                			tree_'.$campos[$h]["nombre"].'.setImagePath("../../imgs/");
                			tree_'.$campos[$h]["nombre"].'.enableIEImageFix(true);';
                if($arreglo[1]==1){
                	$texto.='tree_'.$campos[$h]["nombre"].'.enableCheckBoxes(1);
                			tree_'.$campos[$h]["nombre"].'.enableThreeStateCheckboxes(1);';
                }
                else if($arreglo[1]==2){
                  $texto.='tree_'.$campos[$h]["nombre"].'.enableCheckBoxes(1);
                    tree_'.$campos[$h]["nombre"].'.enableRadioButtons(true);';
                }
                $texto.='tree_'.$campos[$h]["nombre"].'.setOnLoadingStart(cargando_'.$campos[$h]["nombre"].');
                      tree_'.$campos[$h]["nombre"].'.setOnLoadingEnd(fin_cargando_'.$campos[$h]["nombre"].');';
                if($arreglo[3]){
                  $texto.='tree_'.$campos[$h]["nombre"].'.enableSmartXMLParsing(true);';
                }
                else
                  $texto.='tree_'.$campos[$h]["nombre"].'.setXMLAutoLoading('.$ruta.');';
                	$texto.='tree_'.$campos[$h]["nombre"].'.loadXML('.$ruta.');
                      tree_'.$campos[$h]["nombre"].'.setOnCheckHandler(onNodeSelect_'.$campos[$h]["nombre"].');
                      function onNodeSelect_'.$campos[$h]["nombre"].'(nodeId)
                      {valor_destino=document.getElementById("'.$campos[$h]["nombre"].'");
                       destinos=tree_'.$campos[$h]["nombre"].'.getAllChecked();
                       var nuevos_valores=destinos.split(",");
						var cantidad=nuevos_valores.length;
						var funcionarios=new Array();
						var indice=0;
						for(var i=0;i<cantidad;i++){
							//if(nuevos_valores[i].indexOf("#")=="-1"){
								if(nuevos_valores[i]!=""){
									funcionarios[indice]=nuevos_valores[i];
									indice++;
								}
							//}
						}
						valor_destino.value=funcionarios.join(",");
                      }';
                  $texto.="
                      function fin_cargando_".$campos[$h]["nombre"]."() {
                        if (browserType == \"gecko\" )
                           document.poppedLayer =
                               eval('document.getElementById(\"esperando_".$campos[$h]["nombre"]."\")');
                        else if (browserType == \"ie\")
                           document.poppedLayer =
                              eval('document.getElementById(\"esperando_".$campos[$h]["nombre"]."\")');
                        else
                           document.poppedLayer =
                              eval('document.layers[\"esperando_".$campos[$h]["nombre"]."\"]');
                        document.poppedLayer.style.visibility = \"hidden\";
                      }
                      function cargando_".$campos[$h]["nombre"]."() {
                        if (browserType == \"gecko\" )
                           document.poppedLayer =
                               eval('document.getElementById(\"esperando_".$campos[$h]["nombre"]."\")');
                        else if (browserType == \"ie\")
                           document.poppedLayer =
                              eval('document.getElementById(\"esperando_".$campos[$h]["nombre"]."\")');
                        else
                           document.poppedLayer =
                               eval('document.layers[\"esperando_".$campos[$h]["nombre"]."\"]');
                        document.poppedLayer.style.visibility = \"visible\";
                      }
                	";
              if($accion=="editar"){
                $texto.="
                  function checkear_arbol(){
                  vector2=\"".arma_funcion("cargar_seleccionados",$idformato.",".$campos[$h]["idcampos_formato"].",1","mostrar")."\";
                  vector2=vector2.split(\",\");
                  for(m=0;m<vector2.length;m++)
                    {tree_".$campos[$h]["nombre"].".setCheck(vector2[m],true);
                    }}\n";
              }
             	$texto.="--></script>";
			  if($h<($campos["numcampos"]-1))
                	$texto.=generar_condicion($campos[$h]["nombre"]);
              $texto.= '</div></div>';
			  $campos_especiales[]=$campos[$h]["nombre"]."@arbol";
              $arboles++;
              break;
              case "detalle":
                $padre=busca_filtro_tabla("nombre_tabla","formato A","idformato=".$campos[$h]["valor"],"",$conn);
                if($padre["numcampos"]){
                  $texto.='<?php if($_REQUEST["padre"]) {?'.'><input type="hidden"  name="'.$padre[0]["nombre_tabla"].'" '.$obligatorio.' value="<?php echo $_REQUEST["padre"]; ?'.'>">'.'<?php } ?'.'>';
                  $texto.='<?php if($_REQUEST["anterior"]) {?'.'><input type="hidden"  name="bqsaia_'.$padre[0]["nombre_tabla"].'" '.$obligatorio.' value="<?php echo $_REQUEST["anterior"]; ?'.'>">'.'<?php }  else {listar_select_padres('.$padre[0]["nombre_tabla"].');} ?'.'>';
                }
              break;
              case "ejecutor":
                $texto.='
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>'.$campos[$h]["etiqueta"].'</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre'.generar_comparacion($campos[$h]["tipo_dato"],'f@nombre__'.$h).'</b><div class="controls"><input type="text" '." $adicionales ".' id="'.$campos[$h]["nombre"].'-nombre" name="g@'.$campos[$h]["nombre"].'-nombre" '.$obligatorio.'></div>';

				  $texto.='<b>Identificacion</b><div class="controls"><input type="text" '." $adicionales ".' id="'.$campos[$h]["nombre"].'-identificacion" name="g@'.$campos[$h]["nombre"].'-identificacion" '.$obligatorio.'></div>';

				  $texto.='<b>Empresa</b><div class="controls"><input type="text" '." $adicionales ".' id="'.$campos[$h]["nombre"].'-empresa" name="g@'.$campos[$h]["nombre"].'-empresa" '.$obligatorio.'></div>';

                //if($h<($campos["numcampos"]-1))
                	//$texto.=generar_condicion('f@nombre__'.$h);

                $texto.='</div></fieldset><br>';
				//$adicional_ejecutor[]=" ".$campos[$h]["nombre"]."=iddatos_ejecutor ";
				$campos_especiales[]=$campos[$h]["nombre"]."@ejecutor";
               $ejecutores++;
              break;
			  case "textarea":
                $texto.='<div class="control-group"><b>'.$campos[$h]["etiqueta"].generar_comparacion($campos[$h]["tipo_dato"],"g@".$campos[$h]["nombre"]).'</b><div class="controls"><textarea '." $adicionales ".' id="'.$campos[$h]["nombre"].'" name="bqsaia_g@'.$campos[$h]["nombre"].'" '.$obligatorio.' style="width:500px;height:100px"></textarea>';

				if($h<($campos["numcampos"]-1))
                	$texto.=generar_condicion("g@".$campos[$h]["nombre"]);
                $texto.='</div></div>';

               $textarea++;
              break;
              default: //text
              	if($campos[$h]["etiqueta_html"]=="archivo"){
              		$archivo++;
              		//continue;
              	}
								if($campos[$h]["tipo_dato"]=="DATE"){
									$adicionales=str_replace("required","dateISO",$adicionales);
									$texto.='<div class="control-group"><label class="string control-label" style="font-size:9pt" for="'.$campos[$h]["nombre"].'"><b>'.$campos[$h]["etiqueta"].generar_comparacion("date","g@".$campos[$h]["nombre"]).'</b></label><div class="controls">
                   <input type="text" readonly="true" '.$adicionales.' name="bqsaia_g@'.$campos[$h]["nombre"].'" id="'.$campos[$h]["nombre"].'" tipo="fecha" value="">';
                  $texto.='<?php selector_fecha("'.$campos[$h]["nombre"].'","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?'.'></form>';
                  $fecha++;
								}
								else{
                	$texto.='<div class="control-group"><b>'.$campos[$h]["etiqueta"].generar_comparacion($campos[$h]["tipo_dato"],"g@".$campos[$h]["nombre"]).'</b><div class="controls"><input type="text" id="'.$campos[$h]["nombre"].'" name="bqsaia_g@'.$campos[$h]["nombre"].'">';
								}
                if($h<($campos["numcampos"]-1))
                	$texto.=generar_condicion("g@".$campos[$h]["nombre"]);

                $texto.='</div></div>';
              break;
        }
       }
      array_push($listado_campos,"'".$campos[$h]["nombre"]."'");
    }
    $tablas_adicionales=Null;
//if($ejecutores>0){
	//$tablas_adicionales[0]=" datos_ejecutor e ";
	//$tablas_adicionales[1]=" ejecutor f ";
	$tablas_adicionales[2]=" ".$formato[0]["nombre_tabla"]." g ";
	$where_adicional.=" g.documento_iddocumento=iddocumento ";
//}
if($archivo>0){
	//$tablas_adicionales[2]=" anexos g ";
	//$where_adicional.=" AND g.documento_iddocumento=iddocumento ";
}
if($arboles>0||$ejecutores>0){
	$texto.='<input type="hidden" name="campos_especiales" value="'.implode(",",$campos_especiales).'">';
}
if($tablas_adicionales){
	$tablas_adicionales=array_merge($tablas_adicionales);
	$texto.='<input type="hidden" name="filtro_adicional" id="filtro_adicional" value="'.implode(",",$tablas_adicionales).'@ AND '.$where_adicional.'">';
}
//die();
//******************************************************************************************
    $wheref="(A.formato LIKE '".$idformato."' OR A.formato LIKE '%,".$idformato.",%' OR A.formato LIKE '%,".$idformato."' OR A.formato LIKE '".$idformato.",%') AND A.acciones LIKE '%".strtolower($accion[0])."%' ";
    /*if(count($listado_campos)){
      $wheref.="AND nombre_funcion NOT IN(".implode(",",$listado_campos).")";
    }*/
    $funciones=busca_filtro_tabla("*","funciones_formato A",$wheref," idfunciones_formato asc",$conn);
    //print_r($funciones);
    //die();
    for($i=0;$i<$funciones["numcampos"];$i++)
    {
         $ruta_orig="";
         //saco el primer formato de la lista de la funcion (formato inicial)
         $formato_orig=explode(",",$funciones[$i]["formato"]);
         //si el formato actual es distinto del formato inicial
         if($formato_orig[0]!=$idformato)
           {//busco el nombre del formato inicial
            $dato_formato_orig=busca_filtro_tabla("nombre","formato","idformato=".$formato_orig[0],"",$conn);
            if($dato_formato_orig["numcampos"])
                {
                 //si el archivo existe dentro de la carpeta del archivo inicial
                 if(is_file($dato_formato_orig[0]["nombre"]."/".$funciones[$i]["ruta"]))
                    {$includes.=incluir("../".$dato_formato_orig[0]["nombre"]."/".$funciones[$i]["ruta"],"librerias");
                    }
                 elseif(is_file($funciones[$i]["ruta"]))
                    {//si el archivo existe en la ruta especificada partiendo de la raiz
                     $includes.=incluir("../".$funciones[$i]["ruta"],"librerias");
                    }
                 else//si no existe en ninguna de las dos
                    {//trato de crearlo dentro de la carpeta del formato actual
                     if(crear_archivo($formato[0]["nombre"]."/".$funciones[$i]["ruta"]))
                        {
                          $includes.=incluir($funciones[$i]["ruta"],"librerias");
                        }
                     else alerta("No es posible generar el archivo ".$formato[0]["nombre_tabla"]."/".$funciones[$i]["ruta"]);
                    }
                }
           }
        else //$ruta_orig=$formato[0]["nombre"];
           {//si el archivo existe dentro de la carpeta del formato actual
                 if(is_file($formato[0]["nombre"]."/".$funciones[$i]["ruta"]))
                    {$includes.=incluir($funciones[$i]["ruta"],"librerias");
                    }
                 elseif(is_file($funciones[$i]["ruta"]))
                    {//si el archivo existe en la ruta especificada partiendo de la raiz
                     $includes.=incluir("../".$funciones[$i]["ruta"],"librerias");
                    }
                 else//si no existe en ninguna de las dos
                    {//trato de crearlo dentro de la carpeta del formato actual
                     if(crear_archivo($formato[0]["nombre"]."/".$funciones[$i]["ruta"]))
                        {
                          $includes.=incluir($funciones[$i]["ruta"],"librerias");
                        }
                     else alerta("No es posible generar el archivo ".$formato[0]["nombre_tabla"]."/".$funciones[$i]["ruta"]);

                    }
           }
       if(!in_array($funciones[$i]["nombre_funcion"],$fun_campos))
         {$parametros="$idformato,NULL";
          $texto.=arma_funcion($funciones[$i]["nombre_funcion"],$parametros,$accion);
         }
    }
    //******************************************************************************************
    $campo_descripcion = busca_filtro_tabla("","campos_formato","formato_idformato=".$idformato." AND acciones LIKE '%p%'","",$conn);
    $valor1=extrae_campo($campo_descripcion,"idcampos_formato","U");
    $valor=implode(",",$valor1);
    if($formato[0]["detalle"]){
      $texto.='<input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?'.'>">';
      $texto.='<input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?'.'>">';
      //Aqui va el tema de crear los formatos hijos
    }
    if($formato[0]["item"]){
      $texto.='<input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?'.'>"><input type="hidden" name="formato" value="'.$formato[0]["nombre"].'">';
      //Aqui va el tema de crear los formatos hijos
    }
    if($archivo)
    /*Se debe tener especial cuidado con los campos con doble guion bajo ya que se muestra asi para evitar que un funcionario pueda seleccionar un campo con el mismo nombre*/
    $texto.='<input type="hidden" name="adicionar_consulta" value="1">
     <?php if(@$_REQUEST["campo__retorno"]){ ?'.'>
                <input type="hidden" name="campo__retorno" value="<?php echo($_REQUEST["campo__retorno"]); ?'.'>">
              <?php }
               if(@$_REQUEST["formulario__retorno"]){ ?'.'>
                <input type="hidden" name="formulario__retorno" value="<?php echo($_REQUEST["formulario__retorno"]); ?'.'>">
              <?php }
                if(@$_REQUEST["pagina__retorno"]){ ?'.'>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_REQUEST["pagina__retorno"]); ?'.'>">
             <?php  }
              else{ ?'.'>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_SERVER["PHP_SELF"]); ?'.'>">
             <?php  } ?'.'>';
    $texto.='</body>';
    if($fecha){
      $includes.=incluir("../../calendario/calendario.php","librerias");
			$texto.='<input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|'.implode(",",$datos_fecha).'">';
    }
    if($textareas){
      $includes.=incluir_libreria("header_formato.php","librerias");
    }

    if($autocompletar){
      $includes.=incluir("../librerias/autocompletar.js","javascript");
    }
    if($dependientes>0){
      $includes.=incluir("../librerias/dependientes.js","javascript");
    }
    /*$componente_busqueda=busca_filtro_tabla("","busqueda_componente","nombre='".$formato[0]["nombre_tabla"]."'","",$conn);
    if($componente_busqueda["numcampos"]){
      $componente=$componente_busqueda[0]["idbusqueda_componente"];
    }
    else{
      $llaves=array();
      $valores=array();
      $campos_excluidos=array("idbusqueda_componente","busqueda_idbusqueda","campos_adicionales","tablas_adicionales","nombre","etiqueta");
      $busqueda=busca_filtro_tabla("","busqueda","nombre='formatos_generados'","",$conn);
      $info=busca_filtro_tabla("","busqueda_componente","nombre='listado_documentos'","",$conn);
      foreach($info[0] AS $key=>$valor){
        if(!is_numeric($key) && !in_array($key,$campos_excluidos)){
        	if($key=="info"){
        		array_push($valores,addslashes($valor));
          		array_push($llaves,$key);
        	}
			else{
				array_push($valores,$valor);
          		array_push($llaves,$key);
			}
        }
      }
      array_push($llaves,"busqueda_idbusqueda");
      array_push($valores,$busqueda[0]["idbusqueda"]);
      array_push($llaves,"campos_adicionales");
      array_push($valores,str_replace("'","","Y.".implode(",Y.",$listado_campos)));
      array_push($llaves,"tablas_adicionales");
      array_push($valores,$formato[0]["nombre_tabla"]." Y");
      array_push($llaves,"nombre");
      array_push($valores,$formato[0]["nombre_tabla"]);
      array_push($llaves,"etiqueta");
      array_push($valores,$formato[0]["etiqueta"]);
      $sql2="INSERT INTO busqueda_componente(".implode(",",$llaves).") VALUES('".implode("','",$valores)."')";
      phpmkr_query($sql2);
      $componente=phpmkr_insert_id();
    }
	if($componente){
		$enlace_busqueda=busca_filtro_tabla("","busqueda_condicion A","fk_busqueda_componente=".$componente,"",$conn);
		if($enlace_busqueda["numcampos"]==0){
			$sql3="INSERT INTO busqueda_condicion (fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES(".$componente.", 'Y.documento_iddocumento=A.iddocumento {*filtrar_serie_buzon@funcionario*}', '".$formato[0]["nombre_tabla"]."')";
			phpmkr_query($sql3);
			$enlace_bus=phpmkr_insert_id();
		}
	}
    $texto.='<input type="hidden" name="idbusqueda_componente" value="'.$componente.'">';*/

    $contenido=$includes.$enmascarar.$texto;
    $mostrar=crear_archivo($formato[0]["nombre"]."/buscar_".$formato[0]["nombre"]."2.php",$contenido);

    if($mostrar<>"")
      alerta("Formato Creado con exito por favor verificar la carpeta ".dirname($mostrar));
  }
  else
    alerta("No es posible generar el Formato");
}
/*<Clase>
<Nombre>generar_condicion</Nombre>
<Parametros>$nombre:nombre del campo</Parametros>
<Responsabilidades>Crea un select para que se pueda elegir si la condici?n sobre el campo especificado es de obligatorio cumplimiento en la busqueda o no<Responsabilidades>
<Notas>usado para la pantalla de busqueda del formato</Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function generar_condicion($nombre){
$texto='<div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor(\'bqsaiaenlace_'.$nombre.'\',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor(\'bqsaiaenlace_'.$nombre.'\',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_'.$nombre.'" id="bqsaiaenlace_'.$nombre.'" value="y" />
		</div>';
return($texto);
}
/*<Clase>
<Nombre>generar_comparacion</Nombre>
<Parametros>$tipo:tipo de campo sobre el que se va a hacer la comparacion;$nombre:nombre del campo</Parametros>
<Responsabilidades>genera un listado con las opciones de comparaci?n posibles seg?n el tipo de campo<Responsabilidades>
<Notas>usado para la pantalla de busqueda del formato</Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function generar_comparacion($tipo,$nombre){
$texto='';
$listado=array();
switch($tipo){
  case "INT":
    $texto='<input type="hidden" name="bksaiacondicion_'.$nombre.'" id="bksaiacondicion_'.$nombre.'" value="=">';
  break;
  case "arbol":
    $texto='<input type="hidden" name="bksaiacondicion_'.$nombre.'" id="bksaiacondicion_'.$nombre.'" value="like">';
  break;
	case "date":
		$texto='<input type="hidden" name="bksaiacondicion_'.$nombre.'" id="bksaiacondicion_'.$nombre.'" value="date">';
  break;
	case "datetime":
		$texto='<input type="hidden" name="bksaiacondicion_'.$nombre.'" id="bksaiacondicion_'.$nombre.'" value="datetime">';
  break;
  default:
    $texto='<input type="hidden" name="bksaiacondicion_'.$nombre.'" id="bksaiacondicion_'.$nombre.'" value="like_total">';
  break;
}
return($texto);
}
/*<Clase>
<Nombre></Nombre>
<Parametros>cad:cadena con las rutas relativas de los archivos a incluir separadas por comas;
tipo:Tipo de libreria a incluir librerias->php, javascript->js,estilos->css;
eval:Si debe crear el archivo o no</Parametros>
<Responsabilidades>Genera la cadena que se necesita incluir los archivos especificados<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida>Cadena de texto</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function incluir($cad,$tipo,$eval=0){
global $incluidos;
  $includes="";
  $lib=explode(",",$cad);
  switch($tipo){
    case "librerias":
      $texto1='<?php include_once("';
      $texto2='"); ?'.'>';
    break;
    case "javascript":
      $texto1='<script type="text/javascript" src="';
      $texto2='"></script>';
    break;
    case "estilos":
      $texto1='<link rel="stylesheet" type="text/css" href="';
      $texto2='"/>';
    break;
    default:
      return(""); //retorna un vacio si no existe el tipo
    break;
  }
  for($j=0;$j<count($lib);$j++){
    $includes.=$texto1.$lib[$j].$texto2;
    array_push($incluidos,$texto1.$lib[$j].$texto2);
  }
return($includes);
}
/*<Clase>
<Nombre>incluir_libreria</Nombre>
<Parametros>$nombre:nombre del archivo;$tipo:tipo de archivo php, js, css</Parametros>
<Responsabilidades>Crea la cadena necesaria para incluir un archivo que se encuentre en la carpeta formatos/librerias<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function incluir_libreria($nombre,$tipo){
$includes="";
  if(!is_file("librerias/".$nombre)){
    if(crear_archivo("librerias/".$nombre)){
      $includes.=incluir("../librerias/".$nombre,$tipo);
    }
    else alerta("No es posible generar el archivo ".$nombre);
  }
  else $includes.=incluir("../librerias/".$nombre,$tipo);
return($includes);
}
/*<Clase>
<Nombre>arma_funcion</Nombre>
<Parametros>$nombre:nombre de la funci?n;$parametros:parametros que se le deben pasar;$accion:formato al cual corresponde (adicionar,editar,buscar)</Parametros>
<Responsabilidades>Crea la cadena de texto necesaria para hacer el llamado a la funci?n especificada<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function arma_funcion($nombre,$parametros,$accion){
if($parametros<>"" && $accion<>"adicionar" && $accion!='buscar')
   $parametros.=",";
if($accion=="mostrar")
  $texto="<?php ".$nombre."(".$parametros."$"."_REQUEST['iddoc']);? >";
elseif($accion=="adicionar")
  $texto="<?php ".$nombre."(".$parametros.");? >";
elseif($accion=="editar")
  $texto="<?php ".$nombre."(".$parametros."$"."_REQUEST['iddoc']);? >";
elseif($accion=="buscar" )
  $texto="<?php ".$nombre."(".$parametros.",'',1,'".$accion."');? >";
return($texto);
}
/*<Clase>
<Nombre>codifica</Nombre>
<Parametros>$texto:texto que se desea codificar</Parametros>
<Responsabilidades>llama la funci?n que pasa el texto a mayusculas y devuelve el nuevo texto modificado<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function codifica($texto)
{//strtoupper(codifica_encabezado(html_entity_decode($campos[$h]["etiqueta"].generar_comparacion($campos[$h]["tipo_dato"],$campos[$h]["nombre"]))))
 return mayusculas($texto);
}
?>
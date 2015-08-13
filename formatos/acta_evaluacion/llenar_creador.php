<?php session_start(); ?>
<?php ob_start(); ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
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
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."class_transferencia.php");
?>
<script type="text/javascript" src="js/jquery.js"></script>

       
        <script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
        <script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
        <link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css">
<?php

$ewCurSec = 0; // Initialise

// Initialize common variables
$x_idfuncionario = Null;
 $m=0;
$prueba = $_REQUEST["iddoc"];

// Get action
//if(($autorizacion[0]["encargado_inspeccion"]=="")||($contrato[0]["encargado_inspeccion"]=="")){



$sAction = @$_POST["a_add"];

if (($sAction == "") || ((is_null($sAction)))) {
    $sKey = @$_GET["key"];
    $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
    if ($sKey <> "") {
        $sAction = "C"; // Copy record
    }
    else
    {
        $sAction = "I"; // Display blank record
    }
}
else
{
$GLOBALS["x_prueba"] = @$_POST["prueba"];
$GLOBALS["x_recomendacion"]= @$_POST["recomendacion"];
$GLOBALS["x_forma_pago"]= @$_POST["forma_pago"];
$GLOBALS["x_plazo"]= @$_POST["plazo"];
$GLOBALS["x_valor"]= @$_POST["valor"];
$GLOBALS["x_interventor"] = @$_POST["interventor"];
    // Get fields from form
       

}

switch ($sAction)
{
    case "C": // Get a record to display
        if (!LoadData($sKey,$conn)) { // Load Record based on key
            $_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
            ob_end_clean();
            header("Location: funcionariolist.php");
            exit();
        }
        break;
    case "A": // Add
   
        if (AddData($conn,@$_POST["prueba"])) { // Add New Record
            $_SESSION["ewmsg"] = "Adici?n exitosa del registro.";
            ob_end_clean();
            //header("Location: devolucion_analisis.php");
            exit();
        }
        break;
}

?>
<?php include ("../../header.php");
$datos=busca_filtro_tabla("","ft_acta_evaluacion","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);

 ?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator   

//-->
</script>
<script type="text/javascript">
<!--


//-->
</script>
<script type="text/javascript" src="popcalendar.js"></script>


<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script><script type="text/javascript" src="../../js/jquery.validate2.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../js/jquery.spin.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />

<form name="funcionarioadd" id="funcionarioadd" action="llenar_creador.php" method="post" enctype="multipart/form-data" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<input type="hidden" name="EW_Max_File_Size" value="2000000">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
<tr>
                     <td class="encabezado" width="20%" title="">INTERVENTOR*</td>
                     <td bgcolor="#F5F5F5">	<br /><br />
<div id="treeboxbox_interventor"></div>	<input type="hidden" name="interventor" id="interventor"  class="required" obligatorio="obligatorio"  value="" >
  
  <script type="text/javascript">
  <!--		
			tree_interventor=new dhtmlXTreeObject("treeboxbox_interventor","100%","100%",0);
			tree_interventor.setImagePath("../../imgs/");
			tree_interventor.enableIEImageFix(true);
			tree_interventor.enableCheckBoxes(1);
			tree_interventor.enableRadioButtons(true);			
			tree_interventor.setXMLAutoLoading("../../test.php?rol=1");
			tree_interventor.loadXML("../../test.php?rol=1");
      tree_interventor.setOnCheckHandler(onNodeSelect_interventor);    
 
      /*function onNodeSelect_interventor(nodeId)
      {valor=document.getElementById("interventor");       
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
      document.getElementById("interventor").value=valor.value;
      }	*/
     function onNodeSelect_interventor(nodeId)
      {valor_destino=document.getElementById("interventor");
                       destinos=tree_interventor.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_interventor.getAllSubItems(vector[i]);
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
	--> 		
	</script>
  </td></tr></tr>
<tr>
                     <td class="encabezado" width="20%" title=""><b>RECOMENDACIÓN*</b></td>
                     <td class="celda_transparente"><textarea name="recomendacion"    obligatorio="obligatorio" class="required"   cols="53" rows="3" class="tiny_"><?php echo $datos[0]["recomendacion"];?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title=""><b>FORMA DE PAGO*</b></td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"   obligatorio="obligatorio" class="required"   type="text" size="100" id="forma_pago" name="forma_pago"  value="<?php echo $datos[0]["forma_pago"];?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title=""><b>PLAZO*</b></td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"   obligatorio="obligatorio" class="required"   type="text" size="100" id="plazo" name="plazo"  value="<?php echo $datos[0]["plazo"];?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title=""><b>VALOR*</b></td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"   obligatorio="obligatorio" class="required"   type="text" size="100" id="valor" name="valor"  value="<?php echo $datos[0]["valor"];?>"></td>
                    </tr>
                    
    <input type="hidden" name="prueba" value="<?php echo htmlspecialchars($prueba ); ?>">
               

</table>
<p>
<input type="submit" name="Action" value="Adicionar">
</form>
<?php include ("../../footer.php") ?>

<?php

//-------------------------------------------------------------------------------
function AddData($conn,$prueba)
{  
  $id=$GLOBALS["x_prueba"];

/*
 if($GLOBALS["x_juridico"]!=""){
$juridico=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$GLOBALS["x_juridico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);

$fieldList["nombre"] = 'TRANSFERIDO';
$fieldList["fecha"] = date("Y-m-d H:i:s");
$fieldList["notas"] ="Reasignacion evaluador juridico";
$fieldList["ver_notas"] = 1;
$fieldList["tipo_destino"] = 1;
$fieldList["archivo_idarchivo"] = $id;
$fieldList["origen"] = usuario_actual("funcionario_codigo");
$datos_adicionales["notas"]="'".$fieldList["notas"]."'";

$destinos=array($juridico[0]["funcionario_codigo"]);
transferir_archivo_prueba($fieldList,$destinos,$datos_adicionales);
$sql="update ft_acta_evaluacion set evaluador_juridico=".$GLOBALS["x_juridico"]." where documento_iddocumento=".$id;

phpmkr_query($sql);
 }else{ */
 
  
  $recomendacion="'".$GLOBALS["x_recomendacion"]."'";
  $forma_pago="'".$GLOBALS["x_forma_pago"]."'";
  $plazo="'".$GLOBALS["x_plazo"]."'";
  $valor="'".$GLOBALS["x_valor"]."'";  
  $interventor="'".$GLOBALS["x_interventor"]."'"; 
  $sql="update ft_acta_evaluacion set valor=".$valor.",plazo=".$plazo.",forma_pago=".$forma_pago.",recomendacion=".$recomendacion.",interventor=".$interventor." where documento_iddocumento=".$id;
  
  phpmkr_query($sql);
$consulta=busca_filtro_tabla("","ft_acta_evaluacion","documento_iddocumento=".$id,"",$conn); 
if($consulta[0]["aprobacion_tecnico"]=='APROBADO' && $consulta[0]["aprobacion_economico"]=='APROBADO' && $consulta[0]["aprobacion_juridico"]=='APROBADO'){  

$fieldList["nombre"] = 'TRANSFERIDO';
$fieldList["fecha"] = date("Y-m-d H:i:s");
$fieldList["notas"] ="";
$fieldList["ver_notas"] = 1;
$fieldList["tipo_destino"] = 1;
$fieldList["archivo_idarchivo"] = $id;
$fieldList["origen"] = usuario_actual("funcionario_codigo");
$datos_adicionales["notas"]="'".$fieldList["notas"]."'";
$logistica=42109698;
$destinos=array($logistica);

transferir_archivo_prueba($fieldList,$destinos,'');
}
//}
  echo '<script>
          window.parent.history.go(0);
          window.parent.hs.close();
          </script>';  


}
?>

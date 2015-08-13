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
<script type="text/javascript" src="../../js/jquery.js"> </script>
<script type="text/javascript" src="../../js/jquery.validate.js"></script>
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
$GLOBALS["x_aspectos_tecnicos"]= @$_POST["aspectos_tecnicos"];
$GLOBALS["x_conclusion_tecnica"]= @$_POST["conclusion_tecnica"];
$GLOBALS["x_tecnico"] = @$_POST["evaluador_tecnico"];
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
include_once("../librerias/funciones_generales.php"); 
include_once("../librerias/funciones_acciones.php"); 
include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script><script type="text/javascript" src="../../js/jquery.validate2.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../js/jquery.spin.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />

<form name="funcionarioadd" id="funcionarioadd" action="llenar_tecnico.php" method="post" enctype="multipart/form-data" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<input type="hidden" name="EW_Max_File_Size" value="2000000">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">

<tr>
        <td class="encabezado_list" title="Aspectos tecnicos."><span class="phpmaker" style="color: #FFFFFF;">ASPECTOS TECNICOS*</span></td>
        <td bgcolor="#F5F5F5"><span class="phpmaker">
<textarea name="aspectos_tecnicos" rows="10" cols="30" class="required" ><?php echo $datos[0]["aspectos_tecnicos"];?></textarea>

</span></td>
    </tr>
    <tr>
        <td class="encabezado_list" title="conclusion tecnica."><span class="phpmaker" style="color: #FFFFFF;">CONCLUSION TECNICA*</span></td>
        <td bgcolor="#F5F5F5"><span class="phpmaker">
<textarea name="conclusion_tecnica" rows="10" cols="30" class="required"><?php echo $datos[0]["conclusion_tecnica"];?></textarea>

</span></td>
    </tr>
    <tr>
                     <td class="encabezado" width="20%" title=""><b>REASIGNAR EVALUADOR TECNICO*</b></td>
                     <td bgcolor="#F5F5F5">    <br /><br />
<div id="treeboxbox_evaluador_tecnico"></div>    <input type="hidden" name="evaluador_tecnico" id="evaluador_tecnico"  class="required" obligatorio="obligatorio"  value="" >
 
  <script type="text/javascript">
  <!--       
            tree_evaluador_tecnico=new dhtmlXTreeObject("treeboxbox_evaluador_tecnico","100%","100%",0);
            tree_evaluador_tecnico.setImagePath("../../imgs/");
            tree_evaluador_tecnico.enableIEImageFix(true);
            tree_evaluador_tecnico.enableCheckBoxes(1);
            tree_evaluador_tecnico.enableRadioButtons(true);           
            tree_evaluador_tecnico.setXMLAutoLoading("../../test.php?rol=1");
            tree_evaluador_tecnico.loadXML("../../test.php?rol=1");
      tree_evaluador_tecnico.setOnCheckHandler(onNodeSelect_evaluador_tecnico);   

      /*function onNodeSelect_evaluador_tecnico(nodeId)
      {valor=document.getElementById("evaluador_tecnico");      
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
      document.getElementById("evaluador_tecnico").value=valor.value;
      }    */
     function onNodeSelect_evaluador_tecnico(nodeId)
      {valor_destino=document.getElementById("evaluador_tecnico");
                       destinos=tree_evaluador_tecnico.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(","); 
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_evaluador_tecnico.getAllSubItems(vector[i]);
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
  </td></tr>
    <input type="hidden" name="prueba" value="<?php echo htmlspecialchars($prueba ); ?>">
               

</table>
<p>
<table border="0" align="center">
<tr><td align="center"><input type="submit" name="Action" value="Adicionar"></td></tr>
</table>
</form>

<?php include ("../../footer.php") ?>

<?php

//-------------------------------------------------------------------------------
function AddData($conn,$prueba)
{  
$id=$GLOBALS["x_prueba"];

 if($GLOBALS["x_tecnico"]!=""){
$tecnico=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$GLOBALS["x_tecnico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);

$fieldList["nombre"] = 'TRANSFERIDO';
$fieldList["fecha"] = date("Y-m-d H:i:s");
$fieldList["notas"] ="Reasignacion evaluador tecnico";
$fieldList["ver_notas"] = 1;
$fieldList["tipo_destino"] = 1;
$fieldList["archivo_idarchivo"] = $id;
$fieldList["origen"] = usuario_actual("funcionario_codigo");
$datos_adicionales["notas"]="'".$fieldList["notas"]."'";

$destinos=array($tecnico[0]["funcionario_codigo"]);
transferir_archivo_prueba($fieldList,$destinos,$datos_adicionales);
$sql="update ft_acta_evaluacion set evaluador_tecnico=".$GLOBALS["x_tecnico"]." where documento_iddocumento=".$id;

phpmkr_query($sql);
 }else{ 
 
  
  $aspectos_tecnicos="'".$GLOBALS["x_aspectos_tecnicos"]."'";
  $conclusion_tecnica="'".$GLOBALS["x_conclusion_tecnica"]."'";
 
    
  $sql="update ft_acta_evaluacion set aspectos_tecnicos=".$aspectos_tecnicos.", conclusion_tecnica=".$conclusion_tecnica.", aprobacion_tecnico='APROBADO' where documento_iddocumento=".$id;
 
  phpmkr_query($sql);
  $consulta=busca_filtro_tabla("","ft_acta_evaluacion","documento_iddocumento=".$id,"",$conn);
$economico=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consulta[0]["evaluador_economico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
if($consulta[0]["aprobacion_tecnico"]=='APROBADO'){
$fieldList["nombre"] = 'TRANSFERIDO';
$fieldList["fecha"] = date("Y-m-d H:i:s");
$fieldList["notas"] ="";
$fieldList["ver_notas"] = 1;
$fieldList["tipo_destino"] = 1;
$fieldList["archivo_idarchivo"] = $id;
$fieldList["origen"] = usuario_actual("funcionario_codigo");
$datos_adicionales["notas"]="'".$fieldList["notas"]."'";
$destinos=array($economico[0]["funcionario_codigo"]);
transferir_archivo_prueba($fieldList,$destinos,'');
 } 
 }

 echo '<script>
          window.parent.history.go(0);
          window.parent.hs.close();
          </script>'; 

}
?>

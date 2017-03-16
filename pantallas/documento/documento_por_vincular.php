<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
if($_REQUEST["iddocumento"]){   
$usuario=usuario_actual("idfuncionario");
$seleccionados=busca_filtro_tabla("","documento_por_vincular","documento_iddocumento=".$_REQUEST["iddocumento"]." AND funcionario_idfuncionario=".$usuario,"",$conn);
$documento=busca_filtro_tabla("","documento","iddocumento=".$_REQUEST["iddocumento"],"",$conn);
if($documento["numcampos"]){
  if(!$seleccionados["numcampos"] ){
    $sql2="INSERT INTO documento_por_vincular(documento_iddocumento,funcionario_idfuncionario,fecha) VALUES(".$_REQUEST["iddocumento"].",".$usuario.",".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").")";
    phpmkr_query($sql2);    
    $mensaje="El documento con <b>No Radicado:".$documento[0]["numero"]."</b><br />  Descripci&oacute;n: ".$documento[0]["descripcion"]." <br />SE HA ADICIONADO A LOS DOCUMENTOS PENDIENTES POR VINCULAR ";
  }
  else{
     $mensaje="El documento con <b>No Radicado:".$documento[0]["numero"]."</b> <br /> Descripci&oacute;n: ".$documento[0]["descripcion"]."  <br />YA SE ENCUENTRA EN LOS DOCUMENTOS PENDIENTES POR VINCULAR ";
  }  
  
}
else{
  $mensaje="El documento con ID:".$_REQUEST["iddocumento"]." <br />NO SE HA PODIDO VINCULAR Por favor comuniquese con su administrador";
}
}
?>
<script type="text/javascript">
top.noty({text: "<?php echo($mensaje);?>",type: 'success',layout: "topCenter",timeout:3500});
//window.open("<?php echo($ruta_db_superior);?>documentoview.php?key=<?php echo($_REQUEST['iddocumento']);?>","_self");

</script>
<?php 
volver(1);
?>
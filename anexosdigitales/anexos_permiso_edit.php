<?php
include_once("../db.php");
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

if (isset($_REQUEST["editar_anexo"])) {
  global $conn;
$info=busca_filtro_tabla("","anexos","idanexos=".$_REQUEST["idanexo"],"",$conn);
 $ruta_nueva=$ruta_db_superior.$info[0]["ruta"];
    if (is_file($_FILES['anexo']['tmp_name'])) {
   $ext1 = explode(".",$_FILES['anexo']['name']);
   $nombre = explode("anexos/",$info[0]["ruta"]);
   $ext2 = explode(".",$nombre[1]);
   $info[0]["ruta"] = $nombre[0]."anexos/".$ext2[0].".".$ext1[1];
  
  $carpeta_eliminados=RUTA_BACKUP_ELIMINADOS.$info[0]["documento_iddocumento"];
   crear_destino($ruta_db_superior.$carpeta_eliminados);
  $nombre=$carpeta_eliminados."/".date("Y-m-d_H_i_s")."_".$info[0]["etiqueta"];
   //copio el anterior a eliminados
   rename($ruta_db_superior.$info[0]["ruta"],$ruta_db_superior.$nombre);
   //reemplazo el anterior por el nuevo
   rename($_FILES['anexo']['tmp_name'],$ruta_db_superior.$info[0]["ruta"]);
   chmod($ruta_db_superior.$dir_anexos.$temp_filename,0777);
   $x_detalle= "Identificador: ".$info[0]["idanexos"]." ,Nombre: ".$info[0]["etiqueta"];
   registrar_accion_digitalizacion($info[0]["documento_iddocumento"],'EDICION ANEXO',$x_detalle);
   
   $sql = "UPDATE anexos SET ruta='".$info[0]["ruta"]."', etiqueta='".$_FILES['anexo']['name']."', tipo='".$ext1[1]."' WHERE idanexos=".$_REQUEST["idanexo"];
   
   phpmkr_query($sql,$conn);
   alerta("Anexo editado.",'success',4000);
        //echo "<script>window.parent.hs.close();</script>";
  }  
} elseif($_REQUEST["idanexo"]) {
?>

<link href="<?php echo $ruta_db_superior;?>dropzone/dist/dropzone.css" type="text/css" rel="stylesheet" />

<script src="<?php echo $ruta_db_superior;?>dropzone/dist/dropzone.js"></script>

<b>Editar Anexo</b><br /><br />
<form id="reemplazo_anexo" name="form1" action="anexos_permiso_edit.php" method="POST" class="dropzone" enctype="multipart/form-data">
<!-- <input type="file" name="anexo"> -->
<input type="hidden" name="idanexo" value="<?php echo $_REQUEST["idanexo"]?>">
<!-- <input type="submit" value="Reemplazar archivo">  -->
<input type="hidden" value="1" name="editar_anexo">

	<div class="dz-message"><span>Reemplazar archivo</span></div>

</form>

<script>

Dropzone.options.reemplazoAnexo = {
	paramName: "anexo",
	uploadMultiple: false,
	success: function(file, response) {
        window.parent.hs.close();
        //window.parent.location.reload();
	},
};
</script>
<?php
}
?>

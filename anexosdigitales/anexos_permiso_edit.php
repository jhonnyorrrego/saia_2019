<?php
include_once("../db.php");
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";

while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("idanexo");
include_once($ruta_db_superior."librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());

if (isset($_REQUEST["editar_anexo"])) {
  global $conn;
$info=busca_filtro_tabla("","anexos","idanexos=".$_REQUEST["idanexo"],"",$conn);
 $ruta_nueva=$ruta_db_superior.$info[0]["ruta"];
	if (is_file($_FILES['anexo']['tmp_name'])) {
   $ext1 = explode(".",$_FILES['anexo']['name']);

		$arr_origen = StorageUtils::resolver_ruta($info[0]["ruta"]);

		$nombre = explode("anexos/", $arr_origen["ruta"]);
   $ext2 = explode(".",$nombre[1]);
  
		//INICIO
		// hago copia del archivo en la carpeta backup/eliminados
		$alm_eliminados = new SaiaStorage(RUTA_BACKUP_ELIMINADOS);

		$carpeta_eliminados = $info[0]["documento_iddocumento"];
		$nombre_bk = $carpeta_eliminados . "/" . date("Y-m-d_H_i_s") . "_" . $info[0]["etiqueta"];

		$alm_origen = $arr_origen["clase"];

		if ($alm_origen->get_filesystem()->has($arr_origen["ruta"])) {
			$resultado=$alm_origen->copiar_contenido($alm_eliminados, $arr_origen["ruta"], $nombre_bk);
			$alm_origen->get_filesystem()->delete($arr_origen["ruta"]);
		}
		//FIN

		$nueva_ruta = $nombre[0] . "anexos/" . $ext2[0] . "." . $ext1[1];

		$alm_origen->copiar_contenido_externo($_FILES['anexo']['tmp_name'], $nueva_ruta);

   $x_detalle= "Identificador: ".$info[0]["idanexos"]." ,Nombre: ".$info[0]["etiqueta"];
   registrar_accion_digitalizacion($info[0]["documento_iddocumento"],'EDICION ANEXO',$x_detalle);
   
		$ruta = array("servidor" => $arr_origen["servidor"], "ruta" => $nueva_ruta);
		$sql = "UPDATE anexos SET ruta='" . json_encode($ruta) . "', etiqueta='" . $_FILES['anexo']['name'] . "', tipo='" . $ext1[1] . "' WHERE idanexos=" . $_REQUEST["idanexo"];
		/*
		 * print_r($sql);
		 * die();
		 */
   
   phpmkr_query($sql,$conn);
   alerta("Anexo editado.",'success',4000);
   echo "<script>window.parent.hs.close();</script>";
  }  
} elseif ($_REQUEST["idanexo"]) {
?>
<b>Editar Anexo</b>
<br />
<br />
<form name="form1" id="form1" method="POST" enctype="multipart/form-data">
<input type="file" name="anexo">
<input type="hidden" name="idanexo" value="<?php echo $_REQUEST["idanexo"]?>">
<input type="submit" value="Reemplazar archivo">
<input type="hidden" value="1" name="editar_anexo">
</form>
<?php
encriptar_sqli("form1",1,"form_info",$ruta_db_superior);
}
?>

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
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("idnoticia_index");
desencriptar_sqli('form_info');

/* -------------------------  ADICIONAR ------------------------ */


if(isset($_REQUEST['adicionar2'])){

	$ejecutar=true;
	//comprobamos si ha ocurrido un error.
	if ($_FILES["imagen_modulo"]["error"] > 0){
		$ejecutar=false;
		echo "error al subir la imagen, intenta con otra diferente";
	} else {
		//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
		$permitidos = array("image/png","image/jpg","image/jpeg");
		if (in_array($_FILES['imagen_modulo']['type'], $permitidos)){
			//esta es la ruta donde copiaremos la imagen_modulo
			//recuerden que deben crear un directorio con este mismo nombre
			//en el mismo lugar donde se encuentra el archivo subir.php
			//$ruta = $ruta_db_superior.RUTA_NOTICIA_IMAGENES;
			require_once $ruta_db_superior . 'StorageUtils.php';
			require_once $ruta_db_superior . 'filesystem/SaiaStorage.php';
			
			$ruta=RUTA_NOTICIA_IMAGENES;
			$tipo_almacenamiento = new SaiaStorage("archivos");
			
			//comprovamos si este archivo existe para cambiar el nombre.
			$nombre_extension = basename($_FILES['imagen_modulo']['name']);
			$vector_nombre_extension = explode('.',$nombre_extension);
			$extencion=$vector_nombre_extension[(count($vector_nombre_extension)-1)];
			$nombre_imagen=$vector_nombre_extension[0];
		
			if($tipo_almacenamiento->get_filesystem()->has($ruta.$_FILES["imagen_modulo"]["name"])){
				$tmpVar = 1;
				while($tipo_almacenamiento->get_filesystem()->has($ruta.$nombre_imagen.'_'.$tmpVar.'.'.$extencion)){
					$tmpVar++;
				}
				$nombre_imagen=$nombre_imagen . '_' . $tmpVar;	
			}
			$ruta.=$nombre_imagen.'.'.$extencion;
			$ruta_anexos = array("servidor" => $tipo_almacenamiento->get_ruta_servidor(), "ruta" => $ruta);	
			$ruta_anexos=json_encode($ruta_anexos);
				
			if (!$tipo_almacenamiento->get_filesystem()->has($ruta)){
				//aqui movemos el archivo desde la ruta temporal a nuestra ruta
				$resultado = $tipo_almacenamiento->almacenar_recurso($ruta, $_FILES["imagen_modulo"]["tmp_name"], false);
				unlink($_FILES["imagen_modulo"]["tmp_name"]);
			} else {
				$ejecutar=false;
				echo "La imagen ".$_FILES['imagen_modulo']['name']." ya existe en el servidor, La imagen debe tener otro nombre";
			}
		} else {
				$ejecutar=false;
				echo "Solo se permite imagen PNG con fondo transparente";
		}
	
		if($ejecutar==true){
			$fecha=fecha_db_almacenar(date('Y-m-d'),'Y-m-d');
			$previo=substr($_REQUEST['noticia'], 0,200);
			$sql="INSERT INTO noticia_index (noticia,previo,imagen,titulo,subtitulo,fecha) values ('".$_REQUEST['noticia']."','".$previo."','".$ruta_anexos."','".$_REQUEST['titulo']."','".$_REQUEST['subtitulo']."','".$fecha."')";
			phpmkr_query($sql);
			echo "Noticia adicionada satisfactoriamente";  
		}				
	}
	

}

/* -------------------------  CHECKBOX MOSTRAR O NO ------------------------ */

if(isset($_REQUEST['mostrar'])){

	$mensaje='';
	$retorno=0;
	
	$noticia_puntual=busca_filtro_tabla('','noticia_index','estado=1 AND mostrar=1 AND idnoticia_index='.$_REQUEST['idnoticia_index'],'',$conn);
	
	if($noticia_puntual['numcampos']>0){
		
		$sql="UPDATE noticia_index SET mostrar=0 WHERE idnoticia_index=".$_REQUEST['idnoticia_index'];
		phpmkr_query($sql);
		$mensaje="Noticia desvinculada satisfactoriamente";  
		
		
	}else{
					
		$noticias=busca_filtro_tabla('','noticia_index','estado=1 AND mostrar=1','',$conn);
	
		if($noticias['numcampos']>=2){
			$mensaje='No se pueden seleccionar mas de 2 noticias';
			$retorno=2;
			
		}else{
			$sql="UPDATE noticia_index SET mostrar=1 WHERE idnoticia_index=".$_REQUEST['idnoticia_index'];
				phpmkr_query($sql);
				$mensaje="Noticia seleccionada satisfactoriamente";  
				
		}	
	}
	
	$vector=array('mensaje'=>$mensaje,'idnoticia_index'=>$_REQUEST['idnoticia_index'],'retorno'=>$retorno);
	echo(json_encode($vector));
}




/* -------------------------  ACTUALIZAR TITULO PRINCIPAL ------------------------ */

if(isset($_REQUEST['actualizar_titulo'])){
	
	$sql="UPDATE configuracion SET valor='".$_REQUEST['titulo']."' WHERE nombre='titulo_index' ";
	phpmkr_query($sql);
	echo($_REQUEST['titulo']);

}



/* -------------------------  ACTUALIZAR SUBTITULO PRINCIPAL ------------------------ */

if(isset($_REQUEST['actualizar_subtitulo'])){
	
	$sql="UPDATE configuracion SET valor='".$_REQUEST['subtitulo']."' WHERE nombre='subtitulo_index' ";
	phpmkr_query($sql);
	echo($_REQUEST['subtitulo']);

}


?>

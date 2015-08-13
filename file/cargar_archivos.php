<?php include ("../header.php") ?>
<form action="#" method="post" enctype="multipart/form-data" name="form1">
  <p align="center">Archivo
   <input name="archivo" type="file" id="archivo">
  </p>
  <p align="center"><input name="boton" type="submit" id="boton" value="Enviar"></p>
</form>
<?
if(isset($boton)&&$boton) {
    if (is_uploaded_file($HTTP_POST_FILES['archivo']['tmp_name'])) {
      copy($HTTP_POST_FILES['archivo']['tmp_name'], "../temporal/".$HTTP_POST_FILES['archivo']['name']);
      $subio = true;
    }

if($subio) {
    echo "El archivo subio con exito";
} else {
    echo "El archivo no cumple con las reglas establecidas";
}
//die("NO SU BIO");
}
?>

<?php include("../footer.php")?>

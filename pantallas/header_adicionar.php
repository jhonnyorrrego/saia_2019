<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
include_once($ruta_db_superior."db.php");
usuario_actual("login");
include_once($ruta_db_superior."librerias_saia.php");
$data_form_saia=null;
echo(estilo_bootstrap("3"));
?>
<meta http-equiv="X-UA-Compatible" content="IE=9">
<?php
echo(librerias_html5());
?>
<style type="text/css">
  label.error {
    font-weight: bold;
    color: red;
  }
</style>
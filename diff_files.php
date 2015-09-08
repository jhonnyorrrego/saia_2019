<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ( $max_salida > 0 ) {
    if (is_file ( $ruta . "db.php" )) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida --;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ace-diff - Demo #1</title>
<?php 

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo(estilo_bootstrap ());
echo(librerias_jquery("1.7"));
echo (librerias_principal());
echo (librerias_notificaciones ());
?>
    <script src="src/diff_match_patch.js"></script>

</head>
<body>

<div>
    <div id="left-editor"></div>
    <div id="gutter"></div>
    <div id="left-editor"></div>
</div>

<script src="src/ace.js"></script>
<script src="src/ace-diff.js"></script>
<script>
var differ = new AceDiff({
  mode: "ace/mode/javascript",
  left: {
    id: "left-editor",
    content: "your first file content here"
  },
  right: {
    id: "right-editor",
    content: "your second file content here"
  }
});
</script>

</body>
</html>
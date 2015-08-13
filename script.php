<?php
include_once("db.php");
global $conn;
$papa = busca_filtro_tabla("","modulo","nombre='menu_ordenar'","",$conn);

$sql = "INSERT INTO modulo (nombre, tipo, imagen, etiqueta, enlace, destino, cod_padre, orden, ayuda, parametros, busqueda_idbusqueda, permiso_admin) VALUES
('vincular_documento', 'secundario', 'botones/configuracion/default.gif', 'Vincular Documentos', 'vincular_documentoview.php?iddoc=@key@', 'centro', ".$papa[0]["idmodulo"].", 10, 'Permite buscar y vincular uno o varios documentos al doccumento actual.', '', 0, 0);";
echo $sql."<br><br>";
phpmkr_query($sql,$conn);

$sql = "CREATE TABLE IF NOT EXISTS documento_vinculados (
  iddocumento_vinculados int(11) NOT NULL auto_increment,
  documento_origen int(11) NOT NULL,
  documento_destino int(11) NOT NULL,
  fecha datetime NOT NULL,
  funcionario_idfuncionario int(11) NOT NULL,
  observaciones text character set latin1,
  PRIMARY KEY  (iddocumento_vinculados)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";
phpmkr_query($sql,$conn);
?>

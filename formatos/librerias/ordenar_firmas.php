<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

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
include_once($ruta_db_superior."header.php");
if(isset($_REQUEST["pantalla"])&&$_REQUEST["pantalla"]=="tiny")
{echo '<script type="text/javascript">
document.getElementById("header").style.display="none";
</script>';
}
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/interface.js"></script>
<style type="text/css"><!--
.lcampo
{
  cursor:move;
	padding: 2px 2px;
	border: 1px solid #ccc;
	background-color: #eee;
	list-style-type: none;
	width:400px;
}
	//-->
</style>
<?php
if(isset($_REQUEST["iddoc"])){
  $iddoc=$_REQUEST["iddoc"];
}
else $iddoc=0;
if(isset($_REQUEST["orden"])){
  $orden=$_REQUEST["orden"];
}
else $orden=0;

if($orden){
  $datos=explode("|",$orden);
  $cont=count($datos);
  for($i=0;$i<$cont;$i++){
    $sql="UPDATE ruta SET orden=".($i+1)." WHERE idruta=".$datos[$i];
    phpmkr_query($sql,$conn);
  }
redirecciona("ordenar_firmas.php?iddoc=".$iddoc);
}
$campos=busca_filtro_tabla("a.idruta,a.orden,b.nombres,b.apellidos","ruta a,funcionario b,dependencia_cargo dc","obligatorio>0 and iddependencia_cargo=origen and funcionario_idfuncionario=idfuncionario and documento_iddocumento=".$iddoc,"orden ASC",$conn);

$texto='';
if($campos["numcampos"]){
$texto.='<br /><br /><ul id="listacampos">';
for($i=0;$i<$campos["numcampos"];$i++){
  $texto.='<li class="lcampo" id="'.$campos[$i]["idruta"].'">'.$campos[$i]["orden"]."-".codifica_encabezado(strtoupper(html_entity_decode($campos[$i]["nombres"]." ".$campos[$i]["apellidos"]))).'</li>';
}
$texto.='</ul>';
if(isset($_REQUEST["pantalla"])&&$_REQUEST["pantalla"]=="tiny")
  $texto.='<input type="hidden" name="pantalla" value="tiny">
           <input type="button" value="Continuar" OnClick="salir_tiny()">';
else
  $texto.='<input type="button" value="Continuar" OnClick="salir()">';
echo($texto);
}
include_once("footer.php");
?>
<script language="JavaScript" type="text/javascript"><!--
$(document).ready(
	function () {
		$('#listacampos').Sortable(
			{
				accept : 		'lcampo',
				onchange : function (sorted) {
          ordenar();
        },
				opacity: 		0.8,
				fx:				200,
				axis:			'vertically',
				opacity:		0.4,
				revert:			true
			}
		)
	}
);
  function ordenar(){
    var lista="";
    /*Pilas que estas lineas son muy utiles para la serializacion del codigo */
    var serial= $.SortSerialize('listacampos');
    lista=serial.hash.replace(/listacampos\[\]=/gi, '').replace(/&/g, '|');
    ruta='ordenar_firmas.php?iddoc=<?php echo($_REQUEST["iddoc"]);?>&orden='+lista;
    window.open(ruta,'_self');
  }
  
  function salir(){
    serial = $.SortSerialize('listacampos');
    window.open('ordenar_firmas.php?iddoc=<?php echo($_REQUEST["iddoc"]);?>','_self');
  }
  
  function salir_tiny(){
    serial = $.SortSerialize('listacampos');
    ruta="../tinymce/jscripts/tiny_mce/plugins/formatos/formatos.php?iddoc=<?php echo $_REQUEST['iddoc']; ?>";
    window.open(ruta,'_self');
  }
	//-->
</script>

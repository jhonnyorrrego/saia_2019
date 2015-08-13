<?php   

session_start();
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
?>
<html>
	<head>
<?php
$texto='
<style>           
  #contenedor{
    border:1px solid blue;
    position:absolute;
    width:600px;
    height:370px;
    overflow:auto;
  }
  #imagen_flujo{
    position:absolute;
    border:1px solid;
    background-image:url('.@$imagen.'); height: '.@$datos_imagen[1].'px; width: '.@$datos_imagen[0].'px; border: 1px solid black;
  }
  .paso{
    background-color:red;
    position:absolute;
    border:1px solid red;
    opacity:0.4;
    filter:alpha(opacity=40);       
  }   
  ul {
  	padding: 0; 
    margin: 0 0 0 30 ;
  	float: left;
  	width: 100%;
  	list-style: none;
  	border-top: 1px solid #fff; /*--Gives the bevel feel on the panel--*/
  	font-size: 1.1em;
  }
  ul li{
  	padding: 0; margin: 0;
  	float: left;
  	position: relative;
  }
  ul li a{
  	padding: 5px;
  	float: left;
  	text-indent: -9999px;
  	height: 16px; width: 16px;
  	text-decoration: none;
  	color: #333;
  	position: relative;
  }
  html ul li a:hover{	background-color: #fff; }
  html ul li a.active { /*--Active state when subpanel is open--*/
  	background-color: #fff;
  	height: 17px;
  	margin-top: -2px; /*--Push it up 2px to attach the active button to subpanel--*/
  	border: 1px solid #555;
  	border-top: none;
  	z-index: 200; /*--Keeps the active area on top of the subpanel--*/
  	position: relative;
  }
  a.home{	
  	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/home.png) no-repeat center center;
  }
  a.profile{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/user.png) no-repeat center center;  }
   a.previo_paso{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/preview.jpg) no-repeat center center;  }
    a.siguiente_paso{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/next.jpg) no-repeat center center;  }
  a.contacts{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/address_book.png) no-repeat center center; }
  a.playlist{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/document_music_playlist.png) no-repeat center center; }
  a.cerrar_paso{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/close.png) no-repeat center center; }
  a.messages{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/mail.png) no-repeat center center; }
  a.editprofile{	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/wrench_screwdriver.png) no-repeat center center; }  
  a small {  /*--panel tool tip styles--*/
  	text-align: center;
  	width: 70px;
  	background: url('.$ruta_db_superior.'images/panel_inferior_pasos/pop_arrow.gif) no-repeat center bottom;
  	padding: 15px 5px 11px;
  	display: none; /*--Hide by default--*/
  	color: #fff;
  	font-size: 9px;
  	text-indent: 0;
  }
  a:hover small{
  	display: block; /*--Show on hover--*/
  	position: absolute;
  	top: 15px; /*--Position tooltip 35px above the list item--*/
  	left: 50%; 
  	margin-left: -40px; /*--Center the tooltip--*/
  	z-index: 9999;
  }
  ul li div a { /*--Reset link style for subpanel links--*/
  	text-indent: 0;
  	width: auto;
  	height: auto;
  	padding: 0;
  	float: none;
  	color: #00629a;
  	position: static;
  }
  ul li div a:hover {	text-decoration: underline; } /*--Reset link style for subpanel links--*/
</style>';

//echo($texto);

?>

<script type='text/javascript'>
    function abrir_menu_paso(id,boton){
      switch(boton){
        case 1:
          enlace='actividades_paso.php';
          titulo='Actividades';
        break;
        case 2:
          enlace='funcionarios_paso.php';
          titulo='Funcionarios';
        break; 
        case 3:
          enlace='mostrar_paso.php';
          titulo='Detalles';
        break; 
        case 4:
          enlace='configurar_paso.php';
          titulo='Configuracion';
        break; 
        case 5:
          enlace='comentarios_paso.php';
          titulo='Comentarios';
        break; 
        case 6:
          enlace='ojetos_paso.php';
          titulo='Objetos';
        break;
      }
      $.ajax({
        type:'POST',
        url:enlace,
        data:'idpaso='+id,
        success: function(datos,exito){
          $("#contenido_paso"+id).html(datos);
          $("#footer_paso"+id).html(titulo);
        }

      });  

    }

</script>
	</head>
	<body>
  <?php
	//Inicializo variables	
		$pasos = busca_filtro_tabla("","paso","idfigura=".$_REQUEST["figura"]." AND diagram_iddiagram=".$_SESSION['id_diagramaxxx'],"",$conn);

    echo substr(@$sel1[0]["descripcion"],0,150);
    if($pasos["numcampos"]){
    echo '<br>
    <a href="actividades_paso.php?idpaso='.$pasos[0]["idpaso"].'" class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 460, height:450,contentId:\'cuerpo_paso'.$pasos[$i]["idpaso"].'\'} )">Ver mas...</a>';
	}
	else{
      echo("<br />Es necesario Guardar para caracterizar el paso, Inicio y Fin no son pasos del diagrama");
    }

?>

<div class="highslide-html-content" id="cuerpo_paso<?php //echo($pasos[$i]["idpaso"]);?>">

          <!-- header -->
    

        <!--<ul id="mainpanel">   

          <!--li><a onclick="hs.prev(this)" class="previo_paso">Anterior <small>Paso Anterior</small></a></li-->

         <!-- <li><a onclick="abrir_menu_paso(<?php //echo($pasos[0]["idpaso"]);?>,1)"  class="contacts">Actividades <small>Actividades</small></a></li>

          <li><a onclick="abrir_menu_paso(<?php //echo($pasos[0]["idpaso"]);?>,3)" class="home">Detalles <small>Detalles</small></a></li>

          <li><a onclick="abrir_menu_paso(<?php //echo($pasos[0]["idpaso"]);?>,2)" class="profile">Funcionarios <small>Funcionarios</small></a></li>

          <li><a onclick="abrir_menu_paso(<?php //echo($pasos[0]["idpaso"]);?>,4)" class="editprofile">Configurar<small>Configurar</small></a></li>

          

    

          <li><a onclick="abrir_menu_paso(<?php //echo($pasos[0]["idpaso"]);?>,5)" class="messages">Mensajes <small>Mensajes</small></a></li>

          <li><a onclick="abrir_menu_paso(<?php //echo($pasos[0]["idpaso"]);?>,6)"class="playlist">Objetos<small>Objetos</small></a></li>

          <!--li><a onclick="hs.next(this)" class="siguiente_paso">Siguiente <small>Siguiente Paso</small></a></li-->

          <a onclick="hs.close(this)" href="#">Cerrar</a><br>

        <!--</ul>--> 
      <div style="clear:both;"></div>
      <!-- scrolling content -->
      <div class="highslide-body" id="contenido_paso">
      </div>
      <!-- footer -->
      <div style="clear:both;"></div>
      <div id="footer_paso">  <!--&nbsp;Actividades-->
      </div>
  </div>
	</body>
</html>
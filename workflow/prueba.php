<?php
	$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
if(!@$_REQUEST["idpaso"])
  die("Por favor Seleccione un Paso");
$arreglo1 = busca_filtro_tabla("*","paso","idpaso=".$_REQUEST['idpaso'],"",$conn);
if($arreglo1[0]["estado"] == 1)
	$fin = "Activo";
if($arreglo1[0]["estado"] == 0)
	$fin = "Inactivo";  
include_once($ruta_db_superior."header.php");
?>  <br /><br />
<style type="text/css">
body {
	background: #7f7f7f url(background.gif) no-repeat center top;
	margin: 0;
	padding: 0;
	font: 10px normal Verdana, Arial, Helvetica, sans-serif;
	height: 100%;
}
* {margin: 0; padding: 0; outline: none;}
img {border: none;}
h1 {
	font-size: 1.2em;
	padding: 5px 10px;
	color: #ccc;
	width: 940px;
	margin: 0 auto;
}
h1 a {	color: #fff; }
h1 span {font-weight: normal;}

#footpanel {
	position: fixed;
	bottom: 0; left: 0;
	z-index: 9999; /*--Keeps the panel on top of all other elements--*/
	background: #e3e2e2;
	border: 1px solid #c3c3c3;
	border-bottom: none;
	width: 88%;
	margin: 0 3%;
}

*html #footpanel { /*--IE6 Hack - Fixed Positioning to the Bottom--*/
	margin-top: -1px; /*--prevents IE6 from having an infinity scroll bar - due to 1px border on #footpanel--*/
	position: absolute;
	top:expression(eval(document.compatMode &&document.compatMode=='CSS1Compat') ?documentElement.scrollTop+(documentElement.clientHeight-this.clientHeight) : document.body.scrollTop +(document.body.clientHeight-this.clientHeight));
}

#footpanel ul {
	padding: 0; margin: 0;
	float: left;
	width: 100%;
	list-style: none;
	border-top: 1px solid #fff; /*--Gives the bevel feel on the panel--*/
	font-size: 1.1em;
}
#footpanel ul li{
	padding: 0; margin: 0;
	float: left;
	position: relative;
}
#footpanel ul li a{
	padding: 5px;
	float: left;
	text-indent: -9999px;
	height: 16px; width: 16px;
	text-decoration: none;
	color: #333;
	position: relative;
}
html #footpanel ul li a:hover{	background-color: #fff; }
html #footpanel ul li a.active { /*--Active state when subpanel is open--*/
	background-color: #fff;
	height: 17px;
	margin-top: -2px; /*--Push it up 2px to attach the active button to subpanel--*/
	border: 1px solid #555;
	border-top: none;
	z-index: 200; /*--Keeps the active area on top of the subpanel--*/
	position: relative;
}


#footpanel a.home{	
	background: url(<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>home.png) no-repeat center center;
}
a.profile{	background: url(<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>user.png) no-repeat center center;  }
a.contacts{	background: url(<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>address_book.png) no-repeat center center; }
a.playlist{	background: url(<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>document_music_playlist.png) no-repeat center center; }
a.videos{	background: url(<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>film.png) no-repeat center center; }
a.messages{	background: url(<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>mail.png) no-repeat center center; }
a.editprofile{	background: url(<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>wrench_screwdriver.png) no-repeat center center; }
#footpanel a.chat{	
	background: url(<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>balloon.png) no-repeat 15px center;
	width: 126px;
	/*border-left: 1px solid #bbb;¨*/
	border-right: 1px solid #bbb;
	padding-left: 40px;
	text-indent: 0; /*--Reset text indent--*/
}
a.alerts{	background: url(<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>newspaper.png) no-repeat center center;	 }

#footpanel li#chatpanel, #footpanel li#alertpanel , #footpanel li#formatos {	float: left; }  /*--Right align the chat and alert panels--*/

#footpanel a small {  /*--panel tool tip styles--*/
	text-align: center;
	width: 70px;
	background: url(<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>pop_arrow.gif) no-repeat center bottom;
	padding: 5px 5px 11px;
	display: none; /*--Hide by default--*/
	color: #fff;
	font-size: 1em;
	text-indent: 0;
}
#footpanel a:hover small{
	display: block; /*--Show on hover--*/
	position: absolute;
	top: -35px; /*--Position tooltip 35px above the list item--*/
	left: 50%; 
	margin-left: -40px; /*--Center the tooltip--*/
	z-index: 9999;
}
#footpanel ul li div a { /*--Reset link style for subpanel links--*/
	text-indent: 0;
	width: auto;
	height: auto;
	padding: 0;
	float: none;
	color: #00629a;
	position: static;
}
#footpanel ul li div a:hover {	text-decoration: underline; } /*--Reset link style for subpanel links--*/

#footpanel .subpanel {
	position: absolute;
	left: 0; bottom: 27px;
	display: none;	/*--Hide by default--*/
	width: 198px;
	border: 1px solid #555;
	background: #fff;
	overflow: hidden;
	padding-bottom: 2px;
}
#footpanel h3 {
	background: #526ea6;
	padding: 5px 10px;
	color: #fff;
	font-size: 1.1em;
	cursor: pointer;
}
#footpanel h3 span { 
	font-size: 1.5em;
	float: right;
	line-height: 0.6em;	
	font-weight: normal;
}
#footpanel .subpanel ul{
	padding: 0; margin: 0;
	background: #fff;
	width: 100%;
	overflow: auto;
}
#footpanel .subpanel li{ 
	float: none; /*--Reset float--*/
	display: block;
	padding: 0; margin: 0;
	overflow: hidden;
	clear: both;
	background: #fff;
	position: static;  /*--Reset relative positioning--*/
	font-size: 0.9em;
}

#chatpanel .subpanel li { background: url(<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>dash.gif) repeat-x left center; } 
#chatpanel .subpanel li span {
	padding: 5px;
	background: #fff;
	color: #777;
	float: left;
}
#chatpanel .subpanel li a img {
	float: left;
	margin: 0 5px;
}
#chatpanel .subpanel li a{
	padding: 3px 0;	margin: 0;
	line-height: 22px;
	height: 22px;
	background: #fff;
	display: block;
}
#chatpanel .subpanel li a:hover {
	background: #3b5998;
	color: #fff;
	text-decoration: none;
}


#alertpanel .subpanel { right: 0; left: auto; /*--Reset left positioning and make it right positioned--*/ }
#alertpanel .subpanel li {
	border-top: 1px solid #f0f0f0;
	display: block;
}
#alertpanel .subpanel li p {padding: 5px 10px;}
#alertpanel .subpanel li a.delete{
	background: url(<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>delete_x.gif) no-repeat;
	float: right;
	width: 13px; height: 14px;
	margin: 5px;
	text-indent: -9999px;
	visibility: hidden; /*--Hides by default but still takes up space (not completely gone like display:none;)--*/
}
#alertpanel .subpanel li a.delete:hover { background-position: left bottom; }
#footpanel #alertpanel li.view {
	text-align: right;
	padding: 5px 10px 5px 0;
}
</style>
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){

	//Adjust panel height
	$.fn.adjustPanel = function(){ 
		$(this).find("ul, .subpanel").css({ 'height' : 'auto'}); //Reset subpanel and ul height
		
		var windowHeight = $(window).height(); //Get the height of the browser viewport
		var panelsub = $(this).find(".subpanel").height(); //Get the height of subpanel	
		var panelAdjust = windowHeight - 100; //Viewport height - 100px (Sets max height of subpanel)
		var ulAdjust =  panelAdjust - 25; //Calculate ul size after adjusting sub-panel (27px is the height of the base panel)
		
		if ( panelsub >= panelAdjust ) {	 //If subpanel is taller than max height...
			$(this).find(".subpanel").css({ 'height' : panelAdjust }); //Adjust subpanel to max height
			$(this).find("ul").css({ 'height' : ulAdjust}); //Adjust subpanel ul to new size
		}
		else if ( panelsub < panelAdjust ) { //If subpanel is smaller than max height...
			$(this).find("ul").css({ 'height' : 'auto'}); //Set subpanel ul to auto (default size)
		}
	};
	
	//Execute function on load
	$("#chatpanel").adjustPanel(); //Run the adjustPanel function on #chatpanel
	$("#alertpanel").adjustPanel(); //Run the adjustPanel function on #alertpanel
	$("#formatos").adjustPanel(); //Run the adjustPanel function on #alertpanel
	//Each time the viewport is adjusted/resized, execute the function
	$(window).resize(function () { 
		$("#chatpanel").adjustPanel();
		$("#alertpanel").adjustPanel();
		$("#formatos").adjustPanel();
	});
	
	//Click event on Chat Panel + Alert Panel	
	$("#chatpanel a:first, #alertpanel a:first, #formatos a:first").click(function() { //If clicked on the first link of #chatpanel and #alertpanel...
		if($(this).next(".subpanel").is(':visible')){ //If subpanel is already active...
			$(this).next(".subpanel").hide(); //Hide active subpanel
			$("#footpanel li a").removeClass('active'); //Remove active class on the subpanel trigger
		}
		else { //if subpanel is not active...
			$(".subpanel").hide(); //Hide all subpanels
			$(this).next(".subpanel").toggle(); //Toggle the subpanel to make active
			$("#footpanel li a").removeClass('active'); //Remove active class on all subpanel trigger
			$(this).toggleClass('active'); //Toggle the active class on the subpanel trigger
		}
		return false; //Prevent browser jump to link anchor
	});
	
	//Click event outside of subpanel
	$(document).click(function() { //Click anywhere and...
		$(".subpanel").hide(); //hide subpanel
		$("#footpanel li a").removeClass('active'); //remove active class on subpanel trigger
	});
	$('.subpanel ul').click(function(e) { 
		e.stopPropagation(); //Prevents the subpanel ul from closing on click
	});
	
	//Delete icons on Alert Panel
	$("#alertpanel li").hover(function() {
		$(this).find("a.delete").css({'visibility': 'visible'}); //Show delete icon on hover
	},function() {
		$(this).find("a.delete").css({'visibility': 'hidden'}); //Hide delete icon on hover out
	});	
});
</script>
<table border="0" width="100%">
  <tr>
    <td class="encabezado">Nombre paso</td>
    <td><?php echo $arreglo1[0][3]; ?></td>
  </tr>
  <tr>
    <td class="encabezado">Descripcion</td>
    <td><?php echo $arreglo1[0][1]; ?></td>
  </tr>
  <tr>
    <td class="encabezado">Estado</td>
    <td><?php echo $fin; ?></td>
  </tr>
  <tr>
    <td colspan="2"><?php crear_menu() ?></td>
  </tr>
  <tr>
    <td colspan="2"><div id="zona_carga" >12345</div></td>
  </tr>
</table>
<?php 
function crear_menu(){
global $ruta_db_superior;
?>
<div id="footpanel">
	<ul id="mainpanel">    	
        <li><a href="http://www.designbombs.com" class="home">Inspiration <small>Design</small></a></li>
        <li><a href="http://www.designbombs.com" class="profile">View Profile <small>View</small></a></li>
        <li><a href="http://www.designbombs.com" class="editprofile">Edit Profile <small>Edit</small></a></li>
        <li><a href="http://www.designbombs.com" class="contacts">Contacts <small>Contacts</small></a></li>

        <li><a href="http://www.designbombs.com" class="messages">Messages (10) <small>Messages</small></a></li>
        <li><a href="http://www.designbombs.com" class="playlist">Play List <small>Play List</small></a></li>
        <li><a href="http://www.designbombs.com" class="videos">Videos <small>Videos</small></a></li>
       </ul>
       <ul> 
        <li id="alertpanel">
        	<a href="#" class="chat">Actividades</a>

            <div class="subpanel">
            <h3><span> &ndash; </span>Actividades</h3>
            <ul>
            	<li class="view"><a href="#">View All</a></li>
            	<li><a href="#" class="delete">X</a><p><a href="#">Antehabeo</a> abico quod duis odio tation luctus eu ad <a href="#">lobortis facilisis</a>.</p></li>

                <li><a href="#" class="delete">X</a><p><a href="#">Et voco </a> Duis vel quis at metuo obruo, turpis quadrum nostrud <a href="#">lobortis facilisis</a>.</p></li>
                <li><a href="#" class="delete">X</a><p><a href="#">Tego</a> nulla eum probo metuo nullus indoles os consequat commoveo os<a href="#">lobortis facilisis</a>.</p></li>
                <li><a href="#" class="delete">X</a><p><a href="#">Antehabeo</a> abico quod duis odio tation luctus eu ad <a href="#">lobortis facilisis</a>.</p></li>

                <li><a href="#" class="delete">X</a><p><a href="#">Nonummy</a> nulla eum probo metuo nullus indoles os consequat commoveo <a href="#">lobortis facilisis</a>.</p></li>
                <li><a href="#" class="delete">X</a><p><a href="#">Tego</a> minim autem aptent et jumentum metuo uxor nibh euismod si <a href="#">lobortis facilisis</a>.</p></li>
                <li><a href="#" class="delete">X</a><p><a href="#">Antehabeo</a> abico quod duis odio tation luctus eu ad <a href="#">lobortis facilisis</a>.</p></li>

            </ul>
            </div>
        </li>
        </ul>
        <ul>
        <li id="formatos"> 
        	<a href="#" class="chat">Formatos</a>

            <div class="subpanel">
            <h3><span> &ndash; </span>Formatos</h3>
            <ul>
            	<li class="view"><a href="#">View All</a></li>
            	<li><p><a href="#">Antehabeo</a> abico quod duis odio tation luctus eu ad <a href="#">lobortis facilisis</a>.</p></li>

                <li><p><a href="#">Et voco </a> Duis vel quis at metuo obruo, turpis quadrum nostrud <a href="#">lobortis facilisis</a>.</p></li>
                <li><p><a href="#">Tego</a> nulla eum probo metuo nullus indoles os consequat commoveo os<a href="#">lobortis facilisis</a>.</p></li>
                <li><p><a href="#">Antehabeo</a> abico quod duis odio tation luctus eu ad <a href="#">lobortis facilisis</a>.</p></li>

                <li><p><a href="#">Nonummy</a> nulla eum probo metuo nullus indoles os consequat commoveo <a href="#">lobortis facilisis</a>.</p></li>
                <li><p><a href="#">Tego</a> minim autem aptent et jumentum metuo uxor nibh euismod si <a href="#">lobortis facilisis</a>.</p></li>
                <li><p><a href="#">Antehabeo</a> abico quod duis odio tation luctus eu ad <a href="#">lobortis facilisis</a>.</p></li>

            </ul>
            </div>
        </li>   
        </ul>
        <ul>
        <li id="chatpanel">
        	<a href="#" class="chat">Funcionarios(<strong>XX</strong>) </a>
            <div class="subpanel">
            <h3><span> &ndash; </span>Funcionarios</h3>

            <ul>
            	<li><span>Dependencia</span></li>
            	<li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>

                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                
                <li><span>Otros Funcionarios</span></li>
                
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>

                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>

                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>

                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>

                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
                <li><a href="#"><img src="<?php echo($ruta_db_superior."images/panel_inferior_pasos/");?>chat-thumb.gif" alt="" /> Your Friend</a></li>
            </ul>
            </div>
        </li>        
	</ul>
</div>
<?php  
  
}

include_once($ruta_db_superior."footer.php");?>
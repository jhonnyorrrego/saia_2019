<?php
require_once("../db.php");
require_once("../encabezados_busquedas.php");
include_once("../define.php");
?>
<script type="text/javascript" src="../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<?php
if(isset($_REQUEST["fin"]))
  redirecciona("../logout.php");
//print_r($_REQUEST);
if(isset($_REQUEST["adicionales"]) && $_REQUEST["adicionales"]<>"")
    {
     $adicionales=explode(";",$_REQUEST["adicionales"]);
     foreach($adicionales as $variable)
       {$variable=explode(",",$variable);
        $_REQUEST[$variable[0]]=$variable[1];
       }
    }
//busca el color de fondo configurados para la aplicacion y predetermina los estilos de
//los componentes
 $conn;
$config = busca_filtro_tabla("A.valor",DB.".configuracion A","A.nombre='color_encabezado'","",$conn);
 if($config["numcampos"])
 {  $style = "
     <style type=\"text/css\">
     <!--INPUT, TEXTAREA, SELECT {
        font-family: Verdana;
        font-size: 10px;
       }
       .phpmaker {
       font-family: Verdana;
       font-size: 9px;
       }
       .encabezado {
       background-color:".$config[0]["valor"].";
       color:white ;
       padding:10px;
       text-align: left;
       }
       .encabezado_list {
       background-color:".$config[0]["valor"].";
       color:white ;
       vertical-align:middle;
       text-align: center;
       font-weight: bold;
       }
       table thead td {
		    font-weight:bold;
    		cursor:pointer;
    		background-color:".$config[0]["valor"].";
    		text-align: center;
        font-family: Verdana;
        font-size: 9px;
        vertical-align:middle;
    	 }
    	 table tbody td {
    		font-family: Verdana;
        font-size: 9px;
    	 }
       -->
       </style>";
  if(!isset($_REQUEST["export"]) || $_REQUEST["export"]=="" || $_REQUEST["export"]=="html")
     echo $style;
  }
if(!isset($_REQUEST["export"]) || $_REQUEST["export"]=="")
{
?>
<style type="text/css" media="screen">

	@import "css/title2note.css";

	/* DEMO CSS */
	.nota{
	  TEXT-DECORATION: none;
		color:#FFFFFF;
	}
</style>
<head><meta http-equiv='content-type' content='text/html; charset=UTF-8'>
<style type="text/css">
#dhtmlgoodies_tooltip{
		background-color:#ECEDF1;
		border:1px solid #000;
		position:absolute;
		display:none;
		z-index:20000;
		padding:2px;
		font-size:0.7em;
		-moz-border-radius:6px;	/* Rounded edges in Firefox */
		font-family: "Trebuchet MS", "Lucida Sans Unicode", Arial, sans-serif;

	}
	#dhtmlgoodies_tooltipShadow{
		position:absolute;
		background-color:#555;
		display:none;
		z-index:10000;
		opacity:0.7;
		filter:alpha(opacity=70);
		-khtml-opacity: 0.7;
		-moz-opacity: 0.7;
		-moz-border-radius:6px;	/* Rounded edges in Firefox */
	}
	</style>
	<SCRIPT type="text/javascript">
	/************************************************************************************************************
	(C) www.dhtmlgoodies.com, October 2005

	This is a script from www.dhtmlgoodies.com. You will find this and a lot of other scripts at our website.

	Updated:
		March, 11th, 2006 - Fixed positioning of tooltip when displayed near the right edge of the browser.
		April, 6th 2006, Using iframe in IE in order to make the tooltip cover select boxes.

	Terms of use:
	You are free to use this script as long as the copyright message is kept intact. However, you may not
	redistribute, sell or repost it without our permission.

	Thank you!

	www.dhtmlgoodies.com
	Alf Magne Kalleland

	************************************************************************************************************/
	var dhtmlgoodies_tooltip = false;
	var dhtmlgoodies_tooltipShadow = false;
	var dhtmlgoodies_shadowSize = 4;
	var dhtmlgoodies_tooltipMaxWidth = 200;
	var dhtmlgoodies_tooltipMinWidth = 100;
	var dhtmlgoodies_iframe = false;
	var tooltip_is_msie = (navigator.userAgent.indexOf('MSIE')>=0 && navigator.userAgent.indexOf('opera')==-1 && document.all)?true:false;
	function showTooltip(e,tooltipTxt)
	{

		var bodyWidth = Math.max(document.body.clientWidth,document.documentElement.clientWidth) - 20;

		if(!dhtmlgoodies_tooltip){
			dhtmlgoodies_tooltip = document.createElement('DIV');
			dhtmlgoodies_tooltip.id = 'dhtmlgoodies_tooltip';
			dhtmlgoodies_tooltipShadow = document.createElement('DIV');
			dhtmlgoodies_tooltipShadow.id = 'dhtmlgoodies_tooltipShadow';

			document.body.appendChild(dhtmlgoodies_tooltip);
			document.body.appendChild(dhtmlgoodies_tooltipShadow);

			if(tooltip_is_msie){
				dhtmlgoodies_iframe = document.createElement('IFRAME');
				dhtmlgoodies_iframe.frameborder='5';
				dhtmlgoodies_iframe.style.backgroundColor='#FFFFFF';
				dhtmlgoodies_iframe.src = '#';
				dhtmlgoodies_iframe.style.zIndex = 100;
				dhtmlgoodies_iframe.style.position = 'absolute';
				document.body.appendChild(dhtmlgoodies_iframe);
			}

		}

		dhtmlgoodies_tooltip.style.display='block';
		dhtmlgoodies_tooltipShadow.style.display='block';
		if(tooltip_is_msie)dhtmlgoodies_iframe.style.display='block';

		var st = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
		if(navigator.userAgent.toLowerCase().indexOf('safari')>=0)st=0;
		var leftPos = e.clientX + 10;

		dhtmlgoodies_tooltip.style.width = null;	// Reset style width if it's set
		dhtmlgoodies_tooltip.innerHTML = tooltipTxt;
		dhtmlgoodies_tooltip.style.left = leftPos + 'px';
		dhtmlgoodies_tooltip.style.top = e.clientY + 10 + st + 'px';


		dhtmlgoodies_tooltipShadow.style.left =  leftPos + dhtmlgoodies_shadowSize + 'px';
		dhtmlgoodies_tooltipShadow.style.top = e.clientY + 10 + st + dhtmlgoodies_shadowSize + 'px';

		if(dhtmlgoodies_tooltip.offsetWidth>dhtmlgoodies_tooltipMaxWidth){	/* Exceeding max width of tooltip ? */
			dhtmlgoodies_tooltip.style.width = dhtmlgoodies_tooltipMaxWidth + 'px';
		}

		var tooltipWidth = dhtmlgoodies_tooltip.offsetWidth;
		if(tooltipWidth<dhtmlgoodies_tooltipMinWidth)tooltipWidth = dhtmlgoodies_tooltipMinWidth;


		dhtmlgoodies_tooltip.style.width = tooltipWidth + 'px';
		dhtmlgoodies_tooltipShadow.style.width = dhtmlgoodies_tooltip.offsetWidth + 'px';
		dhtmlgoodies_tooltipShadow.style.height = dhtmlgoodies_tooltip.offsetHeight + 'px';

		if((leftPos + tooltipWidth)>bodyWidth){
			dhtmlgoodies_tooltip.style.left = (dhtmlgoodies_tooltipShadow.style.left.replace('px','') - ((leftPos + tooltipWidth)-bodyWidth)) + 'px';
			dhtmlgoodies_tooltipShadow.style.left = (dhtmlgoodies_tooltipShadow.style.left.replace('px','') - ((leftPos + tooltipWidth)-bodyWidth) + dhtmlgoodies_shadowSize) + 'px';
		}

		if(tooltip_is_msie){
			dhtmlgoodies_iframe.style.left = dhtmlgoodies_tooltip.style.left;
			dhtmlgoodies_iframe.style.top = dhtmlgoodies_tooltip.style.top;
			dhtmlgoodies_iframe.style.width = dhtmlgoodies_tooltip.offsetWidth + 'px';
			dhtmlgoodies_iframe.style.height = dhtmlgoodies_tooltip.offsetHeight + 'px';
		}
	}

	function hideTooltip()
	{
		dhtmlgoodies_tooltip.style.display='none';
		dhtmlgoodies_tooltipShadow.style.display='none';
		if(tooltip_is_msie)dhtmlgoodies_iframe.style.display='none';
	}
	</SCRIPT>
</head>
<?php
}
if(!isset($_REQUEST["export"]) || $_REQUEST["export"]=="")
{
?>

<script type="text/javascript" src="js/ordenar_list.js"></script>
<link rel="stylesheet" href="css/bubble-tooltip.css" media="screen">
<script type="text/javascript" src="js/bubble-tooltip.js"></script>
<style type="text/css">
.imagen_internos {vertical-align:middle}
.internos {font-family: Verdana; font-size: 9px; font-weight: bold;}
	/* If you wish to highlight current sortable column, add layout effects below */
	.highlightedColumn{
  background-color:#CCC;
}
</style>
<?php
}
$agregados=0;
if(!strpos($_SERVER["HTTP_REFERER"],'buscador/index.php'))
  $_SESSION["punto_retorno"]=$_SERVER["HTTP_REFERER"];

// Es la segunda pantalla, segun las tablas seleccionadas, se muestran los campos por los que puedo
//configurar la búsqueda
if(isset($_REQUEST["formu"]))
{
  imprimirCampos();
}

else
// Es la pantalla que saca los resultados de la busqueda
if(isset($_REQUEST["busqueda"]))
{
  // Si le llegaron las tablas para hacer la busqueda
  if(isset($_REQUEST["tablas"]) && $_REQUEST["tablas"]!="")
  {
    //si es el primer grupo de resultados y las variables anterior y siguiente no existen
    if(!array_key_exists("anterior",$_REQUEST))
      {$anterior=0;


      //variables usadas para pasar los datos de pagina en pagina
      //se reinician cada vez que entra aqui
       unset($_SESSION["sql"]);//contiene el sql de la busqueda
       unset($_SESSION["ordenar"]);//campo por el cual se desea ordenar
       unset($_SESSION["totales"]);//campos con funciones de agregacion para totalizar
       unset($_SESSION["datos_g"]);//se crea cuando se dibuja la grafica, (datos a dibujar)
       unset($_SESSION["arr3d"]);//array con el ancho para la grafica en 3d
       unset($_SESSION["tipo_g"]);//tipo de grafica que quiero ver
       unset($_SESSION["titulo"]);//titulo de la grafica
       unset($_SESSION["titulox"]);//titulo del eje x
       unset($_SESSION["tipo_dato"]);//si quiero ver el porcentaje o el valor normal (grafica)
       unset($_SESSION["tituloy"]);//titulo del eje y

      //si voy a utilizar la cadena sql entrada en el formulario
       if($_REQUEST["sql"]<>"")
          {
             $resultado=stripslashes(rawurldecode($_REQUEST["sql"]));
             $resultado=htmlspecialchars_decode(htmlentities($resultado, ENT_NOQUOTES, 'UTF-8'), ENT_NOQUOTES);

               if(strpos($resultado, '/*para_idfunci*/') >0)
                { if(isset($_REQUEST["fun_permiso"]) && $_REQUEST["fun_permiso"]!="")
                   $resultado=str_replace('/*para_idfunci*/',$_REQUEST["fun_permiso"],$resultado);
                  else
                   $resultado=str_replace('/*para_idfunci*/', $_SESSION["usuario_actual"],$resultado);
                }
                if(strpos($resultado, '/*idfuncionario*/') >0)
                { $resultado=str_replace('/*idfuncionario*/', usuario_actual("id"),$resultado);
                  }
                if(strpos($resultado, '/*codigo_sql*/') >0)
                {
                if(isset($_REQUEST["lista_docs"]) && $_REQUEST["lista_docs"]<>"")
                    {$lista=str_replace("-",",",$_REQUEST["lista_docs"]);
                     $docs_v=array_chunk(explode(",",$lista), 1000);
                     if(count($docs_v)>1)
                        {
                         foreach($docs_v as $fila)
                            $docs2[]=" iddocumento in (".implode(",",$fila).") ";
                         $docs=implode(" or ",$docs2);
                        }
                     else
                        {$docs=" iddocumento in (".implode(",",$docs_v[0]).") ";
                        }
                     if(isset($_REQUEST["ejecutor"]) && $_REQUEST["ejecutor"]!="")
                     {   $resultado =str_replace('/*codigo_sql*/'," and (".$docs.") and ejecutor=".$_REQUEST["ejecutor"],$resultado);
                     }
                     else
                      $resultado=str_replace('/*codigo_sql*/'," and (".$docs.") ",$resultado);

                    }
                     else
                      $resultado=str_replace('/*codigo_sql*/',"iddocumento in (0) ",$resultado);
                }
                if(strpos($resultado, '/*nombre_plantilla*/') >0)
                { //print_r($_REQUEST);
                  if(isset($_REQUEST["plantilla_ppal"]))
                   $resultado=str_replace('/*nombre_plantilla*/', $_REQUEST["plantilla_ppal"],$resultado);
                  //else
                   //$resultado=str_replace('/*nombre_plantilla*/', "memorando",$resultado);
                }
          }
       //si voy a utilizar los datos del formulario para construir la consulta
       else
          $resultado = generarSQL();

       $_SESSION["sql"]=$resultado;
      }
    /*------------------------------------------------------------------------------------------
    si ya hice todos los calculos y estoy navegando entre las paginas
      tomo el sql de la variable de sesion
    ------------------------------------------------------------------------------------------*/
    else
      {$resultado=$_SESSION["sql"];
      }

    //echo "<br /><br /><br /><br /><br /><br />".$resultado."<br><br>";
    //echo "Imprimo el sql de la busqueda global: <br/>".$resultado;
    /*------------------------------------------------------------------------------------------
      si se tienen llaves configuradas para la busqueda, las adiciono a la consulta si no existen
    --------------------------------------------------------------------------------------------*/
    //saco aparte la lista de los campos que existen en la consulta
    //$subcadena=substr($resultado,strrpos($resultado,"select"),strrpos($resultado,"FROM "));
    //si tengo llaves configuradas
    if(isset($_REQUEST["llave"]) && $_REQUEST["llave"]<>"")
      {//tomo el from de la consulta
       $from=substr($resultado,strrpos(strtoupper($resultado),"FROM"),strrpos(strtoupper($resultado),"WHERE"));
       //separo las llaves
       $llaves=explode(";",$_REQUEST["llave"]);
       //array con los alias de las llaves
       $alias_llaves=array();
       //para cada una de las llaves
       foreach($llaves as $llave)
          {//separo el campo del alias
           $llave=explode(",",$llave);
           $alias_llaves[]=$llave[1];
           if(strpos($resultado,$llave[1])==="" || strpos($resultado,$llave[1])===0 || strpos($resultado,$llave[1])===false)
              {//separo el campo de la tabla
               $llave2=explode(".",$llave[0]);
               $tabla=$llave2[0];
               $campo=$llave2[1];
               //busco el alias de la tabla

               if(isset($_SESSION["lista_tablas"]))
                 {$pos=array_search(strtolower(DB.".".$tabla),$_SESSION["lista_tablas"]);
                  $alias_tabla=$_SESSION["alias"][$pos];
                 }
               else
               $alias_tabla=substr($from,strrpos($from,$tabla)+strlen($tabla)+1,1);         //echo $alias_tabla;die();
               //lo agrego a la consulta si es la primera vez
               if(!array_key_exists("anterior",$_REQUEST))
                  {//busco si tiene la llave el select, si no la tiene se la adiciono
                   if(strpos(strtoupper($resultado),"SELECT DISTINCT")!==false)
                      $cadena=substr_replace($resultado,"SELECT DISTINCT ".$alias_tabla.".".$llave2[1]." as ".$llave[1].",",0,15);
                   else
                      $cadena=substr_replace($resultado,"SELECT ".$alias_tabla.".".$llave2[1]." as ".$llave[1].",",0,6);
//echo $cadena."<br /><br />";
                   $_SESSION["sql"]=$cadena;
                   $resultado=$cadena;
                  }
              }
          }
      }

    /*------------------------------------------------------------------------------------------
    si es la primera vez que entro, haciendo calculos iniciales. Calculo el total de registros para
      poder mostrar los numeros de pagina
      ------------------------------------------------------------------------------------------*/

    $resultado=str_replace("\'","'",$resultado);
    //echo "<br /><br /><br />".$resultado."<br/>";
    //$sql_aux="select count(*) as registros ".substr($resultado,strpos(strtolower($resultado),"from"));
    $inicio=strpos(strtolower($resultado),"from");
    if(strpos(strtolower($resultado),"order by")!==false)
       $fin=strpos(strtolower($resultado),"order by")-$inicio;
    else
       $fin=strlen($resultado);
    if(MOTOR=="Oracle")
      $sql_aux="select count(*) as registros from (".$resultado.")";
     if(MOTOR=="MySql")
      $sql_aux="select count(*) as registros from (".str_replace("key","'key'",$resultado).") b";

  // echo "<br /><br /><br /><br /><br /><br /><br /><br />".$sql_aux."<br />";
   if(!array_key_exists("num_reg",$_REQUEST) || $_REQUEST["num_reg"]=="")
    {  global $conn;

      if(isset($_REQUEST["lista_docs"]) && $_REQUEST["lista_docs"]=="")
      $_REQUEST["num_reg"]=0;
      else
      {
      $rs = phpmkr_query($sql_aux, $conn);
      //echo phpmkr_error();
      $fila=phpmkr_fetch_row($rs);
     //print_r($fila);
      $_REQUEST["num_reg"]=$fila[0];
      }

      $_SESSION["totales"]="";

    }

     /*------------------------------------------------------------------------------------------
    creo los nuevos indices para el limit. $anterior (registro inicial de la pagina actual),
    $_REQUEST["registros"] (numero de registro por pagina), $_REQUEST["anterior"] (primer registro de la pagina anterior)
    ------------------------------------------------------------------------------------------*/
  //print_r($_REQUEST);
    if(@$_REQUEST["pagina"]=="salto_pagina")
    {
      if($_REQUEST["salto_pagina"]<1)
        {
          alerta("Acaba de Elegir una página no válida y será enviado a la primera página",'error',5000);
          $anterior=0;
        }
      else if(($_REQUEST["salto_pagina"]-1)*$_REQUEST["registros"]>=$_REQUEST["num_reg"])
        {
          alerta("Acaba de Elegir una página que no existe y será enviado a la última página",'error',4000);
          $anterior=((ceil($_REQUEST["num_reg"]/$_REQUEST["registros"])-1)*$_REQUEST["registros"]);
        }
      else $anterior=(($_REQUEST["salto_pagina"]-1)*$_REQUEST["registros"]);

    }
    else if(@$_REQUEST["pagina"]=="siguiente")
      $anterior=$_REQUEST["anterior"]+$_REQUEST["registros"];
    else if(@$_REQUEST["pagina"]=="anterior")
      $anterior=$_REQUEST["anterior"]-$_REQUEST["registros"];
    else if(array_key_exists("anterior",$_REQUEST))
          { if($anterior=$_REQUEST["anterior"]-1>0)
             $anterior=$_REQUEST["anterior"]-1;
             else
            $anterior=0;
          }


   /*------------------------------------------------------------------------------------------
     si se van a organizar los resultados por subgrupos
    ------------------------------------------------------------------------------------------*/

    if(isset($_REQUEST["subtitulo"]) && $_REQUEST["subtitulo"]<>"" && @$_REQUEST["subtitulo"]<>0)
      {//separo el nombre de la tabla del nombre del campo
       $col_titulo=explode("_",$_REQUEST["subtitulo"]);
       //reemplazo el nombre del campo por su alias
       $info_campo=busca_filtro_tabla("A.alias",DB.".campos A","A.nombre='".$col_titulo[1]."' and A.tabla='".$col_titulo[0]."'","",$conn);
       $col_titulo=$col_titulo[0]."_".$info_campo[0][0];
       $col_titulo=str_replace(" ","_",$col_titulo);
      }
    else
       $col_titulo="null";

    /*variable que me indica entre el vector de resultados cual es la columna que tiene
      el campo por el cual haré los subgrupos*/
    $indice="";

    //echo "Imprimo el sql de la busqueda global: <br/>".$cadena;

    // Esto es para el caso de los expedientes que utilizan la busqueda avanzada de los documentos para llenar el expediente.
    if(isset($_REQUEST["pagina_exp"]) && $_REQUEST["pagina_exp"]<>"")
    {
      redirecciona("../expediente.php?idexpediente=".$_REQUEST["pagina_exp"]."&sql=$resultado");
    }
     if(isset($_REQUEST["pagina_reserva"]) && $_REQUEST["pagina_reserva"]<>"")
    {
      redirecciona("../solicitudadd.php?idexpediente=".$_REQUEST["pagina_exp"]."&sql=$resultado");
    }

   /*------------------------------------------------------------------------------------------
    imprimo el encabezado que se encuentra en ../encabezado_busquedas.php
    ------------------------------------------------------------------------------------------*/

   if(!isset($_REQUEST['no_encabezado']))
    encabezado($_REQUEST["tabla"],@$_REQUEST["func_busqueda"],@$_REQUEST["llave"],$resultado,$_REQUEST["num_reg"]);
    if($_REQUEST["num_reg"]==0)
      {
      error("<label style='font-family:verdana;font-size:10'>No hay registros que cumplan las condiciones dadas.<br /></label>");
      }

    /*------------------------------------------------------------------------------------------
     agrego el order by a la consulta
    ------------------------------------------------------------------------------------------*/
    if(!isset($_REQUEST["orden"]))
        $_REQUEST["orden"]="asc";
    if(isset($_REQUEST["ordenar"]) && $_REQUEST["ordenar"]<>"")
      {
        $resultado.=" ".$_REQUEST["ordenar"]." ".$_REQUEST["orden"];
      }
    $cadena=$resultado;
    require_once("../funciones.php");
    /*------------------------------------------------------------------------------------------
     agrego el limit a la consulta y la ejecuto
    ------------------------------------------------------------------------------------------*/
  //echo "<br />".$anterior."&nbsp;".$_REQUEST["registros"];
  //echo $_SESSION["usuario_actual"]."..";
  if($_REQUEST["num_reg"]>0)
    {$fin=$anterior + $_REQUEST["registros"]-1;
     if($fin>$_REQUEST["num_reg"])
       $fin=$_REQUEST["num_reg"];
     //echo "<br />".$cadena;
    // echo "<br />".$anterior."&nbsp;".$fin."<br />";
     $rs=$conn->Ejecutar_Limit($cadena,$anterior,$fin,$conn);

	  }

    /*------------------------------------------------------------------------------------------
     creacion de la consulta para los totales
    ------------------------------------------------------------------------------------------*/
    if(isset($_REQUEST["totales"]) && $_REQUEST["totales"]<>"")
        {
         $aux=array();
         $subtitulo=$_REQUEST["subtitulo"];
         //si no es una busqueda de tipo listado
         if($_REQUEST["tipo"]<>"listado" && !isset($_REQUEST[$anterior]))
           {$totales=explode(",",$_REQUEST["totales"]);
            //creo los alias para los campos a totalizar
            foreach($totales as $fila)
               {
                $t_alias=str_replace("count(","Contar_",$fila);
                $t_alias=str_replace("sum(","Sumar_",$t_alias);
                $t_alias=str_replace("avg(","Promedio_",$t_alias);
                $t_alias=str_replace(")","",$t_alias);
                $t_alias=str_replace(".","_",$t_alias);
                $t_alias=str_replace(" ","_",$t_alias);
                $aux[]=$fila." as ".$t_alias;
               }
            $totales="select ".implode(",",$aux);
           }
         else
           $totales="select ".$_REQUEST["totales"];
         //reemplazo los nombres de las tablas por los alias
         if(isset($_SESSION["tablas"]) && $_REQUEST["tipo"]<>"listado" )
            {
             for($i=0;$i<count($_SESSION["tablas"]);$i++)
                {$totales=str_replace($_SESSION["tablas"][$i].".",$_SESSION["alias"][$i].".",$totales);
                 $subtitulo=str_replace($_SESSION["tablas"][$i].".",$_SESSION["alias"][$i].".",$subtitulo);
                }
             unset($_SESSION["lista_tablas"]);
             unset($_SESSION["alias"]);
            }
         //si existe campo para formar subgrupos
         if($_REQUEST["subtitulo"]<>"0" && $_REQUEST["tipo"]<>"listado")
           {//lo agrego a la consulta de los totales
            $totales.=",".$subtitulo." as ".$col_titulo;
            $order_i=strpos($resultado,"ORDER BY");

            if($order_i>0)
                {$totales.=" ".substr($resultado,strpos($resultado,"FROM"),$order_i-strpos($resultado,"FROM"));
                 $totales.=" group by ".$subtitulo." ".substr($resultado,$order_i);
                }
            else
               $totales.=" ".substr($resultado,strpos($resultado,"FROM"))." group by ".$subtitulo;
           }
         else if( $_REQUEST["tipo"]<>"listado")
           {
            $group_i=strpos($resultado,"GROUP BY");

            if($group_i>0)
              {$totales.=" ".substr($resultado,strpos($resultado,"FROM"),$group_i-strpos($resultado,"FROM"));
              }
            else
               $totales.=" ".substr($resultado,strpos($resultado,"FROM"));

           }
         $_REQUEST["totales"]=str_replace("select ","",$totales);
         //ejecuto la consulta
         $rs_total = phpmkr_query($totales,$conn) or error("PROBLEMAS AL EJECUTAR LA BUSQUEDA" . phpmkr_error() . ' SQL:' . $totales);
         //creo una matriz con los resultados

         //creo un vector con el conjunto de resultados
          $temp=phpmkr_fetch_array($rs_total);
          for($i=0;$temp;$temp=phpmkr_fetch_array($rs_total),$i++)
          array_push($matriz,$temp);
          phpmkr_free_result($rs_total);
         //pongo los resultados en una varible de sesion
         $_SESSION["totales"]=$matriz;

        }
  /*------------------------------------------------------------------------------------------
  creo el formulario que contiene los resultados
  ------------------------------------------------------------------------------------------*/

  echo "<form name='resultados' id='resultados' action='index.php' method='post'> ";
  if((!isset($_REQUEST["export"]) || $_REQUEST["export"]==""))
    {
 ?>
    <input type=hidden name=anterior id=anterior value=<?php echo $anterior; ?> ><!--registro en el que voy-->
      <input type=hidden name=tablas value='<?php echo $_REQUEST["tablas"];?>' >
    <?php

    if(isset($_REQUEST["func_busqueda"]) && $_REQUEST["func_busqueda"]<>"")
      {echo "<input type=hidden name='func_busqueda' value='".$_REQUEST["func_busqueda"]."' >";
      }
    if(isset($_REQUEST["llave"]) && $_REQUEST["llave"]<>"")
      {echo "<input type=hidden name='llave' value='".$_REQUEST["llave"]."' >";
      }
    ?>
    <input type=hidden name=busqueda value='buscar' >
    <input type=hidden name=tabla value='<?php echo $_REQUEST["tabla"]; ?>' ><!--para el encabezado -->
    <input type=hidden name=tipo_b value='<?php echo $_REQUEST["tipo_b"]; ?>' >
    <input type=hidden name=export value='<?php echo @$_REQUEST["export"]; ?>' ><!--para el exportar -->
    <input type=hidden name=num_reg value='<?php echo $_REQUEST["num_reg"]; ?>' ><!--numero total de registros -->
    <input type=hidden name=pagina id='pagina' value='' >
        <?php if(isset($_REQUEST['no_encabezado'])) { ?>
    <input type=hidden name=no_encabezado id='no_encabezado' value='1' >
    <?php } ?>
    <input type=hidden name=adicionales value='<?php echo @$_REQUEST["adicionales"]; ?>' >
    <input type=hidden name=grafico value='<?php echo $_REQUEST["grafico"]; ?>' ><!--si lleva o no grafico -->
    <input type=hidden name=ordenar id='ordenar' value='<?php echo @$_REQUEST["ordenar"]; ?>' ><!--columna para ordenar -->
    <input type=hidden name=orden id='orden' value='<?php echo @$_REQUEST["orden"]; ?>' ><!--ascendente o descendente -->
    <input type=hidden name=subtitulo value='<?php echo @$_REQUEST["subtitulo"]; ?>' ><!--columna para crear subgrupos -->
    <input type=hidden name=registros value=<?php echo $_REQUEST["registros"]; ?> ><!--numero de registros por página-->
    <?php
    //para saber si la llamó el listados de pendientes de radicacion
    if(isset($_REQUEST["estado"]) )
      echo '<input type="hidden" name="estado" value="'.$_REQUEST["estado"].'">';
    }
    echo '<table id="documentolist" border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC" align=center>';
    if (phpmkr_num_fields($rs)>0) { ?>
	<?php
    //si la consulta tiene funciones relacionadas las separo en un vector
    if(isset($_REQUEST["func_busqueda"]) && $_REQUEST["func_busqueda"]<>"")
        {$funciones=explode(",",$_REQUEST["func_busqueda"]);

        }

    $titulos='<tr class="encabezado_list" style="text-transform: uppercase" align="center" valign="middle" >';
    /*si la consulta tiene funciones relacionadas creo en la primera fila varias columnas vacias
      para poner los enlaces ahi
    */

    if(isset($funciones))
      {
       for($h=0;$h<count($funciones);$h++)
          {$tipo=busca_filtro_tabla("tipo,etiqueta","funciones_busqueda","idfunciones_busqueda=".$funciones[$h],"orden asc",$conn);


           if($tipo[0]["tipo"]=='link' &&  (!isset($_REQUEST["export"]) || $_REQUEST["export"]==""))
              $titulos.="<td><br /></td>";
          }

      }
    //creo los titulos de las columnas con los alias de los campos

    for($i=0; $i<phpmkr_num_fields($rs); $i++)
      {
       if(phpmkr_field_name($rs, $i)!==$col_titulo  )
         {
          if(strpos(phpmkr_field_name($rs, $i),"_")>0)
             {if(strpos(phpmkr_field_name($rs, $i),"__")>0)
                $nombre_mostrar=str_replace("_"," ",substr(phpmkr_field_name($rs, $i),strpos(phpmkr_field_name($rs, $i),"__")+1));
              else
                $nombre_mostrar=str_replace("_"," ",substr(phpmkr_field_name($rs, $i),0));
             }
          else
              $nombre_mostrar=phpmkr_field_name($rs, $i);

          //oculto los titulos de las columnas que son llaves e imprimo los titulos de las otras
          if((!isset($alias_llaves) || (isset($alias_llaves) && !in_array(strtolower($nombre_mostrar),$alias_llaves)))&& $nombre_mostrar<>"fila" && $nombre_mostrar<>"key")
            {$titulos.='<td ><span class="phpmaker" style="color: #FFFFFF;">
                      <label style="text-decoration:underline; cursor:pointer" onclick="reordenar('."'".phpmkr_field_name($rs, $i)."','".strtolower(phpmkr_field_type($rs, $i))."'".');">';
             $titulos.=$nombre_mostrar.'</label>
                      </span></td>';

            }
         }
       else
         $indice=$i;
      }

  if(isset($funciones))
      {for($h=0;$h<=count($funciones);$h++)
      {$tipo=busca_filtro_tabla("tipo,etiqueta"," funciones_busqueda","tipo='funcion' and idfunciones_busqueda=".$funciones[$h],"orden asc",$conn);

        if($tipo[0]["tipo"]=='funcion')
        $titulos.="<td valign='middle'>".$tipo[0]["etiqueta"]."</td>";
      }


      }
  $titulos.='</tr><tbody>';
  $j=0;
  while ($row = @phpmkr_fetch_array($rs))
    {
     if($j==0 || (isset($titulo_anterior) && $titulo_anterior<>$row[$indice]))
       {if(isset($_SESSION["totales"]) && $_SESSION["totales"]<>"" && $j<>0)
            {
             foreach($_SESSION["totales"] as $valor)
                {if($valor[$col_titulo]==$titulo_anterior )
                    {echo "<tr><td>Totales</td></tr>";
                     foreach($valor as $llave=>$value)
                        {if($value<>$titulo_anterior)
                           echo "<tr><td bgcolor='#FFFFFF' colspan=".(phpmkr_num_fields($rs)-1).">$llave: $value</td></tr>";
                        }
                    }
                }
            }
        if($indice!=="")
          {if($row[$indice]<>"")
              $nombre=$row[$indice];
           else
               $nombre="<br/>";

           echo '<tr bgcolor="#0086DF"><td colspan='.(phpmkr_num_fields($rs)-1).' align=center>
                 <label style="text-decoration:underline; color:white; cursor:pointer" onclick="reordenar('."'".$col_titulo."'".');">
                 '.$nombre.'</label></td></tr>';
          }
       //imprime los encabezados de las columnas
        echo $titulos;
       }

       /*---------------------------------------------------------------------------------------
       imprimo las funciones relacionadas con la busqueda
       ---------------------------------------------------------------------------------------*/
       echo '<tr bgcolor="#FFFFFF">';
       if(isset($funciones) and (!isset($_REQUEST["export"]) || $_REQUEST["export"]==""))
          {for($h=0;$h<count($funciones);$h++)
              {//cadena sql

               $sql_func="select B.llave,A.* from ".DB.".funciones_busqueda A,".DB.".busquedas B where A.busquedas_idbusqueda=B.idbusquedas and A.idfunciones_busqueda=".$funciones[$h];

               $rs_func = phpmkr_query($sql_func,$conn) or error("PROBLEMAS AL EJECUTAR LA BUSQUEDA" . phpmkr_error() . ' SQL:' . $sql_func);

               //creo una matriz con los resultados
               /////////////////////////////////////////////////////////////////////
               //$funcion=$conn->Resultado($rs_func);
               $temp=phpmkr_fetch_array($rs_func);
              $funcion = array();
               for($i=0;$temp;$temp=phpmkr_fetch_array($rs_func),$i++)
                  array_push($funcion,$temp);
               phpmkr_free_result($rs_func);

               if($funcion[0]["tipo"]=='link')
                  { //creo el link con la pagina relacionada
                   $ruta=$funcion[0]["pagina"];
                   if(isset($funcion[0]["llave"]))
                      {$llaves=explode(";",$funcion[0]["llave"]);
                       $ruta=$funcion[0]["pagina"];
                       foreach($llaves as $llave)
                         {$llave=explode(",",$llave);
                          if(strpos($ruta,"?")>0)
                            $ruta.="&".$llave[1]."=".$row[$llave[1]];
                          else
                            $ruta.="?".$llave[1]."=".$row[$llave[1]];
                         }
                      }
                   //si tiene parametros adicionales los agrego al link
                   if($funcion[0]["parametros"]<>"")
                       {if(strpos($ruta,"?")>0)
                           $ruta.="&".$funcion[0]["parametros"];
                        else
                           $ruta.="?".$funcion[0]["parametros"];
                       }
                   echo "<td><a href='".$ruta."'>".strtoupper($funcion[0]["etiqueta"])."</a></td>";
                  }


              }
          }
       for($i=1; $i<phpmkr_num_fields($rs); $i++)
          {//oculto las columnas que son llaves
           if(strpos(phpmkr_field_name($rs, $i),"_")>0)
              $nombre_mostrar=str_replace("_"," ",substr(phpmkr_field_name($rs, $i),strpos(phpmkr_field_name($rs, $i),"_")+1));
           else
              $nombre_mostrar=phpmkr_field_name($rs, $i);

           if((!isset($alias_llaves) || (isset($alias_llaves) && !in_array(strtolower($nombre_mostrar),$alias_llaves))) && $nombre_mostrar<>"fila")
             {//imprimo los resultados
              echo "<td ";
              if(strtolower(trim($nombre_mostrar))=="numero" || strtolower(trim($nombre_mostrar))=="radicado")
                 echo " align=center ";
              echo ">";
              if($indice!=="")
                {if($i<>$indice )
                    $imprime=stripslashes((($row[phpmkr_field_name($rs, $i)]))).'<br/>';
                }
              else
                 $imprime=stripslashes(htmlspecialchars_decode(($row[(phpmkr_field_name($rs, $i))])));
              /*if(isset($_REQUEST["export"]) && $_REQUEST["export"])
                 echo ($imprime);
              else    */
                 echo $imprime;
              echo "</td>";
             }

          }
       if(isset($funciones))
          {for($h=0;$h<count($funciones);$h++)
              {//cadena sql
               $sql_func="select B.llave,A.* from ".DB.".funciones_busqueda A,".DB.".busquedas B where A.busquedas_idbusqueda=B.idbusquedas and A.idfunciones_busqueda=".$funciones[$h]." order by A.orden asc";

               $rs_func = phpmkr_query($sql_func,$conn) or error("PROBLEMAS AL EJECUTAR LA BUSQUEDA" . phpmkr_error() . ' SQL:' . $sql_func);

               //creo una matriz con los resultados
               /////////////////////////////////////////////////////////////////////
               //$funcion=$conn->Resultado($rs_func);

               $temp=phpmkr_fetch_array($rs_func);
              $funcion = array();
               for($i=0;$temp;$temp=phpmkr_fetch_array($rs_func),$i++)
                  array_push($funcion,$temp);
               phpmkr_free_result($rs_func);
               if($funcion[0]["tipo"]=='funcion')//si debo llamar una funcion
                  {
                    $parametros=array();
                    $parametros=explode(",",$funcion[0]["parametros"]);
                    for($i=0;$i<count($parametros);$i++)
                      {$parametros[$i]=$row[$parametros[$i]];
                      }
                    echo call_user_func_array($funcion[0]["pagina"], $parametros);
                  }
               }
           }
          echo '</tr>';

     $j++;
     //variable para controlar el cambio entre subgrupos
     if(isset($indice) && $indice<>"")
        $titulo_anterior=$row[$indice];
    }
  //si existen columnas para totalizar imprimo sus valores
  if(isset($_SESSION["totales"]) && $_SESSION["totales"]<>"" && $j<>0)
    {foreach($_SESSION["totales"] as $valor)
        {if($valor[$col_titulo]==$titulo_anterior )
            {echo "<tr><td>Totales</td></tr>";
             foreach($valor as $llave=>$value)
                {if($value<>$titulo_anterior)
                   {if($indice<>"")
                      echo "<tr><td bgcolor='#FFFFFF' colspan=".(phpmkr_num_fields($rs)-1).">$llave: $value</td></tr>";
                    else
                      echo "<tr><td bgcolor='#FFFFFF' colspan=".(phpmkr_num_fields($rs)).">$llave: $value</td></tr>";
                   }
                }
            }
        }
    }
    /*---------------------------------------------------------------------------------------
       controles del paginador
       ---------------------------------------------------------------------------------------*/
    ?>
        </tbody>
        <?php

        if(isset($funciones))
           $cols=phpmkr_num_fields($rs)+count($funciones);
        else
           $cols=phpmkr_num_fields($rs);
        //echo $_REQUEST["num_reg"]."//".$_REQUEST["registros"]."<br />";
        if($_REQUEST["num_reg"]>$_REQUEST["registros"])
        {
        echo '<tr ><td align=center colspan='.$cols.' bgcolor="#FFFFFF">';


        ?>
        <script>
    function validar_pagina(evento,valor)
     {var teclaPresionada=(document.all) ? evento.keyCode : evento.which;
      if(teclaPresionada==9 || teclaPresionada==13)
      	{document.getElementById("pagina").value="salto_pagina"; resultados.submit();
      	}
     }
</script>
        <input type=button value="<<" <?php if ($anterior==0) echo "disabled";?> onclick='document.getElementById("anterior").value="1"; resultados.submit();'>
        <input type=button value="<" <?php if ($anterior==0) echo "disabled";?> onclick='document.getElementById("pagina").value="anterior"; resultados.submit();'>
        <label > P&Aacute;GINA <input type=text size="5" name="salto_pagina" value="<?php echo ceil($anterior/$_REQUEST["registros"])+1;?>" onkeydown='validar_pagina(event)'> DE <?php echo ceil(($_REQUEST["num_reg"])/$_REQUEST["registros"]);?> </label>
        <input type=button value=">" <?php if ($anterior+$_REQUEST["registros"]>=$_REQUEST["num_reg"]) echo "disabled";?> onclick='document.getElementById("pagina").value="siguiente"; resultados.submit();'>
        <input type=button value=">>" <?php if ($anterior+$_REQUEST["registros"]>=$_REQUEST["num_reg"]) echo "disabled";?> onclick='document.getElementById("anterior").value="<?php echo ((ceil($_REQUEST["num_reg"]/$_REQUEST["registros"])-1)*$_REQUEST["registros"])+1;?>"; resultados.submit();'>

        <?php
        //calculo el último registro de la pagina actual

        }
        if($anterior+$_REQUEST["registros"]>=$_REQUEST["num_reg"])
            $ultimo=$_REQUEST["num_reg"];
        else
            $ultimo=$anterior+$_REQUEST["registros"];
        if($_REQUEST["num_reg"]>0)
        {
         echo "</td></tr><tr><td colspan=$cols bgcolor='#FFFFFF'>
              <center>REGISTROS ".($anterior+1)." A $ultimo DE ".($_REQUEST["num_reg"])."</center></td></tr>";
        }
        if(isset($funciones) && $funciones<>"")
         $botones=busca_filtro_tabla("","funciones_busqueda","tipo='button' and idfunciones_busqueda in(".implode(",",$funciones).")","orden asc",$conn);
        if(isset($botones) && $botones["numcampos"] && $_REQUEST["num_reg"]>0)
           {
            echo "<tr><td colspan=$cols bgcolor='#FFFFFF'><center>".$botones[0]["pagina"]()."</center></td></tr>";
           }

        ?>
        </table>
        </form>
    <?php
     /*---------------------------------------------------------------------------------------
       formulario para guardar la busqueda cuando es de tipo reporte
       ---------------------------------------------------------------------------------------*/
    if(isset($_REQUEST["tipo_b"])  && $_REQUEST["tipo_b"]=="reporte" && !isset($_REQUEST["anterior"]))
       { ?>
        <form name='guardar' id='guardar' action="guardar_busqueda.php?funcion=guardar_datos" method="post">
        <input type='hidden' name='subtitulo' value='<?php echo $_REQUEST["subtitulo"];?>'>
        <input type='hidden' name='sql' value='<?php echo $resultado;?>'>
        <input type='hidden' name='totales' value='<?php echo $_REQUEST["totales"];?>'>
        <table align=center>
        <tr id=b_guardar><td bgcolor='#FFFFFF' align=center><input type=button name=guardar value='GUARDAR BUSQUEDA' onclick='document.getElementById("f_guardar").style.display="";this.style.visibility="hidden";'></td></tr>
        <tr><td bgcolor='#FFFFFF' align=center><div id=f_guardar name=f_guardar style="display:none">
        <table>
        <tr>
        <td>Etiqueta:</td><td><input type=text name=etiqueta id=etiqueta size=30></td>
        </tr>
        <tr>
        <td>Módulo:</td>
        <td><select name=modulo id=modulo><option value="" selected>Seleccionar...</option>
        <?php
        $modulos=busca_filtro_tabla("A.*","modulo A","1=1","",$conn);
        for($i=0;$i<$modulos["numcampos"];$i++)
          echo "<option value=".$modulos[$i]["idmodulo"].">".$modulos[$i]["nombre"]."</option>"
        ?>
        </select>
        </td>
        </tr><input type='hidden' name='tipo_b' value='listado'>
        <!--tr>
        <td>Tipo:</td><td><select name=tipo_b>
        <option value=busqueda selected>Busqueda</option>
        <option value=reporte>Reporte</option>
        </select></td>
        </tr-->
        <tr>
        <td>Mostrar gráfico?:</td><td>
        <input type=radio name=grafico id=no value=0 checked><label for=no>No</label>
        <input type=radio name=grafico id=si value=1><label for=si>Si</label>
        </td>
        </tr>
        <tr>
        <td colspan=2 align=center><input type=button value="Guardar" onclick="validar_guardar();"></td>
        </tr>
        </table>
        </div>
        </td></tr>
        <input name=order_by type=hidden value='<?php echo $_REQUEST["ordenar"]; ?>'>
        </table>
        </form>
<?php
       }
    }

   /*---------------------------------------------------------------------------------------
    datos para llamar al iframe que contiene el grafico
    ---------------------------------------------------------------------------------------*/
  //lista de los campos de tipo string y lista de los campos de tipo numerico
  for($i=0; $i<phpmkr_num_fields($rs); $i++)
    {if(phpmkr_field_type($rs,$i)=="int")
        $numericos[]=phpmkr_field_name($rs,$i);
     else
        $cadenas[]=phpmkr_field_name($rs,$i);
    }
  //convierto las dos listas en cadenas
  if(isset($numericos))
    $numericos=implode(",",$numericos);
  if(isset($cadenas))
    $cadenas=implode(",",$cadenas);
  //llamo al iframe que crea el grafico
  if(@$_REQUEST["grafico"]=="1" && ($anterior+$_POST["registros"])>=$_REQUEST["num_reg"])
    {echo "

         </form>";
    }

    /////////////////////////////////////////////////////////////////////////////
  phpmkr_free_result($rs);
  }
  else
    echo "No ha seleccionado ningún parametro para la búsqueda";
}
else
{
 /*---------------------------------------------------------------------------------------
       pantalla inicial con drag and drop para las tablas funcionario, dependencia y cargo
    ---------------------------------------------------------------------------------------*/
?>

<script type="text/javascript" src="drag-drop-custom.js"></script>
<link rel="stylesheet" href="estilos.css" media="screen" type="text/css">
<link rel="stylesheet" href="demos.css" media="screen" type="text/css">

<body>
<table>
<tr><td>
<form name="formula" id="formula" action="index.php" method="post">
<div style="font-family: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif; font-size:2em;">BUSQUEDAS </div>
<div id="main" style="width:450px;height:600px;">
		<div id="leftColumn">
			<p><b>Tablas para la busqueda</b></p>
			<div id="dropContent">
        <div id="funcionario" class="dragableBox"> Funcionario</div>
        <div id="cargo" class="dragableBox"> Cargo</div>
        <div id="dependencia" class="dragableBox"> Dependencia</div>
      </div>
    </div>

			<div id="rightColumn">
  			<div id="dropBox" class="dropBox">
		  		<p><b>Tablas elegidas para la busqueda</b></p>
			   	<div id="dropContent2"></div>
	   		</div>
			</div>
      <input type="hidden" name="formu" id="formu">
</div>
<input type="submit" value="enviar" style="position:absolute; left:310px; top:435px;" onclick="LlenarTablas('<?php echo DB;?>');">
<input type=hidden name='tipo_b' value='reporte'>
</form>
</td></tr>
<tr><td>
<form name='listar' id='listar' action="guardar_busqueda.php?funcion=listar_busquedas" method="post">
<input type=submit name=guardar value='Cargar Busqueda' style="position:absolute; left:400px; top:435px;">
</form>
</td></tr>
</table>
<?php
if(!isset($_REQUEST["export"]) || $_REQUEST["export"]=="")
{
?>

<script type="text/javascript">
/*
<Clase>
<Nombre>LlenarTablas
<Parametros>
<Responsabilidades>Asignar la lista de las tablas al elemento tipo hidden
<Notas>Busca dentto del div que contiene aquellas tablas que fueron arrastradas para hacer la busqueda
        y asigna dicha busqueda al valor del campo hidden que es enviado en el post
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function LlenarTablas(db)
{
  var targetObj = document.getElementById('dropContent2');	// Creating reference to target obj
	var subDivs = targetObj.getElementsByTagName('DIV');	// Number of subdivs
	var tablas = "";
	for(var i=0; i<subDivs.length; i++)
	{
	  if(tablas != "")
      tablas += ','+db+"." + subDivs[i].id;
    else
      tablas +=db+"."+ subDivs[i].id;
  }
	document.getElementById('formu').value = tablas;
}

/*
<Clase>
<Nombre>dropItems
<Parametros>idOfDraggedItem: id del elemento que ha sido arrastrado; targetId: id del elemento al que ha sido arrastrado
            x: posicion x al que fue arrastrado; y: posicion y al que fue arrastrado
<Responsabilidades>Es la que hace el proceso de colocar el elemento arrastrado en el nuevo div.
<Notas>Verifica adonde fue arrastrado y adiciona el div a este nuevo elemento.
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function dropItems(idOfDraggedItem,targetId,x,y)
{
	if(targetId=='dropBox'){	// Item dropped on <div id="dropBox">
		var obj = document.getElementById(idOfDraggedItem);
		if(obj.parentNode.id=='dropContent2')return;
		document.getElementById('dropContent2').appendChild(obj);	// Appending dragged element as child of target box
	}
	if(targetId=='leftColumn'){	// Item dropped on <div id="leftColumn">
		var obj = document.getElementById(idOfDraggedItem);
		if(obj.parentNode.id=='dropContent')return;
		document.getElementById('dropContent').appendChild(obj);	// Appending dragged element as child of target box
	}
}

/*
<Clase>
<Nombre>onDragFunction
<Parametros>cloneId; origId: son los identificadores del div que esta siendo arrastrado
<Responsabilidades>Hace el efecto sobre el borde del elemento que es arrastrado
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function onDragFunction(cloneId,origId)
{
	self.status = 'Started dragging element with id ' + cloneId;
	var obj = document.getElementById(cloneId);
	obj.style.border='1px solid #F00';
}

// Es la parte para manejar que se puedan arrastrar los elementos
var dragDropObj = new DHTMLgoodies_dragDrop();
dragDropObj.addSource('funcionario',true,true,true,false,'onDragFunction');	// Make <div id="box1"> dragable. slide item back into original position after drop
dragDropObj.addSource('cargo',true,true,true,false,'onDragFunction');	// Make <div id="box2"> dragable. slide item back into original position after drop
dragDropObj.addSource('dependencia',true,true,true,false,'onDragFunction');	// Make <div id="box3"> dragable. slide item back into original position after drop
dragDropObj.addTarget('dropBox','dropItems');	// Set <div id="dropBox"> as a drop target. Call function dropItems on drop
dragDropObj.addTarget('leftColumn','dropItems'); // Set <div id="leftColumn"> as a drop target. Call function dropItems on drop
dragDropObj.init();

</script>

</body>
<?php
}
}

/*
<Clase>
<Nombre>codigoElemento
<Parametros>$id: identificar del campo que se quiere imprimir; $tipo: Es el tipo de componente que se quiere dibujar
            $valor: Su funcion varia dependiendo del tipo de componente que se maneje
<Responsabilidades>Generar el codigo HTML para pintar un campo para la busqueda
<Notas>Hace el switch para que dependiendo del tipo de componente se retorne el codigo correspondiente al mismo
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/

function codigoElemento($id, $tipo, $valor)
{global $i;
  $codigo = "";
  switch($tipo)
  {
    //Se pinta la caja de texto, verificando si existe un valor por defecto para la misma
    case "TEXT":
      $codigo = "<td colspan=2><input style=\"text-transform:none\" type=\"text\" name=\"".$id."\" id=\"".$id."\"";
      if($valor!=Null && $valor!="")
        $codigo .= " value=\"".$valor."\"";
      $codigo .= "></td>";
      break;
    //Se obtienen las opciones del radio a partir de valor, estas deben estar separadas por comas.
    case "RADIO":
      $valores = explode(",", $valor);
      $codigo = "<td colspan=2>";
      for($i=0; $i<count($valores); $i++)
        {
         if(strpos($valores[$i],";")>0)
            {$valor=explode(";",$valores[$i]);
             $codigo .= "<input type=\"radio\" name=\"".$id."\"  id=\"i".$id.$i."\" value=".$valor[0].">".$valor[1];
            }
         else
            {$codigo .= "<input type=\"radio\" name=\"".$id."\"  id=\"i".$id.$i."\" value=".$valores[$i].">".$valores[$i];
            }
        }
      $codigo .= "</td>";
      break;
    //para el campo tipo fecha
    case "FECHA":
      $codigo = "<td colspan=2>";
      $codigo.='<input type="text" readonly=true name="'.$id.'" id="fecha_'.$id.'" value="" >
                <input name="image" id="image_'.$id.'" type="image"
                onclick="popUpCalendar(this, this.form.fecha_'.$id.','."'yyyy-mm-dd'".');return false;"
                src="images/ew_calendar.gif" alt="Seleccione una Fecha" />';
      $codigo .= "</td>";
      break;
    //para el campo tipo autocompletar
    case "AUTOCOMPLETAR":
      $codigo = "<td colspan=2>";
      $codigo.='<input type=hidden name="'.$id.'" id="'.$id.'" value="" style=\"text-transform:none\">
                <div id="lista'.$id.'" onmouseout="v=1;" onmouseover="v=0;">
                <input type="text" size=53 value="" name="auto'.$id.'" id="auto'.$id.'"
                autocomplete=off onkeyup="if(Teclados(event,'.$id.') == 1)
                { autocompletar('.$id.',auto'.$id.'.value, '.$valor.','.$id.'); document.getElementById('."'comple".$id."'".').style.display='."'block'".';
                document.getElementById('."'".$id."'".').value='."''".';}" onkeydown = "ParaelTab(event,'.$id.','.$id.')"
                onfocus="document.getElementById('."'comple".$id."'".').style.display='."'block'".';">
                </div>
                <div id="comple'.$id.'" style="position:absolute"
                onmouseout="document.getElementById('."'comple".$id."'".').style.display='."'none'".';">
                </div>';
      break;
    //Se obtienen las valores del checkbos, desde valor, estas deben esatr separadas por comas
    case "CHECKBOX":
      $valores = explode(",", $valor);
      if(count($valores)>0)
      {
        $codigo.="<td><input type=\"hidden\" name=\"".$id."\" value=\"checkbox\">";
        $codigo.="<input type=\"hidden\" name=\"".$id."numero\" value=\"".count($valores)."\">";
        $codigo.="<input type=\"radio\" name=\"".$id."opcion\" id=\"".$id."AND\" value=\"AND\">AND";
        $codigo.="<input type=\"radio\" name=\"".$id."opcion\" id=\"".$id."OR\" value=\"OR\">OR</td>";
      }
      $codigo .= "<td>";
      for($i=0; $i<count($valores); $i++)
        $codigo .= "<input type=\"checkbox\" name=\"".$id.$i."\" id=\"".$id.$i."\" value=\"".$valores[$i]."\">".$valores[$i];
      $codigo .= "</td>";
      break;
    //Se obtiene la sentencia SQL a partir de la variable valor, se hace la busqueda correspondiente y se genera el codigo
    //para las opciones que tendrá el select. Se debe tener en cuenta que la consulta que se guarda en la base de datos en el
    //campo valor, tiene dos columnas, la primera es la que se colocará en el value de los option y la segunda es la que
    //aparecerá como tal en pantalla en el select
    case "SELECT":
      global $conn;
      $codigo="<td colspan=2><select id=\"".$id."\" name=\"".$id."\">";
      if($valor!="")
      {
        $rs = phpmkr_query($valor,$conn) or error("PROBLEMAS AL EJECUTAR LA BUSQUEDA" . phpmkr_error() . ' SQL:' . $valor);
        $codigo .= "<option value=\"\">Seleccione...</option>";
        while ($row = @phpmkr_fetch_array($rs))
        {
          $codigo .= "<option value=\"".$row[0]."\">".$row[1]."</option>";
        }
      }
      $codigo.="</select></td>";
      break;
  }
  return $codigo;
}
function operadores()
  {$cadena="<option value='<>' >diferente a</option>";
   $cadena.="<option value='='>igual a</option>";
   $cadena.="<option value='like1'  selected>frase similar a</option>";
   $cadena.="<option value='like2' >frase iniciada con</option>";
   $cadena.="<option value='like3' >frase terminada en</option>";
   $cadena.="<option value='>' >mayor que</option>";
   $cadena.="<option value='>=' >mayor o igual que</option>";
   $cadena.="<option value='<' >menor que</option>";
   $cadena.="<option value='<=' >menor o igual que</option>";
   return $cadena;
  }
/*
<Clase>
<Nombre>imprimir campos
<Parametros>
<Responsabilidades>Imprimir todos los campos para los cuales el usuario puede parametrizar la busqueda
<Notas>Da un recorrido por aquellas tablas que han sido elegidas para hacer la busqueda e invoca a la
        funcion que genere el codigo para cada uno de los campos de la busqueda
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function imprimirCampos()
{
  global $_REQUEST;
  global $conn;
  echo "<script type='text/javascript' src='popcalendar.js'></script>
        <head><meta http-equiv='content-type' content='text/html; charset=UTF-8'></head>
        <form id=\"campos\" name=\"campos\" action=\"index.php\" method=\"POST\">";
  //Las tablas recibidas llegan separadas por comas
  $tablasRecibidas = explode(",", $_REQUEST["formu"]);
  if(count($tablasRecibidas>0))
  {
   echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" bgcolor=\"#CCCCCC\" width=70%>";
  }
  $tablas = "";

  // Para cada una de las tablas, se hace el recorrido y se imprimen cada uno de los campos de la misma
  foreach($tablasRecibidas as $tabla)
  {
    $campos = busca_filtro_tabla("A.*", DB.".campos A", "A.tabla = '".strtolower($tabla)."' AND visible=1", "A.alias", $conn);
    if(count($campos)>0)
    {
      echo "<tr class=\"encabezado_list\"><td valign=\"top\" style='text-transform: uppercase' colspan=7><span class=\"phpmaker\" style=\"color: #FFFFFF;\">".str_replace("ft_","",substr($tabla,strpos($tabla,".")+1))."</span></td></tr>";
      echo "<tr style='text-transform: uppercase'>
            <input type=hidden name=tabla value=".strtolower(@$_REQUEST["tabla"]).">
            <td valign=\"top\"><span class=\"phpmaker\" style=\"color: #000000;\">Mostrar</span></td>
            <td valign=\"top\"><span class=\"phpmaker\" style=\"color: #000000;\">Conector</span></td>
            <td valign=\"top\"><span class=\"phpmaker\" style=\"color: #000000;\">Nombre</span></td>
            <td valign=\"top\"><span class=\"phpmaker\" style=\"color: #000000;\">Operador</span></td>
            <td valign=\"top\" colspan=2><span class=\"phpmaker\" style=\"color:#000000;\">Valor</span></td>";
      /*if($_REQUEST["tipo_b"]=="reporte")
           {echo "<td valign=\"top\" ><span class=\"phpmaker\" style=\"color: #000000;\">Funci&oacute;n</span></td>";
           }*/
      echo  "</tr>";
    }
    if(isset($_REQUEST['no_encabezado'])) { ?>
    <input type=hidden name=no_encabezado id='no_encabezado' value='1' >
    <?php }
    if(isset($_REQUEST['iddoc'])) { ?>
    <input type=hidden name=iddoc id='iddoc' value='<?php echo $_REQUEST["iddoc"]; ?>' >
    <?php }
    if(isset($_REQUEST["adicionales"]))
        {echo "<input value='".@$_REQUEST["adicionales"]."' type=hidden name='adicionales'>";
         $adicionales=explode(";",$_REQUEST["adicionales"]);
         foreach($adicionales as $variable)
           {$variable=explode(",",$variable);
            $_REQUEST[@$variable[0]]=@$variable[1];
           }
        }

    for($i=0; $i<=$campos["numcampos"]-1; $i++)
    {//echo $_REQUEST["adicionales"];
     if(!isset($_REQUEST[$campos[$i]["nombre"]]))
       {
        echo "<tr bgcolor=\"#FFFFFF\" >
              <td><input value=1 type=checkbox name='mostrar_".$campos[$i]["idcampos"]."' ";
        if($campos[$i]["seleccionado"])
           echo "checked ";
        echo "></td>
              <td><select name='conector_".$campos[$i]["idcampos"]."'>
              <option value='and' selected>Y</option><option value='or'>O</option></select></td>
              <td>".codifica_encabezado(strtoupper($campos[$i]["alias"]))."</td>";
        echo "<td><select name='op_".$campos[$i]["idcampos"]."'>
              ".operadores()."
              </select></td>";
        echo codigoElemento($campos[$i]["idcampos"], $campos[$i]["tipo"], $campos[$i]["valor"]);

        /*if($_REQUEST["tipo_b"]=="reporte")
          {echo "<td style='visibility=hidden'>";
          }
        else*/
          echo  "<td >";
        /*if($_REQUEST["tipo_b"]=="reporte")
        {echo "<select name='funcion_".$campos[$i]["idcampos"]."'>
              <option value='' selected>Ninguna...</option><option value='sum'>Suma</option><option value='avg'>Promedio</option><option value='count'>Contar</option></select></td>";
         } */
        echo "</tr>";
        $select[]=$tabla.".".$campos[$i]["alias"];
        $values[]=$tabla.".".$campos[$i]["nombre"];
      }
     else
       {echo "<input value=0 type=hidden name='mostrar_".$campos[$i]["idcampos"]."' >
              <input type=hidden name='conector_".$campos[$i]["idcampos"]."' value='and' >
              <input type=hidden name='op_".$campos[$i]["idcampos"]."' value='='>
              <input type='hidden' value='".$_REQUEST[$campos[$i]["nombre"]]."'
              name='".$campos[$i]["idcampos"]."'/>";
       }
    }
    if($campos["numcampos"]>0)
      if($tablas == "")
      $tablas .= $tabla;
      else
        $tablas .= ",".$tabla;
  }
  echo '<tr bgcolor="#FFFFFF">
        <td colspan=7><input type=button value="Seleccionar Todos" onclick="marcar_todos(true);" ><input type=button value="Desmarcar Todos" onclick="marcar_todos(false);" ></td></tr>';

  echo "</table>";
  if(count($tablasRecibidas>0))
    {/*if($_REQUEST["tipo_b"]=="reporte")
        $display="";
     else*/
        $display="none";
     echo "<div id=reporte style='display:$display'>
            <table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" bgcolor=\"#CCCCCC\" width=70%>
           <tr class=\"encabezado_list\" style='text-transform: uppercase'><td colspan=7>Crear subgrupos seg&uacute;n:</td></tr>";
     echo "<tr bgcolor=\"#FFFFFF\"><td colspan=7><select name='subtitulo' id='subtitulo'>
           <option value='0' selected>Seleccionar Campo...</option>";
     for($i=0;$i<count($select);$i++)
        {echo "<option value='".$values[$i]."'>".$select[$i]."</option>";
        }
     echo "</select></td></tr>";
     echo "<tr class=\"encabezado_list\" style='text-transform: uppercase'><td colspan=4>Agregar a totales:</td><td colspan=3>Funci&oacute;n a usar:</td>
           </tr>";
     echo "<tr bgcolor=\"#FFFFFF\"><td colspan=4><select name='totalizar' id='totalizar'>
           <option value='0' selected>Seleccionar Campo...</option>";
     for($i=0;$i<count($select);$i++)
        {echo "<option value='".$values[$i]."'>".$select[$i]."</option>";
        }
     echo "</select></td>
           <td colspan=3><select name='ftotal' id='ftotal'>
            <option value='sum' selected>Suma</option>
            <option value='avg'>Promedio</option><option value='count'>Contar</option></select>
            <input type=button value='Agregar' onclick='adicionar(\"totales\");'>
           </td>
           </tr>";
     echo "<tr class=\"encabezado_list\" style='text-transform: uppercase'><td colspan=7>Totales:</td></tr>";
     echo "<tr><td colspan=7 bgcolor=\"#FFFFFF\"><input type='text' value='' id='l_totales' readonly=true size=120>
           <input type='hidden' name='totales' id='totales'>
           <input type=button onclick='limpiar(\"totales\");' value='Limpiar'></td></tr>";
     echo "<tr class=\"encabezado_list\" style='text-transform: uppercase'><td colspan=7>Agrupar por:</td></tr>";
     echo "<tr><td colspan=7 bgcolor=\"#FFFFFF\"><input type='text' value='' id='l_agrupados' readonly=true size=120>
           <input type='hidden' name='agrupados' id='agrupados'><input type=button onclick='limpiar(\"agrupados\");' value='Limpiar'>
           </td></tr>";
     echo "<!--tr class=\"encabezado_list\" style='text-transform: uppercase'><td colspan=7>Ordenar por:</td></tr>";
     echo "<tr><td colspan=7 bgcolor=\"#FFFFFF\"><input type='text' value='' id='l_ordenados' readonly=true size=120>
           <input type='hidden' name='ordenados' id='ordenados'><input type=button onclick='limpiar(\"ordenados\");' value='Limpiar'>
           </td></tr-->";
     echo "<tr class=\"encabezado_list\" style='text-transform: uppercase'><td colspan=7>Agregar campo al agrupar:</td></tr>";
     echo "<tr bgcolor=\"#FFFFFF\" align=center><td colspan=4>
           <select name='l_campos' id='l_campos'>
           <option value='0' selected>Seleccionar Campo...</option>";
     for($i=0;$i<count($select);$i++)
        {echo "<option value='".$values[$i]."'>".$select[$i]."</option>";
        }
     echo "</select>
           </td><td colspan=3><input type=button id='b_agrupar' value='Agregar' onclick='adicionar(\"agrupados\");'></td>
           <!--td colspan=2><input type=button id='b_ordenar' value='Ordenar por' onclick='adicionar(\"ordenados\");'></td--></tr>
           </table></div><table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" bgcolor=\"#CCCCCC\" width=70% >
           <tr class=\"encabezado_list\" style='text-transform: uppercase'><td colspan=7>Adicionales:</td></tr>
           <tr bgcolor=\"#FFFFFF\"><td colspan=2>NO REPETIR DATOS EN LA CONSULTA:</td>
           <td colspan=5><input name='distinct' type='checkbox' checked value=1></td></tr>
           <!--tr bgcolor=\"#FFFFFF\"><td colspan=2>MOSTRAR GR&Aacute;FICO:</td>
           <td colspan=5><input name='grafico' type='checkbox' value=1></td></tr-->
           <tr bgcolor=\"#FFFFFF\"><td colspan=2>REGISTROS POR P&Aacute;GINA:</td>
           <td colspan=5><input name='registros' id='registros' type='text' value='10'></td></tr>
           <input name='sql' id='sql' type='hidden' value=''>
           <input name='tipo_b' id='tipo' type='hidden' value='".$_REQUEST["tipo_b"]."'>
           ";
     if(isset($_REQUEST["func_busqueda"]))
        echo "<input name=func_busqueda value='".$_REQUEST["func_busqueda"]."' type=hidden>";
     if(isset($_REQUEST["llave"]))
        echo "<input name=llave value='".$_REQUEST["llave"]."' type=hidden>";
     if(isset($_REQUEST["tabla"]))
        echo "<input name=tabla value='".$_REQUEST["tabla"]."' type=hidden>";
     if(isset($_REQUEST["orden"]))
        echo "<input name=orden value='".$_REQUEST["orden"]."' type=hidden>";
     if(isset($_REQUEST["ordenado"]))
        echo "<input name=ordenado value='".$_REQUEST["ordenado"]."' type=hidden>";
    }

     // Aqui nos damos cuenta si el buscador es para el listado de documentos para llenar un expediente
    if(isset($_REQUEST["pagina_exp"]) && $_REQUEST["pagina_exp"]<>"")
    { echo "<input type='hidden' name='pagina_exp' value='".$_REQUEST["pagina_exp"]."'>";
    }
  //Boton para enviar el formulario una vez se halla diligenciado y el elemento hidden para enviar de nuevo las tablas seleccionadas
  echo "</table><input type=\"button\" value=\"Buscar\" onclick=\"validar();\">
        <input type=\"hidden\" name=\"busqueda\" value=\"buscar\"><input type=\"hidden\" name=\"tablas\" value=\"".$tablas."\">
        </form>";
}

/*
<Clase>
<Nombre>generarSQL
<Parametros>
<Responsabilidades>Generar el codigo SQL que finalmente hará la búsqueda que se pretendia desde el principio
<Notas>Mira cada una de las tablas que fueron seleccionadas y las compara entre todas ellas. Buscando en la base de datos la
      ruta de tablas de la base de datos para hacer la union de estas. Con cada una de dichas tablas de cada ruta que se encuentre
      se hace la busqueda de los campos que listará. Ademas busca aquellos elementos adicionales que esten asignados a dicha ruta
      como where adicionales, order, group o having.
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function generarSQL()
{
    global $conn;
    global $_REQUEST;
    $where = "";
    $tablas = "";
    $arraytablas = array();
    $alias_tablas=array();
    $indice_alias=0;
    $columnas = "";
    $group = "";
    $order = "";
    $join=array();
    $having = "";
    $ruta="";
    $sobrenombres = "";
    $todas_tablas=array();
    global $agregados;

    if(isset($_REQUEST["filtro"]) && $_REQUEST["filtro"]=="funcionario" && !(strpos($_REQUEST["tablas"],"buzon_salida")>0))
        $_REQUEST["tablas"].=",".DB.".buzon_salida";
    //Nuevamente las tablas llegan separadas por comas
    $lista_tablas = explode(",", strtolower($_REQUEST["tablas"]));
    for($indice_alias=0;$indice_alias<count($lista_tablas);$indice_alias++)
      {$alias_tablas[$indice_alias]=chr(65+$indice_alias);
       $todas_tablas[$indice_alias]=$lista_tablas[$indice_alias];
      }
    // Ciclo con cada una de las tablas

    for($i=0; $i<count($lista_tablas)-1; $i++)
    {
      // Compara la actual con cada una de las otras, buscando en la base de datos el campo que las enlaza
      for($j=$i+1; $j<count($lista_tablas); $j++)
      {
        // Encuentra la ruta entre las tablas para poder realizar la busqueda
        $resultado = busca_filtro_tabla("A.*", DB.".busqueda_ruta A", "(A.tabla_origen='".$lista_tablas[$i]."' AND A.tabla_destino='".$lista_tablas[$j]."') OR (A.tabla_origen='".$lista_tablas[$j]."' AND A.tabla_destino='".$lista_tablas[$i]."')", "", $conn);
        //print_r($resultado);
        $camino = explode(",", $resultado[0]["ruta"]);

        // Ciclo para realizar la busqueda con la ruta especificada
        for($z=0; $z<count($camino)-1; $z++)
        {
          if(in_array($camino[$z], $arraytablas)==false)
          {
            array_push($arraytablas, $camino[$z]);

            if(in_array($camino[$z], $todas_tablas)==false)
            {
              array_push($todas_tablas, $camino[$z]);
              array_push($alias_tablas, chr($indice_alias+65));
              $indice_alias++;
            }
            if(in_array($camino[$z+1], $todas_tablas)==false)
            {
              array_push($todas_tablas, $camino[$z+1]);
              array_push($alias_tablas, chr($indice_alias+65));
              $indice_alias++;
            }
            $pos_alias=array_search($camino[$z],$todas_tablas);

            if($tablas=="")
              $tablas.=$camino[$z]." ".$alias_tablas[$pos_alias];
            else
              $tablas.=",".$camino[$z]." ".$alias_tablas[$pos_alias];

            $pos_alias=array_search($camino[$z],$todas_tablas);

            $agrupados[]=recorrerCampos($camino[$z], $columnas, $where,$alias_tablas[$pos_alias], $sobrenombres);

            $res=busca_filtro_tabla("A.campo_origen, A.campo_destino,A.mostrar_nulos", DB.".busqueda_union A", "(A.tabla_origen='".$camino[$z]."' AND A.tabla_destino='".$camino[$z+1]."') OR (A.tabla_origen='".$camino[$z+1]."' AND A.tabla_destino='".$camino[$z]."')", "", $conn);
            //print_r($res);
            $campoorigen = $res[0]["campo_origen"];
            $campodestino = $res[0]["campo_destino"];

            $origen=busca_filtro_tabla("A.nombre, A.tabla", DB.".campos A", "A.idcampos=".$campoorigen,"",$conn);
            $pos_alias2=array_search($origen[0]["tabla"],$todas_tablas);
            $destino=busca_filtro_tabla("A.nombre, A.tabla", DB.".campos A", "A.idcampos=".$campodestino,"",$conn);
            $pos_alias=array_search($destino[0]["tabla"],$todas_tablas);
          if($res[0]["mostrar_nulos"]=="")
            {if($ruta=="")
              $ruta.=" ".$alias_tablas[$pos_alias2].".".$origen[0]["nombre"]."=";
             else
              $ruta.=" AND ".$alias_tablas[$pos_alias2].".".$origen[0]["nombre"]."=";

            $ruta.=$alias_tablas[$pos_alias].".".$destino[0]["nombre"];
            }
          else
            {if($res[0]["mostrar_nulos"]==1)
             { if(MOTOR=="Oracle")
                $join[]=" ".$origen[0]["tabla"]." ".$alias_tablas[$pos_alias2]." join ".$destino[0]["tabla"]." ".$alias_tablas[$pos_alias]." on(".$alias_tablas[$pos_alias].".".$destino[0]["nombre"]."(+)=".$alias_tablas[$pos_alias2].".".$origen[0]["nombre"].") ";
               else
                $join[]=" ".$origen[0]["tabla"]." ".$alias_tablas[$pos_alias2]." RIGHT join ".$destino[0]["tabla"]." ".$alias_tablas[$pos_alias]." on(".$alias_tablas[$pos_alias].".".$destino[0]["nombre"]."=".$alias_tablas[$pos_alias2].".".$origen[0]["nombre"].") ";
             }
             else
             {
              if(MOTOR=="Oracle")
                $join[]=" ".$origen[0]["tabla"]." ".$alias_tablas[$pos_alias2]." join ".$destino[0]["tabla"]." ".$alias_tablas[$pos_alias]." on(".$alias_tablas[$pos_alias].".".$destino[0]["nombre"]."=".$alias_tablas[$pos_alias2].".".$origen[0]["nombre"]."(+) ) ";
               else
                $join[]=" ".$origen[0]["tabla"]." ".$alias_tablas[$pos_alias2]." LEFT join ".$destino[0]["tabla"]." ".$alias_tablas[$pos_alias]." on(".$alias_tablas[$pos_alias].".".$destino[0]["nombre"]."=".$alias_tablas[$pos_alias2].".".$origen[0]["nombre"].") ";
             }
            }
           }
          else
            if($z==count($camino)-2)
              if(in_array($camino[count($camino)-1], $arraytablas)==FALSE)
              {
                  array_push($arraytablas, $camino[count($camino)-1]);
                  if(in_array($camino[count($camino)-1], $todas_tablas)==false)
                  {
                    array_push($todas_tablas, $camino[count($camino)-1]);
                    array_push($alias_tablas, chr($indice_alias+65));
                    $indice_alias++;
                  }
                  $indice_alias++;
                  $pos_alias=array_search($camino[count($camino)-1],$todas_tablas);
                  $tablas.=",".$camino[count($camino)-1]." ".$alias_tablas[$pos_alias];

                  $agrupados[]=recorrerCampos($camino[count($camino)-1], $columnas, $where,$alias_tablas[$pos_alias],$sobrenombres);

                  $res=busca_filtro_tabla("A.campo_origen, A.campo_destino,mostrar_nulos", DB.".busqueda_union A", "(A.tabla_origen='".$camino[count($camino)-2]."' AND A.tabla_destino='".$camino[count($camino)-1]."') OR (A.tabla_origen='".$camino[count($camino)-1]."' AND A.tabla_destino='".$camino[count($camino)-2]."')", "", $conn);
                  $campoorigen = $res[0]["campo_origen"];
                  $campodestino = $res[0]["campo_destino"];

                  $origen=busca_filtro_tabla("A.nombre, A.tabla", DB.".campos A", "A.idcampos=".$campoorigen,"",$conn);
                  $pos_alias2=array_search($origen[0]["tabla"],$todas_tablas);

                  $destino=busca_filtro_tabla("A.nombre, A.tabla", DB.".campos A", "A.idcampos=".$campodestino,"",$conn);
                  $pos_alias=array_search($destino[0]["tabla"],$todas_tablas);
                  if($res[0]["mostrar_nulos"]=="")
                    {if($ruta=="")
                      $ruta.=" ".$alias_tablas[$pos_alias2].".".$origen[0]["nombre"]."=";
                     else
                      $ruta.=" AND ".$alias_tablas[$pos_alias2].".".$origen[0]["nombre"]."=";

                    $ruta.=$alias_tablas[$pos_alias].".".$destino[0]["nombre"];
                    }
                   elseif($res[0]["mostrar_nulos"]==1)
                    {
                    if(MOTOR=='oracle')
                    $join[]=" ".$origen[0]["tabla"]." ".$alias_tablas[$pos_alias2]." join ".$destino[0]["tabla"]." ".$alias_tablas[$pos_alias]." on(".$alias_tablas[$pos_alias].".".$destino[0]["nombre"]."(+)=".$alias_tablas[$pos_alias2].".".$origen[0]["nombre"].") ";
                    else
                    $join[]=" ".$origen[0]["tabla"]." ".$alias_tablas[$pos_alias2]." left join ".$destino[0]["tabla"]." ".$alias_tablas[$pos_alias]." on(".$alias_tablas[$pos_alias].".".$destino[0]["nombre"]."=".$alias_tablas[$pos_alias2].".".$origen[0]["nombre"].") ";
                    }
                  elseif($res[0]["mostrar_nulos"]==2)
                    {
                    if(MOTOR=='oracle')
                     $join[]=" ".$origen[0]["tabla"]." ".$alias_tablas[$pos_alias2]." join ".$destino[0]["tabla"]." ".$alias_tablas[$pos_alias]." on(".$alias_tablas[$pos_alias].".".$destino[0]["nombre"]."=".$alias_tablas[$pos_alias2].".".$origen[0]["nombre"]."(+)) ";
                    else
                     $join[]=" ".$origen[0]["tabla"]." ".$alias_tablas[$pos_alias2]." left join ".$destino[0]["tabla"] ." ".$alias_tablas[$pos_alias]." on(".$alias_tablas[$pos_alias].".".$destino[0]["nombre"]."=".$alias_tablas[$pos_alias2].".".$origen[0]["nombre"].") ";
                    }
             }
        }
        //Hace la misma busqueda para la ultima tabla de la lista
        if(in_array($camino[count($camino)-1], $arraytablas)==FALSE)
        {
          array_push($arraytablas, $camino[count($camino)-1]);
          if(in_array($camino[count($camino)-1], $todas_tablas)==false)
          {
               array_push($todas_tablas, $camino[count($camino)-1]);
               array_push($alias_tablas, chr($indice_alias+65));
               $indice_alias++;
          }
          $indice_alias++;
          $pos_alias=array_search($camino[count($camino)-1],$todas_tablas);
          $tablas.=",".$camino[count($camino)-1]." ".$alias_tablas[$pos_alias];
          //echo($tablas." $i $j<br /> ");
          $agrupados[]=recorrerCampos($camino[count($camino)-1], $columnas, $where,$alias_tablas[$pos_alias],$sobrenombres);

        }
      }
    }
    // En caso que la busqueda sea de una sola tabla
    if(count($lista_tablas)==1)
    {
      $agrupados[]=recorrerCampos($_REQUEST["tablas"], $columnas, $where,"A",$sobrenombres);
      $tablas = $_REQUEST["tablas"]." A";
    }
    //miro si existen campos agrupados
    if($_REQUEST["agrupados"]<>"")
      {$aux=explode(".",$_REQUEST["agrupados"]);
       $pos_alias=array_search($aux[0],$todas_tablas);
       if($group=="")
          $group=$alias_tablas[$pos_alias].".".$aux[1];
       else
          $group.=",".$alias_tablas[$pos_alias].".".$aux[1];
      }
    //miro si existen campos para ordenar
    if(@$_REQUEST["ordenados"]<>"")
      {$aux=explode(".",$_REQUEST["ordenados"]);
       $pos_alias=array_search($aux[0],$todas_tablas);
       if($group=="")
          $group=$alias_tablas[$pos_alias].".".$aux[1];
       else
          $group.=",".$alias_tablas[$pos_alias].".".$aux[1];
      }
    $_SESSION["lista_tablas"]=$todas_tablas;
    $_SESSION["alias"]=$alias_tablas;
    //Arma la sentencia final
    $sSql="SELECT ";
    //si se va a usar el distinct
    if(@$_REQUEST["distinct"]==1)
      $sSql.="DISTINCT ";
    if(count($join)>0)
      {$join2=implode(",",$join);
       $tablas2=explode(",",$tablas);
       foreach($tablas2 as $tabla_aux)
         {if(strpos($join2,$tabla_aux)===false)
            {$join2=$tabla_aux.",".$join2;
            }
         }
      }

    if($sSql=="")
     $sSql="SELECT ".$columnas." FROM ";
    else
     $sSql.=$columnas." FROM ";
    if(count($join)>0)
      $sSql.=$join2;
    else
      $sSql.=str_replace(DB,strtolower(DB),$tablas);
    if($ruta<>"" && $where<>"")
      $where=" ($ruta) AND ($where)";
    else if($ruta<>"")
       $where=" ($ruta)";
    else if($where<>"")
       $where=" ($where)";
    else
       $where=" 1 = 1";

    if(isset($_REQUEST["filtro"]) && $_REQUEST["filtro"]=="funcionario")
       {$nick=$alias_tablas[count($alias_tablas)-1];
        if(isset($_REQUEST["tipo_filtro"]) && $_REQUEST["tipo_filtro"]=="origen")
          $where.=" and (".$nick.".origen='".usuario_actual("funcionario_codigo")."')";
        if(isset($_REQUEST["tipo_filtro"]) && $_REQUEST["tipo_filtro"]=="destino")
          $where.=" and (".$nick.".destino='".usuario_actual("funcionario_codigo")."')";
        else
          $where.=" and (".$nick.".origen='".usuario_actual("funcionario_codigo")."' or ".$nick.".destino='".usuario_actual("funcionario_codigo")."')";
       }
    if(isset($_REQUEST["archivo_idarchivo"]))
       {$where.=" and archivo_idarchivo IS NULL ";
       }
    if(isset($_REQUEST["listado_plantillas"]))
       {$where.=" and plantilla<>'' ";
       }
    if(isset($_REQUEST["lista_docs"]) && $_REQUEST["lista_docs"]<>"0")
       {$lista=str_replace("-",",",$_REQUEST["lista_docs"]);
        $docs_v=array_chunk(explode(",",$lista), 1000);
        if(count($docs_v)>1)
          {
           foreach($docs_v as $fila)
              $docs2[]=" iddocumento in (".implode(",",$fila).") ";
           $docs=implode(" or ",$docs2);
          }
        else
          {$docs=" iddocumento in (".implode(",",$docs_v[0]).") ";
          }
        $where.=" and ($docs)";
       }
    if($where<>"")
       $sSql.=" WHERE ".$where;
    if($group<>"")
      $sSql .= " GROUP BY ".$group;
    if($having<>"")
      $sSql .= " HAVING ".$having;
    if($order<>"")
      $sSql .= " ORDER BY ".$order;
    return $sSql;
}

/*
<Clase>
<Nombre>recorrerCampos
<Parametros>$tabla: La tabla sobre la que se hará la búsqueda; $columnas: parametro por referencia, contiene las columnas de la busqueda final
            $where: parametro por referencia, contiene la sentencia where para la busqueda final
<Responsabilidades>Hacer un recorrido por los campos que correspondan a la tabla, genera las columnas para la busqueda,
                  y a partir de estos verifica si existe algun valor determinado de este campo para la busqueda, si es asi,
                  genera este en el where para la busqueda
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function recorrerCampos($tabla, &$columnas, &$where,$alias_tabla, &$sobrenombres)
{
  //$conn=phpmkr_db_connect();
  global $_REQUEST,$sql,$conn;
  //Busca las cada uno de los campos que corresponden a la tabla
  $campos = busca_filtro_tabla("A.idcampos, A.tabla, A.nombre, A.alias,A.tipo_dato", DB.".campos A", "A.tabla = '".strtolower($tabla)."' AND visible=1", "", $conn);
//  print_r($campos);
//  die($tabla);
  //busco si hay funciones de agregacion

  global $agregados,$conn;
  $agrupados="";
  $mostrar="";
  //Ciclo para cada uno de los campos
  for($ind=0; $ind<$campos["numcampos"]; $ind++)
  {
   if($campos[$ind]["tipo_dato"]=='clob'&& MOTOR=="Oracle")
      $nombre_campo= "to_char(".$alias_tabla.".".$campos[$ind]["nombre"].")";
   elseif($campos[$ind]["tipo_dato"]=='date')
      $nombre_campo= fecha_db_obtener($alias_tabla.".".$campos[$ind]["nombre"],'Y-m-d');
   elseif($campos[$ind]["tipo_dato"]=='datetime')
      $nombre_campo= fecha_db_obtener($alias_tabla.".".$campos[$ind]["nombre"],'Y-m-d H:i:s');
   elseif($campos[$ind]["tipo_dato"]=='int'&& MOTOR=="Oracle")
      $nombre_campo= "cast(".$alias_tabla.".".$campos[$ind]["nombre"]." as number)";
   elseif($campos[$ind]["tipo_dato"]=='int'&& MOTOR=="MySql")
      $nombre_campo= "cast(".$alias_tabla.".".$campos[$ind]["nombre"]." as unsigned)";
   else
      $nombre_campo= $alias_tabla.".".$campos[$ind]["nombre"];

   if(@$_REQUEST["mostrar_".$campos[$ind]["idcampos"]]==1)
      {//Forma las columnas para la busqueda
       if($columnas=="")
       {
         $columnas = $nombre_campo." as ".str_replace(" ","_",$campos[$ind]["alias"]);
         $sobrenombres = str_replace(" ","_",$campos[$ind]["alias"]);
       }
       else
       {
         $columnas .= ", ".$nombre_campo." as ".str_replace(" ","_",$campos[$ind]["alias"]);
         $sobrenombres .= ", ".str_replace(" ","_",$campos[$ind]["alias"]);
       }
      }

    if(@$_REQUEST["funcion_".$campos[$ind]["idcampos"]]<>"")
      {
       if($_REQUEST["funcion_".$campos[$ind]["idcampos"]]=="count")
          $f_alias="CONTAR";
       else if($_REQUEST["funcion_".$campos[$ind]["idcampos"]]=="sum")
          $f_alias="SUMAR";
       else if($_REQUEST["funcion_".$campos[$ind]["idcampos"]]=="avg")
          $f_alias="PROMEDIO";

       if($columnas=="")
       {
         $columnas = $_REQUEST["funcion_".$campos[$ind]["idcampos"]]."(".$alias_tabla.".".$campos[$ind]["nombre"].") as ".$f_alias."__".str_replace(" ","_",$campos[$ind]["alias"]);
         $sobrenombres = $f_alias."__".str_replace(" ","_",$campos[$ind]["alias"]);
       }
       else
       {
         $columnas .= ",".$_REQUEST["funcion_".$campos[$ind]["idcampos"]]."(".$alias_tabla.".".$campos[$ind]["nombre"].") as ".$f_alias."__".str_replace(" ","_",$campos[$ind]["alias"]);
         $sobrenombres = ", ".$f_alias."__".str_replace(" ","_",$campos[$ind]["alias"]);
       }
      }
    //Verifica si en el POST llegó algun elemento que corresponda a este campo, para tenerlo en cuenta en el where
    if(isset($_REQUEST[$campos[$ind]["idcampos"]]) && ($_REQUEST[$campos[$ind]["idcampos"]]<>""))
    {$tipo=busca_filtro_tabla("lower(tipo) as tipo","campos","idcampos=".$campos[$ind]["idcampos"],"",$conn);
        // el caso para el checkbox es diferente porque este puede generar una o mas condiciones

        if($tipo[0]["tipo"]<>"checkbox" && $tipo[0]["tipo"]<>"")
        {
         if($where<>"")
             $where.=" ".$_REQUEST["conector_".$campos[$ind]["idcampos"]];
          if($tipo[0]["tipo"]=="fecha")
             $where.=" ".fecha_db_obtener($alias_tabla.".".$campos[$ind]["nombre"],'Y-m-d')." ";
          elseif(!is_numeric($_REQUEST[$campos[$ind]["idcampos"]]))
             $where.=" lower(".$alias_tabla.".".$campos[$ind]["nombre"].") ";
          else
             $where.=" ".$alias_tabla.".".$campos[$ind]["nombre"]." ";

          if($_REQUEST["op_".$campos[$ind]["idcampos"]]=="like1")
             $where.="like '%".(strtolower(($_REQUEST[$campos[$ind]["idcampos"]])))."%' ";
          elseif($_REQUEST["op_".$campos[$ind]["idcampos"]]=="like2")
             $where.="like '".(strtolower(($_REQUEST[$campos[$ind]["idcampos"]])))."%' ";
          elseif($_REQUEST["op_".$campos[$ind]["idcampos"]]=="like3")
             $where.="like '%".(strtolower(($_REQUEST[$campos[$ind]["idcampos"]])))."' ";
          elseif(!is_numeric($_REQUEST[$campos[$ind]["idcampos"]]))
             $where.=$_REQUEST["op_".$campos[$ind]["idcampos"]]."'".(strtolower(($_REQUEST[$campos[$ind]["idcampos"]])))."' ";
          else
             $where.=$_REQUEST["op_".$campos[$ind]["idcampos"]].$_REQUEST[$campos[$ind]["idcampos"]];

        }
        //Caso CheckBox
        elseif($tipo[0]["tipo"]=="checkbox")
        {
          $wherecheck = "";
          for($c=0; $c<$_REQUEST[$campos[$ind]["idcampos"]."numero"]; $c++)
          {
            if(isset($_REQUEST[$campos[$ind]["idcampos"].$c]) && $_REQUEST[$campos[$ind]["idcampos"].$c]<>"")
            {
              if($wherecheck=="")
                $wherecheck="(".$alias_tabla.".".$campos[$ind]["nombre"]."='".$_REQUEST[$campos[$ind]["idcampos"].$c]."'";
              else
                $wherecheck.=" ".$_REQUEST[$campos[$ind]["idcampos"]."opcion"]." ".$alias_tabla.".".$campos[$ind]["nombre"]."='".$_REQUEST[$campos[$ind]["idcampos"].$c]."'";
            }
          }
          if($wherecheck!="")
            if($where=="")
              $where .= $wherecheck.")";
            else
              $where .= " AND ".$wherecheck.")";
        }
    }
  }
 return($agrupados);
}
if(!isset($_REQUEST["export"]) || $_REQUEST["export"]=="")
{
?>

<script>
/*
<Clase>
<Nombre>validar_guardar
<Parametros>
<Responsabilidades>valida que el formulario para guardar la consulta tenga todos los campos llenos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/

function validar_guardar()
  {
   if(document.getElementById("etiqueta").value=="" || document.getElementById("modulo").value=="")
     alert("Debe llenar todos los campos del formulario.");
   else
     document.getElementById("guardar").submit();
  }
  /*
<Clase>
<Nombre>reordenar
<Parametros>campo
<Responsabilidades>establece el campo por el cual se ordenarán los resultados
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function reordenar(campo,tipo)
  {
   var primero=campo.substring(0,campo.indexOf("_"));
   /*if(campo=="documento__numero")
     document.getElementById("ordenar").value="ORDER BY cast("+campo+" as unsigned)";
   else*/
   if(tipo=='varchar'||tipo=='varchar2')
     document.getElementById("ordenar").value="ORDER BY lower(trim("+campo+"))";
   else
     document.getElementById("ordenar").value="ORDER BY "+campo;
   if(document.getElementById("orden").value=="asc")
      document.getElementById("orden").value="desc";
   else if(document.getElementById("orden").value=="desc")
      document.getElementById("orden").value="asc";
   document.getElementById("resultados").submit();
  }
/*
<Clase>
<Nombre>adicionar
<Parametros>campo:nombre del campo que se desea agregar a la lista
<Responsabilidades>se encarga de adicionar un nuevo elemento a la lista de los totales
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/

function adicionar(campo)
  {
   if(campo=="totales")
     {//miro si el select de los campos tiene alguno seleccinado
       if(document.getElementById("totalizar").value==0)
          alert("Debe elegir un campo primero.");
       else
          {
           //si no hay ningun elemento todavía en agrupar u ordenar
           if(document.getElementById(campo).value=="")
              {//pongo en agrupar u ordenar el nombre real del campo
               document.getElementById(campo).value=document.getElementById("ftotal").value+"("+document.getElementById("totalizar").value+")";
               //pongo en l_campos la mascara del campo
               indice=document.getElementById("totalizar").selectedIndex;
               indice2=document.getElementById("ftotal").selectedIndex;
               document.getElementById("l_"+campo).value=document.getElementById("ftotal").options[indice2].text+"("+document.getElementById("totalizar").options[indice].text+")";
              }
           else
              {//valido si el campo elegido ya se encuentra en la lista
               var valor=document.getElementById(campo).value;
               encontrado=valor.match(document.getElementById("totalizar").value);
               if(encontrado==null)
                  {//pongo en agrupar u ordenar el nombre real del campo
                   document.getElementById(campo).value+=","+document.getElementById("ftotal").value+"("+document.getElementById("totalizar").value+")";
                   //pongo en l_campos la mascara del campo
                   indice=document.getElementById("totalizar").selectedIndex;
                   indice2=document.getElementById("ftotal").selectedIndex;
                   document.getElementById("l_"+campo).value+=","+document.getElementById("ftotal").options[indice2].text+"("+document.getElementById("totalizar").options[indice].text+")";
                  }
               else
                  {alert("este campo ya se encuentra en la lista");
                  }
               }
          }
     }
   else
     {//miro si el select de los campos tiene alguno seleccinado
       if(document.getElementById("l_campos").value==0)
          alert("Debe elegir un campo primero.");
       else
          {//si no hay ningun elemento todavía en agrupar u ordenar
           if(document.getElementById(campo).value=="")
              {//pongo en agrupar u ordenar el nombre real del campo
               document.getElementById(campo).value=document.getElementById("l_campos").value;
               //pongo en l_campos la mascara del campo
               indice=document.getElementById("l_campos").selectedIndex;
               document.getElementById("l_"+campo).value=document.getElementById("l_campos").options[indice].text;
              }
           else
              {//valido si el campo elegido ya se encuentra en la lista
               var valor=document.getElementById(campo).value;
               encontrado=valor.match(document.getElementById("l_campos").value);
               if(encontrado==null)
                  {//pongo en agrupar u ordenar el nombre real del campo
                   document.getElementById(campo).value+=","+document.getElementById("l_campos").value;
                   //pongo en l_campos la mascara del campo
                   indice=document.getElementById("l_campos").selectedIndex;
                   document.getElementById("l_"+campo).value+=","+document.getElementById("l_campos").options[indice].text;
                  }
               else
                  {alert("este campo ya se encuentra en la lista");
                  }
              }
          }
     }
  }
function validar()
  {//cuantos campos están seleccionados para mostrarse
   var select=0;
   //cuantos campos tienen funciones de agregación
  // var agregados=0;
   var error=0;
   //recorro todos los elementos del formulario
   for(i=0;i<document.getElementById("campos").elements.length;i=i+1)
    {var objeto=document.getElementById("campos").elements[i];
     //cuento el numero de campos marcados para mostrar
     if(objeto.name.match("mostrar")!=null && objeto.checked==true)
        {select+=1;
        }
     //cuento el numero de campos que tienen función de agregación
     /*if(objeto.name.match("funcion")!=null && objeto.value!="")
        {agregados+=1;
        }*/
    }
   //error si no hay ningun campo para mostrar y ningun campo con funcion de agregacion
   if(select==0 )
      {alert("Debe seleccionar por lo menos un campo para mostrar.");
       error=1;
      }
   /*
   //error si hay campos de agregacion y normales y no hay por lo menos un campo para agrupar
   if(agregados>0 && select>0 && document.getElementById("agrupados").value=="")
      {alert("Debe seleccionar por lo menos un campo para agrupar.");
       error=1;
      }
   //error si no se puso el numero de registros por pagina
   if(document.getElementById("registros").value=="" || document.getElementById("registros").value<1)
      {alert("El numero de registros por página debe ser mayor que 1.");
       error=1;
      }
    //valido el campo de la cadena sql

    if(document.getElementById('sql').value!="")
      {var patron= /select/gi;
       var buscaren=document.getElementById('sql').value;
       if(buscaren.search(patron)!=0)
          {alert("La sentencia sql no es válida.");
           error=1;
          }
      }
     */
   //si no hay errores envío el formulario
   if(error==0)
    {document.getElementById("campos").submit();
    }
  }

/*
<Clase>
<Nombre>LlenarTablas
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/

function limpiar(objeto)
  {document.getElementById(objeto).value="";
   document.getElementById("l_"+objeto).value="";
  }
////////////////////////////////////////////Juan 26 Mayo Autocompletar /////////////////////////////////////

elementoSeleccionado=0;
var v=1;
/*
<Clase>
<Nombre>llamado
<Parametros>url-pagina que se quiere cargar; id_contenedor-id del elemento donde se van a escribir los resultados;
parametros-parámetros que serán pasados por el post a la pagina que vamos a llamar
<Responsabilidades>llamado asincrono a la pagina (ajax)
<Notas>utiliza la función cargarpagina
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function llamado(url, id_contenedor,parametros)
{var pagina_requerida = false
 if (window.XMLHttpRequest)
	{// Si es Mozilla, Safari etc
	 pagina_requerida = new XMLHttpRequest();
	}
 else if (window.ActiveXObject)
	{ // pero si es IE
	 try
		{pagina_requerida = new ActiveXObject("Msxml2.XMLHTTP");
		}
	 catch (e)
		{ // en caso que sea una versión antigua
		 try
			{pagina_requerida = new ActiveXObject("Microsoft.XMLHTTP");
			}
		 catch (e){}
		}
 	}
 else
	return false
 pagina_requerida.onreadystatechange=function(){ // función de respuesta
   	if(pagina_requerida.readyState==4)
     {
  		if(pagina_requerida.status==200)
          {
    			 cargarpagina(pagina_requerida, id_contenedor);
    		  }
       else if(pagina_requerida.status==404)
          {
  			   document.write("La página no existe");
  		    }
  	  }

   }

 pagina_requerida.open('POST', url, true); // asignamos los métodos open y send
 pagina_requerida.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 pagina_requerida.send(parametros);

}
/*
<Clase>
<Nombre>cargarpagina
<Parametros>pagina_requerida-objeto XMLHttpRequest ;id_contenedor-id del componente donde se pondrán los datos
<Responsabilidades> poner la información requerida en su sitio en la pagina xhtml
<Notas>
<Excepciones>si no se encuentra un elemento con el id id_contenedor genera un error,
si hay errores en el codigo html presenta problemas
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function cargarpagina(pagina_requerida, id_contenedor)
  {
   if (pagina_requerida.readyState == 4 && (pagina_requerida.status==200 || window.location.href.indexOf("http")==-1))
      document.getElementById(id_contenedor).innerHTML=pagina_requerida.responseText;
  }


/*
<Clase>
<Nombre>mouseFuera
<Parametros>numero-del elemento sobre el cual se encontraba el mouse
<Responsabilidades>Des-selecciono el elemento actualmente seleccionado, si es que hay alguno
<Notas>se utiliza para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function mouseFuera(numero)
{
	if(elementoSeleccionado!=0)
    {
	    document.getElementById("d" + numero + "comp" + elementoSeleccionado).style.color="#000000";
	  }
}

/*
<Clase>
<Nombre>mouseDentro
<Parametros>elemento-sobre el cual está el mouse;numero-del elemento sobre el cual se encuentra el mouse
<Responsabilidades>Establezco el nuevo elemento seleccionado
<Notas>se utiliza para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function mouseDentro(elemento, numero)
{
	mouseFuera(numero);
	elemento.style.color="#CC0000";
	elemento.style.cursor="pointer";
	elementoSeleccionado=elemento.title;
}

/*
<Clase>
<Nombre> autocompletar
<Parametros>idcomponente-id del componente;digitado-valor digitado
<Responsabilidades>llama la función en php que consulta la bd y llena la lista de opciones
<Notas>para el autocompletar
<Excepciones>
<Salida>una lista de los valores coincidentes
<Pre-condiciones>
<Post-condiciones>
*/
function autocompletar(idcomponente, digitado,tipo,nombre)
{
  llamado("../Autocompletar.php","comple"+idcomponente,"op=autocompl&idcomponente="+idcomponente+"&digitado="+digitado+"&depende=1&tipo="+tipo+"&nombre="+nombre);
  document.getElementById("comple"+idcomponente).style.display="inline";
}
/*
<Clase>
<Nombre>Teclados
<Parametros>
<Responsabilidades>llama las funciones necesarias dependiendo de la tecla
<Notas>Para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function Teclados(evento,numero)
{
	var teclaPresionada=(document.all) ? evento.keyCode : evento.which;

  switch(teclaPresionada)
	{ //para la flecha abajo
		case 40:
		if(elementoSeleccionado<document.getElementById("interno" + numero).childNodes.length-1)
		{
			mouseDentro(document.getElementById("d" + numero + "comp" + (parseInt(elementoSeleccionado)+1)), numero);
		}
		return 0;
		//para la flecha arriba
		case 38:
		if(elementoSeleccionado>1)
		{
			mouseDentro(document.getElementById("d" + numero + "comp" + (parseInt(elementoSeleccionado)-1)), numero);
		}
		return 0;
		//para el tab
		case 9:
		return 0;

		default: elementoSeleccionado=0;return 1;
	}
}

/*
<Clase>
<Nombre>ParaelTab
<Parametros>
<Responsabilidades>autocompletar con el valor seleccionado al presionar tab
<Notas>Para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function ParaelTab(evento,numero,nombre)
{
	var teclaPresionada=(document.all) ? evento.keyCode : evento.which;
	if(teclaPresionada==9 || teclaPresionada==13)
	{
	 if(elementoSeleccionado!=0)
		  {
       clickLista(document.getElementById("d" + numero + "comp" + elementoSeleccionado),"auto"+numero, "comple"+numero, document.getElementById("d"+numero+"valor"+elementoSeleccionado).value,nombre);
		  }
	 if(teclaPresionada==13)
		{
		  if(document.all)
		  {
        evento.keyCode=9;
      }
      else
      {
        evento.preventDefault();
        evento.stopPropagation();
      }

		}
	}
}

/*
<Clase>
<Nombre>clickLista
<Parametros>elemento-seleccionado; inputLista-input donde se pondrá el valor; divLista-div con las opciones
<Responsabilidades>Se ejecuta cuando se hace clic en algun elemento de la lista. Se coloca en el input el
	valor del elemento clickeado
<Notas>Para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function clickLista(elemento,inputLista, divLista,codigo,nombre)
{	v=1;

	valor=elemento.innerHTML;
	document.getElementById(inputLista).value=valor;
	document.getElementById(divLista).style.display="none";
	elemento.style.backgroundColor="#EAEAEA";
	elementoSeleccionado = 0;
	document.getElementById(nombre).value=codigo;
}

function eliminarespacio(elemento)
{
  var cadena = elemento.value;
  var inicio = 0, j=0;
  var nuevo="", palabra="";
  for(var i=0; i<cadena.length; i++)
  {
    if(cadena.charAt(i)==" ")
    {
      nuevo += palabra + " ";
      palabra = "";
      while(cadena.charAt(i)==" " && i<cadena.length)
        i++;
      i--;
    }
    else
      palabra += cadena.charAt(i);
  }
  nuevo += palabra;
  elemento.value = nuevo;
}
function marcar_todos(valor)
  {for(i=0;i<document.getElementById("campos").elements.length;i=i+1)
    {var objeto=document.getElementById("campos").elements[i];
     if(objeto.name.indexOf("mostrar_")>=0)
        {objeto.checked=valor;
        }
    }
  }

</script>
<?php
}
?>
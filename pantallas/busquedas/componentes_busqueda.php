<?php 
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
usuario_actual("login");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/encabezado_componente.php");
$componentes=busca_filtro_tabla("A.*,B.ruta_visualizacion, B.badge_cantidades","busqueda_componente A, busqueda B","A.busqueda_idbusqueda=B.idbusqueda AND B.idbusqueda=".$_REQUEST["idbusqueda"]." AND A.estado<>0","orden",$conn);
$ruta_db_superior="../";
?>
<div class="panel-body">	
  <div class="block-nav">    
<?php 
      $texto='';
      for($i=0;$i<$componentes["numcampos"];$i++){
      	if(!acceso_modulo($componentes[$i]["modulo_idmodulo"]))continue;
		  
        switch($componentes[$i]["tipo"]){
          case 1:
            //sumary, es un componente tipo div html tiene un label y un info 
            $texto.='<div class="summary" id="'.$componentes[$i]["nombre"].'">';
            $texto.='<div class="label"><strong>'.$componentes[$i]["etiqueta"]."</strong></div>";
            $texto.='<div class="info">'.$componentes[$i]["info"]."</div>";
            $texto.='</div>
            ';
          break;
          case 2:
            //quicksearch (formulario busqueda), es un componente tipo form html la redireccion sale del url en la bd y la estructura completa del codigo inclusive el javascript debe salir del info
            $texto.=$componentes[$i]["info"];
          break;
          case 3:
            //items navegable , es un componente tipo data-load que hace enlace a un componente kaiten especifico
            $conector='';
            switch($componentes[$i]["conector"]){
              case 1:$conector='html.page';
              break;
              case 2:$conector='iframe';
              break;
              case 3:$conector='html.string';
              break;
              case 4:$conector='html.dom';            
            }       
            if($componentes[$i]["url"]){
              $url=$ruta_db_superior.$componentes[$i]["url"];
            }elseif($componentes[$i]["ruta_visualizacion"]!=''){
              $url=$ruta_db_superior.$componentes[$i]["ruta_visualizacion"];
            }else{              
              $url=$ruta_db_superior.'pantallas/busquedas/consulta_busqueda.php';
            }          
            if($url) {              
              if($componentes[$i]["conector"]==1||$componentes[$i]["conector"]==2) {
                if(strpos($url,"?"))
                  $url.="&";
                else 
                  $url.="?";  
                $url.='idbusqueda_componente='.$componentes[$i]["idbusqueda_componente"];
              }
            }							
            if($conector!=''){
              $texto.='<div title="'.$componentes[$i]["etiqueta"].'" data-load=\'{"kConnector":"'.$conector.'", "url":"'.$url.'", "kTitle":"'.$componentes[$i]["etiqueta"].'","kWidth":"'.$componentes[$i]["ancho"].'px"}\' class="items navigable">';
              $texto.='<div class="head">';              				            
                         
              //$texto.='<img src="'.$componentes[$i]["imagen"].'"/>'; 
              $texto.='</div>
                <div class="label">';
				if($componentes[$i]["info"] && $componentes[$i]["badge_cantidades"]){
	                $texto.=' <span class="badge badge-info cantidades" idcomponente="'.$componentes[$i]["idbusqueda_componente"].'"></span>&nbsp;&nbsp;&nbsp;';
    			}
              $texto.=$componentes[$i]["etiqueta"];
              $texto.='</div>
			         <div class="info">'; 
						
              $texto.='</div>

			         <div class="tail"></div>
		          </div>'; 
            }
          break;
			case 4:
                $etiqueta=codifica_encabezado(html_entity_decode($componentes[$i]['etiqueta']));
                $url=$ruta_db_superior.$componentes[$i]['url'];
	            $conector='';
	            switch($componentes[$i]["conector"]){
	              case 1:$conector='html.page';
	              break;
	              case 2:$conector='iframe';
	              break;
	              case 3:$conector='html.string';
	              break;
	              case 4:$conector='html.dom';            
	            }  
					
		        $texto.='<div title="'.$etiqueta.'" data-load=\'{"kConnector":"'.$conector.'", "url":"'.$url.'", "kTitle":"'.$etiqueta.'"}\' class="items navigable">';
		        $texto.='<div class="head"></div>';              				            
		        $texto.='<div class="label">'.$etiqueta.'</div>';
		        $texto.='<div class="info"></div>'; 		
		        $texto.='<div class="tail"></div>';
				$texto.='</div>'; 				
				
			break;
          default:
            //sumary error, es un componente tipo div html tiene un label y un info con la descripcion del error en la secuencia de la base de datos.
            $texto.='<div class="summary" id="error_'.$componentes[$i]["nombre"].'">';
            $texto.='<div class="label"><strong> ERROR EN EL COMPONENTE '.$componentes[$i]["etiqueta"]."  Tipo:".$componentes[$i]["tipo"]." NO RECONOCIDO</strong></div>";
            $texto.='<div class="info">'.$componentes[$i]["info"]."</div>";
            $texto.='</div>';
          break;
        }
      }
    echo($texto);
        ?>	
  </div>
</div>
<?php
echo(librerias_jquery("1.7"));
function acceso_modulo($idmodulo){
	if($idmodulo=='' || $idmodulo==Null || $idmodulo==0 || usuario_actual("login")=="cerok"){
		return true;
	}
	$ok=new Permiso();
	$modulo=busca_filtro_tabla("","modulo","idmodulo=".$idmodulo,"");
	$acceso=$ok->acceso_modulo_perfil($modulo[0]["nombre"]);
	return $acceso;
}
?>
<script type="text/javascript">
$(document).ready(function(){
  $(".cantidades").each(function(){
    var cantidades=$(this);
    $.ajax({
      type:'POST',
      url: "<?php echo($ruta_db_superior); ?>pantallas/busquedas/servidor_busqueda.php",
      data: "idbusqueda_componente="+$(this).attr("idcomponente")+"&page=0&rows=1&actual_row=0",
      success: function(html){
        if(html){         
          var objeto=jQuery.parseJSON(html);                              
          cantidades.html(objeto.records);                   
        } 
        else{
          cantidades.html("0");
        }                                          
      }
    });
  });
});
</script>
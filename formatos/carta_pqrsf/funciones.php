<?php 
if(!isset($_REQUEST["tipo"])||$_REQUEST["tipo"]==1)
{
?>
<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<?php
}
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
include_once($ruta_db_superior."calendario/calendario.php");
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.js"></script>
<?php
function actualizar_radicados($idformato,$iddoc){
  global $conn;
  $doc=busca_filtro_tabla("numero,destinos,varios_radicados","documento,ft_carta","documento_iddocumento=iddocumento and iddocumento=$iddoc","",$conn);
  if($doc[0]["numero"]&&$doc[0]["varios_radicados"]){
    $destinos=explode(",",$doc[0]["destinos"]);
 
    $destinos=array_unique($destinos);
    sort($destinos);
   
    for($i=0;$i<count($destinos);$i++)
      {$radicado=busca_filtro_tabla("","radicados_carta","destino='".$destinos[$i]."' and documento_iddocumento=$iddoc","",$conn);
       if(!$radicado["numcampos"])
         {if($i==0)
            $radicado=$doc[0]["numero"];
          else
            {$cont=contador("carta");
             $radicado=$cont[0]["consecutivo"];
            } 
          $sql="insert into radicados_carta(destino,radicado,documento_iddocumento) values('".$destinos[$i]."','$radicado','$iddoc')" ;
          phpmkr_query($sql,$conn);
         }
      }
   }
}
?>

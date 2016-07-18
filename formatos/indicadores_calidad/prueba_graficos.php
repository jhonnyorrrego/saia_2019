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
include_once($ruta_db_superior."librerias_saia.php");
echo( librerias_jquery('1.7') );
//echo( json_encode($data_nombres) );
//die();
?> 
    <script src="build/dist/echarts.js"></script>
        <center>
    <div id="contenedor_grafico_pc" style="width: 600px;height:400px;"></div>
    <br>
    <div id="imagen_grafico_pc" style="width: 600px;height:400px;"></div>
<?php
        
function generar_grafico_torta($color_grafico,$contenedores,$nombres,$valores,$titulo_grafico='',$titulox='',$tituloy=''){
    global $conn;
        $valores=json_encode($valores);
        
        
        //print_r(json_encode($nombres['nombres']));die();   
        
        if($color_grafico==''){
            $color_saia=busca_filtro_tabla("","configuracion","nombre='color_encabezado_list'","",$conn);  
            $color_grafico=$color_saia[0]['valor'];
        }
        
       $data_nombres=array();
       for($i=0;$i<count($nombres['nombres']);$i++){
            $data_nombres[$i]['value']=$nombres['valores'][$i];
            $data_nombres[$i]['name']=$nombres['nombres'][$i];
           // $data_nombres[$i]['textStyle']['color']=$nombres['colores'][$i];
           // $data_nombres[$i]['textStyle']['fontWeight']='bold';           
       }        
        $data_nombres=json_encode($data_nombres);
       // echo($titulos);die();
    ?>
        <script type="text/javascript">
        
            require.config({
              paths: {
                 echarts: 'build/dist'
              }
            });
            require(['echarts','echarts/chart/pie'],// require the specific chart type        
            function (ec) {
 		    var myChart = ec.init(document.getElementById('<?php echo($contenedores[0]); ?>'));

            var option = {
               // renderAsImage:true,
                title : {
                    text: '<?php echo($titulo_grafico); ?>',
                    subtext: '<?php echo($titulo_grafico); ?>',
                    x:'center'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient : 'vertical',
                    x : 'left',
                    data:<?php echo(json_encode($nombres['nombres'])); ?>
                },
                toolbox: {
                    show : true,
                    feature : {
                        mark : {show: true},
                        dataView : {show: true, readOnly: false},
                        magicType : {
                            show: true, 
                            type: ['pie', 'funnel'],
                            option: {
                                funnel: {
                                    x: '25%',
                                    width: '50%',
                                    funnelAlign: 'left',
                                    max: 1548
                                }
                            }
                        },
                        restore : {show: true},
                        saveAsImage : {show: true}
                    }
                },
                calculable : true,
                series : [
                    {
                        name:'Valores',
                        type:'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:<?php echo($data_nombres); ?>
                    }
                ]
            };
                    
            
            myChart.setOption(option);
            //alert( myChart.getImage() );
            var img = new Image();
            
            
            //img.src = myChart.getImage();
           
           // img.id = "img_<?php echo($contenedores[1]); ?>";
           
           setTimeout(function(){ 
               
               document.getElementById('<?php echo($contenedores[1]); ?>').appendChild(myChart.getImage());
               
               
           }, 3000);
           
            
           
            } //fin function ec
            
            );
        </script>
    <?php
}

       $dato=array(5,10,15,20,25,30);
	   $dato3=array('titulo 5','titulo 10','titulo 15','titulo 20','titulo 25','titulo 30');
	   $colores=array('#00FF51','#D923D0','#00FF51','#D923D0','#00FF51','#D923D0');
	   $titulo_grafico='Mi Grafico';
	   $contenedores=array('contenedor_grafico_pc','imagen_grafico_pc');
	   $tipo_grafico='barras';
	   $color='#00FF51';
	   $titulox='Titulo Eje X';
	   $tituloy='Titulo Eje Y';
	    switch($tipo_grafico){
	        case 'torta':
	            
			case 'barras':
			    $valores=$dato;
			    $nombres['nombres']=$dato3;  
			    $nombres['colores']=$colores;
			    $nombres['valores']=$dato;
			    break;
		}
	   generar_grafico_torta('',$contenedores,$nombres,$valores,$titulo_grafico,$titulox,$tituloy);
?>




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
        
function generar_grafico_torta($configuracion_grafico){
    global $conn;

        if($color_grafico==''){
            $color_saia=busca_filtro_tabla("","configuracion","nombre='color_encabezado_list'","",$conn);  
            $color_grafico=$color_saia[0]['valor'];
        }
        
        //PARSEO renderAsImage
        $generar_imagen='';
        if($configuracion_grafico['imagen']){
            $generar_imagen='renderAsImage:true,';
        }
        
        //PARSEO NOMBRES Y VALORES
       $data_nombres=array();
       for($i=0;$i<count($configuracion_grafico['nombres']);$i++){
            $data_nombres[$i]['value']=$configuracion_grafico['valores'][$i];
            $data_nombres[$i]['name']=$configuracion_grafico['nombres'][$i];
            
       }        
        $data_nombres=json_encode($data_nombres);
    ?>
        <script type="text/javascript">
        
            require.config({
              paths: {
                 echarts: 'build/dist'
              }
            });
            require(['echarts','echarts/chart/pie'],// require the specific chart type        
            function (ec) {
 		    var myChart = ec.init(document.getElementById('<?php echo($configuracion_grafico['contenedores'][0]); ?>'));

            var option = {
                <?php echo($generar_imagen); ?>
                title : {
                    text: '<?php echo($configuracion_grafico['titulo_grafico']); ?>',
                    subtext: '<?php echo($configuracion_grafico['subtitulo_grafico']); ?>',
                    x:'center'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient : 'vertical',
                    x : 'left',
                    data:<?php echo(json_encode($configuracion_grafico['nombres'])); ?>
                },
                toolbox: {
                    show : true,
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
            } //fin function ec
            
            );
        </script>
    <?php
}



function generar_grafico_barra($configuracion_grafico){
    global $conn;

        if($configuracion_grafico['color_grafico']==''){
            $color_saia=busca_filtro_tabla("","configuracion","nombre='color_encabezado_list'","",$conn);  
            $configuracion_grafico['color_grafico']=$color_saia[0]['valor'];
        }
        
        //PARSEO renderAsImage
        $generar_imagen='';
        if($configuracion_grafico['imagen']){
            $generar_imagen='renderAsImage:true,';
        }
        
        //PARSEO NOMBRES Y VALORES
       $data_nombres=array();
     /*  for($i=0;$i<count($configuracion_grafico['nombres']);$i++){
            $data_nombres[$i]['value']=$configuracion_grafico['valores'][$i];
            $data_nombres[$i]['name']=$configuracion_grafico['nombres'][$i];
       }   */     

       for($i=0;$i<count($configuracion_grafico['nombres']);$i++){
            $data_nombres[$i]['value']=$configuracion_grafico['nombres'][$i];
            $data_nombres[$i]['textStyle']['color']=$configuracion_grafico['colores'][$i];
            if(!$configuracion_grafico['colores'][$i]){
                 $data_nombres[$i]['textStyle']['color']='#000000';
            }
           
            $data_nombres[$i]['textStyle']['fontWeight']='bold';           
       }        
       
        $data_nombres=json_encode($data_nombres);
    ?>
        <script type="text/javascript">
            require.config({
              paths: {
                 echarts: 'build/dist'
              }
            });
            require(['echarts','echarts/chart/bar'],// require the specific chart type        
            function (ec) {
 		    var myChart = ec.init(document.getElementById('<?php echo($configuracion_grafico['contenedor']); ?>'));

            var option = {
                title : {
                    text: '<?php echo($configuracion_grafico['titulo_grafico']); ?>',
                    subtext: '<?php echo($configuracion_grafico['subtitulo_grafico']); ?>',
                    x:'center'
                },
                color: ['<?php echo($configuracion_grafico['color_grafico']); ?>'],
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            
                        type : 'shadow' 
                    }                    
                },
                /*toolbox: {
                    show : true,
                },*/
                calculable : true,
                xAxis : [
                    {
                        type : 'category',
                        data : <?php echo($data_nombres); ?>
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'Valores',
                        type:'bar',
                        barWidth: 50,
                        data:<?php echo(json_encode($configuracion_grafico['valores'])); ?>
                    },
                   /* {
                        name:'降水量',
                        type:'bar',
                        data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3],
                        markPoint : {
                            data : [
                                {name : '年最高', value : 182.2, xAxis: 7, yAxis: 183, symbolSize:18},
                                {name : '年最低', value : 2.3, xAxis: 11, yAxis: 3}
                            ]
                        },
                        markLine : {
                            data : [
                                {type : 'average', name : '平均值'}
                            ]
                        }
                    }*/
                ]
            };
                    
                    
            myChart.setOption(option);
            } //fin function ec
            
            );
        </script>
    <?php
}








    /*
    // -----> TORTA
	$configuracion_grafico=array();
	$configuracion_grafico['imagen']=1;
	$configuracion_grafico['titulo_grafico']='Mi Grafico';
	$configuracion_grafico['subtitulo_grafico']='Mi Subtitulo';
	$configuracion_grafico['contenedores']=array('contenedor_grafico_pc','imagen_grafico_pc');
	$configuracion_grafico['nombres']=array('titulo 5','titulo 10','titulo 15','titulo 20','titulo 25','titulo 30');
	$configuracion_grafico['valores']=array(5,10,15,20,25,30);
    $configuracion_grafico['colores']=array('#00FF51','#D923D0','#00FF51','#D923D0','#00FF51','#D923D0');
    generar_grafico_torta($configuracion_grafico);
    
    */


    // -----> BARRA
    $configuracion_grafico=array();
    $configuracion_grafico['contenedor']='contenedor_grafico_pc';
    $configuracion_grafico['titulo_grafico']='Mi Grafico';
    $configuracion_grafico['subtitulo_grafico']='Mi Subtitulo';
    $configuracion_grafico['nombres']=array('titulo 5','titulo 10','titulo 15','titulo 20','titulo 25','titulo 30');
    $configuracion_grafico['valores']=array(5,10,15,20,25,30);
    //$configuracion_grafico['colores']=array('#00FF51','#D923D0','#00FF51','#D923D0','#00FF51','#D923D0');
    //$configuracion_grafico['color_grafico']='#B1B109';
    generar_grafico_barra($configuracion_grafico);
    
    
    
    
?>




<?php
$resta_alto=100; //ESTABA AQUI NO SE SABE SI SE USA
$resta_ancho=100; //ESTABA AQUI NO SE SABE SI SE USA



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

function generar_grafico_barra($configuracion_grafico){
    global $conn;

        if($configuracion_grafico['color_saia']){
            $color_saia=busca_filtro_tabla("","configuracion","nombre='color_encabezado_list'","",$conn);  
            $configuracion_grafico['color_saia']='color: ["'.$color_saia[0]['valor'].'"],';
        }
        
        //PARSEO renderAsImage
        $generar_imagen='';
        if($configuracion_grafico['imagen']){
            $generar_imagen='renderAsImage:true,';
        }
        
        //PARSEO NOMBRES & COLORES
       $data_nombres=array();
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
                <?php echo($generar_imagen); ?>
                title : {
                    text: '<?php echo($configuracion_grafico['titulo_grafico']); ?>',
                    subtext: '<?php echo($configuracion_grafico['subtitulo_grafico']); ?>',
                    x:'center'
                },
                
                <?php echo($configuracion_grafico['color_saia']); ?>
                legend: {
                    data:<?php echo(json_encode($configuracion_grafico['valores_nombre']) ); ?>,
                    x:'right'
                }, 
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            
                        type : 'shadow' 
                    }                    
                },
                calculable : true,
                xAxis : [
                    {
                        nameTextStyle:{
                          color: '#000000',
                          fontWeight:'bold'
                        },
                        nameLocation:'end',      
                        name:'<?php echo($configuracion_grafico['titulox']); ?>',                        
                        type : 'category',
                        data : <?php echo($data_nombres); ?>
                    }
                ],
                yAxis : [
                    {
                        
                        nameTextStyle:{
                          color: '#000000',
                          fontWeight:'bold'
                        },
                        nameLocation:'end',
                                     
                        name:'<?php echo($configuracion_grafico['tituloy']); ?>',                        
                        type : 'value'
                    }
                ],
                series : [
                    
                    <?php
                    for($x=0;$x<count($configuracion_grafico['valores']);$x++){
                        echo('
                            {
                                name:"'.$configuracion_grafico['valores_nombre'][$x].'",
                                type:"bar",
                                barWidth: 50,
                                data:'.json_encode($configuracion_grafico['valores'][$x]).'
                            }  
                        ');
                        if(($x+1)!=count($configuracion_grafico['valores'])){
                            echo(',');
                        }
                    }
                    
                    ?>
                ]
            };
                    
                    
            myChart.setOption(option);
            } //fin function ec
            
            );
        </script>
    <?php
}


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
 		    var myChart = ec.init(document.getElementById('<?php echo($configuracion_grafico['contenedor']); ?>'));

            var option = {
                <?php echo($generar_imagen); ?>
                title : {
                    text: '<?php echo($configuracion_grafico['titulo_grafico']); ?>',
                    subtext: '<?php echo($configuracion_grafico['subtitulo_grafico']); ?>',
                    x:'right'
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

function generar_grafico_linea($configuracion_grafico){
    global $conn;

        if($configuracion_grafico['color_saia']){
            $color_saia=busca_filtro_tabla("","configuracion","nombre='color_encabezado_list'","",$conn);  
            $configuracion_grafico['color_saia']='color: ["'.$color_saia[0]['valor'].'"],';
        }
        
        //PARSEO renderAsImage
        $generar_imagen='';
        if($configuracion_grafico['imagen']){
            $generar_imagen='renderAsImage:true,';
        }
        
        //PARSEO NOMBRES & COLORES
       $data_nombres=array();
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
            require(['echarts','echarts/chart/line'],// require the specific chart type        
            function (ec) {
 		    var myChart = ec.init(document.getElementById('<?php echo($configuracion_grafico['contenedor']); ?>'));

            var option = {
                <?php echo($generar_imagen); ?>
                <?php echo($configuracion_grafico['color_saia']); ?>
                title : {
                    text: '<?php echo($configuracion_grafico['titulo_grafico']); ?>',
                    subtext: '<?php echo($configuracion_grafico['subtitulo_grafico']); ?>',
                    x:'center'
                },
                legend: {
                    data:<?php echo(json_encode($configuracion_grafico['valores_nombre']) ); ?>,
                    x:'right'
                },               
                tooltip : {
                    trigger: 'axis'
                },
                calculable : true,
                xAxis : [
                    {
                        nameTextStyle:{
                          color: '#000000',
                          fontWeight:'bold'
                        },
                        nameLocation:'end',      
                        name:'<?php echo($configuracion_grafico['titulox']); ?>',                         
                        type : 'category',
                        data : <?php echo($data_nombres); ?>
                    }
                ],
                yAxis : [
                    {
                        type : 'value',
                        nameTextStyle:{
                          color: '#000000',
                          fontWeight:'bold'
                        },
                        nameLocation:'end',        
                        name:'<?php echo($configuracion_grafico['tituloy']); ?>',                         
                    }
                ],
                series : [
                    <?php
                    for($x=0;$x<count($configuracion_grafico['valores']);$x++){
                        echo('
                            {
                                name:"'.$configuracion_grafico['valores_nombre'][$x].'",
                                type:"line",
                                data:'.json_encode($configuracion_grafico['valores'][$x]).'
                            }  
                        ');
                        if(($x+1)!=count($configuracion_grafico['valores'])){
                            echo(',');
                        }
                    }
                    
                    ?>
                ]
            };
                      
            myChart.setOption(option);
            } //fin function ec
            
            );
        </script>
    <?php
}
?>
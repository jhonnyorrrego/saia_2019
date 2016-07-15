<?php

$nombres=array();

$nombres['value']='ruben';
$nombres['textStyle']['color']='#00FF51';
$nombres['textStyle']['fontWeight']='bold';


echo( json_encode($nombres) );

die();
?>


    <script src="echarts.min.js"></script>
        <center>
    <div id="main" style="width: 600px;height:400px;"></div>
<?php
        



function generar_grafico_barra($color,$idcontenedor,$nombres,$valores,$titulo_grafico='',$titulox='',$tituloy=''){
        $nombres=json_encode($nombres['nombres']);
        $valores=json_encode($valores);
        
       for($i=0;$i<count($nombres['nombres']);$i++){
           
       }
       
        
        
       // echo($titulos);die();
    ?>
        <script type="text/javascript">
 		    var myChart = echarts.init(document.getElementById('<?php echo($idcontenedor); ?>'));

            var option = {
                
                title: {text: '<?php echo($titulo_grafico); ?>', x:'center'},
                color: ['<?php echo($color); ?>'],
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                grid: {
                   // left: '3%',
                   // right: '4%',
                    //bottom: '3%',
                    containLabel: true
                },
                xAxis : [
                    {
                        
                        nameTextStyle:{
                          color: '#000000',
                          fontWeight:'bold'
                        },
                        nameLocation:'middle',
                        nameGap:21,                        
                        name:'<?php echo($titulox); ?>',
                        type : 'category',
                        
                          data:[
                              {
                                  value:'barra 1',
                                  textStyle: {
                                      fontWeight:'bold',
                                      color: 'red'
                                  }
                              },
                              {
                                  value:'barra 2'    
                                 
                              }
                          ],
                        axisTick: {
                            alignWithLabel: true
                        }
                    }
                ],
                yAxis : [
                    {
                        nameTextStyle:{
                          color: '#000000',
                          fontWeight:'bold'
                        },
                        nameLocation:'middle',
                        nameGap:30,
                        name:'<?php echo($tituloy); ?>', //
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'Valor',
                        type:'bar',
                        barWidth: '50%',
                        data:<?php echo($valores); ?>
                    }
                ]
            };
            
            myChart.setOption(option);

        </script>
    <?php
}


        
        
       $dato=array(5,10,15,20,25,30);
	   $dato3=array('titulo 5','titulo 10','titulo 15','titulo 20','titulo 25','titulo 30');
	   $titulo_grafico='Mi Grafico';
	   $idcontenedor='main';
	   $tipo_grafico='barras';
	   $color='#00FF51';
	   $titulox='Titulo Eje X';
	   $tituloy='Titulo Eje Y';
	    switch($tipo_grafico){
			case 'barras':
			    $valores=$dato;
			    $nombres['nombres']=$dato3;  
			    $nombres['colores']=$array_colores;
			    break;
		}
	    generar_grafico_barra($color,$idcontenedor,$nombres,$valores,$titulo_grafico,$titulox,$tituloy);
	
	
?>




<?php
 /*
     Example3 : an overlayed bar graph, uggly no?
 */

 // Standard inclusions   
 include("pChart/pData.class");
 include("pChart/pChart.class");

 // Dataset definition 
 $DataSet = new pData;
 $DataSet->AddPoint(array(5),"Serie1");
 $DataSet->AddPoint(array(3),"Serie2");
 $DataSet->AddAllSeries();
 $DataSet->SetAbsciseLabelSerie();
 $DataSet->SetSerieName("January","Serie1");
 $DataSet->SetSerieName("February","Serie2");

 // Initialise the graph
 $Test = new pChart(700,230);
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->setGraphArea(50,30,585,200);
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);
 $Test->drawGraphArea(255,255,255,TRUE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_START0,150,150,150,TRUE,0,2,TRUE);
 $Test->drawGrid(4,TRUE,230,230,230,50);

 // Draw the 0 line
 $Test->setFontProperties("Fonts/tahoma.ttf",6);
 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);

 // Draw the bar graph
 //$Test->drawOverlayBarGraph($DataSet->GetData(),$DataSet->GetDataDescription());
 $Test->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE);   

 // Finish the graph
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->drawLegend(600,30,$DataSet->GetDataDescription(),255,255,255);
 $Test->setFontProperties("Fonts/tahoma.ttf",10);
 $Test->drawTitle(50,22,"Example 3",50,50,50,585);
 $Test->Render("example3.png");
?>
<image src="example3.png" />

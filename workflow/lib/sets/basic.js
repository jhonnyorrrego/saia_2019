var formulario = 0;
var rectangulo = 0;
var cuadrado = 0;
var circulo = 0;
var diamante = 0;
var paralelograma = 0;
var elipse = 0;
var semitriangulo = 0;
var pentagono = 0;
var hexagono = 0;
var figure_defaultFigureSegmentSize=70;
var figure_defaultFigureSegmentShortSize=40;
var figure_defaultFigureRadiusSize=35;
var figure_defaultFigureParalelsOffsetSize=40;
var figure_defaultFigureCorner=10;
var figure_defaultFigureCornerRoundness=8;
var figure_defaultXCoordonate=0;
var figure_defaultYCoordonate=0;
var figure_defaultFigureTextSize=12;
var figure_defaultFigureTextStr="Paso";
var figure_defaultFigureTextFont="Arial";
var figure_defaultStrokeStyle="#000000";
var figure_defaultFillStyle="#ffffff";
var figure_defaultFillTextStyle="#000000";
//figura no utilizada
function figure_CanvasImage(a,d){
	var c=new Figure("Image");
	var b=new CanvasImage(a,d,"desert.jpg?"+new Date().getTime());c.addPrimitive(b);c.finalise();
	return c
}
//figura no utilizada
function figure_Polyline(a,d){
	var b=new Figure("Polyline");
	b.style.fillStyle=figure_defaultFillStyle;
	b.style.strokeStyle=figure_defaultStrokeStyle;
	b.properties.push(new BuilderProperty("Fill Style","style.fillStyle",BuilderProperty.TYPE_COLOR));
	b.properties.push(new BuilderProperty("Line Width","style.lineWidth",BuilderProperty.TYPE_LINE_WIDTH));
	var c=new Polyline();
	c.addPoint(new Point(a,d));
	c.addPoint(new Point(a+50,d));
	c.addPoint(new Point(a+50,d+50));
	c.addPoint(new Point(a,d+50));
	c.addPoint(new Point(a,d));
	b.addPrimitive(c);
	b.finalise();
	return b
}
function uno()
{
	
}
/*
<Clase>
<Nombre>figure_Rectangle
<Parametros>a -> Posicion en x cuando se dio clic, g -> posicion en y cuando se dio clic
<Responsabilidades>Se crea la figura rectangulo
Aqui se inserta el texto respectivo a la figura.
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>

*/

//figura utilizada RECTANGULO
function figure_Rectangle(a,g){
//la variable rectangulo es para darle el nombre a la figura, vemos que al principio de este archivo se inicializa la variable en 0. y vemos que 
//figure_defaultFigureTextStr tambien se inicializa arriba como igual a "paso" entonces podremos modificar este texto cuando queramos,
//abajo se incrementa rectangulo esto para darle el nombre paso1, paso2, paso3, cada vez que se crea una figura rectangulo.
	rectangulo++;
	var e=new Figure("Rectangle");
	e.style.fillStyle=figure_defaultFillStyle;
	e.style.strokeStyle=figure_defaultStrokeStyle;
	/*$(document).ready(function(){
		$.post("funcion.php",{figura : e.id},function(data){
			formulario = data;
		});
	});*/
	
	//setTimeout("uno()",3000);
	e.properties.push(new BuilderProperty("Text","primitives.1.str",BuilderProperty.TYPE_TEXT));

		
		//e.properties.push(new BuilderProperty("<a href='#' name='"+e.id+"' id='proceso"+e.id+"' onclick='formulario_paso(this.name,event)'>Llenar informacion</a>","primitives.1.str",BuilderProperty.TYPE_TEXT));
		//alert($("#proceso1").attr("id"));
		/*e.properties.push(new BuilderProperty("Tamaño del Texto","primitives.1.size",BuilderProperty.TYPE_TEXT_FONT_SIZE));
		e.properties.push(new BuilderProperty("Font","primitives.1.font",BuilderProperty.TYPE_TEXT_FONT_FAMILY));
		e.properties.push(new BuilderProperty("Alignment","primitives.1.align",BuilderProperty.TYPE_TEXT_FONT_ALIGNMENT));
		e.properties.push(new BuilderProperty("Hola2 Color","primitives.1.style.fillStyle",BuilderProperty.TYPE_COLOR));
		e.properties.push(new BuilderProperty(BuilderProperty.SEPARATOR));
		e.properties.push(new BuilderProperty("Stroke Style","style.strokeStyle",BuilderProperty.TYPE_COLOR));
		e.properties.push(new BuilderProperty("Fill Style","style.fillStyle",BuilderProperty.TYPE_COLOR));
		e.properties.push(new BuilderProperty("Line Width","style.lineWidth",BuilderProperty.TYPE_LINE_WIDTH));*/
		
		var d=new Polygon();d.addPoint(new Point(a,g));d.addPoint(new Point(a+figure_defaultFigureSegmentSize,g));
		d.addPoint(new Point(a+figure_defaultFigureSegmentSize,g+figure_defaultFigureSegmentShortSize+5));
		d.addPoint(new Point(a,g+figure_defaultFigureSegmentShortSize+5));
		e.addPrimitive(d);
		
		//aqui se inserta el texto de la figura figure_defaultFigureTextStr+rectangulo es igual a paso1
		var c=new Text(figure_defaultFigureTextStr+rectangulo,a+figure_defaultFigureSegmentSize/2,g+figure_defaultFigureSegmentShortSize/2,figure_defaultFigureTextFont,figure_defaultFigureTextSize);
		c.style.fillStyle=figure_defaultFillTextStyle;
		e.addPrimitive(c);
		var b=figure_defaultFigureSegmentShortSize+5;
		CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a+figure_defaultFigureSegmentSize/2-10,g),ConnectionPoint.TYPE_FIGURE);
		CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a+figure_defaultFigureSegmentSize/2,g),ConnectionPoint.TYPE_FIGURE);
		CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a+figure_defaultFigureSegmentSize/2+10,g),ConnectionPoint.TYPE_FIGURE);
		CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a+figure_defaultFigureSegmentSize/2-10,g+b),ConnectionPoint.TYPE_FIGURE);
		CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a+figure_defaultFigureSegmentSize/2,g+b),ConnectionPoint.TYPE_FIGURE);
		CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a+figure_defaultFigureSegmentSize/2+10,g+b),ConnectionPoint.TYPE_FIGURE);
		CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a+figure_defaultFigureSegmentSize,g+b/2-10),ConnectionPoint.TYPE_FIGURE);
		CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a+figure_defaultFigureSegmentSize,g+b/2),ConnectionPoint.TYPE_FIGURE);
		CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a+figure_defaultFigureSegmentSize,g+b/2+10),ConnectionPoint.TYPE_FIGURE);
		CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a,g+b/2-10),ConnectionPoint.TYPE_FIGURE);
		CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a,g+b/2),ConnectionPoint.TYPE_FIGURE);
		CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a,g+b/2+10),ConnectionPoint.TYPE_FIGURE);
		e.finalise();
		return e
}
//figura no utilizada
function figure_Square(a,e){
	cuadrado++;
	var c=new Polygon();
	c.addPoint(new Point(a,e));
	c.addPoint(new Point(a+figure_defaultFigureSegmentSize,e));
	c.addPoint(new Point(a+figure_defaultFigureSegmentSize,e+figure_defaultFigureSegmentSize));
	c.addPoint(new Point(a,e+figure_defaultFigureSegmentSize));
	var d=new Figure("Square");
	d.style.fillStyle=figure_defaultFillStyle;
	d.style.strokeStyle=figure_defaultStrokeStyle;
	d.properties.push(new BuilderProperty("Hola3","primitives.1.str",BuilderProperty.TYPE_TEXT));
	d.properties.push(new BuilderProperty("Text Size ","primitives.1.size",BuilderProperty.TYPE_TEXT_FONT_SIZE));
	d.properties.push(new BuilderProperty("Font ","primitives.1.font",BuilderProperty.TYPE_TEXT_FONT_FAMILY));
	d.properties.push(new BuilderProperty("Alignment ","primitives.1.align",BuilderProperty.TYPE_TEXT_FONT_ALIGNMENT));
	d.properties.push(new BuilderProperty("Text Color","primitives.1.style.fillStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty(BuilderProperty.SEPARATOR));
	d.properties.push(new BuilderProperty("Stroke Style","style.strokeStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty("Fill Style","style.fillStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty("Line Width","style.lineWidth",BuilderProperty.TYPE_LINE_WIDTH));
	d.addPrimitive(c);
	var b=new Text(figure_defaultFigureTextStr+cuadrado,a+figure_defaultFigureSegmentSize/2,e+figure_defaultFigureSegmentSize/2,figure_defaultFigureTextFont,figure_defaultFigureTextSize);
	b.style.fillStyle=figure_defaultFillTextStyle;
	d.addPrimitive(b);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentSize/2-10,e),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentSize/2,e),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentSize/2+10,e),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentSize/2-10,e+figure_defaultFigureSegmentSize),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentSize/2,e+figure_defaultFigureSegmentSize),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentSize/2+10,e+figure_defaultFigureSegmentSize),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentSize,e+figure_defaultFigureSegmentSize/2-10),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentSize,e+figure_defaultFigureSegmentSize/2),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentSize,e+figure_defaultFigureSegmentSize/2+10),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a,e+figure_defaultFigureSegmentSize/2-10),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a,e+figure_defaultFigureSegmentSize/2),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a,e+figure_defaultFigureSegmentSize/2+10),ConnectionPoint.TYPE_FIGURE);
	d.finalise();
	return d
}
//figura no utilizada
function figure_Circle(a,g){
	circulo++;
	var d=new Figure("Circle");
	d.style.fillStyle=figure_defaultFillStyle;
	d.style.strokeStyle=figure_defaultStrokeStyle;
	d.properties.push(new BuilderProperty("Text","primitives.1.str",BuilderProperty.TYPE_TEXT));
	d.properties.push(new BuilderProperty("Text Size ","primitives.1.size",BuilderProperty.TYPE_TEXT_FONT_SIZE));
	d.properties.push(new BuilderProperty("Font ","primitives.1.font",BuilderProperty.TYPE_TEXT_FONT_FAMILY));
	d.properties.push(new BuilderProperty("Alignment ","primitives.1.align",BuilderProperty.TYPE_TEXT_FONT_ALIGNMENT));
	d.properties.push(new BuilderProperty("Text Color","primitives.1.style.fillStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty(BuilderProperty.SEPARATOR));
	d.properties.push(new BuilderProperty("Stroke Style","style.strokeStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty("Fill Style","style.fillStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty("Line Width","style.lineWidth",BuilderProperty.TYPE_LINE_WIDTH));
	var e=new Arc(a,g,figure_defaultFigureRadiusSize,0,360,false,0);
	d.addPrimitive(e);
	var b=new Text(figure_defaultFigureTextStr+circulo,a,g,figure_defaultFigureTextFont,figure_defaultFigureTextSize);
	b.style.fillStyle=figure_defaultFillTextStyle;
	d.addPrimitive(b);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureRadiusSize,g),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a,g+figure_defaultFigureRadiusSize),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a-figure_defaultFigureRadiusSize,g),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a,g-figure_defaultFigureRadiusSize),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a,g),ConnectionPoint.TYPE_FIGURE);
	d.finalise();
	return d
}
//figura no utilizada
function figure_Diamond(a,e){
	diamante++;
	var c=new Polygon();
	c.addPoint(new Point(a,e-figure_defaultFigureSegmentSize/2));
	c.addPoint(new Point(a+figure_defaultFigureSegmentShortSize/3*2,e));
	c.addPoint(new Point(a,e+figure_defaultFigureSegmentSize/2));
	c.addPoint(new Point(a-figure_defaultFigureSegmentShortSize/3*2,e));
	var d=new Figure("Diamond");
	d.style.fillStyle=figure_defaultFillStyle;
	d.style.strokeStyle=figure_defaultStrokeStyle;
	d.properties.push(new BuilderProperty("Text","primitives.1.str",BuilderProperty.TYPE_TEXT));
	d.properties.push(new BuilderProperty("Text Size ","primitives.1.size",BuilderProperty.TYPE_TEXT_FONT_SIZE));
	d.properties.push(new BuilderProperty("Font ","primitives.1.font",BuilderProperty.TYPE_TEXT_FONT_FAMILY));
	d.properties.push(new BuilderProperty("Alignment ","primitives.1.align",BuilderProperty.TYPE_TEXT_FONT_ALIGNMENT));
	d.properties.push(new BuilderProperty("Text Color","primitives.1.style.fillStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty(BuilderProperty.SEPARATOR));
	d.properties.push(new BuilderProperty("Stroke Style","style.strokeStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty("Fill Style","style.fillStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty("Line Width","style.lineWidth",BuilderProperty.TYPE_LINE_WIDTH));
	d.addPrimitive(c);
	var b=new Text(figure_defaultFigureTextStr+diamante,a,e,figure_defaultFigureTextFont,figure_defaultFigureTextSize);
	b.style.fillStyle=figure_defaultFillTextStyle;
	d.addPrimitive(b);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a,e),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a,e-figure_defaultFigureSegmentSize/2),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentShortSize/3*2,e),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a,e+figure_defaultFigureSegmentSize/2),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a-figure_defaultFigureSegmentShortSize/3*2,e),ConnectionPoint.TYPE_FIGURE);
	d.finalise();
	return d
}
//figura no utilizada
function figure_Parallelogram(a,e){
	paralelograma++;
	var c=new Polygon();c.addPoint(new Point(a+10,e));
	c.addPoint(new Point(a+figure_defaultFigureSegmentSize+10,e));
	c.addPoint(new Point(a+figure_defaultFigureSegmentSize+figure_defaultFigureParalelsOffsetSize,e+figure_defaultFigureSegmentShortSize));
	c.addPoint(new Point(a+figure_defaultFigureParalelsOffsetSize,e+figure_defaultFigureSegmentShortSize));
	var d=new Figure("Diamond");
	d.style.fillStyle=figure_defaultFillStyle;
	d.style.strokeStyle=figure_defaultStrokeStyle;
	d.properties.push(new BuilderProperty("Text","primitives.1.str",BuilderProperty.TYPE_TEXT));
	d.properties.push(new BuilderProperty("Text Size ","primitives.1.size",BuilderProperty.TYPE_TEXT_FONT_SIZE));
	d.properties.push(new BuilderProperty("Font ","primitives.1.font",BuilderProperty.TYPE_TEXT_FONT_FAMILY));
	d.properties.push(new BuilderProperty("Alignment ","primitives.1.align",BuilderProperty.TYPE_TEXT_FONT_ALIGNMENT));
	d.properties.push(new BuilderProperty("Text Color","primitives.1.style.fillStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty(BuilderProperty.SEPARATOR));
	d.properties.push(new BuilderProperty("Stroke Style","style.strokeStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty("Fill Style","style.fillStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty("Line Width","style.lineWidth",BuilderProperty.TYPE_LINE_WIDTH));
	d.addPrimitive(c);
	var b=new Text(figure_defaultFigureTextStr+paralelograma,a+figure_defaultFigureSegmentSize/2+figure_defaultFigureParalelsOffsetSize/2+5,e+figure_defaultFigureSegmentShortSize/2,figure_defaultFigureTextFont,figure_defaultFigureTextSize);
	b.style.fillStyle=figure_defaultFillTextStyle;
	d.addPrimitive(b);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+10,e),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentSize+10,e),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentSize+figure_defaultFigureParalelsOffsetSize,e+figure_defaultFigureSegmentShortSize),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureParalelsOffsetSize,e+figure_defaultFigureSegmentShortSize),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentSize+figure_defaultFigureParalelsOffsetSize/2+5,e+figure_defaultFigureSegmentShortSize/2),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureParalelsOffsetSize/2+5,e+figure_defaultFigureSegmentShortSize/2),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentSize/2+figure_defaultFigureParalelsOffsetSize,e+figure_defaultFigureSegmentShortSize),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentSize/2+10,e),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentSize/2+figure_defaultFigureParalelsOffsetSize/2+2,e+figure_defaultFigureSegmentShortSize/2),ConnectionPoint.TYPE_FIGURE);
	d.finalise();
	return d
}

/*
<Clase>
<Nombre>figure_Ellipse
<Parametros>a -> Posicion en x cuando se dio clic, g -> posicion en y cuando se dio clic
<Responsabilidades>Se crea la figura ellipse, esta es la figura que crea cuando carga diagramo, en este caso son dos.
En esta funcion se inserta el texto a las figuras, como Inicio, fin.
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>

*/


//figura utilizada
function figure_Ellipse(a,g){
//esta figura es practicamente lo mismo a la explicacion del rectangulo.
	elipse++;
//se crea la variable texto para tomar el valor de dos posibles casos. Cuando la variable ellipse que se inicializo arriba en 0 y se incremento
//empezando esta funcion es impar Que este sea inicio, cuando sea par que sea fin.
	var texto
	if (elipse % 2 == 1 )
		texto = "Inicio";
	if (elipse % 2 == 0 )
		texto = "Fin";
	var d=new Figure("Ellipse");
	d.style.fillStyle=figure_defaultFillStyle;
	d.style.strokeStyle=figure_defaultStrokeStyle;
	d.properties.push(new BuilderProperty("Text","primitives.1.str",BuilderProperty.TYPE_TEXT));
	/*d.properties.push(new BuilderProperty("Text Size ","primitives.1.size",BuilderProperty.TYPE_TEXT_FONT_SIZE));
	d.properties.push(new BuilderProperty("Font ","primitives.1.font",BuilderProperty.TYPE_TEXT_FONT_FAMILY));
	d.properties.push(new BuilderProperty("Alignment ","primitives.1.align",BuilderProperty.TYPE_TEXT_FONT_ALIGNMENT));
	d.properties.push(new BuilderProperty("Text Color","primitives.1.style.fillStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty(BuilderProperty.SEPARATOR));
	d.properties.push(new BuilderProperty("Stroke Style","style.strokeStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty("Fill Style","style.fillStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty("Line Width","style.lineWidth",BuilderProperty.TYPE_LINE_WIDTH));*/
	var e=new Ellipse(new Point(a,g),figure_defaultFigureSegmentShortSize,figure_defaultFigureSegmentShortSize/2);
	d.addPrimitive(e);
	//Aqui se inserta el texto
	var b=new Text(texto,a,g-2,figure_defaultFigureTextFont,figure_defaultFigureTextSize);
	b.style.fillStyle=figure_defaultFillTextStyle;d.addPrimitive(b);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentShortSize,g),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a,g+figure_defaultFigureSegmentShortSize/2),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a-figure_defaultFigureSegmentShortSize,g),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a,g-figure_defaultFigureSegmentShortSize/2),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a,g),ConnectionPoint.TYPE_FIGURE);
	d.finalise();
	return d
}
//figura no utilizada
function figure_RightTriangle(a,f){
	semitriangulo++;
	var b=new Polygon();
	b.addPoint(new Point(a,f));
	b.addPoint(new Point(a+figure_defaultFigureSegmentShortSize,f+figure_defaultFigureSegmentSize));
	b.addPoint(new Point(a,f+figure_defaultFigureSegmentSize));var d=new Figure("RightTriangle");
	d.style.fillStyle=figure_defaultFillStyle;d.style.strokeStyle=figure_defaultStrokeStyle;
	d.properties.push(new BuilderProperty("Text","primitives.1.str",BuilderProperty.TYPE_TEXT));
	d.properties.push(new BuilderProperty("Text Size ","primitives.1.size",BuilderProperty.TYPE_TEXT_FONT_SIZE));
	d.properties.push(new BuilderProperty("Font ","primitives.1.font",BuilderProperty.TYPE_TEXT_FONT_FAMILY));
	d.properties.push(new BuilderProperty("Alignment ","primitives.1.align",BuilderProperty.TYPE_TEXT_FONT_ALIGNMENT));
	d.properties.push(new BuilderProperty("Text Color","primitives.1.style.fillStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty(BuilderProperty.SEPARATOR));
	d.properties.push(new BuilderProperty("Stroke Style","style.strokeStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty("Fill Style","style.fillStyle",BuilderProperty.TYPE_COLOR));
	d.properties.push(new BuilderProperty("Line Width","style.lineWidth",BuilderProperty.TYPE_LINE_WIDTH));
	var c=new Text(figure_defaultFigureTextStr+semitriangulo,a+figure_defaultFigureSegmentShortSize/2,f+figure_defaultFigureSegmentSize/2,figure_defaultFigureTextFont,figure_defaultFigureTextSize);
	c.style.fillStyle=figure_defaultFillTextStyle;
	d.addPrimitive(b);
	d.addPrimitive(c);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a,f),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentShortSize,f+figure_defaultFigureSegmentSize),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a,f+figure_defaultFigureSegmentSize),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(d.id,new Point(a+figure_defaultFigureSegmentShortSize/2,f+figure_defaultFigureSegmentSize/2),ConnectionPoint.TYPE_FIGURE);
	d.finalise();
	return d
}
//figura no utilizada
function figure_Pentagon(a,h){
	pentagono++;
	var e=new Polygon();
	var b=figure_defaultFigureRadiusSize;
	for(var c=0;c<5;c++){
		e.addPoint(new Point(a-b*Math.sin(2*Math.PI*c/5),h-b*Math.cos(2*Math.PI*c/5)))
	}
	var g=new Figure("Pentagon");
	g.style.fillStyle=figure_defaultFillStyle;
	g.style.strokeStyle=figure_defaultStrokeStyle;
	g.properties.push(new BuilderProperty("Text","primitives.1.str",BuilderProperty.TYPE_TEXT));
	g.properties.push(new BuilderProperty("Text Size ","primitives.1.size",BuilderProperty.TYPE_TEXT_FONT_SIZE));
	g.properties.push(new BuilderProperty("Font ","primitives.1.font",BuilderProperty.TYPE_TEXT_FONT_FAMILY));
	g.properties.push(new BuilderProperty("Alignment ","primitives.1.align",BuilderProperty.TYPE_TEXT_FONT_ALIGNMENT));
	g.properties.push(new BuilderProperty("Text Color","primitives.1.style.fillStyle",BuilderProperty.TYPE_COLOR));
	g.properties.push(new BuilderProperty(BuilderProperty.SEPARATOR));
	g.properties.push(new BuilderProperty("Stroke Style","style.strokeStyle",BuilderProperty.TYPE_COLOR));
	g.properties.push(new BuilderProperty("Fill Style","style.fillStyle",BuilderProperty.TYPE_COLOR));
	g.properties.push(new BuilderProperty("Line Width","style.lineWidth",BuilderProperty.TYPE_LINE_WIDTH));
	g.addPrimitive(e);var d=new Text(figure_defaultFigureTextStr+pentagono,a,h,figure_defaultFigureTextFont,figure_defaultFigureTextSize);
	d.style.fillStyle=figure_defaultFillTextStyle;
	g.addPrimitive(d);
	for(var c=0;c<5;c++){
		CONNECTOR_MANAGER.connectionPointCreate(g.id,new Point(a-b*Math.sin(2*Math.PI*c/5),h-b*Math.cos(2*Math.PI*c/5)),ConnectionPoint.TYPE_FIGURE)
	}
	CONNECTOR_MANAGER.connectionPointCreate(g.id,new Point(a,h),ConnectionPoint.TYPE_FIGURE);
	g.finalise();
	return g
}
//figura no utilizada
function figure_Hexagon(a,g){
	hexagono++;
	var d=new Polygon();
	var b=figure_defaultFigureSegmentShortSize/4*3+2;d.addPoint(new Point(a,g+b));
	d.addPoint(new Point(a+b,g+b/2));
	d.addPoint(new Point(a+b,g-b/2));
	d.addPoint(new Point(a,g-b));
	d.addPoint(new Point((a-b),g-b/2));
	d.addPoint(new Point((a-b),g+b/2));
	var e=new Figure("Hexagon");
	e.style.fillStyle=figure_defaultFillStyle;
	e.style.strokeStyle=figure_defaultStrokeStyle;
	e.properties.push(new BuilderProperty("Text","primitives.1.str",BuilderProperty.TYPE_TEXT));
	e.properties.push(new BuilderProperty("Text Size ","primitives.1.size",BuilderProperty.TYPE_TEXT_FONT_SIZE));
	e.properties.push(new BuilderProperty("Font ","primitives.1.font",BuilderProperty.TYPE_TEXT_FONT_FAMILY));
	e.properties.push(new BuilderProperty("Alignment ","primitives.1.align",BuilderProperty.TYPE_TEXT_FONT_ALIGNMENT));
	e.properties.push(new BuilderProperty("Text Color","primitives.1.style.fillStyle",BuilderProperty.TYPE_COLOR));
	e.properties.push(new BuilderProperty(BuilderProperty.SEPARATOR));
	e.properties.push(new BuilderProperty("Stroke Style","style.strokeStyle",BuilderProperty.TYPE_COLOR));
	e.properties.push(new BuilderProperty("Fill Style","style.fillStyle",BuilderProperty.TYPE_COLOR));
	e.properties.push(new BuilderProperty("Line Width","style.lineWidth",BuilderProperty.TYPE_LINE_WIDTH));
	e.addPrimitive(d);
	var c=new Text(figure_defaultFigureTextStr+hexagono,a,g-2,figure_defaultFigureTextFont,figure_defaultFigureTextSize);
	c.style.fillStyle=figure_defaultFillTextStyle;
	e.addPrimitive(c);CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a,g+b),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a+b,g+b/2),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a+b,g-b/2),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a,g-b),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a-b,g-b/2),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a-b,g+b/2),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(e.id,new Point(a,g),ConnectionPoint.TYPE_FIGURE);
	e.finalise();
	return e
}
//figura no utilizada
function figure_Octogon(b,i){
	var g=new Polygon();
	var d=figure_defaultFigureSegmentShortSize/3*2;
	var c=d/Math.sqrt(2);
	g.addPoint(new Point(b,i));
	g.addPoint(new Point(b+d,i));
	g.addPoint(new Point(b+d+c,i+c));
	g.addPoint(new Point(b+d+c,i+c+d));
	g.addPoint(new Point(b+d,i+c+d+c));
	g.addPoint(new Point(b,i+c+d+c));
	g.addPoint(new Point(b-c,i+c+d));
	g.addPoint(new Point(b-c,i+c));
	var h=new Figure("Octogon");
	h.style.fillStyle=figure_defaultFillStyle;
	h.style.strokeStyle=figure_defaultStrokeStyle;
	h.properties.push(new BuilderProperty("Text","primitives.1.str",BuilderProperty.TYPE_TEXT));
	h.properties.push(new BuilderProperty("Text Size ","primitives.1.size",BuilderProperty.TYPE_TEXT_FONT_SIZE));
	h.properties.push(new BuilderProperty("Font ","primitives.1.font",BuilderProperty.TYPE_TEXT_FONT_FAMILY));
	h.properties.push(new BuilderProperty("Alignment ","primitives.1.align",BuilderProperty.TYPE_TEXT_FONT_ALIGNMENT));
	h.properties.push(new BuilderProperty("Text Color","primitives.1.style.fillStyle",BuilderProperty.TYPE_COLOR));
	h.properties.push(new BuilderProperty(BuilderProperty.SEPARATOR));
	h.properties.push(new BuilderProperty("Stroke Style","style.strokeStyle",BuilderProperty.TYPE_COLOR));
	h.properties.push(new BuilderProperty("Fill Style","style.fillStyle",BuilderProperty.TYPE_COLOR));
	h.properties.push(new BuilderProperty("Line Width","style.lineWidth",BuilderProperty.TYPE_LINE_WIDTH));
	h.addPrimitive(g);var e=new Text(figure_defaultFigureTextStr,b+d/2,i+(d+c+c)/2-2,figure_defaultFigureTextFont,figure_defaultFigureTextSize);
	e.style.fillStyle=figure_defaultFillTextStyle;
	h.addPrimitive(e);
	CONNECTOR_MANAGER.connectionPointCreate(h.id,new Point(b,i),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(h.id,new Point(b+d,i),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(h.id,new Point(b+d+c,i+c),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(h.id,new Point(b+d+c,i+c+d),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(h.id,new Point(b+d,i+c+d+c),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(h.id,new Point(b,i+c+d+c),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(h.id,new Point(b-c,i+c+d),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(h.id,new Point(b-c,i+c),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(h.id,new Point(b+d/2,i+(d+c+c)/2),ConnectionPoint.TYPE_FIGURE);
	h.finalise();
	return h
}
//figura no utilizada
function figure_Text(a,d){
	var c=new Figure("Text");
	c.style.fillStyle=figure_defaultFillStyle;
	c.properties.push(new BuilderProperty("Text","primitives.0.text",BuilderProperty.TYPE_TEXT));
	c.properties.push(new BuilderProperty("Text Size ","primitives.0.textSize",BuilderProperty.TYPE_TEXT_FONT_SIZE));
	c.properties.push(new BuilderProperty("Font ","primitives.0.font",BuilderProperty.TYPE_TEXT_FONT_FAMILY));
	c.properties.push(new BuilderProperty("Alignment ","primitives.0.align",BuilderProperty.TYPE_TEXT_FONT_ALIGNMENT));
	c.properties.push(new BuilderProperty("Text Color","primitives.0.style.fillStyle",BuilderProperty.TYPE_COLOR));
	var b=new Text(figure_defaultFigureTextStr,a,d+figure_defaultFigureRadiusSize/2,figure_defaultFigureTextFont,figure_defaultFigureTextSize);
	b.style.fillStyle=figure_defaultFillTextStyle;c.addPrimitive(b);
	c.finalise();
	return c
}
//figura no utilizada
function figure_RoundedRectangle(n,m){
	var l=new Figure("RoundedRectangle");
	l.style.fillStyle=figure_defaultFillStyle;
	l.style.strokeStyle=figure_defaultStrokeStyle;
	l.style.lineWidth=2;
	l.properties.push(new BuilderProperty("Text","primitives.1.str",BuilderProperty.TYPE_TEXT));
	l.properties.push(new BuilderProperty("Text Size ","primitives.1.size",BuilderProperty.TYPE_TEXT_FONT_SIZE));
	l.properties.push(new BuilderProperty("Font ","primitives.1.font",BuilderProperty.TYPE_TEXT_FONT_FAMILY));
	l.properties.push(new BuilderProperty("Alignment ","primitives.1.align",BuilderProperty.TYPE_TEXT_FONT_ALIGNMENT));
	l.properties.push(new BuilderProperty("Text Color","primitives.1.style.fillStyle",BuilderProperty.TYPE_COLOR));
	l.properties.push(new BuilderProperty(BuilderProperty.SEPARATOR));
	l.properties.push(new BuilderProperty("Stroke Style","style.strokeStyle",BuilderProperty.TYPE_COLOR));
	l.properties.push(new BuilderProperty("Fill Style","style.fillStyle",BuilderProperty.TYPE_COLOR));
	l.properties.push(new BuilderProperty("Line Width","style.lineWidth",BuilderProperty.TYPE_LINE_WIDTH));
	var a=new Path();
	var q=10;var o=6;
	var g=new Line(new Point(n+q,m+o),new Point(n+figure_defaultFigureSegmentSize-q,m+o));
	var j=new QuadCurve(new Point(n+figure_defaultFigureSegmentSize-q,m+o),new Point(n+figure_defaultFigureSegmentSize-q+figure_defaultFigureCorner*(figure_defaultFigureCornerRoundness/10),m+figure_defaultFigureCorner/figure_defaultFigureCornerRoundness+o),new Point(n+figure_defaultFigureSegmentSize-q+figure_defaultFigureCorner,m+figure_defaultFigureCorner+o));
	var d=new Line(new Point(n+figure_defaultFigureSegmentSize-q+figure_defaultFigureCorner,m+figure_defaultFigureCorner+o),new Point(n+figure_defaultFigureSegmentSize-q+figure_defaultFigureCorner,m+figure_defaultFigureCorner+figure_defaultFigureSegmentShortSize-o));
	var i=new QuadCurve(new Point(n+figure_defaultFigureSegmentSize-q+figure_defaultFigureCorner,m+figure_defaultFigureCorner+figure_defaultFigureSegmentShortSize-o),new Point(n+figure_defaultFigureSegmentSize-q+figure_defaultFigureCorner*(figure_defaultFigureCornerRoundness/10),m+figure_defaultFigureCorner+figure_defaultFigureSegmentShortSize-o+figure_defaultFigureCorner*(figure_defaultFigureCornerRoundness/10)),new Point(n+figure_defaultFigureSegmentSize-q,m+figure_defaultFigureCorner+figure_defaultFigureSegmentShortSize-o+figure_defaultFigureCorner));
	var c=new Line(new Point(n+figure_defaultFigureSegmentSize-q,m+figure_defaultFigureCorner+figure_defaultFigureSegmentShortSize-o+figure_defaultFigureCorner),new Point(n+q,m+figure_defaultFigureCorner+figure_defaultFigureSegmentShortSize-o+figure_defaultFigureCorner));
	var h=new QuadCurve(new Point(n+q,m+figure_defaultFigureCorner+figure_defaultFigureSegmentShortSize-o+figure_defaultFigureCorner),new Point(n+q-figure_defaultFigureCorner*(figure_defaultFigureCornerRoundness/10),m+figure_defaultFigureCorner+figure_defaultFigureSegmentShortSize-o+figure_defaultFigureCorner*(figure_defaultFigureCornerRoundness/10)),new Point(n+q-figure_defaultFigureCorner,m+figure_defaultFigureCorner+figure_defaultFigureSegmentShortSize-o));
	var b=new Line(new Point(n+q-figure_defaultFigureCorner,m+figure_defaultFigureCorner+figure_defaultFigureSegmentShortSize-o),new Point(n+q-figure_defaultFigureCorner,m+figure_defaultFigureCorner+o));
	var e=new QuadCurve(new Point(n+q-figure_defaultFigureCorner,m+figure_defaultFigureCorner+o),new Point(n+q-figure_defaultFigureCorner*(figure_defaultFigureCornerRoundness/10),m+o),new Point(n+q,m+o));
	a.addPrimitive(g);
	a.addPrimitive(j);
	a.addPrimitive(d);
	a.addPrimitive(i);
	a.addPrimitive(c);
	a.addPrimitive(h);
	a.addPrimitive(b);
	a.addPrimitive(e);
	l.addPrimitive(a);
	var k=new Text(figure_defaultFigureTextStr,n+figure_defaultFigureSegmentSize/2,m+figure_defaultFigureSegmentShortSize/2+figure_defaultFigureCorner,figure_defaultFigureTextFont,figure_defaultFigureTextSize);
	k.style.fillStyle=figure_defaultFillTextStyle;l.addPrimitive(k);
	var s=figure_defaultFigureSegmentSize-q+figure_defaultFigureCorner;
	var r=figure_defaultFigureCorner+figure_defaultFigureSegmentShortSize-o+figure_defaultFigureCorner;CONNECTOR_MANAGER.connectionPointCreate(l.id,new Point(n+s/2-10,m+o),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(l.id,new Point(n+s/2,m+o),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(l.id,new Point(n+s/2+10,m+o),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(l.id,new Point(n+s,m+r/2-10),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(l.id,new Point(n+s,m+r/2),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(l.id,new Point(n+s,m+r/2+10),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(l.id,new Point(n+s/2-10,m+r),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(l.id,new Point(n+s/2,m+r),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(l.id,new Point(n+s/2+10,m+r),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(l.id,new Point(n,m+r/2-10),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(l.id,new Point(n,m+r/2),ConnectionPoint.TYPE_FIGURE);
	CONNECTOR_MANAGER.connectionPointCreate(l.id,new Point(n,m+r/2+10),ConnectionPoint.TYPE_FIGURE);
	l.finalise();
	return l
};
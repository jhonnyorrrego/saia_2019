var testNS={};testNS.state=1;var doUndo=true;var currentMoveUndo=null;var CONNECTOR_MANAGER=new ConnectorManager();
var GRIDWIDTH=20;
var fillColor=null;
var strokeColor="#000000";
var currentText=null;
var FIGURE_ESCAPE_DISTANCE=20;
var createFigureFunction=null;
var IE=false;
var CNTRL_PRESSED=false;
var SHIFT_PRESSED=false;
var connector=null;
var connectorType="";document.onselectstart=stopselection;
var comienzo = 0;
function stopselection(a){
	if(!a){
		a=window.event
	}
	if((IE&&a.srcElement.className=="text")||(!IE&&a.target.className=="text")){return true}
	return false
}
var stack=new Stack();
var mousePressed=false;
var STATE_NONE=0;
var STATE_FIGURE_CREATE=1;
var STATE_FIGURE_SELECTED=2;
var STATE_CONNECTOR_PICK_FIRST=4;
var STATE_CONNECTOR_PICK_SECOND=8;
var STATE_CONNECTOR_SELECTED=16;
var STATE_CONNECTOR_MOVE_POINT=32;
var STATE_SELECTING_MULTIPLE=64;
var STATE_GROUP_SELECTED=128;
var state=STATE_NONE;
var selectionArea=new Polygon();
selectionArea.points.push(new Point(0,0));
selectionArea.points.push(new Point(0,0));
selectionArea.points.push(new Point(0,0));
selectionArea.points.push(new Point(0,0));
selectionArea.style.strokeStyle="grey";
selectionArea.style.lineWidth="1";
var gridVisible=false;
var snapTo=false;
var lastClick=[];
var defaultLineWidth=2;
var selectedFigureId=-1;
var selectedGroupId=-1;
var selectedConnectorId=-1;
var selectedConnectionPointId=-1;
var dragging=false;
var canvasProps=null;
function getCanvas(){
	var a=document.getElementById("a");
	return a
}
function getContext(){
	var a=getCanvas();
	if(a.getContext){
		return a.getContext("2d")
	}
	else{
		alert("You need Safari or Firefox 1.5+ to see this demo.")
	}
}
var currentSetId="basic";
function setFigureSet(c){
	var b=document.getElementById(c);
	if(b!=null){
		if(currentSetId!=null){
			var a=document.getElementById(currentSetId);
			a.style.display="none"
		}
		b.style.display="block";currentSetId=c
	}
}
function updateFigure(g,l,b){
	Log.info("updateFigure() figureId: "+g+" property: "+l+" new value: "+b);
	var c=null;
	var d=stack.figureGetById(g);
	if(d){
		c=History.OBJECT_FIGURE
	}
	else{
		d=CONNECTOR_MANAGER.connectorGetById(g);
		Log.info("updateFigure(): it's a connector 1");
		if(d){
			c=History.OBJECT_CONNECTOR
		}else{
			if(g=="canvasProps"){
				d=canvasProps;
				Log.info("updateFigure(): it's the canvas")
			}
		}
	}
	var a=d;
	var j=l.split(".");
	for(var e=0;e<j.length-1;e++){
		d=d[j[e]]
	}
	var f=j[j.length-1];
	Log.info("updateFigure(): last property: "+f);Log.info("updateFigure(): last object in hierarchy: "+d.oType);
	if(d[f]===undefined){
		var h="set"+j[j.length-1];
		if(h in d){
			if(doUndo&&d["get"+f]()!=b){
				var k=new PropertyCommand(g,c,l,d["get"+f](),b);
				History.addUndo(k)}d[h](d,b)
			}
		}else{
			if(d[f]!=b){if(doUndo&&d[f]!=b){
				var k=new PropertyCommand(g,c,l,d[f],b);
				History.addUndo(k)
			}d[f]=b
		}
	}
	if(a instanceof Connector&&f=="str"){
		Log.info("updateFigure(): it's a connector 2");
		a.updateMiddleText()
	}draw()
}
function setUpEditPanel(a){
	var b=document.getElementById("edit");
	b.innerHTML="";
	if(a==null){}else{
		switch(a.oType){
			case"Group":break;
			case"CanvasProps":Builder.constructCanvasPropertiesPanel(b,a);
			break;
			default:Builder.contructPropertiesPanel(b,a)
		}
	}
}
/*
<Clase>
<Nombre>createFigure
<Parametros>a -> es la figura a crear
<Responsabilidades>Se crea cualquier figura.
Cuando uno crea una figura en el canvas, siempre se entra a esa funcion, en esta funcion ayuda a que cuando cargamos diagramo
carga con la ellipse inicio y fin 
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>

*/
function createFigure(a){
	comienzo++;
	createFigureFunction=a;
	selectedFigureId=-1;
	selectedConnectorId=-1;
	selectedConnectionPointId=-1;
	//state=STATE_FIGURE_SELECTED;
	state=STATE_FIGURE_CREATE;
	draw();
	//alert(comienzo);
	/*
	cada vez que uno crea una figura la variable comienzo incrementa, aqui se pone la condicion de igual a 1 y 2 ya que debe entrar dos veces
	para crear las dos ellipses
	*/
	if(comienzo == 1 || comienzo == 2)
	{
		/*snapMonitor=[0,0];
		var z2=createFigureFunction(309,229);
		z2.style.lineWidth=defaultLineWidth;
		stack.figureAdd(z2);
		selectedFigureId=z2.id;
		new CreateCommand(z2.id,History.OBJECT_FIGURE,null,z2.id,[createFigureFunction,v]);
		History.addUndo(w)
		selectedConnectorId=-1;
		state=STATE_FIGURE_SELECTED;
		createFigureFunction=null;
		setUpEditPanel(z);
		mousePressed=false;
		repaint=true*/
		//----------------------------------------------------------------------------------------------------------------------
		//cuando "comienzo" sea igual a 1 pone la primera ellipse en la posicion en x = 300 y = 80
		if(comienzo == 1){
			var n=300;
			var l=80;
		}
		//cuando comienzo sea igual a 2 pone la ellipse en la posicion en x = 300 y = 450 obviamente se entiende que este segundo es mas abajo
		if(comienzo == 2){
			var n=300;
			var l=450;
		}
		
		lastClick=[n,l];
		mousePressed=true;
		switch(state){
			case STATE_NONE:
			case STATE_FIGURE_CREATE:snapMonitor=[0,0];
			if(createFigureFunction){
				Log.info("onMouseDown() + STATE_FIGURE_CREATE--> new state STATE_FIGURE_SELECTED");
				var z=createFigureFunction(n,l);
				z.style.lineWidth=defaultLineWidth;
				//a.style.cursor="default";
				stack.figureAdd(z);
				selectedFigureId=z.id;
					var w=new CreateCommand(z.id,History.OBJECT_FIGURE,null,z.id,[createFigureFunction]);
					History.addUndo(w)
				selectedConnectorId=-1;
				state=STATE_FIGURE_SELECTED;
				createFigureFunction=null;
				setUpEditPanel(z);
				mousePressed=false;
				repaint=true
			}
			break;
			case STATE_FIGURE_SELECTED:
			break;
			case STATE_GROUP_SELECTED:break;
			case STATE_CONNECTOR_PICK_FIRST:
			break;
			case STATE_CONNECTOR_PICK_SECOND:
			break;
			case STATE_CONNECTOR_SELECTED:break;
			default:
	
	
	
	//----------------------------------------------------------------------------------------------------------------------
		}
		draw();
		return false;
	}
}
function snapToGrid(){
	if(gridVisible==false&&snapTo==false){
		showGrid()
	}
	snapTo=!snapTo;
	document.getElementById("snapCheckbox").checked=snapTo
}
function showGrid(){
	var a=getCanvas();
	gridVisible=!gridVisible;
	if(gridVisible){
		a.style.backgroundImage="url(assets/images/gridTile1.png)"
	}else{
		a.style.backgroundImage="";
		document.getElementById("snapCheckbox").checked=false
	}
	document.getElementById("gridCheckbox").checked=gridVisible
}
function onClick(b){
	var c=getCanvasXY(b);
	var a=c[0];
	var d=c[1]
}
function onKeyPress(a){if(!a){a=window.event}if((IE&&a.srcElement.className=="text")||(!IE&&a.target.className=="text")){
	return
}
switch(a.charCode){
	case KEY.NUMPAD4:if(CNTRL_PRESSED&&stack.figureGetSelected()){
		var b=stack.figureGetSelected().clone();
		stack.figureAdd(b);
		stack.figureSelect(stack.figures.length-1);
		b.transform(Matrix.translationMatrix(10,10));
		getCanvas().style.cursor="default"
	}
	break
}
draw();
return false
}
//----------------------------------------eventos con el teclado----------------------------------------------------------
function onKeyDown(f){
	Log.info("main.js->onKeyDown()->function call. Event = "+f.type+" IE = "+IE);
	if(typeof f=="undefined"||f==null){
		f=window.event
	}
	if((IE&&f.srcElement.className=="text")||(!IE&&f.target.className=="text")){
		return true
	}
	f.KEY=f.keyCode;Log.info("e.keyCode = "+f.keyCode+" ev.KEY = "+f.KEY);
	switch(f.KEY){
	case KEY.ESCAPE:createFigureFunction=null;
	if(selectedFigureId!=-1||selectedConnectionPointId!=-1||selectedConnectorId!=-1){
		redraw=true
	}
	selectedFigureId=-1;
	selectedConnectionPointId=-1;
	selectedConnectorId=-1;state=STATE_NONE;
	break;
	case KEY.DELETE:
	
	switch(state){
		case STATE_FIGURE_SELECTED:if(selectedFigureId>-1){
		  $.post("funcion5.php",{borrar_figura : selectedFigureId});
			if(!f.noAddUndo&&doUndo){
				var b=new DeleteCommand(selectedFigureId,History.OBJECT_FIGURE,null,stack.figureGetById(selectedFigureId),f);
				History.addUndo(b)
			}
			stack.figureRemoveById(selectedFigureId);
			var g=CONNECTOR_MANAGER.connectionPointGetAllByParent(selectedFigureId);
			for(var c=0;c<g.length;c++){
				CONNECTOR_MANAGER.glueRemoveAllByFirstId(g[c].id)
			}
			CONNECTOR_MANAGER.connectionPointRemoveAllByParent(selectedFigureId);
			selectedFigureId=-1;
			setUpEditPanel(canvasProps);
			state=STATE_NONE;
			redraw=true
		}
		break;
		case STATE_CONNECTOR_SELECTED:if(selectedConnectorId!=-1){
			var a=CONNECTOR_MANAGER.connectorGetById(selectedConnectorId);
			$.post("funcion5.php",{borrar_figura : selectedConnectorId});
			if(!f.noAddUndo&&doUndo){
				var b=new DeleteCommand(selectedConnectorId,History.OBJECT_CONNECTOR,null,a,null);
				History.addUndo(b)
			}
			CONNECTOR_MANAGER.connectorRemoveByIdCascade(selectedConnectorId);
			selectedConnectorId=-1;
			setUpEditPanel(canvasProps);
			state=STATE_NONE;
			redraw=true
		}
		break;
		case STATE_GROUP_SELECTED:var e=stack.figureGetByGroupId(selectedGroupId);
		if(!f.noAddUndo&&doUndo){
			var b=new DeleteCommand(selectedGroupId,History.OBJECT_GROUP,null,e,stack.groupGetById(selectedGroupId).permanent);
			History.addUndo(b)
		}
		var e=stack.figureGetByGroupId(selectedGroupId);
		stack.groupDestroy(selectedGroupId);
		for(var d=0;d<e.length;d++){
			stack.figureRemoveById(e[d].id)
		}
		selectedGroupId=-1;
		state=STATE_NONE;
		break
	}
	break;
	case KEY.SHIFT:SHIFT_PRESSED=true;
	break;
	case KEY.CTRL:case KEY.COMMAND:case KEY.COMMAND_FIREFOX:CNTRL_PRESSED=true;
	break;
	case KEY.LEFT:action("left");
	return false;
	break;
	case KEY.UP:action("up");
	return false;
	break;
	case KEY.RIGHT:action("right");
	return false;
	break;
	case KEY.DOWN:action("down");
	return false;
	break;case KEY.Z:if(CNTRL_PRESSED){action("undo")}
	break;case KEY.Y:if(CNTRL_PRESSED){action("redo")}
	break;case KEY.G:if(CNTRL_PRESSED){action("group")}
	break;case KEY.U:if(CNTRL_PRESSED){action("ungroup")}
	break;case KEY.S:if(CNTRL_PRESSED){save()}break}draw();
	return false
	}
	function onKeyUp(a){
		if(!a){a=window.event}switch(a.keyCode){
			case KEY.SHIFT:SHIFT_PRESSED=false;
			break;
			case KEY.ALT:CNTRL_PRESSED=false;break;
			case KEY.CTRL:CNTRL_PRESSED=false;break
		}
		return false
	}
//---------------------------------------------click en el canvas------------------evento con mouse ---------------
	function onMouseDown(v){
		var q=getCanvasXY(v);
		var a=getCanvas();
		var n=q[0];
		var l=q[1];
		lastClick=[n,l];
		mousePressed=true;
		switch(state){
		case STATE_NONE:snapMonitor=[0,0];
		var b=stack.figureGetByXY(n,l);
		if(b!=-1){
			if(stack.figureGetById(b).groupId!=-1){
				selectedGroupId=stack.figureGetById(b).groupId;
				var k=stack.groupGetById(selectedGroupId);
				state=STATE_GROUP_SELECTED;
				if(doUndo){
					currentMoveUndo=new MatrixCommand(selectedGroupId,History.OBJECT_GROUP,History.MATRIX,Matrix.translationMatrix(k.getBounds()[0],k.getBounds()[1]),null)
				}
			}
			else{
				selectedFigureId=b;
				var t=stack.figureGetById(b);
//------------------------------------------Aqui se llama al texto a la derecha-----------------------------------------------
				setUpEditPanel(t);
				state=STATE_FIGURE_SELECTED;
				if(doUndo){
					//alert(b);
					/*var x11 = t.getBounds()[0];
					var y11 = t.getBounds()[1];
					var x22 = t.getBounds()[2];
					var y22 = t.getBounds()[3];
					
					$(document).ready(function(){
					$.post("funcion2.php",{id_figura : b,x1 : x11, y1 : y11, x2 : x22, y2 : y22},function(data){
							formulario = data;
							
							//alert(data);
						});
					});*/
					
					currentMoveUndo=new MatrixCommand(b,History.OBJECT_FIGURE,History.MATRIX,Matrix.translationMatrix(t.getBounds()[0],t.getBounds()[1]),null)
				}
			}
		}else{
			setUpEditPanel(canvasProps);
			HandleManager.clear();
			selectedFigureId=-1;
			state=STATE_SELECTING_MULTIPLE;
			selectionArea.points[0]=new Point(n,l);
			selectionArea.points[1]=new Point(n,l);
			selectionArea.points[2]=new Point(n,l);
			selectionArea.points[3]=new Point(n,l)
		}var o=CONNECTOR_MANAGER.connectorGetByXY(n,l);
		if(o!=-1){
			selectedConnectorId=o;
			state=STATE_CONNECTOR_SELECTED;
			var e=CONNECTOR_MANAGER.connectorGetById(selectedConnectorId);
			setUpEditPanel(e);Log.info("onMouseDown() + STATE_NONE  - change to STATE_CONNECTOR_SELECTED");
			repaint=true
		}else{
			selectedConnectorId=-1;
			Log.info("onMouseDown() + STATE_NONE - deselect any connector");
			repaint=true
		}
		break;
		case STATE_FIGURE_CREATE:snapMonitor=[0,0];
		if(createFigureFunction){
			Log.info("onMouseDown() + STATE_FIGURE_CREATE--> new state STATE_FIGURE_SELECTED");
			var z=createFigureFunction(n,l);
			z.style.lineWidth=defaultLineWidth;
			
			a.style.cursor="default";
			stack.figureAdd(z);
			selectedFigureId=z.id;
			
			var x11 = z.getBounds()[0];
			var y11 = z.getBounds()[1];
			var x22 = z.getBounds()[2];
			var y22 = z.getBounds()[3];		
					$(document).ready(function(){
					$.post("funcion4.php",{figura : z.id,x1 : x11, y1 : y11, x2 : x22, y2 : y22},function(data){
							//formulario = data;
						});
					});
			
			/**/ 
//-----------------------------------------------------------			
			if(!v.noAddUndo&&doUndo){
				var w=new CreateCommand(z.id,History.OBJECT_FIGURE,null,z.id,[createFigureFunction,v]);
				History.addUndo(w);
				setUpEditPanel(z);
			}
			selectedConnectorId=-1;
			state=STATE_FIGURE_SELECTED;
			createFigureFunction=null;
			
			mousePressed=false;
			repaint=true
		}
		break;
		case STATE_FIGURE_SELECTED:snapMonitor=[0,0];
		
		var b=stack.figureGetByXY(n,l);

		if(b!=-1&&stack.figureGetById(b).groupId!=-1){
			state=STATE_GROUP_SELECTED;
			selectedGroupId=stack.figureGetById(b).groupId;
			selectedFigureId=-1;
			var r=stack.groupGetById(selectedFigureId);
			redraw=true;
			if(doUndo){
				currentMoveUndo=new MatrixCommand(selectedFigureId,History.OBJECT_FIGURE,History.MATRIX,Matrix.translationMatrix(r.getBounds()[0],r.getBounds()[1]),null)
			}
			HandleManager.figureSet(r);
			state=STATE_GROUP_SELECTED;
			break
		}
		if(b!=-1&&b!=selectedFigureId){
			selectedFigureId=b;
			HandleManager.clear();
			var t=stack.figureGetById(b);
			setUpEditPanel(t);
			redraw=true;
			if(doUndo){
				currentMoveUndo=new MatrixCommand(b,History.OBJECT_FIGURE,History.MATRIX,Matrix.translationMatrix(t.getBounds()[0],t.getBounds()[1]),null)
			}
		}
		else{
			if(b==selectedFigureId&&b!=-1){
				var t=stack.figureGetById(b);
				if(doUndo){
					currentMoveUndo=new MatrixCommand(b,History.OBJECT_FIGURE,History.MATRIX,Matrix.translationMatrix(t.getBounds()[0],t.getBounds()[1]),null)
				}
			}else{
				if(HandleManager.handleGet(n,l)!=null){

					Log.info("onMouseDown() + STATE_FIGURE_SELECTED - handle selected");
					HandleManager.handleSelectXY(n,l);
					var s=[HandleManager.figure.rotationCoords[0].clone(),HandleManager.figure.rotationCoords[1].clone()];
					var u=Util.getAngle(HandleManager.figure.rotationCoords[0],HandleManager.figure.rotationCoords[1],0.00001);
					var d=Matrix.translationMatrix(-HandleManager.figure.rotationCoords[0].x,-HandleManager.figure.rotationCoords[0].y);
					if(u!=0){
						HandleManager.figure.transform(d);
						HandleManager.figure.transform(Matrix.rotationMatrix(-u));
						d[0][2]=-d[0][2];d[1][2]=-d[1][2];
						HandleManager.figure.transform(d);
						d[0][2]=-d[0][2];d[1][2]=-d[1][2]
					}
					if(doUndo){
						currentMoveUndo=new MatrixCommand(HandleManager.figure.id,History.OBJECT_FIGURE,History.MATRIX,s,HandleManager.figure.getBounds())
					}
					if(u!=0){
						HandleManager.figure.transform(d);
						HandleManager.figure.transform(Matrix.rotationMatrix(u));
						d[0][2]=-d[0][2];d[1][2]=-d[1][2];
						HandleManager.figure.transform(d)
					}
				}
				else{
					if(b!=selectedFigureId){
						Log.info("onMouseDown() + STATE_FIGURE_SELECTED --> deselect any figure");
						selectedFigureId=-1;
						setUpEditPanel(canvasProps);
						state=STATE_NONE;
						redraw=true;
						currentMoveUndo=null;
						state=STATE_SELECTING_MULTIPLE;
						selectionArea.points[0]=new Point(n,l);
						selectionArea.points[1]=new Point(n,l);
						selectionArea.points[2]=new Point(n,l);
						selectionArea.points[3]=new Point(n,l)
					}
				}
			}
		}break;
		case STATE_GROUP_SELECTED:var i=stack.groupGetById(selectedGroupId);
		if(!i.contains(n,l)&&HandleManager.handleGet(n,l)==null){
			if(i.permanent==false&&doUndo){
				History.addUndo(new GroupCommand(selectedGroupId,History.OBJECT_GROUP,false,stack.figureGetIdsByGroupId(selectedGroupId),false));
				stack.groupDestroy(selectedGroupId)
			}
			selectedGroupId=-1;
			state=STATE_NONE;
			break
		}
		var b=stack.figureGetByXY(n,l);
		var p=selectedGroupId;
		if(b!=-1&&stack.figureGetById(b).groupId!=-1){
			p=stack.figureGetById(b).groupId
		}
		else{
			if(HandleManager.handleGet(n,l)!=null){
				p=-1
			}
			else{
				if(b!=-1){
					state=STATE_FIGURE_SELECTED;break
				}
			}
		}
		if(p!=-1){
			selectedGroupId=p;
			var r=stack.groupGetById(p);
			redraw=true;
			if(doUndo){
				currentMoveUndo=new MatrixCommand(p,History.OBJECT_GROUP,History.MATRIX,Matrix.translationMatrix(r.getBounds()[0],r.getBounds()[1]),null)
			}
			state=STATE_GROUP_SELECTED
		}
		else{
			if(HandleManager.handleGet(n,l)!=null){
				Log.info("onMouseDown() + STATE_FIGURE_SELECTED - handle selected");
				HandleManager.handleSelectXY(n,l);
				var s=[HandleManager.figure.rotationCoords[0].clone(),HandleManager.figure.rotationCoords[1].clone()];
				var u=Util.getAngle(HandleManager.figure.rotationCoords[0],HandleManager.figure.rotationCoords[1],0.00001);
				var d=Matrix.translationMatrix(-HandleManager.figure.rotationCoords[0].x,-HandleManager.figure.rotationCoords[0].y);
				if(u!=0){
					HandleManager.figure.transform(d);
					HandleManager.figure.transform(Matrix.rotationMatrix(-u));
					d[0][2]=-d[0][2];d[1][2]=-d[1][2];
					HandleManager.figure.transform(d);
					d[0][2]=-d[0][2];
					d[1][2]=-d[1][2]
				}
				if(doUndo){
					currentMoveUndo=new MatrixCommand(HandleManager.figure.id,History.OBJECT_GROUP,History.MATRIX,s,HandleManager.figure.getBounds())
				}
				if(u!=0){
					HandleManager.figure.transform(d);
					HandleManager.figure.transform(Matrix.rotationMatrix(u));
					d[0][2]=-d[0][2];
					d[1][2]=-d[1][2];
					HandleManager.figure.transform(d)
				}
			}
		}break;
		case STATE_CONNECTOR_PICK_FIRST:connectorPickFirst(n,l,v);
		break;
		case STATE_CONNECTOR_PICK_SECOND:state=STATE_NONE;
		break;
		case STATE_CONNECTOR_SELECTED:var m=CONNECTOR_MANAGER.connectionPointGetAllByParent(selectedConnectorId);
		var h=m[0];
		var c=m[1];
		if(h.point.near(n,l,3)){
			var r=CONNECTOR_MANAGER.glueGetBySecondConnectionPointId(h.id);
			Log.info("Picked the start point");
			selectedConnectionPointId=h.id;
			if(r.length!=0&&doUndo==true){
				currentMoveUndo=new MatrixCommand(selectedConnectionPointId,History.OBJECT_CONNECTION_POINT,[r[0].id1,r[0].id2],Matrix.translationMatrix(h.point.x,h.point.y),null)
			}
			else{
				if(doUndo==true){
					currentMoveUndo=new MatrixCommand(selectedConnectionPointId,History.OBJECT_CONNECTION_POINT,null,Matrix.translationMatrix(h.point.x,h.point.y),null)
				}
			}
			state=STATE_CONNECTOR_MOVE_POINT;
			a.style.cursor="move"
		}
		else{
			if(c.point.near(n,l,3)){
				var r=CONNECTOR_MANAGER.glueGetBySecondConnectionPointId(c.id);
				Log.info("Picked the end point");
				selectedConnectionPointId=c.id;
				if(r.length!=0&&doUndo==true){
					currentMoveUndo=new MatrixCommand(selectedConnectionPointId,History.OBJECT_CONNECTION_POINT,[r[0].id1,r[0].id2],Matrix.translationMatrix(c.point.x,c.point.y),null)
				}else{
					if(doUndo==true){
						currentMoveUndo=new MatrixCommand(selectedConnectionPointId,History.OBJECT_CONNECTION_POINT,null,Matrix.translationMatrix(c.point.x,c.point.y),null)
					}
				}
				state=STATE_CONNECTOR_MOVE_POINT;a.style.cursor="move"
			}else{
				var j=selectedConnectorId;
				if(HandleManager.handleGet(n,l)==null){
					j=CONNECTOR_MANAGER.connectorGetByXY(n,l)
				}if(j==-1){
					Log.info("No other connector selected. Deselect all connectors");
					selectedConnectorId=-1;
					state=STATE_NONE;
					setUpEditPanel(canvasProps);
					repaint=true
				}else{
					if(j==selectedConnectorId){
						Log.info("onMouseDown(): Nothing, it's the same connector")
					}else{
						Log.info("onMouseDown(): Select another connector");
						selectedConnectorId=j;setUpEditPanel(CONNECTOR_MANAGER.connectorGetById(selectedConnectorId));
						state=STATE_CONNECTOR_SELECTED;repaint=true
					}
				}if(HandleManager.handleGet(n,l)!=null){
					Log.info("onMouseDown() + STATE_FIGURE_SELECTED - handle selected");
					HandleManager.handleSelectXY(n,l)
				}
			}
		}break;
		default:
	}
	draw();
	return false
}
//-------------------------------------Cuando se deja de pulsar un boton del raton --------------------------------------------
function onMouseUp(K){
	var m=getCanvasXY(K);
	x=m[0];
	y=m[1];
	lastClick=[];
	switch(state){
		case STATE_NONE:if(HandleManager.handleGetSelected()){
			HandleManager.clear()
		}
		break;
		case STATE_FIGURE_SELECTED:
			
		if(currentMoveUndo!=null&&HandleManager.handleGetSelected()==null){
					
			var N=stack.figureGetById(selectedFigureId);
			
			var b = selectedFigureId;
// Aqui capturo la posicion de una figura de x1,y1,x2,y2 y la inserto a la base de datos.
//es decir, estamos en el estado figura seleccionada : STATE_FIGURE_SELECTED, entonces al mismo tiempo estamos en un estado cuando se suelta click
//asi que si arrastramos una figura y la soltamos entra aqui a esta funcion y captura las posiciones y las inserta a la base de datos por medio
//del jquery
			var x11 = N.getBounds()[0];
			var y11 = N.getBounds()[1];
			var x22 = N.getBounds()[2];
			var y22 = N.getBounds()[3];
			
			
			//va a funcion2.php envia los datos 
			$(document).ready(function(){
			$.post("funcion4.php",{figura : b,x1 : x11, y1 : y11, x2 : x22, y2 : y22},function(data){
					formulario = data;
					
					//alert(data);
				});
			});
					
			
			if(N.getBounds()[0]!=currentMoveUndo.previousValue[0][2]||N.getBounds()[1]!=currentMoveUndo.previousValue[1][2]){
				currentMoveUndo.currentValue=[Matrix.translationMatrix(N.getBounds()[0]-currentMoveUndo.previousValue[0][2],N.getBounds()[1]-currentMoveUndo.previousValue[1][2])];
				currentMoveUndo.previousValue=[Matrix.translationMatrix(currentMoveUndo.previousValue[0][2]-N.getBounds()[0],currentMoveUndo.previousValue[1][2]-N.getBounds()[1])];
				History.addUndo(currentMoveUndo);currentMoveUndo=null
			}
		}
		if(HandleManager.handleGetSelected()!=null){
			var q=HandleManager.figure;
			var C=q.getBounds();
			var r=currentMoveUndo.previousValue;
			var I=q.rotationCoords;
			var F=Util.getAngle(r[0],r[1],0.001);
			var t=Util.getAngle(I[0],I[1],0.001);
			
					
			if(F!=t){
				currentMoveUndo.previousValue=[Matrix.translationMatrix(-r[0].x,-r[0].y),Matrix.rotationMatrix(F-t),Matrix.translationMatrix(r[0].x,r[0].y)];
				currentMoveUndo.currentValue=[Matrix.translationMatrix(-r[0].x,-r[0].y),Matrix.rotationMatrix(t-F),Matrix.translationMatrix(r[0].x,r[0].y)]
			}else{
				
				F=Util.getAngle(r[0],r[1]);
				t=Util.getAngle(I[0],I[1]);
				var E=1;
				var D=1;
				var d=Matrix.translationMatrix(0,0);
				var n=Matrix.translationMatrix(0,0);
				var e=currentMoveUndo.currentValue;
				var G=Matrix.translationMatrix(-HandleManager.figure.rotationCoords[0].x,-HandleManager.figure.rotationCoords[0].y);HandleManager.figure.transform(G);
				G[0][2]=-G[0][2];G[1][2]=-G[1][2];
				HandleManager.figure.transform(Matrix.rotationMatrix(-t));
				HandleManager.figure.transform(G);G[0][2]=-G[0][2];G[1][2]=-G[1][2];
				var l=HandleManager.figure.getBounds();HandleManager.figure.transform(G);G[0][2]=-G[0][2];G[1][2]=-G[1][2];
				HandleManager.figure.transform(Matrix.rotationMatrix(t));
				HandleManager.figure.transform(G);
				HandleManager.figure.transform(Matrix.rotationMatrix(-t));
				var P=HandleManager.figure.getBounds();
				HandleManager.figure.transform(Matrix.rotationMatrix(t));
				var o=(e[2]-e[0])/2;
				var c=(l[2]-l[0])/2;
				var z=(e[3]-e[1])/2;
				var B=(l[3]-l[1])/2;
				E=o/c;
				D=z/B;
				var s=HandleManager.handleGetSelected();
				if(s.type=="w"||s.type=="nw"||s.type=="sw"){
					d[0][2]=-P[2];n[0][2]=P[2]
				}else{
					d[0][2]=-P[0];n[0][2]=P[0]
				}if(s.type=="n"||s.type=="nw"||s.type=="ne"){
					d[1][2]=-P[3];n[1][2]=P[3]
				}else{
					d[1][2]=-P[1];n[1][2]=P[1]
				}if(doUndo){
					currentMoveUndo.previousValue=[Matrix.rotationMatrix(-t),d,Matrix.scaleMatrix(E,D),n,Matrix.rotationMatrix(t)];
					currentMoveUndo.currentValue=[Matrix.rotationMatrix(-t),d,Matrix.scaleMatrix(1/E,1/D),n,Matrix.rotationMatrix(t)]
				}
			}if(doUndo&&currentMoveUndo!=null){
				History.addUndo(currentMoveUndo)
			}HandleManager.clear();
			redraw=true
		}break;
		case STATE_GROUP_SELECTED:if(currentMoveUndo!=null&&HandleManager.handleGetSelected()==null){
			var N=stack.groupGetById(selectedGroupId);
			if(N.getBounds()[0]!=currentMoveUndo.previousValue[0][2]||N.getBounds()[1]!=currentMoveUndo.previousValue[1][2]){
				currentMoveUndo.currentValue=[Matrix.translationMatrix(N.getBounds()[0]-currentMoveUndo.previousValue[0][2],N.getBounds()[1]-currentMoveUndo.previousValue[1][2])];
				currentMoveUndo.previousValue=[Matrix.translationMatrix(currentMoveUndo.previousValue[0][2]-N.getBounds()[0],currentMoveUndo.previousValue[1][2]-N.getBounds()[1])]
			}
		}if(HandleManager.handleGetSelected()!=null){
			var q=HandleManager.figure;
			var C=q.getBounds();
			var r=currentMoveUndo.previousValue;
			var I=q.rotationCoords;
			var F=Util.getAngle(r[0],r[1],0.001);
			var t=Util.getAngle(I[0],I[1],0.001);
			if(F!=t&&currentMoveUndo!=null&&doUndo){
				currentMoveUndo.previousValue=[Matrix.translationMatrix(-r[0].x,-r[0].y),Matrix.rotationMatrix(F-t),Matrix.translationMatrix(r[0].x,r[0].y)];
				currentMoveUndo.currentValue=[Matrix.translationMatrix(-r[0].x,-r[0].y),Matrix.rotationMatrix(t-F),Matrix.translationMatrix(r[0].x,r[0].y)]
			}else{
				F=Util.getAngle(r[0],r[1]);t=Util.getAngle(I[0],I[1]);
				var E=1;
				var D=1;
				var d=Matrix.translationMatrix(0,0);
				var n=Matrix.translationMatrix(0,0);
				var e=currentMoveUndo.currentValue;
				var G=Matrix.translationMatrix(-HandleManager.figure.rotationCoords[0].x,-HandleManager.figure.rotationCoords[0].y);HandleManager.figure.transform(G);
				G[0][2]=-G[0][2];
				G[1][2]=-G[1][2];
				HandleManager.figure.transform(Matrix.rotationMatrix(-t));
				HandleManager.figure.transform(G);
				G[0][2]=-G[0][2];
				G[1][2]=-G[1][2];
				var l=HandleManager.figure.getBounds();
				HandleManager.figure.transform(G);
				G[0][2]=-G[0][2];
				G[1][2]=-G[1][2];
				HandleManager.figure.transform(Matrix.rotationMatrix(t));
				HandleManager.figure.transform(G);HandleManager.figure.transform(Matrix.rotationMatrix(-t));
				var P=HandleManager.figure.getBounds();
				HandleManager.figure.transform(Matrix.rotationMatrix(t));
				var o=(e[2]-e[0])/2;
				var c=(l[2]-l[0])/2;
				var z=(e[3]-e[1])/2;
				var B=(l[3]-l[1])/2;
				E=o/c;
				D=z/B;
				var s=HandleManager.handleGetSelected();
				if(s.type=="w"||s.type=="nw"||s.type=="sw"){
					d[0][2]=-P[2];n[0][2]=P[2]
				}else{
					d[0][2]=-P[0];n[0][2]=P[0]
				}if(s.type=="n"||s.type=="nw"||s.type=="ne"){
					d[1][2]=-P[3];n[1][2]=P[3]
				}else{
					d[1][2]=-P[1];n[1][2]=P[1]
				}if(doUndo&&currentMoveUndo!=null){
					currentMoveUndo.previousValue=[Matrix.rotationMatrix(-t),d,Matrix.scaleMatrix(E,D),n,Matrix.rotationMatrix(t)];
					currentMoveUndo.currentValue=[Matrix.rotationMatrix(-t),d,Matrix.scaleMatrix(1/E,1/D),n,Matrix.rotationMatrix(t)]
				}
			}
		}HandleManager.handleSelectedIndex=-1;
		if(doUndo&&currentMoveUndo!=null){History.addUndo(currentMoveUndo)}
		currentMoveUndo=null;
		break;
		case STATE_SELECTING_MULTIPLE:state=STATE_NONE;
		var O=[];for(var L=0;L<stack.figures.length;L++){
			if(stack.figures[L].groupId==-1){
				var H=stack.figures[L].getPoints();
				if(H.length==0){
					H.push(new Point(stack.figures[L].getBounds()[0],stack.figures[L].getBounds()[1]));
					H.push(new Point(stack.figures[L].getBounds()[2],stack.figures[L].getBounds()[3]));
					H.push(new Point(stack.figures[L].getBounds()[0],stack.figures[L].getBounds()[3]));
					H.push(new Point(stack.figures[L].getBounds()[2],stack.figures[L].getBounds()[1]))
				}
				for(var R=0;R<H.length;R++){
					if(Util.isPointInside(H[R],selectionArea.getPoints())){
						O.push(stack.figures[L].id);
						break
					}
				}
			}
		}
		if(O.length>1){
			selectedGroupId=stack.groupCreate(O);
			state=STATE_GROUP_SELECTED
		}else{
			if(O.length==1){
				selectedFigureId=O[0];state=STATE_FIGURE_SELECTED
			}
		}
		break;
		case STATE_CONNECTOR_PICK_SECOND:var j=CONNECTOR_MANAGER.connectorGetById(selectedConnectorId);
		var p=CONNECTOR_MANAGER.connectionPointGetAllByParent(j.id);
		var J=CONNECTOR_MANAGER.connectionPointGetByXY(x,y,ConnectionPoint.TYPE_FIGURE);
		if(J!=-1){
			var h=CONNECTOR_MANAGER.connectionPointGetById(J);
//--------------------------------------------------------------h.parentId-----------------------nodo final------------------
      $(document).ready(function(){
    			$.post("insertar_conector.php",{nodofinal:h.parentId},function(datos){
    			   //alert(datos);
          });
      });
//---------------------------------------------------------------------------------------------------------------------------
			Log.info("Second ConnectionPoint is: "+h);
			p[1].point.x=h.point.x;
			p[1].point.y=h.point.y;
			j.turningPoints[j.turningPoints.length-1].x=h.point.x;
			j.turningPoints[j.turningPoints.length-1].y=h.point.y;
			h.color=ConnectionPoint.NORMAL_COLOR;
			p[1].color=ConnectionPoint.NORMAL_COLOR;
			var M=CONNECTOR_MANAGER.glueCreate(h.id,p[1].id);
			if(j.type==Connector.TYPE_JAGGED){
				CONNECTOR_MANAGER.connectorAdjustByConnectionPoint(p[1].id)
			}
			if(!K.noAddUndo&&doUndo==true){
				History.addUndo(new ConnectCommand([M.id1,M.id2],History.OBJECT_GLUE,null,M.id1,null))
			}else{
				if(doUndo==true){
					History.CURRENT_POINTER++
				}
			}
		}else{p[1].point.x=x;p[1].point.y=y;j.turningPoints[j.turningPoints.length-1].x=x;j.turningPoints[j.turningPoints.length-1].y=y;if(j.type==Connector.TYPE_JAGGED){
			CONNECTOR_MANAGER.connectorAdjustByConnectionPoint(p[1].id)
		}
	}
	if(!K.noAddUndo){currentMoveUndo.currentValue=[currentMoveUndo.currentValue,K]
	}
	state=STATE_CONNECTOR_SELECTED;
	setUpEditPanel(j);
	redraw=true;
	break;
	case STATE_CONNECTOR_MOVE_POINT:var w=CONNECTOR_MANAGER.connectionPointGetById(selectedConnectionPointId);var p=CONNECTOR_MANAGER.connectionPointGetAllByParent(w.parentId);var k=w;var A=Matrix.translationMatrix(k.point.x-currentMoveUndo.previousValue[0][2],k.point.y-currentMoveUndo.previousValue[1][2]);if(doUndo){currentMoveUndo.currentValue=[A];currentMoveUndo.previousValue=[Matrix.translationMatrix(currentMoveUndo.previousValue[0][2]-k.point.x,currentMoveUndo.previousValue[1][2]-k.point.y)];History.addUndo(currentMoveUndo)}p[0].color=ConnectionPoint.NORMAL_COLOR;p[1].color=ConnectionPoint.NORMAL_COLOR;var u=CONNECTOR_MANAGER.glueGetBySecondConnectionPointId(selectedConnectionPointId);if(u.length==1){var J=u[0].id1;var h=CONNECTOR_MANAGER.connectionPointGetById(J);if(!h.point.near(x,y,3)){CONNECTOR_MANAGER.glueRemoveByIds(J,selectedConnectionPointId);Log.info("Glue removed")}}var J=CONNECTOR_MANAGER.connectionPointGetByXY(x,y,ConnectionPoint.TYPE_FIGURE);if(J!=-1){var h=CONNECTOR_MANAGER.connectionPointGetById(J);Log.info("onMouseUp() + STATE_CONNECTOR_MOVE_POINT : fCP is "+h+" and fCpId is "+J);var j=CONNECTOR_MANAGER.connectorGetById(w.parentId);var v=CONNECTOR_MANAGER.glueGetAllByIds(J,selectedConnectionPointId);if(v.length>0){Log.info("Snap back to old figure (not a new glue)");if(p[0].id==selectedConnectionPointId){p[0].point.x=h.point.x;p[0].point.y=h.point.y;j.turningPoints[0].x=h.point.x;j.turningPoints[0].y=h.point.y}else{p[1].point.x=h.point.x;p[1].point.y=h.point.y;j.turningPoints[j.turningPoints.length-1].x=h.point.x;j.turningPoints[j.turningPoints.length-1].y=h.point.y}}else{Log.info("Snap back to new figure (plus add a new glue)");if(p[0].id==selectedConnectionPointId){p[0].point.x=h.point.x;p[0].point.y=h.point.y;j.turningPoints[0].x=h.point.x;j.turningPoints[0].y=h.point.y}else{p[1].point.x=h.point.x;p[1].point.y=h.point.y;j.turningPoints[j.turningPoints.length-1].x=h.point.x;j.turningPoints[j.turningPoints.length-1].y=h.point.y}var M=CONNECTOR_MANAGER.glueCreate(J,selectedConnectionPointId);if(!K.noAddUndo&&doUndo==true){currentMoveUndo=new ConnectCommand([M.id1,M.id2],History.OBJECT_GLUE,null,M.id1,null);History.addUndo(currentMoveUndo)}else{if(doUndo==true){History.CURRENT_POINTER++}}}}else{}CONNECTOR_MANAGER.connectorAdjustByConnectionPoint(selectedConnectionPointId);state=STATE_CONNECTOR_SELECTED;selectedConnectionPointId=-1;redraw=true;break;case STATE_CONNECTOR_SELECTED:if(currentMoveUndo){var Q=CONNECTOR_MANAGER.connectorGetById(selectedConnectorId).turningPoints;var b=[Q.length];for(var L=0;L<Q.length;L++){b[L]=Q[L].clone()}currentMoveUndo.currentValue=b;History.addUndo(currentMoveUndo);state=STATE_NONE;selectedConnectorId=-1}break}currentMoveUndo=null;mousePressed=false;draw()}var lastMove=null;var snapMonitor=[0,0];function onMouseMove(v){var q=false;var r=getCanvasXY(v);var j=r[0];var h=r[1];var b=getCanvas();Log.debug("onMouseMoveCanvas: test if over a figure: "+j+","+h);switch(state){case STATE_NONE:if(stack.figureIsOver(j,h)){b.style.cursor="move";Log.debug("onMouseMove() - STATE_NONE - mouse cursor = move")}else{b.style.cursor="default";Log.debug("onMouseMove() - STATE_NONE - mouse cursor = default")}break;case STATE_SELECTING_MULTIPLE:selectionArea.points[1].x=j;selectionArea.points[2].x=j;selectionArea.points[2].y=h;selectionArea.points[3].y=h;q=true;break;
		case STATE_FIGURE_CREATE:if(createFigureFunction){
			b.style.cursor="crosshair"
		}break;
		case STATE_FIGURE_SELECTED:if(stack.figureIsOver(j,h)){
			b.style.cursor="move"
		}else{
			if(HandleManager.handleGet(j,h)!=null){b.style.cursor=HandleManager.handleGet(j,h).getCursor()
		}else{
			b.style.cursor="default"
		}
	}
	if(mousePressed==true&&lastMove!=null&&selectedFigureId!=-1&&HandleManager.handleGetSelected()==null){
		var B=stack.figureGetById(selectedFigureId);
		var m=generateMoveMatrix(B,j,h);
		B.transform(m);
		q=true
	}
	if(mousePressed==true&&lastMove!=null&&HandleManager.handleGetSelected()!=null){
		var w=HandleManager.handleGetSelected();
		w.action(lastMove,j,h);
		q=true
	}
	break;
	case STATE_GROUP_SELECTED:if(stack.figureIsOver(j,h)){
		b.style.cursor="move";
		Log.debug("onMouseMove() - STATE_GROUP_SELECTED - mouse cursor = move")
	}
	else{
		if(HandleManager.handleGet(j,h)!=null){
			b.style.cursor=HandleManager.handleGet(j,h).getCursor()
		}else{
			b.style.cursor="default";
			Log.debug("onMouseMove() - STATE_GROUP_SELECTED - mouse cursor = default")
		}
	}if(mousePressed==true&&lastMove!=null&&selectedGroupId!=-1&&HandleManager.handleGetSelected()==null){
		var s=stack.groupGetById(selectedGroupId);
		var m=generateMoveMatrix(s,j,h);
		s.transform(m);
		q=true
	}if(mousePressed==true&&lastMove!=null&&HandleManager.handleGetSelected()!=null){
		var w=HandleManager.handleGetSelected();
		w.action(lastMove,j,h);q=true
	}break;
	case STATE_CONNECTOR_PICK_FIRST:var n=CONNECTOR_MANAGER.connectionPointGetByXY(j,h,ConnectionPoint.TYPE_FIGURE);
	if(n!=-1){
		var t=CONNECTOR_MANAGER.connectionPointGetById(n);
		t.color=ConnectionPoint.OVER_COLOR;
		selectedConnectionPointId=n
	}else{
		if(selectedConnectionPointId!=-1){
			var f=CONNECTOR_MANAGER.connectionPointGetById(selectedConnectionPointId);
			f.color=ConnectionPoint.NORMAL_COLOR;selectedConnectionPointId=-1
		}
	}q=true;
	break;case STATE_CONNECTOR_PICK_SECOND:connectorPickSecond(j,h,v);
	q=true;
	break;
	case STATE_CONNECTOR_SELECTED:var l=CONNECTOR_MANAGER.connectionPointGetAllByParent(selectedConnectorId);
	var e=l[0];
	var c=l[1];
	if(e.point.near(j,h,3)||c.point.near(j,h,3)){
		b.style.cursor="move"
	}else{
		if(HandleManager.handleGet(j,h)!=null){
			b.style.cursor=HandleManager.handleGet(j,h).getCursor()
		}else{
			b.style.cursor="default"
		}
	}
	if(mousePressed==true&&lastMove!=null&&HandleManager.handleGetSelected()!=null){
		Log.info("onMouseMove() + STATE_FIGURE_SELECTED - trigger a handler action");
		var w=HandleManager.handleGetSelected();
		var a=CONNECTOR_MANAGER.connectorGetById(selectedConnectorId).turningPoints;
		var A=[a.length];for(var p=0;p<a.length;p++){
			A[p]=a[p].clone()
		}
		w.action(lastMove,j,h);
		a=CONNECTOR_MANAGER.connectorGetById(selectedConnectorId).turningPoints;
		var u=[a.length];
		for(var p=0;p<a.length;p++){
			u[p]=a[p].clone()
		}
		var z=false;
		for(var o=0;o<u.length;o++){
			if(!u[o].equals(A[o])){
				z=true
			}
		}
		if(z&&doUndo){
			currentMoveUndo=new ConnectorHandleCommand(selectedConnectorId,History.OBJECT_CONNECTOR,null,A,u);
			History.addUndo(currentMoveUndo)
		}
		q=true
	}
	break;
	case STATE_CONNECTOR_MOVE_POINT:if(mousePressed){
		var d=CONNECTOR_MANAGER.connectorGetById(selectedConnectorId);
		var l=CONNECTOR_MANAGER.connectionPointGetAllByParent(selectedConnectorId);
		var n=CONNECTOR_MANAGER.connectionPointGetByXY(j,h,ConnectionPoint.TYPE_FIGURE);
		if(n!=-1){
			b.style.cursor="default";
			if(l[0].id==selectedConnectionPointId){
				l[0].color=ConnectionPoint.OVER_COLOR
			}
			else{
				l[1].color=ConnectionPoint.OVER_COLOR
			}
		}else{
			b.style.cursor="move";
			if(l[0].id==selectedConnectionPointId){
				l[0].color=ConnectionPoint.NORMAL_COLOR
			}else{
				l[1].color=ConnectionPoint.NORMAL_COLOR
			}
		}
		if(l[0].id==selectedConnectionPointId){
			l[0].point.x=j;
			l[0].point.y=h;
			d.turningPoints[0].x=j;
			d.turningPoints[0].y=h
		}else{
			l[1].point.x=j;
			l[1].point.y=h;
			d.turningPoints[d.turningPoints.length-1].x=j;
			d.turningPoints[d.turningPoints.length-1].y=h
		}
		q=true
	}
	break
}
lastMove=[j,h];if(q){draw()}return false
	}
	
	function connectorPickFirst(i,f,h){
	var d=CONNECTOR_MANAGER.connectorCreate(new Point(i,f),new Point(i+10,f+10),connectorType);
	selectedConnectorId=d;
	var a=CONNECTOR_MANAGER.connectorGetById(d);
	if(h!=null&&!h.noAddUndo&&doUndo){
		currentMoveUndo=new CreateCommand(selectedConnectorId,History.OBJECT_CONNECTOR,connectorType,null,h);History.addUndo(currentMoveUndo)
	}
	var e=CONNECTOR_MANAGER.connectionPointGetAllByParent(d);
	var b=CONNECTOR_MANAGER.connectionPointGetByXY(i,f,ConnectionPoint.TYPE_FIGURE);
	if(b!=-1){	   
		var j=CONNECTOR_MANAGER.connectionPointGetById(b);
		$(document).ready(function(){
		    /*if(j.parentId==0)
		        j.parentId = "inicio";*/
		    
    		$.post("insertar_conector.php",{nodoinicial:j.parentId, conector:a.id},function(muchos){
    		  //alert(muchos);
        });
    });
		//------------------------------j.parentId-----------------nodo inicial-----
		e[0].point.x=j.point.x;
		e[0].point.y=j.point.y;
		a.turningPoints[0].x=j.point.x;a.turningPoints[0].y=j.point.y;
		var c=CONNECTOR_MANAGER.glueCreate(j.id,e[0].id)
	}
	state=STATE_CONNECTOR_PICK_SECOND
}

function connectorPickSecond(k,h,j){
	var c=CONNECTOR_MANAGER.connectorGetById(selectedConnectorId);
	var g=CONNECTOR_MANAGER.connectionPointGetAllByParent(c.id);
	var d=CONNECTOR_MANAGER.connectionPointGetByXY(k,h,ConnectionPoint.TYPE_FIGURE);
	if(d!=-1){
//-------
		var m=CONNECTOR_MANAGER.connectionPointGetById(d);
		
//-------------------------------------------punto final--------------------------------m.parentId-----------------------
		m.color=ConnectionPoint.OVER_COLOR;
		g[1].color=ConnectionPoint.OVER_COLOR;
		selectedConnectionPointId=d
	}
	else{
		if(selectedConnectionPointId!=-1){
			var i=CONNECTOR_MANAGER.connectionPointGetById(selectedConnectionPointId);
			i.color=ConnectionPoint.NORMAL_COLOR;
			g[1].color=ConnectionPoint.NORMAL_COLOR;
			selectedConnectionPointId=-1
		}
	}
	if(c.type==Connector.TYPE_STRAIGHT){
		g[1].point.x=k;
		g[1].point.y=h;
		c.turningPoints[1].x=k;
		c.turningPoints[1].y=h
	}
	else{
		if(c.type==Connector.TYPE_JAGGED){
			var f=c.turningPoints.length-1;
			g[1].point.x=k;
			g[1].point.y=h;
			c.turningPoints[f].x=k;
			c.turningPoints[f].y=h;
			var e=c.turningPoints[0];
			var l=c.turningPoints[f];
			var b=new Point((e.x+l.x)/2,e.y);
			var a=new Point((e.x+l.x)/2,l.y);
			c.turningPoints=[e,b,a,l]
		}
	}
}

function generateMoveMatrix(a,f,e){var j=f-lastMove[0];var h=e-lastMove[1];var d=null;if(snapTo){d=[[1,0,0],[0,1,0],[0,0,1]];snapMonitor[0]+=j;snapMonitor[1]+=h;if(j>0){var c=Math.ceil((a.getBounds()[2]+snapMonitor[0])/GRIDWIDTH)*GRIDWIDTH;if((snapMonitor[0]+a.getBounds()[2])%GRIDWIDTH>=GRIDWIDTH/2){d[0][2]=c-a.getBounds()[2];snapMonitor[0]-=c-a.getBounds()[2]}}else{if(j<0){var i=Math.floor((a.getBounds()[0]+snapMonitor[0])/GRIDWIDTH)*GRIDWIDTH;if(a.getBounds()[0]+snapMonitor[0]>=i&&a.getBounds()[0]+snapMonitor[0]<=i+GRIDWIDTH/2){d[0][2]=-(a.getBounds()[0]-i);snapMonitor[0]+=a.getBounds()[0]-i}}}if(h>0){var b=Math.ceil((a.getBounds()[3]+snapMonitor[1])/GRIDWIDTH)*GRIDWIDTH;if((a.getBounds()[3]+snapMonitor[1])%GRIDWIDTH>GRIDWIDTH/2){d[1][2]=b-a.getBounds()[3];snapMonitor[1]-=b-a.getBounds()[3]}}else{if(h<0){var g=Math.floor((a.getBounds()[1]+snapMonitor[1])/GRIDWIDTH)*GRIDWIDTH;if(a.getBounds()[1]+snapMonitor[1]>=g&&a.getBounds()[1]+snapMonitor[1]<=g+GRIDWIDTH/2){d[1][2]=-(a.getBounds()[1]-g);snapMonitor[1]+=a.getBounds()[1]-g}}}}else{d=[[1,0,j],[0,1,h],[0,0,1]]}Log.groupEnd();return d}function getCanvasBounds(){var d=$("#a").offset().left;var b=d+$("#a").width();var c=$("#a").offset().top;var a=d+$("#a").height();return[d,c,b,a]}function getBodyXY(a){return[a.pageX,a.pageY]}function getCanvasXY(d){var a=[];var e=getCanvasBounds();var c=null;var b=null;if(d.touches){if(d.touches.length>0){c=d.touches[0].pageX;b=d.touches[0].pageY}}else{c=d.pageX;b=d.pageY}if(c>=e[0]&&c<=e[2]&&b>=e[1]&&b<=e[3]){a=[c-$("#a").offset().left,b-$("#a").offset().top]}return a}function reset(){var b=getCanvas();var a=getContext();a.beginPath();a.clearRect(0,0,b.width,b.height);a.closePath();a.stroke()}function draw(){var a=getContext();reset();stack.paint(a);minimap.updateMinimap()}function action(e){redraw=false;switch(e){case"undo":Log.info("main.js->action()->Undo. Nr of actions in the stack: "+History.COMMANDS.length);History.undo();redraw=true;break;case"redo":Log.info("main.js->action()->Redo. Nr of actions in the stack: "+History.COMMANDS.length);History.redo();redraw=true;break;case"group":if(selectedGroupId!=-1){var i=stack.groupGetById(selectedGroupId);i.permanent=true;if(doUndo){History.addUndo(new GroupCommand(selectedGroupId,History.OBJECT_GROUP,true,false,stack.figureGetIdsByGroupId(selectedGroupId)))}}redraw=true;break;case"ungroup":if(selectedGroupId!=-1){if(doUndo){History.addUndo(new GroupCommand(selectedGroupId,History.OBJECT_GROUP,true,stack.figureGetIdsByGroupId(selectedGroupId),false))}stack.groupDestroy(selectedGroupId);selectedGroupId=-1;state=STATE_NONE;redraw=true
	}
	break;
	case"connector-jagged":selectedFigureId=-1;
	state=STATE_CONNECTOR_PICK_FIRST;
	connectorType=Connector.TYPE_JAGGED;
	redraw=true;
	break;
	case"connector-straight":selectedFigureId=-1;state=STATE_CONNECTOR_PICK_FIRST;connectorType=Connector.TYPE_STRAIGHT;
	redraw=true;break;
	case"rotate90":case"rotate90A":
	if(selectedFigureId){
		var h=stack.figureGetById(selectedFigureId);
	var b=h.getBounds();
	var k=b[0]+(b[2]-b[0])/2;
	var j=b[1]+(b[3]-b[1])/2;
	var g=[[1,0,k*-1],[0,1,j*-1],[0,0,1]];
	var f=[[1,0,k],[0,1,j],[0,0,1]];
	h.transform(g);
	if(e=="rotate90"){h.transform(R90)}
	else{h.transform(R90A)}
	h.transform(f);
	redraw=true
	}
	break;
	case"up":if(selectedFigureId!=-1){
		var h=stack.figureGetById(selectedFigureId);
	g=[[1,0,0],[0,1,-1],[0,0,1]];h.transform(g);
	redraw=true}break;case"down":
	if(selectedFigureId!=-1){
		var h=stack.figureGetById(selectedFigureId);
	g=[[1,0,0],[0,1,1],[0,0,1]];
	h.transform(g);redraw=true
	}
	break;case"right":
	if(selectedFigureId!=-1){
		var h=stack.figureGetById(selectedFigureId);g=[[1,0,1],[0,1,0],[0,0,1]];
	h.transform(g);
	redraw=true}break;case"left":
	if(selectedFigureId!=-1){
		var h=stack.figureGetById(selectedFigureId);
	var g=[[1,0,-1],[0,1,0],[0,0,1]];
	h.transform(g);
	redraw=true
	}
	break;case"grow":
	if(selectedFigureId!=-1){
		var h=stack.figureGetById(selectedFigureId);
	var b=h.getBounds();
	var k=b[0]+(b[2]-b[0])/2;
	var j=b[1]+(b[3]-b[1])/2;
	var g=[[1,0,k*-1],[0,1,j*-1],[0,0,1]];
	var f=[[1,0,k],[0,1,j],[0,0,1]];
	var a=[[1+0.2,0,0],[0,1+0.2,0],[0,0,1]];
	h.transform(g);
	h.transform(a);
	h.transform(f);
	redraw=true
	}
	break;case"shrink":
	if(selectedFigureId!=-1){
		var h=stack.figureGetById(selectedFigureId);
	var b=h.getBounds();
	var k=b[0]+(b[2]-b[0])/2;
	var j=b[1]+(b[3]-b[1])/2;
	var g=[[1,0,k*-1],[0,1,j*-1],[0,0,1]];
	var f=[[1,0,k],[0,1,j],[0,0,1]];
	var d=[[1-0.2,0,0],[0,1-0.2,0],[0,0,1]];
	h.transform(g);
	h.transform(d);
	h.transform(f);
	redraw=true
	}
	break;
	case"duplicate":
		if(selectedFigureId!=-1){
			var c=stack.figureGetById(selectedFigureId).clone();
	c.transform(Matrix.translationMatrix(10,10));
	stack.figureAdd(c);
	stack.figureSelect(stack.figures.length-1);
	c=null;
	getCanvas().style.cursor="default";
	redraw=true
	}
	break;
	case"back":if(selectedFigureId!=-1){
		History.addUndo(new ZOrderCommand(selectedFigureId,History.OBJECT_FIGURE,null,stack.idToIndex[selectedFigureId],0));
	stack.setPosition(selectedFigureId,0);
	redraw=true
	}
		break;case"front":
	if(selectedFigureId!=-1){
		History.addUndo(new ZOrderCommand(selectedFigureId,History.OBJECT_FIGURE,null,stack.idToIndex[selectedFigureId],stack.figures.length-1));
	stack.setPosition(selectedFigureId,stack.figures.length-1);
	redraw=true}break;case"moveback":
	if(selectedFigureId!=-1){
		History.addUndo(new ZOrderCommand(selectedFigureId,History.OBJECT_FIGURE,null,stack.idToIndex[selectedFigureId],stack.idToIndex[selectedFigureId]-1));
	stack.swapToPosition(selectedFigureId,stack.idToIndex[selectedFigureId]-1);
	redraw=true}
	break;case"moveforward":if(selectedFigureId!=-1){
		History.addUndo(new ZOrderCommand(selectedFigureId,History.OBJECT_FIGURE,null,stack.idToIndex[selectedFigureId],stack.idToIndex[selectedFigureId]+1));
	stack.swapToPosition(selectedFigureId,stack.idToIndex[selectedFigureId]+1);
	redraw=true
	}
	break
	}
		if(redraw){draw()
}
}
var lastMousePosition=null;
		function touchStart(a){
			a.preventDefault();
			onMouseDown(a)
		}
		function touchMove(a){a.preventDefault();
			onMouseMove(a)
		}
		function touchEnd(a){
			onMouseUp(a)
		}
		function touchCancel(a){};
function Builder(){}
Builder.load=function(b){
	var a=new Builder();
	a.properties=BuilderProperty.loadArray(b.properties);
	a.figureId=b.figureId;
	return a
};

Builder.contructPropertiesPanel=function(c,a){
	for(var b=0;b<a.properties.length;b++){
		a.properties[b].injectInputArea(c,a.id)
	}
};

Builder.constructCanvasPropertiesPanel=function(e,g){
	var a=document.createElement("div");
	var c=document.createElement("div");
	c.innerHTML='<div class = "label">Width</div>';
	var f=document.createElement("input");
	f.type="text";
	f.className="text";
	f.value=g.getWidth();
	c.appendChild(f);
	a.appendChild(c);
	var d=document.createElement("div");
	d.innerHTML='<div class = "label">Height</div>';
	var b=document.createElement("input");
	b.type="text";
	b.className="text";
	b.value=g.getHeight();
	d.appendChild(b);
	a.appendChild(d);
	var j=document.createElement("div");
	j.innerHTML='<div class = "label"></div>';
	var h=document.createElement("input");
	h.setAttribute("type","button");
	h.setAttribute("value","Update");
	h.onclick=function(){
		Log.group("builder.js->constructCanvasPropertiesPanel()->Canvas update");
		if(doUndo&&g.getWidth()!=f.value){
			var k=new CanvasResizeCommand(g,History.OBJECT_STATIC,"Width",g.getWidth(),f.value);
			g.width=f.value;
			History.addUndo(k)
		}
		if(doUndo&&g.getHeight()!=b.value){
			var k=new CanvasResizeCommand(g,History.OBJECT_STATIC,"Height",g.getHeight(),b.value);
			g.height=b.value;History.addUndo(k)
		}Log.groupEnd();
		g.setWidth(f.value);
		g.setHeight(b.value);
		draw()
	};
	j.appendChild(h);
	a.appendChild(j);
	e.appendChild(a)
};
function BuilderProperty(a,c,b){
	this.name=a;
	this.property=c;
	this.type=b
}
BuilderProperty.TYPE_COLOR="Color";
BuilderProperty.TYPE_TEXT="Text";
BuilderProperty.TYPE_SINGLE_TEXT="SingleText";
BuilderProperty.TYPE_TEXT_FONT_SIZE="TextFontSize";
BuilderProperty.TYPE_TEXT_FONT_FAMILY="TextFontFamily";
BuilderProperty.TYPE_TEXT_FONT_ALIGNMENT="TextFontAlignment";
BuilderProperty.TYPE_BOOLEAN="Boolean";
BuilderProperty.TYPE_LINE_WIDTH="LineWidth";
BuilderProperty.TYPE_CONNECTOR_END="ConnectorEnd";
BuilderProperty.LINE_WIDTHS=[{Text:"1px",Value:"1"},{Text:"2px",Value:"2"},{Text:"3px",Value:"3"},{Text:"4px",Value:"4"},
{Text:"5px",Value:"5"},{Text:"6px",Value:"6"},{Text:"7px",Value:"7"},{Text:"8px",Value:"8"},{Text:"9px",Value:"9"},
{Text:"10px",Value:"10"}];
BuilderProperty.FONT_SIZES=[];
for(var i=0;i<73;i++){BuilderProperty.FONT_SIZES.push({Text:i+"px",Value:i})}
BuilderProperty.CONNECTOR_ENDS=[{Text:"Normal",Value:"Normal"},{Text:"Arrow",Value:"Arrow"},
{Text:"Empty Triangle",Value:"Empty"},{Text:"Filled Triangle",Value:"Filled"}];
BuilderProperty.SEPARATOR="SEPARATOR";
BuilderProperty.load=function(a){
	var b=new BuilderProperty();
	b.name=a.name;
	b.property=a.property;
	b.type=a.type;
	return b
};
BuilderProperty.loadArray=function(a){
	var c=[];
	for(var b=0;b<a.length;b++){
		c.push(BuilderProperty.load(a[b]))
	}
	return c
};
	BuilderProperty.prototype={
	toString:function(){
		return"Propery type: "+this.type+" name: "+this.name+" property: "+this.property
	},
	equals:function(a){
		return this.type==a.type&&this.name==a.name&&this.property==a.property
	},
	injectInputArea:function(b,a){
		if(this.name==BuilderProperty.SEPARATOR){
			b.appendChild(document.createElement("hr"));return
		}
		else{
			if(this.type==BuilderProperty.TYPE_COLOR){
				this.generateColorCode(b,a)
			}
			else{
//---------------------------------Linea la cual genera texto----------------------------------------------------
				if(this.type==BuilderProperty.TYPE_TEXT){
					this.generateTextCode(b,a)
				}
				else{
					if(this.type==BuilderProperty.TYPE_SINGLE_TEXT){
						this.generateSingleTextCode(b,a)
					}
					else{
						if(this.type==BuilderProperty.TYPE_TEXT_FONT_SIZE){
							this.generateArrayCode(b,a,BuilderProperty.FONT_SIZES)
						}
						else{
							if(this.type==BuilderProperty.TYPE_TEXT_FONT_FAMILY){
								this.generateArrayCode(b,a,Text.FONTS)
							}
							else{
								if(this.type==BuilderProperty.TYPE_TEXT_FONT_ALIGNMENT){
									this.generateArrayCode(b,a,Text.ALIGNMENTS)
								}
								else{
									if(this.type==BuilderProperty.TYPE_CONNECTOR_END){
										this.generateArrayCode(b,a,BuilderProperty.CONNECTOR_ENDS)
									}
									else{
										if(this.type==BuilderProperty.TYPE_LINE_WIDTH){
											this.generateArrayCode(b,a,BuilderProperty.LINE_WIDTHS)
										}
									}
								}
							}
						}
					}
				}
			}
		}
	},generateBooleanCode:function(h,b){
		var e=new Date();
		var g=e.getTime();
		var c=this.getValue(b);
		var f=document.createElement("div");
		f.innerHTML='<div id="customWiget'+g+'" style="clear: both;" class="editorLabel" >'+this.name+":</div>";
		var a=document.createElement("input");
		a.type="checkbox";
		a.className="text";
		a.style.cssText="float: right";
		a.checked=c;
		f.children[0].appendChild(a);
		a.onclick=function(d,j){
			return function(){
				updateFigure(d,j,this.checked)
			}
		}
		(b,this.property);
		h.appendChild(f)
	},
	/*
<Clase>
<Nombre>generateTextCode
<Parametros>f, a -> Es el id de la figura que se esta seleccionando en este momento.
<Responsabilidades>En esta funcion es donde se modifica el texto de la figura, y se trae por medio de jquery el formulario de otro archivo. Para 
Insertarlos o modificarlos. 
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>

*/
		generateTextCode:function(f,a){
		
		
			var e=new Date().getTime();
			var b=this.getValue(a);
			var d=document.createElement("div");
			var h=document.createElement("div");
			
			d.className="textLine";
			h.className="textLine";
			
			//En esta funcion le envio el id de la figura seleccionada al archivo que me muestra el formulario en la parte derecha.
			//Ya este archivo con el id de la figura y el id del diagrama el cual lo llama desde sesiones, ya se puede actualizar datos, listarlos o
			//insertarlos
			$(document).ready(function(){
			$.post("funcion.php",{figura : a,no_popup : "si"},function(data){
					formulario = data;
					//aqui se trae todos los datos a la variable formulario y se mete dentro de una capa.
					d.innerHTML='<div class = "label">'+formulario+'</div>';
				});
			});
			//setTimeout("uno()",1000);
			//alert(a);
			//Esto es lo que va de primero en el formulario de la derecha Texto de la figura, obviamente se puede modificar.
			h.innerHTML='<div class = "label">Texto de la figura</div>';
			
			
			var c=document.createElement("textarea");
			//c.style.visibility='hidden';
			
			c.className="text";
			c.value=b;
			c.style.width="100%";
			c.style.height="50px";
			d.appendChild(document.createElement("br"));
			c.appendChild(document.createElement("br"));
			h.appendChild(c);
			$(document).ready(function(){
			$.post("funcion3.php",{figura : a,nombre_paso : c.value},function(data){
					formulario = data;
					//alert(formulario);
					//aqui se trae todos los datos a la variable formulario y se mete dentro de una capa.
					//d.innerHTML='<div class = "label">'+formulario+'</div>';
				});
			});
			 
				//$("<a href='funcion.php?figura="+a+"' id='fancyx'>Ver mas...</a>").appendTo(h);
				
			c.onchange=function(g,h){
				return function(){
					updateFigure(g,h,this.value)
				}
			}
			(a,this.property);
			c.onmouseout=c.onchange;
			c.onkeyup=c.onchange;
//----------------------------------------------			
			c.onkeyup=function(){
			   $(document).ready(function(){
			$.post("funcion3.php",{figura : a,nombre_paso : c.value},function(data){
					formulario = data;
					//alert(formulario);
					//aqui se trae todos los datos a la variable formulario y se mete dentro de una capa.
					//d.innerHTML='<div class = "label">'+formulario+'</div>';
				});
			});
      };
//----------------------------------------------      
			f.appendChild(h);
			f.appendChild(d)
			
			
		},
		generateSingleTextCode:function(f,a){
			var e=new Date().getTime();
			var b=this.getValue(a);
			var d=document.createElement("div");
			d.className="line";
			d.innerHTML='<div class = "label">'+this.name+"</div>";
			var c=document.createElement("input");
			c.type="text";
			c.className="text";
			c.style.cssText="float: right";
			c.value=b;
			d.appendChild(c);
			c.onchange=function(g,h){
				return function(){
					updateFigure(g,h,this.value)
				}
			}
			(a,this.property);c.onmouseout=c.onchange;c.onkeyup=c.onchange;f.appendChild(d)
		},
			
			generateArrayCode:function(b,e,k){
				var f=new Date().getTime();
				var j=this.getValue(e);
				var a=document.createElement("div");
				a.className="line";
				a.innerHTML='<div class="label">'+this.name+"</div>";
				var g=document.createElement("select");
				g.style.cssText="float: right;";
				a.appendChild(g);
				for(var c=0;c<k.length;c++){
					var d=document.createElement("option");
					d.value=k[c].Value;
					d.text=k[c].Text;
					g.options.add(d);
					if(d.value==j){
						d.selected=true;
					}
				}
				var h=this.property;
				
				updateFigure(e,"endStyle","Arrow");
				
				g.onchange=function(){
					updateFigure(e,h,this.options[this.selectedIndex].value)
				};
					b.appendChild(a)
			},generateColorCode:function(g,b){
				var c=this.getValue(b);
				var f=new Date().getTime();
				var e=document.createElement("div");
				e.className="line";var d='<div class="label">'+this.name+"</div>\n";d+='<div id="colorSelector'+f+'" style="/*border: 1px solid #000000;*/ width: 16px; height: 16px; display: block; float: right; padding-right: 3px;">\n';d+='<input type="text" value="'+c+'" id="colorpickerHolder'+f+'">\n';d+="</div>\n";e.innerHTML=d;g.appendChild(e);$("#colorpickerHolder"+f).colorPicker();var a=this.property;$("#colorpickerHolder"+f).change(function(){Log.info("generateColorCode(): figureId: "+b+"type: "+this.type+" name: "+this.name+" property: "+this.property);updateFigure(b,a,$("#colorpickerHolder"+f).val())})},
				getValue:function(b){
					var e=stack.figureGetById(b);
					if(e==null){
						e=CONNECTOR_MANAGER.connectorGetById(b)
					}
					if(e==null){
						if(b=="canvas"){
							e=canvas
						}
					}
					var c=this.property.split(".");
					for(var a=0;a<c.length-1;a++){
						e=e[c[a]]
					}
					if(e[c[c.length-1]]===undefined){
						var d="get"+c[c.length-1];
						if(d in e){
							return e["get"+c[c.length-1]]()
						}
						else{
							return null
						}
					}
					else{
						return e[c[c.length-1]]
					}
				}
			};
		function uno()
		{
			alert('Buenas');
		}
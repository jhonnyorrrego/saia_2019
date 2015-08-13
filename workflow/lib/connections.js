function Connector(c,a,b,d){
	
	this.id=d;
	this.turningPoints=[c,a];
	this.type=b;
	this.style=new Style();
	this.style.strokeStyle="#000000";
	
	this.middleText=new Text("",(c.x+a.x)/2-2,(c.y+a.y)/2+2,"Arial",10);

	this.middleText.style.strokeStyle="#000000";
	this.middleText.bgStyle="#ffffff";
	this.properties=[];
	this.properties.push(new BuilderProperty("Start Style","startStyle",BuilderProperty.TYPE_CONNECTOR_END));
	this.properties.push(new BuilderProperty("End Style","endStyle",BuilderProperty.TYPE_CONNECTOR_END));
	this.properties.push(new BuilderProperty("Line Width","style.lineWidth",BuilderProperty.TYPE_LINE_WIDTH));
	this.properties.push(new BuilderProperty("Color","style.strokeStyle",BuilderProperty.TYPE_COLOR));
	this.properties.push(new BuilderProperty("Text","middleText.str",BuilderProperty.TYPE_TEXT));
	this.endStyle=Connector.STYLE_NORMAL;
	this.startStyle=Connector.STYLE_NORMAL;
	this.activeConnectionPointId=-1;
	this.visualDebug=false;
	this.oType="Connector"
}
Connector.TYPE_STRAIGHT="straight";
Connector.TYPE_JAGGED="jagged";
Connector.STYLE_NORMAL="Normal";
Connector.STYLE_ARROW="Arrow";
Connector.STYLE_EMPTY_TRIANGLE="Empty";
Connector.STYLE_FILLED_TRIANGLE="Filled";
Connector.ARROW_SIZE=15;
Connector.ARROW_ANGLE=30;

Connector.load=function(b){
	var a=new Connector(new Point(0,0),new Point(0,0),Connector.TYPE_STRAIGHT,0);
	a.id=b.id;
	a.turningPoints=Point.loadArray(b.turningPoints);
	a.type=b.type;a.style=Style.load(b.style);
	a.middleText=Text.load(b.middleText);
	a.properties=BuilderProperty.loadArray(b.properties);
	a.endStyle=b.endStyle;a.startStyle=b.startStyle;
	a.activeConnectionPointId=b.activeConnectionPointId;
	return a
};
Connector.loadArray=function(a){
	var c=[];
	for(var b=0;b<a.length;b++){	
		c.push(Connector.load(a[b]))
	}
	return c
};
Connector.prototype={
	equals:function(b){
		if(!b instanceof Connector){
			return false
		}
		for(var a=0;a<this.turningPoints.length;a++){
			if(!this.turningPoints[a].equals(b.turningPoints[a])){
				return false
			}
		}
		for(var a=0;a<this.properties.length;a++){
			if(!this.properties[a].equals(b.properties[a])){
				return false
			}
		}
		if(this.id!=b.id||this.type!=b.type||!this.middleText.equals(b.middleText)||this.startStyle!=b.startStyle||this.endStyle!=b.endStyle||this.activeConnectionPointId!=b.activeConnectionPointId){
			return false
		}
		return true
	},
	getArrow:function(a,f){
		var d=new Point(a,f);
		var c=new Line(d.clone(),Util.getEndPoint(d,Connector.ARROW_SIZE,Math.PI/180*Connector.ARROW_ANGLE));
		var b=new Line(d.clone(),Util.getEndPoint(d,Connector.ARROW_SIZE,Math.PI/180*-Connector.ARROW_ANGLE));
		var e=new Path();
		e.style=this.style;
		c.style=this.style;
		b.style=this.style;
		e.addPrimitive(c);
		e.addPrimitive(b);
		return e},getTriangle:function(a,g,e){
			var d=new Point(a,g);var c=Util.getEndPoint(d,Connector.ARROW_SIZE,Math.PI/180*Connector.ARROW_ANGLE);
			var b=Util.getEndPoint(d,Connector.ARROW_SIZE,-Math.PI/180*Connector.ARROW_ANGLE);
			var f=new Polygon();
			f.addPoint(d);
			f.addPoint(c);
			f.addPoint(b);
			f.style=this.style.clone();
			if(e){
				f.style.fillStyle=this.style.strokeStyle
			}
			else{
				f.style.fillStyle="#FFFFFF"
			}
			return f
		},paint:function(a){
			this.style.setupContext(a);
			a.beginPath();
			var h=0;
			var g=0;
			a.moveTo(this.turningPoints[0].x,this.turningPoints[0].y);
			for(var e=1;e<this.turningPoints.length;e++){
				if(this.startStyle==Connector.STYLE_EMPTY_TRIANGLE&&e==1){
					var c=Util.getAngle(this.turningPoints[0],this.turningPoints[1]);
					var b=Util.getEndPoint(this.turningPoints[0],Connector.ARROW_SIZE*Math.cos(Math.PI/180*Connector.ARROW_ANGLE),c);
					a.moveTo(b.x,b.y)
				}
				if(this.endStyle==Connector.STYLE_EMPTY_TRIANGLE&&e==this.turningPoints.length-1){
					var c=Util.getAngle(this.turningPoints[e-1],this.turningPoints[e]);var b=Util.getEndPoint(this.turningPoints[e],-Connector.ARROW_SIZE*Math.cos(Math.PI/180*Connector.ARROW_ANGLE),c);a.lineTo(b.x,b.y)}else{a.lineTo(this.turningPoints[e].x,this.turningPoints[e].y)}}a.stroke();if(this.visualDebug){a.beginPath();for(var e=0;e<this.turningPoints.length;e++){a.moveTo(this.turningPoints[e].x,this.turningPoints[e].y);a.arc(this.turningPoints[e].x,this.turningPoints[e].y,3,0,Math.PI*2,false)}a.stroke()}var m=null;if(this.startStyle==Connector.STYLE_ARROW){m=this.getArrow(this.turningPoints[0].x,this.turningPoints[0].y)}if(this.startStyle==Connector.STYLE_EMPTY_TRIANGLE){m=this.getTriangle(this.turningPoints[0].x,this.turningPoints[0].y,false)}if(this.startStyle==Connector.STYLE_FILLED_TRIANGLE){m=this.getTriangle(this.turningPoints[0].x,this.turningPoints[0].y,true)}if(m){var f=this.turningPoints[0].x;var d=this.turningPoints[0].y;var j=Util.getAngle(this.turningPoints[0],this.turningPoints[1],0);m.transform(Matrix.translationMatrix(-f,-d));m.transform(Matrix.rotationMatrix(j));m.transform(Matrix.translationMatrix(f,d));a.save();a.lineJoin="round";a.lineCap="round";m.paint(a);a.restore()}m=null;var m=null;if(this.endStyle==Connector.STYLE_ARROW){m=this.getArrow(this.turningPoints[this.turningPoints.length-1].x,this.turningPoints[this.turningPoints.length-1].y)}if(this.endStyle==Connector.STYLE_EMPTY_TRIANGLE){m=this.getTriangle(this.turningPoints[this.turningPoints.length-1].x,this.turningPoints[this.turningPoints.length-1].y,false)}if(this.endStyle==Connector.STYLE_FILLED_TRIANGLE){m=this.getTriangle(this.turningPoints[this.turningPoints.length-1].x,this.turningPoints[this.turningPoints.length-1].y,true)}if(m){var f=this.turningPoints[this.turningPoints.length-1].x;var d=this.turningPoints[this.turningPoints.length-1].y;var j=Util.getAngle(this.turningPoints[this.turningPoints.length-1],this.turningPoints[this.turningPoints.length-2],0);m.transform(Matrix.translationMatrix(-f,-d));m.transform(Matrix.rotationMatrix(j));m.transform(Matrix.translationMatrix(f,d));a.save();a.lineJoin="round";a.lineCap="round";m.paint(a);a.restore()}
					
					if(this.middleText.str!=""){
						var l=a.fillStyle;
						a.beginPath();
						var k=this.middleText.getBounds();
						a.moveTo(k[0],k[1]);
						a.lineTo(k[0],k[3]);
						a.lineTo(k[2],k[3]);
						a.lineTo(k[2],k[1]);
						a.fillStyle="white";
						a.closePath();
						a.fill();
						a.fillStyle=l;
						this.middleText.paint(a)
					}
				},transform:function(b){if(this.activeConnectionPointId!=-1){var a=CONNETOR_MANAGER.connectionPointGet(this.activeConnectionPointId);a.transform(b)}else{for(var c=0;c<this.turningPoints.length;c++){
		this.turningPoints[c].transform(b)
	}}},
		jagged:function(){
			this.jaggedReloaded();
			return;
			var g=this.turningPoints.pop();
			var l=this.turningPoints[0];
			var o=CONNECTOR_MANAGER.connectionPointGetAllByParent(this.id)[0];
			var s=CONNECTOR_MANAGER.glueGetByConnectionPointId(o.id)[0];
			var a=CONNECTOR_MANAGER.connectionPointGet(s.id1==o.id?s.id2:s.id1).parentId;
			var x=stack.figureGetById(a);
			var j;
			if(x){
				j=x.rotationCoords[0]
			}
			else{
				j=l
			}
			var k=CONNECTOR_MANAGER.connectionPointGetAllByParent(this.id)[1];
			s=CONNECTOR_MANAGER.glueGetByConnectionPointId(k.id)[0];
			var h=CONNECTOR_MANAGER.connectionPointGet(s.id1==k.id?s.id2:s.id1).parentId;
			h=stack.figureGetById(h);
			var v;
			if(h){
				v=h.rotationCoords[0]
			}
			else{
				v=g
			}
			var y=false;
			if(v.x<j.x){
				var f=v;v=j;j=f;f=h;h=x;x=f;f=g;g=l;l=f;y=true
			}
			var u=[g];
			this.turningPoints=[l];
			var w;
			var q=Util.getAngle(j,l,Math.PI/2);
			var n=Util.getAngle(v,g,Math.PI/2);
			if(n==0){
				w=new Point(g.x,h.getBounds()[1]-20)
			}
			else{
				if(n==Math.PI/2){
					w=new Point(h.getBounds()[2]+20,g.y)
				}
				else{
					if(n==Math.PI){
						w=new Point(g.x,h.getBounds()[3]+20)
					}
					else{
						w=new Point(h.getBounds()[0]-20,g.y)
					}
				}
			}
			u.push(w);
			g=w;
			var m=l;
			if(q==0){
				w=new Point(l.x,x.getBounds()[1]-20)
			}
			else{
				if(q==Math.PI/2){
					w=new Point(x.getBounds()[2]+20,l.y)
				}
				else{
					if(q==Math.PI){
						w=new Point(l.x,x.getBounds()[3]+20)
					}
					else{
						w=new Point(x.getBounds()[0]-20,l.y)
					}
				}
			}
			this.turningPoints.push(w);
			l=w;
			var d=l;
			w=null;
			var p=[0,Math.PI/2,Math.PI,Math.PI/2*3,Math.PI*2];
			var c=0;
			var e=Util.lineIntersectsRectangle(l,g,h.getBounds());
			var b=Util.lineIntersectsRectangle(l,g,x.getBounds());
			while(e||b){
				q=Util.getAngle(l,this.turningPoints[this.turningPoints.length-2],Math.PI/2);
				n=Util.getAngle(g,u[u.length-2],Math.PI/2);
				switch(c){
					case 0:if(q==0||q==Math.PI){
						if(l.x<g.x){
							l=new Point(x.getBounds()[2]+20,l.y)
						}
						else{
							l=new Point(x.getBounds()[0]-20,l.y)
						}
					}
					else{
						if(l.y<g.y||g.y>x.getBounds()[1]){
							l=new Point(l.x,x.getBounds()[3]+20)
						}
						else{
							l=new Point(l.x,x.getBounds()[1]-20)
						}
					}
					this.turningPoints.push(l);
					break;
					case 1:u.push(g);
					if(n==0||n==Math.PI){
						if(l.x>g.x){
							g=new Point(h.getBounds()[2]+20,g.y)
						}
						else{
							g=new Point(h.getBounds()[0]-20,g.y)
						}
					}
					else{
						if(l.y>g.y){
							g=new Point(g.x,h.getBounds()[3]+20)
						}
						else{
							g=new Point(g.x,h.getBounds()[1]-20)
						}
					}
					break
				}
				c++;e=Util.lineIntersectsRectangle(l,g,h.getBounds());
				b=Util.lineIntersectsRectangle(l,g,x.getBounds());
				if(c==3){break}
			}
			if(!Util.lineIntersectsRectangle(new Point(l.x,g.y),new Point(g.x,g.y),h.getBounds())&&!Util.lineIntersectsRectangle(new Point(l.x,g.y),new Point(g.x,g.y),x.getBounds())&&!Util.lineIntersectsRectangle(new Point(l.x,l.y),new Point(l.x,g.y),h.getBounds())&&!Util.lineIntersectsRectangle(new Point(l.x,l.y),new Point(l.x,g.y),x.getBounds())){
				this.turningPoints.push(new Point(l.x,g.y))
			}else{
				this.turningPoints.push(new Point(g.x,l.y))
			}
			this.turningPoints.push(new Point(g.x,g.y));
			for(var r=0;r<u.length;r++){
				this.turningPoints.push(u.pop());r--
			}
			if(y){
				this.turningPoints=this.turningPoints.reverse()
			}
		},jaggedReloaded:function(){
				var a=this.turningPoints[0];
				var f=null;
				var d=null;
				var k=this.turningPoints[this.turningPoints.length-1];
				var m=CONNECTOR_MANAGER.connectionPointGetAllByParent(this.id)[0];
				var e=CONNECTOR_MANAGER.glueGetByConnectionPointId(m.id)[0];
				if(e!=null){var g=CONNECTOR_MANAGER.connectionPointGet(e.id1==m.id?e.id2:e.id1);var j=stack.figureGetById(g.parentId);var i=Util.getAngle(j.rotationCoords[0],a,Math.PI/2);switch(i){case 0:f=new Point(a.x,j.getBounds()[1]-20);break;case Math.PI/2:f=new Point(j.getBounds()[2]+20,a.y);break;case Math.PI:f=new Point(a.x,j.getBounds()[3]+20);break;case 3*Math.PI/2:f=new Point(j.getBounds()[0]-20,a.y);break}}var c=CONNECTOR_MANAGER.connectionPointGetAllByParent(this.id)[1];e=CONNECTOR_MANAGER.glueGetByConnectionPointId(c.id)[0];if(e!=null){var h=CONNECTOR_MANAGER.connectionPointGet(e.id1==c.id?e.id2:e.id1);var l=stack.figureGetById(h.parentId);var b=Util.getAngle(l.rotationCoords[0],k,Math.PI/2);switch(i){case 0:d=new Point(k.x,l.getBounds()[1]-20);break;case Math.PI/2:d=new Point(l.getBounds()[2]+20,k.y);break;case Math.PI:d=new Point(k.x,l.getBounds()[3]+20);break;case 3*Math.PI/2:d=new Point(l.getBounds()[0]-20,k.y);break}}alert("jaggedReloaded:Connector has "+this.turningPoints.length+" points");this.turningPoints.splice(1,0,f,d);alert("jaggedReloaded:Connector has "+this.turningPoints.length+" points")},connect2Points:function(c,b){var a=[];
				if(c.equals(b)){}return a},redraw:function(){
					if(this.type=="jagged"){
						var b=true;
						while(b==true){
							b=false;
							for(var a=1;a<this.turningPoints.length-2;a++){
								if(this.turningPoints[a].x==this.turningPoints[a-1].x&&this.turningPoints[a-1].x==this.turningPoints[a+1].x){
									this.turningPoints.splice(a,1);b=true
								}
								if(this.turningPoints[a].y==this.turningPoints[a-1].y&&this.turningPoints[a-1].y==this.turningPoints[a+1].y){
									this.turningPoints.splice(a,1);b=true
								}
							}
						}
					}
				},adjust:function(f,g){
					if(this.type==Connector.TYPE_STRAIGHT){
						var k=CONNECTOR_MANAGER.connectionPointGetByParentAndCoordinates(this.id,g.x,g.y);
						var d=-1;if(this.turningPoints[0].equals(g)){d=0}else{if(this.turningPoints[1].equals(g)){d=1}else{Log.error("Connector:adjust() - This should not happend"+this.toString()+" point is "+g)}}k.transform(f);this.turningPoints[d].x=k.point.x;this.turningPoints[d].y=k.point.y}
						
						if(this.type==Connector.TYPE_JAGGED){
							var j=g.x;
							var h=g.y;
							var k=CONNECTOR_MANAGER.connectionPointGetByParentAndCoordinates(this.id,g.x,g.y);
							k.transform(f);
							var a,b,e;
							if(g.equals(this.turningPoints[0])){
								this.turningPoints[0].x=k.point.x;
								this.turningPoints[0].y=k.point.y;
								a=1;b=this.turningPoints.length;e=1
							}
							else{
								if(g.equals(this.turningPoints[this.turningPoints.length-1])){
									this.turningPoints[this.turningPoints.length-1].x=k.point.x;
									this.turningPoints[this.turningPoints.length-1].y=k.point.y;
									a=this.turningPoints.length-2;b=-1;e=-1
								}
								else{
									Log.error("Connector:adjust() - this should never happen for point "+g+" and connector "+this.toString())
								}
							}
							for(var c=a;c!=b;c+=e){
								if(this.turningPoints[c].y!=h&&this.turningPoints[c].x==j&&this.turningPoints[c]!=CONNECTOR_MANAGER.connectionPointGetAllByParent(this.id)[0].point&&this.turningPoints[c]!=CONNECTOR_MANAGER.connectionPointGetAllByParent(this.id)[1].point){
									j=this.turningPoints[c].x;
									h=this.turningPoints[c].y;
									this.turningPoints[c].x=this.turningPoints[c-e].x
								}
								else{
									if(this.turningPoints[c].x!=j&&this.turningPoints[c].y==h&&this.turningPoints[c]!=CONNECTOR_MANAGER.connectionPointGetAllByParent(this.id)[0].point&&this.turningPoints[c]!=CONNECTOR_MANAGER.connectionPointGetAllByParent(this.id)[1].point){
										j=this.turningPoints[c].x;
										h=this.turningPoints[c].y;
										this.turningPoints[c].y=this.turningPoints[c-e].y
									}
								}
							}
						}
					},contains:function(a,d){for(var c=0;c<this.turningPoints.length-1;c++){var b=new Line(this.turningPoints[c],this.turningPoints[c+1]);if(b.near(a,d,3)){return true}}return this.turningPoints[this.turningPoints.length-1].near(a,d,3)||this.turningPoints[0].near(a,d,3)},near:function(b,e,a){for(var d=0;d<this.turningPoints.length-1;d++){var c=new Line(this.turningPoints[d],this.turningPoints[d+1]);if(c.near(b,e,a)){return true}}return this.turningPoints[this.turningPoints.length-1].near(b,e,3)||this.turningPoints[0].near(b,e,3)},middle:function(){if(this.type==Connector.TYPE_STRAIGHT){var h=(this.turningPoints[0].x+this.turningPoints[1].x)/2;var f=(this.turningPoints[0].y+this.turningPoints[1].y)/2;return[h,f]}else{
						if(this.type==Connector.TYPE_JAGGED){
							var g=0;
							for(var b=0;b<this.turningPoints.length-1;b++){
								g+=Util.getLength(this.turningPoints[b],this.turningPoints[b+1])
							}var a=-1;
							var e=0;
							for(var b=0;b<this.turningPoints.length-1;b++){
								a=b;
								var c=Util.getLength(this.turningPoints[b],this.turningPoints[b+1]);
								if(e+c<g/2){
									e+=c
								}
								else{
									break
								}
							}
							if(a!=-1){
								var d=g/2-e;
								if(Util.round(this.turningPoints[a].x,3)==Util.round(this.turningPoints[a+1].x,3)){
									return[this.turningPoints[a].x,Math.min(this.turningPoints[a].y,this.turningPoints[a+1].y)+d]
								}
								else{
									if(Util.round(this.turningPoints[a].y,3)==Util.round(this.turningPoints[a+1].y,3)){
										return[Math.min(this.turningPoints[a].x,this.turningPoints[a+1].x)+d,this.turningPoints[a].y]
									}
									else{
										Log.error("Connector:middle() - this should never happen "+this.turningPoints[a]+" "+this.turningPoints[a+1]+" nr of points "+this.turningPoints.length)
									}
								}
							}
						}
					}return null
				},updateMiddleText:function(){
					var a=this.middle();
					if(a!=null){
						this.middleText.transform(Matrix.translationMatrix(((a[0]-this.middleText.vector[0].x)*160)/100,a[1]-this.middleText.vector[0].y))
					}
				},getBounds:function(){
					var a=minY=maxX=maxY=null;
					for(var b=0;b<this.turningPoints.length;b++){
						if(this.turningPoints[b].x<a||a==null){a=this.turningPoints[b].x}if(this.turningPoints[b].x>maxX||maxX==null){maxX=this.turningPoints[b].x}if(this.turningPoints[b].y<minY||minY==null){minY=this.turningPoints[b].y}if(this.turningPoints[b].y>maxY||maxY==null){maxY=this.turningPoints[b].y}}return[a,minY,maxX,maxY]},toString:function(){return"Connector id = "+this.id+" "+this.type+"["+this.turningPoints+"] active cp = "+this.activeConnectionPointId+")"},toSVG:function(){var e='<polyline points="';for(var d=0;d<this.turningPoints.length;d++){e+=this.turningPoints[d].x+","+this.turningPoints[d].y+" "}e+='"';e+=this.style.toSVG();e+="/>";var g=null;if(this.startStyle==Connector.STYLE_ARROW){g=this.getArrow(this.turningPoints[0].x,this.turningPoints[0].y)}if(this.startStyle==Connector.STYLE_EMPTY_TRIANGLE){g=this.getTriangle(this.turningPoints[0].x,this.turningPoints[0].y,false)}if(this.startStyle==Connector.STYLE_FILLED_TRIANGLE){g=this.getTriangle(this.turningPoints[0].x,this.turningPoints[0].y,true)}if(g){var b=this.turningPoints[0].x;var a=this.turningPoints[0].y;var c=Util.getAngle(this.turningPoints[0],this.turningPoints[1],0);g.transform(Matrix.translationMatrix(-b,-a));g.transform(Matrix.rotationMatrix(c));g.transform(Matrix.translationMatrix(b,a));e+=g.toSVG()}if(this.endStyle==Connector.STYLE_ARROW){g=this.getArrow(this.turningPoints[this.turningPoints.length-1].x,this.turningPoints[this.turningPoints.length-1].y)}if(this.endStyle==Connector.STYLE_EMPTY_TRIANGLE){g=this.getTriangle(this.turningPoints[this.turningPoints.length-1].x,this.turningPoints[this.turningPoints.length-1].y,false)}if(this.endStyle==Connector.STYLE_FILLED_TRIANGLE){g=this.getTriangle(this.turningPoints[this.turningPoints.length-1].x,this.turningPoints[this.turningPoints.length-1].y,true)}if(g){var b=this.turningPoints[this.turningPoints.length-1].x;var a=this.turningPoints[this.turningPoints.length-1].y;var c=Util.getAngle(this.turningPoints[this.turningPoints.length-1],this.turningPoints[this.turningPoints.length-2],0);g.transform(Matrix.translationMatrix(-b,-a));g.transform(Matrix.rotationMatrix(c));g.transform(Matrix.translationMatrix(b,a));e+=g.toSVG()}if(this.middleText.str.length!=1){var h=this.middleText.getBounds();var f=new Polygon();f.addPoint(new Point(h[0],h[1]));f.addPoint(new Point(h[2],h[1]));f.addPoint(new Point(h[2],h[3]));f.addPoint(new Point(h[0],h[3]));f.style.fillStyle="#FFFFFF";e+=f.toSVG();e+=this.middleText.toSVG()}return e}};function ConnectionPoint(d,a,c,b){this.id=c;this.point=a.clone();this.parentId=d;this.type=b;this.color=ConnectionPoint.NORMAL_COLOR;this.radius=3;this.oType="ConnectionPoint"}ConnectionPoint.NORMAL_COLOR="#FFFF33";ConnectionPoint.OVER_COLOR="#FF9900";ConnectionPoint.CONNECTED_COLOR="#ff0000";ConnectionPoint.RADIUS=4;ConnectionPoint.TYPE_FIGURE="figure";ConnectionPoint.TYPE_CONNECTOR="connector";ConnectionPoint.load=function(b){var a=new ConnectionPoint(0,new Point(0,0),ConnectionPoint.TYPE_FIGURE);a.id=b.id;a.point=Point.load(b.point);a.parentId=b.parentId;a.type=b.type;a.color=b.color;a.radius=b.radius;return a};ConnectionPoint.loadArray=function(b){var a=[];for(var c=0;c<b.length;c++){a.push(ConnectionPoint.load(b[c]))}return a};ConnectionPoint.prototype={equals:function(a){return this.id==a.id&&this.point.equals(a.point)&&this.parentId==a.parentId&&this.type==a.type&&this.color==a.color&&this.radius==a.radius},paint:function(a){a.save();a.fillStyle=this.color;a.strokeStyle="#000000";a.beginPath();a.arc(this.point.x,this.point.y,ConnectionPoint.RADIUS,0,(Math.PI/180)*360,false);a.fill();a.stroke();a.restore()},transform:function(a){this.point.transform(a)},highlight:function(){this.color=ConnectionPoint.OVER_COLOR},unhighlight:function(){this.color=ConnectionPoint.NORMAL_COLOR},contains:function(a,b){return this.near(a,b,ConnectionPoint.RADIUS)},near:function(b,c,a){return new Point(this.point.x,this.point.y).near(b,c,a)},toString:function(){return"ConnectionPoint id = "+this.id+" point = ["+this.point+"] ,type = "+this.type+", parentId = "+this.parentId+")"}};function Glue(b,a){this.id1=b;this.id2=a;this.type1="figure";this.type2="connector";this.oType="Glue"}Glue.load=function(b){var a=new Glue(23,40);a.id1=b.id1;a.id2=b.id2;a.type1=b.type1;a.type2=b.type2;return a};Glue.loadArray=function(b){var a=[];for(var c=0;c<b.length;c++){a.push(Glue.load(b[c]))}return a};Glue.prototype={equals:function(a){if(!a instanceof Glue){return false}return this.id1==a.id1&&this.id2==a.id2&&this.type1==a.type1&&this.type2==a.type2},toString:function(){return"Glue : ("+this.id1+", "+this.id2+")"}};
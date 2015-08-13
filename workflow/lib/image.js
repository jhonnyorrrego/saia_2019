/**
 *Offers support for images in diagrams
 *@this {CanvasImage}
 *@constructor
 *@param {Number} x
 *@param {Number} y
 *@param {String} src
 *@author zack
 **/
function CanvasImage(x, y, src){
    this.img = null;
   
    this.noImage = new Image();
    this.noImage.src = CanvasImage.NO_IMAGE;

    this.src = src;
    this.encoded = "";
   
    this.width = CanvasImage.DEFAULT_WIDTH;
    this.height= CanvasImage.DEFAULT_WIDTH;

    this.fixed = CanvasImage.FIXED_AUTO;
    this.vector= [new Point(x,y), new Point(x,y-20), new Point(x+this.width, y+this.height)];

    this.gifTimer = null;
   
    this.style = new Style();
}

CanvasImage.DEFAULT_WIDTH = 100;
CanvasImage.NO_IMAGE = "assets/images/selectImage.gif";
CanvasImage.LOADING_IMAGE = "assets/images/loading.gif";

CanvasImage.FIXED_NONE = 0;
CanvasImage.FIXED_WIDTH = 1;
CanvasImage.FIXED_HEIGHT = 2;
CanvasImage.FIXED_BOTH = 3;
CanvasImage.FIXED_AUTO = 4;


/**Creates a {CanvasImage} out of JSON parsed object
 *@param {JSONObject} o - the JSON parsed object
 *@return {CanvasImage} a newly constructed Point
 **/
CanvasImage.load = function(o){
    var newCanvasImage = new CanvasImage();
    
    newCanvasImage.width = o.width;
    newCanvasImage.height = o.height;
    newCanvasImage.style = Style.load(o.style);
    newCanvasImage.src = o.src;
    
    return newCanvasImage;
}
		

CanvasImage.prototype = {
    getFile:function(){
        return ""
    },

    setFile:function(figure, file){
        this.src = "";
        this.noImage.src = CanvasImage.LOADING_IMAGE;
        var primNum = 0;
        for(var i = 0; i < figure.primitives.length; i++){
            if(figure.primitives[i] == this){
                primNum = i;
                break;
            }
        }
        $.ajaxFileUpload({
            url:'upload.php?figureID='+figure.id+'&primitive='+primNum,
            dataType:'json',
            fileElementId: 'fileToUpload',
            secureuri: false, 
            success: function (data, status){
                var prim = stack.figureGetById(data.figure).primitives[data.primitive];
                prim.img = null;
                prim.src = data.File;
                prim.gifTimer = setTimeout("draw();",333);
            },
            error: function (data, status, e){
                alert(e);
            }
        })
        return false;
    },
    
    getURL:function(){
        return this.src;
    },

    setURL:function(figure, url){
        this.img = null;
        if(url != ""){
            this.encoded = "";
        }
        if(this.src != url){
            this.image = null;
            this.src = url;
        }
    },

    getEncoded:function(){
        return this.encoded;
    },

    setEncoded:function(figure, encoded){
        if(encoded != ""){
            this.src = "";
        }
        if(encoded != this.encoded){
            this.image = null;
            this.encoded = encoded;
        }
    },
    
    drawImage:function(context, img){
        var fixed;
        var sWidth;
        var sHeight;
        var dWidth;
        var dHeight;
        
        if(img == this.img){//if we are displaying a logo, use the selected scaling
            fixed = this.fixed;
        }
        else{//otherwise (please select, loading), force fit
            fixed = CanvasImage.FIXED_BOTH;
        }

        //determine auto width
        if(img.width > img.height && fixed == CanvasImage.FIXED_AUTO){
            fixed = CanvasImage.FIXED_WIDTH;
        }
        else if(fixed == CanvasImage.FIXED_AUTO){
            fixed = CanvasImage.FIXED_HEIGHT;
        }

        //set up properties of source width, height and dest width and height, based on which dimension(s) are fixed
        if(fixed == CanvasImage.FIXED_NONE){
            sHeight = Math.min(this.height, img.height);
            dHeight = sHeight;
            
            sWidth = Math.min(this.width, img.width);
            dWidth = sWidth;
        }
        else if(fixed == CanvasImage.FIXED_BOTH){
            sHeight = img.height;
            dHeight = this.height;
            
            sWidth = img.width;
            dWidth = this.width;
        }
        else if(fixed == CanvasImage.FIXED_WIDTH){
            var ratio = 100 / img.width * this.width;
            sWidth = img.width;
            dWidth = this.width;

            sHeight = img.height;
            if(this.height >= sHeight / 100 * ratio){
                dHeight = sHeight / 100 * ratio;//sWidth / 100 * ratio;
            }
            else{
                dHeight = this.height;
                sHeight = this.height * 100 / ratio;
            }
        }
        else if(fixed == CanvasImage.FIXED_HEIGHT){
            var ratio = 100 / img.height * this.height;
            sHeight = img.height;
            dHeight = this.height;
            
            sWidth = img.width;
            if(this.width >= sWidth / 100 * ratio){
                dWidth = sWidth / 100 * ratio;//sWidth / 100 * ratio;
            }
            else{
                dWidth = this.width;
                sWidth = this.width * 100 / ratio;
            }
        }context.drawImage(img,
            0, 0, //sx, sy
            sWidth,
            sHeight,
            this.vector[0].x, this.vector[0].y, //dx,dy
            dWidth,
            dHeight
            );
        if(img.src.indexOf(".gif") != -1){
            this.gifTimer = setTimeout("draw();",333);
        }
    },

    paint:function(context){
        //context.save();
        if(this.debug){
            //paint vector
            context.beginPath();
            context.moveTo(this.vector[0].x,this.vector[0].y);
            context.lineTo(this.vector[0].x+this.width,this.vector[0].y+this.height);
            context.closePath();
            context.stroke();
        }
        var angle = Util.getAngle(this.vector[0],this.vector[1]);
        
        context.translate(this.vector[0].x,this.vector[0].y);
        context.rotate(angle);
        context.translate(-this.vector[0].x, -this.vector[0].y);
        if(this.img == null){
            if(this.src != ""){
                this.img = new Image();
                /*this.img.onload = function(canvasImage){
                    return function(event){
                        if(img.)
                        canvasImage.drawImage(context, canvasImage.img);
                    }
                }(this);*/
                this.img.src = "getImage.php?url="+this.src;
            }
            else if(this.encoded != ""){
                this.img = new Image();
                this.img.src = this.encoded;
            }
            this.drawImage(context, this.noImage);
        }
        else if(this.img.complete == false){
            this.noImage.src = CanvasImage.LOADING_IMAGE;
            this.drawImage(context, this.noImage);
        }
        else{
            this.gifTimer = setTimeout("draw();",1);//its loaded lets make sure it is displayed
            clearTimeout(this.gifTimer);
            this.gifTimer = null;
            this.drawImage(context, this.img);
        }
       
    //context.fill();
    //context.restore();
    },
    
    transform:function(matrix){
        this.vector[0].transform(matrix);
        this.vector[1].transform(matrix);
        this.vector[2].transform(matrix);

        //now we need to get it's actual width and height, so lets rotate it back to 0 and set it's width and height
        var angle = Util.getAngle(this.vector[0], this.vector[1]);

        this.vector[0].transform(Matrix.rotationMatrix(-angle));
        this.vector[2].transform(Matrix.rotationMatrix(-angle));
        
        this.width = this.vector[2].x - this.vector[0].x;
        this.height = this.vector[2].y - this.vector[0].y;

        this.vector[0].transform(Matrix.rotationMatrix(angle));
        this.vector[2].transform(Matrix.rotationMatrix(angle));
    },

    getNormalBounds:function(){
        var poly = new Polygon();
        poly.addPoint(new Point(this.vector[0].x, this.vector[0].y));
        poly.addPoint(new Point(this.vector[0].x+this.width, this.vector[0].y));
        poly.addPoint(new Point(this.vector[0].x+this.width, this.vector[0].y+this.height));
        poly.addPoint(new Point(this.vector[0].x, this.vector[0].y+this.height));
        return poly;
    },

    getBounds:function(){
        var angle = Util.getAngle(this.vector[0],this.vector[1]);
        var nBounds = this.getNormalBounds();
        /*if(this.align == Text.ALIGN_LEFT){
            nBounds.transform(Matrix.translationMatrix(this.getNormalWidth()/2,0));
        }
        if(this.align == Text.ALIGN_RIGHT){
            nBounds.transform(Matrix.translationMatrix(-this.getNormalWidth()/2,0));
        }*/
        nBounds.transform(Matrix.translationMatrix(-this.vector[0].x,-this.vector[0].y) );
        nBounds.transform(Matrix.rotationMatrix(angle));
        nBounds.transform(Matrix.translationMatrix(this.vector[0].x,this.vector[0].y));

        return nBounds.getBounds();
    },



    contains: function(x,y){
        var angle = Util.getAngle(this.vector[0],this.vector[1]);
        var nBounds = this.getNormalBounds();
        nBounds.transform( Matrix.translationMatrix(-this.vector[0].x,-this.vector[0].y) );
        nBounds.transform(Matrix.rotationMatrix(angle));
        nBounds.transform(Matrix.translationMatrix(this.vector[0].x,this.vector[0].y));

        return nBounds.contains(x,y);
    },


    near:function(x, y, radius){
        var angle = Util.getAngle(this.vector[0],this.vector[1]);
        var nBounds = this.getNormalBounds();
        nBounds.transform( Matrix.translationMatrix(-this.vector[0].x,-this.vector[0].y) );
        nBounds.transform(Matrix.rotationMatrix(angle));
        nBounds.transform(Matrix.translationMatrix(this.vector[0].x,this.vector[0].y));

        return nBounds.near(x,y, radius);
    },


    equals:function(anotherImage){
        if(!anotherImage instanceof CanvasImage){
            return false;
        }

        if(
            this.img.src != anotherImage.img.src
            || this.x != anotherImage.x
            || this.y != anotherImage.y
            || this.width != anotherImage.width
            || this.height != anotherImage.height){
            return false;
        }


        for(var i=0; i<this.vector.length; i++){
            if(!this.vector[i].equals(anotherImage.vector[i])){
                return false;
            }
        }

        if(!this.style.equals(anotherImage.style)){
            return false;
        }

        //TODO: compare styles too this.style = new Style();
        return true;
    },


    clone: function(){
        throw 'Image:clone - not implemented';
    },


    toString:function(){
        return 'Image: ' + (this.img == null ? "null" : this.img.src) + ' x:' + this.vector[0].x +  ' y:' + this.vector[0].y;
    },


    getPoints:function(){
        return [];
    }
}
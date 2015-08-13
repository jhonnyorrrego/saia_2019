/*
 * A wrapper for canvas element. This should only used to save / store canvas' properties
 * @param {Number} width - the width of the {Canvas}
 * @param {Number} height - the height of the {Canvas}
 * @author Zack Newsham <zack_newsham@yahoo.co.uk>
 * @author Alex Gheorghiu <alex@scriptoid.com>
 */
function CanvasProps(width, height){    
    this.width = width;
    this.height = height;
    
    this.id = "canvasProps"; //used in main.js:updateFigure() to see what object we have
    
    this.oType = 'CanvasProps';
}

CanvasProps.DEFAULT_HEIGHT = 700; //default height for canvas
CanvasProps.DEFAULT_WIDTH = 1000; //default width for canvas

/*
 *We only ever have one instance of this class (like stack)
 *but we need the creation of the Canvas to appear AFTER the page exists,
 *otherwise we would not be able to add it dinamically to the document.
 *@param {JSONObject} o
 *@return new {Canvas}
 *@author Zack Newsham <zack_newsham@yahoo.co.uk>
 *@author Alex Gheorghiu <alex@scriptoid.com>
 */
CanvasProps.load = function(o){
    var canvasprops = new CanvasProps();

    canvasprops.height = o.height;
    canvasprops.width = o.width;

    return canvasprops;
}


CanvasProps.prototype = {
    
    /**Get width of the canvas*/
    getWidth:function(){
        return this.width;
    },


    /*
     * Set the width of the canvas. Also force a canvas resize
     * @param {Numeric} width - the new width
     */
    setWidth:function(width){//required for undo
        this.width = width;
        this.sync();
    },

    /**Return the height of the canvas*/
    getHeight:function(){
        return this.height;
    },


    /*
     * Set the height of the canvas. Also force a Canvas resize
     *  @param {Numeric} height - the new height
     */

    setHeight:function(height){//required for undo
        this.height = height;
        this.sync();
    },


    /**
     *Resize the Canvas to current values
     *@author alex@scriptoid.com
     **/
    sync:function() {
        var canvas = getCanvas();
        
        canvas.height = this.height;
        canvas.width = this.width;

        //whenever we change a detail of the width of the canvas, we need to update the map
        minimap.initMinimap();
    },

    
    toString: function(){
       return "CanvasProp [width: " + this.width + " height: " + this.height + ' ]';
    }
}


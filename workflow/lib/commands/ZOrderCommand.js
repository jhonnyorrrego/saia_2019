/*
 * @this Object that is used to undo actions when figures are moved from front to back
 * @param property {Null}
 * @param previousValue {Number} index
 * @param currentValue {Number} index
 */
function ZOrderCommand(objectId, typeOfObject, property, previousValue, currentValue){
    this.objectId = objectId;
    this.typeOfObject = typeOfObject;
    this.property = property;
    this.previousValue = previousValue;
    this.currentValue = currentValue;
    this.oType = "Z-Order Action";
}

ZOrderCommand.prototype = {
        /**This method got called every time the Command must execute*/
    redo : function(){
        this._doAction(this.currentValue);
    },
    
    
    /**This method should be called every time the Command should be undone*/
    undo : function(){
        this._doAction(this.previousValue);
    },
    
    _doAction:function(value){
        var oldValue = stack.idToIndex[this.objectId] ;
        if(oldValue + 1 == value || oldValue - 1 == value){
            stack.swapToPosition(this.objectId, value);
        }
        else{
            stack.setPosition(this.objectId, value);
        }
    }
}



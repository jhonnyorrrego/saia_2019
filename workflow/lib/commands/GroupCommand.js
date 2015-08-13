/*
 * @this Object that is used to undo actions when figures are grouped or ungrouped
 * @param objectId {Numeric} - the id of the object we will operate on
 * @param typeOfObject {Numeric} - the type of the object we will operate on (ex. History.OBJECT_FIGURE)
 * @param property {String} - the property of the object we are observing
 * @param previousValue {Object} - the pervious value of the object
 * @param currentValue {Object} - the current value of the object
 */
function GroupCommand(objectId, typeOfObject, property, previousValue, currentValue){
    this.objectId = objectId;
    this.typeOfObject = typeOfObject;
    this.property = property;
    this.previousValue = previousValue;
    this.currentValue = currentValue;
    this.oType = "Group Action";
}

GroupCommand.prototype = {
    /**This method got called every time the Command must execute*/
    redo : function(){
        this._doAction(this.currentValue);
    },
    
    
    /**This method should be called every time the Command should be undone*/
    undo : function(){
        this._doAction(this.previousValue);
    },
    
    _doAction:function(value){
        var group = stack.groupGetById(this.objectId);
        if(value == false){//we are ungrouping
            stack.groupDestroy(this.objectId);
            selectedGroupId = -1; //inherited from main.js
            state = STATE_NONE; //inherited from main.js
        }
        else {//we are regrouping
            //destroy/discard any temp group
            for (var i = 0; i < stack.groups.length; i++){
                if(stack.groups[i].permanent == false){
                    stack.groupDestroy(stack.groups[i].id);
                    break;//there should only be 1
                }
            }

            //create a new group based on the figureIds we already have
            var gId = stack.groupCreate(value);
            group = stack.groupGetById(gId);
            group.id = this.objectId;
            group.permanent = this.property;

            //set the figures with the old groupId, as we will now have a new one.
            var figures = stack.figureGetByGroupId(gId);
            for (var i = 0; i < figures.length; i++){
                figures[i].groupId = this.objectId;
            }
            selectedGroupId = this.objectId;
            state = STATE_GROUP_SELECTED;
        }
    }
}


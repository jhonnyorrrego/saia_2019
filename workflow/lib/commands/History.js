/* 
 * @this An facade to add Commands, undo and redo them
 * @author Zack Newsham zack_newsham@yahoo.co.uk
 * @author Alex <alex@scriptoid.com>
 */
function History(){
}

History.OBJECT_FIGURE = 0;           //objectID is for a figure
History.OBJECT_CONNECTOR = 1;        //objectID is for a connector
History.OBJECT_CONNECTION_POINT = 2; //objectID is for a connection point
History.OBJECT_STATIC = 3;           //objectID is an object
History.OBJECT_GROUP = 4;            //objectID is for a group
History.OBJECT_GLUE = 5;             //objectID is for a glue

History.COMMANDS = [];                //where we store all the actions
History.CURRENT_POINTER = -1;         //the current location within the vector of undoable objects. At that position there will be a Command



/* Add an action to the stack of undoable actions.
 * We position at current pointer, remove everything after it and then add the new
 * action
 * @param {Command} command -  the command History must store
 */
History.addUndo = function(command){
    if(doUndo){
        /**As we are now positioned on CURRENT_POINTER(where current Command is stored) we will
         *delete anything after it, add new Command and increase CURRENT_POINTER
         **/
        
        //remove commands after current command 
        History.COMMANDS.splice(History.CURRENT_POINTER +1, History.COMMANDS.length);
         
        //add new command 
        History.COMMANDS.push(command);
        
        //increase the current pointer
        History.CURRENT_POINTER++;
    }
}


History.undo = function(){
    if(History.CURRENT_POINTER >= 0){
        Log.info('undo()->Type of action: ' + History.COMMANDS[History.CURRENT_POINTER].oType);
        History.COMMANDS[History.CURRENT_POINTER].undo();
                        
        History.CURRENT_POINTER --;
    }
}


History.redo = function(){
    if(History.CURRENT_POINTER + 1 < History.COMMANDS.length){
        Log.info('redo()->Type of action: ' + History.COMMANDS[History.CURRENT_POINTER+1].oType);
        History.COMMANDS[History.CURRENT_POINTER + 1].redo();
                       
        History.CURRENT_POINTER++;
    }
}



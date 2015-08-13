/* 
 * @this An interface for undoable actions, implemented by classes that specify 
 * how to handle action
 * @param objectId = {Number} of {Figure}/{Connector}/{ConnectionPoint} Id
 * @param typeOfObject = {Number} representing the type of object being changed
 * @param property = {String} representing properties address within object
 * @param previousValue = {Object}
 * @param currentValue = {Object}
 * @author Zack Newsham zack_newsham@yahoo.co.uk
 * @author Alex <alex@scriptoid.com>
 */
function Command(objectId, typeOfObject, property, previousValue, currentValue){
    this.objectId = objectId;
    this.typeOfObject = typeOfObject;
    this.property = property;
    this.previousValue = previousValue;
    this.currentValue = currentValue;
}

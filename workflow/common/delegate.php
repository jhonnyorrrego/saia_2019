<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
if (!isset($_SESSION)) {
    session_start();
}
//require_once(dirname(__FILE__).'/settings.php');
require_once($ruta_db_superior."db.php");
require_once($ruta_db_superior.'workflow/common/entities.php');
require_once($ruta_db_superior.'workflow/common//utils.php');



class Delegate {

    private $con;

    /**constructor*/
    public function __construct() {

       //$this->con = $this->getConnection();

    }


    /**destructor*/
    public function __destruct() {
        //$this->closeConnection($this->con);
    }


    /**a wrapper method for executing a query*/
    public function executeSQL($query, $con) {
        $result=phpmkr_query($query);
        return $result;
    }


    /**get a connection*/
    protected  function getConnection() {
      global $conn;
      return $conn->con;
    }


    /**close a connection to database*/
    protected function closeConnection($con) {
  
    }


    /*retuns last inserted Id*/
    protected function lastId($con) {
        return(phpmkr_insert_id());
    }

    /**************************************************************************/
    /************************GENERAL FUNCTIONS*********************************/
    /**************************************************************************/

    /**
     * Use this function to define strange plurals (not a simple 's' added: example company/companies)
     */
//     function singular($plural){
//        $dict = array('entries'=>'entry');
//
//        if(key_exists($plural, $dict)){
//            return $dict[$plural];
//        }
//        else{
//            //try to remove the 's'
//            return substr($plural, 0, -1);
//        }
//    }
//
//    function plural($singular){
//        $dict = array('entries'=>'entry');
//        $reverseDict = array_flip($dict);
//
//        if(key_exists($singular, $reverseDict)){
//            return $reverseDict[$singular];
//        }
//        else{
//            return $singular + 's';
//        }
//    }

    /**Update an entry from an object. We should make wrappers around this function (make it private !?!)
    *  and never call it directly from outside Delegate
    *  $tableName - name of the table
    *  $object - the object
    *  $ids -  list of ids (default 'id'), usefull for multiple key or keys other then 'id'
    *  $nullify - if true unset values will be set to NULL, if false we will not touch existing column value
    *  author: liviu, alex
     * 
    *  Note: The update is made based on the object/record id, so the id should not be changed!
     */
    protected function update($object, $ids = array('id'), $tableName=null, $nullify=false) {

        //detect class name
        if(empty($tableName)) {
            $tableName = strtolower(get_class($object));
        }

        //start query
        $query = "UPDATE {$tableName} SET ";


        $comma = false;
        foreach($object as $key => $value) {

            //ignore the primary keys (usually id)
            if(in_array($key, $ids)) {
                continue;
            }

            //set values
//            if(isset($value)) { //pick only set values and ignore not set ones
            //TODO: here is wrong as $v= null; isset($v) returns False and we can not get inside this branch/scope

                if(is_null($value)) { //the value is null so we have to see what to do with it
                    if($nullify) { //should we set the unset values to null ?
                        if($comma) {
                            $query .= ", ";
                        } else {
                            $comma = true;
                        }
                        $query .= "{$key} = NULL ";
                    } else {
                        //do nothing, we will ignore set & null values
                    }
                } else { //the value is not null
                    if($comma) {
                        $query .= ", ";
                    } else {
                        $comma = true;
                    }

                    //based on it's type we quote the value
                    switch(gettype($value)) {
                        case 'string':
                            $query .= sprintf(" {$key} = '%s' ", addslashes($value));
                            break;
                        case 'boolean':
                            $query .= sprintf(" {$key} = %s ", $value ? "true" : "false");
                            break;
                        default:
                            $query .= sprintf(" {$key} = %s ", addslashes($value));
                            break;
                    }
                }
//            } else {
//                //ignore unset values
//            }


        }//end foreach


        //use the keys
        $query .= " WHERE "; //'WHERE' should always be present as there should always be an id
        $comma = false;
        foreach($ids as $id) {
            foreach($object as $key => $value) {
//                print "ID: $id -------" . "($key,$value) ----------- " . var_export($object, true) . "<br>";
                if ($id == $key) { //ok we found a key
                    if($comma) {
                        $query .= " AND ";
                    }
                    else {
                        $comma = true;
                    }

                    switch(gettype($value)) {
                        case 'string':
                            $query .= sprintf(" {$key} = '%s' ", addslashes($value));
                            break;
                        default: //we place together integers, booleans and aliens
                            $query .= sprintf(" {$key} = %s ", addslashes($value));
                            break;
                    }

                }
            }
        } //end foreach

        #print $query;
        #exit();

        (@DEBUG) ? $_SESSION['logs'][] = "&nbsp;&nbsp;&nbsp;&nbsp;" . __CLASS__ .'{#}'. __FUNCTION__ ."{#}{$query}{#}". __LINE__ : '';

        //EXECUTE
        $result = $this->executeSQL($query, $this->con);

        if($result) {
            return true;
        } else {
            return false;
        }

    }

    /**Add a new entry. We should make wrappers around this function (make it private !?!)
    *  and never call it directly from outside Delegate
    *  $tableName - name of the table
    *  $object - the object
    *  $ids -  list of ids (default 'id'), usefull for multiple key or keys other then 'id'
    *  $nullify - if true unset values will be set to NULL, if false we will not touch existing column value
     * returns the 'id' of the created entry
    *  author: alex
     */
    protected function create($object, $ids = array('id'), $tableName=null,  $nullify=false, $autoincrement=true) {

        //detect class name
        if(empty($tableName)) {
            $tableName = strtolower(get_class($object));
        }

        //start query
        $query = "INSERT INTO {$tableName} ( ";

        //start collecting column names
        $comma = false;
        foreach($object as $key => $value) {
            //ignore the primary keys (usually id) if autogenerated
            if($autoincrement && in_array($key, $ids)) {
                continue;
            }

            //set column names
            if(isset($value)) { //ok the value is set
                if(is_null($value)) { //but it's set to null
                    if($nullify) { //we will add columns that will have NULL values
                        if($comma) {
                            $query .= ",";
                        }
                        else {
                            $comma = true;
                        }
                        $query .= "{$key}"; #protect the column names in case they are the same as SQL keywords (ex: order)
                    }
                    else { //we will ignore the columns with null values
                        //do nothing
                    }
                }
                else { //now, it's not null
                    if($comma) {
                        $query .= ",";
                    }
                    else {
                        $comma = true;
                    }
                    $query .= "{$key}";
                }

            } else {
                //just ignore unset values
            }
        }//end collecting column names


        //start collecting values
        $query .= ') VALUES (';
        //TODO: test for cases where there is not need for a value - ex. table with 1 autogenerated column
        //even if this is kinda stupid :P
        $comma = false;
        foreach($object as $key => $value) {

            //ignore the primary keys (usually id) if autogeneated
            if($autoincrement  && in_array($key, $ids)) {
                continue;
            }

            //add VALUES(....)
            //right now we skip not set NULL values...but maybe we should reconsider for set to Null values (ex: $o->deadDate = null)
            if(isset($value)) {
                if($comma) {
                    $query .= ", ";
                }
                else {
                    $comma = true;
                }
                //based on it's type we quote the value
                switch(gettype($value)) {
                    case 'string':
						if(strpos($value,":")>0){
							$nuevo_valor=fecha_db_almacenar($value,'Y-m-d H:i:s');
							//" TO_DATE('".$value."','YYYY-MM-DD HH24:MI:SS') ";
							$query .= $nuevo_valor;
						}
						else{
                        	$query .= sprintf("'%s'",  addslashes($value));
						}
                        break;
                    case 'boolean': //special case as a 'false' value can not be concatenated with a string
                        $query .= $value ? 'true' : 'false';
					
                        break;
                    case 'NULL' : //if $conditionValue is null the gettype($conditionValue) returns 'NULL'
                        $query .= 'NULL';
                        break;    
                    default:
                        $query .= sprintf("%s",  $value);
                }
            } else {
                if($nullify) { //should we set the unset values to null ?
                    if($comma) {
                        $query .= ", ";
                    }
                    else {
                        $comma = true;
                    }
                    $query .= " NULL";
                }
            }
        }//end collecting value


        $query .= ')';
		//die($query);
//        print $query;
        #exit();

        (@DEBUG) ? $_SESSION['logs'][] = "&nbsp;&nbsp;&nbsp;&nbsp;" . __CLASS__ .'{#}'. __FUNCTION__ ."{#}{$query}{#}". __LINE__ : '';
        //EXECUTE
        $result = $this->executeSQL($query, $this->con);

        if($autoincrement) {//autogenerated ID
//            print "log: autoincrement used";
            return $this->lastId($this->con);
        }
        else { //"by hand" ids
//            print "log: by hand used";
            if($result) {
//                print "log: affected";
                return true;
            } else {
//                print "log: not affected";
                return false;
            }
        }
    }


    /**
     * Get a number of object from the database
     * $tableName - table name
     * $conditions - AND like conditions ex: array('name'=>'alex', 'age'=>'31')
     * $orders - ORDER BY part ex: array('name'=>'ASC', 'age'=>'DESC')
     * $start - start offset
     * $nr - number of rows returned
     * author: alex
     */

    protected function getMultiple($tableName, $conditions = null, $orders=null, $start =null, $nr = null) {
        $objects = array(); //this will contain all the found objects

        $tableName = strtolower($tableName);

        //start query building
        $query = sprintf("SELECT * FROM %s", $tableName);

        //conditions
        if(count($conditions) > 0) {
            $query .= " WHERE ";
            $and = false;
            foreach($conditions as $conditionName=> $conditionValue) {
                if($and) {
                    $query .= " AND ";
                }
                else {
                    $and = true;
                }

                //based on it's type we quote the value
                switch(gettype($conditionValue)) {
                    case 'string':
                        $query .= sprintf(" %s = '%s'",$conditionName,addslashes($conditionValue));
                        break;
                    case 'boolean': //special case as a 'false' value can not be concatenated with a string
                        $query .= sprintf(" %s = %s",$conditionName, $conditionValue ? 'true' : 'false');
                        break;
                    case 'NULL' : //if $conditionValue is null the gettype($conditionValue) returns 'NULL'
                        $query .= sprintf(" %s IS NULL",$conditionName);
                        break;
                    default:
                        $query .= sprintf(" %s = %s",$conditionName,$conditionValue);
                }
            }
        }


        //add orders
        if(count($orders) > 0) {
            $query .= " ORDER BY ";
            $comma = false;
            foreach($orders as $order=>$direction) {
                if($comma) {
                    $query .= sprintf(", %s  %s ",$order,$direction);
                }
                else {
                    $query .= sprintf(" %s  %s",$order,$direction);
                    $comma = true;
                }
            }
        }


        if(!is_null($start)) {
            $query .= sprintf(" LIMIT %d", $start);
        }

        if(!is_null($nr)) {
            $query .= sprintf(", %d", $nr);
        }

        #print $query;
        (@DEBUG) ? $_SESSION['logs'][] = "&nbsp;&nbsp;&nbsp;&nbsp;" . __CLASS__ .'{#}'. __FUNCTION__ ."{#}{$query}{#}". __LINE__ : '';

        //EXECUTE query
        $result = $this->executeSQL($query, $this->con);
        $className = ucfirst($tableName);
		if($className == "User_workflow"){
			$className="User";
		}
        while ($row = phpmkr_fetch_array($result)) {
            $object = new $className;
            $object->loadFromSQL($row);
            $objects[] = $object;
        }



        return $objects;
    }


    /**Return single */
    protected function getSingle($tableName, $conditions = null) {
        $foundedObjects = $this->getMultiple($tableName, $conditions);
        if(isset($foundedObjects) && count($foundedObjects) > 0 ){
            return $foundedObjects[0];
        }

        return;        
    }


    /**Return single */
    protected function getCount($tableName, $conditions = null) {
        $foundedObjects = $this->getMultiple($tableName, $conditions);
        return count($foundedObjects);
    }


    /**Remove an entry from a table
     * param: $id the id of the entry
     * Returns true if data was deleted, false otherwise
     */
    protected function deprecated__delete($tableName, $id) {
        $query = sprintf("DELETE FROM %s WHERE id = '%s'" , strtolower($tableName), $id);

        (@DEBUG) ? $_SESSION['logs'][] = "&nbsp;&nbsp;&nbsp;&nbsp;" . __CLASS__ .'{#}'. __FUNCTION__ ."{#}{$query}{#}". __LINE__ : '';

        $this->executeSQL($query, $this->con);

        if(mysql_affected_rows($this->con) > 0) {
            return true;
        } else {
            return false;
        }
    }


    /**Remove all entries from a table that met conditions
     * param: $conditions (an array of $key=>$value)
     * Returns true if data was deleted, false otherwise
     *
     * Ex: delete('user', array('id'=>1)) //delete the user with id 1
     * Ex2: delete('user') //delete ALL users
     */
    protected function delete($tableName, $conditions = null) {
        $tableName = strtolower($tableName);

        //start query building
        $query = sprintf("DELETE FROM %s", $tableName);

        //conditions
        if(count($conditions) > 0) {
            $query .= " WHERE ";
            $and = false;
            foreach($conditions as $conditionName=> $conditionValue) {
                if($and) {
                    $query .= " AND ";
                }
                else {
                    $and = true;
                }

                //based on it's type we quote the value
                switch(gettype($conditionValue)) {
                    case 'string':
                        $query .= sprintf(" %s = '%s'",$conditionName,addslashes($conditionValue));
                        break;
                    case 'boolean': //special case as a 'false' value can not be concatenated with a string
                        $query .= sprintf(" %s = %s",$conditionName, $conditionValue ? 'true' : 'false');
                        break;
                    default:
                        $query .= sprintf(" %s = %s",$conditionName,$conditionValue);
                }
            }
        }


        #print $query;
        (@DEBUG) ? $_SESSION['logs'][] = "&nbsp;&nbsp;&nbsp;&nbsp;" . __CLASS__ .'{#}'. __FUNCTION__ ."{#}{$query}{#}". __LINE__ : '';

        $this->executeSQL($query, $this->con);

        if(mysql_affected_rows($this->con) > 0) {
            return true;
        } else {
            return false;
        }
    }


    /**Remove an entry from a table, based on an object
     * Returns true if data was deleted, false otherwise
     */
    protected function deleteObject($object) {
        //detect class name
        if(empty($tableName)) {
            $tableName = strtolower(get_class($object));
        }

        (@DEBUG) ? $_SESSION['logs'][] = "&nbsp;&nbsp;&nbsp;&nbsp;" . __CLASS__ .'{#}'. __FUNCTION__ ."{#}{$query}{#}". __LINE__ : '';

        return $this->delete($tableName, array('id'=>$object->id) );
    }




    /**Count the number of entries
     * param: $conditions (an array of $key=>$value)
     * Returns true if data was deleted, false otherwise
     *
     * Ex: count('user', array('id'=>1)) //return the number of users with id=1 (usually 1 or null)
     * Ex2: count('user') //return the number of users in the system
     */
    protected function count($tableName, $conditions = null) {

        $tableName = strtolower($tableName);

        //start query building
        $query = sprintf("SELECT COUNT(*) as nr FROM %s", $tableName);

        //conditions
        if(count($conditions) > 0) {
            $query .= " WHERE ";
            $and = false;
            foreach($conditions as $conditionName=> $conditionValue) {
                if($and) {
                    $query .= " AND ";
                }
                else {
                    $and = true;
                }

                //based on it's type we quote the value
                switch(gettype($conditionValue)) {
                    case 'string':
                        $query .= sprintf(" %s = '%s'",$conditionName,addslashes($conditionValue));
                        break;
                    case 'boolean': //special case as a 'false' value can not be concatenated with a string
                        $query .= sprintf(" %s = %s",$conditionName, $conditionValue ? 'true' : 'false');
                        break;
                    default:
                        $query .= sprintf(" %s = %s",$conditionName,$conditionValue);
                }
            }
        }


        #print $query;
        (@DEBUG) ? $_SESSION['logs'][] = "&nbsp;&nbsp;&nbsp;&nbsp;" . __CLASS__ .'{#}'. __FUNCTION__ ."{#}{$query}{#}". __LINE__."{#}": null;

        $result  = $this->executeSQL($query, $this->con);
        if ($row =  phpmkr_fetch_array($result)) {
            return $row['nr'];
        }

    }


    /**************************************************************************/
    /*****************************USERS**************************************/
    /**************************************************************************/
    public function userGetByEmailAndPassword($email,$password) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getSingle('user_workflow', array('email'=>$email, 'password'=>$password ));
    }
    
    public function userGetByEmail($email) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getSingle('user_workflow', array('email'=>$email));
    }
    
    public function userGetByAccount($account) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getSingle('user_workflow', array('account'=>$account));
    }

    public function userGetByEmailAndAccount($email, $account) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getSingle('user_workflow', array('email'=>$email, 'account'=>$account));
    }

    public function userGetByIdAndEncryptedPassword($id, $ePass) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getSingle('user_workflow', array('id'=>$id, 'password'=>$ePass));
    }
    
    public function userGetByEmailAndCryptedPassword($email,$cryptedPassword) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getSingle('user_workflow', array('email'=>$email, 'password'=>$cryptedPassword ));
    }
    
    public function userGetById($userId) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getSingle('user_workflow', array('id'=>$userId));
    }
    
    public function userUpdate($user) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->update($user);
    }

    public function userCreate($entry) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->create($entry);
    }

    /**Get all users that are collaborating to a diagram*/
    public function usersGetAsCollaboratorNative($diagramId){
        $users = array();

        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        $query ="select user_workflow.* from user_workflow, userdiagram
                    where userdiagram.diagramId = ${diagramId}
                    and userdiagram.userId = user_workflow.id
                    order by account";

        (@DEBUG) ? $_SESSION['logs'][] = "&nbsp;&nbsp;&nbsp;&nbsp;" . __CLASS__ .'{#}'. __FUNCTION__ ."{#}{$query}{#}". __LINE__ : '';

        #echo $query;

        //EXECUTE query
        $result = $this->executeSQL($query, $this->con);
        while ($row = phpmkr_fetch_array($result)) {
            $user = new User();
            $user->loadFromSQL($row);
            $users[] = $user;
        }

        return $users;
    }

    /**************************************************************************/
    /*****************************DIAGRAMS**************************************/
    /**************************************************************************/
    public function diagramCreate($entry) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->create($entry);
    }

    public function diagramUpdate($diagram) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->update($diagram);
    }
    

    public function diagramGetById($diagramId) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getSingle('diagram', array('id'=>$diagramId));
    }

    public function diagramGetByHash($hash) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getSingle('diagram', array('hash'=>$hash));
    }

    public function diagramCountByHash($hash){
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->count('diagram', array('hash'=>$hash));
    }

    public function diagramsForUserNative($userId, $level=''){
		//print_r($level);
        $diagrams = array();

        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        $query ="select diagram.* from diagram, userdiagram
                    where userdiagram.userId = ${userId}
                    and userdiagram.diagramId = diagram.id"
                    . ( isset($level) ? " and userdiagram.nivel = '$level'" : '' )
                    . " order by title";

        (@DEBUG) ? $_SESSION['logs'][] = "&nbsp;&nbsp;&nbsp;&nbsp;" . __CLASS__ .'{#}'. __FUNCTION__ ."{#}{$query}{#}". __LINE__ : '';

        #echo $query;

        //EXECUTE query
        $result = $this->executeSQL($query, $this->con);
        while ($row = phpmkr_fetch_array($result)) {
            $diagram = new Diagram();
            $diagram->loadFromSQL($row);
            $diagrams[] = $diagram;
        }

        return $diagrams;
    }

    /**This create a cascade delete to diagramdata*/
    public function diagramDelete($diagramId){
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->delete('diagram', array('id'=>$diagramId));
    }
    
    /**************************************************************************/
    /*****************************DIAGRAMDATA**********************************/
    /**************************************************************************/
    public function diagramdataCreate($entry) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        //$object, $ids = array('id'), $tableName=null,  $nullify=false, $autoincrement=true) {
        return $this->create($entry, array('diagramId', 'type'), 'diagramdata', false, false);
    }

    public function diagramdataGetByDiagramIdAndType($diagramId, $type) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getSingle('diagramdata', array('diagramId'=>$diagramId, 'type'=>$type));
    }

    /**This create a cascade delete to diagramdata*/
    public function diagramdataDeleteByDiagramIdAndType($diagramId, $type){
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->delete('diagramdata', array('diagramId'=>$diagramId, 'type'=>$type));
    }
    
    public function diagramdataGetByDiagramId($diagramId) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getMultiple('diagramdata', array('diagramId'=>$diagramId));
    }
    
//    public function diagramdataGetByDiagramHashAndType($hash, $type) {
//        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
//        return $this->getSingle('diagramdata', array('hash'=>$hash, 'type'=>$type));
//    }

    public function diagramdataUpdate($diagramdata) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->update($diagramdata, array('diagramId', 'type'), 'diagramdata'); //do not update the key
    }
    
    /**************************************************************************/
    /*****************************USERDIAGRAMS**************************************/
    /**************************************************************************/
    public function userdiagramCreate($entry) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->create($entry);
    }
    
    public function userdiagramGetByIds($userId, $diagramId) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getSingle('userdiagram', array('userId'=>$userId, 'diagramId'=>$diagramId));
    }
    
    
    public function userdiagramGetByAuthor($diagramId) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getSingle('userdiagram', array('diagramId'=>$diagramId, 'nivel'=>  Userdiagram::LEVEL_AUTHOR));
    }

    public function userdiagramGetByDiagramId($diagramId) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getMultiple('userdiagram', array('diagramId'=>$diagramId));
    }

    public function userdiagramDelete($userId, $diagramId){
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->delete('userdiagram', array('userId'=>$userId, 'diagramId'=>$diagramId));
    }

    /**************************************************************************/
    /*****************************INVITATION***********************************/
    /**************************************************************************/
    public function invitationCreate($entry) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->create($entry, array('token'), 'invitation', false, false);
    }

    /**Counts the number of invitations that have this token*/
    public function invitationCountByToken($token) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ . '{#}' . __FUNCTION__ . "{#}{#}" . __LINE__ : '';
        return $this->count('invitation', array('token' => $token));
    }
    
    public function invitationGetByToken($token) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getSingle('invitation', array('token'=>$token));
    }
    
    public function invitationsByEmail($email) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getMultiple('invitation', array('email'=>$email));
    }

    public function invitationsDeleteByToken($token) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->delete('invitation', array('token'=>$token));
    }
    
    public function invitationsGetByDiagram($diagramId) {
        (@DEBUG) ? $_SESSION['logs'][] = __CLASS__ .'{#}'. __FUNCTION__ ."{#}{#}". __LINE__ : '';
        return $this->getMultiple('invitation', array('diagramId'=>$diagramId));
    }
    

}
?>
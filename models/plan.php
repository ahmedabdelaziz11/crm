<?php

require_once "database.php";
require_once app_path.'/interfaces/curdInterface.php';            
class plan implements curdInterface
{
    public $id ;
    public $name;
    public $duration;
    public $cost;
    public $count;
    
    private CONST TABLE_NAME = "plan" ;                                  
    private CONST TABLE_COLUMNS= "`id`, `name`, `duration`, `cost`, `count`" ;
    private CONST TABLE_KEY = "id" ;
    private $database ; 

    function __construct($name="",$duration="",$cost="")
    {
        $this->database  = new database();
        $this->set_data($name,$duration,$cost);
    }
    function set_id($id)
    {
        $this->id = $id ;
    }
    public function set_data($name,$duration,$cost) 
    {
        $this->name     = $this->database->clean_query($name);
        $this->duration = $this->database->clean_query($duration);
        $this->cost     = $this->database->clean_query($cost);
    }
    
    function count_of_subscriptions($plan_id)
    {
        $query  = "SELECT count FROM ".self::TABLE_NAME." WHERE id = ".$plan_id ;
        $result = $this->database->make_query($query);
            if($result->num_rows === 1)
            {
                $row = $result->fetch_array(MYSQLI_ASSOC);      
                return $row['count'] ; 
            }
            return false;
    }
    
    function update_count($newcount,$plan_id)
    {
        $data_to_update = "count='" .$newcount. "'" ;
        $result = $this->database->update_data(self::TABLE_NAME, $data_to_update, self::TABLE_KEY, $plan_id);
        return ($result) ? true : false ;
    }
    
    function name_is_unique()
    {
        $query  = "SELECT name FROM ".self::TABLE_NAME." WHERE name = '$this->name' ";
        $result = $this->database->make_query($query);
        return ($result->num_rows == 1) ? false : true ;
    }
    
    function create()
    {
        $data_to_insert = "NULL, '$this->name', '$this->duration', '$this->cost', '0' ";
        $result         = $this->database->insert_data(self::TABLE_NAME, self::TABLE_COLUMNS, $data_to_insert); 
        if($result)
        {
            $this->database->close_db();
            return true;
        }
        return false ;
    }

    public function get_all()
    {
        $query  = "SELECT * FROM ".self::TABLE_NAME."";
        $result = $this->database->make_query($query);
        if($result)
        {
            $rows = $result->num_rows;
            $plans = array(); 
            for($i=0; $i<$rows ;$i++)
            {
                $result->data_seek($i);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $plans[] = $row ;
            }
            $result->close();
            $this->database->close_db();
            return $plans ;
        }
 
    }
    
    public function get_by_id($plan_id)
    {
        $query  = "SELECT * FROM ".self::TABLE_NAME." WHERE id = $plan_id";
        $result = $this->database->make_query($query);
        if($result->num_rows == 1)
        {  
            $plan = $result->fetch_array(MYSQLI_ASSOC);
            $result->close();
            $this->database->close_db();
            return $plan;
        }
        return false;
 
    }
    
    function update($id)
    {
        $data_to_update = "name='" . $this->name. "',duration='". $this->duration. "',cost='" . $this->cost. "',count='" . $this->count. "'" ;
        $result = $this->database->update_data(self::TABLE_NAME, $data_to_update, self::TABLE_KEY, $id);
        if($result)
        {
            $this->database->close_db();
            return true ;
        }
        return false;
    }
    
    function delete($id)
    { 
        // $this->database->delete_data("subscriptions", "plan_id", $id);
        $result = $this->database->delete_data(self::TABLE_NAME, self::TABLE_KEY, $id) ;
        $this->database->close_db();   
    }

}
<?php
require_once 'user.php';
require_once 'database.php';
require_once app_path.'/interfaces/curdInterface.php';            

class complaint implements curdInterface{
    
    public $id;
    public $user_id;
    public $date;
    public $description;
    public $solution;
    public $is_solve;
    public $employee_id;

    private CONST TABLE_NAME    = "complaint" ;                                  
    private CONST TABLE_COLUMNS = "`id`, `user_id`, `date`, `description`, `solution`, `is_solve`, `rate`, `employee_id`" ;
    private CONST TABLE_KEY     = "id" ;
    private $database;
    
    function __construct($user_id="", $description="", $solution="", $is_solve="", $employee_id="") {
        $this->database = new database();
        $this->set_data($user_id, $description, $solution, $is_solve, $employee_id);
        
    }
    
    public function set_data($user_id,$description)
    {
        $this->user_id     = $user_id;
        $this->date        = date("20y-m-d");
        $this->description = $this->database->clean_query($description);
    }
    
    function set_id($id)
    {
        $this->id = $id ;
    }

    function make_complaint()
    {
        $data_to_insert = "NULL, '$this->user_id', '$this->date', '$this->description', NULL , '0', '0', NULL " ;
        $result         = $this->database->insert_data(self::TABLE_NAME, self::TABLE_COLUMNS, $data_to_insert);
        if ($result) 
        {
            $this->database->close_db();   
            return true;
        }
        return false;

    }
    
    function solve_complaint($id,$solution,$employee_id)
    {
        $data_to_update = "solution='".$this->database->clean_query($solution)."',is_solve='1',employee_id='".$employee_id. "'" ;
        $result         = $this->database->update_data(self::TABLE_NAME, $data_to_update, self::TABLE_KEY, $id);
        if ($result) 
        {
            $this->database->close_db();   
            return true;
        }
        return false;
    }
    
    function get_customer_complaint($id)
    {
        $query  = "SELECT * FROM ".self::TABLE_NAME." WHERE user_id = $id";
        $result = $this->database->make_query($query);
        if($result)
        {
            $rows = $result->num_rows;
            $complaints = array(); 
            for($i=0; $i<$rows ;$i++)
            {
                $result->data_seek($i);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $complaints[] = $row ;
            }
            $result->close();
            $this->database->close_db();
            return $complaints ;
        }
    }
    
    function get_by_id($id)
    {
        $query  = "SELECT * FROM '".self::TABLE_NAME."' WHERE '".self::TABLE_KEY."' = ".$id ;
        $result = $this->database->make_query($query);
            if($result->num_rows == 1)
            {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $result->close();
                $this->database->close_db();
                return $row ; 
            }
            return false;
    }
    
    function get_all()
    {
        $query  = "SELECT * FROM " .self::TABLE_NAME;
        $result = $this->database->make_query($query);
        if($result)
        {
            $rows = $result->num_rows;
            $complaints = array(); 
            for($i=0; $i<$rows ;$i++)
            {
                $result->data_seek($i);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $complaints[] = $row ;
            }
            $result->close();
            $this->database->close_db();
            return $complaints ;
        }
    }
    
    function get_notsolved_complaints()
    {
        $query  = "SELECT * FROM ".self::TABLE_NAME." WHERE is_solve = 0" ;
        $result = $this->database->make_query($query);
        if($result)
        {
            $rows = $result->num_rows;
            $complaints = array(); 
            for($i=0; $i<$rows ;$i++)
            {
                $result->data_seek($i);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $complaints[] = $row ;
            }
            $result->close();
            $this->database->close_db();
            return $complaints ;
        }
    }
    
    function rate_solution($complaint_id,$rate)
    {
        $data_to_update = "rate='".$rate."'" ;
        $result         = $this->database->update_data(self::TABLE_NAME, $data_to_update, self::TABLE_KEY, $complaint_id);
        if ($result) 
        {
            $this->database->close_db();   
            return true;
        }
        return false;       
        
    }
    
    function update($id)
    {
        $data_to_update = "description='" . $this->description. "' " ;
        $result = $this->database->update_data(self::TABLE_NAME, $data_to_update, "id", $id);
        if ($result)
        {
            $this->database->close_db();
            return true ;
        }
        return false;
    }

    function delete($id)
    {
        $result = $this->database->delete_data(self::TABLE_NAME, self::TABLE_KEY, $id) ;
        if ($result) 
        {
            $this->database->close_db();   
            return true;
        }
        return false;
    }
    
}

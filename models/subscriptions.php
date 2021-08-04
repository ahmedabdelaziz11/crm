<?php
require_once 'user.php';
require_once 'database.php';
require_once 'plan.php';
require_once app_path.'/interfaces/curdInterface.php';            



class subscriptions implements curdInterface{
    
    public $id;
    public $user_id;
    public $plan_id;
    public $start;
    public $end;

    private CONST TABLE_NAME    = "subscriptions" ;                                  
    private CONST TABLE_COLUMNS = "`id`, `user_id`, `plan_id`, `start`, `end`" ;
    private CONST TABLE_KEY     = "id" ;
    private $database;
    
    function __construct($user_id="", $plan="") {
        $this->database = new database();
        $this->set_data($user_id,$plan);
        
    }
    
    public function set_data($user_id, $plan)
    {
        $this->user_id = $user_id;
        if($plan != null)
        {
            $this->plan_id = $plan['id'];
            $this->start   = date("20y-m-d");
            $this->end     = date('Y-m-d', strtotime('+'.$plan['duration'] .' day')); 
        }
    }



    function new_subscription()
    {
        $data_to_insert = "NULL, '$this->user_id', '$this->plan_id', '$this->start', '$this->end'" ;
        $result         = $this->database->insert_data(self::TABLE_NAME, self::TABLE_COLUMNS, $data_to_insert);
        if ($result)
        {
            $plan      = new plan();
            $new_count = $plan->count_of_subscriptions($this->plan_id) + 1; //increase count of subscribers 1
            $result    = $plan->update_count($new_count, $this->plan_id); // count of subscribers
            $this->database->close_db();
            return true;
        }
        return false;
    }
    

    function get_customer_subscription($user_id)
    {
        $query  = "SELECT * FROM ".self::TABLE_NAME." INNER JOIN plan ON subscriptions.plan_id = plan.id WHERE user_id = $user_id" ;
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
        $query  = "SELECT * FROM '".self::TABLE_NAME."'";
        $result = $this->database->make_query($query);
        if($result)
        {
            $rows = $result->num_rows;
            $subscriptions = array(); 
            for($i=0; $i<$rows ;$i++)
            {
                $result->data_seek($i);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $subscriptions[] = $row ;
            }
            $result->close();
            $this->database->close_db();
            return $subscriptions ;
        }
    }
    
    
    function update($id)
    {
        $data_to_update = "start='" . $this->start. "',end='" . $this->end. "' " ;
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
        $result = $this->database->delete_data(self::TABLE_NAME, "user_id", $id) ;
        if($result)
        {
            $plan      = new plan();
            $new_count = $plan->count_of_subscriptions($this->plan_id) - 1; //descrease count of subscribers 1
            $result    = $plan->update_count($new_count, $this->plan_id); // count of subscribers for plan
            $this->database->close_db();
            return true ;
        }       
        return false;
    }

    public function get_by_id($id) {
        
    }

}

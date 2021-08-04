<?php
require_once 'user.php';
require_once 'database.php';
require_once app_path.'/traits/photo.php';
require_once app_path.'//traits/mymailer.php';



class employee extends user{

    use photo,mymailer;
    public $qulification;
    public $rate;
    private const USER_TYPE = 2 ;
    
    private CONST TABLE_NAME    = "employee" ;                                  
    private CONST TABLE_COLUMNS = "`user_id`, `qulification`, `rate`" ;
    private CONST TABLE_KEY     = "user_id" ;
    private $database ;
            
    function __construct($username="",$password="",$email="" ,$address="",$qulification="",$rate="")
    {
        parent:: __construct($username, $password, $email, $address, self::USER_TYPE);
        $this->database     = new database();
        $this->qulification = $this->database->clean_query($qulification);
        $this->rate         = $this->database->clean_query($rate);
    }
    
    function register()
    {
        parent::register();
        $data_to_insert = " '$this->id' , '$this->qulification', '$this->rate'" ;
        $result         = $this->database->insert_data(self::TABLE_NAME, self::TABLE_COLUMNS, $data_to_insert); 
        if ($result)
        {            
            $this->database->close_db();
            return true;
        }
        return false;      
    }
    
    function get_all()
    {
        $query = "SELECT user.id , user.username , user.email ,user.address , employee.qulification , employee.rate 
                  FROM user INNER JOIN employee ON user.id = employee.user_id" ;
        $result = $this->database->make_query($query);
        if($result)
        {
            $rows = $result->num_rows;
            $emps = array(); 
            for($i=0; $i<$rows ;$i++)
            {
                $result->data_seek($i);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $emps[] = $row ;
            }
            $result->close();
            $this->database->close_db();
            return $emps ;
        }
    }
    
    function get_rate($user_id)
    {
        $query = "SELECT rate from " .self::TABLE_NAME ." WHERE user_id = " . $user_id ;
        $result = $this->database->make_query($query);
        if($result->num_rows == 1)
        { 
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $result->close();
            return $row['rate'] ;
        }
    }
    
    function set_rate($user_id,$rate)
    {
        $old_rate = $this->get_rate($user_id);
        $new_rate = $old_rate + $rate ;
        $data_to_update = "rate='".$new_rate."'" ;
        $result         = $this->database->update_data(self::TABLE_NAME, $data_to_update, self::TABLE_KEY, $user_id);
        if($result)
        {
            $this->database->close_db();
            return true ;
        }
        return false;   
    }
    
    function sum_rate()
    {
        $query = "SELECT sum(rate) as sum from ".self::TABLE_NAME ;
        $result = $this->database->make_query($query);
        if($result->num_rows == 1)
        { 
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $result->close();
            $this->database->close_db();
            return $row['sum'] ;
        }
    }


    function get_by_id($user_id="")
    {
        $query = "SELECT * FROM user RIGHT JOIN employee ON user.id = employee.user_id WHERE user.id = ".$user_id;
        $result = $this->database->make_query($query);
        if($result->num_rows == 1)
        { 
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $result->close();
            return $row ;
        }
    }


    function update($id)
    {
        parent::update($id);
        $data_to_update = "qulification='" .$this->qulification. "',rate='". $this->rate. "'" ;
        $result = $this->database->update_data(self::TABLE_NAME, $data_to_update, self::TABLE_KEY, $id);
        if($result)
        {
            $this->database->close_db();
            return true;            
        }
        return false;
    }
    
    function delete($id) {
        
        if($this->image != 'user.png')
            $this->delete_photo($this->image); 
            
        $result = parent::delete($id);
        if($result)
        {
            $this->database->close_db();
            return true;            
        }
        return false;
    }
}

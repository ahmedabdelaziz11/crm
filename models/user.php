<?php
require_once 'database.php';
require_once app_path.'/interfaces/curdInterface.php';            


class user implements curdInterface{
 
    
    public $id ;
    public $username;
    public $password;
    public $email;
    public $address;
    public $image;
    public $user_type;
    
    private CONST TABLE_NAME = "user" ;                                  
    private CONST TABLE_COLUMNS= "`id`, `username`, `Password`, `email`, `address`, `image`, `user_type`" ;
    private CONST TABLE_KEY = "id" ;
    
    private const salt1 = "qm*@a"; // to hash password
    private const salt2 = "pg&!";
    private $database ;

    function __construct($username="",$password="",$email="" ,$address="",$user_type="") 
    { 
        $this->database  = new database();
        $this->set_data($username,$password,$email,$address,$user_type);   
    }
    
    public function set_data($username,$password,$email,$address,$user_type) {
        $this->username  = $this->database->clean_query($username);
        $this->password  = $this->get_hashed($this->database->clean_query($password));
        $this->email     = $this->database->clean_query($email);
        $this->address   = $this->database->clean_query($address);
        $this->user_type = $user_type;
        $this->image     = "user.png"; // defualt photo 
    }
    
    public function set_id($id) {
         $this->id = $id;
    }
    public function get_id() {
        return $this->id;
    }
    public function get_username() {
        return $this->username;
    }
    public function get_email() {
        return $this->email;
    }
    public function get_address() {
        return $this->address;
    }
    public function get_image() {
        return $this->image;
    }    
    public function get_user_type() {
        return $this->user_type;
    }


    private function get_hashed($pass)
    {
        return hash('ripemd128', self::salt1 .$pass. self::salt2);
    }
    
    function username_is_unique()
    {
        $query  = "SELECT username FROM ".self::TABLE_NAME." WHERE username = '$this->username' ";
        $result = $this->database->make_query($query);
        return ($result->num_rows == 1) ? false : true ;
    }
    
    function email_is_unique()
    {
        $query  = "SELECT email FROM ".self::TABLE_NAME." WHERE email = '$this->email' ";
        $result = $this->database->make_query($query);
        return ($result->num_rows == 1) ? false : true ;
    }
    
    
    function register()
    {
        $data_to_insert = " NULL , '$this->username', '$this->password', '$this->email','$this->address', '$this->image','$this->user_type'" ;
        $result         = $this->database->insert_data(self::TABLE_NAME, self::TABLE_COLUMNS, $data_to_insert); 
        if($result) 
        {
            $this->id = $this->database->connection_link->insert_id;   // set inserted id 
            $newcount = $this->count_of_users($this->user_type) + 1 ; //update user count
            $this->update_count($newcount, $this->user_type);
            $this->database->close_db();
            return true;
        }
        return false;
    }

    //when register or delete user this fn update count of users
    function update_count($newcount,$user_type)
    {
        $data_to_update = "count='" .$newcount. "'" ;
        $result = $this->database->update_data("user_type", $data_to_update, "id", $user_type);
        return ($result) ? true : false ;
    }
    
        
    public function login()
    {
        $query = " SELECT * FROM ".self::TABLE_NAME." WHERE username = '$this->username' AND password = '$this->password'";
        $result = $this->database->connection_link->query($query);
        return ($result->num_rows == 1) ? true : false ; 
    }

    public function get_by_id($id="")
    {
        if($id== null)
            $query = "SELECT * FROM ".self::TABLE_NAME." WHERE username = '$this->username' ";
        else 
            $query = "SELECT * FROM ".self::TABLE_NAME." WHERE id = ".$id ;
        
        $result = $this->database->make_query($query);
        if($result->num_rows == 1)
        {
            $user_data       = $result->fetch_array(MYSQLI_ASSOC);
            $this->id        = $user_data['id'];
            $this->username  = $user_data['username'];
            $this->email     = $user_data['email'];
            $this->address   = $user_data['address'];
            $this->user_type = $user_data['user_type'];
            $this->image     = $user_data['image'];
            return true ;
        }       
        return false ;
    }

    function get_email_formDB($id)
    {
        $query  = "SELECT email FROM ".self::TABLE_NAME." WHERE id = $id ";
        $result = $this->database->make_query($query);
        if($result->num_rows == 1)
        {  
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $result->close();
            $this->database->close_db();
            return $row['email'] ;
        }        
        return false;
    }
    
    
    public function get_all()
    {
        $query  = "SELECT * FROM ".self::TABLE_NAME." WHERE user_type = $this->user_type";
        $result = $this->database->make_query($query);
        if($result)
        {
            $rows = $result->num_rows;
            $users = array(); 
            for($i=0; $i<$rows ;$i++)
            {
                $result->data_seek($i);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $users[] = $row ;
            }
            $result->close();
            $this->database->close_db();
            return $users ;
        }
    }


    function update($id)
    {
        $data_to_update = "username='" . $this->username. "',password='". $this->password. "',email='" . $this->email. "',address='" . $this->address. "'" ;
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
        if($result)
        { 
            $newcount = $this->count_of_users($this->user_type) - 1 ; 
            $this->update_count($newcount, $this->user_type);  
            $this->database->close_db();
            return true;
        }
        return false;
    }

        
    function count_of_users($user_type)
    {
        $query  = "SELECT count FROM user_type WHERE id = ".$user_type ;
        $result = $this->database->make_query($query);
            if($result->num_rows == 1)
            {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $result->close();
                return $row['count'] ; 
            }
            return false;
    }
 
}

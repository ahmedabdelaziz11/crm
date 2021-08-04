<?php
require_once 'user.php';
require_once 'subscriptions.php';
require_once app_path.'/traits/photo.php';

class customer extends user{	
    
    use photo;
    private const USER_TYPE = 3 ;
    private $database;
            
    function __construct($username="",$password="",$email="" ,$address="")
    {
        parent:: __construct($username, $password, $email, $address, self::USER_TYPE);
        $this->database     = new database();
    }
    
    
    function delete($id)
    {
        
        if($this->image != 'user.png')
            $this->delete_photo($this->image); 
            
        parent::delete($id);
    }
}

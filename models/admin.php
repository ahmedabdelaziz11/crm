<?php
require_once 'user.php';

class admin extends user{	
    
    private const USER_TYPE = 1 ;
    
    function __construct($username="",$password="",$email="" ,$address="")
    {
        parent:: __construct($username, $password, $email, $address, self::USER_TYPE);
    }
}

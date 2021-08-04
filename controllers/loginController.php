<?php
require_once '../config.php';
require_once app_path.'/models/user.php';            
if(isset($_POST['login']))
{
    $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);

    $user = new user($username,$password);
    if($user->login())
    { 
        session_start();
        $user->get_by_id();
        $_SESSION['id']        = $user->get_id();
        $_SESSION['username']  = $user->get_username();
        $_SESSION['email']     = $user->get_email();
        $_SESSION['address']   = $user->get_address();
        $_SESSION['user_type'] = $user->get_user_type();
        $_SESSION['image']     = $user->get_image();
        header("location: route.php");

    }else{
            
        $formErrors = 'username or password are wrong ';
    }
}
require_once app_path.'/views/login.php';            


    
    


    

<?php
require_once '../config.php';
require_once app_path.'/models/customer.php';            

if(isset($_POST['register']) && $_POST['register'] = 'register' )
{
    // sanitize input
    $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING); 
    $email    = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $address  = filter_var($_POST['address'],FILTER_SANITIZE_STRING);

    //validate input 
    $formErrors = array();
    $formErrors = null ;
    $customer = new customer($username,$password,$email,$address);

    if(!$customer->username_is_unique())
        $formErrors[] = 'username is already used';  
        
    if(!$customer->email_is_unique())
        $formErrors[] = 'email is already used';

    if($formErrors != null )
        include_once app_path.'/views/register.php';

    else    
    {       
        if($customer->register())
        {
            $username   = "";
            $email      = "";        
            $address    = "";
            $success    = '<div class="alert alert-success">you are register successfully </div>'  ;               
        }
    }
    
}
require_once app_path.'/views/register.php';            


    
    
    



    
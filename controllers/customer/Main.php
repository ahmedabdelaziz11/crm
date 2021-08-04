<?php
require_once '../../config.php';
require_once app_path.'/models/subscriptions.php';            
require_once app_path.'/models/plan.php';            
require_once app_path.'/models/customer.php';            

$user_id  = $_SESSION['id'];
$username = $_SESSION['username'];
$email    = $_SESSION['email'];
$address  = $_SESSION['address'];
$image    = $_SESSION['image'];

$subscriptions = new subscriptions();
$subscription_data  = $subscriptions->get_customer_subscription($user_id);
if($subscription_data){
    $plan_id    = $subscription_data['plan_id'];
    $plan_start = $subscription_data['start']  ;
    $plan_end   = $subscription_data['end'];
    $plan_name  = $subscription_data['name'];
}
else {
    $plan_name  = "do not subscribe to plan yet";   
    $plan_start = ""  ;
    $plan_end   = "";
}

//  upload new photo
if(isset($_POST['upload']))
{    
    $customer  = new customer();
    $new_photo = $customer->validate_photo($_FILES['photo'],$_FILES['photo']['error']);    
    if($customer->save($user_id))
    {
        if($image != 'user.png')
            $customer->delete_photo ($image); // delete old photo     
        
        $_SESSION['image'] = $new_photo;
        $image             = $new_photo; 
    }
    else {
        foreach ($customer->errors as $error)
        {
            echo $error ;
        }   
    }  
    
}
require_once app_path.'/views/customer/Main.php';            


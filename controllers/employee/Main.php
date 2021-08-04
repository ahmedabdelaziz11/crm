<?php 
require_once '../../config.php';
require_once app_path.'/models/employee.php';            
require_once app_path.'/traits/photo.php';            

$user_id      = $_SESSION['id'];
$username     = $_SESSION['username'];
$email        = $_SESSION['email'];
$address      = $_SESSION['address'];
$image        = $_SESSION['image'];

$emp      = new employee();
$emp_data = $emp->get_by_id($user_id);

$qulification = $emp_data['qulification'];
$rate         = $emp_data['rate'];
$sum          = $emp->sum_rate();
$rate         = 0 ;
if($sum != 0)
    $rate = $rate / $sum * 100 ;


//upload new photo 
if(isset($_POST['upload']))
{    
    $employee  = new employee();
    $new_photo = $employee->validate_photo($_FILES['photo'],$_FILES['photo']['error']);    
    if($employee->save($user_id))
    {
        if($image != 'user.png')
            $employee->delete_photo ($image); // delete old photo         
        
        $_SESSION['image'] = $new_photo;
        $image             = $new_photo; 
    }
    else {
        foreach ($employee->errors as $error)
        {
            echo $error ;
        }   
    }  
}
require_once app_path.'/views/employee/Main.php';            
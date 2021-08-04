<?php
require_once '../../config.php';
require_once app_path.'/models/complaint.php';
require_once app_path.'/models/employee.php';

$user_id  = $_SESSION['id']; //customer id 

//------------    MAKE COMPLIANT -----------------------
if(isset ($_POST['SaveComplaint']))
{
    if(isset($_POST['description']))
    {
        $description = $_POST['description'];
        $complaint = new complaint();
        $complaint->set_data($user_id, $description);

        $result = $complaint->make_complaint();
        if($result)
        {
            $success  = '<div class="alert alert-success">make complaint successfully </div>'  ;
            require_once app_path.'/views/customer/makeComplaint.php';
        }
        else
        {
            $formErrors  = 'something went wrong'  ;
            require_once app_path.'/views/customer/makeComplaint.php';      
        }
    }
    else
    {
        $formErrors  = 'please write your complaint'  ;
        require_once app_path.'/views/customer/makeComplaint.php';           
    }
}

//-----------------------  MAKE COMPLAINT FORM ---------------------------
elseif(isset($_GET['MakeComplaint']))
{
    require_once app_path.'/views/customer/makeComplaint.php';            
}

// rate form 
else if(isset ($_POST['rate']))
{
    $complaint_id = $_POST['id'] ;
    $old_rate     = $_POST['old_rate'];
    $employee_id  = $_POST['employee_id'];
    require_once app_path.'/views/customer/rate.php';            
}

//------------------------  save rate ----------------------------------
else if (isset ($_POST['sentRating']))
{
    if(isset($_POST['star']))
    {
        $complaint_id  = $_POST['id'];
        $rate          = $_POST['star'];
        $old_rate      = $_POST['old_rate'];
        $employee_id   = $_POST['employee_id'];
        $complaint     = new complaint();
        $result        = $complaint->rate_solution($complaint_id, $rate);
        $employee_rate = $rate - $old_rate ;
        $emp = new employee();
        if($result && $emp->set_rate($employee_id, $employee_rate))
        {
            $success  = '<div class="alert alert-success">thanks for your feadback for our service . </div>'  ;
            require_once app_path.'/views/customer/rate.php';            
        }
        else 
        {
            $formErrors  = 'something went wrong'  ;
            require_once app_path.'/views/customer/rate.php';               
        }
    }
    else
    {
        $formErrors  = 'please pic a star'  ;
        require_once app_path.'/views/customer/rate.php';               
    }
    
}
else 
{ //----------------------DELETE COMPLAINT ---------------------------------------
    if (isset($_GET['action']) && $_GET['action'] == 'delete')
    {
        $complaint_id = $_GET['id'] ;
        $complaint    = new complaint();
        $complaint->delete($complaint_id);   
    }
    
    //----------------------display customer complaints --------------------------
    $complaint    = new complaint();  
    $comps_data = $complaint->get_customer_complaint($user_id);
    require_once app_path.'/views/customer/complaint.php';            
}




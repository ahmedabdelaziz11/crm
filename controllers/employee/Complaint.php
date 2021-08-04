<?php
require_once '../../config.php';
require_once app_path.'/models/complaint.php';            
require_once app_path.'/models/customer.php';            
require_once app_path.'/models/employee.php';            

//-------------------   SOLVE complaint  -----------------
if(isset ($_POST['solved']) && isset($_POST['id']))
{
    $id          = $_POST['id']; //id of complaint
    $solution    = $_POST['solution'];
    $user_id     = $_POST['user_id'];
    $employee_id = $_SESSION['id'];   
    
    //---send email to client with solution ---
    $customer        = new customer();
    $customer_email  = $customer->get_email_formDB($user_id); 
    $subject  = "soultion of your problem";
    $employee = new employee();
    $m_result = $employee->send_mail($subject, $solution, $customer_email);
    
    //---save solution in DB-----
    $complaint = new complaint();
    $result = $complaint->solve_complaint($id, "$solution", $employee_id);
    if($result)
    {
        $success = 'send solution successfully'  ;
        if($m_result)
            $success .= '<br>send Email successfully' ;
        require_once app_path.'/views/employee/solveComplaint.php';            
    }
    else
    {
        $formErrors  = $mail->ErrorInfo ;
        require_once app_path.'/views/employee/solveComplaint.php';                   
    }
}

//------------- solve complaint form---------------------
elseif(isset($_GET['action'])  && $_GET['action'] == 'solve')
{
    $id      = $_GET['id'];
    $user_id = $_GET['user_id'];
    require_once app_path.'/views/employee/solveComplaint.php';                
}
else
{
    $complaint = new complaint();
    $comps_data = $complaint->get_notsolved_complaints();
    require_once app_path.'/views/employee/Complaints.php';            
}




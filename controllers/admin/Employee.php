<?php
require_once '../../config.php';
require_once app_path.'/models/employee.php';

if($_POST || @$_GET['action'])
{
    //  ADD OR UPDATE Employee 
    if(isset($_POST['addEmployee']))
    {
        // sanitize input
        $id            = $_POST['id']; // if only come from update form

        $username      = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
        $password      = filter_var($_POST['password'],FILTER_SANITIZE_STRING); 
        $email         = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $address       = filter_var($_POST['address'],FILTER_SANITIZE_STRING);
        $qulification  = filter_var($_POST['qulification'],FILTER_SANITIZE_STRING);

        $oldUserName   = $_POST['oldUserName']; // if only come from update form
        $oldEmail      = $_POST['oldEmail'];   // if only come from update form

        $employee = new employee($username,$password,$email,$address,$qulification);

        $formErrors = array();

        // not has id (new employee) 
        if($id == null)
        {
            $formName   = 'Add';

            if(!$employee->username_is_unique())
                $formErrors[] = 'username is already used';  

            if(!$employee->email_is_unique())
                $formErrors[] = 'email is already used';
                             
            if($formErrors != null )
                require_once app_path.'/views/admin/Employee.php';

            if($employee->register())
            {
                $username = "";
                $email    = "";        
                $address  = "";
                $success  = '<div class="alert alert-success">you are register successfully </div>'  ;
                require_once app_path.'/views/admin/Employee.php';
            }
            else
            {
                $formErrors[] = 'something went wrong';
                require_once app_path.'/views/admin/Employee.php';
            }         
        }

        // update
        elseif(isset($id))
        {
            $formName = 'update';

            if($username != $oldUserName && !$employee->username_is_unique() )
                $formErrors[] = 'username is already used';  

            if($email != $oldEmail && !$employee->email_is_unique())
                $formErrors[] = 'email is already used';

            if($formErrors != null )
                require_once app_path.'/views/admin/Employee.php';

            if($employee->update($id))
            {
                $username     = "";
                $email        = "";        
                $address      = "";
                $qulification = "";
                $success  = '<div class="alert alert-success">you are update employee successfully </div>'  ;
                require_once app_path.'/views/admin/Employee.php';
            } 
            else
            {
                $formErrors[] = 'something went wrong';
                require_once app_path.'/views/admin/Employee.php';
            } 

        }
    } 
    
    //-------------------- Add Employee Form--------------------------
    if(isset($_GET['action']) && $_GET['action'] == 'add')
    {
        $formName = 'Add';
        require_once app_path.'/views/admin/Employee.php';
    }
    
    //--------------- update employee form ------------------------------
    if(isset($_GET['action'])  && $_GET['action'] == 'update')
    {
        
        $id           = $_GET['id'];
        $employee     = new employee();
        $data         = $employee->get_by_id($id);
        $username     = $data['username']; 
        $email        = $data['email'];
        $address      = $data['address'];
        $qulification = $data['qulification'];
        $formName     = 'update';
        require_once app_path.'/views/admin/Employee.php'; 
    }
    
    // ------------------ delete employee-------------------------- 
    if(isset($_GET['action'])  && $_GET['action'] == 'delete')
    {
        $employee_id = $_GET['id'] ;
        $employee    = new employee();
        $employee->get_by_id($employee_id);
        $employee->delete($employee_id);        
    }
}

else // display all employees 
{
    $employee = new employee();
    $employee_data = $employee->get_all();
    require_once app_path.'/views/admin/showEmployees.php';   
}    

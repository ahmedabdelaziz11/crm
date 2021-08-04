<?php
require_once '../../config.php';
require_once app_path.'/models/admin.php';

if($_POST || @$_GET['action'])
{
    // ---------- ADD or UPDATE admin -----------
    if(isset($_POST['addAdmin']))
    {

        // sanitize input
        $id            = $_POST['id']; // if only come from update form

        $username      = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
        $password      = filter_var($_POST['password'],FILTER_SANITIZE_STRING); 
        $email         = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $address       = filter_var($_POST['address'],FILTER_SANITIZE_STRING);

        $oldUserName   = $_POST['oldUserName']; // if only come from update form   
        $oldEmail      = $_POST['oldEmail']; // if only come from update form

        $admin = new admin($username,$password,$email,$address);

        $formErrors = array();

        // not has id (new admin) 
        if($id == null)
        {
            $formName   = 'Add';

            if(!$admin->username_is_unique())
                $formErrors[] = 'username is already used';  

            if(!$admin->email_is_unique())
                $formErrors[] = 'email is already used';

            if($formErrors != null )
                require_once app_path.'/views/admin/Admin.php';  

            if($admin->register())
            {
                $username = "";
                $email    = "";        
                $address  = "";
                $success  = '<div class="alert alert-success">you are register successfully </div>'  ;
                require_once app_path.'/views/admin/Admin.php';  
            }
            else
            {
                $formErrors[] = 'something went wrong';
                require_once app_path.'/views/admin/Admin.php';  
            }
        }
        // update
        elseif(isset($id))
        {
            $formName = 'update';

            if($username != $oldUserName && !$admin->username_is_unique() )
                $formErrors[] = 'username is already used';  

            if($email != $oldEmail && !$admin->email_is_unique())
                $formErrors[] = 'email is already used';

            if($formErrors != null )
                require_once app_path.'/views/admin/Admin.php';  

            if($admin->update($id))
            {
                $username = "";
                $email    = "";        
                $address  = "";
                $success  = '<div class="alert alert-success">you are update admin successfully </div>'  ;
                require_once app_path.'/views/admin/Admin.php';       
            }
            else
            {
                $formErrors[] = 'something went wrong';
                require_once app_path.'/views/admin/Admin.php';  
            }

        }
    }
    
    //---------------- Add Admin Form -------------
    if(isset($_GET['action']) && $_GET['action'] == 'add')
    {
        $formName = 'add';
        require_once app_path.'/views/admin/Admin.php';  

    }
    
    // ------------ update admin form -------------
    if(isset($_GET['action'])  && $_GET['action'] == 'update')
    {
        $id = $_GET['id'];
        $admin = new admin();
        $admin->get_by_id($id);
        $username = $admin->get_username();
        $email    = $admin->get_email();
        $address  = $admin->get_address();
        $formName = 'update';
        require_once app_path.'/views/admin/Admin.php';  
    }
    
    // ------------ delete admin --------------- 
    if(isset($_GET['action'])  && $_GET['action'] == 'delete')
    {
        $admin_id = $_GET['id'] ;
        $admin = new admin(); 
        $admin->delete($admin_id);
    }
}

else // display all admin 
{
    $admin = new admin();
    $admin_data = $admin->get_all();
    require_once app_path.'/views/admin/showAdmins.php';  
}      




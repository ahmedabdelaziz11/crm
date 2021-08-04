<?php
require_once '../../config.php';
require_once app_path.'/models/plan.php';

if($_POST || @$_GET['action'])
{
    // ----------- ADD OR UPDATE Plan ---------------------
    if(isset($_POST['addPlan']))
    {
        // sanitize input
        $name     = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
        $duration = filter_var($_POST['duration'],FILTER_SANITIZE_NUMBER_INT); 
        $cost     = filter_var($_POST['cost'],FILTER_SANITIZE_NUMBER_FLOAT);

        $id       = $_POST['id'];       // if only come from update form
        $oldName  = $_POST['oldName']; // if only come from update form

        $plan = new plan($name,$duration,$cost);
        $formErrors = "";
        $formErrors = null ;    

        // not has id (new plan)
        if($id == null)
        {
            $formName = 'add';

            if(!$plan->name_is_unique())
                $formErrors = 'name is already used';

            if($formErrors != null )
                require_once app_path.'/views/admin/Plan.php';   

            if($plan->create())
            {
                $name     = "";
                $duration = "";        
                $cost     = "";
                $success  = '<div class="alert alert-success">you are add plan successfully </div>'  ;
                require_once app_path.'/views/admin/Plan.php';   
            }
            else
            {
                $formErrors = 'something went wrong';
                require_once app_path.'/views/admin/Plan.php';   
            }  
        }

        // update
        elseif(isset($id))
        {
            $formName = 'update';

            if($name != $oldName && !$plan->name_is_unique() )
                $formErrors[] = 'name is already used';  

            if($formErrors != null )
                require_once app_path.'/views/admin/Plan.php';   

            if($plan->update($id))
            {  
                $name     = "";
                $duration = "";        
                $cost     = "";
                $success  = '<div class="alert alert-success">you are add plan successfully </div>'  ;
                require_once app_path.'/views/admin/Plan.php';   
            }         
        }
    }
    
    // -------------- add plan form ----------------
    if(isset($_GET['action']) && $_GET['action'] == 'add')
    {
        $formName = 'add';
        require_once app_path.'/views/admin/Plan.php'; 
    }
    
    //--------------------- UPADTE Plan Form -----------------
    if(isset($_GET['action']) && $_GET['action'] == 'update')
    {
        $id       = $_GET['id'];
        $plan     = new plan();
        $data     = $plan->get_by_id($id);
        $name     = $data['name']; 
        $duration = $data['duration'];
        $cost     = $data['cost'];
        $formName = 'update';
        require_once app_path.'/views/admin/Plan.php'; 
    }
    
    //--------------------- delete plan ---------------------------
    if(isset($_GET['action'])  && $_GET['action'] == 'delete')
    {
        $plan_id = $_GET['id'] ;
        $plan    = new plan();
        $plan->delete($plan_id);
    } 
}

// -------------------------  display all plan ----------------------------------
else
{    
    $plan = new plan();
    $plan_data = $plan->get_all();
    require_once app_path.'/views/admin/showPlans.php'; 
}
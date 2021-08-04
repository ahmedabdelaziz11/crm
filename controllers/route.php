<?php

session_start();

if(isset($_SESSION['username']) && $_SESSION['username'] != null)
{    
    switch ($_SESSION['user_type'])
    {
        case 1  :        
            header("Location: ../views/admin/index.php ");
            break;
        case 2  :
            header("Location: ../views/employee/index.php");
            break;
        case 3  :
            header("Location: ../views/customer/index.php");
            break;
        default :
            header("Location: ../views/login.php");
            break;
    }
}
else{
    header("Location: ../views/login.php");
}



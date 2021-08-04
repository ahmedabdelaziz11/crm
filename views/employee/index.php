<?php 
session_start();

if(!isset($_SESSION['username']) || $_SESSION['user_type'] != '2')
{
    header('Location:../login.php');
}

?>


<!DOCTYPE html>
<html Lang="en">
    <head> 
        <meta charset="UTF-8" /> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title> Login </title> 
        <link rel="stylesheet" href="../../resources/css/bootstrap.min.css" /> 
        <link rel="stylesheet" href="../../resources/css/fontawesome.min.css" /> 
        <link rel="stylesheet" href="../../resources/css/all.css" />
        <link href="../../resources/css/form.css" rel="stylesheet" type="text/css"/>
        <link href="../../resources/css/index.css" rel="stylesheet" type="text/css"/>
        
     
        
        <link href="http://fonts.googleapis.com/css?family=raleway:400,700,900,900i">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --> 
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
        <!--[if lt IE 9]> 
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js">
        </script> <script src="https://oss. maxcdn.com/respond/1.4.2/respond.min.js"></script> 
        <! [endif]-->
    </head>
    <body>
        <div class ="container">
            <header>

                <h1 class="text-center">CRM</h1>

                <h2>welcome <?php if(isset($_SESSION['username']))
                { echo $_SESSION['username']." "."<a href='../../controllers/logout.php'>Logout</a>";
                }?>
                </h2>
            </header>
             <div> 
                    <a class="btn btn-secondary" href="?page=Main"> Main</a>
                    <a class="btn btn-secondary" href="?page=Complaint"> view complaints</a>
                </div>  
            <div class="clear"></div>
            <div id ="contents" >
      
                <section id="page">
                    <?php
                    if(@$_GET['page']){
                        $url = "../../controllers/employee/" . $_GET['page'] . ".php" ;
                        if(is_file($url)) {
                        include $url;
                        } else {
                        echo 'error';
                        }
                    }else {
                    include '../../controllers/employee/Main.php';
                    }
                    ?>
                </section>
            </div>
            <div class="clear"></div>
            <footer>
                <p>Copyright reserved - Ahmed Abdelaziz </p>
            </footer>
        </div>
        
        <script src="js/jquery-1.12.4.min.js"></script> 
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

<!DOCTYPE html>
<html Lang="en">
    <head> 
        <meta charset="UTF-8" /> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title> Register </title> 
        <link rel="stylesheet" href="../resources/css/bootstrap.min.css" /> 
        <script rel="stylesheet" href="../resources/js/all.js" ></script>
        <link rel="stylesheet" href="../resources/css/fontawesome.min.css" /> 
        <link rel="stylesheet" href="../resources/css/all.css" />
        <link href="../resources/css/form.css" rel="stylesheet" type="text/css"/>
        
        <link href="http://fonts.googleapis.com/css?family=raleway:400,700,900,900i">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --> 
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
        <!--[if lt IE 9]> 
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js">
        </script> <script src="https://oss. maxcdn.com/respond/1.4.2/respond.min.js"></script> 
        <! [endif]-->
    </head>
    <body>
        
        <!-- Start Form -->
        <div class="container"> 
            <h1 class="text-center"> Register </h1> 
            <div class="content">
                <form class="form" action="../controllers/registerController.php" method="POST" >

                    <?php if (isset($formErrors) && $formErrors != null) { ?>
                    <div class="alert alert-danger alert-dismissible" role="start">
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span> 
                        </button> 
                            <?php 
                                foreach($formErrors as $error) { 
                                    echo $error. '<br/>';
                                }
                            ?> 
                    </div> 
                    <?php } ?>
                    <?php if(isset($success)) {echo $success; $success = null ; } ?>

                    <div class="form-group">   
                        <input class="form-control"
                               type="text"
                               name="username"
                               required="required"
                               placeholder="Type Your Username"
                               value="<?php if(isset($username)){echo $username;}?>"
                               /> 
                        <i class="fal fa-user fa-fw"></i>
                        <span class="asterisx">*</span>
                    </div>

                    <div class="form-group">
                        <input class="form-control"
                               type="password"
                               name="password"
                               required="required"
                               placeholder="Type Your passowrd"
                               /> 
                        <i class="fal fa-user fa-fw"></i>
                        <span class="asterisx">*</span>
                    </div>

                    <div class="form-group">
                        <input class="form-control"
                               type="email"
                               name="email"
                               required="required"
                               placeholder="Type Your email"
                               value="<?php if(isset($email)){echo $email;}?>"
                               /> 
                        <i class="fal fa-user fa-fw"></i>
                        <span class="asterisx">*</span>
                    </div>

                    <div class="form-group">
                        <input class="form-control"
                               type="text"
                               name="address"
                               required="required"
                               placeholder="Type Your address"
                               value="<?php if(isset($address)){echo $address;}?>"
                               /> 
                        <i class="fal fa-user fa-fw"></i>
                        <span class="asterisx">*</span>
                    </div>



                    <input class="btn btn-success"
                           type="submit"
                           name ="register"
                           value="register"
                           /> 
                    <i class="fal fa-send fa-fw  send-icon"></i>

                </form> 
                <a href="../controllers/loginController.php">  go to login </a>
            </div>
 
        </div>
            <!-- end Form -->
        <div class="clear"></div>
            <footer>
                <p>Copyright reserved - Ahmed Abdelaziz </p>
            </footer>
        </div>    
            
               
       
        
        
        <script src="js/jquery-1.12.4.min.js"></script> 
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

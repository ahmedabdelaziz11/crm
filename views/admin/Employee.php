<?php 
if(isset($_GET['action']) || isset($_POST['addEmployee']))
{
    
}
else
{
    header('Location:../login.php');
}
?>
<!-- Start Form -->
<div class="container" > 
    <h2 class="text-center add"> <?php echo $formName; ?> employee </h2> 
    <form class="form" action="" method="POST" >
                
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
        
            <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}?>"/>
            <input type="hidden" name="oldUserName" value="<?php if(isset($username)){echo $username;}?>"/>
            <input type="hidden" name="oldEmail" value="<?php if(isset($email)){echo $email;}?>"/>
                
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
                <span class="asterisx">*</spa>
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
            
            
            <div class="form-group">
                <input class="form-control"
                    type="text"
                    name="qulification"
                    required="required"
                    placeholder="Type Your qulification"
                    value="<?php if(isset($qulification)){echo $qulification;}?>"
                /> 
                <i class="fal fa-user fa-fw"></i>
                <span class="asterisx">*</span>
            </div>
            
            <input class="btn btn-success"
                type="submit"
                name ="addEmployee"
                value="<?php echo $formName; ?>Employee"
            /> 
            <i class="fal fa-send fa-fw  send-icon"></i>
        </form> 
    
</div>
            <!-- end Form -->
            
            
                    
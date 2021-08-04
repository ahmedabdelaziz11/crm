<?php 
if(isset($_GET['action']) || isset($_POST['addPlan']))
{

}
else
{
    header('Location:../login.php');
}
?>
<!-- Start Form -->
<div class="container" > 
    <h2 class="text-center add"> <?php echo $formName; ?> plan </h2> 
    <form class="form" action="" method="POST" >
                
            <?php if (isset($formErrors)) { ?>
                <div class="alert alert-danger alert-dismissible" role="start">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span> 
                    </button> 
                        <?php  echo $formErrors. '<br/>'; ?> 
                </div> 
                <?php } ?>
            <?php if(isset($success)) {echo $success; $success = null ; } ?>
        
            <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}?>"/>
            <input type="hidden" name="oldName" value="<?php if(isset($name)){echo $name;}?>"/>
            
                
            <div class="form-group">   
                <input class="form-control"
                    type="text"
                    name="name"
                    required="required"
                    placeholder="Type plan name"
                    value="<?php if(isset($name)){echo $name;}?>"
                /> 
                <i class="fal fa-user fa-fw"></i>
                <span class="asterisx">*</span>
            </div>
                
            <div class="form-group">
                <input class="form-control"
                    type="number"
                    name="duration"
                    required="required"
                    placeholder="Type plan duration"
                    value="<?php if(isset($duration)){echo $duration;}?>"
                /> 
                <i class="fal fa-user fa-fw"></i>
                <span class="asterisx">*</span>
            </div>
                
            <div class="form-group">
                <input class="form-control"
                    type="number"
                    name="cost"
                    required="required"
                    placeholder="Type plan cost"
                    value="<?php if(isset($cost)){echo $cost;}?>"
                /> 
                <i class="fal fa-user fa-fw"></i>
                <span class="asterisx">*</spa>
            </div>
                
            
            
            <input class="btn btn-success"
                type="submit"
                name ="addPlan"
                value="<?php echo $formName; ?>Plan"
            /> 
            <i class="fal fa-send fa-fw  send-icon"></i>
        </form> 
    
</div>
            <!-- end Form -->
            
            
                    
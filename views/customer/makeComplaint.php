<?php 
if(isset($_GET['MakeComplaint']))
{

}
else
{
    header('Location:../login.php');
}
?>
<!-- Start Form -->
<div class="container" > 
    <h2 class="text-center add">Make Complaint</h2> 
    <form class="form" action="" method="POST" >
                
            <?php if (isset($formErrors)) { ?>
                <div class="alert alert-danger alert-dismissible" role="start">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span> 
                    </button> 
                        <?php echo $formErrors. '<br/>';?> 
                </div> 
                <?php } ?>
            <?php if(isset($success)) {echo $success; $success = null ; } ?>
           

            <div class="form-group">   
                <textarea class="form-control" 
                          placeholder="Describe your complaint here..." 
                          name="description" 
                          required="required" 
                          autofocus 
                ></textarea>
            </div>
        
            <input class="btn btn-success"
                type="submit"
                name ="SaveComplaint"
                value="SaveComplaint"
            /> 
            <i class="fal fa-send fa-fw  send-icon"></i>
        </form> 
    
</div>
            <!-- end Form -->
            
            
             
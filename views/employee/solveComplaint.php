<?php 
if(isset($_GET['action']))
{

}
else
{
    header('Location:../login.php');
}
?>
<!-- Start Form -->
<div class="container" > 
    <h2 class="text-center add">solve complain</h2> 
    <form class="form" action="" method="POST" >
                
            <?php if (isset($formErrors)) { ?>
                <div class="alert alert-danger alert-dismissible" role="start">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span> 
                    </button> 
                        <?php echo $formErrors. '<br/>';?> 
                </div> 
                <?php } ?>
            <?php if(isset($success)) {echo '<div class="alert alert-success">' .$success . '</div>'; $success = null ; } ?>
           

            <div class="form-group">   
                <textarea class="form-control" 
                          placeholder="Describe solution here..." 
                          name="solution" 
                          required="required" 
                          autofocus 
                ></textarea>
            </div>
        
            <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}?>"/>            
            <input type="hidden" name="user_id" value="<?php if(isset($user_id)){echo $user_id;}?>"/>

            <input class="btn btn-success"
                type="submit"
                name ="solved"
                value="solved"
            /> 
            <i class="fal fa-send fa-fw  send-icon"></i>
        </form> 
    
</div>
            <!-- end Form -->
            
            
             
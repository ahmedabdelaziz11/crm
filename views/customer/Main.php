<?php 
if(!isset($_SESSION['username']) || $_SESSION['user_type'] != '3')
{
    header('Location:../login.php');
}

?>
<style>
    #contents{
            padding-left: 50px;
    }
</style>
<div class="d-flex align-items-center">
            <div class="image"> <img src="../../resources/images/<?php echo$image?>" class="rounded" width="155"> </div>
            <div style="padding: 10px" class="ml-3 w-100">
                <h5 class="mb-1 mt-0">UserName : <?php echo $username ;?></h5> <span>Email : <?php echo $email ;?></span>
                <br><span>address : <?php echo $address ;?></span>
                <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">
                    <div class="d-flex flex-column"> <span class="articles">Plan Name</span> <span class="number1"><?php echo $plan_name ;?></span> </div>
                    <div class="d-flex flex-column"> <span class="followers">Date to start</span> <span class="number2"><?php echo $plan_start ;?></span> </div>
                    <div class="d-flex flex-column"> <span class="rating">Date to End</span> <span class="number3"><?php echo $plan_end ;?></span> </div>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <input  class="btn btn-sm " type="file" name="photo" value=""  > 
                    <input  class="btn btn-sm btn-primary w-100 ml-2" type="submit" name="upload" value="upload" >
                </form>
              <!--  <div class="button mt-2 d-flex flex-row align-items-center"> <button class="btn btn-sm btn-outline-primary w-100">Chat</button> <button class="btn btn-sm btn-primary w-100 ml-2">Follow</button> </div> -->
            </div>
        </div>











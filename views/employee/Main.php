<?php
if(!isset($_SESSION['username']) || $_SESSION['user_type'] != '2')
{
    header('Location:../login.php');
}
?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    #contents{
            padding-left: 50px;
    }
</style>
        <div class="d-flex align-items-center">
            <div class="image"> <img src="../../resources/images/<?php echo$image?>" class="rounded" width="160"> </div>
            <div style="padding: 10px" class="ml-3 w-100">
                <h5 class="mb-1 mt-0">UserName : <?php echo $username ;?></h5> <span>Email : <?php echo $email ;?></span>
                <br><span>address : <?php echo $address ;?></span>
                <div class="p-3 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">
                    
                    <div class="d-flex flex-column"> <span class="articles">qulification</span> <span class="number1"><?php echo $qulification ;?></span> </div>
                    <!--<div class="d-flex flex-column"> <span class="followers"></span> <span class="number2"><?php   ?></span> </div>-->
                    <div class="d-flex flex-column"> <span class="rating">Rate</span> <span class="number3"><span <?php if($rate >= 20) echo 'style="color: orange"'; ?> class="fa fa-star  "></span>
                                                                                                            <span <?php if($rate >= 40 ) echo 'style="color: orange"'; ?> class="fa fa-star  "></span>
                                                                                                            <span <?php if($rate >= 60) echo 'style="color: orange"'; ?> class="fa fa-star "></span>
                                                                                                            <span <?php if($rate >= 80) echo 'style="color: orange"'; ?> class="fa fa-star"></span>
                                                                                                            <span <?php if($rate >= 100) echo 'style="color: orange"'; ?> class="fa fa-star"></span>
                                                    </span> 
                    </div>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <input  class="btn btn-sm " type="file" name="photo" value=""  > 
                    <input  class="btn btn-sm btn-primary w-100 ml-2" type="submit" name="upload" value="upload" >
                </form>
            </div>
        </div>


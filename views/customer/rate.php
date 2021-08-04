<?php 
if(isset($_POST['rate']) || isset ($_POST['sentRating']))
{

}
else
{
    header('Location:../login.php');
}
?>
<style>

div.stars {
    width: 360px;
    display: inline-block;
    text-align: center;
       
}

.mt-200 {
    margin-top: 100px
}

input.star {
    display: none
}

label.star {
    float: right;
    padding: 12px;
    font-size: 35px;
    color: #4A148C;
    transition: all .2s
}

input.star:checked~label.star:before {
    content: '★';
    color: #FD4;
    transition: all .25s
}

input.star-5:checked~label.star:before {
    color: #FE7;
    text-shadow: 0 0 20px #952
}

input.star-1:checked~label.star:before {
    color: #F62
}

label.star:hover {
    transform: rotate(-15deg) scale(1.3)
}

label.star:before {
    content: '★';
    font-family: FontAwesome
}

</style>

<body>
    
<!-- Start Form -->
<div class="container" > 
    <h2 class="text-center add">Rate Solution</h2> 
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
        
        
        <div class="stars" >
                <form action="" method="post"> 
                    <input class="star star-5" id="star-5" type="radio" value="5" name="star" /> 
                    <label class="star star-5" for="star-5"></label> 
                    <input class="star star-4" id="star-4" type="radio" value="4" name="star" /> 
                    <label class="star star-4" for="star-4"></label> 
                    <input class="star star-3" id="star-3" type="radio" value="3" name="star" /> 
                    <label class="star star-3" for="star-3"></label> 
                    <input class="star star-2" id="star-2" type="radio" value="2" name="star" />
                    <label class="star star-2" for="star-2"></label> 
                    <input class="star star-1" id="star-1" type="radio" value="1" name="star" /> 
                    <label class="star star-1" for="star-1"></label>
                    <input type="hidden" name="id" value="<?php echo $complaint_id;?>">  
                    <input type="hidden" name="old_rate" value="<?php echo $old_rate;?>">    
                    <input type="hidden" name="employee_id" value="<?php echo $employee_id;?>">

                    <input class="btn btn-success" style="margin-top: 30px" type="submit" name="sentRating" value="Sent Rating"   /> 
                    </form>
            </div>
           
    
</div>
         
</body>
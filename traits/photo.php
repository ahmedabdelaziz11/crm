<?php
include_once app_path.'/models/database.php';

trait photo {
    
    public $image_db ; // name to set to DB
    public $errors = array();
    public $image_tmp;

    function validate_photo($uploaded_file,$upload_errors)
    {
        $allowed_extentions = array('jpg','gif','png','jpeg');
        
        $image_name  = $uploaded_file['name'];
        $this->image_tmp   = $uploaded_file['tmp_name'];
        $image_size  = $uploaded_file['size'];
        $image_error = $upload_errors;
        
        $image_extention  = explode('.', $image_name);
        $image_extention = strtolower(end($image_extention));
        $this->image_db           = rand() . '.' .$image_extention;
        
        if($image_error == 4)
            $this->errors[] = 'no file uploaded';
        else
        {
            if($image_size > 1500000) 
                $this->errors[] = 'file can not be more 1.5m ';

            if(! in_array($image_extention, $allowed_extentions))
                $this->errors[] = 'file not valid ';  
        }
        return $this->image_db;
    }
    
    function save($user_id)
    {
        if(empty($this->errors))
        {
            $result = $this->save_in_db($this->image_db, $user_id);
            if($result)
            {
                move_uploaded_file($this->image_tmp, $_SERVER['DOCUMENT_ROOT'].'\CRM\resources\images\\'.$this->image_db);
                return true ;
            }
        } 
        return false;   
    }
    
    function save_in_db($image,$user_id)
    {
        $this->database  = new database();
        $query  = "UPDATE user SET `image` = '$image' WHERE id = $user_id";
        $result = $this->database->make_query($query);
        if ($result)
        {
            $this->database->close_db();
            return true;
        }
        $this->database->close_db();
        return false;
    }
    
    function delete_photo($image_name)
    {
        $result = unlink($_SERVER['DOCUMENT_ROOT'].'\CRM\resources\images\\'.$image_name);
        return ($result) ? true : false ;
    }
}

<?php
require_once '../../config.php';
include app_path.'/resources/PHPMailer/class.phpmailer.php';   
include app_path.'/resources/PHPMailer/class.smtp.php';  

trait mymailer {
    
    public $my_email       = project_email;
    public $email_password = email_password;
    public $form_name      = "CRM PROJECT"; 
    
    function send_mail($subject,$body,$user_email)
    {
        $mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 465;
        $mail->Username   = $this->my_email;
        $mail->Password   = $this->email_password;
        $mail->From       = $this->my_email;     
        $mail->FromName   = $this->form_name; 
        $mail->Subject    = $subject;
        $mail->AltBody    = $body;
        $mail->msgHTML($body);    
        $mail->addAddress($user_email, 'Client'); 
        $mail->isHTML(true); 
        $result = $mail->send();
        return ($result) ? true : false;
    }
}

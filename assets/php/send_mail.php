<?php

function died($error) {
    // your error code can go here
    echo "We are very sorry, but there were error(s) found with the form you submitted. ";
    echo "These errors appear below.<br /><br />";
    echo $error."<br /><br />";
    echo "Please go back and fix these errors.<br /><br />";
    exit();
}

try {
    require_once('./class.phpmailer.php');
    if(isset($_POST['email'])) {

        $email = $_POST['email'];
        $name = $_POST['name'];
        $message = $_POST['message'];
        $subject = $name . " contacting you via Biglarpour.com";

        $error_message = "";
        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
        $string_exp = "/^[A-Za-z .'-]+$/";


        if(!array_key_exists('gotcha', $_POST)) {
            died("Who do you think you are trying to abuse us.");
        }

        if(!preg_match($email_exp, $email)) {
            $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
        }

        if(!preg_match($string_exp,$name)) {
            $error_message .= 'The Name you entered does not appear to be valid.<br />';
        }

        if(strlen($error_message) > 0) {
            died($error_message);
        }

        $mail = new PHPMailer();
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 465;
        $mail->AddAddress("abo@biglarpour.com");
        $mail->Username= "4boc4do@gmail.com";
        $mail->Password= "tD4k2fNvqs9XsGbT";
        $mail->SetFrom($email, $name);
        $mail->AddReplyTo($email, $name);
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
        header("Location:https://biglarpour.com");
        exit();
        }
    else{
        echo "No email found in POST" . $_POST;
    }
}
catch (Exception $e)
{
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>
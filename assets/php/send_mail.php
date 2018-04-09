<?php
if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_from = $_POST['email'];

    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }

    $name = $_POST['name']; // required
    $email_address = $_POST['email']; // required
    $comments = $_POST['message']; // required
    $email_subject = "Biglarpour.com Prospect client ";
    $email_subject .= $name;
    $referred = NULL;

    $error_message = "";

    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';


  if(!array_key_exists('gotcha', $_POST)) {
      died("Who do you think you are trying to abuse us.");
  }


  if(!preg_match($email_exp,$email_address)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }

    $email_message = "Personal details below.\n\n";


    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }



    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_address)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
    if(!is_null($referred)){
        $email_message .= "Referred By: ".clean_string($referred)."\n";
    }

// create email headers
$headers = 'From: '.$email_from."\r\n".
'X-Mailer: PHP/' . phpversion();
@mail("abo@biglarpour.com", $email_subject, $email_message, $headers);
exit(header("Location:https://biglarpour.com"));
?>

<?php

}
?>
<?php
    
    if (isset($_POST["contactSubmit"])) {
        
        $user_name = $_POST["contactName"];
        $user_email = $_POST["contactEmail"];
        $user_message = $_POST["contactMessage"];
    
        if (IsValid($user_email)) {
            echo "Fel med e-postadressen!";
            exit;
        }
    
        $email_from = "ehnsbbq@gmail.com";
        $email_subject = "Nytt meddelande";
        $email_body = "Du har fått ett nytt meddelande från $user_name.\n". "Här är meddelandet:\n $user_message".
    
        $to = "ehnsbbq@gmail.com";
        $headers = "From: $email_from \r\n";
    
        mail($to,$email_subject,$email_body,$headers);
        echo "mail sent";
    }
?>
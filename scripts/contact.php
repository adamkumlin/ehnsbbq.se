<?php
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

    function IsValid($str) {
        $injections = array('(\n+)',
        '(\r+)',
        '(\t+)',
        '(%0A+)',
        '(%0D+)',
        '(%08+)',
        '(%09+)');

        $inject = join("|", $injections);
        $inject = "/$inject/i";

        if (preg_match($inject, $str)) {
            return true;
        } else {
            return false;
        }
    }
?>
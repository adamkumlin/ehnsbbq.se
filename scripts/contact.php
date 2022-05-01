<?php
        $user_name = htmlspecialchars($_POST["contactName"]);
        $user_email = htmlspecialchars($_POST["contactEmail"]);
        $user_message = htmlspecialchars($_POST["contactMessage"]);
        // Hämtar namnet, e-postadressen och meddelandet från formuläret och tilldelar dem tre olika variabler. Gör om strängarna till text, detta förhindrar 
        användaren att skriva html-taggar i strängarna.

        $from = "info@ehnsbbq.se";
        $to = "ehnsbbq@gmail.com";
        // Specificerar från vilken e-postadress mejlet ska skickas och vilken e-postadress mejlet ska skickas till. Informationen sparas i två olika variabler.

        $subject = "Nytt meddelande från en användare på ehnsbbq.se";
        // Specificerar ämnet som kommer synas i mejlet.

        $headers = "From: $from\n";
        // Headers (en valfri parameter) ges variabeln "$from":s värde.

        $message = "E-postadress: $user_email\n
        Namn: $user_name\n
        Meddelande: $user_message";
        // Skapar meddelandet som faktiskt mejlet ska innehålla. I meddelandet skrivs användarens mejladress, namn och meddelande ut.
        
        if (preg_match("/(http|https|ftp|mailto)/", $user_message)) {
                // Om meddelandet som användaren skrev in innehåller "http", "https", "ftp" eller "mailto".
                        
                exit;
                // Avbryter skriptet. Detta är för att minska mängden spam-meddelanden som kan komma fram.
                
        } else {

                $mail_sent = mail($to,$subject,$message,$headers);
                // Annars skickas mejlet, detta görs med funktionen mail(). Här specificeras vilken e-postadress mejlet ska skickas till ($to), mejlets ämmne ($subject),
                // meddelandet (det som mejlet ska innehålla, $message) och $headers (avsändaren ($from)). En variabel "$send" kopplas till funktionen.
        
        }

        if ($mail_sent = true) {
        // Om variabeln har värdet "true", vilket betyder att mejlet skickades.
        
                header("Location: ../success.html");
                // Skickar vidare användaren till sidan "success.html".
        } else if ($mail_sent = false) {
                        
                header("Location: ../failure.html");
                // Annars skickas användaren vidare till sidan "failure.html".
        }
?>

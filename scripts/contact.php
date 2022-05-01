<?php
        $user_name = htmlspecialchars($_POST["contactName"]);
        $user_phone = htmlspecialchars($_POST["contactPhone"]);
        $user_email = htmlspecialchars($_POST["contactEmail"]);
        $user_message = htmlspecialchars($_POST["contactMessage"]);
        // Hämtar namnet, e-postadressen och meddelandet från formuläret och tilldelar dem tre olika variabler. Gör om strängarna till text, detta förhindrar
        // användaren att skriva html-taggar i strängarna.

        $from = "info@ehnsbbq.se";
        $to = "ehnsbbq@gmail.com";
        // Specificerar från vilken e-postadress mejlet ska skickas och vilken e-postadress mejlet ska skickas till. Informationen sparas i två olika variabler.

        $subject = "Nytt meddelande från en användare på ehnsbbq.se";
        // Specificerar ämnet som kommer synas i mejlet.

        $headers = "From: $from\n";
        // Headers (en valfri parameter) ges variabeln "$from":s värde.

        $message = "E-postadress: $user_email\n
        Namn: $user_name\n
        Telefonnummer: $user_phone\n
        Meddelande: $user_message";
        // Skapar meddelandet som faktiskt mejlet ska innehålla. I meddelandet skrivs användarens mejladress, namn och meddelande ut.

        $email_pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
        // Skapar en variabel som kopplas till en sträng.

        if (!preg_match("/^([a-öA-Ö' ]+)$/", $user_name)) {
        // Om namnet som användaren skrev in inte endast innehåller bokstäver eller mellanrum.
                        
                echo "Vänligen använd endast bokstäver (A-Ö) och mellanslag i namnrutan.";
                // Skriver ut ett felmeddelande.

        } elseif (!preg_match("/^[0-9]*$/", $user_phone)) {
        // Om telefonnumret som användaren skrev in inte endast innehåller siffror.
                        
                echo "Vänligen använd endast siffror i telefonrutan.";
                // Skriver ut ett felmeddelande.

        } elseif (!preg_match($email_pattern, $user_email)) {
        // Om e-postadressen som användaren skrev in inte matchar variabeln "$email_pattern". Det betyder att e-postadressen är ogiltig.

                echo "E-postadressen är inte giltig.";
                // Skriver ut ett felmeddelande.

        } elseif (preg_match("/(http|https|ftp|mailto)/", $user_message)) {
                // Om meddelandet som användaren skrev in innehåller "http", "https", "ftp" eller "mailto". Detta är för att minska mängden spam-meddelanden som kan komma fram.
                        
                echo "Vänligen använd inga länkar i meddelanderutan.";
                // Skapar ett felmeddelande.

        } else {

                $mail_sent = mail($to,$subject,$message,$headers);
                // Annars skickas mejlet, detta görs med funktionen mail(). Här specificeras vilken e-postadress mejlet ska skickas till ($to), mejlets ämmne ($subject),
                // meddelandet (det som mejlet ska innehålla, $message) och $headers (avsändaren ($from)). En variabel "$mail_sent" kopplas till funktionen.

                header("Location: ../success.html");
                // Skickar vidare användaren till sidan "success.html".
        }
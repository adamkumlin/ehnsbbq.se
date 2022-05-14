<?php
        $user_name = htmlspecialchars($_POST["contactName"]);
        $user_phone = htmlspecialchars($_POST["contactPhone"]);
        $user_email = htmlspecialchars($_POST["contactEmail"]);
        $user_message = htmlspecialchars($_POST["contactMessage"]);
        // Hämtar namnet, e-postadressen och meddelandet från formuläret och tilldelar dem tre olika variabler. Gör om strängarna till text, detta förhindrar
        // att användaren skriver in html-taggar i textboxarna.

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
        // Skapar meddelandet som mejlet ska innehålla. I meddelandet skrivs användarens e-postadress, namn, telefonnummer och meddelande ut.

        $subject_confirmation = "Vi har tagit emot ditt meddelande på ehnsbbq.se";
        // Skapar ett ämne till konfirmationsmejlet som kommer skickas till användaren.

        $message_confirmation = 
        "Hej $user_name!\n
        Vi har tagit emot ditt meddelande.\n
        Tack för att du kontaktade Ehn's BBQ, vi återkommer så snart vi kan.\n
        Ditt meddelande: $user_message\n
        OBS: du kan inte svara på detta mejl!";
        // Skapar ett konfirmationsmeddelande till användaren.

        if (!preg_match("/^([a-öA-Ö' ]+)$/", $user_name)) {
        // Om namnet som användaren skrev in inte endast innehåller bokstäver eller mellanrum.
                        
                echo "Vänligen använd endast bokstäver (A-Ö) och mellanslag i namnrutan.";
                // Skriver ut ett felmeddelande.

        } elseif (!preg_match("/^[0-9]*$/", $user_phone)) {
        // Om telefonnumret som användaren skrev in inte endast innehåller siffror.
                        
                echo "Vänligen använd endast siffror i telefonrutan.";
                // Skriver ut ett felmeddelande.

        } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        // Om e-postadressen som användaren skrev in inte är giltig.

                echo "E-postadressen är inte giltig.";
                // Skriver ut ett felmeddelande.

        } elseif (preg_match("/(http|https|ftp|mailto)/", $user_message)) {
                // Om meddelandet som användaren skrev in innehåller "http", "https", "ftp" eller "mailto". Detta är för att minska mängden spam-meddelanden som kan komma fram.
                        
                echo "Vänligen använd inga länkar i meddelanderutan.";
                // Skapar ett felmeddelande.

        } else {

                mail($to,$subject,$message,$headers);
                // Annars skickas mejlet, detta görs med funktionen mail(). Här specificeras vilken e-postadress mejlet ska skickas till ($to), mejlets ämne ($subject),
                // meddelandet (det som mejlet ska innehålla, $message) och $headers (avsändaren ($from)). En variabel "$mail_sent" kopplas till funktionen.

                mail($user_email,$subject_confirmation,$message_confirmation,$headers);
                // Ett konfirmationsmejl skickas också till användaren för att försäkra hen om att hens meddelande kom fram.
                
                header("Location: ../success.html");
                // Skickar vidare användaren till sidan "success.html".
        }
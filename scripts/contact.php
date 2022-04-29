<?php
        $user_name = $_POST["contactName"];
        $user_email = $_POST["contactEmail"];
        $user_message = $_POST["contactMessage"];
        // Hämtar namnet, e-postadressen och meddelandet från formuläret och tilldelar dem tre olika variabler.

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

        mail($to,$subject,$message,$headers);
        // Slutligen ska mejlet skickas, detta görs med funktionen mail(). Här specificeras vilken e-postadress mejlet ska skickas till ($to), mejlets ämmne ($subject),
        // meddelandet (det som mejlet ska innehålla, $message) och $headers (avsändaren ($from)).
?>
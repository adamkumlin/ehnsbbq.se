<!DOCTYPE html>

<html lang="sv-SE">
<!--Ändrar webbsidans språk till svenska.-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ehn's BBQ - Kontakta oss</title>
    <!--Lägger till en titel.-->

    <link rel="icon" type="image/x-icon" href="media/favicon.png">
    <!--Lägger till en favicon, en sorts ikon som syns i webbläsarens adressfält när webbsidan visas i webbläsaren.-->

    <meta name="description" content="Har du några frågor om vad vi på Ehn's BBQ gör? Vill du boka ett besök? Kontakta oss direkt så löser vi tillsammans!">
    <!--Lägger till en beskrivning av webbsidans innehåll, detta förbättrar sökmotoroptimeringen.-->

    <meta name="keywords" content="Ehn's BBQ, Ehns BBQ, Kontakta oss, Mejl, E-post, Telefon">
    <!--Lägger till sökord för webbsidan, detta förbättrar sökmotoroptimeringen.-->

    <meta name="author" content="Adam Kumlin">
    <!--Lägger till skaparens namn.-->

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!--Länkar en stilmall.-->

    <link rel="stylesheet" type="text/css" media="(min-width: 460px)" href="css/style_tablet.css">
    <link rel="stylesheet" type="text/css" media="(min-width: 1024px)" href="css/style_desktop.css">
    <!--Länkar två stilmallar som endast läses in beroende på skärmbredden. Genom att dessa extra stilmallar inte läses in direkt så blir webbplatsen snabbare.
    Prestandan ökar. Detta är ett bättre alternativ till att t.ex. alla stilmallar läses in, oavsett om skärmen uppfyller de krav så läses de ändå in.-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rancho&family=Rye&display=swap" rel="stylesheet">
    <!--Länkar en Google-font.-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed&family=Rancho&family=Rye&display=swap" rel="stylesheet">
    <!--Länkar en Google-font.-->

    <script type="module" src="https://unpkg.com/friendly-challenge@0.9.4/widget.module.min.js" async defer></script>
    <script nomodule src="https://unpkg.com/friendly-challenge@0.9.4/widget.min.js" async defer></script>

</head>

<body class="contact">

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Om server:n får en POST-request.

            $verify_url = "https://api.friendlycaptcha.com/api/v1/siteverify";
            //Skapar en variabel för URL:en som kommer utföra verifieringen.

            $data = [
                "solution" => $_POST["frc-captcha-solution"],
                // Här sparas användarens captcha-token.

                "secret" => "A1IT8L3E9H7BPQDFR1J57JIF4OMSV8VNI3JKB0204IUBCECB6P1IA0NPS3",
                // Här sparas den hemliga nyckeln som bara server:n har.

                "sitekey" => "FCMIIQMPP8GSKLFV"
            ];
            // Skapar en array "data" med olika variabler.

            $request = array (
                "http" => array (
                    "content" => http_build_query($data),
                    "method"  => "POST"
                )
                // Konstruerar en HTTP-request som ska skickas med hjälp av POST-metoden. Allt placeras inuti en array som innehåller variablerna från array:en "$data".
            );
            
            $stream_context = stream_context_create($request);
            // Skickar en stream-context med variabeln $request. Här specificeras var som ska göras med filen som hämtas i $captcha_response längre ned.

            $response = file_get_contents($verify_url, false, $stream_context);
            // Läser av URL:en. Den verifieras med variabeln "$stream_context". Filen letas inte efter i användarens lokala hårddisk ("C:\") med hjälp av den andra parametern som
            // är satt till "false".

            $captcha_response = json_decode($response, true);
            // Avkodar JSON-datan. Den returneras som ett objekt med hjälp av den andra parametern som är satt till "true".

            if ($captcha_response["success"] == true) {
            // Om verifieringen lyckas och "score" har värdet 0.5 eller mer.

                $user_name = htmlspecialchars($_POST["contactName"]);
                $user_phone = htmlspecialchars($_POST["contactPhone"]);
                $user_email = htmlspecialchars($_POST["contactEmail"]);
                $user_message = htmlspecialchars($_POST["contactMessage"]);
                // Hämtar namnet, telefonnumret, e-postadressen och meddelandet från formuläret och tilldelar sina egna variabler. Gör om strängarna till text, detta förhindrar
                // att användaren skriver in html-taggar i textboxarna.
        
                $from = "noreply@ehnsbbq.se";
                $to = "ehnsbbq@gmail.com";
                // Specificerar från vilken e-postadress mejlet ska skickas och vilken e-postadress mejlet ska skickas till. Informationen sparas i två olika variabler.
        
                $subject = "Nytt meddelande från en användare på ehnsbbq.se";
                // Specificerar ämnet som kommer synas i mejlet.
        
                $headers = "From: $from\n";
                // Headers (en valfri parameter) ges variabeln "from":s värde.
        
                $message = "E-postadress: $user_email\n
                Namn: $user_name\n
                Telefonnummer: $user_phone\n
                Meddelande: $user_message";
                // Skapar meddelandet som mejlet ska innehålla. I meddelandet skrivs användarens e-postadress, namn, telefonnummer och meddelande ut.
        
                $subject_confirmation = "Vi har tagit emot ditt meddelande på ehnsbbq.se";
                // Skapar ett ämne till konfirmationsmejlet som kommer skickas till användaren om mejlet går fram.
        
                $message_confirmation = 
                "Hej $user_name!\n
                Ditt meddelande har skickats.\n
                Tack för att du kontaktade Ehn's BBQ, vi återkommer så snart vi kan.\n
                Ditt meddelande: $user_message\n
                OBS: du kan inte svara på detta mejl!";
                // Skapar ett konfirmationsmeddelande till användaren.
        
                if (empty($user_name) || !preg_match("/^([a-öA-Ö' ]+)$/", $user_name)) {
                // Om textboxen är tom eller om namnet som användaren skrev in inte endast innehåller bokstäver eller mellanrum.
                                
                    echo "<h2>Vänligen använd endast bokstäver (A-Ö) och mellanslag i namnrutan.</h2>";
                    // Skriver ut ett felmeddelande.
        
                } elseif (!preg_match("/^[0-9]*$/", $user_phone)) {
                // Om telefonnumret som användaren skrev in inte endast innehåller siffror.
                                
                    echo "<h2>Vänligen använd endast siffror i telefonrutan.</h2>";
                    // Skriver ut ett felmeddelande.
        
                } elseif (empty($user_email) || !filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                // Om textboxen är tom eller om e-postadressen som användaren skrev in inte är giltig.
        
                    echo "<h2>E-postadressen är inte giltig.</h2>";
                    // Skriver ut ett felmeddelande.
        
                } elseif (empty($user_message) || preg_match("/(http|https|ftp|mailto)/", $user_message)) {
                // Om textboxen är tom eller om meddelandet som användaren skrev in innehåller "http", "https", "ftp" eller "mailto". Detta är för att minska mängden spam-meddelanden som kan komma fram.
                                
                    echo "<h2>Vänligen använd inga länkar i meddelanderutan.</h2>";
                    // Skriver ut ett felmeddelande.
        
                } else {
        
                    $mail_sent = mail($to,$subject,$message,$headers);
                    // Annars skickas mejlet, detta görs med metoden mail(). Här specificeras vilken e-postadress mejlet ska skickas till ($to), mejlets ämne ($subject),
                    // meddelandet (det som mejlet ska innehålla, $message) och $headers (avsändaren ($from)). En variabel "$mail_sent" kopplas till metoden. Metoden kopplas
                    // till en variabel. Om mejlet skickas så får variabeln värdet "true", annars "false".
                }
        
                if ($mail_sent) {
                // Om variabeln har värdet "sant".
        
                    http_response_code(200);
                    // Och om HTTP-response-code:en är 200 (att det lyckades).
        
                    mail($user_email,$subject_confirmation,$message_confirmation,$headers);
                    // Skickar först ett konfirmationsmejl till användaren för att försäkra hen om att hens meddelande kom fram.
        
                    header("Location: success.html");
                    // Sedan skickas användaren vidare till sidan "success.html".
        
                } else {
                    http_response_code(500);
                    // Eller om HTTP-response-code:en är 500 (att det misslyckades).
        
                    echo "<h2>Något gick fel. Ditt meddelande skickades inte.</h2>";
                    // Skriver ut ett felmeddelande.
                }
            } else {
            echo "Robotfiltret returnerade ett förbjudet värde, försök igen.";
            }
    }

    ?>

    <header>
        <a href="#mainContentContact" class="skipToMainContent">Hoppa till huvudinnehållet</a>
        <!-- Skapar en länk som användaren kan klicka. Den tar hen till huvudinnehållet på sidan. Detta är ett verktyg som gör webbplatsen mer tillgänglig. Den låter
        t.ex. användare med nedsatt syn kunna använda webbplatsen med skärmläsare. Denna länk är bra att ha även för de med små enheter som vill komma till innehållet direkt
        utan att behöva scrolla förbi en massa annat. Den är bättre att ha än att inte ha, även fast den inte alltid behövs. Denna länk, samt alla andra länkar kan kommas åt med
        tab-tangenten. Hela webbplatsen går lika bra att använda med ett tangentbord, vilket är mycket bra och viktigt. Detta är en aspekt inom tillgänglighet, att kunna använda
        webbplatsen med endast ett tangentbord.-->

        <nav class="headerNav">
            <a href="index.html"><img src="media/ehns_bbq_logo.png" alt="Bild på Ehn's BBQ:s huvudlogotyp"></a>
            <!--Lägger till en bild som också tar användaren till startsidan.-->
            
            <a class="navToggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </a>
            <!--Skapar en hamburgermeny.-->

            <div class="navLinks">
                <ul>
                    <li class="index"><a href="index.html">HEM</a></li>
                    <li class="images"><a href="images.html">BILDER</a></li>
                    <li class="contact"><a href="contact.php">KONTAKTA OSS</a></li>
                    <li class="about"><a href="about.html">OM OSS</a></li>
                    <!--Lägger till länkar till webbsidorna. -->
                </ul>
            </div>
        </nav>
    </header>

    <div class="background">
        <div class="backgroundOverlay"></div>
        <video autoplay muted loop playsinline>
            <source src="media/background_video2.mp4" type="video/mp4">
        </video>
    </div>
    <!--Lägger in en bakgrundsvideo med en overlay på. Videon spelas automatiskt och är tystad. Den loopar också. "playsinline" gör så att videon spelas av samtliga webbläsare. Video av Karolina Grabowska från Pexels (https://www.pexels.com/video/close-up-video-of-flame-on-grill-4725809/).-->

    <div id="mainContentContact">
    <!--Skapar en div som innehåller webbsidans huvudinnehåll.-->

        <h1 class="pageHeading">Kontakta oss</h1>
        <!--Lägger till webbsidans titel. -->

        <div id="contactGridContainer">
        <!--Skapar en grid-container som kommer innehålla alla grid-items.-->

            <div id="contactGridItem0">
            <!--Skapar ett grid-item.-->

                <p>
                    Kontakta oss gärna genom telefon på <br><a href="tel:0733464592"><img src="media/phone_icon.png" alt="Bild på en telefonikon">073-346 45 92</a> eller via e-post på 
                    <br><a href="mailto:ehnsbbq@gmail.com"><img src="media/email_icon.png" alt="Bild på en e-postikon">ehnsbbq@gmail.com</a>. Det går också bra att skriva till oss på 
                    <br><a href="https://www.instagram.com/ehnsbbq/" target="_blank"><img src="media/instagram_icon_white.png" alt="Bild på Instagrams logotyp i vitt">Instagram</a> 
                    eller <br><a href="https://www.facebook.com/Ehns-Bbq-1771708099778296/">
                    <img src="media/facebook_icon_white.png" alt="Bild på Facebooks logotyp i vitt">Facebook</a>.
                </p>
                <!--Skriver en text med länkar och bilder inbäddade.-->

                <p>Du får också gärna använda formuläret nedan, vi ser fram emot ditt meddelande!</p>
            </div>

            <div id="contactGridItem1">
            <!--Skapar ett grid-item.-->

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" onsubmit="return validateForm();" name="contactForm" novalidate>
                <!--Formuläret skickar datan med POST-metoden. När den skickas in så kontrolleras den först med funktionen "validateForm()". "novalidate" förhindrar att formuläret istället
                valideras av HTML-koden. Datan skickas sedan till servern (om den gick igenom valideringen). Den skickas till samma sida, gör också om strängarna till text, detta förhindrar 
                att användaren skriver in html-taggar i textboxarna (t.ex. en script-tagg vilken kan vara en säkerhetsrisk).-->

                    <input type="hidden" name="mtcaptcha-verifiedtoken" value="<token>"/>
                    <label for="contactName">Namn<input type="text" id="contactName" name="contactName" placeholder="Anna Andersson"></label>
                    <label for="contactPhone">Telefon (valfritt)<input type="tel" id="contactPhone" name="contactPhone" placeholder="0733464592"></label>
                    <label for="contactEmail">E-post<input type="email" id="contactEmail" name="contactEmail" placeholder="example@example.com"></label>
                    <label for="contactMessage">Meddelande<textarea id="contactMessage" name="contactMessage" placeholder="OBS: Var snäll inkludera inga länkar."></textarea></label>
                    <label for="contactConsent"><input type="checkbox" id="contactConsent" name="contactConsent">Jag godkänner <a href="privacy.html">integritetspolicyn</a>.</label>
                    <div class="frc-captcha" data-sitekey="FCMIIQMPP8GSKLFV"></div>
                    <input type="submit" id="contactSubmit" name="contactSubmit" value="Skicka">
                </form>
                <!--Skapar ett formulär.-->
            </div>
        </div>
    </div>

    <footer>
        <div class="footerIcons">
            <a href="https://www.instagram.com/ehnsbbq/" target="_blank"><img src="media/instagram_icon.png" alt="Bild på Instagrams logotyp"></a>
            <a href="https://www.facebook.com/Ehns-Bbq-1771708099778296/" target="_blank"><img src="media/facebook_icon.png" alt="Bild på Facebooks logotyp"></a>
        </div>

        <div class="footerAbout">
            <p>Ehn's BBQ<br>
            Tel: <a href="tel:0733464592">073-346 45 92</a><br>
            E-post: <a href="mailto:ehnsbbq@gmail.com">ehnsbbq@gmail.com</a><br>
            <a href="privacy.html">Integritetspolicy</a><br>
            &copy; 2022 Ehn's BBQ.<br></p>

            <span class="creatorName">Created by <a href="mailto:kumlinadam99@gmail.com">Adam Kumlin</a></span>
        </div>
    </footer>
    <!--Skapar en footer som innehåller information om företaget och ikoner för sociala medier. Skaparen krediteras också.-->

    <script src="scripts/script.js"></script>
    <script src="scripts/contact.js"></script>
    <!--Länkar två JavaScript-filer.--> 
</body>
</html>

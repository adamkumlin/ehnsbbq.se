let username = document.getElementById("contactName");
let email = document.getElementById("contactEmail");
let phone = document.getElementById("contactPhone");
let message = document.getElementById("contactMessage");
let consent = document.getElementById("contactConsent");
let captcha = document.getElementById("contactCaptcha");
// Skapar sex variabler och kopplar dem till respektive element.

function validateForm() {

    if (username.value == "" || email.value == "" || message.value == "") {
    // Om någon variabel är tom.
          
        alert("Var snäll fyll i alla nödvändiga fält.");
        // Skriver ut ett felmeddelande.

        return false;
        // Returnerar "false".

    } else if (!username.value.match(/^([a-öA-Ö' ]+)$/)) {
    // Om variabeln inte endast består av bokstäver och/eller mellanslag.

        alert("Vad snäll använd endast bokstäver och mellanslag i namnfältet.");
        // Skriver ut ett felmeddelande.

        return false;
        // Returnerar "false".

    } else if (!email.value.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)) {
    // Om variabeln inte matchar kriterierna för att vara en giltig e-postadress.
        
        alert("Vänligen dubbelkolla din mejladress. Den verkar inte vara giltig.");
        // Skriver ut ett felmeddelande.

        return false;
        // Returnerar "false".

    } else if (!phone.value.match(/^[0-9]*$/)) {
    // Om variabeln inte endast består av siffror.
    
        alert("Var snäll använd endast siffror i telefonfältet.");
        // Skriver ut ett felmeddelande.

        return false;
        // Returnerar "false".

    } else if (message.value.includes("http")) {
    // Om meddelandet innehåller "http".
        
        alert("Var snäll använd inga länkar i meddelandefältet.");
        // Skriver ut ett felmeddelande.

        return false;
        // Returnerar "false".

    } else if (!consent.checked == true) {
    // Om checkbox:en inte är ikryssad.
        
        alert("Du måste acceptera integritetspolicyn.");
        // Skriver ut ett felmeddelande.

        return false;
        // Returnerar "false".

    } else if (captcha.value == "") {
    // Om variabeln är tom.

        alert("Robotfiltrets textfält får inte lämnas tomt.");
        // Skriver ut ett felmeddelande.

        return false;
        // Returnerar "false".

    } else {
         
        return true;
        // Annars returneras "true".
    }
}